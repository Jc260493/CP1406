<?php

include("dbconnect.php");



?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>2010 Milestone 1 - Results Page</title>
</head>

<body>

<?php


 if ($_REQUEST['submit'] == "Insert Entry"){
	$sql = "INSERT INTO artist (name, details, contact, perf_date, perf_loc, category) VALUES ('$_REQUEST[name]', '$_REQUEST[details]', '$_REQUEST[contact]', '$_REQUEST[perf_date]', '$_REQUEST[perf_loc]', '$_REQUEST[category]')";
    if($dbh->exec($sql)){
        echo 'inserted';
    }else{ echo 'not inserted';}
     
     
	$test = "SELECT * FROM artist WHERE name = '$_REQUEST[name]'";
	foreach ($dbh->query($test) as $row){
		$length = count(explode(", ", $row[category]));
		for($x = 0; $x < $length; $x++){
			$current = (string)explode(", ", $row[category])[$x];
			//printf(" %s - %s<br/>\n", $row[name], $current);

			$sql4 = "INSERT INTO categories (id, category) VALUES ($row[id], '$current')";
			$dbh->exec($sql4);
	}
}	


}else if ($_REQUEST['submit'] == "Delete Entry"){
	$sql = "DELETE FROM artist WHERE id = '$_REQUEST[id]'";
     if($dbh->exec($sql)){
        echo 'deleted';
    }else{ echo 'not deleted';}

	$sql2 = "DELETE FROM categories WHERE id = '$_REQUEST[id]'";
	$dbh->exec($sql2); 
	
	
	
}else if ($_REQUEST['submit'] == "Update Entry"){
	$sql = "UPDATE artist SET name = '$_REQUEST[name]', details = '$_REQUEST[details]', contact = '$_REQUEST[contact]', perf_date = '$_REQUEST[perf_date]', perf_loc = '$_REQUEST[perf_loc]', category = '$_REQUEST[category]' WHERE id = '$_REQUEST[id]'";
    if($dbh->exec($sql)){
        echo 'updated';
    }else{ echo 'not updated';}

	$sql2 = "DELETE FROM categories WHERE id = '$_REQUEST[id]'";
	$dbh->exec($sql2); 
	
	
	$test = "SELECT * FROM artist WHERE id = '$_REQUEST[id]'";
	foreach ($dbh->query($test) as $row){
		$length = count(explode(", ", $row[category]));
		for($x = 0; $x < $length; $x++){
			$current = explode(", ", $row[category])[$x];
			//printf(" %s - %s<br/>\n", $row[name], $current);
			$sql4 = "INSERT INTO categories (id, category) VALUES ($row[id], $current)";
			$dbh->exec($sql4);
	}
}	
}




$dbh = null;
?>
<br/>
<a href = "artist.php">Return to Artist Page</a>;
</body>
</html>