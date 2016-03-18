<?php
include ('header.html');
?>
<meta http-equiv="refresh" content="3;URL='index.php'" />
<link rel="stylesheet" href="style.css" type="text/css" />
<div id="pagewrap">
<div id="pagecontent">

<?php
require ('config.inc.php'); 
$page_title = 'Activating Your Account';


if (isset($_GET['x'], $_GET['y'], $_GET['hash']) 
	&& filter_var($_GET['x'], FILTER_VALIDATE_EMAIL)
	&& (strlen($_GET['y']) == 32 )
	) {
	
	require (MYSQL);
	$q = "UPDATE users SET active=NULL WHERE (email='" . mysqli_real_escape_string($dbc, $_GET['x']) . "' AND active='" . mysqli_real_escape_string($dbc, $_GET['y']) . "' AND hash=". mysqli_real_escape_string($dbc, $_GET['hash'])." ) LIMIT 1";
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