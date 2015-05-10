
<?php
session_start();
include("dbconnect.php")
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Signed Up - TCMC</title>
<link href="mainstyles.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="container">
<div id="logo">
<img src="TCMClogo.jpg">
<div id="navbar">
<?php
include("inc_nav.php")
?>
</div>
<div id="content">
<h1> Sign Up </h1>
<?php

$match = 0;

//for admin use to change paid members to level 2
 if ($_REQUEST['submit'] == "Increase Member Level"){
	$sql = "UPDATE members SET member_level = '2' WHERE contactemail = '$_REQUEST[contactemail]'";
	 if($dbh->exec($sql)){
        echo 'Change Successful';
    }else{ echo 'Change not Successful';
	}
//for end users to sign up
 }else {
	 
	 if($_POST['tcmc01username'] !="" && $_POST['password'] !="" && $_POST['firstname'] !="" && $_POST['lastname'] !="" && $_POST['addressnumber'] !="" && $_POST['addressstreet'] !="" && $_POST['addresssuburb'] !="" && $_POST['contactnumber'] !=""){
		 
		 //checks if email is already in use
		$sql = "SELECT contactemail FROM members";
		foreach ($dbh->query($sql) as $row){
			if($row[contactemail] == $_REQUEST[tcmc01username]){
				$match = 1;
				break;
			}
		}
		
		//if in use, displays error, else creates account
		if($match == 1){
			$_SESSION['signupmsg'] = "Email already in use";
			header("Location: membership.php");
			//echo 'Sign Up not Successful test';
			break;
		}else {
			$sql = "INSERT INTO members (contactemail, password, firstname, lastname, addressnumber, addressstreet, addresssuburb, contactnumber) VALUES ('$_REQUEST[tcmc01username]', '$_REQUEST[password]', '$_REQUEST[firstname]', '$_REQUEST[lastname]', '$_REQUEST[addressnumber]', '$_REQUEST[addressstreet]', '$_REQUEST[addresssuburb]', '$_REQUEST[contactnumber]')";
			if($dbh->exec($sql)){
				//echo 'Sign Up Successful';
				$_SESSION['signupmsg'] = "Signed Up!";
				header("Location: membership.php");
				break;
			}else{ 
				$_SESSION['signupmsg'] = "Error Occured, Try Again";
				break;
			}
	}
		
	 }else {
		 $_SESSION['signupmsg'] = "Fill In all Fields";
		header("Location: membership.php");
	 }
	

 }
	 ?>

<?php
include("inc_footer.php")
?>
</div>
</div>
</div>
</body>
</html>