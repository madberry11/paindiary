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
	<link rel="stylesheet" href="style.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="colour1.css" type="text/css" id="colour1" media="screen, projection" />
    <link rel="stylesheet" href="colour2.css" type="text/css" id="colour2" media="screen, projection" />
    <link rel="stylesheet" href="colour3.css" type="text/css" id="colour3" media="screen, projection" />
    <link rel="stylesheet" href="jquery.mobile/jquery.mobile-1.4.5.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="print.css" type="text/css" media="print" /> 

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
<div id="pagecontent">
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
<p><input class='checkbox' type='checkbox' id='avgrel' name='avgrel' /><label id="avgrellabel" for='avgrel'>Average Medicine Efficiency</label></p>
<p><input class='checkbox relcomp' type='checkbox' id='relcomp' name='relcomp' /><label id="relcomplabel" for='relcomp'>Medicine Efficiency Comparison including</label></p>
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
<p><input class='checkbox' type='checkbox' id='impent' name='impent' /><label id='impentlabel' for='relcomp'>Important Entries</label></p>
<p><input type="submit" name="generate" id="generate" value="Generate Report" /></p>
</form>
<?php
}
else {
	echo "There is nothing to report for this month yet.";
}
$sql3 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth;
$result3 = $dbc->query($sql3);
if ($result2 -> num_rows == 0) {
	?>
    <script>
$(document).ready(function () {
       $('#avgrel').css('display','none');
	   $('#avgrellabel').css('display','none');
	   $('#relcomp').css('display','none');
	   $('#relcomplabel').css('display','none');
  });
  </script>
    <?php
}

