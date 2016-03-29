<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php

ob_start();
session_start();
require ('config.inc.php'); 

if (!isset($page_title)) {
	$page_title = 'Your Pain Diary';

}

if(isset($_SESSION["username"])) {
	
}

elseif(!isset($_SESSION["username"]) && isset($_COOKIE["unm"]) && ($_SESSION["keeploggedin"] == 1)) {
	$_SESSION["username"] = $_COOKIE["unm"];
	
	$servername = "ap-cdbr-azure-east-c.cloudapp.net";
	$username = "bcac3dbe9c1d06";
	$password = "32d91723";
	$dbname = "booksapp";

	$dbc = new mysqli($servername, $username, $password, $dbname);
	
	$q = "SELECT user_id, username FROM users WHERE (username='".$_SESSION['username']."' AND active IS NULL";		
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	if (@mysqli_num_rows($r) == 1) { 
			
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
	}

}

else {
?>
<script type="text/javascript">
            window.location.href = "http://paindiary.azurewebsites.net/index.php"
        </script>
<?php	
}


if(isset($_COOKIE["unm"]) == $_SESSION["username"]) {
	$_SESSION["username"] = $_COOKIE["unm"];
}

	$servername = "ap-cdbr-azure-east-c.cloudapp.net";
	$username = "bcac3dbe9c1d06";
	$password = "32d91723";
	$dbname = "booksapp";

	$dbc = new mysqli($servername, $username, $password, $dbname);


?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $page_title; ?></title>
    
<!-- stylesheets -->
	<link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="colour1.css" type="text/css" id="colour1" />
    <link rel="stylesheet" href="colour2.css" type="text/css" id="colour2" />
    <link rel="stylesheet" href="colour3.css" type="text/css" id="colour3" />
    <link rel="stylesheet" href="jquery.mobile/jquery.mobile-1.4.5.css" type="text/css" />

<!-- JavaScript / JQuery -->
	<script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.js"></script>
    <script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
    <script src="json2.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
    <script src="moment-2.8.3.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>

<!-- fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ruda:700' rel='stylesheet' type='text/css'>


<script type="text/javascript">
var myInterval = setTimeout("location=('index.php');",3600000);
</script>  

<?php

$q = "SELECT user_id, username, email, pass, registration_date, colour FROM users WHERE user_id='".$_SESSION['user_id']."' AND active IS NULL";		
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	if (@mysqli_num_rows($r) == 1) { 
	$row = mysqli_fetch_assoc($r);
	$username=$row['username'];
	$register=new DateTime($row['registration_date']);
	$email=$row['email'];
	$password=$row['pass'];
	$colour=$row['colour'];
	
	switch($colour) {
case '1':
	$chosen="Blue";
	?>
    <script type="text/javascript">
    document.getElementById('colour1').disabled = false;
    document.getElementById('colour2').disabled = true;
	document.getElementById('colour3').disabled = true;
	</script>
    <?php
	break;
case '2':
	$chosen="Green";
		?>
	<script type="text/javascript">
    document.getElementById('colour1').disabled = true;
    document.getElementById('colour2').disabled = false;
	document.getElementById('colour3').disabled = true;
	</script>
    <?php
	break;
case '3':
	$chosen="Purple";
	?>
	<script type="text/javascript">
    document.getElementById('colour1').disabled = true;
    document.getElementById('colour2').disabled = true;
	document.getElementById('colour3').disabled = false;
	</script>
    <?php
	break;
default:
	$chosen="Blue";
		?>
	<script type="text/javascript">
    document.getElementById('colour1').disabled = false;
    document.getElementById('colour2').disabled = true;
	document.getElementById('colour3').disabled = true;
	</script>
    <?php
	break;
	}
	
}

if (isset($_SESSION['calmonth'])) {
	$calmonth = $_SESSION['calmonth'];
	$calyear = $_SESSION['calyear'];
}

