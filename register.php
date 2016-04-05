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

<script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>

<div id="header">
<div id="logintitle"><a href="index.php" class="nounderline"><span class="lato900">Your</span> <span class="lato300">Pain Diary</span></a></div>
</div>

<div id="pagewraplogin">
<h1 class="outh1"><a href="index.php" class="icon-chevron-left nounderline"></a>Register</h1>
<div id="pagecontent">

<form action="register.php" method="post">
<div class="center">

<label for="username" class="ui-hidden-accessible">Username</label>
<input class="logininput" type="text" name="username" placeholder="Username" maxlength="40" value="<?php if (isset($trimmed['username'])) echo $trimmed['username']; ?>" />
<label for="email" class="ui-hidden-accessible">E-mail Address</label>
<input class="logininput" type="email" name="email" placeholder="Email Address" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" />
<label for="password1" class="ui-hidden-accessible">Password</label>
<input class="logininput" type="password" name="password1" placeholder="Password" maxlength="20" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" />
<label for="password2" class="ui-hidden-accessible">Confirm Password</label>
<input class="logininput" type="password" name="password2" placeholder="Confirm Password" maxlength="20" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" />
<div class="g-recaptcha" data-sitekey="6LdAMhsTAAAAAMX7hLpafjBh-lbVL1Pbkqohj2q7"></div>
<p><input type="submit" name="registerbutton" id="registerbutton" value="Create New Account" /></p>
<!--<div id="tologin"><a href="index.php">Member Login</a></div>-->
</div>
</form>


<?php 
require ('config.inc.php');
$page_title = 'Register';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

	$captcha;
	require (MYSQL);
	
	$trimmed = array_map('trim', $_POST);

	
	$un = $sid = $st = $e = $p = FALSE;
	
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['username'])) {
			$n = mysqli_real_escape_string ($dbc, $trimmed['username']);
			$sql = "SELECT * FROM users WHERE username= '" . $n . "'";
			$result = mysqli_query ($dbc, $sql) or trigger_error("Query: $sql\n<br />MySQL Error: " . mysqli_error($dbc));
		
			if (mysqli_num_rows($result) > 0) {
				echo '<p class="error">Sorry, this username is already taken!</p>';
			}
			else {
				$un = mysqli_real_escape_string ($dbc, $trimmed['username']);
			}
	}else {
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
	
	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<p class="error">Please check the reCaptcha form.</p>';
          exit;
        }
	$secretKey = "6LdAMhsTAAAAAMNbXZqi_puaVdJ_LJPhfj-w9g7o";
	$ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
	$responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          echo '<p class="error">You have failed the reCaptcha validation. Please try again to prove you are not a computer or bot.</p>';
        } else {
	
	if ($un && $e && $p) { 

		
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { 

			
			$a = md5(uniqid(rand(), true));
			$hash = md5( rand(0,1000) );

			
			$q = "INSERT INTO users (email, pass, username, active, registration_date, hash) VALUES ('". mysqli_real_escape_string($dbc, $e) ."', SHA1('$p'), '".mysqli_real_escape_string($dbc, $un)."', '".mysqli_real_escape_string($dbc, $a)."', NOW(), '". mysqli_real_escape_string($dbc, $hash) ."' )";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			if (mysqli_affected_rows($dbc) == 1) { 

				echo '<h3>Thank you for registering! A confirmation email has been sent to your email address. Please click on the link in the email in order to activate your account.';
				//Or click the link below:<br /><a href="'.BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a".'">click here</a></h3>'; 
			
			// Send Activation Email

require 'PHPMailer-master/PHPMailerAutoload.php';
 
$mail = new PHPMailer;
 
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'nemrestellem@gmail.com';                   // SMTP username
$mail->Password = 'gugurekasu22';               // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
$mail->SMTPDebug  = 0;								// enable SMTP authentication
$mail->setFrom('nemrestellem@gmail.com', 'Your Pain Diary');     //Set who the message is to be sent from
$mail->addReplyTo('1407067@rgu.ac.uk', 'Your Pain Diary');  //Set an alternative reply-to address
$mail->addAddress($e);               // Name is optional
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
//$mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
 
$mail->Subject = 'Welcome to Your Pain Diary!';
$mail->Body    = '<p>Thanks for signing up, '.$un.'!</p>
<p>Your account has been created. Please click this link to activate your account:</p>
<p><a href="http://paindiary.azurewebsites.net/activate.php?x='.urlencode($e).'&y='.$a.'&hash='.$hash.'">http://paindiary.azurewebsites.net/activate.php?x='.urlencode($e).'&y='.$a.'&hash='.$hash.'</a></p>
';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

//$mail->msgHTML(file_get_contents('PHPMailer-master/examples/contents.html'), dirname(__FILE__));
 
if(!$mail->send()) {
   echo '<div class="error">Message could not be sent.</div>';
   echo '<div class="error">Mailer Error: ' . $mail->ErrorInfo .'</div>';
   exit;
}
 
//echo 'Message has been sent';

 
				
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
} 
?>

</div>
</div>
</body>
</html>