<?php
session_start();
include("dbconnect.php")

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Musicians - TCMC</title>
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

<div id = "artistsdiv">

<h1>Musicians</h1>
<h2>Current Musicians</h2>


<form id="catselect" name="catselect" method="post" action="artistSelectionStatic.php">
    <select name="formCat" id = "formCat">
        <option value="">Select...</option>
        <?php
            $sql = "SELECT DISTINCT category from categories";
            foreach ($dbh->query($sql) as $row){
                $category= $row["category"];
                echo "<option value=\"$category\">$category</option>";
    
}

?>
    </select>
    <input type="submit" name="submit" value="Filter Artists" />
</form>

<?php
$sql = "SELECT * FROM artist WHERE featartist = 'Y'";
foreach ($dbh->query($sql) as $row){
	echo '<div id = "singlediv">';

	echo '<div id = imageContainer>';
	printf('<a href = \~tcmc01/a2/artistFullStatic.php?tag=%s>', $row[id])
	?> <img src=<?php echo $row[images_path]; ?>></a>
	</div>
	<?php
	echo '<h3>';
	printf("<a href = \"artistFullStatic.php?tag=%s\">%s</a><br/>\n", $row[id], $row[name]);
	echo '</h3>';
	echo '<h4>';
	print($row[details]);
	echo '</h4>';
	?>
	</div>
	<?php
}

?>

<?php
$sql = "SELECT * FROM artist WHERE featartist = 'N'";
foreach ($dbh->query($sql) as $row){
	echo '<div id = "singlediv">';

	echo '<div id = imageContainer>';
	printf('<a href = \~tcmc01/a2/artistFullStatic.php?tag=%s>', $row[id])
	?> <img src=<?php echo $row[images_path]; ?>></a>
	</div>
	<?php
	echo '<h3>';
	printf("<a href = \"artistFullStatic.php?tag=%s\">%s</a><br/>\n", $row[id], $row[name]);
	echo '</h3>';
	echo '<h4>';
	print($row[details]);
	echo '</h4>';
	?>
	</div>
	<?php
}
?>


</div>

<?php

if($_SESSION['level'] == 2 || $_SESSION['level'] == 3){


	?>


	<form id="insertForm" name="insertForm" method="post" action="dbprocessartist.php" enctype="multipart/form-data">
	<fieldset class="subtleSet">
		
		<h2>Insert New Musicians Entry:</h2>
		<table id = 'inputtable'>

		<tr>
		  <th><label for="name">Name: </label> </th>
		  <th><input type="text" name="name" id="name"> </th>
		</tr>
		<tr>
		 <th> <label for="details">Details: </label> </th>
		  <th><input type="text" name="details" id="details"> </th>
		</tr>
		<tr>
		 <th> <label for="contact">Contact: </label> </th>
		  <th><input type="text" name="contact" id="contact"> </th>
		</tr>
		<tr>
		  <th><label for="website">Website: </label> </th>
		  <th><input type="text" name="website" id="website"> </th>
		</tr>
		<tr>
		   <th><label for="featartist">Featured Artist: </label> </th>
		   <th><input type="checkbox" name="featartist" value = "Y"> </th>
		</tr>
		<tr>
		  <th><label for="perf_date">Performance Date: </label> </th>
		  <th><input type="text" name="perf_date" id="perf_date"> </th>
		</tr>
		<tr>
		  <th><label for="perf_loc">Performance Venue: </label> </th>
		  <th><input type="text" name="perf_loc" id="perf_loc"> </th>
		</tr>
		<tr>
		  <th><label for="category">Categories (Seperate with ,): </label> </th>
		  <th><input type="text" name="category" id="category"> </th>
		</tr>
		<tr>
		   <th><label for="uploadedimage">Image: </label> </th>
		   <th><input type="file" name="fileToUpload" id="fileToUpload"> </th>
		</tr>
		</table>
		<p>
			<input type="submit" name="submit" id="submit" value="Insert Entry">
			<?php echo "<input type='hidden' name='id'  value='$row[id]' />" ?>
		</p>
		
	</fieldset>
	</form>

	<fieldset class="subtleSet">
	<h2>Edit Existing Musicians: </h2>

	<?php
		$sql = "SELECT * FROM artist";
	foreach ($dbh->query($sql) as $row){
		?>
		<form id="alterForm" name="alterForm" method="post" action="dbprocessartist.php">
		<?php
			echo "<input type='text' name='name' value='$row[name]' /> <input type='text' name='details' value='$row[details]' /> <input type='text' name='contact' value='$row[contact]' /> <input type='text' name='website' value='$row[website]' />  <input type = 'text' name = 'featartist' value = '$row[featartist]' /> <input type='text' name='perf_date' value='$row[perf_date]' /> <input type='text' name='perf_loc' value='$row[perf_loc]' /> <input type='text' name='category' value='$row[category]' /> <input type='text' name='uploadedimage' value='$row[images_path]' />\n";
			echo "<input type='hidden' name='id' value='$row[id]' />";
			echo "<input type='hidden' name='images_path' value='$row[images_path]' />";
		?>
		<input type="submit" name="submit" value="Update Entry" />
		<input type="submit" name="submit" value="Delete Entry" class="deleteButton">
		<br/>
		</form>

		<?php

	}
echo "</fieldset>\n";

}


?>
<?php
include("inc_footer.php");
?>
</div>
</div>
</div>
</body>
</html>
