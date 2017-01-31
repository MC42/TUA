<html>
 <head>
  <title><?php 
  $district = $_GET['district'];
  $district = strtoupper($district);
  echo $district . ' Rankings | The Ugly Alliance';
  ?></title>
  
<style>  
body {
font-family: Arial;
}
h1,h2,h3.h4,h5,h6 {
text-align:center;
}
.center {
width:420px; 
margin:0 auto;
}
.table {
width: 100%;
text-align:center;
}
tr:nth-child(2n) {
background-color: #e6e6e6;
}
</style>
</head>
<body>
 <?php 
 
 $startTime = microtime(true);
 include $_SERVER['DOCUMENT_ROOT'] . '/tbaapi/TBARequest.php';
 $tbaRequest = new tbaAPI\TBARequest("@StruckByTheBell", "UglyAlliance-Rankings", "1");

if (isset($_GET['district'])) { //THIS IS ALL A MESS WATCH WITH CAUTION
	
	$district = $_GET['district'];
	echo '<div class="center"><h2>' . strtoupper($district) . ' District Rankings</h2>';
	$distRank = $tbaRequest->getDistrictRankings(['district_short'=>$district, 'year'=>date("Y")]);
	$nonJSDistRank = json_decode($distRank);
	$rank = "1";
	
	echo '<table class="table" border="0"><tr><th>Rank</th><th>Number</th><th>Points</th></tr>';
	foreach($nonJSDistRank as $key) {
	echo '<tr><td>' . $rank . '</td><td>' . strtoupper($key->team_key) . "</td><td>" . $key->point_total . "</td></tr>";
	$rank++;
	} 
	echo '</table></div>';
}

echo '<h6>generated in ' . round((microtime(true) - $startTime), 2) . '  μs. </h6>';
 ?> 
 </body>
</html>