switch ($calmonth) {
	case 1:
		$month = "January";
		break;
	case 2:
		$month = "February";
		break;
	case 3:
		$month = "March";
		break;
	case 4:
		$month = "April";
		break;
	case 5:
		$month = "May";
		break;
	case 6:
		$month = "June";
		break;
	case 7:
		$month = "July";
		break;
	case 8:
		$month = "August";
		break;
	case 9:
		$month = "September";
		break;
	case 10:
		$month = "October";
		break;
	case 11:
		$month = "November";
		break;
	case 12:
		$month = "December";
		break;
}
?>

</head>

<body>

<div id="header">
<div id="title"><a href="home.php" class="nounderline"><span class="lato900">Your</span> <span class="lato300">Pain Diary</span></a></div>
<ul id="navbar">
<li><a href="home.php" class="nounderline">Home</a></li>
<li class="activetab"><a href="profile.php" class="nounderline">Profile</a></li>
<li><a data-ajax="false" href="logout.php" class="nounderline">Logout</a></li>
</ul>
</div>
<br clear="both" />
<div id="divider"></div>

<div id="pagewrap">
<h1><a href="home.php" class="icon-chevron-left nounderline"></a>Report for <?php echo $month ?> <?php echo $calyear ?></h1>
<?php
$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "bcac3dbe9c1d06";
$password = "32d91723";
$dbname = "booksapp";

$dbc = new mysqli($servername, $username, $password, $dbname);




$sql = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth;
$result = $dbc->query($sql);
if ($result -> num_rows > 0) {


// Day 1
$sql1 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 1 ";
$result1 = $dbc->query($sql1);
if ($result1 -> num_rows > 0) {
	
	 $day1num = 0;
	 $day1sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day1num++;
		 $day1sum = $day1sum + $row['avgpain'];
	 }
	 if ($day1num !== 0) {
	 $day1 = $day1sum/$day1num;
	 }
	 else {
		 $day1 = 0;
	 }
	 echo "day1 average: ". $day1 ."</br />";
}
else {
	//echo "There is nothing on the 1st.";
}

// Day 2
$sql2 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 2 ";
$result2 = $dbc->query($sql2);
if ($result2 -> num_rows > 0) {
	
	 $day2num = 0;
	 $day2sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day2num++;
		 $day2sum = $day2sum + $row['avgpain'];
	 }
	 if ($day2num !== 0) {
	 $day2 = $day2sum/$day2num;
	 }
	 else {
		 $day2 = 0;
	 }
	 echo "day2 average: ". $day2 ."</br />";
}
else {
	//echo "There is nothing on the 2nd.";
}

// Day 3
$sql3 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 3 ";
$result3 = $dbc->query($sql3);
if ($result3 -> num_rows > 0) {
	
	 $day3num = 0;
	 $day3sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day3num++;
		 $day3sum = $day3sum + $row['avgpain'];
	 }
	 if ($day3num !== 0) {
	 $day3 = $day3sum/$day3num;
	 }
	 else {
		 $day3 = 0;
	 }
	 echo "day3 average: ". $day3 ."</br />";
}
else {
	//echo "There is nothing on the 3rd.";
}

// Day 4
$sql4 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 4 ";
$result4 = $dbc->query($sql4);
if ($result4 -> num_rows > 0) {
	
	 $day4num = 0;
	 $day4sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day4num++;
		 $day4sum = $day4sum + $row['avgpain'];
	 }
	 if ($day4num !== 0) {
	 $day4 = $day4sum/$day4num;
	 }
	 else {
		 $day4 = 0;
	 }
	 echo "day4 average: ". $day4 ."</br />";
}
else {
	//echo "There is nothing on the 4th.";
}

// Day 5
$sql5 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 5 ";
$result5 = $dbc->query($sql5);
if ($result5 -> num_rows > 0) {
	
	 $day5num = 0;
	 $day5sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day5num++;
		 $day5sum = $day5sum + $row['avgpain'];
	 }
	 if ($day5num !== 0) {
	 $day5 = $day5sum/$day5num;
	 }
	 else {
		 $day5 = 0;
	 }
	 echo "day5 average: ". $day5 ."</br />";
}
else {
	//echo "There is nothing on the 5th.";
}

