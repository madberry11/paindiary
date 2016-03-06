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
    <link rel="stylesheet" href="style.css" type="text/css" /> <!-- base CSS -->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> <!-- jQuery base CSS -->
	<link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'><!-- jQuery style CSS -->
    <link href="demo/css/demo.css" rel="stylesheet" type="text/css"/> <!-- tagbox CSS -->
    <link rel="stylesheet" type="text/css" href="css/tagit-dark-grey.css"> <!-- tagbox dark grey style -->
    <link rel="stylesheet" type="text/css" href="demo/css/jquery-ui-base-1.8.20.css"> <!-- jQuery base CSS -->
    
<!-- JavaScript / JQuery -->
	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript" src="jquery.mobile/jquery.mobile-1.4.5.js"></script>
    <script src="demo/js/jquery.1.7.2.min.js"></script>
  	<script src="demo/js/jquery-ui.1.8.20.min.js"></script>
  	<script src="js/tagit.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <noscript>JavaScript is essential for the functionality of this application. Please enable JavaScript for an improved user experience.</noscript>
    
<!-- fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    
<script>
var myInterval = setTimeout("location=('index.php');",3600000);


/*globals $ */
/*jslint vars:true */

    $(function () { 'use strict';
        function showTags(tags) {
            console.log(tags);
            var string = "";
            var i;
            for (i in tags) {
                string += "<li>" + tags[i].value + "</li>";
				string += "&nbsp;";
            }
			$('#demo4Out').append(string);
			$('#demo2Out').append(string);
			$("input[id=paintags]").val(string);
			$("input[id=paintags2]").val(string);
            
        }

        var availableTags = [
            "flickering",
            "pulsing",
            "throbbing",
            "beating",
            "pounding",
            "flashing",
            "shooting",
            "pricking",
            "boring",
            "drilling",
            "stabbing",
            "sharp",
            "lacerating",
            "pinching",
            "pressing",
            "gnawing",
            "cramping",
            "crushing",
            "tugging",
            "pulling",
            "wrenching",
			"hot",
			"burning",
			"scalding",
			"searing",
			"tingling",
			"itching",
			"smarting",
			"stinging",
			"dull",
			"sore",
			"hurting",
			"aching",
			"heavy",
			"tender",
			"rasping",
			"splitting",
			"tiring",
			"exhausting",
			"sickening",
			"suffocating",
			"fearful",
			"frightful",
			"terrifying",
			"punishing",
			"grueling",
			"cruel",
			"vicious",
			"killing",
			"wretched",
			"blinding",
			"annoying",
			"troublesome",
			"miserable",
			"intense",
			"unbearable",
			"spreading",
			"radiating",
			"penetrating",
			"piercing",
			"tight",
			"numb",
			"squeezing",
			"drawing",
			"tearing",
			"cool",
			"cold",
			"freezing",
			"nagging",
			"nauseating",
			"agonising",
			"dreadful",
			"torturing"
        ];

        $('#demo1').tagit({tagSource:availableTags, select:true, sortable:true});
        $('#demo2').tagit({tagSource:availableTags, inputWidth: 180, tagsChanged:function (a, b) {
			$('#demo2Out').html(a + ' was ' + b);
		}});
        $('#demo3').tagit({tagSource:availableTags, triggerKeys:['enter', 'comma', 'tab']});
        $('#demo4').tagit({tagSource:availableTags, sortable:true, tagsChanged:function (a, b) {
            $('#demo4Out').html(a + ' was ' + b);
			
			
			

        }});
        $('#demo5').tagit({maxLength:5, maxTags:5 });
        $('#demo6').tagit({tagSource:availableTags, sortable:true});
        $('#demo7').tagit({tagSource:availableTags, sortable:'handle'});
        $('#demo9').tagit({tagSource:availableTags, editable: true});


        $('#demo1GetTags').click(function () {
            showTags($('#demo1').tagit('tags'));
        });
        $('#demo2GetTags').click(function (i) {
            showTags($('#demo2').tagit('tags'));
			i.preventDefault();
        });
        $('#demo2ResetTags').click(function (i) {
            $('#demo2').tagit('reset');
			i.preventDefault();
        });
        $('#demo3GetTags').click(function () {
            showTags($('#demo3').tagit('tags'));
        });
        $('#demo4GetTags').click(function (i) {
            showTags($('#demo4').tagit('tags'));
			i.preventDefault();
        });
        $('#demo5GetTags').click(function () {
            showTags($('#demo5').tagit('tags'));
        });
        $('#demo6GetTags').click(function () {
            showTags($('#demo6').tagit('tags'));
        });
        $('#demo7GetTags').click(function () {
            showTags($('#demo7').tagit('tags'));
        });
        $('#demo8GetTags').click(function () {
            showTags($('#demo8').tagit('tags'));
        });
        $('#demo9GetTags').click(function () {
            showTags($('#demo9').tagit('tags'));
        });

        setInterval(function () {
           $('#fork').effect('pulsate', {times: 1}, 500);
        }, 5000);
		
		$('#demo4 li').each(function(i)
{
   $(this).attr('rel'); // This is your rel value
});


    });
	

  </script> 
</head>
<body>
  
<div id="header">
<div id="title"><a href="home.php" class="nounderline"><span class="lato900">Your</span> <span class="lato300">Pain Diary</span></a></div>
<ul id="navbar">
<li><a href="home.php" class="nounderline">Home</a></li>
<li><a href="" class="nounderline">Profile</a></li>
<li><a data-ajax="false" href="logout.php" class="nounderline">Logout</a></li>
</ul>
</div>
<br clear="both" />
<div id="divider"></div>
<div id="pagewrap">

<script type="text/javascript">

$('#formid').on('keyup keypress', function(e) {
  var code = e.keyCode || e.which;
  if (code == 13) { 
    e.preventDefault();
    return false;
  }
});
</script>

<?php 
$page_title = 'New Entry';


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

if(isset($_GET['calday'])) {
     $day = $_GET['calday'] - $_GET['startday'] + 1;
	 $_SESSION['day'] = $_GET['calday'] - $_GET['startday'] + 1;
}

if(isset($_GET['important'])) {
	
	$sql = "SELECT important_id FROM important WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'];
	mysqli_query($dbc,$sql) or die(mysqli_error($dbc));
	$result = $dbc->query($sql);
	
	// if this day had not been marked as important --> make important
	if ($result -> num_rows == 0) {
		//echo "now important";
		$uid = $_SESSION['user_id'];
		$eyear = $_SESSION['calyear'];
		$emonth = $_SESSION['calmonth'];
		$eday = $_SESSION['day'];
		$query ="INSERT INTO important (user_id, entryyear, entrymonth, entryday) VALUES ('$uid', '$eyear', '$emonth', '$eday')";
		mysqli_query($dbc,$query) or die(mysqli_error($dbc));
		?>
    <script>
	$(document).ready(function(){
    $('#makeimportant').removeClass("notimportant").addClass("important"); //Adds 'a', removes 'b'
	$("#importantday").css("display", "block");
	});
	
	</script>
    <?php
	}
	
	// if this day had been marked as important --> make not important
	elseif ($result -> num_rows == 1) {
		//echo "now not important";
		$query = "DELETE FROM important WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'];
      	mysqli_query($dbc,$query) or die(mysqli_error($dbc));
		
		
	}
}

elseif(!isset($_GET['important'])) {
	$sql = "SELECT important_id FROM important WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'];
	mysqli_query($dbc,$sql) or die(mysqli_error($dbc));
	$result = $dbc->query($sql);
	if ($result -> num_rows == 1) {
		?>
    <script>
	$(document).ready(function(){
    $('#makeimportant').removeClass("notimportant").addClass("important"); //Adds 'a', removes 'b'
	$("#importantday").css("display", "block");
	});
	
	</script>
    <?php
	}
}

if(isset($_GET['editrecord'])) {
	$editrecord = $_GET['editrecord'];
	$rvalue = 3;
}

if(isset($_GET['newrecord'])) {
	$newrecord = $_GET['newrecord'];
	$rvalue = 2;
}

if(isset($_GET['createcomment'])) {
	$createcomment = $_GET['createcomment'];
	$cvalue = 2;
}

if(isset($_GET['newbodypart'])) {
	$newbodypart = $_GET['newbodypart'];
}
	
if(isset($_GET['todelete'])) {
	$idtodelete = $_GET['todelete'];
	$query = "DELETE FROM pain WHERE entryid = " . $idtodelete;
      mysqli_query($dbc,$query) or die(mysqli_error($dbc));
}

if(isset($_GET['toedit'])) {
	$idtoedit = $_GET['toedit'];
	$_SESSION['entryid'] = $_GET['toedit'];
}

if(isset($_GET['commentdelete'])) {
	$commentdelete = $_GET['commentdelete'];
	$query = "DELETE FROM comments WHERE comment_id =" . $commentdelete;
      mysqli_query($dbc,$query) or die(mysqli_error($dbc));
}

if(isset($_GET['deleterecord'])) {
	$deleterecord = $_GET['deleterecord'];
	$query = "DELETE FROM painrelief WHERE record_id =" . $deleterecord;
      mysqli_query($dbc,$query) or die(mysqli_error($dbc));
}

if(isset($_GET['commentedit'])) {
	$commentedit = $_GET['commentedit'];
	$cvalue = 3;
}

if(isset($_GET['deleteall'])) {
	$query = "DELETE FROM pain WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'];
	$query = "DELETE FROM comments WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'];
	// code to delete pain relief record too
    mysqli_query($dbc,$query) or die(mysqli_error($dbc));
}

if (isset($_SESSION['calmonth'])) {
	$calmonth = $_SESSION['calmonth'];
	$calyear = $_SESSION['calyear'];
}

$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "bcac3dbe9c1d06";
$password = "32d91723";
$dbname = "booksapp";

$dbc = new mysqli($servername, $username, $password, $dbname);
if ($dbc->connect_error) {
     die("Connection failed: " . $dbc->connect_error);
} 
						