$sql4 = "SELECT * FROM important WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth;
$result4 = $dbc->query($sql4);
if ($result4 -> num_rows == 0) {
	?>
    <script>
$(document).ready(function () {
       $('#impent').css('display','none');
	   $('#impentlabel').css('display','none');
  });
  </script>
    <?php
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
<fieldset>
<legend>Average Pain Intensity</legend>
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
</fieldset>
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
<fieldset>
<legend>Pain Intensity Comparison</legend>
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

<div id="container5" class="cont"></div>
<script>
$(function () { 
    $('#container5').highcharts({
        chart: {
            type: 'column'
			//zoomType: 'xy'
        },
        title: {
            text: 'Pain Intensity Comparison (3)'
        },
		yAxis: {
            title: {
                text: 'Pain Intensity'
            }
        },
		<?php 

// if the month is January, March, May, July, August, October or December
if (($calmonth == 1) OR ($calmonth == 3) OR ($calmonth == 5) OR ($calmonth == 7) OR ($calmonth == 8) OR ($calmonth == 10) OR ($calmonth == 12)) {
?>		
        xAxis: {
            categories: ['21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31']
        },
<?php
}

// if the month is April, June, September or November
elseif (($calmonth == 4) OR ($calmonth == 6) OR ($calmonth == 9) OR ($calmonth == 11)) {
?>	
        xAxis: {
            categories: ['21', '22', '23', '24', '25', '26', '27', '28', '29', '30']
        },
<?php
}

// if the month is February
else {
	
	// if it is a leap year
	if ($calyear % 4 == 0) {
		?>	
        xAxis: {
            categories: ['21', '22', '23', '24', '25', '26', '27', '28', '29']
        },
<?php
	}
	
	// if it is not a leap year
	else {
		?>	
        xAxis: {
            categories: ['21', '22', '23', '24', '25', '26', '27', '28']
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
	<?php 

// if the month is January, March, May, July, August, October or December
if (($calmonth == 1) OR ($calmonth == 3) OR ($calmonth == 5) OR ($calmonth == 7) OR ($calmonth == 8) OR ($calmonth == 10) OR ($calmonth == 12)) {
?>		
                series: [
		<?php
		$j=0;
		while ($j<$countparts-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p21[$j]. ',' .$p22[$j]. ',' .$p23[$j]. ',' .$p24[$j]. ',' .$p25[$j]. ',' .$p26[$j]. ',' .$p27[$j]. ',' .$p28[$j]. ',' .$p29[$j]. ',' .$p30[$j]. ',' .$p31[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countparts-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p21[$j]. ',' .$p22[$j]. ',' .$p23[$j]. ',' .$p24[$j]. ',' .$p25[$j]. ',' .$p26[$j]. ',' .$p27[$j]. ',' .$p28[$j]. ',' .$p29[$j]. ',' .$p30[$j]. ',' .$p31[$j] ?>]
        }
		<?php
		}
		?>
		]
<?php
}

// if the month is April, June, September or November
elseif (($calmonth == 4) OR ($calmonth == 6) OR ($calmonth == 9) OR ($calmonth == 11)) {
?>	
                series: [
		<?php
		$j=0;
		while ($j<$countparts-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p21[$j]. ',' .$p22[$j]. ',' .$p23[$j]. ',' .$p24[$j]. ',' .$p25[$j]. ',' .$p26[$j]. ',' .$p27[$j]. ',' .$p28[$j]. ',' .$p29[$j]. ',' .$p30[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countparts-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p21[$j]. ',' .$p22[$j]. ',' .$p23[$j]. ',' .$p24[$j]. ',' .$p25[$j]. ',' .$p26[$j]. ',' .$p27[$j]. ',' .$p28[$j]. ',' .$p29[$j]. ',' .$p30[$j] ?>]
        }
		<?php
		}
		?>
		]
<?php
}

// if the month is February
else {
	
	// if it is a leap year
	if ($calyear % 4 == 0) {
		?>	
                series: [
		<?php
		$j=0;
		while ($j<$countparts-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p21[$j]. ',' .$p22[$j]. ',' .$p23[$j]. ',' .$p24[$j]. ',' .$p25[$j]. ',' .$p26[$j]. ',' .$p27[$j]. ',' .$p28[$j]. ',' .$p29[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countparts-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p21[$j]. ',' .$p22[$j]. ',' .$p23[$j]. ',' .$p24[$j]. ',' .$p25[$j]. ',' .$p26[$j]. ',' .$p27[$j]. ',' .$p28[$j]. ',' .$p29[$j] ?>]
        }
		<?php
		}
		?>
		]
<?php
	}
	
	// if it is not a leap year
	else {
		?>	
                series: [
		<?php
		$j=0;
		while ($j<$countparts-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p21[$j]. ',' .$p22[$j]. ',' .$p23[$j]. ',' .$p24[$j]. ',' .$p25[$j]. ',' .$p26[$j]. ',' .$p27[$j]. ',' .$p28[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countparts-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $pain[$j] ?>',
			data: [<?php echo $p21[$j]. ',' .$p22[$j]. ',' .$p23[$j]. ',' .$p24[$j]. ',' .$p25[$j]. ',' .$p26[$j]. ',' .$p27[$j]. ',' .$p28[$j] ?>]
        }
		<?php
		}
		?>
		]
<?php
	}

}
?>	
    });
});

</script>
</fieldset>
<?php


		} // close tag for if not empty
	} // close tag for Pain Intensity Comparison
	
	
	
	// if Average Medicine Efficiency got ticked
	if (isset($_POST['avgrel'])) {
	
	// Day 1
	$qq1 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 1 ";
	$rr1 = $dbc->query($qq1);
	if ($rr1 -> num_rows > 0) {
	
	 $d1num = 0;
	 $d1sum = 0;
     while($row = $rr1->fetch_assoc()) {
		 $d1num++;
		 $d1sum = $d1sum + $row['reliefrating'];
	 }
	 	$d1 = $d1sum/$d1num;
	}
	else {
		$d1 = 0;
	}
	
	// Day 2
	$qq2 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 2 ";
	$rr2 = $dbc->query($qq2);
	if ($rr2 -> num_rows > 0) {
	
	 $d2num = 0;
	 $d2sum = 0;
     while($row = $rr2->fetch_assoc()) {
		 $d2num++;
		 $d2sum = $d2sum + $row['reliefrating'];
	 }
	 	$d2 = $d2sum/$d2num;
	}
	else {
		$d2 = 0;
	}
	
	// Day 3
	$qq3 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 3 ";
	$rr3 = $dbc->query($qq3);
	if ($rr3 -> num_rows > 0) {
	
	 $d3num = 0;
	 $d3sum = 0;
     while($row = $rr3->fetch_assoc()) {
		 $d3num++;
		 $d3sum = $d3sum + $row['reliefrating'];
	 }
	 	$d3 = $d3sum/$d3num;
	}
	else {
		$d3 = 0;
	}
	
	// Day 4
	$qq4 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 4 ";
	$rr4 = $dbc->query($qq4);
	if ($rr4 -> num_rows > 0) {
	
	 $d4num = 0;
	 $d4sum = 0;
     while($row = $rr4->fetch_assoc()) {
		 $d4num++;
		 $d4sum = $d4sum + $row['reliefrating'];
	 }
	 	$d4 = $d4sum/$d4num;
	}
	else {
		$d4 = 0;
	}
	
	// Day 5
	$qq5 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 5 ";
	$rr5 = $dbc->query($qq5);
	if ($rr5 -> num_rows > 0) {
	
	 $d5num = 0;
	 $d5sum = 0;
     while($row = $rr5->fetch_assoc()) {
		 $d5num++;
		 $d5sum = $d5sum + $row['reliefrating'];
	 }
	 	$d5 = $d5sum/$d5num;
	}
	else {
		$d5 = 0;
	}
	
	// Day 6
	$qq6 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 6 ";
	$rr6 = $dbc->query($qq6);
	if ($rr6 -> num_rows > 0) {
	
	 $d6num = 0;
	 $d6sum = 0;
     while($row = $rr6->fetch_assoc()) {
		 $d6num++;
		 $d6sum = $d6sum + $row['reliefrating'];
	 }
	 	$d6 = $d6sum/$d6num;
	}
	else {
		$d6 = 0;
	}
	
	// Day 7
	$qq7 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 7 ";
	$rr7 = $dbc->query($qq7);
	if ($rr7 -> num_rows > 0) {
	
	 $d7num = 0;
	 $d7sum = 0;
     while($row = $rr7->fetch_assoc()) {
		 $d7num++;
		 $d7sum = $d7sum + $row['reliefrating'];
	 }
	 	$d7 = $d7sum/$d7num;
	}
	else {
		$d7 = 0;
	}
	
	// Day 8
	$qq8 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 8 ";
	$rr8 = $dbc->query($qq8);
	if ($rr8 -> num_rows > 0) {
	
	 $d8num = 0;
	 $d8sum = 0;
     while($row = $rr8->fetch_assoc()) {
		 $d8num++;
		 $d8sum = $d8sum + $row['reliefrating'];
	 }
	 	$d8 = $d8sum/$d8num;
	}
	else {
		$d8 = 0;
	}
	
	// Day 9
	$qq9 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 9 ";
	$rr9 = $dbc->query($qq9);
	if ($rr9 -> num_rows > 0) {
	
	 $d9num = 0;
	 $d9sum = 0;
     while($row = $rr9->fetch_assoc()) {
		 $d9num++;
		 $d9sum = $d9sum + $row['reliefrating'];
	 }
	 	$d9 = $d9sum/$d9num;
	}
	else {
		$d9 = 0;
	}
	
	// Day 10
	$qq10 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 10 ";
	$rr10 = $dbc->query($qq10);
	if ($rr10 -> num_rows > 0) {
	
	 $d10num = 0;
	 $d10sum = 0;
     while($row = $rr10->fetch_assoc()) {
		 $d10num++;
		 $d10sum = $d10sum + $row['reliefrating'];
	 }
	 	$d10 = $d10sum/$d10num;
	}
	else {
		$d10 = 0;
	}
	
	// Day 11
	$qq11 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 11 ";
	$rr11 = $dbc->query($qq11);
	if ($rr11 -> num_rows > 0) {
	
	 $d11num = 0;
	 $d11sum = 0;
     while($row = $rr11->fetch_assoc()) {
		 $d11num++;
		 $d11sum = $d11sum + $row['reliefrating'];
	 }
	 	$d11 = $d11sum/$d11num;
	}
	else {
		$d11 = 0;
	}
	
	// Day 12
	$qq12 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 12 ";
	$rr12 = $dbc->query($qq12);
	if ($rr12 -> num_rows > 0) {
	
	 $d12num = 0;
	 $d12sum = 0;
     while($row = $rr12->fetch_assoc()) {
		 $d12num++;
		 $d12sum = $d12sum + $row['reliefrating'];
	 }
	 	$d12 = $d12sum/$d12num;
	}
	else {
		$d12 = 0;
	}
	
	// Day 13
	$qq13 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 13 ";
	$rr13 = $dbc->query($qq13);
	if ($rr13 -> num_rows > 0) {
	
	 $d13num = 0;
	 $d13sum = 0;
     while($row = $rr13->fetch_assoc()) {
		 $d13num++;
		 $d13sum = $d13sum + $row['reliefrating'];
	 }
	 	$d13 = $d13sum/$d13num;
	}
	else {
		$d13 = 0;
	}
	
	// Day 14
	$qq14 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 14 ";
	$rr14 = $dbc->query($qq14);
	if ($rr14 -> num_rows > 0) {
	
	 $d14num = 0;
	 $d14sum = 0;
     while($row = $rr14->fetch_assoc()) {
		 $d14num++;
		 $d14sum = $d14sum + $row['reliefrating'];
	 }
	 	$d14 = $d14sum/$d14num;
	}
	else {
		$d14 = 0;
	}
	
	// Day 15
	$qq15 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 15 ";
	$rr15 = $dbc->query($qq15);
	if ($rr15 -> num_rows > 0) {
	
	 $d15num = 0;
	 $d15sum = 0;
     while($row = $rr15->fetch_assoc()) {
		 $d15num++;
		 $d15sum = $d15sum + $row['reliefrating'];
	 }
	 	$d15 = $d15sum/$d15num;
	}
	else {
		$d15 = 0;
	}
	
	// Day 16
	$qq16 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 16 ";
	$rr16 = $dbc->query($qq16);
	if ($rr16 -> num_rows > 0) {
	
	 $d16num = 0;
	 $d16sum = 0;
     while($row = $rr16->fetch_assoc()) {
		 $d16num++;
		 $d16sum = $d16sum + $row['reliefrating'];
	 }
	 	$d16 = $d16sum/$d16num;
	}
	else {
		$d16 = 0;
	}
	
	// Day 17
	$qq17 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 17 ";
	$rr17 = $dbc->query($qq17);
	if ($rr17 -> num_rows > 0) {
	
	 $d17num = 0;
	 $d17sum = 0;
     while($row = $rr17->fetch_assoc()) {
		 $d17num++;
		 $d17sum = $d17sum + $row['reliefrating'];
	 }
	 	$d17 = $d17sum/$d17num;
	}
	else {
		$d17 = 0;
	}
	
	// Day 18
	$qq18 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 18 ";
	$rr18 = $dbc->query($qq18);
	if ($rr18 -> num_rows > 0) {
	
	 $d18num = 0;
	 $d18sum = 0;
     while($row = $rr18->fetch_assoc()) {
		 $d18num++;
		 $d18sum = $d18sum + $row['reliefrating'];
	 }
	 	$d18 = $d18sum/$d18num;
	}
	else {
		$d18 = 0;
	}
	
	// Day 19
	$qq19 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 19 ";
	$rr19 = $dbc->query($qq19);
	if ($rr19 -> num_rows > 0) {
	
	 $d19num = 0;
	 $d19sum = 0;
     while($row = $rr19->fetch_assoc()) {
		 $d19num++;
		 $d19sum = $d19sum + $row['reliefrating'];
	 }
	 	$d19 = $d19sum/$d19num;
	}
	else {
		$d19 = 0;
	}
	
	// Day 20
	$qq20 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 20 ";
	$rr20 = $dbc->query($qq20);
	if ($rr20 -> num_rows > 0) {
	
	 $d20num = 0;
	 $d20sum = 0;
     while($row = $rr20->fetch_assoc()) {
		 $d20num++;
		 $d20sum = $d20sum + $row['reliefrating'];
	 }
	 	$d20 = $d20sum/$d20num;
	}
	else {
		$d20 = 0;
	}
	
	// Day 21
	$qq21 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 21 ";
	$rr21 = $dbc->query($qq21);
	if ($rr21 -> num_rows > 0) {
	
	 $d21num = 0;
	 $d21sum = 0;
     while($row = $rr21->fetch_assoc()) {
		 $d21num++;
		 $d21sum = $d21sum + $row['reliefrating'];
	 }
	 	$d21 = $d21sum/$d21num;
	}
	else {
		$d21 = 0;
	}
	
	// Day 22
	$qq22 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 22 ";
	$rr22 = $dbc->query($qq22);
	if ($rr22 -> num_rows > 0) {
	
	 $d22num = 0;
	 $d22sum = 0;
     while($row = $rr22->fetch_assoc()) {
		 $d22num++;
		 $d22sum = $d22sum + $row['reliefrating'];
	 }
	 	$d22 = $d22sum/$d22num;
	}
	else {
		$d22 = 0;
	}
	
	// Day 23
	$qq23 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 23 ";
	$rr23 = $dbc->query($qq23);
	if ($rr23 -> num_rows > 0) {
	
	 $d23num = 0;
	 $d23sum = 0;
     while($row = $rr23->fetch_assoc()) {
		 $d23num++;
		 $d23sum = $d23sum + $row['reliefrating'];
	 }
	 	$d23 = $d23sum/$d23num;
	}
	else {
		$d23 = 0;
	}
	
	// Day 24
	$qq24 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 24 ";
	$rr24 = $dbc->query($qq24);
	if ($rr24 -> num_rows > 0) {
	
	 $d24num = 0;
	 $d24sum = 0;
     while($row = $rr24->fetch_assoc()) {
		 $d24num++;
		 $d24sum = $d24sum + $row['reliefrating'];
	 }
	 	$d24 = $d24sum/$d24num;
	}
	else {
		$d24 = 0;
	}
	
	// Day 25
	$qq25 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 25 ";
	$rr25 = $dbc->query($qq25);
	if ($rr25 -> num_rows > 0) {
	
	 $d25num = 0;
	 $d25sum = 0;
     while($row = $rr25->fetch_assoc()) {
		 $d25num++;
		 $d25sum = $d25sum + $row['reliefrating'];
	 }
	 	$d25 = $d25sum/$d25num;
	}
	else {
		$d25 = 0;
	}
	
	// Day 26
	$qq26 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 26 ";
	$rr26 = $dbc->query($qq26);
	if ($rr26 -> num_rows > 0) {
	
	 $d26num = 0;
	 $d26sum = 0;
     while($row = $rr26->fetch_assoc()) {
		 $d26num++;
		 $d26sum = $d26sum + $row['reliefrating'];
	 }
	 	$d26 = $d26sum/$d26num;
	}
	else {
		$d26 = 0;
	}
	
	// Day 27
	$qq27 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 27 ";
	$rr27 = $dbc->query($qq27);
	if ($rr27 -> num_rows > 0) {
	
	 $d27num = 0;
	 $d27sum = 0;
     while($row = $rr27->fetch_assoc()) {
		 $d27num++;
		 $d27sum = $d27sum + $row['reliefrating'];
	 }
	 	$d27 = $d27sum/$d27num;
	}
	else {
		$d27 = 0;
	}
	
	// Day 28
	$qq28 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 28 ";
	$rr28 = $dbc->query($qq28);
	if ($rr28 -> num_rows > 0) {
	
	 $d28num = 0;
	 $d28sum = 0;
     while($row = $rr28->fetch_assoc()) {
		 $d28num++;
		 $d28sum = $d28sum + $row['reliefrating'];
	 }
	 	$d28 = $d28sum/$d28num;
	}
	else {
		$d28 = 0;
	}
	
	// Day 29
	$qq29 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 29 ";
	$rr29 = $dbc->query($qq29);
	if ($rr29 -> num_rows > 0) {
	
	 $d29num = 0;
	 $d29sum = 0;
     while($row = $rr29->fetch_assoc()) {
		 $d29num++;
		 $d29sum = $d29sum + $row['reliefrating'];
	 }
	 	$d29 = $d29sum/$d29num;
	}
	else {
		$d29 = 0;
	}
	
	// Day 30
	$qq30 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 30 ";
	$rr30 = $dbc->query($qq30);
	if ($rr30 -> num_rows > 0) {
	
	 $d30num = 0;
	 $d30sum = 0;
     while($row = $rr30->fetch_assoc()) {
		 $d30num++;
		 $d30sum = $d30sum + $row['reliefrating'];
	 }
	 	$d30 = $d30sum/$d30num;
	}
	else {
		$d30 = 0;
	}
	
	// Day 31
	$qq31 = "SELECT * FROM painrelief WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 31 ";
	$rr31 = $dbc->query($qq31);
	if ($rr31 -> num_rows > 0) {
	
	 $d31num = 0;
	 $d31sum = 0;
     while($row = $rr31->fetch_assoc()) {
		 $d31num++;
		 $d31sum = $d31sum + $row['reliefrating'];
	 }
	 	$d31 = $d31sum/$d31num;
	}
	else {
		$d31 = 0;
	}
	
	
	?>
<fieldset>
<legend>Average Medicine Efficiency</legend>
	<div id="container6" class="cont"></div>

<script>
$(function () { 
    $('#container6').highcharts({
        chart: {
            type: 'column'
			//zoomType: 'xy'
        },
        title: {
            text: 'Monthly Medicine Efficiency'
        },
		yAxis: {
            title: {
                text: 'Pain Relief Rate',
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
        data: [<?php echo $d1. ',' .$d2. ',' .$d3. ',' .$d4. ',' .$d5. ',' .$d6. ',' .$d7. ',' .$d8. ',' .$d9. ',' .$d10. ',' .$d11. ',' .$d12. ',' .$d13. ',' .$d14. ',' .$d15. ',' .$d16. ',' .$d17. ',' .$d18. ',' .$d19. ',' .$d20. ',' .$d21. ',' .$d22. ',' .$d23. ',' .$d24. ',' .$d25. ',' .$d26. ',' .$d27. ',' .$d28. ',' .$d29. ',' .$d30. ',' .$d31 ?>],
<?php
}

// if the month is April, June, September or November
elseif (($calmonth == 4) OR ($calmonth == 6) OR ($calmonth == 9) OR ($calmonth == 11)) {
?>	
        data: [<?php echo $d1. ',' .$d2. ',' .$d3. ',' .$d4. ',' .$d5. ',' .$d6. ',' .$d7. ',' .$d8. ',' .$d9. ',' .$d10. ',' .$d11. ',' .$d12. ',' .$d13. ',' .$d14. ',' .$d15. ',' .$d16. ',' .$d17. ',' .$d18. ',' .$d19. ',' .$d20. ',' .$d21. ',' .$d22. ',' .$d23. ',' .$d24. ',' .$d25. ',' .$d26. ',' .$d27. ',' .$d28. ',' .$d29. ',' .$d30 ?>],
<?php
}

// if the month is February
else {
	
	// if it is a leap year
	if ($calyear % 4 == 0) {
		?>	
        data: [<?php echo $d1. ',' .$d2. ',' .$d3. ',' .$d4. ',' .$d5. ',' .$d6. ',' .$d7. ',' .$d8. ',' .$d9. ',' .$d10. ',' .$d11. ',' .$d12. ',' .$d13. ',' .$d14. ',' .$d15. ',' .$d16. ',' .$d17. ',' .$d18. ',' .$d19. ',' .$d20. ',' .$d21. ',' .$d22. ',' .$d23. ',' .$d24. ',' .$d25. ',' .$d26. ',' .$d27. ',' .$d28. ',' .$d29 ?>],
<?php
	}
	
	// if it is not a leap year
	else {
		?>	
        data: [<?php echo $d1. ',' .$d2. ',' .$d3. ',' .$d4. ',' .$d5. ',' .$d6. ',' .$d7. ',' .$d8. ',' .$d9. ',' .$d10. ',' .$d11. ',' .$d12. ',' .$d13. ',' .$d14. ',' .$d15. ',' .$d16. ',' .$d17. ',' .$d18. ',' .$d19. ',' .$d20. ',' .$d21. ',' .$d22. ',' .$d23. ',' .$d24. ',' .$d25. ',' .$d26. ',' .$d27. ',' .$d28 ?>],
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
</fieldset>
<?php
	
	
	
	} // close tag for Average Medicine Efficiency
	
	
	//if Medicine Efficiency Comparison got ticked
	if (isset($_POST['relcomp'])) {
		if(!empty($_POST['medicine'])) {
			$countmed = 0;
    	foreach($_POST['medicine'] as $check2) {
			//echo $check1 . "<br />";
			$med[] = $check2;
			$countmed++;
		}
//print_r($pain);

$i = 0;
while ($i < $countmed) {

	// Day 1
	$qqq1 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=1 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr1 = mysqli_query ($dbc, $qqq1) or trigger_error("Query: $qqq1\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr1 -> num_rows > 0) {
	 $m1num = 0;
	 $m1sum = 0;
     while($row = $rrr1->fetch_assoc()) {
		 $m1num++;
		 $m1sum = $m1sum + $row['reliefrating'];
	 }
	 $m1[] = $m1sum/$m1num;
	}
	else {
	$m1[] = 0;	
	}	
	
	// Day 2
	$qqq2 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=2 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr2 = mysqli_query ($dbc, $qqq2) or trigger_error("Query: $qqq2\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr2 -> num_rows > 0) {
	 $m2num = 0;
	 $m2sum = 0;
     while($row = $rrr2->fetch_assoc()) {
		 $m2num++;
		 $m2sum = $m2sum + $row['reliefrating'];
	 }
	 $m2[] = $m2sum/$m2num;
	}
	else {
	$m2[] = 0;	
	}
	
	// Day 3
	$qqq3 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=3 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr3 = mysqli_query ($dbc, $qqq3) or trigger_error("Query: $qqq3\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr3 -> num_rows > 0) {
	 $m3num = 0;
	 $m3sum = 0;
     while($row = $rrr3->fetch_assoc()) {
		 $m3num++;
		 $m3sum = $m3sum + $row['reliefrating'];
	 }
	 $m3[] = $m3sum/$m3num;
	}
	else {
	$m3[] = 0;	
	}
	
	// Day 4
	$qqq4 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=4 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr4 = mysqli_query ($dbc, $qqq4) or trigger_error("Query: $qqq4\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr4 -> num_rows > 0) {
	 $m4num = 0;
	 $m4sum = 0;
     while($row = $rrr4->fetch_assoc()) {
		 $m4num++;
		 $m4sum = $m4sum + $row['reliefrating'];
	 }
	 $m4[] = $m4sum/$m4num;
	}
	else {
	$m4[] = 0;	
	}
	
	// Day 5
	$qqq5 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=5 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr5 = mysqli_query ($dbc, $qqq5) or trigger_error("Query: $qqq5\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr5 -> num_rows > 0) {
	 $m5num = 0;
	 $m5sum = 0;
     while($row = $rrr5->fetch_assoc()) {
		 $m5num++;
		 $m5sum = $m5sum + $row['reliefrating'];
	 }
	 $m5[] = $m5sum/$m5num;
	}
	else {
	$m5[] = 0;	
	}
	
	// Day 6
	$qqq6 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=6 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr6 = mysqli_query ($dbc, $qqq6) or trigger_error("Query: $qqq6\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr6 -> num_rows > 0) {
	 $m6num = 0;
	 $m6sum = 0;
     while($row = $rrr6->fetch_assoc()) {
		 $m6num++;
		 $m6sum = $m6sum + $row['reliefrating'];
	 }
	 $m6[] = $m6sum/$m6num;
	}
	else {
	$m6[] = 0;	
	}
	
	// Day 7
	$qqq7 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=7 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr7 = mysqli_query ($dbc, $qqq7) or trigger_error("Query: $qqq7\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr7 -> num_rows > 0) {
	 $m7num = 0;
	 $m7sum = 0;
     while($row = $rrr7->fetch_assoc()) {
		 $m7num++;
		 $m7sum = $m7sum + $row['reliefrating'];
	 }
	 $m7[] = $m7sum/$m7num;
	}
	else {
	$m7[] = 0;	
	}
	
	// Day 8
	$qqq8 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=8 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr8 = mysqli_query ($dbc, $qqq8) or trigger_error("Query: $qqq8\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr8 -> num_rows > 0) {
	 $m8num = 0;
	 $m8sum = 0;
     while($row = $rrr8->fetch_assoc()) {
		 $m8num++;
		 $m8sum = $m8sum + $row['reliefrating'];
	 }
	 $m8[] = $m8sum/$m8num;
	}
	else {
	$m8[] = 0;	
	}
	
	// Day 9
	$qqq9 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=9 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr9 = mysqli_query ($dbc, $qqq9) or trigger_error("Query: $qqq9\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr9 -> num_rows > 0) {
	 $m9num = 0;
	 $m9sum = 0;
     while($row = $rrr9->fetch_assoc()) {
		 $m9num++;
		 $m9sum = $m9sum + $row['reliefrating'];
	 }
	 $m9[] = $m9sum/$m9num;
	}
	else {
	$m9[] = 0;	
	}
	
	// Day 10
	$qqq10 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=10 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr10 = mysqli_query ($dbc, $qqq10) or trigger_error("Query: $qqq10\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr10 -> num_rows > 0) {
	 $m10num = 0;
	 $m10sum = 0;
     while($row = $rrr10->fetch_assoc()) {
		 $m10num++;
		 $m10sum = $m10sum + $row['reliefrating'];
	 }
	 $m10[] = $m10sum/$m10num;
	}
	else {
	$m10[] = 0;	
	}
	
	// Day 11
	$qqq11 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=11 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr11 = mysqli_query ($dbc, $qqq11) or trigger_error("Query: $qqq11\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr11 -> num_rows > 0) {
	 $m11num = 0;
	 $m11sum = 0;
     while($row = $rrr11->fetch_assoc()) {
		 $m11num++;
		 $m11sum = $m11sum + $row['reliefrating'];
	 }
	 $m11[] = $m11sum/$m11num;
	}
	else {
	$m11[] = 0;	
	}
	
	// Day 12
	$qqq12 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=12 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr12 = mysqli_query ($dbc, $qqq12) or trigger_error("Query: $qqq12\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr12 -> num_rows > 0) {
	 $m12num = 0;
	 $m12sum = 0;
     while($row = $rrr12->fetch_assoc()) {
		 $m12num++;
		 $m12sum = $m12sum + $row['reliefrating'];
	 }
	 $m12[] = $m12sum/$m12num;
	}
	else {
	$m12[] = 0;	
	}
	
	// Day 13
	$qqq13 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=13 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr13 = mysqli_query ($dbc, $qqq13) or trigger_error("Query: $qqq13\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr13 -> num_rows > 0) {
	 $m13num = 0;
	 $m13sum = 0;
     while($row = $rrr13->fetch_assoc()) {
		 $m13num++;
		 $m13sum = $m13sum + $row['reliefrating'];
	 }
	 $m13[] = $m13sum/$m13num;
	}
	else {
	$m13[] = 0;	
	}
	
	// Day 14
	$qqq14 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=14 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr14 = mysqli_query ($dbc, $qqq14) or trigger_error("Query: $qqq14\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr14 -> num_rows > 0) {
	 $m14num = 0;
	 $m14sum = 0;
     while($row = $rrr14->fetch_assoc()) {
		 $m14num++;
		 $m14sum = $m14sum + $row['reliefrating'];
	 }
	 $m14[] = $m14sum/$m14num;
	}
	else {
	$m14[] = 0;	
	}
	
	// Day 15
	$qqq15 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=15 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr15 = mysqli_query ($dbc, $qqq15) or trigger_error("Query: $qqq15\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr15 -> num_rows > 0) {
	 $m15num = 0;
	 $m15sum = 0;
     while($row = $rrr15->fetch_assoc()) {
		 $m15num++;
		 $m15sum = $m15sum + $row['reliefrating'];
	 }
	 $m15[] = $m15sum/$m15num;
	}
	else {
	$m15[] = 0;	
	}
	
	// Day 16
	$qqq16 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=16 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr16 = mysqli_query ($dbc, $qqq16) or trigger_error("Query: $qqq16\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr16 -> num_rows > 0) {
	 $m16num = 0;
	 $m16sum = 0;
     while($row = $rrr16->fetch_assoc()) {
		 $m16num++;
		 $m16sum = $m16sum + $row['reliefrating'];
	 }
	 $m16[] = $m16sum/$m16num;
	}
	else {
	$m16[] = 0;	
	}
	
	// Day 17
	$qqq17 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=17 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr17 = mysqli_query ($dbc, $qqq17) or trigger_error("Query: $qqq17\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr17 -> num_rows > 0) {
	 $m17num = 0;
	 $m17sum = 0;
     while($row = $rrr17->fetch_assoc()) {
		 $m17num++;
		 $m17sum = $m17sum + $row['reliefrating'];
	 }
	 $m17[] = $m17sum/$m17num;
	}
	else {
	$m17[] = 0;	
	}
	
	// Day 18
	$qqq18 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=18 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr18 = mysqli_query ($dbc, $qqq18) or trigger_error("Query: $qqq18\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr18 -> num_rows > 0) {
	 $m18num = 0;
	 $m18sum = 0;
     while($row = $rrr18->fetch_assoc()) {
		 $m18num++;
		 $m18sum = $m18sum + $row['reliefrating'];
	 }
	 $m18[] = $m18sum/$m18num;
	}
	else {
	$m18[] = 0;	
	}
	
	// Day 19
	$qqq19 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=19 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr19 = mysqli_query ($dbc, $qqq19) or trigger_error("Query: $qqq19\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr19 -> num_rows > 0) {
	 $m19num = 0;
	 $m19sum = 0;
     while($row = $rrr19->fetch_assoc()) {
		 $m19num++;
		 $m19sum = $m19sum + $row['reliefrating'];
	 }
	 $m19[] = $m19sum/$m19num;
	}
	else {
	$m19[] = 0;	
	}
	
	// Day 20
	$qqq20 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=20 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr20 = mysqli_query ($dbc, $qqq20) or trigger_error("Query: $qqq20\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr20 -> num_rows > 0) {
	 $m20num = 0;
	 $m20sum = 0;
     while($row = $rrr20->fetch_assoc()) {
		 $m20num++;
		 $m20sum = $m20sum + $row['reliefrating'];
	 }
	 $m20[] = $m20sum/$m20num;
	}
	else {
	$m20[] = 0;	
	}
	
	// Day 21
	$qqq21 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=21 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr21 = mysqli_query ($dbc, $qqq21) or trigger_error("Query: $qqq21\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr21 -> num_rows > 0) {
	 $m21num = 0;
	 $m21sum = 0;
     while($row = $rrr21->fetch_assoc()) {
		 $m21num++;
		 $m21sum = $m21sum + $row['reliefrating'];
	 }
	 $m21[] = $m21sum/$m21num;
	}
	else {
	$m21[] = 0;	
	}
	
	// Day 22
	$qqq22 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=22 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr22 = mysqli_query ($dbc, $qqq22) or trigger_error("Query: $qqq22\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr22 -> num_rows > 0) {
	 $m22num = 0;
	 $m22sum = 0;
     while($row = $rrr22->fetch_assoc()) {
		 $m22num++;
		 $m22sum = $m22sum + $row['reliefrating'];
	 }
	 $m22[] = $m22sum/$m22num;
	}
	else {
	$m22[] = 0;	
	}
	
	// Day 23
	$qqq23 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=23 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr23 = mysqli_query ($dbc, $qqq23) or trigger_error("Query: $qqq23\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr23 -> num_rows > 0) {
	 $m23num = 0;
	 $m23sum = 0;
     while($row = $rrr23->fetch_assoc()) {
		 $m23num++;
		 $m23sum = $m23sum + $row['reliefrating'];
	 }
	 $m23[] = $m23sum/$m23num;
	}
	else {
	$m23[] = 0;	
	}
	
	// Day 24
	$qqq24 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=24 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr24 = mysqli_query ($dbc, $qqq24) or trigger_error("Query: $qqq24\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr24 -> num_rows > 0) {
	 $m24num = 0;
	 $m24sum = 0;
     while($row = $rrr24->fetch_assoc()) {
		 $m24num++;
		 $m24sum = $m24sum + $row['reliefrating'];
	 }
	 $m24[] = $m24sum/$m24num;
	}
	else {
	$m24[] = 0;	
	}
	
	// Day 25
	$qqq25 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=25 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr25 = mysqli_query ($dbc, $qqq25) or trigger_error("Query: $qqq25\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr25 -> num_rows > 0) {
	 $m25num = 0;
	 $m25sum = 0;
     while($row = $rrr25->fetch_assoc()) {
		 $m25num++;
		 $m25sum = $m25sum + $row['reliefrating'];
	 }
	 $m25[] = $m25sum/$m25num;
	}
	else {
	$m25[] = 0;	
	}
	
	// Day 26
	$qqq26 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=26 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr26 = mysqli_query ($dbc, $qqq26) or trigger_error("Query: $qqq26\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr26 -> num_rows > 0) {
	 $m26num = 0;
	 $m26sum = 0;
     while($row = $rrr26->fetch_assoc()) {
		 $m26num++;
		 $m26sum = $m26sum + $row['reliefrating'];
	 }
	 $m26[] = $m26sum/$m26num;
	}
	else {
	$m26[] = 0;	
	}
	
	// Day 27
	$qqq27 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=27 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr27 = mysqli_query ($dbc, $qqq27) or trigger_error("Query: $qqq27\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr27 -> num_rows > 0) {
	 $m27num = 0;
	 $m27sum = 0;
     while($row = $rrr27->fetch_assoc()) {
		 $m27num++;
		 $m27sum = $m27sum + $row['reliefrating'];
	 }
	 $m27[] = $m27sum/$m27num;
	}
	else {
	$m27[] = 0;	
	}
	
	// Day 28
	$qqq28 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=28 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr28 = mysqli_query ($dbc, $qqq28) or trigger_error("Query: $qqq28\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr28 -> num_rows > 0) {
	 $m28num = 0;
	 $m28sum = 0;
     while($row = $rrr28->fetch_assoc()) {
		 $m28num++;
		 $m28sum = $m28sum + $row['reliefrating'];
	 }
	 $m28[] = $m28sum/$m28num;
	}
	else {
	$m28[] = 0;	
	}
	
	// Day 29
	$qqq29 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=29 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr29 = mysqli_query ($dbc, $qqq29) or trigger_error("Query: $qqq29\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr29 -> num_rows > 0) {
	 $m29num = 0;
	 $m29sum = 0;
     while($row = $rrr29->fetch_assoc()) {
		 $m29num++;
		 $m29sum = $m29sum + $row['reliefrating'];
	 }
	 $m29[] = $m29sum/$m29num;
	}
	else {
	$m29[] = 0;	
	}
	
	// Day 30
	$qqq30 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=30 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr30 = mysqli_query ($dbc, $qqq30) or trigger_error("Query: $qqq30\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr30 -> num_rows > 0) {
	 $m30num = 0;
	 $m30sum = 0;
     while($row = $rrr30->fetch_assoc()) {
		 $m30num++;
		 $m30sum = $m30sum + $row['reliefrating'];
	 }
	 $m30[] = $m30sum/$m30num;
	}
	else {
	$m30[] = 0;	
	}
	
	// Day 31
	$qqq31 = "SELECT * FROM painrelief WHERE entryyear=". $calyear. " AND entrymonth=". $calmonth ." AND entryday=31 AND medicine='". $med[$i] ."' AND user_id="  . $_SESSION['user_id'];
	$rrr31 = mysqli_query ($dbc, $qqq31) or trigger_error("Query: $qqq31\n<br />MySQL Error: " . mysqli_error($dbc));
	if ($rrr31 -> num_rows > 0) {
	 $m31num = 0;
	 $m31sum = 0;
     while($row = $rrr31->fetch_assoc()) {
		 $m31num++;
		 $m31sum = $m31sum + $row['reliefrating'];
	 }
	 $m31[] = $m31sum/$m31num;
	}
	else {
	$m31[] = 0;	
	}
	
$i++;
} // close tag for while 1 < countmed

?>
<fieldset>
<legend>Medicine Efficiency Comparison</legend>
<div id="container7" class="cont"></div>
<script>
$(function () { 
    $('#container7').highcharts({
        chart: {
            type: 'column'
			//zoomType: 'xy'
        },
        title: {
            text: 'Medicine Efficiency Comparison (1)'
        },
		yAxis: {
            title: {
                text: 'Pain Relief Rate'
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
		while ($j<$countmed-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m1[$j]. ',' .$m2[$j]. ',' .$m3[$j]. ',' .$m4[$j]. ',' .$m5[$j]. ',' .$m6[$j]. ',' .$m7[$j]. ',' .$m8[$j]. ',' .$m9[$j]. ',' .$m10[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countmed-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m1[$j]. ',' .$m2[$j]. ',' .$m3[$j]. ',' .$m4[$j]. ',' .$m5[$j]. ',' .$m6[$j]. ',' .$m7[$j]. ',' .$m8[$j]. ',' .$m9[$j]. ',' .$m10[$j] ?>]
        }
		<?php
		}
		?>
		]
    });
});

</script>
<div id="container8" class="cont"></div>
<script>
$(function () { 
    $('#container8').highcharts({
        chart: {
            type: 'column'
			//zoomType: 'xy'
        },
        title: {
            text: 'Medicine Efficiency Comparison (2)'
        },
		yAxis: {
            title: {
                text: 'Pain Relief Rate'
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
		while ($j<$countmed-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m11[$j]. ',' .$m12[$j]. ',' .$m13[$j]. ',' .$m14[$j]. ',' .$m15[$j]. ',' .$m16[$j]. ',' .$m17[$j]. ',' .$m18[$j]. ',' .$m19[$j]. ',' .$m20[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countmed-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m11[$j]. ',' .$m12[$j]. ',' .$m13[$j]. ',' .$m14[$j]. ',' .$m15[$j]. ',' .$m16[$j]. ',' .$m17[$j]. ',' .$m18[$j]. ',' .$m19[$j]. ',' .$m20[$j] ?>]
        }
		<?php
		}
		?>
		]
    });
});

</script>
<div id="container9" class="cont"></div>
<script>
$(function () { 
    $('#container9').highcharts({
        chart: {
            type: 'column'
			//zoomType: 'xy'
        },
        title: {
            text: 'Medicine Efficiency Comparison (3)'
        },
		yAxis: {
            title: {
                text: 'Pain Relief Rate'
            }
        },
		<?php 

// if the month is January, March, May, July, August, October or December
if (($calmonth == 1) OR ($calmonth == 3) OR ($calmonth == 5) OR ($calmonth == 7) OR ($calmonth == 8) OR ($calmonth == 10) OR ($calmonth == 12)) {
?>		
        xAxis: {
            categories: ['21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31']
        },
<?php
}

// if the month is April, June, September or November
elseif (($calmonth == 4) OR ($calmonth == 6) OR ($calmonth == 9) OR ($calmonth == 11)) {
?>	
        xAxis: {
            categories: ['21', '22', '23', '24', '25', '26', '27', '28', '29', '30']
        },
<?php
}

// if the month is February
else {
	
	// if it is a leap year
	if ($calyear % 4 == 0) {
		?>	
        xAxis: {
            categories: ['21', '22', '23', '24', '25', '26', '27', '28', '29']
        },
<?php
	}
	
	// if it is not a leap year
	else {
		?>	
        xAxis: {
            categories: ['21', '22', '23', '24', '25', '26', '27', '28']
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
	<?php 

// if the month is January, March, May, July, August, October or December
if (($calmonth == 1) OR ($calmonth == 3) OR ($calmonth == 5) OR ($calmonth == 7) OR ($calmonth == 8) OR ($calmonth == 10) OR ($calmonth == 12)) {
?>		
                series: [
		<?php
		$j=0;
		while ($j<$countmed-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m21[$j]. ',' .$m22[$j]. ',' .$m23[$j]. ',' .$m24[$j]. ',' .$m25[$j]. ',' .$m26[$j]. ',' .$m27[$j]. ',' .$m28[$j]. ',' .$m29[$j]. ',' .$m30[$j]. ',' .$m31[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countmed-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m21[$j]. ',' .$m22[$j]. ',' .$m23[$j]. ',' .$m24[$j]. ',' .$m25[$j]. ',' .$m26[$j]. ',' .$m27[$j]. ',' .$m28[$j]. ',' .$m29[$j]. ',' .$m30[$j]. ',' .$m31[$j] ?>]
        }
		<?php
		}
		?>
		]
<?php
}

// if the month is April, June, September or November
elseif (($calmonth == 4) OR ($calmonth == 6) OR ($calmonth == 9) OR ($calmonth == 11)) {
?>	
                series: [
		<?php
		$j=0;
		while ($j<$countmed-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m21[$j]. ',' .$m22[$j]. ',' .$m23[$j]. ',' .$m24[$j]. ',' .$m25[$j]. ',' .$m26[$j]. ',' .$m27[$j]. ',' .$m28[$j]. ',' .$m29[$j]. ',' .$m30[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countmed-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m21[$j]. ',' .$m22[$j]. ',' .$m23[$j]. ',' .$m24[$j]. ',' .$m25[$j]. ',' .$m26[$j]. ',' .$m27[$j]. ',' .$m28[$j]. ',' .$m29[$j]. ',' .$m30[$j] ?>]
        }
		<?php
		}
		?>
		]
<?php
}

// if the month is February
else {
	
	// if it is a leap year
	if ($calyear % 4 == 0) {
		?>	
                series: [
		<?php
		$j=0;
		while ($j<$countmed-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m21[$j]. ',' .$m22[$j]. ',' .$m23[$j]. ',' .$m24[$j]. ',' .$m25[$j]. ',' .$m26[$j]. ',' .$m27[$j]. ',' .$m28[$j]. ',' .$m29[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countmed-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m21[$j]. ',' .$m22[$j]. ',' .$m23[$j]. ',' .$m24[$j]. ',' .$m25[$j]. ',' .$m26[$j]. ',' .$m27[$j]. ',' .$m28[$j]. ',' .$m29[$j] ?>]
        }
		<?php
		}
		?>
		]
<?php
	}
	
	// if it is not a leap year
	else {
		?>	
                series: [
		<?php
		$j=0;
		while ($j<$countmed-1) {
		//repeat this part until i = countparts
		?>
		{
            name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m21[$j]. ',' .$m22[$j]. ',' .$m23[$j]. ',' .$m24[$j]. ',' .$m25[$j]. ',' .$m26[$j]. ',' .$m27[$j]. ',' .$m28[$j] ?>]
        },
		<?php
		$j++;
		}
		if ($j == $countmed-1) {
		// write this for the last one only
		?>
		 {
			name: '<?php echo $med[$j] ?>',
			data: [<?php echo $m21[$j]. ',' .$m22[$j]. ',' .$m23[$j]. ',' .$m24[$j]. ',' .$m25[$j]. ',' .$m26[$j]. ',' .$m27[$j]. ',' .$m28[$j] ?>]
        }
		<?php
		}
		?>
		]
<?php
	}

}
?>	
    });
});

</script>
</fieldset>
<?php
	
	
		} // close tag for if not empty
	} // close tag for Medicine Efficiency Comparison
		
		
	// if Important Entries got ticked
	if (isset($_POST['impent'])) {
		
		$sql = "SELECT * FROM important WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth;
$result = $dbc->query($sql);
if ($result -> num_rows > 0) {
		$n=0;
	while($row = $result->fetch_assoc()) {
		$eday[] = $row['entryday'];
		
		$sql2 = "SELECT * FROM comments WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth. " AND entryday = '" . $eday[$n] ."'";
		$result2 = $dbc->query($sql2);
		if ($result2 -> num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
		$ecomment[] = $row['comment'];
			}	
			}
		else {
		$ecomment[] = "There is no comment to justify why this day was marked as important.";
		}
		$n++;

	}
?>
<fieldset>
<legend>Days marked as important</legend>
<table>
<?php
$i=0;
while ($i<= $n-1) {
?>
<tr>
<td class="bold"><?php echo $eday[$i] .'/'. $calmonth .'/'. $calyear ?>:</td>
<td><?php echo $ecomment[$i] ?></td>
</tr>
<?php
$i++;	
}
?>
</table>
</fieldset>
<?php	
	
}
		
		
		
	} // closing tag for Important Entries
?>	
<a href="javascript:window.print()"><div id="printbutton" class="center"><div class="icon-print"></div><div class="linktext">Print Report</div></div></a>

<?php	
	
} // closing request method post



?>
</div>
</div>
</body>
</html>