// Day 6
$sql6 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 6 ";
$result6 = $dbc->query($sql6);
if ($result6 -> num_rows > 0) {
	
	 $day6num = 0;
	 $day6sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day6num++;
		 $day6sum = $day6sum + $row['avgpain'];
	 }
	 if ($day6num !== 0) {
	 $day6 = $day6sum/$day6num;
	 }
	 else {
		 $day6 = 0;
	 }
	 echo "day6 average: ". $day6 ."</br />";
}
else {
	//echo "There is nothing on the 6th.";
}

// Day 7
$sql7 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 7 ";
$result7 = $dbc->query($sql7);
if ($result7 -> num_rows > 0) {
	
	 $day7num = 0;
	 $day7sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day7num++;
		 $day7sum = $day7sum + $row['avgpain'];
	 }
	 if ($day7num !== 0) {
	 $day7 = $day7sum/$day7num;
	 }
	 else {
		 $day7 = 0;
	 }
	 echo "day7 average: ". $day7 ."</br />";
}
else {
	//echo "There is nothing on the 7th.";
}

// Day 8
$sql8 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 8 ";
$result8 = $dbc->query($sql8);
if ($result8 -> num_rows > 0) {
	
	 $day8num = 0;
	 $day8sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day8num++;
		 $day8sum = $day8sum + $row['avgpain'];
	 }
	 if ($day8num !== 0) {
	 $day8 = $day8sum/$day8num;
	 }
	 else {
		 $day8 = 0;
	 }
	 echo "day8 average: ". $day8 ."</br />";
}
else {
	//echo "There is nothing on the 8th.";
}

// Day 9
$sql9 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 9 ";
$result9 = $dbc->query($sql9);
if ($result9 -> num_rows > 0) {
	
	 $day9num = 0;
	 $day9sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day9num++;
		 $day9sum = $day9sum + $row['avgpain'];
	 }
	 if ($day9num !== 0) {
	 $day9 = $day9sum/$day9num;
	 }
	 else {
		 $day9 = 0;
	 }
	 echo "day9 average: ". $day9 ."</br />";
}
else {
	//echo "There is nothing on the 9th.";
}

// Day 10
$sql10 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 10 ";
$result10 = $dbc->query($sql10);
if ($result10 -> num_rows > 0) {
	
	 $day10num = 0;
	 $day10sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day10num++;
		 $day10sum = $day10sum + $row['avgpain'];
	 }
	 if ($day10num !== 0) {
	 $day10 = $day10sum/$day10num;
	 }
	 else {
		 $day10 = 0;
	 }
	 echo "day10 average: ". $day10 ."</br />";
}
else {
	//echo "There is nothing on the 10th.";
}

// Day 11
$sql11 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 11 ";
$result11 = $dbc->query($sql11);
if ($result11 -> num_rows > 0) {
	
	 $day11num = 0;
	 $day11sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day11num++;
		 $day11sum = $day11sum + $row['avgpain'];
	 }
	 if ($day11num !== 0) {
	 $day11 = $day11sum/$day11num;
	 }
	 else {
		 $day11 = 0;
	 }
	 echo "day11 average: ". $day11 ."</br />";
}
else {
	//echo "There is nothing on the 11th.";
}

// Day 12
$sql12 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 12 ";
$result12 = $dbc->query($sql12);
if ($result12 -> num_rows > 0) {
	
	 $day12num = 0;
	 $day12sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day12num++;
		 $day12sum = $day12sum + $row['avgpain'];
	 }
	 if ($day12num !== 0) {
	 $day12 = $day12sum/$day12num;
	 }
	 else {
		 $day12 = 0;
	 }
	 echo "day12 average: ". $day12 ."</br />";
}
else {
	//echo "There is nothing on the 12th.";
}

