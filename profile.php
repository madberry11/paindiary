<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php

ob_start();
session_start();
require ('config.inc.php'); 

if (!isset($page_title)) {
	$page_title = 'Your Pain Diary';

}

if(isset($_SESSION["username"])) {
	
}

elseif(!isset($_SESSION["username"]) && isset($_COOKIE["unm"]) && ($_SESSION["keeploggedin"] == 1)) {
	$_SESSION["username"] = $_COOKIE["unm"];
	
	$servername = "ap-cdbr-azure-east-c.cloudapp.net";
	$username = "bcac3dbe9c1d06";
	$password = "32d91723";
	$dbname = "booksapp";

	$dbc = new mysqli($servername, $username, $password, $dbname);
	
	$q = "SELECT user_id, username FROM users WHERE (user_id='".$_SESSION['user_id']."' AND active IS NULL";		
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	if (@mysqli_num_rows($r) == 1) { 
			
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
	}

}

else {
?>
<script type="text/javascript">
            window.location.href = "http://paindiary.azurewebsites.net/index.php"
        </script>
<?php	
}


if(isset($_COOKIE["unm"]) == $_SESSION["username"]) {
	$_SESSION["username"] = $_COOKIE["unm"];
}

	$servername = "ap-cdbr-azure-east-c.cloudapp.net";
	$username = "bcac3dbe9c1d06";
	$password = "32d91723";
	$dbname = "booksapp";

	$dbc = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['colourIn'])) {
	$colourIn = mysqli_real_escape_string($dbc, $_GET['colourIn']);
	$q = "UPDATE users SET colour='". $colourIn . "' WHERE user_id='".$_SESSION['user_id']."'";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) {
			mysqli_close($dbc); 
			$url = BASE_URL . 'profile.php'; 
			ob_end_clean(); 
			header("Location: $url"); 
			exit();
		}
}


?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $page_title; ?></title>
    
<!-- stylesheets -->
	<link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="colour1.css" type="text/css" id="colour1" />
    <link rel="stylesheet" href="colour2.css" type="text/css" id="colour2" />
    <link rel="stylesheet" href="colour3.css" type="text/css" id="colour3" />
    <link rel="stylesheet" href="jquery.mobile/jquery.mobile-1.4.5.css" type="text/css" />

<!-- JavaScript / JQuery -->
	<script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.js"></script>
    <script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
    <script src="json2.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
    <script src="moment-2.8.3.js"></script>
  	<script src="clndr.js"></script>
 	<script src="site.js"></script>

<!-- fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ruda:700' rel='stylesheet' type='text/css'>


<script type="text/javascript">
var myInterval = setTimeout("location=('index.php');",3600000);
</script>  

<?php

$q = "SELECT user_id, username, email, pass, registration_date, colour FROM users WHERE user_id='".$_SESSION['user_id']."' AND active IS NULL";		
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	if (@mysqli_num_rows($r) == 1) { 
	$row = mysqli_fetch_assoc($r);
	$username=$row['username'];
	$register=new DateTime($row['registration_date']);
	$email=$row['email'];
	$password=$row['pass'];
	$colour=$row['colour'];
	
	switch($colour) {
case '1':
	$chosen="Blue";
	?>
    <script type="text/javascript">
    document.getElementById('colour1').disabled = false;
    document.getElementById('colour2').disabled = true;
	document.getElementById('colour3').disabled = true;
	</script>
    <?php
	break;
case '2':
	$chosen="Green";
		?>
	<script type="text/javascript">
    document.getElementById('colour1').disabled = true;
    document.getElementById('colour2').disabled = false;
	document.getElementById('colour3').disabled = true;
	</script>
    <?php
	break;
case '3':
	$chosen="Purple";
	?>
	<script type="text/javascript">
    document.getElementById('colour1').disabled = true;
    document.getElementById('colour2').disabled = true;
	document.getElementById('colour3').disabled = false;
	</script>
    <?php
	break;
default:
	$chosen="Blue";
		?>
	<script type="text/javascript">
    document.getElementById('colour1').disabled = false;
    document.getElementById('colour2').disabled = true;
	document.getElementById('colour3').disabled = true;
	</script>
    <?php
	break;
	}
	
}
?>
  
