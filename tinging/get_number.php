<?php 

require_once './database/database.php';

function curl_load($url)
{
	curl_setopt($ch=curl_init(), CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}


function insert_number($db , $search , $comments , $out = NULL)
{
	$time = strtotime("now");
	
	//no such number
	$data = array(
			'phone' 	=> $search
			,'comment'  => $comments
			,'time'		=> $time
			//'unknown number'
	);
	
	
	if(!empty($out))
	{
		$data['name'] = (string)$out['fornavn'];	 
		$data['lastname'] = (string)$out['etternavn'];
		$data['postzip'] = (string)$out['postnr'];
		$data['place'] = (string)$out['poststed'];
		//$data['address'] = $out['veinavn'];
		$data['streetNumber'] = (string)$out['husnr'];
		$data['entrance'] = (string)$out['oppgang'];

	}
	
	//print_r($data);
	
	$return = $db->insert('orders' , $data);
	
//	print_r($return);
	
	return $return;
}

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{   
	//if(isset($_GET['submit_phone']) && isset($_GET['phhm'])){
	if(isset($_GET['phhm']) )
	{
		$db = Database::getInstance();
		
		$username = 'DagogTid';
		$password = '47bnp5';
		//$search = '004741428798';
		$search = strip_tags($_GET['phhm']);
		
		$out = array(
			'success' => false
		);	
		$url = 'http://live.intouch.no/tk/search.php?qry='.$search.'&maxpass=1&style=document&format=json&username='.$username.'&password='.$password;
		$json = utf8_encode(file_get_contents($url, 'UTF-8'));
		//$json = curl_load($url);
		$data = json_decode($json);
		
		//print_r($data->result);
 		if( isset($data->result) )
 		{
			foreach($data->result as $row)
			{
				if(isset($row->listing))
				{
					if(isset($row->listing->duplicates))
					{
						$duplicates = $row->listing->duplicates['0'];
						if(isset($duplicates->postnr) && isset($duplicates->etternavn)  && isset($duplicates->fornavn) )
						{
							$out['postnr'] = $duplicates->postnr;
							$out['etternavn'] = $duplicates->etternavn;
							$out['fornavn'] = $duplicates->fornavn;
							$out['veinavn'] = $duplicates->veinavn;
							$out['husnr'] = $duplicates->husnr;
							$out['poststed'] = $duplicates->poststed;
							$out['oppgang'] = $duplicates->oppgang;
							$out['success'] = true;
							
							//$out['order_id'] = get_ro ;
							//insert into the database
							$id = insert_number($db, $search, 'number found' , $out);
							$out['res_id'] = $id;
							break;
							//print_r($row->listing->duplicates);
						}
					}
				}	
			}
 		}
 		else
 		{
 			insert_number($db, $search, 'no results');
 		}
 		
 		if($out['success'] == false)
 		{
 			insert_number($db, $search, 'unknown number');
 		}

		print_r(json_encode($out));
		exit;
	}	
}
?>