// Day 13
$sql13 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 13 ";
$result13 = $dbc->query($sql13);
if ($result13 -> num_rows > 0) {
	
	 $day13num = 0;
	 $day13sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day13num++;
		 $day13sum = $day13sum + $row['avgpain'];
	 }
	 if ($day13num !== 0) {
	 $day13 = $day13sum/$day13num;
	 }
	 else {
		 $day13 = 0;
	 }
	 echo "day13 average: ". $day13 ."</br />";
}
else {
	//echo "There is nothing on the 13th.";
}

// Day 14
$sql14 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 14 ";
$result14 = $dbc->query($sql14);
if ($result14 -> num_rows > 0) {
	
	 $day14num = 0;
	 $day14sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day14num++;
		 $day14sum = $day14sum + $row['avgpain'];
	 }
	 if ($day14num !== 0) {
	 $day14 = $day14sum/$day14num;
	 }
	 else {
		 $day14 = 0;
	 }
	 echo "day14 average: ". $day14 ."</br />";
}
else {
	//echo "There is nothing on the 14th.";
}

// Day 15
$sql15 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 15 ";
$result15 = $dbc->query($sql15);
if ($result15 -> num_rows > 0) {
	
	 $day15num = 0;
	 $day15sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day15num++;
		 $day15sum = $day15sum + $row['avgpain'];
	 }
	 if ($day15num !== 0) {
	 $day15 = $day15sum/$day15num;
	 }
	 else {
		 $day15 = 0;
	 }
	 echo "day15 average: ". $day15 ."</br />";
}
else {
	//echo "There is nothing on the 15th.";
}

// Day 16
$sql16 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 16 ";
$result16 = $dbc->query($sql16);
if ($result16 -> num_rows > 0) {
	
	 $day16num = 0;
	 $day16sum = 0;
     while($row = $result16->fetch_assoc()) {
		 $day16num++;
		 $day16sum = $day16sum + $row['avgpain'];
	 }
	 if ($day16num !== 0) {
	 $day16 = $day16sum/$day16num;
	 }
	 else {
		 $day16 = 0;
	 }
	 echo "day16 daynum: ". $day16num ."<br />";
	 echo "day16 daysum ". $day16sum ."<br />";
	 echo "day16 average: ". $day16 ."<br />";
}
else {
	//echo "There is nothing on the 16th.";
}

// Day 17
$sql17 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 17 ";
$result17 = $dbc->query($sql17);
if ($result17 -> num_rows > 0) {
	
	 $day17num = 0;
	 $day17sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day17num++;
		 $day17sum = $day17sum + $row['avgpain'];
	 }
	 if ($day17num !== 0) {
	 $day17 = $day17sum/$day17num;
	 }
	 else {
		 $day17 = 0;
	 }
	 echo "day17 average: ". $day17 ."</br />";
}
else {
	//echo "There is nothing on the 17th.";
}

// Day 18
$sql18 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 18 ";
$result18 = $dbc->query($sql18);
if ($result18 -> num_rows > 0) {
	
	 $day18num = 0;
	 $day18sum = 0;
     while($row = $result->fetch_assoc()) {
		 $day18num++;
		 $day18sum = $day18sum + $row['avgpain'];
	 }
	 if ($day18num !== 0) {
	 $day18 = $day18sum/$day18num;
	 }
	 else {
		 $day18 = 0;
	 }
	 echo "day18 average: ". $day18 ."</br />";
}
else {
	//echo "There is nothing on the 18th.";
}







} // This closes the monthly overall SQL.

else {
	echo "There is nothing to report for this month yet.";
}
?>

<!-- HIGH CHARTS -->

