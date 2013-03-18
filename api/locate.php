<?php

class Locate extends Controller {

    function call_number() {
      $f3=$this->framework;
      $db = $f3->get('DB');
      $db_user = $f3->get('DB_USER');
      $db_password = $f3->get('DB_PASSWORD');
      $db_host = $f3->get('DB_HOST');
      
      require(dirname(__FILE__).'/callno_parser.php');
        
      /*$this->set('results', json_decode($results, true));
      $path_to_template = 'api/templates/direct_access_json.php';
      echo $this->render($path_to_template);*/
      mysql_connect($db_host, $db_user, $db_password)
      or die ("Could not connect to resource");

      mysql_select_db($db)
      or die ("Could not connect to database");
      
      $callno_text = $f3->get('PARAMS.callno');
      $location = $f3->get('PARAMS.location');
      $collection = $f3->get('PARAMS.collection');
      
      if($location == "LAW" && preg_match('/^[A-Z]{1,7} +[0-9]{3}[A-Z. ].*/', $callno_text)) {
        $something = "Moody";
      }
      elseif(preg_match('/^[a-zA-Z]* +[0-9]*.*/', $callno_text)) {
        $callno_text = preg_replace('/ /', '', $callno_text, 1);
      }
      
      $callno = new callno($callno_text);
      
      $urlcallno = str_replace(" ","+",$callno->str_callno);
      
      /*if (sizeof(explode("LAW", $location))>1)
      {
        $table = 'law_callno';
      }
      elseif ($location == "WID")
      {
        $table = 'wid_callno';
      }
      elseif ($location == "LAM")
      {
        $table = 'lam_callno';
      }
      elseif ($location == "TEST")
      {
        $table = 'test_callno';
      }*/
      $location = strtolower($location);
      $table = $location . "_callno";
      
      $hashes = array($callno->subclass, $callno->index_1, $callno->index_2, $callno->index_3);
      
      # Prelimenary query, to ease sql
      
      $all_callno_array = array();
      
      $query = "SELECT * FROM `$table`";
      $result = mysql_query($query);
      while ($row = mysql_fetch_array($result))
      {
        array_push($all_callno_array, new callno($row['begin_callno']));
      }
      
      
      # Check if it exists
      for ($j=0;$j<sizeof($all_callno_array);$j++)
      {
        $cur = $all_callno_array[$j];
        if (cmp_callno($cur, $callno) == 0)
        {
          # echo "Exact value exists";
          $query = 
          "SELECT `floor`, `range` FROM `$table` WHERE `begin_callno` = '$callno->str_callno' && `collection` = '$collection'";
          $res = mysql_query($query);
          $row = mysql_fetch_array($res);
          $floor = $row['floor'];
          $range = $row['range'];
        }	
      }
      
      if (!isset($floor))
      {
        // Find the Range
        array_push($all_callno_array, $callno);
        usort($all_callno_array, "cmp_callno");
      
        for ($j=0;$j<sizeof($all_callno_array);$j++)
        {
          $cur = $all_callno_array[$j];
          
          //echo $callno->str_callno . " ::: " . $cur->str_callno . "<br>";
          if (cmp_callno($cur, $callno) == 0)
          {
            $begin = $all_callno_array[$j-1];
            $end = $all_callno_array[$j+1];
            break;
          }		
        }	
      
        $query = 
        "SELECT `floor`, `range` FROM `$table` WHERE `begin_callno` = '$begin->str_callno' && `collection` = '$collection'";
        $res = mysql_query($query);
        $row = mysql_fetch_array($res);
        $floor = $row['floor'];
        $range = $row['range'];
      }
      
      if (!isset($floor))
      {
        $FIELDS     = array('floor','range');
        $JSON = array();
        $_datas   = array('not found', 'not found');
                  
        $_tmparr  = array_combine($FIELDS, $_datas);
        array_push($JSON, $_tmparr);
        echo json_encode($JSON);
      }else {
        $location = strtolower($location);
        $maplink = "http://librarylab.law.harvard.edu/map-it/map/$location/$floor/$range";
      
        $FIELDS     = array('floor','range', 'maplink');
        $JSON = array();
        $_datas   = array($floor, $range, $maplink);
                  
        $_tmparr  = array_combine($FIELDS, $_datas);
        array_push($JSON, $_tmparr);
        $callback = $_GET['callback'];
        header('Content-type: application/json');
        echo $callback . '(' . json_encode($JSON) . ')';
      }
      
      mysql_close();
    }
    
    function find_location() {
    }
    
