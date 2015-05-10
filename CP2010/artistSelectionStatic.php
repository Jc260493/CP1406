<?php
include("dbconnect.php")

//TODO
//finalise user inputs

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Filtered Musicians - TCMC</title>
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

<?php
include("inc_account.php");
?>

<h1>Filtered Musicians</h1>

 <?php
    $selectedcat = $_POST['formCat'];
    echo '<h2>';
    print($selectedcat);
    echo '</h2>';
    $sql = "SELECT * FROM categories WHERE category = '$_POST[formCat]'";

    foreach ($dbh->query($sql) as $row){

        
        $sql = "SELECT * FROM artist WHERE id = $row[id]";
            foreach ($dbh->query($sql) as $row2){
            echo '<div id = "div2">';
            echo '<h3>';
            printf("<a href = \"artistFullStatic.php?tag=%s\">%s</a><br/>\n", $row2[id], $row2[name]);
            echo '</h3>';
            echo '<div id = imageContainer>';
            printf('<a href = \~tcmc01/a2/artistFullStatic.php?tag=%s>', $row2[id])
            ?> <img src=<?php echo $row2[images_path]; ?>></a>
            </div>
            </div>
            <?php
}

}
print("<br>");
    ?>

<?php
include("inc_footer.php");
?>
</div>
</div>
</div>
</body>
</html>