$sql = "SELECT entryid FROM pain WHERE entryyear='$calyear' AND entrymonth='$calmonth' AND entryday=". $_SESSION['day'] ." AND user_id="  . $_SESSION['user_id'];
$result = $dbc->query($sql);

if ($result -> num_rows > 0) {
	$evalue = 4;
}

else {
	$evalue = 1;
}

?>

<h1><a href="home.php" class="icon-chevron-left nounderline"></a>
<?php
if ($_SESSION['day'] < 10) {
	echo "0" . $_SESSION['day'] . " / ";
}
elseif ($_SESSION['day'] >= 10) {
	echo $_SESSION['day'] . " / ";
}
if ($_SESSION['calmonth'] < 10) {
	echo "0" . $_SESSION['calmonth'] . " / ";
}
elseif ($_SESSION['calmonth'] >= 10) {
	echo $_SESSION['calmonth'] . " / ";
}
echo "{$_SESSION['calyear']} " ?>
<a href='newentry.php?important=1' id="makeimportant" class="icon-exclamation-sign nounderline notimportant"></a>
</h1>
<div id="importantday" class="triangle-isosceles top">For future reference, please explain in a comment why you have marked this day as important.<a class="icon-circledelete nounderline" id="closemessage" ></a></div>

<script>


$("#makeimportant").toggle(function() 
{
        $('#makeimportant').removeClass("notimportant").addClass("important"); //Adds 'a', removes 'b'
		$("#importantday").css("display", "block");
		window.location.replace("http://paindiary.azurewebsites.net/newentry.php?important=1");
/*	
			 function ajaxFunction(){
 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 } }
		
		$.ajax({
       url: 'makeimportant.php',
       dataType: 'json',
       success: function(data){
            alert(data); 
       }
    });
*/
}, function() {
        $('#makeimportant').removeClass("important").addClass("notimportant"); //Adds 'b', removes 'a'
		$("#importantday").css("display", "none");
/*		
			 function ajaxFunction(){
 var ajaxRequest;  // The variable that makes Ajax possible!

 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 } }
		
		$.ajax({
       url: 'makenotimportant.php',
       dataType: 'json',
       success: function(data){
            alert(data);
       }
    });
	*/
});

$('#closemessage').click(function(){
    $("#importantday").css("display", "none");
});

</script>


<div id="addnewstuffwrap">
<ul id="addnewstuff">
<li><a href='newentry.php?newbodypart="1"'><div id="addnewbutton" class="visible" onlick="showform()"><div class="icon-men"></div><div class="linktext">Add New Body Part</div></div></a></li>
<li><a href='newentry.php?newrecord="1"'><div id="addpainrelief" class="visible" onClick="painrelief()"><div class="icon-pill-antivirusalt"></div><div class="linktext">Add New Pain Relief Record</div></div></a></li>
<li><a href='newentry.php?createcomment="1"'><div id="addcomment" class="visible" onClick="comment()"><div class="icon-commentroundtyping"></div><div class="linktext">Comment</div></div></a></li>
<li><div id="deleteall" class="hidden" onClick="Deleteall()"><div class="icon-trash trash2"></div><div class="linktext">Delete All</div></div></li>
</ul>
</div>

<!-- ADD NEW BODY PART -->

<div id="addnew" class="hidden">
<fieldset>
<legend>Add New Body Part</legend>
<form id="newentryform" name="newentryform" action="newentry.php" method="post">
    <p><label for="bodypart">Body Part</label>
    <input name="bodypart" type="text" placeholder="body part" maxlength="30" value="<?php if (isset($trimmed['bodypart'])) echo $trimmed['bodypart']; ?>" /></p>
    <p><label for="tags">What words would you use to describe the pain?</label>
    
  <ul id="demo4"></ul>
  
  <div class="buttons">
    <button id="demo4GetTags" value="Get Tags">Get Tags</button>
  </div>
  <div id="demo4Out"></div>
  <input id="paintags" name="paintags" class="hidden" />
<script>
function() {
document.write(document.getElementById("paintags").value);
}
</script>

    
    
    <table class="paintable">
    <tr><th class='firstcol'>Hour of Day</th><th>0AM</th><th>1AM</th><th>2AM</th><th>3AM</th><th>4AM</th><th>5AM</th><th>6AM</th><th>7AM</th><th>8AM</th><th>9AM</th><th>10AM</th><th>11AM</th></tr>
		 <tr><th class='firstcol'>Pain Intensity</th>
<td><input name="p00" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p00'])) echo $trimmed['p00']; ?>"/></td>
<td><input name="p01" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p01'])) echo $trimmed['p01']; ?>"/></td>
<td><input name="p02" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p02'])) echo $trimmed['p02']; ?>"></td>
<td><input name="p03" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p03'])) echo $trimmed['p03']; ?>"/></td>
<td><input name="p04" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p04'])) echo $trimmed['p04']; ?>"/></td>
<td><input name="p05" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p05'])) echo $trimmed['p05']; ?>"/></td>
<td><input name="p06" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p06'])) echo $trimmed['p06']; ?>"/></td>
<td><input name="p07" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p07'])) echo $trimmed['p07']; ?>"/></td>
<td><input name="p08" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p08'])) echo $trimmed['p08']; ?>"/></td>
<td><input name="p09" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p09'])) echo $trimmed['p09']; ?>"/></td>
<td><input name="p10" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p10'])) echo $trimmed['p10']; ?>"/></td>
<td><input name="p11" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p11'])) echo $trimmed['p11']; ?>"/></td>
</tr>
<tr><th class='firstcol'>Hour of Day</th><th>12PM</th><th>1PM</th><th>2PM</th><th>3PM</th><th>4PM</th><th>5PM</th><th>6PM</th><th>7PM</th><th>8PM</th><th>9PM</th><th>10PM</th><th>11PM</th></tr>
		 <tr><th class='firstcol'>Pain Intensity</th>
<td><input name="p12" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p12'])) echo $trimmed['p12']; ?>"/></td>
<td><input name="p13" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p13'])) echo $trimmed['p13']; ?>"/></td>
<td><input name="p14" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p14'])) echo $trimmed['p14']; ?>"/></td>
<td><input name="p15" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p15'])) echo $trimmed['p15']; ?>"/></td>
<td><input name="p16" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p16'])) echo $trimmed['p16']; ?>"/></td>
<td><input name="p17" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p17'])) echo $trimmed['p17']; ?>"/></td>
<td><input name="p18" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p18'])) echo $trimmed['p18']; ?>"/></td>
<td><input name="p19" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p19'])) echo $trimmed['p19']; ?>"/></td>
<td><input name="p20" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p20'])) echo $trimmed['p20']; ?>"/></td>
<td><input name="p21" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p21'])) echo $trimmed['p21']; ?>"/></td>
<td><input name="p22" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p22'])) echo $trimmed['p22']; ?>"/></td>
<td><input name="p23" class="hourpain" type="number" min="0" max="10" placeholder="0" value="<?php if (isset($trimmed['p23'])) echo $trimmed['p23']; ?>"/></td>
</tr>
    </table>
   <!-- <input type="hidden" name="calday" value="$_GET['calday']"> -->
    </p>
    <p class="center">
    <a href="" class="nounderline"><input type="submit" name="entry-submit" value="Save" /></a>
    <a href="" class="nounderline"><button type="reset">Clear</button></a>
    <a href="newentry.php" class="nounderline"><button type="submit" name="cancelentry">Cancel</button></a>
    </p>
</form>
</fieldset>
</div>




<!-- DISPLAY EXISTING BODY PART ENTRIES -->

<div id="oldpainentries">
<fieldset>
<legend>Body Parts</legend>
<?php

$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "bcac3dbe9c1d06";
$password = "32d91723";
$dbname = "booksapp";

$dbc = new mysqli($servername, $username, $password, $dbname);
if ($dbc->connect_error) {
     die("Connection failed: " . $dbc->connect_error);
} 
						
$sql = "SELECT entryid, bodypart, avgpain, p00, p01, p02, p03, p04, p05, p06, p07, p08, p09, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, entrytags FROM pain WHERE entryyear='$calyear' AND entrymonth='$calmonth' AND entryday=". $_SESSION['day'] ." AND user_id="  . $_SESSION['user_id'];
$result = $dbc->query($sql);

if ($result -> num_rows > 0) {
     // output data of each row
	 //$evalue= 4;
	 		 ?>
<div id='container'></div>
         <?php
     while($row = $result->fetch_assoc()) {
		
	 if (isset($row['entrytags'])) {
		 $tagsforthis = $row['entrytags'];
	 }
	 if (!$row['entrytags']) {
		 $tagsforthis = "Not defined.";
	 }
         echo "<a class='hidden' id='todelete' href='newentry.php?todelete=$row[entryid]'></a><div class='center'><table class='paintable'><caption class='paintablecaption'>". ucfirst($row["bodypart"])."<a data-ajax='false' class='icon-edit nounderline' href='newentry.php?toedit=$row[entryid]'></a><a href='' class='icon-trash nounderline' onclick='Deleteqry()'></a><br /><ul class='taglist'><span class='bold'>Type of pain:</span> " .$tagsforthis ."</ul></caption><tr><th class='firstcol'>Hour of Day</th><th>0AM</th><th>1AM</th><th>2AM</th><th>3AM</th><th>4AM</th><th>5AM</th><th>6AM</th><th>7AM</th><th>8AM</th><th>9AM</th><th>10AM</th><th>11AM</th></tr><tr><th class='firstcol'>Pain Intensity</th><td>". $row["p00"]. "</td><td>". $row["p01"]. "</td><td>". $row["p02"]."</td><td>". $row["p03"]."</td><td>". $row["p04"]."</td><td>". $row["p05"]."</td><td>". $row["p06"]."</td><td>". $row["p07"]."</td><td>". $row["p08"]."</td><td>". $row["p09"]."</td><td>". $row["p10"]."</td><td>". $row["p11"]."</td></tr><tr><th class='firstcol'>Hour of Day</th><th>12PM</th><th>1PM</th><th>2PM</th><th>3PM</th><th>4PM</th><th>5PM</th><th>6PM</th><th>7PM</th><th>8PM</th><th>9PM</th><th>10PM</th><th>11PM</th></tr><tr><th class='firstcol'>Pain Intensity</th><td>". $row["p12"]."</td><td>". $row["p13"]."</td><td>". $row["p14"]."</td><td>". $row["p15"]."</td><td>". $row["p16"]."</td><td>". $row["p17"]."</td><td>". $row["p18"]."</td><td>". $row["p19"]."</td><td>". $row["p20"]."</td><td>". $row["p21"]."</td><td>". $row["p22"]."</td><td>". $row["p23"]."</td></tr><tr><td class='avgrow' colspan='13'> Daily Average Pain Intensity: ". $row["avgpain"] ."</td></tr></table></div>";
     }
} else {
     echo "You have not entered anything for this day.";
	 ?>
     <script>
	 $(document).ready(function(){
	 $("#makeimportant").css("display", "none");
	 });
	 </script>
     <?php
	 //$evalue = 1 ;
}
?>
</fieldset>
</div>