</head>

<body>

<div id="header">
<div id="title"><a href="home.php" class="nounderline"><span class="lato900">Your</span> <span class="lato300">Pain Diary</span></a></div>
<ul id="navbar">
<li><a href="home.php" class="nounderline">Home</a></li>
<li class="activetab"><a href="profile.php" class="nounderline">Profile</a></li>
<li><a data-ajax="false" href="logout.php" class="nounderline">Logout</a></li>
</ul>
</div>
<br clear="both" />
<div id="divider"></div>

<div id="pagewrap">
<h1>User Profile</h1>
<?php
	
$q2 = "SELECT entryyear, entrymonth, entryday FROM pain WHERE user_id='".$_SESSION['user_id']."' GROUP BY entryyear, entrymonth, entryday";
$r2 = mysqli_query ($dbc, $q2) or trigger_error("Query: $q2\n<br />MySQL Error: " . mysqli_error($dbc));
$numofentries = 0;
if (@mysqli_num_rows($r2) > 0) { 
while($row2 = $r2->fetch_assoc()) {
	$year = $row2['entryyear'];
	$month = $row2['entrymonth'];
	$day = $row2['entryday'];
	$numofentries++;
	
}
}

if(isset($_GET['edit'])) {
     if (mysqli_real_escape_string($dbc, $_GET['edit']) == "username") {
		$editthis = 2;
	 }
	 elseif (mysqli_real_escape_string($dbc, $_GET['edit']) == "email") {
		$editthis = 3;
	 }
	 elseif (mysqli_real_escape_string($dbc, $_GET['edit']) == "password") {
		 $editthis = 4;
	 }
	 elseif (mysqli_real_escape_string($dbc, $_GET['edit']) == "colour") {
		 $editthis = 1;
		 ?>
     <script>
	 $(document).ready(function(){
	 $("#save").css("display", "block");
	 $("#edit").css("display", "none");
	 $("#choosecolour").css("display", "block");
	 $("#chosencolour").css("display", "none");
	 });
	 </script>
     <?php
	 }
	 elseif (mysqli_real_escape_string($dbc, $_GET['edit']) == "delete"){
		 $editthis = 5;
	 }
}
else {
	$editthis = 1;	
}


?>
<fieldset id="userdetails">
<legend>User Details</legend>
<table class="usertable">
<tr><th>Username:</th><td class="userdata"> <?php echo $username ?></td><td class="editcell"><a data-ajax='false' class='icon-edit nounderline' href='profile.php?edit=username'></a></td></tr>
<tr><th>Email address:</th><td class="userdata"><?php echo $email ?></td><td class="editcell"><a data-ajax='false' class='icon-edit nounderline' href='profile.php?edit=email'></a></td></tr>
<tr><th>Password:</th><td class="userdata"><a data-ajax='false' href='profile.php?edit=password'>Change Password</a></td><td class="editcell"><a data-ajax='false' class='icon-edit nounderline' href='profile.php?edit=password'></a></td></tr>
<tr><th>Colour scheme:</th>
<form id="colourform" name="colourform" action="profile.php" method="post">
	<td class="userdata">
    <div id="chosencolour"><?php echo $chosen ?></div>
    <div id="choosecolour" class="hidden">
    <select id="csscolour" name="csscolour">
		<option value="1">Blue</option>
		<option value="2">Green</option>
		<option value="3">Purple</option>
	</select>
    </div>
    </td><td class="editcell">
    <div id="save" class="hidden"><a class="icon-ok nounderline" onClick="colour()"><input class="hidden" type="submit" name="colour-submit" id="colour-submit" /></a></div>
    <div id="edit"><a data-ajax='false' class='icon-edit nounderline' href='profile.php?edit=colour'></a></div>
   	</td>
