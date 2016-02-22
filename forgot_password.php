
<link rel="stylesheet" href="style.css" type="text/css" />
<div id="pagewraplogin">
<h1>Reset Password</h1>
<div id="pagecontent">

<?php 
require ('config.inc.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	
	$uid = FALSE;

	
	if (!empty($_POST['email'])) {

		
		$q = 'SELECT user_id FROM users WHERE email="'.  mysqli_real_escape_string ($dbc, $_POST['email']) . '"';
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 1) { 
			list($uid) = mysqli_fetch_array ($r, MYSQLI_NUM); 
		} else { 
			echo '<p class="error">The submitted email address does not match a registered user!</p>';
		}
		
	} else { 
		echo '<p class="error">You forgot to enter your email address!</p>';
	} 
	
	if ($uid) { 

		
		$p = substr ( md5(uniqid(rand(), true)), 3, 10);

		
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1) { 
		
			
			$body = "Your password to log into <whatever site> has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
			mail ($_POST['email'], 'Your temporary password.', $body, 'From: myemail@domain.com');
			
			
			echo '<h3>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3></div></div>';
			mysqli_close($dbc);
			include ('footer.html');
			exit(); 
			
		} else { 
			echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
		}

	} else { 
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

} 
?>
Please enter your email address. 
<form action="forgot_password.php" method="post">
	<p><input type="text" name="email" size="50" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /><input style="margin-left: 5px" type="submit" name="submit" value="Reset My Password" /></p>
</form>

</div>
</div>