<?php
session_start();
include("dbconnect.php")

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Membership - TCMC</title>
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

<div id="membershipdiv">
<h1>Membership</h1>
<?php
if (!isset($_SESSION['username'])) {
	?>
	
		<div id="memlogindiv">

	<h2>Login</h2>
	<?php 

		if (isset($_SESSION['signupmsg'])) {
		if ($_SESSION['signinmsg'] == "Signed In!"){
			echo "<p style='color:green'>".$_SESSION['signinmsg']."</p>"; 
		}else{
			echo "<p style='color:red'>".$_SESSION['signinmsg']."</p>"; 
		}
	}
	if (!isset($_SESSION['username'])) {
		?>
		<form id="login" name="login" method="post" action="dbprocesslogin.php">
		<table id = "logintable">
		<tr>
			<th> <label for="tcmc01username">Email:</label></th>
			<th> <input type="text" name="tcmc01username" id="tcmc01username"></th>
		 </tr>
		 <tr>
			<th><label for="tcmc01password">Password:</label></th>
			<th> <input type="password" name="tcmc01password" id="tcmc01password"></th>
		  </th>
		</table>
			<input type="submit" name="submit" value="Login">
			
		</form>
	 <?php } ?>
	</pre>
	<?php 
	if (isset($_SESSION['username'])) {
		echo '<a href="logout.php">Logout</a>';
	}
	?>    


	</div>
	<div id="memsignupdiv">

	<h2>Sign Up</h2>
	<?php
	
	if (isset($_SESSION['signupmsg'])) {
		if ($_SESSION['signupmsg'] == "Signed Up!"){
			echo "<p style='color:green'>".$_SESSION['signupmsg']."</p>"; 
		}else{
			echo "<p style='color:red'>".$_SESSION['signupmsg']."</p>"; 
		}
	}
	if (!isset($_SESSION['username'])) {
		?>
		<form id="login" name="login" method="post" action="dbprocesssignup.php">
		<table id = "signuptable">
		 <tr>
			<th> <label for="tcmc01username">Email:</label></th>
			<th><input type="text" name="tcmc01username" id="tcmc01username"></th>
		  </tr>
		<tr>
			<th><label for="password">Password:</label></th>
			<th><input type="password" name="password" id="password"></th>
		</tr>
		<tr>
			 <th><label for="firstname">First Name:</label></th>
			 <th><input type="text" name="firstname" id="firstname"></th>
		 </tr>
		 <tr>
			<th><label for="lastname">Last Name:</label></th>
			<th><input type="text" name="lastname" id="lastname"></th>
		 </tr>
		 <tr>
			<th><label for="addressnumber">Address Number:</label></th>
			<th><input type="text" name="addressnumber" id="addressnumber"></th>
		 </tr>
		 <tr>
			<th><label for="addressstreet">Address Street:</label></th>
			<th><input type="text" name="addressstreet" id="addressstreet"></th>
		  </tr>
		  <tr>
			<th><label for="addresssuburb">Address Suburb:</label></th>
			<th><input type="text" name="addresssuburb" id="addresssuburb"></th>
		  </tr>
		  <tr>
			<th> <label for="contactnumber">Contact Number:</label></th>
			<th><input type="text" name="contactnumber" id="contactnumber"></th>
		  </tr>
		 
		  </table>
			<input type="submit" name="submit" value="SignUp">
		</form>
		
	<?php 
	}else {
		echo $_SESSION['msg'];
		echo '<br>';
		echo '<br>';
		echo '<a href="logout.php">Logout</a>';
	}
	?>    

	</div>


	<?php
}else{
	echo "Welcome ".$_SESSION['firstname'];
	?>

	<form id="logout" name="logout" method="post" action="logout.php">
		<button type="submit" name="logoutbutton" id="logoutbutton">Log Out</button>
	</form>
	<?php
}
	
if($_SESSION['level'] == 3){
	?>
<table id="updatemembertable">
<?php
	$sql = "SELECT * FROM members WHERE member_level = 1";
	foreach ($dbh->query($sql) as $row){
		$contactemail = $row['contactemail'];
		?>
		
		<form id="setmemberlevel" name="setmemberlevel" method="post" action="dbprocesssignup.php">
		
		
		<tr>
		<?php
			echo"<th><label for='contactemail'>$contactemail</label> </th>";
			echo"<input type='hidden' name='contactemail' value= $contactemail>";
		?>
		<th><input type="submit" name="submit" value="Increase Member Level" /></th>
		</tr>
		
		</form>
	
	


<?php
}

?>
	</table>
	<?php
}



include("inc_footer.php");
?>

</div>


</div>
</div>
</div>
</body>
</html>