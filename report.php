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
<div id='container'>
<script>
$(document).ready(function () {
  $('#pcomp').click(function () {
    if ($(this).is(':checked')) {
        $('#sub-p').css('display','block');
    } else {
       $('#sub-p').css('display','none');
    }
  });
  
  $('#relcomp').click(function () {
    if ($(this).is(':checked')) {
        $('#sub-rel').css('display','block');
    } else {
       $('#sub-rel').css('display','none');
    }
  });
});
</script>
<?php
		$sql = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth;
$result = $dbc->query($sql);
if ($result -> num_rows > 0) {
?>
<form id="reportform" action="report.php" method="post">
<p><input class='checkbox' type='checkbox' id='avgp' name='avgp' /><label for='avgp'>Average Pain Intensity</label></p>
<p><input class='checkbox pcomp' type='checkbox' id='pcomp' name='pcomp' /><label for='pcomp'>Pain Intensity Comparison including</label></p>
<div class="sub-comp" id="sub-p">
<?php
$sql2 = "SELECT bodypart, COUNT(entryid) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " GROUP BY bodypart";
$result2 = $dbc->query($sql2);
if ($result2 -> num_rows > 0) {
	while($row = $result2->fetch_assoc()) {
		$bodypart = $row['bodypart'];
echo "<input class='checkbox' type='checkbox' id='$bodypart' name='bodypart[]' value='$bodypart' checked/><label for='$bodypart'> " . $row['bodypart'] . " (". $row['COUNT(entryid)'] .")</label>";

	}
	}
?>
</div>
<p><input class='checkbox' type='checkbox' id='avgrel' name='avgrel' /><label for='avgrel'>Average Medicine Efficiency</label></p>
<p><input class='checkbox relcomp' type='checkbox' id='relcomp' name='relcomp' /><label for='relcomp'>Medicine Efficiency Comparison including</label></p>
<div class="sub-comp" id="sub-rel">
<?php
$sql2 = "SELECT medicine, COUNT(record_id) FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " GROUP BY medicine";
$result2 = $dbc->query($sql2);
if ($result2 -> num_rows > 0) {
	while($row = $result2->fetch_assoc()) {
		$medicine = $row['medicine'];
echo "<input class='checkbox' type='checkbox' id='$medicine' name='medicine[]' value='$medicine' checked /><label for='$medicine'> " . $row['medicine'] . " (". $row['COUNT(record_id)'] .")</label>";
	}
	}
?>
</div>
<p><input class='checkbox' type='checkbox' id='impent' name='impent' /><label for='relcomp'>Important Entries</label></p>
<p><input type="submit" name="generate" id="generate" value="Generate Report" /></p>
</form>
<?php
}
else {
	echo "There is nothing to report for this month yet.";
}

$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "bcac3dbe9c1d06";
$password = "32d91723";
$dbname = "booksapp";

