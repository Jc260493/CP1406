<link href="mainstyles.css" rel="stylesheet" type="text/css">

<div id="accountoptions">
<?php
if (!isset($_SESSION['username'])){
	?>
<div id='signupdiv'>
<form id="signup" name="signup" method="post" action="membership.php">
  <button type="submit" name="signupbutton" id="signupbutton">Sign Up</button>
 </form>
 </div>
 <div id='logindiv'>
<form id="login" name="login" method="post" action="membership.php">
	<button type="submit" name="loginbutton" id="loginbutton">Sign In </button>
</form>
</div>
<?php
}else{
	echo "Welcome ".$_SESSION['username'];
	?>

	<form id="logout" name="logout" method="post" action="logout.php">
		<button type="submit" name="logoutbutton" id="logoutbutton">Log Out</button>
	</form>
	<?php

	}
?>
</div>

