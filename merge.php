<?php
require_once "classGame.php";
include "eltMultiPlayer.php";
include "etlEveryEye.php";

function getGameMerged(){
$months = ["gennaio"=>"01","febbraio"=>"02","marzo"=>"03","aprile"=>"04","maggio"=>"05","giugno"=>"06","luglio"=>"07","agosto"=>"08","settembre"=>"09","ottobre"=>"10","novembre"=>"11","dicembre"=>"12"];
$gameNotE=array();
$gameMultiplayer=getGameMultiplayer();
$gameEveryeye=getGameEveryEye();
$gameMerged=array();
$flag=false;
foreach ($gameMultiplayer as $gameM) {
	$flag=false;
	foreach ($gameEveryeye as $gameE) {
		if(levenshtein(($gameM->name),strtolower($gameE->name))<3)
		{
			$game=new Game($gameM->name,"",$gameE->publisher,$gameE->img_link);
			$game->cooperative=$gameE->cooperative;
			$game->multiplayer=$gameE->multiplayer;
			$game->hw_suggested="";
			$game->minimum_requirements="";
			$game->data=$gameE->data;
			$game->genre=$gameM->genre;
			$game->platform=$gameE->platform;
			$game->vote_multiplayer=$gameM->vote_multiplayer;
			$game->vote_everyeye=$gameE->vote_everyeye;
			$game->review_everyeye=$gameE->review_everyeye;
			$game->review_multiplayer=$gameM->review_multiplayer;
			array_push($gameMerged,$game);
			$flag=true;
			break;
		}
	}
	
	if(!$flag)
	{
		array_push($gameNotE,$gameM);
	}
}

foreach ($gameNotE as $gm) {

	$link=$gm->link;
		$ch = curl_init("https://api.import.io/store/connector/ee6f2895-03d9-41e3-a099-97025ea0e7d7/_query?input=webpage/url:".urlencode($link)."&&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
		// Disable SSL verification
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		set_time_limit(0);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$someObject = json_decode($result);
		$item = $someObject->results[0];
		$platforms=split(",",$item->platform);
		foreach ($platforms as $platform) {
			$platform=trim($platform);
			
			if($platform=="xone" || $platform=="ps4" || $platform=="pc"
					|| $platform=="ps3" || $platform=="x360")
			{
				$index=strpos($gm->link,"-per");
				$link=substr($gm->link,0,$index);
				$plat="-per-".$platform.".html";
				$link=$link.$plat;
				$ch = curl_init("https://api.import.io/store/connector/ee6f2895-03d9-41e3-a099-97025ea0e7d7/_query?input=webpage/url:".urlencode($link)."&&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
				// Disable SSL verification
				curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				set_time_limit(0);
				$result = curl_exec($ch);
				curl_close($ch);
				$someObject = json_decode($result);
			
				
				
				if(!isset($someObject -> results[0]))
				{
					continue;
				}
				
				$item = $someObject->results[0];
				
				if(isset($item->img))
					$gm->img_link= $item->img;
				if(isset($item->publisher))
					$gm->publisher= $item->publisher;
				
				
				if($platform=="ps3")
					$platform="Ps3";
				else if($platform=="ps4")
					$platform="PS4";
				else if($platform=="pc")
					$platform="Pc";
				else if($platform=="x360")
					$platform="Xbox 360";
				else if($platform=="xone")
					$platform="Xbox One";
			
				array_push($gm->platform,$platform);
				$datesplit=split(" ",$item->date);
				if(count($datesplit)==3)
				{
					if(array_key_exists($datesplit[1],$months))
						$datastring=$datesplit[0]."/".$months[$datesplit[1]]."/".$datesplit[2];
					else
						$datastring="00/00/".$datesplit[2];
				}
				else if(count($datesplit)==1)
				{
					$datastring="00/00/".$datesplit[0];
				}
				else if(count($datesplit)==2)
				{
					$datastring="00/".$months[$datesplit[0]]."/".$datesplit[1];
				}
				$gm->data=$datastring;
			
			}
		}
		array_push($gameMerged,$gm);
}


$flag=false;
foreach ($gameEveryeye as $gameE) {
	$flag=false;
	foreach ($gameMultiplayer as $gameM) {

		if(levenshtein(strtolower($gameE->name),strtolower($gameM->name))<3)
		{
			$flag=true;
			break;
		}
	}

	if(!$flag)
	{
	    $crocc="https://api.import.io/store/connector/b39989fa-8435-4d9a-994f-acc5e5691143/_query?input=webpage/url:http%3A%2F%2Fmultiplayer.it%2Fricerca%2F%3Fq%3Dgioco%2520".urlencode(strtolower($gameE->name))."&&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326";	
		$ch = curl_init("https://api.import.io/store/connector/b39989fa-8435-4d9a-994f-acc5e5691143/_query?input=webpage/url:http%3A%2F%2Fmultiplayer.it%2Fricerca%2F%3Fq%3Dgioco%2520".urlencode(strtolower($gameE->name))."&&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
		// Disable SSL verification
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		set_time_limit(0);
		$result = curl_exec($ch);
		curl_close($ch);
		$someObject = json_decode($result);
		$link=levenshteinMatch(strtolower($gameE->name),$someObject);
		//aggiungere genere da gameE
		if($link=="")
		{
			array_push($gameMerged,$gameE);
			continue;
		}
		$ch = curl_init("https://api.import.io/store/connector/ee6f2895-03d9-41e3-a099-97025ea0e7d7/_query?input=webpage/url:".urlencode($link)."&&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
		// Disable SSL verification
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$someObject = json_decode($result);
		$item = $someObject->results[0];
		$platforms=split(",",$item->platform);
		foreach ($platforms as $platform) {
			$platform=trim($platform);
			if($platform=="xone" || $platform=="ps4" || $platform=="pc"
					|| $platform=="ps3" || $platform=="x360")
			{
				$index=strpos($link,"-per");
				$link=substr($link,0,$index);
				$plat="-per-".$platform.".html";
				$link=$link.$plat;
				$ch = curl_init("https://api.import.io/store/connector/ee6f2895-03d9-41e3-a099-97025ea0e7d7/_query?input=webpage/url:".urlencode($link)."&&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
				// Disable SSL verification
				curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				set_time_limit(0);
				$result = curl_exec($ch);
				curl_close($ch);
				$someObject = json_decode($result);
				if(isset($someObject->results[0]))
				{
					$item = $someObject->results[0];
			        
					$split_genre=split(",",$item->genre);
					$gameE->genre=array();
					foreach ($split_genre as $genre) {
						array_push($gameE->genre,$genre);
					}
					
				    if(isset($item->{'vote'}))
				    {
				    	if($platform=="ps3")
				    		$gameE->vote_multiplayer["PlayStation 3"]=$item->{'vote'};
				    	else if($platform=="ps4")
				    		$gameE->vote_multiplayer["PlayStation 4"]=$item->{'vote'};
				    	else if($platform=="pc")
				    		$gameE->vote_multiplayer["PC Windows"]=$item->{'vote'};
				    	else if($platform=="x360")
				    		$gameE->vote_multiplayer["Xbox 360"]=$item->{'vote'};
				    	else if($platform=="xone")
				    		$gameE->vote_multiplayer["Xbox One"]=$item->{'vote'};
				    }
					
				}							
						
												
			}
		}
		
		if(isset($item -> review))
		{
			$link_review = $item -> review;
		
			//echo $link_review."</br>";
			$ch = curl_init ("https://api.import.io/store/connector/0453b716-4774-4802-913e-e64060955f17/_query?input=webpage/url:".$link_review."&&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef");
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			// Disable SSL verification https://api.import.io/store/connector/0453b716-4774-4802-913e-e64060955f17/_query?input=webpage/url:http%3A%2F%2Fmultiplayer.it%2Frecensioni%2F158555-call-of-duty-black-ops-iii-mental-ops.html%3Fpiattaforma%3Dps4&&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326
			curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
			$result3 = curl_exec ( $ch );
		
		
		
			curl_close ( $ch );
			//echo $result3;
			$someObject3 = json_decode ( $result3 );
			if(isset($someObject3 -> results[0] -> review))
			{
				$gameE -> review_multiplayer = $someObject3 -> results[0] -> review;
			}
		}
		
		$count=0;
		$votes=0;
		foreach ($gameE->vote_multiplayer as $vote) {
			if($vote!="0")
			{
				$count++;
				$votes+=floatval($vote);
			}
		};
			
		if($count!=0)
		{
			$gameE->vote_multiplayer["all"]=$votes/$count;
		}
		
		array_push($gameMerged,$gameE);
	}
}

//print_r($gameMerged);
return $gameMerged;
}

function levenshteinMatch($searched,$someObject)
{
	$min=50;
	$matchLink="";
	
	for ($i = 0; $i < count($someObject->results); $i++) {
		$lev=levenshtein(strtolower($searched), strtolower($someObject->results[$i]->{'name/_text'}));
		if($lev<$min)
		{
			$min=$lev;
			$matchLink=$someObject->results[$i]->{'name'};
		}
	}
	
	if($min<3)
	{
		return $matchLink;
	}
	else
	{
		return "";
	}
	
	
}








