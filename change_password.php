<?php
include ('header.html');
?>
<link rel="stylesheet" href="style.css" type="text/css" />
<div id="pagewrap">
<div id="pagecontent">


<?php
require ('config.inc.php'); 
$page_title = 'Changing Your Password';


if (!isset($_SESSION['user_id'])) {
	
	$url = BASE_URL . 'login.php'; //BASE_URL is defined in the config.inc.php
	ob_end_clean(); 
	header("Location: $url");
	exit(); 
	
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
			
	
	$p = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) {
		if ($_POST['password1'] == $_POST['password2']) {
			$p = mysqli_real_escape_string ($dbc, $_POST['password1']); //Password Validation
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password!</p>';
	}
	
	
	if (!empty($_POST['password0'])) {
		$p = mysqli_real_escape_string ($dbc, $_POST['password0']);
	
	if ($p) { 

		
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id={$_SESSION['user_id']} LIMIT 1";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) { //Updating MYSQL Database

			
			echo '<h3>Your password has been changed.</h3>';
			mysqli_close($dbc); 
			include ('footer.html'); 
			exit();
			
		} else { 
		
			echo '<p class="error">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</p>'; 

		}

	} else { 
		echo '<p class="error">Invalid password. Please try again. Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>';		
	}
	
	mysqli_close($dbc); 

} 

else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your old password!</p>';
	}
}

?>

<h1>Changing Your Password</h1>
<form action="change_password.php" method="post">
   
    <table id="changepasswordtable">
    <tr><td><label><small>Enter Old Password:</small></label></td><td><input type="password" name="password0" size="30" maxlength="20" /></td></tr>
    <tr><td><label><small>Enter New Password:</small></label></td><td><input type="password" name="password1" size="30" maxlength="20" /></td></tr>
    <tr><td><label><small>Confirm New Password:</small></label></td><td><input type="password" name="password2" size="30" maxlength="20" /></td></tr>
    </table>
    <input style="margin-left: 300px" type="submit" name="submit" value="Change My Password" />
</form>



</div>
</div>

<?php include ('footer.html'); ?>