</tr>
<tr><th>Registration date:</th><td class="userdata"><?php echo date_format($register, 'Y-m-d'); ?></td><td class="editcell">&nbsp;</td></tr>
<tr><th>Number of entries:</th><td class="userdata"><?php echo $numofentries ?></td><td class="editcell">&nbsp;</td></tr>
<tr><th>&nbsp;</th><td class="userdata"><a href="profile.php?edit=delete">Delete Account</a></td><td class="editcell">&nbsp;</td></tr>
</form>
</table>
</fieldset>
<br  />
<script type="text/javascript">
function colour() { 
	var e = document.getElementById("csscolour");
	var colourIndex = e.options[e.selectedIndex].value;
    
	switch (colourIndex) {
  case '1':
     window.location="profile.php?colourIn=1";
     break;
  case '2':
     window.location="profile.php?colourIn=2";
     break;
  default:
     window.location="profile.php?colourIn=3";
}
}
</script>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	
	
// if cancel button was clicked

if ((!empty($_POST['canceldelete'])) OR (!empty($_POST['cancelpassword'])) OR (!empty($_POST['cancelemail'])) OR (!empty($_POST['cancelusername']))) {
	
	$url = BASE_URL . 'profile.php'; 
	ob_end_clean(); 
	header("Location: $url");	
}	
	
	
	
// if password is getting changed
	
if (!empty($_POST['changepasswordsubmit'])) {
	
if ((preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) AND (preg_match ('/^(\w){4,20}$/', $_POST['password2'])) ) {
		$safe_password1 = mysqli_real_escape_string ($dbc, $_POST['password1']);
		$safe_password2 = mysqli_real_escape_string ($dbc, $_POST['password2']);
		if ($safe_password1 == $safe_password2) {
			$p = $safe_password1;
		} else {
			$p = "";
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		$p = "";
		echo '<p class="error">Please enter a valid password! Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>';
}
	
	
if (!empty($_POST['password0'])) {
		$pass = mysqli_real_escape_string ($dbc, $_POST['password0']);
		$q = "SELECT user_id, pass FROM users WHERE (user_id=".$_SESSION['user_id']." AND pass=SHA1(".'$pass'."))";
		echo $q;
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (@mysqli_num_rows($r) == 1) {
			$p = $pass;
		}
		else {
			echo @mysqli_num_rows($r);
			echo "<p class='error'>The old password is incorrect.</p>";
			$p = "";
		}
	
	if ((!empty($p)) AND (!empty($p2))) { 

		
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id='".$_SESSION['user_id']."' LIMIT 1";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) {
			
			$url = BASE_URL . 'profile.php'; 
			ob_end_clean(); 
			header("Location: $url");
			mysqli_close($dbc);  
			echo '<p class="success">Your password has been changed.</p>';
			exit();
			
		} else { 
		
			echo '<p class="error">Your password was not changed. Make sure your new password is different from the current password.</p>'; 

		}
	
	}
	
	mysqli_close($dbc); 

} 

elseif (empty($p)) {
		$e = FALSE;
		echo '<p class="error">You forgot to enter your old password!</p>';
	}
	
elseif (empty($p2)) {
		$p = FALSE;
		echo '<p class="error">You need to enter the new password twice!</p>';
	}
	
	
}
	


// if email address is getting changed
	