<?php
/*
sql = "SELECT bodypart, p00, p01, p02, p03, p04, p05, p06, p07, p08, p09, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23 FROM pain WHERE entryyear='$calyear' AND entrymonth='$calmonth' AND entryday=". $_SESSION['day'] ." AND user_id="  . $_SESSION['user_id'];
$result = $dbc->query($sql);

if ($result -> num_rows > 0) {
	$row_cnt = $result->num_rows;
	//echo $row_cnt;
while ($row = mysqli_fetch_array($result)) {
	$bodypart[] = $row['bodypart'];
   	$p00[] = $row['p00'];
	$p01[] = $row['p01'];
	$p02[] = $row['p02'];
	$p03[] = $row['p03'];
	$p04[] = $row['p04'];
	$p05[] = $row['p05'];
	$p06[] = $row['p06'];
	$p07[] = $row['p07'];
	$p08[] = $row['p08'];
	$p09[] = $row['p09'];
	$p10[] = $row['p10'];
	$p11[] = $row['p11'];
	$p12[] = $row['p12'];
	$p13[] = $row['p13'];
	$p14[] = $row['p14'];
	$p15[] = $row['p15'];
	$p16[] = $row['p16'];
	$p17[] = $row['p17'];
	$p18[] = $row['p18'];
	$p19[] = $row['p19'];
	$p20[] = $row['p20'];
	$p21[] = $row['p21'];
	$p22[] = $row['p22'];
	$p23[] = $row['p23'];
   //echo "query works";
}
}
?>
<!--
var chart = new Highcharts.Chart({
      chart: {
         renderTo: 'container'
      },
      series: [{
         data: [<?php echo join($data, ',') ?>],
         pointStart: 0,
         pointInterval
      }]
});
-->

<script>
$(function () { 
    $('#container').highcharts({
        chart: {
            type: 'column'
			//zoomType: 'xy'
        },
        title: {
            text: 'Daily Pain Itensity'
        },
		yAxis: {
            title: {
                text: 'Pain Itensity'
            }
        },
        xAxis: {
            categories: ['0AM', '1AM', '2AM', '3AM', '4AM', '5AM', '6AM', '7AM', '8AM', '9AM', '10AM', '11AM', '12PM', '1PM', '2PM', '3PM', '4PM', '5PM', '6PM', '7PM', '8PM', '9PM', '10PM', '11PM']
        },
		
		plotOptions: {
        
                line: {
            cursor: 'ns-resize'
        }
    },
		
        series: [
		<?php
		$i=0;
		while ($i<$row_cnt-1) {
		//repeat this part until i = (row_cnt-2)
		?>
		{
            name: '<?php echo $bodypart[$i] ?>',
			data: [<?php echo $p00[$i]. ',' .$p01[$i]. ',' .$p02[$i]. ',' .$p03[$i]. ',' .$p04[$i]. ',' .$p05[$i]. ',' .$p06[$i]. ',' .$p07[$i]. ',' .$p08[$i]. ',' .$p09[$i]. ',' .$p10[$i]. ',' .$p11[$i]. ',' .$p12[$i]. ',' .$p13[$i]. ',' .$p14[$i]. ',' .$p15[$i]. ',' .$p16[$i]. ',' .$p17[$i]. ',' .$p18[$i]. ',' .$p19[$i]. ',' .$p20[$i]. ',' .$p21[$i]. ',' .$p22[$i]. ',' .$p23[$i] ?>],
			draggableY: true,
			dragMinY: 0
        },
		<?php
		$i++;
		}
		if ($i == $row_cnt-1) {
		// write this when i = (row_cnt-1)
		?>
		 {
            name: '<?php echo $bodypart[$i] ?>',
			data: [<?php echo $p00[$i]. ',' .$p01[$i]. ',' .$p02[$i]. ',' .$p03[$i]. ',' .$p04[$i]. ',' .$p05[$i]. ',' .$p06[$i]. ',' .$p07[$i]. ',' .$p08[$i]. ',' .$p09[$i]. ',' .$p10[$i]. ',' .$p11[$i]. ',' .$p12[$i]. ',' .$p13[$i]. ',' .$p14[$i]. ',' .$p15[$i]. ',' .$p16[$i]. ',' .$p17[$i]. ',' .$p18[$i]. ',' .$p19[$i]. ',' .$p20[$i]. ',' .$p21[$i]. ',' .$p22[$i]. ',' .$p23[$i] ?>],
			draggableY: true,
			dragMinY: 0
        }
		<?php
		}
		?>
		]
    });
});

</script>*/
?>
</div>
</body>
</html>