

<?php
include("dbconnect.php");

session_start();

error_reporting(E_ALL);

// this is the simple check if we're NOT logged in - if we ARE, do nothing (there's no "else")
if (!isset($_SESSION['username'])){
	// check if we came from a form (with username) - this could be more robust (check for our specific login form)
	if (isset($_POST['tcmc01username'])) {
		// now do the username/password check - this could be a proper database lookup
		$user = $_POST['tcmc01username'];
		$sql = "SELECT * FROM members WHERE contactemail = '$user'";
		foreach ($dbh->query($sql) as $row){
			if ($_POST['tcmc01password'] == $row[password]){
				// Yes, valid credentials - set message and set session variable for logged in
				$_SESSION['username'] = $_POST['tcmc01username'];
				$_SESSION['firstname'] = $row[firstname];
				$_SESSION['lastname'] = $row['lastname'];
				$_SESSION['signinnmsg'] = "Logged in!";
				$_SESSION['level'] = $row[member_level];
				// Generate a new session ID for a new successful login
				session_regenerate_id();
			}
			else{
				$_SESSION['signinmsg'] = "Invalid username and/or password!";
				// redirect them to the login page, protecting our secure page
				header("Location: membership.php");
				exit();
			}
		}
	}
	else // they didn't come from a form - tell them to log in, redirecting to login page
	{
		$_SESSION['signinmsg'] = "You must log in first";
		header("Location: membership.php");
		exit();
	}
}
?>