<!-- HIGH CHARTS -->
<?php
$sql = "SELECT bodypart, p00, p01, p02, p03, p04, p05, p06, p07, p08, p09, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23 FROM pain WHERE entryyear='$calyear' AND entrymonth='$calmonth' AND entryday=". $_SESSION['day'] ." AND user_id="  . $_SESSION['user_id'];
$result = $dbc->query($sql);

if ($result -> num_rows > 0) {
	$row_cnt = $result->num_rows;
	echo $row_cnt;
while ($row = mysqli_fetch_array($result)) {
	$bodypart[] = $row['bodypart'];
   	$p00[] = $row['p00'];
	$p01[] = $row['p01'];
	$p02[] = $row['p02'];
	$p03[] = $row['p03'];
	$p04[] = $row['p04'];
	$p05[] = $row['p05'];
	$p06[] = $row['p06'];
	$p07[] = $row['p07'];
	$p08[] = $row['p08'];
	$p09[] = $row['p09'];
	$p10[] = $row['p10'];
	$p11[] = $row['p11'];
	$p12[] = $row['p12'];
	$p13[] = $row['p13'];
	$p14[] = $row['p14'];
	$p15[] = $row['p15'];
	$p16[] = $row['p16'];
	$p17[] = $row['p17'];
	$p18[] = $row['p18'];
	$p19[] = $row['p19'];
	$p20[] = $row['p20'];
	$p21[] = $row['p21'];
	$p22[] = $row['p22'];
	$p23[] = $row['p23'];
   //echo "query works";
}
}
?>
<!--
var chart = new Highcharts.Chart({
      chart: {
         renderTo: 'container'
      },
      series: [{
         data: [<?php echo join($data, ',') ?>],
         pointStart: 0,
         pointInterval
      }]
});
-->

<script>
$(function () { 
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Daily Pain Itensity'
        },
		yAxis: {
            title: {
                text: 'Pain Itensity'
            }
        },
        xAxis: {
            categories: ['0AM', '1AM', '2AM', '3AM', '4AM', '5AM', '6AM', '7AM', '8AM', '9AM', '10AM', '11AM', '12PM', '1PM', '2PM', '3PM', '4PM', '5PM', '6PM', '7PM', '8PM', '9PM', '10PM', '11PM']
        },
        series: [{
            name: '<?php echo $bodypart[0] ?>',
			data: [<?php echo $p00[0]. ',' .$p01[0]. ',' .$p02[0]. ',' .$p03[0]. ',' .$p04[0]. ',' .$p05[0]. ',' .$p06[0]. ',' .$p07[0]. ',' .$p08[0]. ',' .$p09[0]. ',' .$p10[0]. ',' .$p11[0]. ',' .$p12[0]. ',' .$p13[0]. ',' .$p14[0]. ',' .$p15[0]. ',' .$p16[0]. ',' .$p17[0]. ',' .$p18[0]. ',' .$p19[0]. ',' .$p20[0]. ',' .$p21[0]. ',' .$p22[0]. ',' .$p23[0] ?>]
           // data: [<?php echo join($p16, ',') ?>]
        }, {
            name: 'John',
            data: [5, 7, 3, 4, 9, 2]
        }]
    });
});

</script>





<!-- EDIT BODY PART ENTRY -->

<div id="editoldentry" class="hidden">
<fieldset>
<?php
if(isset($_GET['toedit'])) {
	$idtoedit = $_GET['toedit'];
	$_SESSION['entryid'] = $_GET['toedit'];
}
	$sql = "SELECT bodypart, avgpain, p00, p01, p02, p03, p04, p05, p06, p07, p08, p09, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, entrytags, entryyear, entrymonth, entryday FROM pain WHERE entryid = " . $_SESSION['entryid'];
	$result = $dbc->query($sql);

if ($result -> num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
	?>
	<legend>Edit Entry: <?php echo ucfirst($row["bodypart"]) ?></legend>
    
    <?php
	$bodypart = $row["bodypart"];
	$p00 = $row["p00"];
	$p01 = $row["p01"];
	$p02 = $row["p02"];
	$p03 = $row["p03"];
	$p04 = $row["p04"];
	$p05 = $row["p05"];
	$p06 = $row["p06"];
	$p07 = $row["p07"];
	$p08 = $row["p08"];
	$p09 = $row["p09"];
	$p10 = $row["p10"];
	$p11 = $row["p11"];
	$p12 = $row["p12"];
	$p13 = $row["p13"];
	$p14 = $row["p14"];
	$p15 = $row["p15"];
	$p16 = $row["p16"];
	$p17 = $row["p17"];
	$p18 = $row["p18"];
	$p19 = $row["p19"];
	$p20 = $row["p20"];
	$p21 = $row["p21"];
	$p22 = $row["p22"];
	$p23 = $row["p23"];
	$entrytags = $row["entrytags"];
	 }
 
?>
<form id="editentryform" name="editentryform" action="newentry.php" method="post">
    <p><label for="bodypart">Body Part</label>
    <input name="bodypart" type="text" placeholder="<?php echo $bodypart ?>" maxlength="30" value="<?php if (isset($trimmed['bodypart'])) echo $trimmed['bodypart']; ?>" /></p>Type of pain:
    <ul id="demo2" name="demo2">
        <?php 
		echo $entrytags;
		?>
    </ul>
  <div class="buttons">
    <button id="demo2GetTags" value="Get Tags">Get Tags</button>
    <button id="demo2ResetTags" value="Reset Tags">Reset Tags</button>
  </div>
  <div id="demo2Out"></div>
  <input id="paintags2" name="paintags2" class="hidden" />
    <table class="paintable">
    <tr><th class='firstcol'>Hour of Day</th><th>0AM</th><th>1AM</th><th>2AM</th><th>3AM</th><th>4AM</th><th>5AM</th><th>6AM</th><th>7AM</th><th>8AM</th><th>9AM</th><th>10AM</th><th>11AM</th></tr>
		 <tr><th class='firstcol'>Pain Intensity</th>
<td><input name="p00" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p00 ?>" value="<?php if (isset($trimmed['p00'])) echo $trimmed['p00']; ?>"/></td>
<td><input name="p01" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p01 ?>" value="<?php if (isset($trimmed['p01'])) echo $trimmed['p01']; ?>"/></td>
<td><input name="p02" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p02 ?>" value="<?php if (isset($trimmed['p02'])) echo $trimmed['p02']; ?>"></td>
<td><input name="p03" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p03 ?>" value="<?php if (isset($trimmed['p03'])) echo $trimmed['p03']; ?>"/></td>
<td><input name="p04" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p04 ?>" value="<?php if (isset($trimmed['p04'])) echo $trimmed['p04']; ?>"/></td>
<td><input name="p05" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p05 ?>" value="<?php if (isset($trimmed['p05'])) echo $trimmed['p05']; ?>"/></td>
<td><input name="p06" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p06 ?>" value="<?php if (isset($trimmed['p06'])) echo $trimmed['p06']; ?>"/></td>
<td><input name="p07" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p07 ?>" value="<?php if (isset($trimmed['p07'])) echo $trimmed['p07']; ?>"/></td>
<td><input name="p08" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p08 ?>" value="<?php if (isset($trimmed['p08'])) echo $trimmed['p08']; ?>"/></td>
<td><input name="p09" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p09 ?>" value="<?php if (isset($trimmed['p09'])) echo $trimmed['p09']; ?>"/></td>
<td><input name="p10" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p10 ?>" value="<?php if (isset($trimmed['p10'])) echo $trimmed['p10']; ?>"/></td>
<td><input name="p11" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p11 ?>" value="<?php if (isset($trimmed['p11'])) echo $trimmed['p11']; ?>"/></td>
</tr>
<tr><th class='firstcol'>Hour of Day</th><th>12PM</th><th>1PM</th><th>2PM</th><th>3PM</th><th>4PM</th><th>5PM</th><th>6PM</th><th>7PM</th><th>8PM</th><th>9PM</th><th>10PM</th><th>11PM</th></tr>
		 <tr><th class='firstcol'>Pain Intensity</th>
