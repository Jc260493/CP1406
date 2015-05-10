<?php
include("dbconnect.php")

//TODO
//finalise user inputs

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="mainstyles.css" rel="stylesheet" type="text/css">
<title>Filtered Musicians - TCMC</title>

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


	<div id = 'fullartistdiv'>

<?php 

$id = $_GET['tag'];

$sql = "SELECT * FROM artist WHERE id = $id";
foreach ($dbh->query($sql) as $row){

	if(!empty($row[name])){
		echo '<h1>';
		printf("%s<br/>\n", $row[name]);
		echo '</h1>';
	}
	?>
	
	<div id = 'imageContainer'>
	<img src=<?php echo $row[images_path]; ?>>
	</div>
	
	<?php
	if(!empty($row[details])){
		echo '<h3>';
		printf("Bio:<br/>\n");
		echo '</h3>';
		printf("%s<br/>\n", $row[details]);
	}
	if(!empty($row[contact]) && !empty($row[website])){
		echo '<h3>';
		printf("Contact:<br/>\n");
		echo '</h3>';
		if(!empty($row[contact])){
			printf("Email: %s<br/>\n", $row[contact]);
		}
		if(!empty($row[website])){
			printf("Website: %s<br/>\n", $row[website]);
		}
	}
	if(!empty($row[perf_date]) && !empty($row[perf_loc])){
		echo '<h3>';
		printf("Upcoming Performance:<br/>\n");
		echo '</h3>';
		if(!empty($row[perf_date])){
			printf("Performance Date: %s<br/>\n", $row[perf_date]);
		}
		if(!empty($row[perf_loc])){
			printf("Performance Location: %s<br/>\n", $row[perf_loc]);
		}
	}
}

if(!empty($row[category])){
	$sql2 = "SELECT DISTINCT * FROM categories WHERE id = $id";
	echo '<h3>';
	printf("Categories:");
	echo '</h3>';
	foreach ($dbh->query($sql2) as $row){
		printf("%s<br/>\n", $row[category]);
	}
}
?>



<br/>
<a href = "index.php">Return to Artists Page</a>
</div>


<?php
include("inc_footer.php");
?>
</div>
</div>
</div>
</body>
</html>