if (!empty($_POST['changeemailsubmit'])) {
	
	
	$e2 = FALSE;
	if ((filter_var($_POST['email1'], FILTER_VALIDATE_EMAIL)) AND (filter_var($_POST['email2'], FILTER_VALIDATE_EMAIL))) {
		$safe_email1 = mysqli_real_escape_string ($dbc, $_POST['email1']);
		$safe_email2 = mysqli_real_escape_string ($dbc, $_POST['email2']);
		if ($safe_email1 == $safe_email2) {
			$q = "SELECT user_id FROM users WHERE email='".$safe_email1."'";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
				if (@mysqli_num_rows($r) == 1) {
					echo '<p class="error">Sorry, this email address is already registered with an account!</p>';
				}
				else {
					$e2 = $safe_email1;
				}
		} else {
			echo '<p class="error">Your email address did not match the confirmed email address!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}
	
	if (!empty($_POST['email0'])) {
		$oldmail = mysqli_real_escape_string ($dbc, $_POST['email0']);
		$q= "SELECT user_id FROM users WHERE email='".$oldmail."'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (@mysqli_num_rows($r) == 1) {
			$e = $oldmail;
		}
		else {
			echo "<p class='error'>The old email address is incorrect.</p>";
			$e = "";
		}
	
	if ((!empty($e)) AND (!empty($e2))) { 

		
		$q = "UPDATE users SET email='". $e2 . "' WHERE user_id='".$_SESSION['user_id']."'";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) {

			
			$url = BASE_URL . 'profile.php'; 
			ob_end_clean(); 
			header("Location: $url");
			mysqli_close($dbc);  
			echo '<p class="success">Your email address has been changed.</p>';
			exit();
			
		} else { 
		
			echo '<p class="error">Your email address was not changed. Please make sure your new email address is different from the current one.</p>'; 

		}
	}
	
	mysqli_close($dbc); 

} 

elseif (empty($e)) {
		$e = FALSE;
		echo '<p class="error">You forgot to enter your old email address!</p>';
	}
	
elseif (empty($e2)) {
		$p = FALSE;
		echo '<p class="error">You need to enter the new email address twice!</p>';
	}
	
	
}


// if username is getting changed

if (!empty($_POST['changeusernamesubmit'])) {
	
	$u2 = FALSE;
	if ((preg_match ('/^(\w){4,20}$/', $_POST['username1']) ) AND (preg_match ('/^(\w){4,20}$/', $_POST['username2']))) {
		$safe_username1 = mysqli_real_escape_string ($dbc, $_POST['username1']);
		$safe_username2 = mysqli_real_escape_string ($dbc, $_POST['username2']);
		if ($safe_username1 == $safe_username2) {
			$q = "SELECT user_id FROM users WHERE username='".$safe_username1."'";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
				if (@mysqli_num_rows($r) == 1) {
					echo '<p class="error">Sorry, this username is already taken!</p>';
				}
				else {
					$u2 = $safe_username1;
				}
		} else {
			echo '<p class="error">Your new username did not match the confirmed username!</p>';
		}
	} else {
		echo "<p class='error'>Invalid username. Please try again. Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>";
	}
	
	
	if (!empty($_POST['username0'])) {
		$user = mysqli_real_escape_string ($dbc, $_POST['username0']);
		$q= "SELECT user_id FROM users WHERE username='".$user."'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (@mysqli_num_rows($r) == 1) {
			$u = $user;
		}
		else {
			echo "<p class='error'>The old username is incorrect.</p>";
			$u = "";
		}
	
	if ((!empty($u)) AND (!empty($u2))) { 

		
		$q = "UPDATE users SET username='". $u2 . "' WHERE user_id='".$_SESSION['user_id']."'";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) {

			
			$url = BASE_URL . 'profile.php'; 
			ob_end_clean(); 
			header("Location: $url");
			mysqli_close($dbc);  
			echo '<p class="success">Your username has been changed.</p>';
			exit();
			
		} else { 
		
			echo '<p class="error">Your username was not changed. Make sure your new username is different from the current one.</p>'; 

		}
	}
	
	mysqli_close($dbc); 

} 

elseif (empty($u)) {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your old username!</p>';
	}