<td><input name="p12" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p12 ?>" value="<?php if (isset($trimmed['p12'])) echo $trimmed['p12']; ?>"/></td>
<td><input name="p13" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p13 ?>" value="<?php if (isset($trimmed['p13'])) echo $trimmed['p13']; ?>"/></td>
<td><input name="p14" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p14 ?>" value="<?php if (isset($trimmed['p14'])) echo $trimmed['p14']; ?>"/></td>
<td><input name="p15" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p15 ?>" value="<?php if (isset($trimmed['p15'])) echo $trimmed['p15']; ?>"/></td>
<td><input name="p16" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p16 ?>" value="<?php if (isset($trimmed['p16'])) echo $trimmed['p16']; ?>"/></td>
<td><input name="p17" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p17 ?>" value="<?php if (isset($trimmed['p17'])) echo $trimmed['p17']; ?>"/></td>
<td><input name="p18" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p18 ?>" value="<?php if (isset($trimmed['p18'])) echo $trimmed['p18']; ?>"/></td>
<td><input name="p19" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p19 ?>" value="<?php if (isset($trimmed['p19'])) echo $trimmed['p19']; ?>"/></td>
<td><input name="p20" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p20 ?>" value="<?php if (isset($trimmed['p20'])) echo $trimmed['p20']; ?>"/></td>
<td><input name="p21" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p21 ?>" value="<?php if (isset($trimmed['p21'])) echo $trimmed['p21']; ?>"/></td>
<td><input name="p22" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p22 ?>" value="<?php if (isset($trimmed['p22'])) echo $trimmed['p22']; ?>"/></td>
<td><input name="p23" class="hourpain" type="number" min="0" max="10" placeholder="<?php echo $p23 ?>" value="<?php if (isset($trimmed['p23'])) echo $trimmed['p23']; ?>"/></td>
</tr>
    </table>
    <p class="center">
    <a href="" class="nounderline"><input type="submit" name="entry-resubmit" value="Save" /></a>
    <a href="" class="nounderline"><button type="reset">Clear</button></a>
    <a href="newentry.php" class="nounderline"><button type="submit" name="canceleditentry">Cancel</button></a>
    </p>
</form>





<?php ;}


// check if there are any comments

$sql2="SELECT comment FROM comments WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id="  . $_SESSION['user_id'];
$result = $dbc->query($sql2);

if (mysqli_num_rows($result) == 1) {
	while($row = $result->fetch_assoc()) {
		$comment = $row['comment'];
		$cvalue = 4;
		?>
     <script>
	 $(document).ready(function(){
	 $("#importantday").css("display", "none");
	 });
	 </script>
     <?php
	}
}
else {
	$cvalue = 1;
}


// check if there are any pain relief records

$sql3="SELECT record_id FROM painrelief WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id="  . $_SESSION['user_id'];
$result = $dbc->query($sql3);

if (mysqli_num_rows($result) > 0) {
	while($row = $result->fetch_assoc()) {
		$record_id = $row['record_id'] ;
		$rvalue = 4;
	}
}
else {
	$rvalue = 1;
}
?>
</fieldset>
</div>


<a class="hidden" id='canceldeletepainrelief' href='newentry.php?deleterecord=0'></a>
<a class="hidden" id='canceldeletecomment' href='newentry.php?commentdelete=0'></a>
<a class="hidden" id='canceldeleteentry' href='newentry.php?todelete=0'></a>

<script type="text/javascript">
document.getElementById('addnewbutton').addEventListener('click', function(){
	document.getElementById('addnew').style.display = "block";
	document.getElementById('newcomment').style.display = "none";
	document.getElementById('newpainrelief').style.display = "none";
}, false);

function painrelief(){
	document.getElementById('addnew').style.display = "none";
	document.getElementById('newcomment').style.display = "none";
	document.getElementById('newpainrelief').style.display = "block";
}

function comment(){
	document.getElementById('addnew').style.display = "none";
	document.getElementById('newcomment').style.display = "block";
	document.getElementById('newpainrelief').style.display = "none";
}

//function editEntry() {
	//document.getElementById('editoldentry').style.display = "block";
	//document.getElementById('oldpainentries').style.display = "block";
//}

function Deleteqry() { 
	var r = confirm("Are you sure you want to delete this entry?");
if (r == true) {
	window.location="newentry.php?todelete=$row[entryid]";
	document.getElementById('todelete').click();
} else {
    x = "You pressed Cancel!";
	document.getElementById('canceldeleteentry').click();
}
}

function Deleterecordqry() { 
	var r = confirm("Are you sure you want to delete this pain relief record?");
if (r == true) {
	window.location="newentry.php?deleterecord=$row[entryid]";
	document.getElementById('deletepainrelief').click();
} else {
    x = "You pressed Cancel!";
	document.getElementById('canceldeletepainrelief').click();
}
}

function Deletecomment() { 
	var r = confirm("Are you sure you want to delete this comment?");
if (r == true) {
	window.location="newentry.php?commentdelete=$row[entryid]";
	document.getElementById('deletecomment').click();
} else {
    x = "You pressed Cancel!";
	document.getElementById('canceldeletecomment').click();
}
}

function Deleteall() { 
	var r = confirm("Are you sure you want to delete all data for this day?");
if (r == true) {
	window.location="newentry.php?deleteall=1";
} else {
    x = "You pressed Cancel!";
	window.location="newentry.php?deleteall=0";
}
}

function resetForm() {
document.getElementById("newentryform").reset();
document.getElementById('addnew').style.display = "block";
document.getElementById('addnewbutton').style.display = "none";
document.getElementById('addpainrelief').style.display = "none";
document.getElementById('addcomment').style.display = "none";
window.location="newentry.php#newentryform";	
}

</script>


<br style='clear:both' />


<!-- CREATE PAIN RELIEF RECORD -->
<div id="newpainrelief" class="hidden">
<fieldset>
<legend>Create New Pain Relief Record</legend>
<form id="painreliefform" name="painreliefform" action="newentry.php" method="post">
<table id="relieftable">
<tr>
<td><label for="time">Approximate Time</label></td>
<td><select class="tdright" id="time" name="time">
<?php for($i = 0; $i <= 23; $i++): ?>
    <option value="<?= $i; ?>"><?= date("h:iA", strtotime("$i:00")); ?></option>
<?php endfor; ?>
</select></td></tr>
<tr><td><label for="medicine">Medicine Name</label></td>
<td><input class="tdright" name="medicine" type="text" placeholder="" maxlength="30" value="<?php if (isset($trimmed['medicine'])) echo $trimmed['medicine']; ?>" /></td></tr>
<tr><td><label for="amount">Amount / Dose</label></td>
<td><input class="tdright" class="amount" name="amount" type="number" min="0" placeholder="0" value="<?php if (isset($trimmed['amount'])) echo $trimmed['amount']; ?>" />
<select id="measure" name="measure">
<option value="na">Measurement</option>
<option value="milligrams">milligrams (mg)</option>
<option value="millilitres">millilitres (ml)</option>
</select></td></tr>
<tr><td><label for="otherthings">Other Methods</label></td>
<td><TEXTAREA class="relieftextarea tdright" name="otherthings">
<?php if (isset($trimmed['otherthings'])) echo $trimmed['otherthings']; ?>
</TEXTAREA>
</td></tr>
<tr><td><label for="reliefrating">Pain Relief Rating</label></td>
<td><input class="tdright" name="reliefrating" type="number" placeholder="0" min="0" max="10" value="<?php if (isset($trimmed['reliefrating'])) echo $trimmed['reliefrating']; ?>" /></td></tr>
<tr><td><label for="sideeffects">Side Effects / Problems</label></td>
<td><TEXTAREA class="relieftextarea tdright" name="sideeffects">
<?php if (isset($trimmed['sideeffects'])) echo $trimmed['sideeffects']; ?>
</TEXTAREA></td></tr>
</table>
<p class="center">
<a href="" class="nounderline"><input type="submit" name="painrelief-submit" value="Save" /></a>
<a href="" class="nounderline"><button type="reset">Clear</button></a>
<a href="newentry.php" class="nounderline"><button type="submit" name="cancelrelief">Cancel</button></a>
</p>
</form>
</fieldset>
</div>




<!-- EDIT PAIN RELIEF -->
<div id="editpainrelief" class="hidden">
<fieldset>
<legend>Edit Pain Relief Record</legend>
<?php
if(isset($_GET['editrecord'])) {
	$editrecord = $_GET['editrecord'];
	$_SESSION['record_id'] = $_GET['editrecord'];
}
	$sql = "SELECT time, medicine, amount, measure, otherthings, reliefrating, sideeffects FROM painrelief WHERE record_id = " . $_SESSION['record_id'];
	$result = $dbc->query($sql);

if ($result -> num_rows == 1) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
		 $time = $row["time"];
		 $medicine = $row["medicine"];
		 $amount = $row["amount"];
		 $measure = $row["measure"];
		 $otherthings = $row["otherthings"];
		 $reliefrating = $row["reliefrating"];
		 $sideeffects = $row["sideeffects"];
?>
<form id="painreliefform" name="painreliefform" action="newentry.php" method="post">
<table id="relieftable">
<tr>
<td><label for="time">Approximate Time</label></td>
<td><select class="tdright" id="time" name="time">
<script type="text/javascript">
document.getElementById('time').selectedIndex=<?php echo $time ?>;
</script>
<?php for($i = 0; $i <= 23; $i++): ?>
    <option value="<?= $i; ?>"><?= date("h:iA", strtotime("$i:00")); ?></option>
<?php endfor; ?>
</select></td></tr>
<tr><td><label for="medicine">Medicine Name</label></td>
<td><input class="tdright" name="medicine" type="text" placeholder="<?php echo $medicine; ?>" maxlength="30" value="<?php if (isset($trimmed['medicine'])) echo $trimmed['medicine']; ?>" /></td></tr>
<tr><td><label for="amount">Amount / Dose</label></td>
<td><input class="tdright" class="amount" name="amount" type="number" min="0" placeholder="<?php echo $amount; ?>" value="<?php if (isset($trimmed['amount'])) echo $trimmed['amount']; ?>" />
<select id="measure" name="measure">
<script type="text/javascript">
document.getElementById('measure').selectedIndex=<?php echo $measure ?>;
</script>
<option value="na">Measurement</option>
<option value="milligrams">milligrams (mg)</option>
<option value="millilitres">millilitres (ml)</option>
</select></td></tr>
<tr><td><label for="otherthings">Other Methods</label></td>
<td><TEXTAREA class="relieftextarea tdright" name="otherthings">
<?php
$sql = "SELECT otherthings FROM painrelief WHERE record_id = " . $_SESSION['record_id'];
$result = $dbc->query($sql);
if ($result -> num_rows == 1) {
while($row = $result->fetch_assoc()) {
echo $row['otherthings'];
}
}
?>
</TEXTAREA></td></tr>
<!--<td><input class="tdright" name="otherthings" type="text" placeholder="<?php echo $otherthings; ?>" maxlength="30" value="<?php if (isset($trimmed['otherthings'])) echo $trimmed['otherthings']; ?>" /></td></tr>-->
<tr><td><label for="reliefrating">Pain Relief Rating</label></td>
<td><input class="tdright" name="reliefrating" type="number" placeholder="<?php echo $reliefrating; ?>" min="0" max="10" value="<?php if (isset($trimmed['reliefrating'])) echo $trimmed['reliefrating']; ?>" /></td></tr>
<tr><td><label for="sideeffects">Side Effects / Problems</label></td>
<td><TEXTAREA class="relieftextarea tdright" name="sideeffects">
<?php
$sql = "SELECT sideeffects FROM painrelief WHERE record_id = " . $_SESSION['record_id'];
$result = $dbc->query($sql);
if ($result -> num_rows == 1) {
while($row = $result->fetch_assoc()) {
echo $row['sideeffects'];
}
}
?>
</TEXTAREA></td></tr>
</table>
<p class="center">
<a href="" class="nounderline"><input type="submit" name="changerelief-submit" value="Save" /></a>
<a href="" class="nounderline"><button type="reset">Clear</button></a>
<a href="newentry.php" class="nounderline"><button type="submit" name="cancelchangerelief">Cancel</button></a>
</p>
</form>
<?php
	 }
}
?>
</fieldset>
</div>





