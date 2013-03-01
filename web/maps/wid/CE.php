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
#mapCE {
	width:710px;
	height: 500px;
}

.map {
  margin-top: -500px;
}

#toprow {
	margin:72px 15px 10px 112px;
	float:left;
}

#rightcolumn {
	float:left;
	margin:32px 15px 10px 18px;
	width:100px;
}

#leftcolumn {
	float:left;
	margin:68px 15px 10px 402px;
	width:55px;
}

.left3 {
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	border-top: 1px solid #6a8012;
	height: 36px;
	width: 5px;
	margin-top:84px;
}

.right3 {
	border: 1px solid #6a8012;
	height: 36px;
	width: 5px;
	margin-right: 5px;
	margin-top:84px;
}

.left4 {
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	border-top: 1px solid #6a8012;
	height: 48px;
	width: 5px;
	margin-top:12px;
}

.right4 {
	border: 1px solid #6a8012;
	height: 48px;
	width: 5px;
	margin-right: 5px;
	margin-top:12px;
}

.left9 {
	border-left: 1px solid #6a8012;
	border-bottom: 1px solid #6a8012;
	border-top: 1px solid #6a8012;
	height: 108px;
	width: 5px;
	margin-top:12px;
}

.right9 {
	border: 1px solid #6a8012;
	height: 108px;
	width: 5px;
	margin-right: 5px;
	margin-top:12px;
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

.top {
	margin-bottom:60px;
}

.tall-space {
	margin-bottom:36px;
}

.top4 {
	border: 1px solid #6a8012;
	height: 5px;
	width: 48px;
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
</style>
</head>
<body>
  <img src="/map-it/images/wid/wid-CE.jpg" alt="Widener CE" class="print-map" />
        <div id="mapCE" class="map">
        	<div id="toprow">
       			<span id="row1" class="left9"></span><span id="row2" class="right9"></span>
       			<span id="row3" class="left4 top"></span><span id="row4" class="right4 top"></span>
       			<span id="row5" class="left4 top"></span><span id="row6" class="right4 top"></span>
       			<span id="row7" class="left4 top"></span><span id="row8" class="right4 top"></span>
       			<span id="row9" class="left9"></span><span id="row10" class="right9"></span>
       			<span id="row11" class="left9"></span><span id="row12" class="right9"></span>
       			<span id="row13" class="left9"></span><span id="row14" class="right9"></span>
       			<span id="row15" class="left9"></span><span id="row16" class="right9"></span>
       			<span id="row17" class="left9"></span><span id="row18" class="right9"></span>
       			<span id="row19" class="left9"></span><span id="row20" class="right9"></span>
       			<span id="row21" class="left9"></span><span id="row22" class="right9"></span>
       			<span id="row23" class="left9"></span><span id="row24" class="right9"></span>
       			<span id="row25" class="left9"></span><span id="row26" class="right9"></span>
       			<span id="row27" class="left9"></span><span id="row28" class="right9"></span>
       			<span id="row29" class="left9"></span><span id="row30" class="right9"></span>
       			<span id="row31" class="left9"></span><span id="row32" class="right9"></span>
       			<span id="row33" class="left10"></span><span id="row34" class="right10"></span>
       			<span id="row35" class="left10"></span><span id="row36" class="right10"></span>
       			<span id="row37" class="left10"></span><span id="row38" class="right10"></span>
       			<span id="row39" class="left10"></span><span id="row40" class="right10"></span>
       			<span id="row41" class="left10"></span><span id="row42" class="right10"></span>
       			<span id="row43" class="left10"></span><span id="row44" class="right10"></span>
       			<span id="row45" class="left10"></span><span id="row46" class="right10"></span>
       			<span id="row47" class="left10"></span><span id="row48" class="right10"></span>
       			<span id="row49" class="left3"></span><span id="row50" class="right3"></span>
       		</div>
       		<div class="clear"></div>
       		<div id="leftcolumn">
       			<span id="row82" class="top5"></span><span id="row81" class="bottom5"></span>
       			<span id="row80" class="top5"></span><span id="row79" class="bottom5"></span>
       			<span id="row78" class="top5"></span><span id="row77" class="bottom5"></span>
       			<span id="row76" class="top5"></span><span id="row75" class="bottom5"></span>
       			<span id="row74" class="top5"></span><span id="row73" class="bottom5"></span>
       		</div>
       		<div id="rightcolumn">
       			<span id="row51" class="top6"></span><span id="row52" class="bottom6"></span>
       			<span id="row53" class="top6"></span><span id="row54" class="bottom6"></span>
       			<span id="row55" class="top6"></span><span id="row56" class="bottom6"></span>
       			<span id="row57" class="top6"></span><span id="row58" class="bottom6"></span>
       			<span id="row59" class="top6"></span><span id="row60" class="bottom6"></span>
       			<span id="row61" class="top6"></span><span id="row62" class="bottom6"></span>
       			<span id="row63" class="top6"></span><span id="row64" class="bottom6"></span>
       			<span id="row65" class="top6"></span><span id="row66" class="bottom6"></span>
       			<span id="row67" class="top6"></span><span id="row68" class="bottom6"></span>
       			<span id="row69" class="top6"></span><span id="row70" class="bottom6"></span>
       			<span id="row71" class="top6"></span><span id="row72" class="bottom6"></span>
       		</div>
       	</div>  
</body>
