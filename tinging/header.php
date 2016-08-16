<?php

	define('clientId', 'no.dagogtid');

	define('CLIENT_SECRET', '5F[[xTw.3L*5');

	define('BASE_URL', 'http://dagogtid.com/tinging/');

	define('API_URL', 'https://connectid.no/user/createUser?clientId='.clientId);

	define('ORDER_URL', 'https://connectid.no/user/order?clientId='.clientId); 

	
	$returnUrl = urlencode(BASE_URL.'return_url.php');

	$errorUrl = urlencode(BASE_URL.'error_url.php');

	$successUrl = urlencode(BASE_URL.'success_url.php');

	

	$authorizeUrl = 'https://connectid.no/user/oauth/authorize';

	$accessTokenUrl = 'https://connectid.no/user/oauth/token';

	$clientId = clientId;

	$clientSecret = CLIENT_SECRET;

	$userAgent = 'Dagogtid/0.1 by dt-gregor';

	

	$url = API_URL.'&returnUrl='.$returnUrl.'&errorUrl='.$errorUrl;

	$order_url = ORDER_URL.'&returnUrl='.$successUrl.'&errorUrl='.$errorUrl;

	

	$redirectUrl = urldecode(BASE_URL.'second_url.php');

?>