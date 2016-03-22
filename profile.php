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
	
	$q = "SELECT user_id, username FROM users WHERE (username='".$_SESSION['username']."' AND active IS NULL";		
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
	$colourIn = $_GET['colourIn'];
	$q = "UPDATE users SET colour='". $colourIn . "' WHERE user_id={$_SESSION['user_id']}";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) {
			mysqli_close($dbc);  
			exit();
		}
}


?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $page_title; ?></title>
    
<!-- stylesheets -->
	<link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="clndr.css">

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
	echo "blue";
	?>
    <script type="text/javascript">

	</script>
    <?php
	break;
case '2':
	echo "yellow";
	break;
case '3':
	echo "red";
	break;
default:
	echo "default blue";
	break;
	}
	
}
	
$q2 = "SELECT entryyear, entrymonth, entryday FROM pain WHERE user_id='".$_SESSION['user_id']."' GROUP BY entryyear, entrymonth, entryday";
//$q2 = "SELECT COUNT(*) AS numofentries FROM pain WHERE user_id='".$_SESSION['user_id']."' GROUP BY entryyear, entrymonth, entryday";
$r2 = mysqli_query ($dbc, $q2) or trigger_error("Query: $q2\n<br />MySQL Error: " . mysqli_error($dbc));
$numofentries = 0;
if (@mysqli_num_rows($r2) > 0) { 
while($row2 = $r2->fetch_assoc()) {
	$year = $row2['entryyear'];
	$month = $row2['entrymonth'];
	$day = $row2['entryday'];
	//echo $year . " " . $month . " " . $day . " ";
	$numofentries++;
	
}
}

