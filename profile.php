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


?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $page_title; ?></title>
    
<!-- stylesheets -->
	<link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="clndr.css">

<!-- JavaScript / JQuery -->
	<script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.js"></script>
	<script type="text/javascript" src="script.js"></script>
    <script src="json2.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
    <script src="moment-2.8.3.js"></script>
  	<script src="clndr.js"></script>
 	<script src="site.js"></script>

<!-- fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ruda:700' rel='stylesheet' type='text/css'>


<script type="text/javascript">
var myInterval = setTimeout("location=('index.php');",3600000);
</script>  
  
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
<h1>User Profile</h1>
<?php

	$servername = "ap-cdbr-azure-east-c.cloudapp.net";
	$username = "bcac3dbe9c1d06";
	$password = "32d91723";
	$dbname = "booksapp";

	$dbc = new mysqli($servername, $username, $password, $dbname);

$q = "SELECT user_id, username, email, pass, registration_date FROM users WHERE user_id='".$_SESSION['user_id']."' AND active IS NULL";		
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	if (@mysqli_num_rows($r) == 1) { 
	$row = mysqli_fetch_assoc($r);
	$username=$row['username'];
	$register=new DateTime($row['registration_date']);
	$email=$row['email'];
	$password=$row['pass'];
	}
	
$q2 = "SELECT entryyear, entrymonth, entryday FROM pain WHERE user_id='".$_SESSION['user_id']."' GROUP BY entryyear, entrymonth, entryday";
//$q2 = "SELECT COUNT(*) AS numofentries FROM pain WHERE user_id='".$_SESSION['user_id']."' GROUP BY entryyear, entrymonth, entryday";
$r2 = mysqli_query ($dbc, $q2) or trigger_error("Query: $q2\n<br />MySQL Error: " . mysqli_error($dbc));
$numofentries = 0;
if (@mysqli_num_rows($r2) > 0) { 
while($row2 = $r2->fetch_assoc()) {
	$year = $row2['entryyear'];
	$month = $row2['entrymonth'];
	$day = $row2['entryday'];
	//echo $year . " " . $month . " " . $day . " ";
	$numofentries++;
	
}
}


?>
<div id="leftside">
<fieldset>
<legend>User Details</legend>
<table id="usertable">
<tr><th>Username:</th><td class="right"> <?php echo $username ?></td><td class="editcell"><a data-ajax='false' class='icon-edit nounderline' href='profile.php?edit=$username'></a></td><th>Registration date:</th><td class="right"><?php echo date_format($register, 'Y-m-d'); ?></td></tr>
<tr><th>Email address:</th><td class="right"><?php echo $email ?></td><td class="editcell"><a data-ajax='false' class='icon-edit nounderline' href='profile.php?edit=$email'></a></td><th>Number of entries:</th><td class="right"><?php echo $numofentries ?></td></tr>
<tr><th>Password:</th><td class="right"><a data-ajax='false' href='profile.php?edit=$password'>Change Password</a></td><td class="editcell"><a data-ajax='false' class='icon-edit nounderline' href='profile.php?edit=$password'></a></td><th>&nbsp;</th><td>&nbsp;</td></tr>
<tr><th>Colour scheme:</th><td class="right"></td><td class="editcell"><a data-ajax='false' class='icon-edit nounderline' href='profile.php?edit=$colour'></a></td><th>&nbsp;</th><td>Delete Account</td></tr>
</table>
</fieldset>
</div>
<div id="rightside">
<fieldset>
<legend>Medication Schedule</legend>
something
</fieldset>
</div>
</div>
</body>
</html>