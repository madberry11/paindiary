<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php

ob_start();
session_start();
require ('config.inc.php'); 

$todayday = date("j");
$todaymonth = date("n");
$todayyear = date("Y");
//echo $todayday . " " . $todaymonth . " " . $todayyear;

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


?>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $page_title; ?></title>
    
<!-- stylesheets -->
	<link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="colour1.css" type="text/css" id="colour1" />
    <link rel="stylesheet" href="colour2.css" type="text/css" id="colour2" />
    <link rel="stylesheet" href="colour3.css" type="text/css" id="colour3" />
    <link rel="stylesheet" href="clndr.css">

<!-- JavaScript / JQuery -->
	<script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.js"></script>
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
<li class="activetab"><a href="home.php" class="nounderline">Home</a></li>
<li><a href="profile.php" class="nounderline">Profile</a></li>
<li><a data-ajax="false" href="logout.php" class="nounderline">Logout</a></li>
</ul>
</div>
<br clear="both" />
<div id="divider"></div>
<div id="pagewrap">

<?php
$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "bcac3dbe9c1d06";
$password = "32d91723";
$dbname = "booksapp";

$dbc = new mysqli($servername, $username, $password, $dbname);

if (isset($_SESSION['keeploggedin'])) {
	?>
	<script type="text/javascript">
	clearTimeout(myInterval);
	</script>
    <?php
}

if (isset($_GET['active'])) {
$_SESSION['active'] = $_GET['active'];
$active = $_SESSION['active'];

if ($_GET['active'] == "allpain") {
$whichquery = "allpain";}
else { $whichquery = "bodypart";}
// echo $active;
}

elseif ((!isset($_GET['active'])) AND (isset($_SESSION['active']))) {
$_SESSION['active'] = $_SESSION['active'];
$active = $_SESSION['active'];

if ($_SESSION['active'] == "allpain") {
$whichquery = "allpain";}
else { $whichquery = "bodypart";}
// echo $active;
}

else { 
$active='allpain';
// echo $active;
$whichquery = "allpain";
}


if (isset($_SESSION['calmonth'])) {
	$calmonth = $_SESSION['calmonth'];
	$calyear = $_SESSION['calyear'];
}

if(isset($_GET['calday'])) {
     $day = $_GET['calday'] - $_GET['startday'] + 1;
	 $_SESSION['day'] = $_GET['calday'] - $_GET['startday'] + 1;
}

if (isset($_SESSION['first_name'])) { //Session based on correct First Name
	//echo "{$_SESSION['first_name']}";
}
?>
<!--<h1>Calendar</h1>-->

