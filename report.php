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
echo "<input class='checkbox' type='checkbox' id='$bodypart' name='$bodypart' checked/><label for='$bodypart'> " . $row['bodypart'] . " (". $row['COUNT(entryid)'] .")</label>";

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
echo "<input class='checkbox' type='checkbox' id='$medicine' name='$medicine' checked /><label for='$medicine'> " . $row['medicine'] . " (". $row['COUNT(record_id)'] .")</label>";
	}
	}
?>
</div>
<p><input class='checkbox' type='checkbox' id='impent' name='impent' /><label for='relcomp'>Important Entries</label></p>
<p><input type="submit" name="generate" id="generate" value="Generate Report" /></p>
</form>


<?php
$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "bcac3dbe9c1d06";
$password = "32d91723";
$dbname = "booksapp";

$dbc = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	// if Average Pain Intensity got ticked
	if (isset($_POST['avgp'])) {
		echo "average pain intensity<br />";
	} // close tag for Average Pain Intensity
	
	// if Pain Intensity Comparison got ticked
	if (isset($_POST['pcomp'])) {
		if (isset($_POST['$bodypart'])) {
			echo $bodypart;
			echo "pain comp<br />";
		}
	} // close tag for Pain Intensity Comparison
	
	// if Average Medicine Efficiency got ticked
	if (isset($_POST['avgrel'])) {
		echo "average medicine efficiency<br />";
	} // close tag for Average Medicine Efficiency
	
	//if Medicine Efficiency Comparison got ticked
	if (isset($_POST['relcomp'])) {
		if (isset($_POST['$medicine'])) {
			echo $medicine;
			echo "medicine comp<br />";
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