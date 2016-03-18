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
<h1><a href="index.php" class="icon-chevron-left nounderline"></a>Register</h1>
<div id="pagecontent">

<form action="register.php" method="post">
<div class="center">

<label for="username" class="ui-hidden-accessible">Username</label>
<input class="logininput" type="text" name="username" placeholder="username" maxlength="40" value="<?php if (isset($trimmed['username'])) echo $trimmed['username']; ?>" />
<label for="email" class="ui-hidden-accessible">E-mail Address</label>
<input class="logininput" type="email" name="email" placeholder="email address" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" />
<label for="password1" class="ui-hidden-accessible">Password</label>
<input class="logininput" type="password" name="password1" placeholder="password" maxlength="20" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" />
<label for="password2" class="ui-hidden-accessible">Confirm Password</label>
<input class="logininput" type="password" name="password2" placeholder="confirm password" maxlength="20" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" />

<p><input type="submit" name="registerbutton" id="registerbutton" value="Create New Account" /></p>
<!--<div id="tologin"><a href="index.php">Member Login</a></div>-->
</div>
</form>


<?php 
require ('config.inc.php');
$page_title = 'Register';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

	
	require (MYSQL);
	
	$trimmed = array_map('trim', $_POST);

	
	$un = $sid = $st = $e = $p = FALSE;
	
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['username'])) {
		$un = mysqli_real_escape_string ($dbc, $trimmed['username']);
	} else {
		echo '<p class="error">Please enter a username!</p>';
	}
	
	if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['email']);
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}

	
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password! Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>';
	}
	
	if ($un && $e && $p) { 

		
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { 

			
			$a = md5(uniqid(rand(), true));

			
			$q = "INSERT INTO users (email, pass, username, active, registration_date) VALUES ('$e', SHA1('$p'), '$un', '$a', NOW() )";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			if (mysqli_affected_rows($dbc) == 1) { 
/*
				$subject = "Thank you for registering - Your Pain Diary";
				$body = "Thank you for registering at www.paindiary.azurewebsites.net. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['email'], 'Registration Confirmation', $body, 'From: myemail@domain.com');
*/

				echo '<h3>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account. Or click the link below:<br /><a href="'.BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a".'">click here</a></h3>'; 
			
			// Send Activation Email
			

/**
 * This example shows sending a message using a local sendmail binary.
 */

require 'PHPMailer-master/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
// Set PHPMailer to use the sendmail transport
$mail->isSendmail();
//Set who the message is to be sent from
$mail->setFrom('nemrestellem@gmail.com', 'Your Pain Diary');
//Set an alternative reply-to address
$mail->addReplyTo('1407067@rgu.ac.uk', 'Your Pain Diary');
//Set who the message is to be sent to
$mail->addAddress('1407067@rgu.ac.uk');
//Set the subject line
$mail->Subject = 'PHPMailer sendmail test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('PHPMailer-master/examples/contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

 
				
				exit(); 
				
			} else { 
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}
			
		} else { 
			echo '<p class="error">That email address has already been registered. If you have forgotten your password, <a href="forgot_password.php">click here</a> to request a new one.</p>';
		}
		
	} else { 
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

} 
?>

</div>
</div>
</body>
</html>