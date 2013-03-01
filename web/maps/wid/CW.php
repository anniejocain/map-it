<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <title><?php echo "Map for $library $floor $row" ?></title> 
  
  <link rel="stylesheet" type="text/css" href="/map-it/css/map.css" />
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
  <script>
  var row = '<?php echo $row; ?>';
  </script>
  <script src="/map-it/js/highlight.js"></script>
<style>
#mapCW {
	width:710px;
	height: 480px;
}

.map {
  margin-top: -480px;
}

#bottomfull {
	margin:28px 0px 82px 92px;
	float:left;
}

#rightcolumntop {
	float:left;
	margin:65px 0px 10px 10px;
	width:100px;
}

#leftcolumntop {
	float:left;
	margin:144px 0px 10px 382px;
	width:75px;
}

.left3 {
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	border-top: 1px solid #6a8012;
	height: 36px;
	width: 5px;
	margin-bottom:60px;
}

.right3 {
	border: 1px solid #6a8012;
	height: 36px;
	width: 5px;
	margin-right: 5px;
}

.left4 {
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	border-top: 1px solid #6a8012;
	height: 48px;
	width: 5px;
	margin-top:60px;
}

.right4 {
	border: 1px solid #6a8012;
	height: 48px;
	width: 5px;
	margin-right: 5px;
	margin-top:60px;
}

.left7 {
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	border-top: 1px solid #6a8012;
	height: 84px;
	width: 5px;
}

.right7 {
	border: 1px solid #6a8012;
	height: 84px;
	width: 5px;
	margin-right: 5px;
}

.left8 {
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	border-top: 1px solid #6a8012;
	height: 96px;
	width: 5px;
}

.right8 {
	border: 1px solid #6a8012;
	height: 96px;
	width: 5px;
	margin-right: 5px;
}

.left9 {
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	border-top: 1px solid #6a8012;
	height: 108px;
	width: 5px;
}

.right9 {
	border: 1px solid #6a8012;
	height: 108px;
	width: 5px;
	margin-right: 5px;
}

.left10 {
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	border-top: 1px solid #6a8012;
	height: 120px;
	width: 5px;
}

.right10 {
	border: 1px solid #6a8012;
	height: 120px;
	width: 5px;
	margin-right: 5px;
}

.top5 {
	border: 1px solid #6a8012;
	height: 5px;
	width: 60px;
}

.bottom5 {
	border-right: 1px solid #6a8012;
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	height: 5px;
	margin-bottom: 5px;
	width: 60px;
}

.top6 {
	border: 1px solid #6a8012;
	height: 5px;
	width: 72px;
}

.bottom6 {
	border-right: 1px solid #6a8012;
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	height: 5px;
	margin-bottom: 5px;
	width: 72px;
}

.tall-space {
	margin-bottom: 5px;
}
</style>
</head>
<body>
  <img src="/map-it/images/wid/wid-CW.jpg" alt="Widener CW" class="print-map" />
        <div id="mapCW" class="map">
        	<div id="leftcolumntop">
       			<span id="row11" class="top5 tall-space"></span>
       			<span id="row10" class="top5"></span><span id="row9" class="bottom5"></span>
       			<span id="row8" class="top5"></span><span id="row7" class="bottom5"></span>
       			<span id="row6" class="top5"></span><span id="row5" class="bottom5"></span>
       			<span id="row4" class="top5"></span><span id="row3" class="bottom5"></span>
       			<span id="row2" class="top5"></span><span id="row1" class="bottom5"></span>
       		</div>
        	<div id="rightcolumntop">
       			<span id="row12" class="top6"></span><span id="row13" class="bottom6"></span>
       			<span id="row14" class="top6"></span><span id="row15" class="bottom6"></span>
       			<span id="row16" class="top6"></span><span id="row17" class="bottom6"></span>
       			<span id="row18" class="top6"></span><span id="row19" class="bottom6"></span>
       			<span id="row20" class="top6"></span><span id="row21" class="bottom6"></span>
       			<span id="row22" class="top6"></span><span id="row23" class="bottom6"></span>
       			<span id="row24" class="top6"></span><span id="row25" class="bottom6"></span>
       			<span id="row26" class="top6"></span><span id="row27" class="bottom6"></span>
       			<span id="row28" class="top6"></span><span id="row29" class="bottom6"></span>
       			<span id="row30" class="top6"></span><span id="row31" class="bottom6"></span>
       			<span id="row32" class="top6"></span><span id="row33" class="bottom6"></span>
       		</div>
       		<div class="clear"></div>
       		<div id="bottomfull">
       			<span id="row83" class="left9"></span><span id="row82" class="right9"></span>
       			<span id="row81" class="left4"></span><span id="row80" class="right4"></span>
       			<span id="row79" class="left4"></span><span id="row78" class="right4"></span>
       			<span id="row77" class="left4"></span><span id="row76" class="right4"></span>
       			<span id="row75" class="left9"></span><span id="row74" class="right9"></span>
       			<span id="row73" class="left9"></span><span id="row72" class="right9"></span> 			
       			<span id="row71" class="left9"></span><span id="row70" class="right9"></span>
       			<span id="row69" class="left9"></span><span id="row68" class="right9"></span>
       			<span id="row67" class="left9"></span><span id="row66" class="right9"></span>
       			<span id="row65" class="left9"></span><span id="row64" class="right9"></span>
       			<span id="row63" class="left9"></span><span id="row62" class="right9"></span>
       			<span id="row61" class="left9"></span><span id="row60" class="right9"></span>
       			<span id="row59" class="left9"></span><span id="row58" class="right9"></span>
       			<span id="row57" class="left9"></span><span id="row56" class="right9"></span>
       			<span id="row55" class="left9"></span><span id="row54" class="right9"></span>
       			<span id="row53" class="left9"></span><span id="row52" class="right9"></span>
       			<span id="row51" class="left10"></span><span id="row50" class="right10"></span>
       			<span id="row49" class="left10"></span><span id="row48" class="right10"></span>
       			<span id="row47" class="left10"></span><span id="row46" class="right10"></span>
       			<span id="row45" class="left10"></span><span id="row44" class="right10"></span>
       			<span id="row43" class="left10"></span><span id="row42" class="right10"></span>
       			<span id="row41" class="left10"></span><span id="row40" class="right10"></span>
       			<span id="row39" class="left10"></span><span id="row38" class="right10"></span>
       			<span id="row37" class="left10"></span><span id="row36" class="right10"></span>
       			<span id="row35" class="left3"></span><span id="row34" class="right3"></span>
       		</div>
       	</div>  
</body>
