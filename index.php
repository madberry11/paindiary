<?php

ob_start();
session_start();
require ('config.inc.php');

if (!isset($page_title)) {
	$page_title = 'Your Pain Diary';

}
?>

<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $page_title; ?></title>
    
<!-- stylesheets -->
	<link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="jquery.mobile/jquery.mobile-1.4.5.css" type="text/css" />
	<link rel="stylesheet" href="jquery.mobile/jquery.mobile-1.4.5.min.css" type="text/css" />

<!-- JavaScript / JQuery -->
	<script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.js"></script> 
	<script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
    <noscript>JavaScript is essential for the functionality of this application. Please enable JavaScript for an improved user experience.</noscript>

<!-- fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Ruda:700' rel='stylesheet' type='text/css'>

</head>
<body>

<div id="header">
<div id="logintitle"><a href="home.php" class="nounderline"><span class="lato900">Your</span> <span class="lato300">Pain Diary</span></a></div>
</div>
<div id="pagewraplogin">
<h1>Member Login</h1>
<div id="pagecontent">

<br />
<form id="loginform" action="index.php" method="post">
	<label for="username" class="ui-hidden-accessible">Username</label>
    <input class="logininput" name="username" type="text"  placeholder="username" maxlength="60" />
    <label for="password" class="ui-hidden-accessible">Password</label>
    <input class="logininput" name="pass" type="password" placeholder="password" maxlength="20" />
    <div class="checkbox">
    <!--<input type="checkbox" name="rememberme" value="yes" /><label for="rememberme"> Remember me </label><br />-->
    <input type="checkbox" name="rememberme" /><label for="rememberme"> Remember me</label></br>
    <input type="checkbox" name="keepmeloggedin" /><label for="keepmeloggedin"> Keep me logged in</label></br>
    <span class="icon-warning-sign"></span>Do not check these if you are using a shared or public computer.</div>
    <p><input type="submit" name="login" id="loginbutton" value="Login" /></p>
    <div id="toregister"><a href="register.php">Create New Account</a></div>
    <div id="tochangepassword"><a href="forgot_password.php">Request New Password</a></div>
</form>


<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	
	
	if (!empty($_POST['username'])) {
		$un = mysqli_real_escape_string ($dbc, $_POST['username']);
	} else {
		$un = FALSE;
		echo '<p class="error">You forgot to enter your username!</p>';
	}
	
	
	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string ($dbc, $_POST['pass']);
	} else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your password!</p>';
	}
	
	if ($un && $p) { 

		
		$q = "SELECT user_id, username FROM users WHERE (username='$un' AND pass=SHA1('$p')) AND active IS NULL";		
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (@mysqli_num_rows($r) == 1) { 

			
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
			mysqli_close($dbc);
			
			if (isset($_POST['keepmeloggedin'])) {
			$_SESSION['keeploggedin']	 = 1;
			}
			
			elseif (isset($_POST['rememberme'])) {
			$_SESSION['rememberme']	 = 1;
			}
							
			
			$url = BASE_URL . 'home.php'; 
			ob_end_clean(); 
			header("Location: $url");
			exit(); 
				
		} else { 
			echo '<p class="error">Either the username and password entered do not match those on file or you have not yet activated your account.</p>';
		}
		
	} else { 
		echo '<p class="error">Please try again.</p>';
	}
	
	mysqli_close($dbc);

} 
?>



</div>
</div>