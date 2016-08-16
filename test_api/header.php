<?php
	define('clientId', 'yourid');
	define('CLIENT_SECRET', 'secret');
	define('BASE_URL', 'the base url');
	define('API_URL', 'https://api-test.mediaconnect.no/login/createUser?clientId='.clientId);
	define('ORDER_URL', 'https://api-test.mediaconnect.no/login/order?clientId='.clientId); 
	
	
	$returnUrl = urlencode(BASE_URL.'return_url.php');
	$errorUrl = urlencode(BASE_URL.'error_url.php');
	$successUrl = urlencode(BASE_URL.'success_url.php');
	
	$authorizeUrl = 'https://api-test.mediaconnect.no/login/oauth/authorize';
	$accessTokenUrl = 'https://api-test.mediaconnect.no/login/oauth/token';
	$clientId = clientId;
	$clientSecret = CLIENT_SECRET;
	$userAgent = 'user and agent';
	
	$url = API_URL.'&returnUrl='.$returnUrl.'&errorUrl='.$errorUrl;
	$order_url = ORDER_URL.'&returnUrl='.$successUrl.'&errorUrl='.$errorUrl;
	
	$redirectUrl = urldecode(BASE_URL.'second_url.php');
?>