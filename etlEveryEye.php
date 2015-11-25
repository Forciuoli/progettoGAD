<?php
set_time_limit(1000000000);
$months = ["gennaio","febbraio","marzo","aprile","maggio","giugno","luglio","agosto","settembre","ottobre","novembre","dicembre"];
// for ($j = 0; $j < count($months); $j++) 
// {
	//echo $months[$j]."<br/>";
	$ch = curl_init ("https://api.import.io/store/data/eb8721e7-d9de-43a4-af4c-a5c395e6d294/_query?input/webpage/url=http%3A%2F%2Fwww.everyeye.it%2Fgiochi%2F2015%2Fgennaio%2F&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef");
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	// Disable SSL verification
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	//echo $result;
	$someObject = json_decode ( $result );
	for($i = 1; $i < count ( $someObject->results ); $i ++)
	{
		$link = $someObject -> results[$i] -> name;
		$name = $someObject -> results[$i] -> {'name/_title'};
		$ch = curl_init ("https://api.import.io/store/data/6f4ef18a-6b6c-4abf-9d1e-be9d0436bd9a/_query?input/webpage/url=".urlencode($link)."&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef");
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		// Disable SSL verification
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		$result2 = curl_exec ( $ch );
		curl_close ( $ch );
		$someObject2 = json_decode ( $result2 );
		//echo $result2;
		$item = $someObject2 -> results[0];
		if(isset($item -> {'vote/_text'}))
		{
			$vote = $item -> {'vote/_text'};
			$dataPlatforms = split(':', $item -> dateplatforms);
			foreach ($dataPlatforms as $data) {
				$data[0];
			}
			if($item -> dateplatforms != )
		}
			
		
		//break;
	
		//echo $result."<br/>";
	
	}
// }

