<?php 

function curl_load($url){
	curl_setopt($ch=curl_init(), CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}


	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{   
//		if(isset($_GET['submit_phone']) && isset($_GET['phone'])){
		if(isset($_GET['phone']) ){
			$username = 'zeusername';
			$password = 'zepassword';
			//$search = '004741428798';
			$search = $_GET['phone'];
			
			$out = array(
				'success' => false
			);	
			$url = 'http://live.intouch.no/tk/search.php?qry='.$search.'&maxpass=1&style=document&format=json&username='.$username.'&password='.$password;
			$json = utf8_encode(file_get_contents($url, 'UTF-8'));
			//$json = curl_load($url);
			$data = json_decode($json);
			
			//print_r($data->result);
	 		if( isset($data->result) ){
				foreach($data->result as $row){
					if(isset($row->listing)){
						if(isset($row->listing->duplicates)){
							$duplicates = $row->listing->duplicates['0'];
							if(isset($duplicates->postnr) && isset($duplicates->etternavn)  && isset($duplicates->fornavn) ){
								$out['postnr'] = $duplicates->postnr;
								$out['etternavn'] = $duplicates->etternavn;
								$out['fornavn'] = $duplicates->fornavn;
								$out['veinavn'] = $duplicates->veinavn;
								$out['husnr'] = $duplicates->husnr;
								$out['poststed'] = $duplicates->poststed;
								$out['success'] = true;
								break;
								//print_r($row->listing->duplicates);
							}	
						}
					}	
				}
	 		}
	
			print_r(json_encode($out));
			exit;
		}	
	}
?>