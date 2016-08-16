<?php 

	require_once('./header.php');
	require("./OAuth2/Client.php");
	require("./OAuth2/GrantType/IGrantType.php");
	require("./OAuth2/GrantType/AuthorizationCode.php");
	require_once './database/database.php';
	
	function update_order($order , $comments)
	{
		$db = Database::getInstance();
		
		$time  = strtotime("now"); 
		//no such number
		$data = array(
				 'selected' 	=> strip_tags($order->option)
				,'email'		=> strip_tags($order->email)
				,'name'			=> strip_tags($order->name)
				,'lastname'		=> strip_tags($order->lastname)
				,'postzip'		=> strip_tags($order->postzip)
				,'place'		=> strip_tags($order->place)
				,'streetNumber'	=> strip_tags($order->streetNumber)
				,'co'			=> strip_tags($order->co)
				,'entrance'		=> strip_tags($order->entrance)
				,'time'			=> $time
				,'comment'  	=> $comments
				//'unknown number'
		);
		
		$where = 'id = '. strip_tags($order->id);
		$db->update('orders' , $data , $where);
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Test Api </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
	<?php 
		if (isset($_GET["error"]))
		{
			echo("<pre>OAuth Error: " . $_GET["error"]."\n");
			//echo('<a href="./index.php">Retry</a></pre>');
			die;
		}

		if (!isset($_GET["code"]))
		{
			//$authUrl = $client->getAuthenticationUrl($authorizeUrl, $redirectUrl);
			//header("Location: ".$authUrl);
			//die("Redirect");
		}

		else
		{
			$client = new OAuth2\Client($clientId, $clientSecret);
			$client->setCurlOption(CURLOPT_USERAGENT,$userAgent);

			$params = array("code" => $_GET["code"], "redirect_uri" => $redirectUrl);
			$response = $client->getAccessToken($accessTokenUrl, "authorization_code", $params);
			$accessTokenResult = $response["result"];

			$client->setAccessToken($accessTokenResult["access_token"]);
			$client->setAccessTokenType(OAuth2\Client::ACCESS_TOKEN_BEARER);

			//print $time.'<br>';
			if(isset($_COOKIE['order']))
			{
				$order = json_decode($_COOKIE['order']);
				
				if(intval($order->option) == 24)
				{
					$productSpecNo = 3011;
					$unitPrice = 149;
				} 
				else
				{
					$productSpecNo = 3010;
					$unitPrice = 199;
				};

				$time = strtotime("now") * 1000;

				$parameters = array(
					 'orderDate' => $time
					,'paymentMethod' => 'creditcard'
					,'orderAmount' => $unitPrice
					,'currency'	=> 'NOK'
					,'payer' => array(
							'firstName' => strip_tags($order->name)
							,'lastName' => strip_tags($order->lastname)
							//,'companyName'	=> 'Company Name'
							//,'coAddress' => 'Test Address'
							//,'sex' => 'male'
							//,'street' => strip_tags($order->place)
							//,'floor' => '1'
							,'street' => strip_tags($order->address)
							,'streetNumber' => strip_tags($order->streetNumber)
							,'entrance' => strip_tags($order->entrance)
							//,'entrance' => strip_tags($order->addressNumber)
							,'postalCode' => strip_tags($order->postzip)
							,'postalPlace' => strip_tags($order->place)
							,'coAddress' => strip_tags($order->co)
							,'emails' => array(strip_tags($order->email))
							,'phoneNumbers' => array(strip_tags($order->phone))
					)
					,'orderLines' => array(
						array(
								'productSpecType' => 'coupon'
								,'productSpecCode' => 'DT'
								,'productSpecNo' => $productSpecNo
								,'unitPrice' => $unitPrice
								,'quantity' => 1
						)
					)
				);

				//print_r($parameters);
				//print '<br>';
				$http_method =  OAuth2\Client::HTTP_METHOD_POST;
				$header['Content-Type'] = 'application/json';

				//print_r(json_encode($parameters));
				$response = $client->fetch("https://api.mediaconnect.no/capi/v1/order", json_encode($parameters) , $http_method , $header );
				//$response = $client->fetch("https://api-test.mediaconnect.no/capi/v1/customer/profile ");
// 				echo('<strong>Response for mediaConnect:</strong><pre>');
 				//print_r($response);
// 				echo('</pre>');
				//print_r($response['code'] . '<br>');
				//print_r($response['code'] == 200);
				//print_r('<br>'.is_numeric($response['result']));
				
				//print 'aici';
				update_order($order , $comments = 'order requested');
				//print 'after';
				
				if($response['code'] == 200)
				{
					$to_xml = new SimpleXMLElement($response['result']);
					$orderId = $to_xml->orderId;
					
					if(isset($to_xml->orderId))
					{	
						//print '</br>'.$orderId;
						$order_url .= '&orderId='.$orderId;

						update_order($order , $comments = 'order placed');
						
						UNSET($_COOKIE['order']);
						//print_r('<br>'.$order_url);
						//header("Location: ".$order_url);
						echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $order_url . '">';
						echo "<script type='text/javascript'>document.location.href='{$order_url}';</script>";

						die();
					}
					else
					{
						update_order($order , $comments = 'orderid error');
						
						header("Location: ".$errorUrl);
						die();
					}	
				}
				else 
				{
					update_order($order , $comments = 'order error');
					
					header("Location: ".$errorUrl);
					die();
				}
			}
			else
			{
				header("Location: ".$errorUrl);
				die();
			}
		}
	?>
</body>
</html>