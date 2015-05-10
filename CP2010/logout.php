<?php session_start();
$firstname = $_SESSION['firstname']; // store so we can use it one more time for goodbye message
unset($_SESSION['username']);
unset($_SESSION['signinmsg']);
unset($_SESSION['firstname']);
unset($_SESSION['signupmsg']);
unset($_SESSION['count']);
unset($_SESSION['level']);
session_regenerate_id(FALSE);
session_destroy(); 

session_start();

//error_reporting(E_ALL);

include("dbconnect.php")

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="mainstyles.css" rel="stylesheet" type="text/css">
<title>Logged Out - TCMC</title>

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

<?php
include("inc_account.php");
$_SESSION['signinnmsg'] = "Logged out!";
header("Location: membership.php");
?>


<h1>Logged out</h1>
<p>Goodbye <?php echo $firstname; ?>.</p>


<?php
include("inc_footer.php");
?>
</div>
</div>
</div>
</body>
</html>