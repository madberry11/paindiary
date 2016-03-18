
<link rel="stylesheet" href="style.css" type="text/css" />
<div id="pagewraplogin">
<h1>Reset Password</h1>
<div id="pagecontent">

Please enter your email address. 
<form action="forgot_password.php" method="post">
	<p><input type="text" name="email" size="50" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /><input style="margin-left: 5px" type="submit" name="submit" value="Reset My Password" /></p>
</form>

<?php 
require ('config.inc.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	
	$uid = FALSE;

	
	if (!empty($_POST['email'])) {

		
		$q = 'SELECT user_id, username FROM users WHERE email="'.  mysqli_real_escape_string ($dbc, $_POST['email']) . '"';
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_num_rows($r) == 1) { 
		while ($row = mysqli_fetch_array($r)) {
			list($uid) = mysqli_fetch_array ($r, MYSQLI_NUM); 
			$username = $row['username'];
			echo "yesyes";
		}
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
$mail->addAddress(mysqli_real_escape_string ($dbc, $_POST['email']));               // Name is optional
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
//$mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
 
$mail->Subject = 'Reset Password';
$mail->Body    = '<p>Hi '.$username.'.</p>
<p>You have requested a new password for accessing Your Pain Diary. Your password has been temporarily changed to '. $p .'. Please log in using this password, then you may change it to something more familiar by clicking on the "Change Password" link on the Profile page.</p>
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
else {	
			echo '<div class="success">Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link on the Profile page.</div></div></div>';
			mysqli_close($dbc);
}
			
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
</div>
</div>