<?php
include("dbconnect.php")
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>2010 Milestone 1</title>
</head>

<body>

<?php 

$id = $_GET['tag'];

$sql = "SELECT * FROM artist WHERE id = $id";
foreach ($dbh->query($sql) as $row){
	printf("Artist: %s<br/>\n Details: %s<br/>\n Contact: %s<br/>\n Performance Date: %s<br/>\n Performance Venue: %s<br/>\n", $row[name], $row[details], $row[contact], $row[perf_date], $row[perf_loc]);
}

printf("Categories:");
$sql2 = "SELECT * FROM categories WHERE id = $id";
foreach ($dbh->query($sql2) as $row){
	printf("%s<br/>\n", $row[category]);
}



?>
</body>
</html>