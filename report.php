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
<h1>Report for <?php echo $month ?> <?php echo $calyear ?></h1>
<?php
$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "bcac3dbe9c1d06";
$password = "32d91723";
$dbname = "booksapp";

$dbc = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $calyear . " AND entrymonth = " . $calmonth . " AND entryday = 16 ";
$result = $dbc->query($sql);
if ($result -> num_rows > 0) {
	
	
     // output data of each row
	 $day1num = 0;
	 $day1sum = 0;
     while($row = $result->fetch_assoc()) {
		 echo " &nbsp " . $row['avgpain'];
		 $day1num++;
		 $day1sum = $day1sum + $row['avgpain'];
	 }
	 echo "number of entries: ". $day1num;
	 echo "sum of avgpain: ". $day1sum;
	 $day1 = $day1sum/$day1num;
	 echo "day1 average: ". $day1;
}
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