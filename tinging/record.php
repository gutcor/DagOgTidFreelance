<?php require_once './database/database.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title> Dashboard </title>
</head>
<body>
	<h1>Dashboard</h1>
	<?php 
		$db = Database::getInstance();
		$conn = $db->getConnection();
		
		$sql = "SELECT * FROM orders ORDER BY id";
		$results = $conn->query($sql);
		if( $results ):
		
			while ($res = $results->fetch_object()):
		?>	
			<div>	
				<?php print_r($res); ?>
			</div> </br>		
	<?php 		
			endwhile;	
		endif;
		//print_r($results);
	?>
</body>
</html>