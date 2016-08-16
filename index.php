<?php
	//http://live.intouch.no/tk/search.php?qry=004533272727&maxpass=1&format=json
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Intouch api use</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.js"></script>
  <script src="js/main.js"></script>
</head>
<body>
	<div class="container theme-showcase">
		<div class="jumbotron" style="margin-top:1%;">
			<form action="get_number.php" id="getNumber" >
				<div class="form-group">
				  <label for="usr">Phone Number:</label>
				  <input type="text" class="form-control" name="phone" id="phone">
				</div>
				<div  class="form-group">
					<input type="submit" value="Submit" class="btn btn-lg btn-default"id="submit_phone" name="submit_phone" >
				</div>
			</form>
			<form action="" id="result">
				<div class="form-group">
				  <label for="usr">postnr:</label>
				  <input type="text" class="form-control" name="postnr" id="postnr" disabled>
				</div>
				<div class="form-group">
				  <label for="usr">etternavn:</label>
				  <input type="text" class="form-control disabled" name="etternavn" id="etternavn" disabled>
				</div>
				<div class="form-group">
				  <label for="usr">fornavn:</label>
				  <input type="text" class="form-control disabled" name="fornavn" id="fornavn" disabled>
				</div>
			</form>
		</div>
	</div>
</body>
</html>