<?php
$monthNames = Array("January", "February", "March", "April", "May", "June", "July", 
"August", "September", "October", "November", "December");
?>
<?php
if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");
?>
<?php
$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];

	$q = "SELECT user_id, colour FROM users WHERE user_id='".$_SESSION['user_id']."' AND active IS NULL";		
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	if (@mysqli_num_rows($r) == 1) { 
	$row = mysqli_fetch_assoc($r);
	$colour=$row['colour'];
	
	switch($colour) {
case '1':
	?>
    <script type="text/javascript">
    document.getElementById('colour1').disabled = false;
    document.getElementById('colour2').disabled = true;
	document.getElementById('colour3').disabled = true;
	</script>
    <?php
	break;
case '2':
		?>
	<script type="text/javascript">
    document.getElementById('colour1').disabled = true;
    document.getElementById('colour2').disabled = false;
	document.getElementById('colour3').disabled = true;
	</script>
    <?php
	break;
case '3':
	?>
	<script type="text/javascript">
    document.getElementById('colour1').disabled = true;
    document.getElementById('colour2').disabled = true;
	document.getElementById('colour3').disabled = false;
	</script>
    <?php
	break;
default:
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

$sql = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ;
$result = $dbc->query($sql);
if ($result -> num_rows > 0) {
	
	
     // output data of each row
     while($row = $result->fetch_assoc()) {
		 //echo $row['entryid'];
	 }
}
else {
?>
<script type="text/javascript">
window.onload = function() {
document.getElementById('allpain').style.display = "none";
}
</script>
<?php
}
 
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
?>
<div id="monthnav">
<a data-ajax="false" href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>" class="nounderline"><div class="monthnavcell" id="previous"> Previous</div></a>
<div class="monthnavcell" id="thismonth">
<?php echo $monthNames[$cMonth-1].' '.$cYear; ?>
</div>
<a data-ajax="false" href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>" class="nounderline"><div class="monthnavcell" id="next">Next</div></a>
</div>


<div id="monthlytags">
<ul id="monthly">
<?php
$sql = "SELECT *, COUNT(entryid) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ;
$result = $dbc->query($sql);
if ($result -> num_rows > 0) {

	while($row = $result->fetch_assoc()) {
echo "<a data-ajax='false' onclick='allfunc()' href='home.php?active=allpain&month=$cMonth&year=$cYear'><li id='allpain'> all entries (". $row['COUNT(entryid)'] .")</li></a>";
	}
$sql2 = "SELECT bodypart, COUNT(entryid) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth . " GROUP BY bodypart";
$result2 = $dbc->query($sql2);
if ($result2 -> num_rows > 0) {
	while($row = $result2->fetch_assoc()) {
		$bodypart = $row['bodypart'];
echo "<a data-ajax='false' href='home.php?active=$bodypart&month=$cMonth&year=$cYear'><li id='".$bodypart."'>" . $row['bodypart'] . " (". $row['COUNT(entryid)'] .")</li></a>";
if ($bodypart == $active) {
	?>
    <script type="text/javascript">
	document.getElementById("<?php echo $bodypart ?>").className = "selected";
	</script>
    <?php
}

if ($active == 'allpain' ) {
?>
    <script type="text/javascript">
	document.getElementById("allpain").className = "selected";
	</script>
    <?php	
}

	?>
    <script type="text/javascript"> 
	//document.getElementById('<?php echo $bodypart ?>').style.display = "none";
	function chooseactive() {
		window.location.reload();
	}
	
	var choose = document.querySelectorAll('.chooseactive');
for (var i = 0; i < choose.length; i++) {
    choose[i].addEventListener('click', function(event) {
		window.location.reload();
        }
    });
}
	</script>   
    <?php
}
}
}

?>
</ul>
</div>
<?php
if (($todayyear == $cYear) AND ($todaymonth == $cMonth)) {
?>
<table id="calendar">
<tr>
<th>S</th>
<th>M</th>
<th>T</th>
<th>W</th>
<th>T</th>
<th>F</th>
<th>S</th>
</tr>
<?php 
$sql = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ;
$result = $dbc->query($sql);
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
	
		$thisday = $i - $startday + 1;
		
if ($thisday == $todayday) {

switch($whichquery) {
		
case 'allpain':
	//echo " case all entries";
	$sql = "SELECT entryday, AVG(avgpain) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ." AND entryday =" . $thisday  ;
	$result = $dbc->query($sql);

	break;
case 'bodypart':
	 //echo " case " . $active;
	 if(!isset($_SESSION['active'])) {
		 //echo "It is really not set.";
	 }
	$sql2 = "SELECT entryday, AVG(avgpain) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ." AND entryday =" . $thisday . " AND bodypart = '" . $_SESSION['active'] . "'" ;
	 //echo $sql2;
	$result = mysqli_query ($dbc, $sql2) or trigger_error("Query: $sql2\n<br />MySQL Error: " . mysqli_error($dbc));
	break;
	
	
default:
	//echo " case default";
	$sql = "SELECT entryday, AVG(avgpain) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ." AND entryday =" . $thisday  ;
	$result = $dbc->query($sql);
	break;
}

	if ($result == FALSE) {
		// "Something is wrong."
	}
	
	elseif ($result -> num_rows > 0) {
     while($row = $result->fetch_assoc()) {
		 // if there's an entry for this day
		 if ($row['entryday'] == $thisday) {
			 //echo $row['entryday'];
			 
			 	$query = "SELECT important_id FROM important WHERE entryyear=". $cYear ." AND entrymonth=". $cMonth ." AND entryday=". $thisday ." AND user_id=". $_SESSION['user_id'];
	mysqli_query($dbc,$query) or die(mysqli_error($dbc));
	$r = $dbc->query($query);
	if ($r -> num_rows == 1) {
		//echo "yes";
			 
			 if ($row['AVG(avgpain)'] < 0.95) {
			 $thisday = "<div class='daynumber today'>" . $thisday . "</div><div class='iconshere l1'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			 }
			elseif (($row['AVG(avgpain)'] >= 0.95) && ($row['AVG(avgpain)'] < 1.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l2'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 1.95) && ($row['AVG(avgpain)'] < 2.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l3'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 2.95) && ($row['AVG(avgpain)'] < 3.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l4'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 3.95) && ($row['AVG(avgpain)'] < 4.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l5'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 4.95) && ($row['AVG(avgpain)'] < 5.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l6'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 5.95) && ($row['AVG(avgpain)'] < 6.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l7'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 6.95) && ($row['AVG(avgpain)'] < 7.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l8'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 7.95) && ($row['AVG(avgpain)'] < 8.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l9'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 8.95) && ($row['AVG(avgpain)'] <= 10)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l10'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
	}
	elseif ($r -> num_rows == 0) {
		//echo "no";
			 
			 if ($row['AVG(avgpain)'] < 0.95) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l1'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			 }
			elseif (($row['AVG(avgpain)'] >= 0.95) && ($row['AVG(avgpain)'] < 1.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l2'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 1.95) && ($row['AVG(avgpain)'] < 2.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l3'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 2.95) && ($row['AVG(avgpain)'] < 3.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l4'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 3.95) && ($row['AVG(avgpain)'] < 4.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l5'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 4.95) && ($row['AVG(avgpain)'] < 5.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l6'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 5.95) && ($row['AVG(avgpain)'] < 6.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l7'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 6.95) && ($row['AVG(avgpain)'] < 7.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l8'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 7.95) && ($row['AVG(avgpain)'] < 8.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l9'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 8.95) && ($row['AVG(avgpain)'] <= 10)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l10'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
	}
			
		 }
				 
	 }
}
?>
<?php
	
    if(($i % 7) == 0 )  {echo "<tr>"; }
    if($i < $startday) {echo "<td></td>";}
	
	
    // for cells in the table that have days in them
    else { 
		
		 echo "<td title='Create/Edit Entry' class='actualday'><a data-ajax='false' href='newentry.php?calday=$i&startday=$startday'  class='nounderline'><div class='daynumber'>" . $thisday . "</div></a></td>";
		 if(($i % 7) == 6 ) echo "</tr>";
	}
		 
}
else {
switch($whichquery) {
		
case 'allpain':
	//echo " case all entries";
	$sql = "SELECT entryday, AVG(avgpain) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ." AND entryday =" . $thisday  ;
	$result = $dbc->query($sql);

	break;
case 'bodypart':
	 //echo " case " . $active;
	 if(!isset($_SESSION['active'])) {
		 //echo "It is really not set.";
	 }
	$sql2 = "SELECT entryday, AVG(avgpain) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ." AND entryday =" . $thisday . " AND bodypart = '" . $_SESSION['active'] . "'" ;
	 //echo $sql2;
	$result = mysqli_query ($dbc, $sql2) or trigger_error("Query: $sql2\n<br />MySQL Error: " . mysqli_error($dbc));
	break;
	
	
default:
	//echo " case default";
	$sql = "SELECT entryday, AVG(avgpain) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ." AND entryday =" . $thisday  ;
	$result = $dbc->query($sql);
	break;
}

	if ($result == FALSE) {
		// "Something is wrong."
	}
	
	elseif ($result -> num_rows > 0) {
     while($row = $result->fetch_assoc()) {
		 // if there's an entry for this day
		 if ($row['entryday'] == $thisday) {
			 //echo $row['entryday'];
			 
			 	$query = "SELECT important_id FROM important WHERE entryyear=". $cYear ." AND entrymonth=". $cMonth ." AND entryday=". $thisday ." AND user_id=". $_SESSION['user_id'];
	mysqli_query($dbc,$query) or die(mysqli_error($dbc));
	$r = $dbc->query($query);
	if ($r -> num_rows == 1) {
		//echo "yes";
			 
			 if ($row['AVG(avgpain)'] < 0.95) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l1'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			 }
			elseif (($row['AVG(avgpain)'] >= 0.95) && ($row['AVG(avgpain)'] < 1.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l2'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 1.95) && ($row['AVG(avgpain)'] < 2.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l3'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 2.95) && ($row['AVG(avgpain)'] < 3.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l4'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 3.95) && ($row['AVG(avgpain)'] < 4.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l5'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 4.95) && ($row['AVG(avgpain)'] < 5.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l6'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 5.95) && ($row['AVG(avgpain)'] < 6.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l7'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 6.95) && ($row['AVG(avgpain)'] < 7.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l8'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 7.95) && ($row['AVG(avgpain)'] < 8.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l9'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 8.95) && ($row['AVG(avgpain)'] <= 10)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l10'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
	}
	elseif ($r -> num_rows == 0) {
		//echo "no";
			 
			 if ($row['AVG(avgpain)'] < 0.95) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l1'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			 }
			elseif (($row['AVG(avgpain)'] >= 0.95) && ($row['AVG(avgpain)'] < 1.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l2'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 1.95) && ($row['AVG(avgpain)'] < 2.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l3'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 2.95) && ($row['AVG(avgpain)'] < 3.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l4'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 3.95) && ($row['AVG(avgpain)'] < 4.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l5'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 4.95) && ($row['AVG(avgpain)'] < 5.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l6'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 5.95) && ($row['AVG(avgpain)'] < 6.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l7'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 6.95) && ($row['AVG(avgpain)'] < 7.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l8'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 7.95) && ($row['AVG(avgpain)'] < 8.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l9'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 8.95) && ($row['AVG(avgpain)'] <= 10)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l10'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
	}
			
		 }
				 
	 }
}
?>
<?php
	
    if(($i % 7) == 0 )  {echo "<tr>"; }
    if($i < $startday) {echo "<td></td>";}
	
	
    // for cells in the table that have days in them
    else { 
		
		 echo "<td title='Create/Edit Entry' class='actualday'><a data-ajax='false' href='newentry.php?calday=$i&startday=$startday'  class='nounderline'><div class='daynumber'>" . $thisday . "</div></a></td>";
		 if(($i % 7) == 6 ) echo "</tr>";
	}
		 
}	
}
?>
</tr>
</table>
<?php
}
else {
	?>
<table id="calendar">
<tr>
<th>S</th>
<th>M</th>
<th>T</th>
<th>W</th>
<th>T</th>
<th>F</th>
<th>S</th>
</tr>
<?php 
$sql = "SELECT * FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ;
$result = $dbc->query($sql);
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
	
		$thisday = $i - $startday + 1;
	

switch($whichquery) {
		
case 'allpain':
	//echo " case all entries";
	$sql = "SELECT entryday, AVG(avgpain) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ." AND entryday =" . $thisday  ;
	$result = $dbc->query($sql);

	break;
case 'bodypart':
	 //echo " case " . $active;
	 if(!isset($_SESSION['active'])) {
		 //echo "It is really not set.";
	 }
	$sql2 = "SELECT entryday, AVG(avgpain) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ." AND entryday =" . $thisday . " AND bodypart = '" . $_SESSION['active'] . "'" ;
	 //echo $sql2;
	$result = mysqli_query ($dbc, $sql2) or trigger_error("Query: $sql2\n<br />MySQL Error: " . mysqli_error($dbc));
	break;
	
	
default:
	//echo " case default";
	$sql = "SELECT entryday, AVG(avgpain) FROM pain WHERE user_id="  . $_SESSION['user_id'] . " AND entryyear = " . $cYear . " AND entrymonth = " . $cMonth ." AND entryday =" . $thisday  ;
	$result = $dbc->query($sql);
	break;
}

	if ($result == FALSE) {
	 //echo " no problem";
	}
	
	elseif ($result -> num_rows > 0) {
     while($row = $result->fetch_assoc()) {
		 // if there's an entry for this day
		 if ($row['entryday'] == $thisday) {
			 //echo $row['entryday'];
			 
			 	$query = "SELECT important_id FROM important WHERE entryyear=". $cYear ." AND entrymonth=". $cMonth ." AND entryday=". $thisday ." AND user_id=". $_SESSION['user_id'];
	mysqli_query($dbc,$query) or die(mysqli_error($dbc));
	$r = $dbc->query($query);
	if ($r -> num_rows == 1) {
		//echo "yes";
			 
			 if ($row['AVG(avgpain)'] < 0.95) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l1'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			 }
			elseif (($row['AVG(avgpain)'] >= 0.95) && ($row['AVG(avgpain)'] < 1.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l2'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 1.95) && ($row['AVG(avgpain)'] < 2.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l3'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 2.95) && ($row['AVG(avgpain)'] < 3.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l4'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 3.95) && ($row['AVG(avgpain)'] < 4.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l5'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 4.95) && ($row['AVG(avgpain)'] < 5.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l6'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 5.95) && ($row['AVG(avgpain)'] < 6.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l7'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 6.95) && ($row['AVG(avgpain)'] < 7.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l8'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 7.95) && ($row['AVG(avgpain)'] < 8.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l9'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
			elseif (($row['AVG(avgpain)'] >= 8.95) && ($row['AVG(avgpain)'] <= 10)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere l10'><span class='icon-exclamation-sign nounderline important'></span><span class='vmiddle'>" . number_format($row['AVG(avgpain)'],1) ."</span></div>";
			}
	}
	elseif ($r -> num_rows == 0) {
		//echo "no";
			 
			 if ($row['AVG(avgpain)'] < 0.95) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l1'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			 }
			elseif (($row['AVG(avgpain)'] >= 0.95) && ($row['AVG(avgpain)'] < 1.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l2'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 1.95) && ($row['AVG(avgpain)'] < 2.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l3'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 2.95) && ($row['AVG(avgpain)'] < 3.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l4'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 3.95) && ($row['AVG(avgpain)'] < 4.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l5'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 4.95) && ($row['AVG(avgpain)'] < 5.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l6'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 5.95) && ($row['AVG(avgpain)'] < 6.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l7'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 6.95) && ($row['AVG(avgpain)'] < 7.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l8'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 7.95) && ($row['AVG(avgpain)'] < 8.95)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l9'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
			elseif (($row['AVG(avgpain)'] >= 8.95) && ($row['AVG(avgpain)'] <= 10)) {
			 $thisday = "<div class='daynumber'>" . $thisday . "</div><div class='iconshere noimp l10'>" . number_format($row['AVG(avgpain)'],1) ."</div>";
			}
	}
			
		 }
				 
	 }
}
?>
<?php
	
    if(($i % 7) == 0 )  {echo "<tr>"; }
    if($i < $startday) {echo "<td></td>";}
	
	
    // for cells in the table that have days in them
    else { 
		
		 echo "<td title='Create/Edit Entry' class='actualday'><a data-ajax='false' href='newentry.php?calday=$i&startday=$startday'  class='nounderline'><div class='daynumber'>" . $thisday . "</div></a></td>";
		 if(($i % 7) == 6 ) echo "</tr>";
	}
		 
}
?>
</tr>
</table>
<?php	
}
?>
<!--<div class="cal1">
    </div>-->
</div>
<div id="createreport">
<a data-ajax='false' href='report.php'  class='nounderline'>Create Report for This Month</a>
</div>
<?php
$_SESSION['calmonth'] = $cMonth;
$_SESSION['calyear'] = $cYear;
?>
</body>
</html>