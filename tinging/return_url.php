
<?php 

	ob_start();

	require_once('./header.php');

	require("./OAuth2/Client.php");

	require("./OAuth2/GrantType/IGrantType.php");

	require("./OAuth2/GrantType/AuthorizationCode.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title> Test Api </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
	<?php 

		$client = new OAuth2\Client($clientId, $clientSecret);
		$client->setCurlOption(CURLOPT_USERAGENT,$userAgent);

		if (isset($_GET["error"]))
		{
			echo("<pre>OAuth Error: " . $_GET["error"]."\n");
			//echo('<a href="./index.php">Retry</a></pre>');
			die;
		}

		if (!isset($_GET["code"]))
		{
			$redirectUrl = urldecode(BASE_URL.'second_url.php');
			$authUrl = $client->getAuthenticationUrl($authorizeUrl, $redirectUrl);
                        //print_r($authUrl);
				
			//header("Location: ".$authUrl);
			echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $authUrl . '">';
			echo "<script type='text/javascript'>document.location.href='{$authUrl}';</script>";

			die("Redirect");
		}
		else
		{

// 			$params = array("code" => $_GET["code"], "redirect_uri" => $redirectUrl);
// 			$response = $client->getAccessToken($accessTokenUrl, "authorization_code", $params);
// 			$accessTokenResult = $response["result"];
// 			$client->setAccessToken($accessTokenResult["access_token"]);
// 			$client->setAccessTokenType(OAuth2\Client::ACCESS_TOKEN_BEARER);
// 			$response = $client->fetch("https://api-test.mediaconnect.no/capi//v1/customer/profile");
// 			echo('<strong>Response for mediaConnect:</strong><pre>');
// 			print_r($response);
// 			echo('</pre>');
		}

	?>

</body>

</html>