    function barcode() {
      $f3=$this->framework;
      //$barcode = $f3->get('PARAMS.barcode');
      $barcode = $_REQUEST['barcode'];

      $json = array();

      $url = 'http://webservices.lib.harvard.edu/rest/classic/barcode/cite/' . $barcode;
      
      $ch = curl_init();
      
      curl_setopt($ch, CURLOPT_URL, $url);
      
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      
      curl_setopt($ch,CURLOPT_HTTPHEADER,array('Accept: application/json'));
      
      $contents = curl_exec($ch);
      
      curl_close ($ch);
              
      $contents = json_decode($contents);
      
      $hollis = $contents->rlistFormat->hollis->hollisId;
      $hollis = substr($hollis, 0, 9);
      $hollis_length=strlen($hollis);
      if($hollis_length <= 9) {
        $loop = 9 - $hollis_length;
        for($j=0; $j<$loop; $j++){
          $hollis = '0'.$hollis;
        }
      }
      
      $url = "http://hollis-coda.hul.harvard.edu/availability.ashx?hreciid=|library%2fm%2faleph|$hollis&output=xml";
        
      $ch = curl_init();
      
      curl_setopt($ch, CURLOPT_URL, $url);
      
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      
      $libraries = curl_exec ($ch);
        
      curl_close ($ch);
        
      $xml = simplexml_load_string($libraries);
      
      $callno = $xml->xpath("//item[@barcode='$barcode']/@callno");
      $callno = (string) $callno[0]['callno'];
      if($callno === "")
        $callno = "";
      
      $collection = $xml->xpath("//item[@barcode='$barcode']/@collection");
      $collection = (string) $collection[0]['collection'];
      if($collection === "")
        $collection = "";
      
      $library = $xml->xpath("//xserverrawdata[@barcode='$barcode']/@sub-library");
      $library = (string) $library[0]['sub-library'];
      if($library === "")
        $library = "";
      
      if($library == "Law School" && preg_match('/^[A-Z]{1,7} +[0-9]{3}[A-Z. ].*/', $callno)) {
      }
      elseif(preg_match('/^[a-zA-Z]* +[0-9]*.*/', $callno)) {
        $callno = preg_replace('/ /', '', $callno, 1);
      }
      
      if($collection == "WIDLCWID")
        $callno = "WID-LC $callno";
      
      $callno_text = $callno;
      
      include("callno_parser.php");
      mysql_connect("localhost", "locator_user", "locate88")
      or die ("Could not connect to resource");
      
      mysql_select_db("book_locator")
      or die ("Could not connect to database");
      
      $callno = new callno($callno_text);
      
      if (sizeof(explode("Law", $library))>1)
      {
        $table = 'law_callno';
      }
      elseif ($library == "Widener")
      {
        $table = 'wid_callno';
      }
      
      $hashes = array($callno->subclass, $callno->index_1, $callno->index_2, $callno->index_3);
      
      # Prelimenary query, to ease sql
      
      $all_callno_array = array();
      
      $query = "SELECT * FROM `$table`";
      $result = mysql_query($query);
      while ($row = mysql_fetch_array($result))
      {
        array_push($all_callno_array, new callno($row['begin_callno']));
      }
      
      # Check if it exists
      for ($j=0;$j<sizeof($all_callno_array);$j++)
      {
        $cur = $all_callno_array[$j];
        if (cmp_callno($cur, $callno) == 0)
        {
          # echo "Exact value exists";
          $query = 
          "SELECT `floor`, `range` FROM `$table` WHERE `begin_callno` = '$callno->str_callno'";
          $res = mysql_query($query);
          $row = mysql_fetch_array($res);
          $floor = $row['floor'];
          $range = $row['range'];
        }	
      }
      
      if (!isset($floor))
      {
        // Find the Range
        array_push($all_callno_array, $callno);
        usort($all_callno_array, "cmp_callno");
      
        for ($j=0;$j<sizeof($all_callno_array);$j++)
        {
          $cur = $all_callno_array[$j];

          if (cmp_callno($cur, $callno) == 0)
          {
            $begin = $all_callno_array[$j-1];
            $end = $all_callno_array[$j+1];
            break;
          }		
        }	
      
        $query = 
        "SELECT `floor`, `range` FROM `$table` WHERE `begin_callno` = '$begin->str_callno'";
      
        $res = mysql_query($query);
        $row = mysql_fetch_array($res);
        $floor = $row['floor'];
        $range = $row['range'];
      }
      
      if (!isset($floor))
      {
        $FIELDS     = array('floor','range');
        $JSON = array();
        $_datas   = array('not found', 'not found');
                  
        $_tmparr  = array_combine($FIELDS, $_datas);
        array_push($JSON, $_tmparr);
        echo json_encode($JSON);
      }else {
      
        $json = array();
        $json['floor'] = $floor;
        $json['range'] = $range;
        $json['library'] = $library;
        header('Content-type: application/json');
        echo json_encode($json);
      }
      
      mysql_close();
    }

}
?>