<!-- DISLPAY EXISTING PAIN RELIEF RECORDS -->
<div id="oldpainrelief" class="hidden">
<br />
<fieldset>
<legend>Pain Relief Record</legend>
<?php

$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "bcac3dbe9c1d06";
$password = "32d91723";
$dbname = "booksapp";

$dbc = new mysqli($servername, $username, $password, $dbname);
if ($dbc->connect_error) {
     die("Connection failed: " . $dbc->connect_error);
}
 $q = "SELECT record_id, time, medicine, amount, measure, otherthings, reliefrating, sideeffects  FROM painrelief WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'] . " ORDER BY time ASC";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) > 0) { ?>
        <table class="relieftable2">
        <th class="col1">Time</th><th class="col2">Medicine</th><th class="col3">Amount</th><th class="col4">Other Things</th><th class="col5">Relief</th><th class="col6">Side Effects</th>
        <?php
		while($row = $r->fetch_assoc()) {
echo "<a class='hidden' id='deletepainrelief' href='newentry.php?deleterecord=$row[record_id]'></a><tr><td>" . $row['time'] . ":00</td><td>" . $row['medicine'] . "</td><td>" . $row['amount'] . str_replace("milligrams","mg", str_replace("millilitres","ml", $row['measure'])) . "</td><td>" . $row['otherthings'] . "</td><td>" . $row['reliefrating'] . "</td><td>" . $row['sideeffects'] . "</td><td class='icontd'><a class='icon-edit nounderline' href='newentry.php?editrecord=$row[record_id]'></a><a class='icon-trash nounderline' href='' onclick='Deleterecordqry()'></a></td></tr>";

		}?>
        </table>

        <?php

		}
?>
</fieldset>
</div>




<!-- ADD NEW COMMENT -->
<div id="newcomment" name="newcomment" class="hidden">
<fieldset>
<legend>Add Comment</legend>
<!--<span id="commentlabel">Add Comment: </span>-->
<form method="post" action="newentry.php">
<TEXTAREA id="commentfield" name="comment" ROWS=2 COLS=20 placeholder="Enter your comment here."></TEXTAREA>
<p class="center">
<a href="" class="nounderline"><input type="submit" name="comment-submit" value="Save" /></a>
<a href="" class="nounderline"><button type="reset">Clear</button></a>
<a href="newentry.php" class="nounderline"><button type="submit" name="cancelcomment">Cancel</button></a>
</p>
</form>
</fieldset>
</div>


<!-- DISPLAY OLD COMMENT -->
<div id="oldcomment" class="hidden">
<fieldset>
<legend>Comment</legend>
<!--<span id="commentlabel">Comment: </span>-->
<?php
$sql = "SELECT comment_id, comment FROM comments WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id="  . $_SESSION['user_id'];
$result = $dbc->query($sql);
if ($result -> num_rows > 0) {
while($row = $result->fetch_assoc()) {
echo $row['comment'] . "<a class='hidden' id='deletecomment' href='newentry.php?commentdelete=$row[comment_id]'></a><a class='icon-edit nounderline' onclick='comment()' href='newentry.php?commentedit=$row[comment_id]'></a><a href='' class='icon-trash nounderline' onclick='Deletecomment()'></a>" 
;}
}
?>
</fieldset>
</div>


<!-- EDIT EXISTING COMMENT -->
<div id="editcomment" name="editcomment" class="hidden">
<fieldset>
<legend>Edit Comment</legend>
<form method="post" action="newentry.php">
<TEXTAREA id="commentfield" name="comment2">
<?php
$sql = "SELECT comment_id, comment FROM comments WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id="  . $_SESSION['user_id'];
$result = $dbc->query($sql);
if ($result -> num_rows > 0) {
while($row = $result->fetch_assoc()) {
echo $row['comment'];
}
}
 ?>
</TEXTAREA>
<p class="center">
<a href="" class="nounderline"><input type="submit" id="comment-resubmit" name="comment-resubmit" value="Save" /></a>
<a href="" class="nounderline"><button type="reset">Clear</button></a>
<a href="newentry.php" class="nounderline"><button type="submit" name="cancelcomment">Cancel</button></a>
</p>
</form>
</fieldset>
</div>




<!-- SWITCH BODY ENTRIES -->

<?php

$entryvalue=0;

if ($evalue == 1) {
if (isset($_GET['newbodypart'])) {
	$newbodypart = $_GET['newbodypart'];
	$entryvalue = 5;
	}
else {
	$entryvalue = 1;
	//echo "case 1";
	}
}

if ($evalue == 4) {
	if (isset($_GET['newbodypart'])) {
		$newbodypart = $_GET['newbodypart'];
		$entryvalue = 2;
		//echo "case 2";
	}
	elseif (isset($_GET['toedit'])) {
		$idtoedit = $_GET['toedit'];
		$_SESSION['entryid'] = $_GET['toedit'];
		$entryvalue = 3;
		//echo "case 3";
	}
	else {
		$entryvalue = 4;
		//echo "case 4";
	}
}

switch($entryvalue) {
case '1':
	//echo "There are no body part entries.";
	?>
    <script type="text/javascript">
    document.getElementById('oldpainentries').style.display = "block";
	</script>
    <?php
	break;
case '2':
	//echo "New body part entry is being created, there are other existing body parts already.";
	?>
    <script type="text/javascript">
    document.getElementById('addnew').style.display = "block";
	document.getElementById('oldpainentries').style.display = "block";
	document.getElementById('deleteall').style.display = "block";
	</script>
    <?php
	break;
case '3':
	//echo "Body part entry is getting edited.";
	?>
    <script type="text/javascript">
	//document.getElementById('oldpainentries').style.display = "block";
    document.getElementById('editoldentry').style.display = "block";
	document.getElementById('addnew').style.display = "none";
	document.getElementById('deleteall').style.display = "block";
	</script>
    <?php
	break;
case '4':
	//echo "Existing body part entries are getting displayed.";
	?>
    <script type="text/javascript">
	document.onload = function(){
    document.getElementById('oldpainentries').style.display = "block";
	document.getElementById('deleteall').style.display = "block";
	}
	</script>
    <?php
	break;
case '5':
	//echo "New body part is getting added, no other existing body parts.";
	?>
    <script type="text/javascript">
    document.getElementById('oldpainentries').style.display = "none";
	document.getElementById('addnew').style.display = "block";
	</script>
    <?php
	break;
}
?>





<!-- SWITCH PAIN RELIEF ENTRIES -->

<?php 

if ($rvalue == 1) {
	if (isset($_GET['newrecord'])) {
		$recordvalue = 2;
	}
	else {
		$recordvalue = 1;
	}
}

if ($rvalue == 4) {
	if (isset($_GET['editrecord'])) {
		$recordvalue = 3;
	}
	elseif (isset($_GET['newrecord'])) {
		$recordvalue = 5;
	}
	else {
		$recordvalue = 4;
	}
}

switch($recordvalue) {
case '1' :
	//echo "No pain relief records.";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('oldpainrelief').style.display = "none";
    document.getElementById('editpainrelief').style.display = "none";
	document.getElementById('newpainrelief').style.display = "none";
	}
	</script>
    <?php
	break;
case '2' :
	//echo "New pain relief record is getting created, no other exists yet.";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('oldpainrelief').style.display = "none";
    document.getElementById('editpainrelief').style.display = "none";
	document.getElementById('newpainrelief').style.display = "block";
	document.getElementById('newpainrelief_link').click();
	}
	</script>
    <?php
	break;
case '3' :
	//echo "Existing pain relief record is getting edited.";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('oldpainrelief').style.display = "block";
    document.getElementById('editpainrelief').style.display = "block";
	document.getElementById('newpainrelief').style.display = "none";
	document.getElementById('deleteall').style.display = "block";
	document.getElementById('editpainrelief_link').click();
	}
	</script>
    <?php
	break;
case '4' :
	//echo "Display pain relief records.";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('oldpainrelief').style.display = "block";
    document.getElementById('editpainrelief').style.display = "none";
	document.getElementById('newpainrelief').style.display = "none";
	document.getElementById('deleteall').style.display = "block";
	}
	</script>
    <?php
	break;
case '5' :
	//echo "New pain relief is getting created but some already exist.";
	?>
    <script type="text/javascript">
	window.onload = function(){
	document.getElementById('oldpainrelief').style.display = "block";
    document.getElementById('editpainrelief').style.display = "none";
	document.getElementById('newpainrelief').style.display = "block";
	document.getElementById('deleteall').style.display = "block";
	document.getElementById('newpainrelief_link').click();
	}
	</script>
    <?php
	break;
}
?>



<!-- SWITCH COMMENTS -->

<?php

