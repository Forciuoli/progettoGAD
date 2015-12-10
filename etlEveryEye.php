<?php
//require "classGame.php";
function getGameEveryEye(){
set_time_limit(0); 
$months = ["gennaio"];//,"aprile","maggio","giugno","luglio","agosto","settembre","ottobre","novembre","dicembre"];
 for ($j = 0; $j < count($months); $j++) 
 {
	$ch = curl_init ("https://api.import.io/store/data/eb8721e7-d9de-43a4-af4c-a5c395e6d294/_query?input/webpage/url=http%3A%2F%2Fwww.everyeye.it%2Fgiochi%2F2015%2F".$months[$j]."%2F&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef");
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	// Disable SSL verification
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	//echo $result;
	$someObject = json_decode ( $result );
	$games = array();
	for($i = 0; $i < count($someObject -> results); $i ++)
	{
		$link = $someObject -> results[$i] -> name;
		$ch = curl_init("https://api.import.io/store/connector/6f4ef18a-6b6c-4abf-9d1e-be9d0436bd9a/_query?input=webpage/url:".urlencode($link)."&&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef");
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		// Disable SSL verification
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		$result2 = curl_exec ( $ch );
		curl_close ( $ch );
		$someObject2 = json_decode ( $result2 );
		//echo $result2;
		
		$name = $someObject -> results[$i] -> {'name/_title'};
		if(isset($someObject2 -> results[0])) 
		{
			$item = $someObject2 -> results[0];
			
			if(isset($item -> image))
			{
				$img_link = $item -> image;
			}
			
			if(isset($item -> publisher))
			{
				$publisher = $item -> publisher;
			}
			
			$game = new Game($name, $link, $publisher, $img_link);
				
			if(isset($item -> dateplatforms))
			{
				$date_platforms_nospace = str_replace(" : ", ":", $item -> dateplatforms);
					
				$date_platforms_nospace2 = str_replace("   ","&",$date_platforms_nospace);
					
				$dataPlatforms = split('&', $date_platforms_nospace2);
				
				$can_push = false;
				
				foreach ($dataPlatforms as $data) {
					$temp = split(':', $data);
					$platform = $temp[0];
					$date = $temp[1];
					if($platform != "iPhone" && $platform != "iPad" && $platform != "Android Games" && $platform != "3DS" && $platform != "PSVita" && $platform != "Wii U")
					{
						array_push($game -> platform, $platform);
						$game -> data[$platform] = $date;
						$can_push = true;
					}
				}
			}
			
			
			
			if(isset($item -> cooperative))
			{
				$game -> cooperative = $item -> cooperative;
			}
			
			if(isset($item -> multiplayer_online))
			{
				$game -> multiplayer = $item -> multiplayer_online;
			}
			
			if(isset($item -> hw_suggested))
			{
				$game ->hw_suggested = $item -> hw_suggested;
			}
			
			if(isset($item -> minimum_requirements))
			{
				$game -> minimum_requirements = $item -> minimum_requirements;
			}
			
			if(isset($item -> {'vote/_text'}))
			{
				$game -> vote_everyeye["all"] = $item -> {'vote/_text'};
			}
			
			//verrà preso in seguito solo nel caso non ci sia il gioco su multiplayer
			if(isset($item -> genreeveryeye))
			{
				array_push($game -> genre, $item -> genreeveryeye);
			}
			
			//se c'è il link della recensione
			if(isset($item -> vote))
			{
				$link_review = $item -> vote;
				$ch = curl_init ("https://api.import.io/store/connector/a7f8384c-bab9-4cb7-ae28-66868f6fb34a/_query?input=webpage/url:".$link_review."&&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef");
				curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
				// Disable SSL verification
				curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
				$result3 = curl_exec ( $ch );
				curl_close ( $ch );
				$someObject3 = json_decode ( $result3 );
				if(isset($someObject3 -> results[0] -> review))
				{
				$game -> review_everyeye = $someObject3 -> results[0] -> review;
				}
			}
			
			if($can_push)
			{
				array_push($games, $game);
			}
		}
	}
 }
//print_r($games);
  	return $games;
 }