$dbc = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	// if Average Pain Intensity got ticked
	if (isset($_POST['avgp'])) {


// Day 1
$sql1 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 1 ";
$result1 = $dbc->query($sql1);
if ($result1 -> num_rows > 0) {
	
	 $day1num = 0;
	 $day1sum = 0;
     while($row = $result1->fetch_assoc()) {
		 $day1num++;
		 $day1sum = $day1sum + $row['avgpain'];
	 }
	 $day1 = $day1sum/$day1num;
	 //echo "day1 average: ". $day1 ."<br />";
}
else {
	$day1 = 0;
}

// Day 2
$sql2 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 2 ";
$result2 = $dbc->query($sql2);
if ($result2 -> num_rows > 0) {
	
	 $day2num = 0;
	 $day2sum = 0;
     while($row = $result2->fetch_assoc()) {
		 $day2num++;
		 $day2sum = $day2sum + $row['avgpain'];
	 }
	 $day2 = $day2sum/$day2num;
	 //echo "day2 average: ". $day2 ."<br />";
}
else {
	$day2 = 0;
}

// Day 3
$sql3 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 3 ";
$result3 = $dbc->query($sql3);
if ($result3 -> num_rows > 0) {
	
	 $day3num = 0;
	 $day3sum = 0;
     while($row = $result3->fetch_assoc()) {
		 $day3num++;
		 $day3sum = $day3sum + $row['avgpain'];
	 }
	 $day3 = $day3sum/$day3num;
	 //echo "day3 average: ". $day3 ."<br />";
}
else {
	$day3 = 0;
}

// Day 4
$sql4 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 4 ";
$result4 = $dbc->query($sql4);
if ($result4 -> num_rows > 0) {
	
	 $day4num = 0;
	 $day4sum = 0;
     while($row = $result4->fetch_assoc()) {
		 $day4num++;
		 $day4sum = $day4sum + $row['avgpain'];
	 }
	 $day4 = $day4sum/$day4num;
	 //echo "day4 average: ". $day4 ."<br />";
}
else {
	$day4 = 0;
}

// Day 5
$sql5 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 5 ";
$result5 = $dbc->query($sql5);
if ($result5 -> num_rows > 0) {
	
	 $day5num = 0;
	 $day5sum = 0;
     while($row = $result5->fetch_assoc()) {
		 $day5num++;
		 $day5sum = $day5sum + $row['avgpain'];
	 }
	 $day5 = $day5sum/$day5num;
	 //echo "day5 average: ". $day5 ."<br />";
}
else {
	$day5 = 0;
}

// Day 6
$sql6 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 6 ";
$result6 = $dbc->query($sql6);
if ($result6 -> num_rows > 0) {
	
	 $day6num = 0;
	 $day6sum = 0;
     while($row = $result6->fetch_assoc()) {
		 $day6num++;
		 $day6sum = $day6sum + $row['avgpain'];
	 }
	 $day6 = $day6sum/$day6num;
	 //echo "day6 average: ". $day6 ."<br />";
}
else {
	$day6 = 0;
}

// Day 7
$sql7 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 7 ";
$result7 = $dbc->query($sql7);
if ($result7 -> num_rows > 0) {
	
	 $day7num = 0;
	 $day7sum = 0;
     while($row = $result7->fetch_assoc()) {
		 $day7num++;
		 $day7sum = $day7sum + $row['avgpain'];
	 }
	 $day7 = $day7sum/$day7num;
	 //echo "day7 average: ". $day7 ."<br />";
}
else {
	$day7 = 0;
}

// Day 8
$sql8 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 8 ";
$result8 = $dbc->query($sql8);
if ($result8 -> num_rows > 0) {
	
	 $day8num = 0;
	 $day8sum = 0;
     while($row = $result8->fetch_assoc()) {
		 $day8num++;
		 $day8sum = $day8sum + $row['avgpain'];
	 }
	 $day8 = $day8sum/$day8num;
	 //echo "day8 average: ". $day8 ."<br />";
}
else {
	$day8 = 0;
}


// Day 9
$sql9 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 9 ";
$result9 = $dbc->query($sql9);
if ($result9 -> num_rows > 0) {
	
	 $day9num = 0;
	 $day9sum = 0;
     while($row = $result9->fetch_assoc()) {
		 $day9num++;
		 $day9sum = $day9sum + $row['avgpain'];
	 }
	 $day9 = $day9sum/$day9num;
	 //echo "day9 average: ". $day9 ."<br />";
}
else {
	$day9 = 0;
}

// Day 10
$sql10 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 10 ";
$result10 = $dbc->query($sql10);
if ($result10 -> num_rows > 0) {
	
	 $day10num = 0;
	 $day10sum = 0;
     while($row = $result10->fetch_assoc()) {
		 $day10num++;
		 $day10sum = $day10sum + $row['avgpain'];
	 }
	 $day10 = $day10sum/$day10num;
	 //echo "day10 average: ". $day10 ."<br />";
}
else {
	$day10 = 0;
}

// Day 11
$sql11 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 11 ";
$result11 = $dbc->query($sql11);
if ($result11 -> num_rows > 0) {
	
	 $day11num = 0;
	 $day11sum = 0;
     while($row = $result11->fetch_assoc()) {
		 $day11num++;
		 $day11sum = $day11sum + $row['avgpain'];
	 }
	 $day11 = $day11sum/$day11num;
	 //echo "day11 average: ". $day11 ."<br />";
}
else {
	$day11 = 0;
}

// Day 12
$sql12 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 12 ";
$result12 = $dbc->query($sql12);
if ($result12 -> num_rows > 0) {
	
	 $day12num = 0;
	 $day12sum = 0;
     while($row = $result12->fetch_assoc()) {
		 $day12num++;
		 $day12sum = $day12sum + $row['avgpain'];
	 }
	 $day12 = $day12sum/$day12num;
	 //echo "day12 average: ". $day12 ."<br />";
}
else {
	$day12 = 0;
}

// Day 13
$sql13 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 13 ";
$result13 = $dbc->query($sql13);
if ($result13 -> num_rows > 0) {
	
	 $day13num = 0;
	 $day13sum = 0;
     while($row = $result13->fetch_assoc()) {
		 $day13num++;
		 $day13sum = $day13sum + $row['avgpain'];
	 }
	 $day13 = $day13sum/$day13num;
	 //echo "day13 average: ". $day13 ."<br />";
}
else {
	$day13 = 0;
}

// Day 14
$sql14 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 14 ";
$result14 = $dbc->query($sql14);
if ($result14 -> num_rows > 0) {
	
	 $day14num = 0;
	 $day14sum = 0;
     while($row = $result14->fetch_assoc()) {
		 $day14num++;
		 $day14sum = $day14sum + $row['avgpain'];
	 }
	 $day14 = $day14sum/$day14num;
	 //echo "day14 average: ". $day14 ."<br />";
}
else {
	$day14 = 0;
}

// Day 15
$sql15 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 15 ";
$result15 = $dbc->query($sql15);
if ($result15 -> num_rows > 0) {
	
	 $day15num = 0;
	 $day15sum = 0;
     while($row = $result15->fetch_assoc()) {
		 $day15num++;
		 $day15sum = $day15sum + $row['avgpain'];
	 }
	 $day15 = $day15sum/$day15num;
	 //echo "day15 average: ". $day15 ."<br />";
}
else {
	$day15 = 0;
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
	 $day16 = $day16sum/$day16num;
	 //echo "day16 average: ". $day16 ."<br />";
}
else {
	$day16 = 0;
}

// Day 17
$sql17 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 17 ";
$result17 = $dbc->query($sql17);
if ($result17 -> num_rows > 0) {
	
	 $day17num = 0;
	 $day17sum = 0;
     while($row = $result17->fetch_assoc()) {
		 $day17num++;
		 $day17sum = $day17sum + $row['avgpain'];
	 }
	 $day17 = $day17sum/$day17num;
	 //echo "day17 average: ". $day17 ."<br />";
}
else {
	$day17 = 0;
}

// Day 18
$sql18 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 18 ";
$result18 = $dbc->query($sql18);
if ($result18 -> num_rows > 0) {
	
	 $day18num = 0;
	 $day18sum = 0;
     while($row = $result18->fetch_assoc()) {
		 $day18num++;
		 $day18sum = $day18sum + $row['avgpain'];
	 }
	 $day18 = $day18sum/$day18num;
	 //echo "day18 average: ". $day18 ."<br />";
}
else {
	$day18 = 0;
}

// Day 19
$sql19 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 19 ";
$result19 = $dbc->query($sql19);
if ($result19 -> num_rows > 0) {
	
	 $day19num = 0;
	 $day19sum = 0;
     while($row = $result19->fetch_assoc()) {
		 $day19num++;
		 $day19sum = $day19sum + $row['avgpain'];
	 }
	 $day19 = $day19sum/$day19num;
	 //echo "day19 average: ". $day19 ."<br />";
}
else {
	$day19 = 0;
}

// Day 20
$sql20 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 20 ";
$result20 = $dbc->query($sql20);
if ($result20 -> num_rows > 0) {
	
	 $day20num = 0;
	 $day20sum = 0;
     while($row = $result20->fetch_assoc()) {
		 $day20num++;
		 $day20sum = $day20sum + $row['avgpain'];
	 }
	 $day20 = $day20sum/$day20num;
	 //echo "day20 average: ". $day20 ."<br />";
}
else {
	$day20 = 0;
}

// Day 21
$sql21 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 21 ";
$result21 = $dbc->query($sql21);
if ($result21 -> num_rows > 0) {
	
	 $day21num = 0;
	 $day21sum = 0;
     while($row = $result21->fetch_assoc()) {
		 $day21num++;
		 $day21sum = $day21sum + $row['avgpain'];
	 }
	 $day21 = $day21sum/$day21num;
	 //echo "day21 average: ". $day21 ."<br />";
}
else {
	$day21 = 0;
}

// Day 22
$sql22 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 22 ";
$result22 = $dbc->query($sql22);
if ($result22 -> num_rows > 0) {
	
	 $day22num = 0;
	 $day22sum = 0;
     while($row = $result22->fetch_assoc()) {
		 $day22num++;
		 $day22sum = $day22sum + $row['avgpain'];
	 }
	 $day22 = $day22sum/$day22num;
	 //echo "day22 average: ". $day22 ."<br />";
}
else {
	$day22 = 0;
}

// Day 23
$sql23 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 23 ";
$result23 = $dbc->query($sql23);
if ($result23 -> num_rows > 0) {
	
	 $day23num = 0;
	 $day23sum = 0;
     while($row = $result23->fetch_assoc()) {
		 $day23num++;
		 $day23sum = $day23sum + $row['avgpain'];
	 }
	 $day23 = $day23sum/$day23num;
	 //echo "day23 average: ". $day23 ."<br />";
}
else {
	$day23 = 0;
}

// Day 24
$sql24 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 24 ";
$result24 = $dbc->query($sql24);
if ($result24 -> num_rows > 0) {
	
	 $day24num = 0;
	 $day24sum = 0;
     while($row = $result24->fetch_assoc()) {
		 $day24num++;
		 $day24sum = $day24sum + $row['avgpain'];
	 }
	 $day24 = $day24sum/$day24num;
	 //echo "day24 average: ". $day24 ."<br />";
}
else {
	$day24 = 0;
}

// Day 25
$sql25 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 25 ";
$result25 = $dbc->query($sql25);
if ($result25 -> num_rows > 0) {
	
	 $day25num = 0;
	 $day25sum = 0;
     while($row = $result25->fetch_assoc()) {
		 $day25num++;
		 $day25sum = $day25sum + $row['avgpain'];
	 }
	 $day25 = $day25sum/$day25num;
	 //echo "day25 average: ". $day25 ."<br />";
}
else {
	$day25 = 0;
}

// Day 26
$sql26 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 26 ";
$result26 = $dbc->query($sql26);
if ($result26 -> num_rows > 0) {
	
	 $day26num = 0;
	 $day26sum = 0;
     while($row = $result26->fetch_assoc()) {
		 $day26num++;
		 $day26sum = $day26sum + $row['avgpain'];
	 }
	 $day26 = $day26sum/$day26num;
	 //echo "day26 average: ". $day26 ."<br />";
}
else {
	$day26 = 0;
}

// Day 27
$sql27 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 27 ";
$result27 = $dbc->query($sql27);
if ($result27 -> num_rows > 0) {
	
	 $day27num = 0;
	 $day27sum = 0;
     while($row = $result27->fetch_assoc()) {
		 $day27num++;
		 $day27sum = $day27sum + $row['avgpain'];
	 }
	 $day27 = $day27sum/$day27num;
	 //echo "day27 average: ". $day27 ."<br />";
}
else {
	$day27 = 0;
}

// Day 28
$sql28 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 28 ";
$result28 = $dbc->query($sql28);
if ($result28 -> num_rows > 0) {
	
	 $day28num = 0;
	 $day28sum = 0;
     while($row = $result28->fetch_assoc()) {
		 $day28num++;
		 $day28sum = $day28sum + $row['avgpain'];
	 }
	 $day28 = $day28sum/$day28num;
	 //echo "day28 average: ". $day28 ."<br />";
}
else {
	$day28 = 0;
}

// Day 29
$sql29 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 29 ";
$result29 = $dbc->query($sql29);
if ($result29 -> num_rows > 0) {
	
	 $day29num = 0;
	 $day29sum = 0;
     while($row = $result29->fetch_assoc()) {
		 $day29num++;
		 $day29sum = $day29sum + $row['avgpain'];
	 }
	 $day29 = $day29sum/$day29num;
	 //echo "day29 average: ". $day29 ."<br />";
}
else {
	$day29 = 0;
}

// Day 30
$sql30 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 30 ";
$result30 = $dbc->query($sql30);
if ($result30 -> num_rows > 0) {
	
	 $day30num = 0;
	 $day30sum = 0;
     while($row = $result30->fetch_assoc()) {
		 $day30num++;
		 $day30sum = $day30sum + $row['avgpain'];
	 }
	 $day30 = $day30sum/$day30num;
	 //echo "day30 average: ". $day30 ."<br />";
}
else {
	$day30 = 0;
}

// Day 31
$sql31 = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 31 ";
$result31 = $dbc->query($sql31);
if ($result31 -> num_rows > 0) {
	
	 $day31num = 0;
	 $day31sum = 0;
     while($row = $result31->fetch_assoc()) {
		 $day31num++;
		 $day31sum = $day31sum + $row['avgpain'];
	 }
	 $day31 = $day31sum/$day31num;
	 //echo "day31 average: ". $day31 ."<br />";
}
else {
	$day31 = 0;
}
?>

<div id="container2" class="cont"></div>

<script>
$(function () { 
    $('#container2').highcharts({
        chart: {
            type: 'column'
			//zoomType: 'xy'
        },
        title: {
            text: 'Monthly Pain Intensity'
        },
		yAxis: {
            title: {
                text: 'Average Pain Intensity',
				enabled: false
            }
        },
		
<?php 

// if the month is January, March, May, July, August, October or December
if (($calmonth == 1) OR ($calmonth == 3) OR ($calmonth == 5) OR ($calmonth == 7) OR ($calmonth == 8) OR ($calmonth == 10) OR ($calmonth == 12)) {
?>		
        xAxis: {
            categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31']
        },
<?php
}

// if the month is April, June, September or November
elseif (($calmonth == 4) OR ($calmonth == 6) OR ($calmonth == 9) OR ($calmonth == 11)) {
?>	
        xAxis: {
            categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30']
        },
<?php
}

// if the month is February
else {
	
	// if it is a leap year
	if ($calyear % 4 == 0) {
		?>	
        xAxis: {
            categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29']
        },
<?php
	}
	
	// if it is not a leap year
	else {
		?>	
        xAxis: {
            categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28']
        },
<?php
	}

}
?>	
		plotOptions: {
        
                line: {
            cursor: 'ns-resize'
        }
    },
		
        series: [
		{
			showInLegend: false, 
            name: 'Monthly Pain Intensity',
			
			<?php 

// if the month is January, March, May, July, August, October or December
if (($calmonth == 1) OR ($calmonth == 3) OR ($calmonth == 5) OR ($calmonth == 7) OR ($calmonth == 8) OR ($calmonth == 10) OR ($calmonth == 12)) {
?>		
        data: [<?php echo $day1. ',' .$day2. ',' .$day3. ',' .$day4. ',' .$day5. ',' .$day6. ',' .$day7. ',' .$day8. ',' .$day9. ',' .$day10. ',' .$day11. ',' .$day12. ',' .$day13. ',' .$day14. ',' .$day15. ',' .$day16. ',' .$day17. ',' .$day18. ',' .$day19. ',' .$day20. ',' .$day21. ',' .$day22. ',' .$day23. ',' .$day24. ',' .$day25. ',' .$day26. ',' .$day27. ',' .$day28. ',' .$day29. ',' .$day30. ',' .$day31 ?>],
<?php
}

// if the month is April, June, September or November
elseif (($calmonth == 4) OR ($calmonth == 6) OR ($calmonth == 9) OR ($calmonth == 11)) {
?>	
        data: [<?php echo $day1. ',' .$day2. ',' .$day3. ',' .$day4. ',' .$day5. ',' .$day6. ',' .$day7. ',' .$day8. ',' .$day9. ',' .$day10. ',' .$day11. ',' .$day12. ',' .$day13. ',' .$day14. ',' .$day15. ',' .$day16. ',' .$day17. ',' .$day18. ',' .$day19. ',' .$day20. ',' .$day21. ',' .$day22. ',' .$day23. ',' .$day24. ',' .$day25. ',' .$day26. ',' .$day27. ',' .$day28. ',' .$day29. ',' .$day30 ?>],
<?php
}

// if the month is February
else {
	
	// if it is a leap year
	if ($calyear % 4 == 0) {
		?>	
        data: [<?php echo $day1. ',' .$day2. ',' .$day3. ',' .$day4. ',' .$day5. ',' .$day6. ',' .$day7. ',' .$day8. ',' .$day9. ',' .$day10. ',' .$day11. ',' .$day12. ',' .$day13. ',' .$day14. ',' .$day15. ',' .$day16. ',' .$day17. ',' .$day18. ',' .$day19. ',' .$day20. ',' .$day21. ',' .$day22. ',' .$day23. ',' .$day24. ',' .$day25. ',' .$day26. ',' .$day27. ',' .$day28. ',' .$day29 ?>],
<?php
	}
	
	// if it is not a leap year
	else {
		?>	
        data: [<?php echo $day1. ',' .$day2. ',' .$day3. ',' .$day4. ',' .$day5. ',' .$day6. ',' .$day7. ',' .$day8. ',' .$day9. ',' .$day10. ',' .$day11. ',' .$day12. ',' .$day13. ',' .$day14. ',' .$day15. ',' .$day16. ',' .$day17. ',' .$day18. ',' .$day19. ',' .$day20. ',' .$day21. ',' .$day22. ',' .$day23. ',' .$day24. ',' .$day25. ',' .$day26. ',' .$day27. ',' .$day28 ?>],
<?php
	}

}
?>
			
			draggableY: true,
			dragMinY: 0
        }
		]
    });
});

</script>
<?php
	
	} // close tag for Average Pain Intensity
	
	
	
	// if Pain Intensity Comparison got ticked
	
	if (isset($_POST['pcomp'])) {
		if(!empty($_POST['bodypart'])) {
			$countparts = 0;
    	foreach($_POST['bodypart'] as $check1) {
			//echo $check1 . "<br />";
			$pain[] = $check1;
			$countparts++;
		}
//print_r($pain);

$i = 0;
while ($i < $countparts) {
	//echo $pain[$i];
	
	// Day 1
	$q1 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=1 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r1 = mysqli_query ($dbc, $q1) or trigger_error("Query: $q1\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r1) == 1) { 
	$row = mysqli_fetch_assoc($r1);
	$p1[] = $row['avgpain'];
	}
	else {
	$p1[] = 0;	
	}
	
	// Day 2
	$q2 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=2 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r2 = mysqli_query ($dbc, $q2) or trigger_error("Query: $q2\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r2) == 1) { 
	$row = mysqli_fetch_assoc($r2);
	$p2[] = $row['avgpain'];
	}
	else {
	$p2[] = 0;	
	}
	
	// Day 3
	$q3 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=3 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r3 = mysqli_query ($dbc, $q3) or trigger_error("Query: $q3\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r3) == 1) { 
	$row = mysqli_fetch_assoc($r3);
	$p3[] = $row['avgpain'];
	}
	else {
	$p3[] = 0;	
	}
	
	// Day 4
	$q4 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=4 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r4 = mysqli_query ($dbc, $q4) or trigger_error("Query: $q4\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r4) == 1) { 
	$row = mysqli_fetch_assoc($r4);
	$p4[] = $row['avgpain'];
	}
	else {
	$p4[] = 0;	
	}
	
	// Day 5
	$q5 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=5 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r5 = mysqli_query ($dbc, $q5) or trigger_error("Query: $q5\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r5) == 1) { 
	$row = mysqli_fetch_assoc($r5);
	$p5[] = $row['avgpain'];
	}
	else {
	$p5[] = 0;	
	}
	
	// Day 6
	$q6 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=6 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r6 = mysqli_query ($dbc, $q6) or trigger_error("Query: $q6\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r6) == 1) { 
	$row = mysqli_fetch_assoc($r6);
	$p6[] = $row['avgpain'];
	}
	else {
	$p6[] = 0;	
	}
	
	// Day 7
	$q7 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=7 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r7 = mysqli_query ($dbc, $q7) or trigger_error("Query: $q7\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r7) == 1) { 
	$row = mysqli_fetch_assoc($r7);
	$p7[] = $row['avgpain'];
	}
	else {
	$p7[] = 0;	
	}
	
	// Day 8
	$q8 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=8 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r8 = mysqli_query ($dbc, $q8) or trigger_error("Query: $q8\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r8) == 1) { 
	$row = mysqli_fetch_assoc($r8);
	$p8[] = $row['avgpain'];
	}
	else {
	$p8[] = 0;	
	}
	
	// Day 9
	$q9 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=9 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r9 = mysqli_query ($dbc, $q9) or trigger_error("Query: $q9\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r9) == 1) { 
	$row = mysqli_fetch_assoc($r9);
	$p9[] = $row['avgpain'];
	}
	else {
	$p9[] = 0;	
	}
	
	// Day 10
	$q10 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=10 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r10 = mysqli_query ($dbc, $q10) or trigger_error("Query: $q10\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r10) == 1) { 
	$row = mysqli_fetch_assoc($r10);
	$p10[] = $row['avgpain'];
	}
	else {
	$p10[] = 0;	
	}
	
	// Day 11
	$q11 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=11 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r11 = mysqli_query ($dbc, $q11) or trigger_error("Query: $q11\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r11) == 1) { 
	$row = mysqli_fetch_assoc($r11);
	$p11[] = $row['avgpain'];
	}
	else {
	$p11[] = 0;	
	}
	
	// Day 12
	$q12 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=12 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r12 = mysqli_query ($dbc, $q12) or trigger_error("Query: $q12\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r12) == 1) { 
	$row = mysqli_fetch_assoc($r12);
	$p12[] = $row['avgpain'];
	}
	else {
	$p12[] = 0;	
	}
	
	// Day 13
	$q13 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=13 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r13 = mysqli_query ($dbc, $q13) or trigger_error("Query: $q13\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r13) == 1) { 
	$row = mysqli_fetch_assoc($r13);
	$p13[] = $row['avgpain'];
	}
	else {
	$p13[] = 0;	
	}
	
	// Day 14
	$q14 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=14 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r14 = mysqli_query ($dbc, $q14) or trigger_error("Query: $q14\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r14) == 1) { 
	$row = mysqli_fetch_assoc($r14);
	$p14[] = $row['avgpain'];
	}
	else {
	$p14[] = 0;	
	}
	
	// Day 15
	$q15 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=15 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r15 = mysqli_query ($dbc, $q15) or trigger_error("Query: $q15\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r15) == 1) { 
	$row = mysqli_fetch_assoc($r15);
	$p15[] = $row['avgpain'];
	}
	else {
	$p15[] = 0;	
	}
	
	// Day 16
	$q16 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=16 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r16 = mysqli_query ($dbc, $q16) or trigger_error("Query: $q16\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r16) == 1) { 
	$row = mysqli_fetch_assoc($r16);
	$p16[] = $row['avgpain'];
	}
	else {
	$p16[] = 0;	
	}
	
	// Day 17
	$q17 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=17 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r17 = mysqli_query ($dbc, $q17) or trigger_error("Query: $q17\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r17) == 1) { 
	$row = mysqli_fetch_assoc($r17);
	$p17[] = $row['avgpain'];
	}
	else {
	$p17[] = 0;	
	}
	
	// Day 18
	$q18 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=18 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r18 = mysqli_query ($dbc, $q18) or trigger_error("Query: $q18\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r18) == 1) { 
	$row = mysqli_fetch_assoc($r18);
	$p18[] = $row['avgpain'];
	}
	else {
	$p18[] = 0;	
	}
	
	// Day 19
	$q19 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=19 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r19 = mysqli_query ($dbc, $q19) or trigger_error("Query: $q19\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r19) == 1) { 
	$row = mysqli_fetch_assoc($r19);
	$p19[] = $row['avgpain'];
	}
	else {
	$p19[] = 0;	
	}
	
	// Day 20
	$q20 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=20 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r20 = mysqli_query ($dbc, $q20) or trigger_error("Query: $q20\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r20) == 1) { 
	$row = mysqli_fetch_assoc($r20);
	$p20[] = $row['avgpain'];
	}
	else {
	$p20[] = 0;	
	}
	
	// Day 21
	$q21 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=21 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r21 = mysqli_query ($dbc, $q21) or trigger_error("Query: $q21\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r21) == 1) { 
	$row = mysqli_fetch_assoc($r21);
	$p21[] = $row['avgpain'];
	}
	else {
	$p21[] = 0;	
	}
	
	// Day 22
	$q22 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=22 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r22 = mysqli_query ($dbc, $q22) or trigger_error("Query: $q22\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r22) == 1) { 
	$row = mysqli_fetch_assoc($r22);
	$p22[] = $row['avgpain'];
	}
	else {
	$p22[] = 0;	
	}
	
	// Day 23
	$q23 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=23 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r23 = mysqli_query ($dbc, $q23) or trigger_error("Query: $q23\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r23) == 1) { 
	$row = mysqli_fetch_assoc($r23);
	$p23[] = $row['avgpain'];
	}
	else {
	$p23[] = 0;	
	}
	
	// Day 24
	$q24 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=24 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r24 = mysqli_query ($dbc, $q24) or trigger_error("Query: $q24\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r24) == 1) { 
	$row = mysqli_fetch_assoc($r24);
	$p24[] = $row['avgpain'];
	}
	else {
	$p24[] = 0;	
	}
	
	// Day 25
	$q25 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=25 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r25 = mysqli_query ($dbc, $q25) or trigger_error("Query: $q25\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r25) == 1) { 
	$row = mysqli_fetch_assoc($r25);
	$p25[] = $row['avgpain'];
	}
	else {
	$p25[] = 0;	
	}
	
	// Day 26
	$q26 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=26 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r26 = mysqli_query ($dbc, $q26) or trigger_error("Query: $q26\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r26) == 1) { 
	$row = mysqli_fetch_assoc($r26);
	$p26[] = $row['avgpain'];
	}
	else {
	$p26[] = 0;	
	}
	
	// Day 27
	$q27 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=27 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r27 = mysqli_query ($dbc, $q27) or trigger_error("Query: $q27\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r27) == 1) { 
	$row = mysqli_fetch_assoc($r27);
	$p27[] = $row['avgpain'];
	}
	else {
	$p27[] = 0;	
	}
	
	// Day 28
	$q28 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=28 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r28 = mysqli_query ($dbc, $q28) or trigger_error("Query: $q28\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r28) == 1) { 
	$row = mysqli_fetch_assoc($r28);
	$p28[] = $row['avgpain'];
	}
	else {
	$p28[] = 0;	
	}
	
	// Day 29
	$q29 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=29 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r29 = mysqli_query ($dbc, $q29) or trigger_error("Query: $q29\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r29) == 1) { 
	$row = mysqli_fetch_assoc($r29);
	$p29[] = $row['avgpain'];
	}
	else {
	$p29[] = 0;	
	}
	
	// Day 30
	$q30 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=30 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r30 = mysqli_query ($dbc, $q30) or trigger_error("Query: $q30\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r30) == 1) { 
	$row = mysqli_fetch_assoc($r30);
	$p30[] = $row['avgpain'];
	}
	else {
	$p30[] = 0;	
	}
	
	// Day 31
	$q31 = "SELECT avgpain FROM pain WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=31 AND bodypart='". $pain[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$r31 = mysqli_query ($dbc, $q31) or trigger_error("Query: $q31\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r31) == 1) { 
	$row = mysqli_fetch_assoc($r31);
	$p31[] = $row['avgpain'];
	}
	else {
	$p31[] = 0;	
	}
	
	$i++;
}

?>
<div id="container3" class="cont"></div>
<script>
$(function () { 
    $('#container3').highcharts({
        chart: {
            type: 'column'
			//zoomType: 'xy'
        },
        title: {
            text: 'Pain Intensity Comparison (1)'
        },
		yAxis: {
            title: {
                text: 'Pain Intensity'
            }
        },
        xAxis: {
            categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']
        },
		
		plotOptions: {
        
                line: {
            cursor: 'ns-resize'
        }
    },
		
        series: [
		<?php
		$j=0;
		while ($j<$countparts-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p1[$j]. ',' .$p2[$j]. ',' .$p3[$j]. ',' .$p4[$j]. ',' .$p5[$j]. ',' .$p6[$j]. ',' .$p7[$j]. ',' .$p8[$j]. ',' .$p9[$j]. ',' .$p10[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countparts-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p1[$j]. ',' .$p2[$j]. ',' .$p3[$j]. ',' .$p4[$j]. ',' .$p5[$j]. ',' .$p6[$j]. ',' .$p7[$j]. ',' .$p8[$j]. ',' .$p9[$j]. ',' .$p10[$j] ?>]
        }
		<?php
		}
		?>
		]
    });
});

</script>

<div id="container4" class="cont"></div>
<script>
$(function () { 
    $('#container4').highcharts({
        chart: {
            type: 'column'
			//zoomType: 'xy'
        },
        title: {
            text: 'Pain Intensity Comparison (2)'
        },
		yAxis: {
            title: {
                text: 'Pain Intensity'
            }
        },
        xAxis: {
            categories: ['11', '12', '13', '14', '15', '16', '17', '18', '19', '20']
        },
		
		plotOptions: {
        
                line: {
            cursor: 'ns-resize'
        }
    },
		
        series: [
		<?php
		$j=0;
		while ($j<$countparts-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p11[$j]. ',' .$p12[$j]. ',' .$p13[$j]. ',' .$p14[$j]. ',' .$p15[$j]. ',' .$p16[$j]. ',' .$p17[$j]. ',' .$p18[$j]. ',' .$p19[$j]. ',' .$p20[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countparts-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p11[$j]. ',' .$p12[$j]. ',' .$p13[$j]. ',' .$p14[$j]. ',' .$p15[$j]. ',' .$p16[$j]. ',' .$p17[$j]. ',' .$p18[$j]. ',' .$p19[$j]. ',' .$p20[$j] ?>]
        }
		<?php
		}
		?>
		]
    });
});

</script>
<?php


		} // close tag for if not empty
	} // close tag for Pain Intensity Comparison
	
	
	
	// if Average Medicine Efficiency got ticked
	if (isset($_POST['avgrel'])) {
		echo "average medicine efficiency<br />";
	} // close tag for Average Medicine Efficiency
	
	
	//if Medicine Efficiency Comparison got ticked
	if (isset($_POST['relcomp'])) {
		if(!empty($_POST['medicine'])) {
    	foreach($_POST['medicine'] as $check2) {
            echo $check2;
			}
		}
	} // close tag for Medicine Efficiency Comparison
		
		
	// if Important Entries got ticked
	if (isset($_POST['impent'])) {
		echo "important entries<br />";
	} // closing tag for Important Entries
	
} // closing request method post



?>

</div>
</div>
</body>
</html>