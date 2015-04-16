<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>2010 Milestone 1</title>


<style>
   #div1 {
	   font-weight: bold;
	   border-style: solid;
	   border-width: 1px;
	   
			}

</style>


</head>

<body>

<h1>Artist Database?</h1>

<form id="insert" name="insert" method="post" action="dbprocessartist.php">
<fieldset class="subtleSet">
    <h2>Insert New Artist Entry:</h2>
    <p>
      <label for="name">Name: </label>
      <input type="text" name="name" id="name">
    </p>
	<p>
      <label for="details">Details: </label>
      <input type="text" name="details" id="details">
    </p>
	<p>
      <label for="contact">Contact: </label>
      <input type="text" name="contact" id="contact">
    </p>
	<p>
      <label for="perf_date">Performance Date: </label>
      <input type="text" name="perf_date" id="perf_date">
    </p>
	<p>
      <label for="perf_loc">Performance Venue: </label>
      <input type="text" name="perf_loc" id="perf_loc">
    </p>
	<p>
      <label for="category">Categories (Seperate with ,): </label>
      <input type="text" name="category" id="category">
    </p>
	<p>
	   <label for="uploadedimage">Image: </label>
	   <input type="file" name = "uploadedimage">
	</p>
    <p>
        <input type="submit" name="submit" id="submit" value="Insert Entry">
    </p>
	
</fieldset>
</form>

<fieldset class="subtleSet">
<h2>Edit Existing Artists: </h2>

<?php
$sql = "SELECT * FROM artist";
foreach ($dbh->query($sql) as $row){
?>
<form id="deleteForm" name="deleteForm" method="post" action="dbprocessartist.php">
<?php
	echo "<input type='text' name='name' value='$row[name]' /> <input type='text' name='details' value='$row[details]' /> <input type='text' name='contact' value='$row[contact]' /> <input type='text' name='perf_date' value='$row[perf_date]' /> <input type='text' name='perf_loc' value='$row[perf_loc]' /> <input type='text' name='category' value='$row[category]' />\n";
	echo "<input type='hidden' name='id' value='$row[id]' />";
?>
<input type="submit" name="submit" value="Update Entry" />
<input type="submit" name="submit" value="Delete Entry" class="deleteButton">
</form>

<?php

}
echo "</fieldset>\n";

?>

<div id = "div1" border-radius: 25px;>
<h2>Current Artists</h2>



<?php
$sql = "SELECT * FROM artist";
foreach ($dbh->query($sql) as $row){
	printf("<a href = \"artistfull.php?tag=%s\">%s</a><br/>\n", $row[id], $row[name]);
}


?>



</div>
</body>
</html>