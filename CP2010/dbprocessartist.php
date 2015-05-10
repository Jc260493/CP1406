<?php

include("dbconnect.php");

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link href="mainstyles.css" rel="stylesheet" type="text/css">
<title>2010 Milestone 1 - Results Page</title>
</head>

<body>

<?php


 if ($_REQUEST['submit'] == "Insert Entry"){
	 
//image upload to server
     $target_dir = "img/";
     $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
     move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],            $target_file);

//setting feature artist
	if($_REQUEST[featartist] == "Y" || $_REQUEST[featartist] == "y"){
		$sql = "UPDATE artist SET featartist = 'N'";
		$dbh->exec($sql);
        $feat = "Y";
	}else{
        $feat = "N";
    }

//inserts into artist table
	$id = $_REQUEST[id];
	$sql = "INSERT INTO artist (name, details, contact, website,  perf_date, perf_loc, category, featartist, images_path) VALUES ('$_REQUEST[name]', '$_REQUEST[details]', '$_REQUEST[contact]', '$_REQUEST[website]', '$_REQUEST[perf_date]', '$_REQUEST[perf_loc]', '$_REQUEST[category]', '$feat', '$target_file')";
    if($dbh->exec($sql)){
        echo 'inserted';
    }else{ echo 'not inserted';
				echo "<br/>ensure inputs do not include apostrophes";
	}
	
//separates categories out, inserts each category as entry in category table
	$sql = "SELECT * FROM artist WHERE name = '$_REQUEST[name]'";
	foreach ($dbh->query($sql) as $row){
		$length = count(explode(", ", $row[category]));
		for($x = 0; $x < $length; $x++){
			$current = (string)explode(", ", $row[category])[$x];
			$current = ltrim($current);
            $current = rtrim($current);
			//printf(" %s - %s<br/>\n", $row[name], $current);
			$sql = "INSERT INTO categories (id, category) VALUES ($row[id], '$current')";
			$dbh->exec($sql);
	}
}	


}else if ($_REQUEST['submit'] == "Delete Entry"){
	
//delete entry from artist table
	unlink($_REQUEST[images_path]);
	
	$sql = "DELETE FROM artist WHERE id = '$_REQUEST[id]'";
     if($dbh->exec($sql)){
        echo "deleted $_REQUEST[name]";
		
    }else{ echo 'not deleted';}

//delete all entries for if in category table
	$sql = "DELETE FROM categories WHERE id = '$_REQUEST[id]'";
	$dbh->exec($sql); 
	
	
}else if ($_REQUEST['submit'] == "Update Entry"){
 
 //setting feature artist
     	if($_REQUEST[featartist] == "Y" || $_REQUEST[featartist] == "y"){
		  $sql = "UPDATE artist SET featartist = 'N'";
		  $dbh->exec($sql);
            $feat = "Y";
	   }else{
            $feat = "N";
        }
	
//update entry in artist table
		$sql = "UPDATE artist SET name = '$_REQUEST[name]', details = '$_REQUEST[details]', contact = '$_REQUEST[contact]', website = '$_REQUEST[website]', featartist = '$feat', perf_date = '$_REQUEST[perf_date]', perf_loc = '$_REQUEST[perf_loc]', category = '$_REQUEST[category]', images_path = '$_REQUEST[uploadedimage]' WHERE id = '$_REQUEST[id]'";
		if($dbh->exec($sql)){
			echo "updated $_REQUEST[name]";
		}else{ echo 'not updated';
			echo "<br/>ensure inputs do not include apostrophes";
		}
		
//deletes old entries
		$sql = "DELETE FROM categories WHERE id = '$_REQUEST[id]'";
		$dbh->exec($sql); 
		
//creates new entries for all categories in category table
		$sql = "SELECT * FROM artist WHERE name = '$_REQUEST[name]'";
		foreach ($dbh->query($sql) as $row){
			$length = count(explode(", ", $row[category]));
			for($x = 0; $x < $length; $x++){
				$current = explode(",", $row[category])[$x];
                $current = ltrim($current);
                $current = rtrim($current);
				//printf(" %s - %s<br/>\n", $row[name], $current);
				$sql = "INSERT INTO categories (id, category) VALUES ($row[id], '$current')";
				$dbh->exec($sql);
			}
		}	
}



$dbh = null;
?>
<br/>
<a href = "index.php">Return to Artists Page</a>;
</body>
</html>