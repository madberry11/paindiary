<?php
include ('header.html');
?>
<meta http-equiv="refresh" content="3;URL='index.php'" />
<link rel="stylesheet" href="style.css" type="text/css" />
<div id="pagewrap">
<div id="pagecontent">


<?php 
require ('config.inc.php'); 
$page_title = 'Logout Page';


if (!isset($_SESSION['user_id'])) {

	$url = BASE_URL . 'index.php'; //BASE_URL is defined in the config.inc.php
	ob_end_clean(); 
	header("Location: $url");
	exit(); 
	
} else {

	$_SESSION = array(); 
	session_destroy(); 
	setcookie (session_name(), '', time()-3600000); 
	$_SESSION['keeploggedin']	 = 0;

}
?>

</div>
</div>