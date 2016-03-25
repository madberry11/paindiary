<?php

if (!isset($page_title)) {
	$page_title = 'Your Pain Diary';

}
?>

<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $page_title; ?></title>

<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="colour1.css" type="text/css" id="colour1" />
<script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.js"></script> 
<script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="jquery.mobile/jquery.mobile-1.4.5.css" type="text/css" />
<link rel="stylesheet" href="jquery.mobile/jquery.mobile-1.4.5.min.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Ruda:700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>

</head>
<body>

<div id="header">
<div id="logintitle"><a href="index.php" class="nounderline"><span class="lato900">Your</span> <span class="lato300">Pain Diary</span></a></div>
</div>

<div id="pagewraplogin">
<h1 class="outh1"><a href="index.php" class="icon-chevron-left nounderline"></a>Activating Your Account</h1>
<div id="pagecontent">
<?php
require ('config.inc.php'); 
$page_title = 'Activating Your Account';


if (isset($_GET['x'], $_GET['y'], $_GET['hash']) 
	&& filter_var($_GET['x'], FILTER_VALIDATE_EMAIL)
	&& (strlen($_GET['y']) == 32 )
	) {
	
	require (MYSQL);
	$q = "UPDATE users SET active=NULL WHERE (email='" . mysqli_real_escape_string($dbc, $_GET['x']) . "' AND active='" . mysqli_real_escape_string($dbc, $_GET['y']) . "' AND hash='". mysqli_real_escape_string($dbc, $_GET['hash'])."' ) LIMIT 1";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	
	if (mysqli_affected_rows($dbc) == 1) {
		echo "<h3>Your account is now active. You may now <a href='index.php'>log in</a>.</h3>";
	} else {
		echo '<p class="error">Your account could not be activated. Please re-check the link or contact the system administrator.</p>'; 
	}

	mysqli_close($dbc);

} else { 

	$url = BASE_URL . 'index.php'; 
	ob_end_clean(); 
	header("Location: $url");
	exit(); 

} 
?>

</div>
</div>
</body>
</html>