if(isset($_GET['edit'])) {
     if ($_GET['edit'] == "username") {
		echo "editing username"; 
	 }
	 elseif ($_GET['edit'] == "email") {
		 echo "editing email";
	 }
	 elseif ($_GET['edit'] == "password") {
		 echo "editing password";
	 }
	 if ($_GET['edit'] == "colour") {
		 echo "editing colour";
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
    <div id="chosencolour">chosen colour</div>
    <div id="choosecolour" class="hidden" onChange="colour(this)">
    <select id="csscolour" name="csscolour">
		<option value="1">blue</option>
		<option value="2">yellow</option>
		<option value="3">red</option>
	</select>
    </div>
    </td><td class="editcell">
    <div id="save" class="hidden"><a class="icon-ok nounderline" onClick="colour()"><input class="hidden" type="submit" name="colour-submit" id="colour-submit" /></a></div>
    <div id="edit"><a data-ajax='false' class='icon-edit nounderline' href='profile.php?edit=colour'></a></div>
   	</td>
</tr>
<tr><th>Registration date:</th><td class="userdata"><?php echo date_format($register, 'Y-m-d'); ?></td><td class="editcell">&nbsp;</td></tr>
<tr><th>Number of entries:</th><td class="userdata"><?php echo $numofentries ?></td><td class="editcell">&nbsp;</td></tr>
<tr><th>&nbsp;</th><td class="userdata"><a href="">Delete Account</a></td><td class="editcell">&nbsp;</td></tr>
</form>
</table>
</fieldset>
<br  />
<script type="text/javascript">
function colour() { 
	var e = document.getElementById("csscolour");
	var colourIndex = e.options[e.selectedIndex].value;
    
	switch (colourIndex) {
  case 1:
     window.location="profile.php?colourIn=1"
     break;
  case 2:
     window.location="profile.php?colourIn=2"
     break;
  case 3:
     window.location="profile.php?colourIn=3"
	 break;
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

			
			echo '<p class="success">Your password has been changed.</p>';
			mysqli_close($dbc);  
			exit();
			
		} else { 
		
			echo '<p class="error">Your password was not changed. Make sure your new password is different from the current password.</p>'; 

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


// if email address is getting changed
	
if (!empty($_POST['changeemailsubmit'])) {
	
	$e2 = FALSE;
	if (filter_var($_POST['email1'], FILTER_VALIDATE_EMAIL)) {
		if ($_POST['email1'] == $_POST['email2']) {
			$e2 = mysqli_real_escape_string ($dbc, $_POST['email1']);
		} else {
			echo '<p class="error">Your email address did not match the confirmed email address!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}
	
	
	if (!empty($_POST['email0'])) {
		$e = mysqli_real_escape_string ($dbc, $_POST['email0']);
	
	if ($e) { 

		
		$q = "UPDATE users SET email='". $e2 . "' WHERE user_id={$_SESSION['user_id']}";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) {

			
			echo '<p class="success">Your email address has been changed.</p>';
			mysqli_close($dbc);  
			exit();
			
		} else { 
		
			echo '<p class="error">Your email address was not changed. Make sure your new email address is different from the current one.</p>'; 

		}

	} else { 
		echo '<p class="error">Invalid email address. Please try again.</p>';		
	}
	
	mysqli_close($dbc); 

} 

else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your old email address!</p>';
	}
	
	
}


// if username is getting changed

if (!empty($_POST['changeusernamesubmit'])) {
	
	$u2 = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['username1']) ) {
		if ($_POST['username1'] == $_POST['username2']) {
			$u2 = mysqli_real_escape_string ($dbc, $_POST['username1']);
		} else {
			echo '<p class="error">Your username did not match the confirmed username!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid username!</p>';
	}
	
	
	if (!empty($_POST['username0'])) {
		$u = mysqli_real_escape_string ($dbc, $_POST['username0']);
	
	if ($u) { 

		
		$q = "UPDATE users SET username='". $u2 . "' WHERE user_id={$_SESSION['user_id']}";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) {

			
			echo '<p class="success">Your username has been changed.</p>';
			mysqli_close($dbc);  
			exit();
			
		} else { 
		
			echo '<p class="error">Your username was not changed. Make sure your new username is different from the current one.</p>'; 

		}

	} else { 
		echo '<p class="error">Invalid username. Please try again. Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</p>';		
	}
	
	mysqli_close($dbc); 

} 

else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your old username!</p>';
	}
	
	
}


// if colour scheme is getting changed

if (!empty($_POST['colour-submit'])) {
	echo "colour scheme got changed";
	$colour = isset($_POST['csscolour']) ? $_POST['csscolour'] : false;
		$q = "UPDATE users SET colour='". $colour . "' WHERE user_id={$_SESSION['user_id']}";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) {

			
			echo '<p class="success">Your preferred colour scheme has been changed.</p>';
			mysqli_close($dbc);  
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
    <label for="username0" class="ui-hidden-accessible">Enter Old Username</label>
<input class="logininput" type="text" name="username0" placeholder="enter old username" maxlength="40" />
<label for="username1" class="ui-hidden-accessible">Enter New Username</label>
<input class="logininput" type="text" name="username1" placeholder="enter new username" maxlength="40" />
<label for="username2" class="ui-hidden-accessible">Confirm New Username</label>
<input class="logininput" type="text" name="username2" placeholder="confirm new username" maxlength="40" />
    <br /><br /><div class="center">
    <input type="submit" name="changeusernamesubmit" value="Change Username" />
    <input type="submit" name="cancelusername" value="Cancel" />
    </div>
	</form>
</fieldset>


<fieldset id="changeemail">
<legend>Change Email Address</legend>
	<form action="profile.php" method="post">
   	<table id="changeemailtable">
    <tr><td><label>Enter Old Email Address:</label></td><td><input type="email" name="email0" maxlength="60" /></td></tr>
    <tr><td><label>Enter New Email Address:</label></td><td><input type="email" name="email1" maxlength="60" /></td></tr>
    <tr><td><label>Confirm New Email Address:</label></td><td><input type="email" name="email2" maxlength="60" /></td></tr>
    </table>
    <br /><br /><div class="center">
    <input type="submit" name="changeemailsubmit" value="Change Email Address" />
    <input type="submit" name="cancelemail" value="Cancel" />
    </div>
	</form>

</fieldset>


<fieldset id="changepassword">
<legend>Change Password</legend>
	<form action="profile.php" method="post">
   	<table id="changepasswordtable">
    <tr><td><label>Enter Old Password:</label></td><td><input type="password" name="password0" maxlength="20" /></td></tr>
    <tr><td><label>Enter New Password:</label></td><td><input type="password" name="password1" maxlength="20" /></td></tr>
    <tr><td><label>Confirm New Password:</label></td><td><input type="password" name="password2" maxlength="20" /></td></tr>
    </table>
    <br /><br /><div class="center">
    <input type="submit" name="changepasswordsubmit" value="Change Password" />
    <input type="submit" name="cancelpassword" value="Cancel" />
    </div>
	</form>
</fieldset>


<fieldset id="deleteaccount">
<legend>Delete Account</legend>
	<form action="profile.php" method="post">
This far you have created <?php echo $numofentries ?> entries. If you delete your account now, they will be lost and cannot be retrieved.
<br /> Are you sure you want to delete your account?
	<br /><br /><div class="center">
	<input type="submit" id="deleteaccount" name="deleteaccount" value="Delete Account" />
	<button type="submit" id="canceldelete" name="canceldelete">Cancel</button>
    </form>
	</div>
</fieldset>


<fieldset id="medschedule">
<legend>Medication Schedule</legend>
something
</fieldset>

</div>

</body>
</html>