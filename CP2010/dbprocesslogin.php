<?php require("authenticate.php"); 
/*	Use include/require to avoid duplicating code.  
	In this case, authenticate is included for every page we want to secure/protect.
*/ 

// count number of visits
if (isset($_SESSION['count']))
    $_SESSION['count'] += 1;
else
    $_SESSION['count'] = 1;
?>
<!doctype html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Welcome - TCMC</title>
</head>

<body>
<?php
header("Location: membership.php");
?>

</body>
</html>