elseif (empty($u2)) {
		$p = FALSE;
		echo '<p class="error">You need to enter the new username twice!</p>';
	}
	
	
}


// if colour scheme is getting changed

if (!empty($_POST['colour-submit'])) {
	echo "colour scheme got changed";
	$colour = isset($_POST['csscolour']) ? $_POST['csscolour'] : false;
		$q = "UPDATE users SET colour='". $colour . "' WHERE user_id='".$_SESSION['user_id']."'";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) {

			
			$url = BASE_URL . 'profile.php'; 
			ob_end_clean(); 
			header("Location: $url");
			mysqli_close($dbc);  
			echo '<p class="success">Your preferred colour scheme has been changed.</p>';
			exit();
		}
}


// if the account is getting deleted
	
if (!empty($_POST['deleteaccount'])) {
	
		$q = "DELETE FROM pain WHERE user_id={$_SESSION['user_id']}";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		$q2 = "DELETE FROM painrelief WHERE user_id={$_SESSION['user_id']}";
		$r2 = mysqli_query ($dbc, $q2) or trigger_error("Query: $q2\n<br />MySQL Error: " . mysqli_error($dbc));
		$q3 = "DELETE FROM comments WHERE user_id={$_SESSION['user_id']}";
		$r3 = mysqli_query ($dbc, $q3) or trigger_error("Query: $q3\n<br />MySQL Error: " . mysqli_error($dbc));
		$q4 = "DELETE FROM important WHERE user_id={$_SESSION['user_id']}";
		$r4 = mysqli_query ($dbc, $q4) or trigger_error("Query: $q4\n<br />MySQL Error: " . mysqli_error($dbc));
		// place for scheduled medicine table
		$q6 = "DELETE FROM users WHERE user_id={$_SESSION['user_id']}";
		$r6 = mysqli_query ($dbc, $q6) or trigger_error("Query: $q6\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) > 0) {

			
			$url = BASE_URL . 'index.php'; 
			ob_end_clean(); 
			header("Location: $url");
			mysqli_close($dbc);  
			exit();
			
		} else { 
		
			echo '<p class="error">Your account could not be deleted due to a system error.</p>'; 

		}	
	
	
}

}


?>


<fieldset id="changeusername">
<legend>Change Username</legend>
	<form action="profile.php" method="post">
    <table class="usertable">
	<tr><th>Enter Old Username:</th><td class="userdata2"><input class="logininput prof2" type="text" name="username0" /></td><td class="editcell2">&nbsp;</td></tr>
	<tr><th>Enter New Username:</th><td class="userdata2"><input class="logininput prof2" type="text" name="username1" /></td><td class="editcell2">&nbsp;</td></tr>
	<tr><th>Confirm New Username:</th><td class="userdata2"><input class="logininput prof2" type="text" name="username2" /></td><td class="editcell2">&nbsp;</td></tr>
    </table>
   	<div class="center2">
    <input type="submit" name="changeusernamesubmit" value="Change Username" />
    <input type="submit" name="cancelusername" value="Cancel" />
    </div>
	</form>
</fieldset>


<fieldset id="changeemail">
<legend>Change Email Address</legend>
	<form action="profile.php" method="post">
    <table class="usertable">
	<tr><th>Enter Old Email Address:</th><td class="userdata2"><input class="logininput prof2" type="email" name="email0" maxlength="60" /></td><td class="editcell2">&nbsp;</td></tr>
	<tr><th>Enter New Email Address:</th><td class="userdata2"><input class="logininput prof2" type="email" name="email1" maxlength="60" /></td><td class="editcell2">&nbsp;</td></tr>
	<tr><th>Confirm New Email Address:</th><td class="userdata2"><input class="logininput prof2" type="email" name="email2" maxlength="60" /></td><td class="editcell2">&nbsp;</td></tr>
    </table>
    <div class="center2">
    <input type="submit" name="changeemailsubmit" value="Change Email Address" />
    <input type="submit" name="cancelemail" value="Cancel" />
    </div>
	</form>

