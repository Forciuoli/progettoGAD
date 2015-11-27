<?php
//require "classGame.php";
function getGameMultiplayer(){
set_time_limit(1000000000000);
$games=array();
$controllo_pagine="";
$months=["01"];//,"02","03","04","05","06","07","08","09","10","11","12"];
for($kk=0;$kk<count($months);$kk++){
for($i=1;$i<500;$i++){
	if($i==1)
		$ch = curl_init("https://api.import.io/store/data/647f1b46-43ec-430d-8c0f-b82a184138d0/_query?input/webpage/url=http%3A%2F%2Fmultiplayer.it%2Fgiochi%2F%3Fmonth%3D2015_".$months[$kk]."&_user=12c26aee-8ae3-4b58-af08-e4df583faf99&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
		else
		{
			$link="http://multiplayer.it/giochi/?pagina=".$i."&_=wjums&month=2015_".$months[$kk]."&querystring_key=pagina";
			//echo $link." ss ".$kk."</br>";
			$ch = curl_init("https://api.import.io/store/data/647f1b46-43ec-430d-8c0f-b82a184138d0/_query?input/webpage/url=".urlencode($link)."&_user=12c26aee-8ae3-4b58-af08-e4df583faf99&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		//https://api.import.io/store/data/ee6f2895-03d9-41e3-a099-97025ea0e7d7/_query?input/webpage/url=http%3A%2F%2Fmultiplayer.it%2Fgiochi%2Fgod-of-war-per-ps2.html&_user=12c26aee-8ae3-4b58-af08-e4df583faf99&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326
		//echo $result;

		$someObject = json_decode($result);
		if($i==1)
		{
			$controllo_pagine=$someObject->results[0]->{'name/_text'};
		}
		
		if($i>1 && $someObject->results[0]->{'name/_text'}==$controllo_pagine)
		{
			break;
		}
			
		
		for ($j=0;$j < count($someObject->results);$j++)
		{
			//echo $someObject->results[$j]->{'name/_title'}."</br>";
			$info_game = $someObject->results[$j]->info_game;
			//echo $link."</br>";
			$split_info_game = split (" per ", $info_game);
			if(isset($split_info_game[1]))
			{
				$platform=$split_info_game[1];
			}
			else
			{
				$platform=$split_info_game[0];
			}
			if($platform=="Xbox One" || $platform=="PlayStation 4" || $platform=="PC Windows"
			   || $platform=="PlayStation 3" || $platform=="Xbox 360")
			{
				$name=$someObject->results[$j]->{'name/_text'};
				
				$link=$someObject->results[$j]->{'name'};
				if(isset($someObject->results[$j]->{'vote'}))
				$flag=false;
				foreach ($games as $gm)
				{
					$cocc=$gm->name;
					if($cocc==$name)
					{
						$flag=true;
						if(isset($someObject->results[$j]->{'vote'}))
							$gm->vote_multiplayer[$split_info_game[1]]=$someObject->results[$j]->{'vote'};
					}
				}
				if(!$flag)
				{
					$game= new Game($name,$link,"","");
					$split_genre=split(",",$split_info_game[0]);
					foreach ($split_genre as $genre) {
						array_push($game->genre,$genre);
					}
					if(isset($someObject->results[$j]->{'vote'}))
						$game->vote_multiplayer[$split_info_game[1]]=$someObject->results[$j]->{'vote'};
				    array_push($games,  $game);
				}
				
				
			}
			
				
			//$pos = strpos($gameName, "(");
			//echo $pos;
			// 		$lev = levenshtein(strtolower("god of war 2"), strtolower($gameName));
			// 		echo "<b>&nbsp".$lev."</b>";
			// 		echo "</br>";
				
			// 		$name = substr($someObject->results[$i]->name,34);
			// 		//echo $name;
			// 		$name2 = "http%3A%2F%2Fmultiplayer.it%2Fgiochi%2F".$name;
			// 		$url_single_publisher = "https://api.import.io/store/data/ee6f2895-03d9-41e3-a099-97025ea0e7d7/_query?input/webpage/url=".$name2."&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=".$api_key;
			// 		$ch = curl_init($url_single_publisher);
			// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// 		$res = curl_exec($ch);
			// 		$ob = json_decode($res);
			// 		//echo $ob->results[$i]->{'publisher/_text'};;
			// 		curl_close($ch);
		}
		
		foreach ($games as $game) {
			$count=0;
			$votes=0;
			foreach ($game->vote_multiplayer as $vote) {
				if($vote!="")
				{
					$count++;
					$votes+=floatval($vote);
				}
			};
			
			if($count!=0)
			{
				$game->vote_multiplayer["all"]=$votes/$count;
			}
		}
		
		//break;
}
}
return $games;
}
//print_r ($games);

//genre and publisher
//https://api.import.io/store/data/13daeba6-655e-4af9-93b3-34e89dcf842a/_query?input/webpage/url=http%3A%2F%2Fwww.gamerevolution.com%2Fgame%2F0-day-attack-on-earth&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef

//link wipedia 2010/2011
//https://api.import.io/store/data/ced00686-b169-4950-8400-734195ed62a1/_query?input/webpage/url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2F2010_in_video_gaming&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef