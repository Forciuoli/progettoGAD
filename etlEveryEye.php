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
	usleep(300);
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	//echo $result;
	$someObject = json_decode ( $result );
	$games = array();
	for($i = 0; $i < count($someObject -> results); $i ++)
	{
		$link = $someObject -> results[$i] -> name;
		$ch = curl_init("https://api.import.io/store/connector/5ba164ec-2544-4eb9-b41b-dc3053f97300/_query?input=webpage/url:".urlencode($link)."&&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef");
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		// Disable SSL verification
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		usleep(300);
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
				
			if(isset($item -> platforms))
		{
			$platforms = $item -> platforms;
				
			$can_push = false;
			$platforms = strtoupper($platforms);
			$platforms = str_replace("XBOX 360", "XBOX360", $platforms);
			$platforms = str_replace("XBOX ONE", "XBOXONE", $platforms);
			$platforms = str_replace("WII U", "WIIU", $platforms);
			$platforms = str_replace("ANDROID GAMES", "ANDROIDGAMES", $platforms);
				
			$temp = split(' ', $platforms);
			for ($k = 0; $k < count($temp); $k++) {
				$platform = $temp[$k];
				if($platform != "IPHONE" && $platform != "IPAD" && $platform != "ANDROIDGAMES" && $platform != "3DS" && $platform != "PSVITA" && $platform != "WIIU" && $platform != "N-GAGE" && $platform != "PSX"  && $platform != "WII")
				{
					array_push($game -> platform, $platform);
					$can_push = true;
				}
			}
				
		
		}
			
			if(isset($item -> dateplatforms))
			{
				$date_platforms = $item -> dateplatforms;
				$months2 = ["gennaio"=>"01","febbraio"=>"02","marzo"=>"03","aprile"=>"04","maggio"=>"05","giugno"=>"06","luglio"=>"07","agosto"=>"08","settembre"=>"09","ottobre"=>"10","novembre"=>"11","dicembre"=>"12"];
				$datesplit = split(' ',$date_platforms);
				$datastring=$datesplit[0]."/".$months2[strtolower($datesplit[1])]."/".$datesplit[2];
				
				$game -> data = $datastring;
			}
			
			
			
			if(isset($item -> cooperative))
			{
				$game -> cooperative = $item -> cooperative;
			}
			
			if(isset($item -> multiplayer_online))
			{
				$game -> multiplayer = $item -> multiplayer_online;
			}
			
			if(isset($item -> {'vote'}))
			{
				$game -> vote_everyeye["all"] = split(' ', $item -> {'vote'})[0];;
			}
			
			//verr� preso in seguito solo nel caso non ci sia il gioco su multiplayer
			if(isset($item -> genre_everyeye))
			{
				array_push($game -> genre, $item -> genre_everyeye);
			}
			
			//se c'� il link della recensione
			if(isset($item -> link_review))
			{
				$link_review = $item -> link_review;
				$ch = curl_init ("https://api.import.io/store/connector/a7f8384c-bab9-4cb7-ae28-66868f6fb34a/_query?input=webpage/url:".$link_review."&&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef");
				curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
				// Disable SSL verification
				curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
				usleep(300);
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