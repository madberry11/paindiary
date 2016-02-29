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
    <script src="demo/js/jquery.1.7.2.min.js"></script>
  	<script src="demo/js/jquery-ui.1.8.20.min.js"></script>
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

<?php
if(isset($_COOKIE["unm"])) {
$_SESSION["username"] = $_COOKIE["unm"];
}
else {
$_SESSION["username"] = "";	
}
if(isset($_COOKIE["pwd"])) {
$_SESSION["password"] = $_COOKIE["pwd"];
}
else {
$_SESSION["password"] = "";	
}
?>

<br />
<form id="loginform" action="index.php" method="post">
	<label for="username" class="ui-hidden-accessible">Username</label>
    <input class="logininput" name="username" type="text"  placeholder="username" maxlength="60" value="<?php echo $_SESSION["username"] ?>" />
    <label for="password" class="ui-hidden-accessible">Password</label>
    <input class="logininput" name="pass" type="password" placeholder="password" maxlength="20" value="<?php echo $_SESSION["password"] ?>" />
    <div class="checkboxdiv">
    <!--<input type="checkbox" name="rememberme" value="yes" /><label for="rememberme"> Remember me </label><br />-->
    <input class="checkbox" type="checkbox" id="rememberme" name="rememberme" /><label for="rememberme"> Remember me</label></br>
    <input class="checkbox" type="checkbox" id="keepmeloggedin" name="keepmeloggedin" /><label for="keepmeloggedin"> Keep me logged in</label></br>
    <a href="http://ezinearticles.com/?The-Overlooked-Risks-of-Staying-Logged-In&id=4523115"><div class="icon-warning-sign float-left"></div></a><div class="small float-right">Do not check these if you are using a shared computer.</div></div>
    <p><input type="submit" name="login" id="loginbutton" value="Login" /></p>
    <div id="toregister"><a href="register.php">Create New Account</a></div>
    <div id="tochangepassword"><a href="forgot_password.php">Request New Password</a></div>
</form>
<br clear="both" />

<?php

$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "bcac3dbe9c1d06";
$password = "32d91723";
$dbname = "booksapp";

$dbc = new mysqli($servername, $username, $password, $dbname);

if(isset($_SESSION["username"])) {
	$query2 = "SELECT username, rememberme, keepmeloggedin FROM users WHERE (username='" . $_SESSION['username'] ."')" ;
	$r = mysqli_query ($dbc, $query2) or trigger_error("Query: $query2\n<br />MySQL Error: " . mysqli_error($dbc));
	if (@mysqli_num_rows($r) == 1) {
		while($row = $r->fetch_assoc()) {
		$dorememberme = $row['rememberme'];
		$dokeepmeloggedin = $row['keepmeloggedin'];
		
		if(isset($dorememberme)) {
			//echo "This user has clicked on Remember me.";
			?>
            <script>
			$("#rememberme").prop("checked", true);
			</script>
            <?php
		}
		elseif(isset($dokeepmeloggedin)) {
			echo "This user has clicked on Keep me logged in.";
			?>
            <script>
			$("#keepmeloggedin").prop("checked", true);
			</script>
            <?php
		}
		}
	}
}


?>

<script>
$('div .checkbox').click(function () {                  
    var checkedState =   $(this).prop("checked")
    $(this)
          .parent('div')
          .children('.checkbox:checked')
          .prop("checked", false);
    
    $(this).prop("checked", checkedState);
});
</script>


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
			
			
			// If "keep me logged in" is ticked, save both username and password
			if (isset($_POST['keepmeloggedin'])) {
			$_SESSION['keeploggedin']	 = 1;
			setcookie("unm",$_POST["username"],time()+3600000);
			setcookie("pwd",$_POST["pass"],time()+3600000);
			$query = "UPDATE users SET keepmeloggedin = '1', rememberme = '0' WHERE username='$un'";
			$r = mysqli_query ($dbc, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($dbc));
			echo "keepmeloggedin";
			}
			
			// If "remember me" is ticked, save only the username
			elseif (isset($_POST['rememberme'])) {
			$_SESSION['rememberme']	 = 1;
			setcookie("unm",$_POST["username"],time()+3600000);
			$query = "UPDATE users SET rememberme = '1', keepmeloggedin = '0' WHERE username='$un'";
			$r = mysqli_query ($dbc, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($dbc));
			echo "rememberme";
			}
			
			// If neither is ticked or got unticked, clear cookies
			elseif(!isset($_POST['keepmeloggedin']) AND !isset($_POST['rememberme'])) {
			setcookie("unm","",time()-3600000);
			setcookie("pwd","",time()-3600000);	
			$query = "UPDATE users SET rememberme = '0', keepmeloggedin = '0' WHERE username='$un'";
			}

			
			//mysqli_close($dbc);
			

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