if ($cvalue == 1){
	if(isset($_GET['createcomment'])) {
		$commentvalue = 2;
	}
	else {
		$commentvalue = 1;
	}
}

if ($cvalue == 4){
	if(isset($_GET['commentedit'])) {
		$commentvalue = 3;
	}
	else {
		$commentvalue = 4;
	}
}

switch($commentvalue){
case '1' :
	//echo "No comment.";
	?>
    <script type="text/javascript">
	document.getElementById('newcomment').style.display = "none";
	document.getElementById('editcomment').style.display = "none";
	document.getElementById('oldcomment').style.display = "none";
	</script>
    <?php
	break;
case '2' :
	//echo "New comment is getting created.";
	?>
    <script type="text/javascript">
    document.getElementById('newcomment').style.display = "block";
	document.getElementById('addcomment').style.display = "none";
	document.getElementById('newcomment_link').click();
	</script>
    <?php
	break;
case '3' :
	//echo "Existing comment is getting edited.";
	?>
    <script type="text/javascript">
    document.getElementById('editcomment').style.display = "block";
	document.getElementById('addcomment').style.display = "none";
	document.getElementById('deleteall').style.display = "block";
	document.getElementById('editcomment_link').click();
	</script>
    <?php
	break;
case '4' :
	//echo "Display existing comment.";
	?>
    <script type="text/javascript">
    document.getElementById('oldcomment').style.display = "block";
	document.getElementById('addcomment').style.display = "none";
	document.getElementById('deleteall').style.display = "block";
	</script>
    <?php
	break;
}
?>



<!-- JUMPING -->
<script type="text/javascript">
function jumpto(editpainrelief){
    window.location.href = "#"+editpainrelief;
}
function jumpto(newpainrelief){
    window.location.href = "#"+newpainrelief;
}
function jumpto(editcomment){
    window.location.href = "#"+editcomment;
}
function jumpto(newcomment){
    window.location.href = "#"+newcomment;
}
</script>
<a class="hidden" id="editpainrelief_link" onClick="jumpto('editpainrelief');"></a>
<a class="hidden" id="newpainrelief_link" onClick="jumpto('newpainrelief');"></a>
<a class="hidden" id="editcomment_link" onClick="jumpto('editcomment');"></a>
<a class="hidden" id="newcomment_link" onClick="jumpto('newcomment');"></a>





<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 



// IF CANCEL BUTTON IS CLICKED

if ((!empty($_POST['cancelentry'])) OR (!empty($_POST['cancelrelief'])) OR (!empty($_POST['cancelcomment'])) OR (!empty($_POST['canceleditentry'])) OR (!empty($_POST['cancelchangerelief']))) {
	
	$url = BASE_URL . 'newentry.php'; 
	ob_end_clean(); 
	header("Location: $url");	
}



// IF BODY PART ENTRY GETS SUBMITTED


if (!empty($_POST['entry-submit'])) {
?>
<!--
<style>
body {
cursor: wait;	
}
* {
cursor: wait;	
}
</style>
-->
<?php
	 
	 if (!empty($_POST['paintags'])) {
		 
		 $entrytags = $_POST['paintags'];
		 $_SESSION['entrytags'] = $entrytags;
	 }
	 
	 else {
		 $entrytags = "";
	 }

	require (MYSQL);
	$trimmed = array_map('trim', $_POST);
	$bodypart = $p00 = $p01 = $p02 = $p03 = $p04 = $p05 = $p06 = $p07 = $p08 = $p09 = $p10 = $p11 = $p12 = $p13 = $p14 = $p15 = $p16 = $p17 = $p18 = $p19 = $p20 = $p21 = $p22 = $p23 = $entrytags = FALSE;
  
 if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['bodypart'])) {
		$bodypart = mysqli_real_escape_string ($dbc, $trimmed['bodypart']);
	} else {
		echo '<p class="error">Please enter the affected body part!</p>';
	}
	
if ((empty($_POST["p00"])) AND (empty($_POST["p01"])) AND (empty($_POST["p02"])) AND (empty($_POST["p03"])) AND (empty($_POST["p04"])) AND (empty($_POST["p05"])) AND (empty($_POST["p06"])) AND (empty($_POST["p07"])) AND (empty($_POST["p08"])) AND (empty($_POST["p09"])) AND (empty($_POST["p10"])) AND (empty($_POST["p11"])) AND (empty($_POST["p12"])) AND (empty($_POST["p13"])) AND (empty($_POST["p14"])) AND (empty($_POST["p15"])) AND (empty($_POST["p16"])) AND (empty($_POST["p17"])) AND (empty($_POST["p18"])) AND (empty($_POST["p19"])) AND (empty($_POST["p20"])) AND (empty($_POST["p21"])) AND (empty($_POST["p22"])) AND (empty($_POST["p23"])))
{ echo '<p class="error">You have not entered any pain intensity values!</p>';}
else {
  
if (empty($_POST["p00"])) {$p00 = 0;}
else {$p00 = mysqli_real_escape_string ($dbc, $trimmed['p00']);}

if (empty($_POST["p01"])) {$p01 = 0;}
else {$p01 = mysqli_real_escape_string ($dbc, $trimmed['p01']);}  

if (empty($_POST["p02"])) {$p02 = 0;}
else {$p02 = mysqli_real_escape_string ($dbc, $trimmed['p02']);} 

if (empty($_POST["p03"])) {$p03 = 0;}
else {$p03 = mysqli_real_escape_string ($dbc, $trimmed['p03']);} 

if (empty($_POST["p04"])) {$p04 = 0;}
else {$p04 = mysqli_real_escape_string ($dbc, $trimmed['p04']);} 

if (empty($_POST["p05"])) {$p05 = 0;}
else {$p05 = mysqli_real_escape_string ($dbc, $trimmed['p05']);} 

if (empty($_POST["p06"])) {$p06 = 0;}
else {$p06 = mysqli_real_escape_string ($dbc, $trimmed['p06']);}

if (empty($_POST["p07"])) {$p07 = 0;}
else {$p07 = mysqli_real_escape_string ($dbc, $trimmed['p07']);} 

if (empty($_POST["p08"])) {$p08 = 0;}
else {$p08 = mysqli_real_escape_string ($dbc, $trimmed['p08']);} 

if (empty($_POST["p09"])) {$p09 = 0;}
else {$p09 = mysqli_real_escape_string ($dbc, $trimmed['p09']);} 

if (empty($_POST["p10"])) {$p10 = 0;}
else {$p10 = mysqli_real_escape_string ($dbc, $trimmed['p10']);} 

if (empty($_POST["p11"])) {$p11 = 0;}
else {$p11 = mysqli_real_escape_string ($dbc, $trimmed['p11']);} 

if (empty($_POST["p12"])) {$p12 = 0;}
else {$p12 = mysqli_real_escape_string ($dbc, $trimmed['p12']);}
 
if (empty($_POST["p13"])) {$p13 = 0;}
else {$p13 = mysqli_real_escape_string ($dbc, $trimmed['p13']);} 

if (empty($_POST["p14"])) {$p14 = 0;}
else {$p14 = mysqli_real_escape_string ($dbc, $trimmed['p14']);} 

if (empty($_POST["p15"])) {$p15 = 0;}
else {$p15 = mysqli_real_escape_string ($dbc, $trimmed['p15']);} 

if (empty($_POST["p16"])) {$p16 = 0;}
else {$p16 = mysqli_real_escape_string ($dbc, $trimmed['p16']);} 

if (empty($_POST["p17"])) {$p17 = 0;}
else {$p17 = mysqli_real_escape_string ($dbc, $trimmed['p17']);} 

if (empty($_POST["p18"])) {$p18 = 0;}
else {$p18 = mysqli_real_escape_string ($dbc, $trimmed['p18']);}
 
if (empty($_POST["p19"])) {$p19 = 0;}
else {$p19 = mysqli_real_escape_string ($dbc, $trimmed['p19']);} 

if (empty($_POST["p20"])) {$p20 = 0;}
else {$p20 = mysqli_real_escape_string ($dbc, $trimmed['p20']);}
 
if (empty($_POST["p21"])) {$p21 = 0;}
else {$p21 = mysqli_real_escape_string ($dbc, $trimmed['p21']);} 

if (empty($_POST["p22"])) {$p22 = 0;}
else {$p22 = mysqli_real_escape_string ($dbc, $trimmed['p22']);}

if (empty($_POST["p23"])) {$p23 = 0;}
else {$p23 = mysqli_real_escape_string ($dbc, $trimmed['p23']);} 
  
  if ($bodypart) {
  
  $q = "SELECT entryid FROM pain WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND bodypart='$bodypart' AND user_id=". $_SESSION['user_id'];
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { 
			$q = "INSERT INTO pain SET
			user_id := '". $_SESSION['user_id'] . "',
			entryyear := '". $_SESSION['calyear'] . "',
			entrymonth := '". $_SESSION['calmonth']. "',
			entryday := '".mysqli_real_escape_string($dbc,$_SESSION['day']). "',
			bodypart := '".mysqli_real_escape_string($dbc,$bodypart) ."',
			p00 := '".mysqli_real_escape_string($dbc,$p00) ."',
			p01 := '".mysqli_real_escape_string($dbc,$p01) ."',
			p02 := '".mysqli_real_escape_string($dbc,$p02) ."',
			p03 := '".mysqli_real_escape_string($dbc,$p03) ."',
			p04 := '".mysqli_real_escape_string($dbc,$p04) ."',
			p05 := '".mysqli_real_escape_string($dbc,$p05) ."',
			p06 := '".mysqli_real_escape_string($dbc,$p06) ."',
			p07 := '".mysqli_real_escape_string($dbc,$p07) ."',
			p08 := '".mysqli_real_escape_string($dbc,$p08) ."',
			p09 := '".mysqli_real_escape_string($dbc,$p09) ."',
			p10 := '".mysqli_real_escape_string($dbc,$p10) ."',
			p11 := '".mysqli_real_escape_string($dbc,$p11) ."',
			p12 := '".mysqli_real_escape_string($dbc,$p12) ."',
			p13 := '".mysqli_real_escape_string($dbc,$p13) ."',
			p14 := '".mysqli_real_escape_string($dbc,$p14) ."',
			p15 := '".mysqli_real_escape_string($dbc,$p15) ."',
			p16 := '".mysqli_real_escape_string($dbc,$p16) ."',
			p17 := '".mysqli_real_escape_string($dbc,$p17) ."',
			p18 := '".mysqli_real_escape_string($dbc,$p18) ."',
			p19 := '".mysqli_real_escape_string($dbc,$p19) ."',
			p20 := '".mysqli_real_escape_string($dbc,$p20) ."',
			p21 := '".mysqli_real_escape_string($dbc,$p21) ."',
			p22 := '".mysqli_real_escape_string($dbc,$p22) ."',
			p23 := '".mysqli_real_escape_string($dbc,$p23) ."',
			entrytags := '". $_SESSION['entrytags']. "',
			avgpain := ( $p00+ $p01 + $p02 + $p03 +$p04 + $p05 + $p06 + $p07 + $p08 + $p09 + $p10 + $p11 + $p12 + $p13 + $p14 + $p15 + $p16 + $p17 + $p18 + $p19 + $p20 + $p21 + $p22 + $p23) /24
			";
			
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

					if (mysqli_affected_rows($dbc) == 1) {

	$url = BASE_URL . 'newentry.php'; 
	ob_end_clean(); 
	header("Location: $url");

						
					}else {
						echo '<p class="error">The entry could not be changed due to a system error. We apologize for any inconvenience.</p>';
					}
			
		} else {
			echo '<p class="error">You have already added this body part for this day.</p>';
		}
		
	} else {
		echo '<p class="error">Please try again.</p>';
	}


	mysqli_close($dbc);
}
}


