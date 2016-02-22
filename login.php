<?php
include ('header.html');
?>
<link rel="stylesheet" href="style.css" type="text/css" />
<div id="pagewrap">
<div id="pagecontent">

<?php
require ('config.inc.php'); 
$page_title = 'Login Page';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	
	
	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string ($dbc, $_POST['email']);
	} else {
		$e = FALSE;
		echo '<p class="error">You forgot to enter your email address!</p>';
	}
	
	
	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string ($dbc, $_POST['pass']);
	} else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your password!</p>';
	}
	
	if ($e && $p) { 

		
		$q = "SELECT user_id, first_name, user_level FROM users WHERE (email='$e' AND pass=SHA1('$p')) AND active IS NULL";		
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (@mysqli_num_rows($r) == 1) { 

			
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
			mysqli_close($dbc);
							
			
			$url = BASE_URL . 'index.php'; 
			ob_end_clean(); 
			header("Location: $url");
			exit(); 
				
		} else { 
			echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
		}
		
	} else { 
		echo '<p class="error">Please try again.</p>';
	}
	
	mysqli_close($dbc);

} 
?>

<h1>Login</h1>
<p class="small">We may use information obtained about you from cookies  which we can access when you visit our website in future. We do this to allow us to identify users and personalise the website wherever possible. The cookies store small pieces of information about our visitors. This means that on future visits to our websites, we can identify past visitors and welcome them back.</p>
<form action="login.php" method="post">    
    <table id="logintable">
	<tr><td><label class="loginlabel">Email Address</label></td><td><label class="loginlabel">Password</label></td><td>&nbsp;</td></tr>
    <tr><td><input type="text" name="email" size="30" maxlength="60" /></td><td><input type="password" name="pass" size="30" maxlength="20" /></td><td><input type="submit" name="submit" value="Login" /></td></tr>
    <tr><td><a class="loginother" href="register.php">Not registered yet?</a></td><td><a class="loginother" href="forgot_password.php">Forgot Your Password?</a></td><td>&nbsp;</td></tr>
</table>
</form>

</div>
</div>

<?php include ('footer.html'); ?>