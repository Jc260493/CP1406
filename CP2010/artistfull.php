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
	if(!empty($row[name])){
		printf("Artist: %s<br/>\n", $row[name]);
	}
	if(!empty($row[details])){
		printf("Details: %s<br/>\n", $row[details]);
	}
	if(!empty($row[contact])){
		printf("Contact: %s<br/>\n", $row[contact]);
	}
	if(!empty($row[perf_date])){
		printf("Performance Date: %s<br/>\n", $row[perf_date]);
	}
	if(!empty($row[perf_loc])){
		printf("Performance Location: %s<br/>\n", $row[perf_loc]);
	}
}

printf("Categories:");
$sql2 = "SELECT * FROM categories WHERE id = $id";
foreach ($dbh->query($sql2) as $row){
	printf("%s<br/>\n", $row[category]);
}
?>

<br/>
<a href = "artist.php">Return to Artists Page</a>;

</body>
</html>