// IF BODY PART ENTRY GETS RESUBMITTED

if (!empty($_POST['entry-resubmit'])) {
	
	if (!empty($_POST['paintags2'])) {
		 
		 $entrytags = $_POST['paintags2'];
		 $_SESSION['entrytags'] = $entrytags;
		 //echo $entrytags;
	 }
	 
	 else {
		 $entrytags = "";
		 //echo "tags weren't changed";
	 }
	
require (MYSQL);
	$trimmed = array_map('trim', $_POST);
	
if ((empty($_POST["bodypart"])) AND(empty($_POST["p00"])) AND (empty($_POST["p01"])) AND (empty($_POST["p02"])) AND (empty($_POST["p03"])) AND (empty($_POST["p04"])) AND (empty($_POST["p05"])) AND (empty($_POST["p06"])) AND (empty($_POST["p07"])) AND (empty($_POST["p08"])) AND (empty($_POST["p09"])) AND (empty($_POST["p10"])) AND (empty($_POST["p11"])) AND (empty($_POST["p12"])) AND (empty($_POST["p13"])) AND (empty($_POST["p14"])) AND (empty($_POST["p15"])) AND (empty($_POST["p16"])) AND (empty($_POST["p17"])) AND (empty($_POST["p18"])) AND (empty($_POST["p19"])) AND (empty($_POST["p20"])) AND (empty($_POST["p21"])) AND (empty($_POST["p22"])) AND (empty($_POST["p23"])) AND (empty($_POST["paintags2"])))
{ echo '<p class="error">You did not change any values!</p>';}
else {
	
if (empty($_POST["bodypart"])) {$bodypart = $bodypart;}
else {$bodypart = mysqli_real_escape_string ($dbc, $trimmed['bodypart']);}
  
if (empty($_POST["p00"])) {$p00 = $p00;}
else {$p00 = mysqli_real_escape_string ($dbc, $trimmed['p00']);}

if (empty($_POST["p01"])) {$p01 = $p01;}
else {$p01 = mysqli_real_escape_string ($dbc, $trimmed['p01']);}  

if (empty($_POST["p02"])) {$p02 = $p02;}
else {$p02 = mysqli_real_escape_string ($dbc, $trimmed['p02']);} 

if (empty($_POST["p03"])) {$p03 = $p03;}
else {$p03 = mysqli_real_escape_string ($dbc, $trimmed['p03']);} 

if (empty($_POST["p04"])) {$p04 = $p04;}
else {$p04 = mysqli_real_escape_string ($dbc, $trimmed['p04']);} 

if (empty($_POST["p05"])) {$p05 = $p05;}
else {$p05 = mysqli_real_escape_string ($dbc, $trimmed['p05']);} 

if (empty($_POST["p06"])) {$p06 = $p06;}
else {$p06 = mysqli_real_escape_string ($dbc, $trimmed['p06']);}

if (empty($_POST["p07"])) {$p07 = $p07;}
else {$p07 = mysqli_real_escape_string ($dbc, $trimmed['p07']);} 

if (empty($_POST["p08"])) {$p08 = $p08;}
else {$p08 = mysqli_real_escape_string ($dbc, $trimmed['p08']);} 

if (empty($_POST["p09"])) {$p09 = $p09;}
else {$p09 = mysqli_real_escape_string ($dbc, $trimmed['p09']);} 

if (empty($_POST["p10"])) {$p10 = $p10;}
else {$p10 = mysqli_real_escape_string ($dbc, $trimmed['p10']);} 

if (empty($_POST["p11"])) {$p11 = $p11;}
else {$p11 = mysqli_real_escape_string ($dbc, $trimmed['p11']);} 

if (empty($_POST["p12"])) {$p12 = $p12;}
else {$p12 = mysqli_real_escape_string ($dbc, $trimmed['p12']);}
 
if (empty($_POST["p13"])) {$p13 = $p13;}
else {$p13 = mysqli_real_escape_string ($dbc, $trimmed['p13']);} 

if (empty($_POST["p14"])) {$p14 = $p14;}
else {$p14 = mysqli_real_escape_string ($dbc, $trimmed['p14']);} 

if (empty($_POST["p15"])) {$p15 = $p15;}
else {$p15 = mysqli_real_escape_string ($dbc, $trimmed['p15']);} 

if (empty($_POST["p16"])) {$p16 = $p16;}
else {$p16 = mysqli_real_escape_string ($dbc, $trimmed['p16']);} 

if (empty($_POST["p17"])) {$p17 = $p17;}
else {$p17 = mysqli_real_escape_string ($dbc, $trimmed['p17']);} 

if (empty($_POST["p18"])) {$p18 = $p18;}
else {$p18 = mysqli_real_escape_string ($dbc, $trimmed['p18']);}
 
if (empty($_POST["p19"])) {$p19 = $p19;}
else {$p19 = mysqli_real_escape_string ($dbc, $trimmed['p19']);} 

if (empty($_POST["p20"])) {$p20 = $p20;}
else {$p20 = mysqli_real_escape_string ($dbc, $trimmed['p20']);}
 
if (empty($_POST["p21"])) {$p21 = $p21;}
else {$p21 = mysqli_real_escape_string ($dbc, $trimmed['p21']);} 

if (empty($_POST["p22"])) {$p22 = $p22;}
else {$p22 = mysqli_real_escape_string ($dbc, $trimmed['p22']);}

if (empty($_POST["p23"])) {$p23 = $p23;}
else {$p23 = mysqli_real_escape_string ($dbc, $trimmed['p23']);} 
  
  $q = "SELECT bodypart, avgpain, p00, p01, p02, p03, p04, p05, p06, p07, p08, p09, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, entrytags FROM pain WHERE entryid = " . $_SESSION['entryid'];
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 1) { 
			$q = "UPDATE pain SET
			bodypart := '".mysqli_real_escape_string($dbc,$bodypart) ."',
			p00 := '".mysqli_real_escape_string($dbc,$p00) ."',
			p01 := '".mysqli_real_escape_string($dbc,$p01) ."',
			p02 := '".mysqli_real_escape_string($dbc,$p02) ."',
			p03 := '".mysqli_real_escape_string($dbc,$p03) ."',
			p04 := '".mysqli_real_escape_string($dbc,$p04) ."',
			p05 := '".mysqli_real_escape_string($dbc,$p05) ."',
			p06 := '".mysqli_real_escape_string($dbc,$p06) ."',
			p07 := '".mysqli_real_escape_string($dbc,$p07) ."',
			p08 := '".mysqli_real_escape_string($dbc,$p08) ."',
			p09 := '".mysqli_real_escape_string($dbc,$p09) ."',
			p10 := '".mysqli_real_escape_string($dbc,$p10) ."',
			p11 := '".mysqli_real_escape_string($dbc,$p11) ."',
			p12 := '".mysqli_real_escape_string($dbc,$p12) ."',
			p13 := '".mysqli_real_escape_string($dbc,$p13) ."',
			p14 := '".mysqli_real_escape_string($dbc,$p14) ."',
			p15 := '".mysqli_real_escape_string($dbc,$p15) ."',
			p16 := '".mysqli_real_escape_string($dbc,$p16) ."',
			p17 := '".mysqli_real_escape_string($dbc,$p17) ."',
			p18 := '".mysqli_real_escape_string($dbc,$p18) ."',
			p19 := '".mysqli_real_escape_string($dbc,$p19) ."',
			p20 := '".mysqli_real_escape_string($dbc,$p20) ."',
			p21 := '".mysqli_real_escape_string($dbc,$p21) ."',
			p22 := '".mysqli_real_escape_string($dbc,$p22) ."',
			p23 := '".mysqli_real_escape_string($dbc,$p23) ."',
			entrytags := '". $_SESSION['entrytags']. "',
			avgpain := ( $p00+ $p01 + $p02 + $p03 +$p04 + $p05 + $p06 + $p07 + $p08 + $p09 + $p10 + $p11 + $p12 + $p13 + $p14 + $p15 + $p16 + $p17 + $p18 + $p19 + $p20 + $p21 + $p22 + $p23) /24
			WHERE entryid = " . $_SESSION['entryid'] . "";
			
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

					if (mysqli_affected_rows($dbc) == 1) {

	$url = BASE_URL . 'newentry.php'; 
	ob_end_clean(); 
	header("Location: $url");

						
					}else {
						echo '<p class="error">The entry could not be changed due to a system error. We apologize for any inconvenience.</p>';
					}
			
		} else {
			echo '<p class="error">Something went wrong.</p>';
		}


	mysqli_close($dbc);
}

}