</fieldset>


<fieldset id="changepassword">
<legend>Change Password</legend>
	<form action="profile.php" method="post">
    <table class="usertable">
	<tr><th>Enter Old Password:</th><td class="userdata2"><input class="logininput prof2" type="password" name="password0" maxlength="20" /></td><td class="editcell2">&nbsp;</td></tr>
	<tr><th>Enter New Password:</th><td class="userdata2"><input class="logininput prof2" type="password" name="password1" maxlength="20" /></td><td class="editcell2">&nbsp;</td></tr>
	<tr><th>Confirm New Password:</th><td class="userdata2"><input class="logininput prof2" type="password" name="password2" maxlength="20" /></td><td class="editcell2">&nbsp;</td></tr>
    </table>
	<div class="center2">
    <input type="submit" name="changepasswordsubmit" value="Change Password" />
    <input type="submit" name="cancelpassword" value="Cancel" />
    </div>
	</form>
</fieldset>


<fieldset id="deleteaccount">
<legend>Delete Account</legend>
	<form action="profile.php" method="post">
<div class="indent">This far you have created <?php echo $numofentries ?> entries. If you delete your account now, they will be lost and cannot be retrieved.
<br /> Are you sure you want to delete your account?</div>
	<br /><br /><div class="center">
	<input type="submit" id="deleteuser" name="deleteaccount" value="Delete Account" placeholder="Delete Account" />
	<button type="submit" id="canceldelete" name="canceldelete">Cancel</button>
    </form>
	</div>
</fieldset>


<fieldset id="medschedule">
<legend>Medication Schedule</legend>
something
</fieldset>

</div>
<?php


switch($editthis) {
case '1' :
	//echo "Nothing is getting edited.";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('changeusername').style.display = "none";
	document.getElementById('changeemail').style.display = "none";
	document.getElementById('changepassword').style.display = "none";
	document.getElementById('deleteaccount').style.display = "none";
	document.getElementById('medschedule').style.display = "none";
	}
	</script>
    <?php
	break;
case '2' :
	//echo "Username is getting edited";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('changeusername').style.display = "block";
	document.getElementById('changeemail').style.display = "none";
	document.getElementById('changepassword').style.display = "none";
	document.getElementById('deleteaccount').style.display = "none";
	document.getElementById('medschedule').style.display = "none";
	}
	</script>
    <?php
	break;
case '3' :
	//echo "Email address is getting edited.";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('changeusername').style.display = "none";
	document.getElementById('changeemail').style.display = "block";
	document.getElementById('changepassword').style.display = "none";
	document.getElementById('deleteaccount').style.display = "none";
	document.getElementById('medschedule').style.display = "none";
	}
	</script>
    <?php
	break;
case '4' :
	//echo "Password is getting edited.";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('changeusername').style.display = "none";
	document.getElementById('changeemail').style.display = "none";
	document.getElementById('changepassword').style.display = "block";
	document.getElementById('deleteaccount').style.display = "none";
	document.getElementById('medschedule').style.display = "none";
	}
	</script>
    <?php
	break;
case '5' :
	//echo "Account is getting deleted.";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('changeusername').style.display = "none";
	document.getElementById('changeemail').style.display = "none";
	document.getElementById('changepassword').style.display = "none";
	document.getElementById('deleteaccount').style.display = "block";
	document.getElementById('medschedule').style.display = "none";	
	}
	</script>
    <?php
    break;
default:
?>
	<script type="text/javascript">
	document.getElementById('changeusername').style.display = "none";
	document.getElementById('changeemail').style.display = "none";
	document.getElementById('changepassword').style.display = "none";
	document.getElementById('deleteaccount').style.display = "none";
	document.getElementById('medschedule').style.display = "none";
	</script>
    <?php
    break;
}
?>


</body>
</html>