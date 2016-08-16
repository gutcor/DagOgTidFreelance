<?php require_once('./header.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Test Api </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#redirect').submit(function(e){
				window.location.href = '<?php print $url; ?>';
				e.preventDefault();
			});
		});
	</script>
</head>
<body>
	<h1>Test Api</h1>
	<form action="" id='redirect'>
		<input type="submit" value="Redirect" id=''>
	</form>
</body>
</html>