// IF NEW PAIN RELIEF RECORD GETS SUBMITTED

if (!empty($_POST['painrelief-submit'])) {

require (MYSQL);
	$trimmed = array_map('trim', $_POST);
	$year = $month = $day = $time = $medicine = $amount = $measure = $otherthings = $reliefrating = $sideeffects = FALSE;

// time
$hour = isset($_POST['time']) ? $_POST['time'] : false;
if ($hour) {
   } else {
     $hour ="0";
   }
// medicine
if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['medicine'])) {
		$medicine = mysqli_real_escape_string ($dbc, $trimmed['medicine']);
		// amount
		if (empty($_POST["amount"])) {
			echo '<p class="error"> If you enter a medicine name, you also need to enter the amount.</p>';
			}
		else {
			$amount = mysqli_real_escape_string ($dbc, $trimmed['amount']);
			//measure
			if (empty($_POST["measure"])) {
				echo '<p class="error"> If you enter an amount, you need to choose a measure.</p>';
			}
			else {
				$measure = isset($_POST['measure']) ? $_POST['measure'] : false;
				if ($measure == "milligrams") {}
				elseif ($measure == "millilitres") {}
				elseif ($measure == "na") {
				echo '<p class="error"> If you enter an amount, you need to choose a valid measure.</p>';	
				}
			}
			}
		
	} elseif (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['otherthings'])) {
		// otherthings
		$otherthings = mysqli_real_escape_string ($dbc, $trimmed['otherthings']);
	} else {
		echo '<p class="error"> You need to enter either the name of a medicine or other treatment method.</p>';
	}
// otherthings
if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['otherthings'])) {
		$otherthings = mysqli_real_escape_string ($dbc, $trimmed['otherthings']);}
// reliefrating
if (empty($_POST["reliefrating"])) {$reliefrating = 0;}
else {$reliefrating = mysqli_real_escape_string ($dbc, $trimmed['reliefrating']); }
// sideeffects
if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['sideeffects'])) {
		$sideeffects = mysqli_real_escape_string ($dbc, $trimmed['sideeffects']);
	} else {
		$sideeffects = "";
	}


// if there are no errors	
if ((($medicine) AND ($amount) AND ($measure) AND ($measure!='na')) OR ($otherthings)) {
 
  $q = "SELECT record_id FROM painrelief WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'] ." AND time='$hour' AND ((medicine='$medicine') OR (otherthings='$otherthings'))";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { 
			$q = "INSERT INTO painrelief SET
			user_id := '". $_SESSION['user_id'] . "',
			entryyear := '". $_SESSION['calyear'] . "',
			entrymonth := '". $_SESSION['calmonth']. "',
			entryday := '".mysqli_real_escape_string($dbc, $_SESSION['day']). "',
			time := '".mysqli_real_escape_string($dbc,$hour) ."',
			medicine := '".mysqli_real_escape_string($dbc,$medicine) ."',
			amount := '".mysqli_real_escape_string($dbc,$amount) ."',
			measure := '".mysqli_real_escape_string($dbc,$measure) ."',
			otherthings := '".mysqli_real_escape_string($dbc,$otherthings) ."',
			reliefrating := '".mysqli_real_escape_string($dbc,$reliefrating) ."',
			sideeffects := '".mysqli_real_escape_string($dbc,$sideeffects) ."'";
		
		
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_affected_rows($dbc) == 1) {

	$url = BASE_URL . 'newentry.php'; 
	ob_end_clean(); 
	header("Location: $url");

						
					}else {
						echo '<p class="error">The pain relief record not be added due to a system error. We apologize for any inconvenience.</p>';
					}
				}
		else {
			echo '<p class="error">You have already added this pain relief method for this time of the day. <br />If you increased the dose, please change the dose instead of creating a new record.</p>';
		}
	}

}



// IF PAIN RELIEF RECORD GETS CHANGED

if (!empty($_POST['changerelief-submit'])) {

require (MYSQL);
	$trimmed = array_map('trim', $_POST);

// time
$hour = isset($_POST['time']) ? $_POST['time'] : false;
if ($hour) {
   } else {
     $hour ="$time";
   }
// medicine
if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['medicine'])) {
		$medicine = mysqli_real_escape_string ($dbc, $trimmed['medicine']);
		// amount
		if (empty($_POST["amount"])) {
			$amount = $amount;
			}
		else {
			$amount = mysqli_real_escape_string ($dbc, $trimmed['amount']);
			//measure
			if (empty($_POST["measure"])) {
				$measure = $measure;
			}
			else {
				$measure = isset($_POST['measure']) ? $_POST['measure'] : false;
				if ($measure == "milligrams") {}
				elseif ($measure == "millilitres") {}
				elseif ($measure == "na") {
				echo '<p class="error"> If you enter an amount, you need to choose a valid measure.</p>';	
				}
			}
			}
		
	} elseif (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['otherthings'])) {
		// otherthings
		$otherthings = mysqli_real_escape_string ($dbc, $trimmed['otherthings']);
	} else {
		$otherthings = $otherthings;
	}
// otherthings
if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['otherthings'])) {
		$otherthings = mysqli_real_escape_string ($dbc, $trimmed['otherthings']);}
// reliefrating
if (empty($_POST["reliefrating"])) {$reliefrating = $reliefrating;}
else {$reliefrating = mysqli_real_escape_string ($dbc, $trimmed['reliefrating']); }
// sideeffects
if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['sideeffects'])) {
		$sideeffects = mysqli_real_escape_string ($dbc, $trimmed['sideeffects']);
	} else {
		$sideeffects = "$sideeffects";
	}


// if there are no errors	
if ((($medicine) AND ($amount) AND ($measure) AND ($measure!='na')) OR ($otherthings)) { 
		
		$q = "SELECT record_id, time, medicine, amount, measure, otherthings, reliefrating, sideeffects FROM painrelief WHERE record_id = " . $_SESSION['record_id'];
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 1) {
		
			$q = "UPDATE painrelief SET
			time := '".mysqli_real_escape_string($dbc,$hour) ."',
			medicine := '".mysqli_real_escape_string($dbc,$medicine) ."',
			amount := '".mysqli_real_escape_string($dbc,$amount) ."',
			measure := '".mysqli_real_escape_string($dbc,$measure) ."',
			otherthings := '".mysqli_real_escape_string($dbc,$otherthings) ."',
			reliefrating := '".mysqli_real_escape_string($dbc,$reliefrating) ."',
			sideeffects := '".mysqli_real_escape_string($dbc,$sideeffects) ."'
			WHERE record_id = " . $_SESSION['record_id'];
		
		
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_affected_rows($dbc) == 1) {

	$url = BASE_URL . 'newentry.php'; 
	ob_end_clean(); 
	header("Location: $url");

						
					}else {
						echo '<p class="error">The pain relief record not be added due to a system error. We apologize for any inconvenience.</p>';
					}
				}
		else {
			echo '<p class="error">You have already added this pain relief method for this time of the day. <br />If you increased the dose, please change the dose instead of creating a new record.</p>';
		}
	}

}




// IF NEW COMMENT GETS SUBMITTED

if (!empty($_POST['comment-submit'])) {
	
require (MYSQL);
$dbc = new mysqli($servername, $username, $password, $dbname);
if ($dbc->connect_error) {die("Connection failed: " . $dbc->connect_error);}

$trimmed = array_map('trim', $_POST);
if (empty($_POST["comment"])) {echo "You have not written anything.";}
else {$comment = mysqli_real_escape_string ($dbc, $trimmed['comment']);}

$sql = "SELECT comment FROM comments WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'];
$result = $dbc->query($sql);


if ($result -> num_rows == 0) {
		 $q = "INSERT INTO comments SET
		 comment := '". mysqli_real_escape_string($dbc,$comment) ."',
		 entryyear := '". $_SESSION['calyear'] ."',
		 entrymonth := '". $_SESSION['calmonth'] ."',
		 entryday := '". $_SESSION['day'] ."',
		 user_id := '". $_SESSION['user_id'] ."'";
		 $result = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		 echo $q;
}

else {
echo '<p class="error">You have already added a comment for this day.</p>';
}

if (mysqli_affected_rows($dbc) == 1) {

	$url = BASE_URL . 'newentry.php'; 
	ob_end_clean(); 
	header("Location: $url");

						
}else {
echo '<p class="error">The comment could not be added due to a system error. We apologize for any inconvenience.</p>';
}
}
}



// IF CHANGED COMMENT GETS SUBMITTED

if (!empty($_POST['comment-resubmit'])) {
	
require (MYSQL);
$dbc = new mysqli($servername, $username, $password, $dbname);
if ($dbc->connect_error) {
     die("Connection failed: " . $dbc->connect_error);
}

$trimmed = array_map('trim', $_POST);

if (empty($_POST["comment2"])) {
	echo "You have not written anything.";}
else
	{$comment2 = mysqli_real_escape_string ($dbc, $trimmed['comment2']);
	echo $comment2;}

$sql = "SELECT comment FROM comments WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'];
$result = $dbc->query($sql);


if (mysqli_num_rows($result) == 1) {
		 $q = "UPDATE comments SET
		 comment := '". mysqli_real_escape_string($dbc,$comment2) ."'
		 WHERE entryyear=". $_SESSION['calyear'] ." AND entrymonth=". $_SESSION['calmonth'] ." AND entryday=". $_SESSION['day'] ." AND user_id=". $_SESSION['user_id'];
		 $result = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		 echo $q;
}

if (mysqli_affected_rows($dbc) == 1) {

	$url = BASE_URL . 'newentry.php'; 
	ob_end_clean(); 
	header("Location: $url");

						
}else {
echo '<p class="error">The comment could not be edited due to a system error. We apologize for any inconvenience.</p>';
}
}
?>
</div>
</body>
</html>