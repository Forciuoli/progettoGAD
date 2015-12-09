<?php
require_once "classGame.php";
include "eltMultiPlayer.php";
include "etlEveryEye.php";

$gameNotE=array();
$gameMultiplayer=getGameMultiplayer();
$gameEveryeye=getGameEveryEye();
$gameMerged=array();
$flag=false;

//cerchiamo giochi che non sono in everyeye e se sono in entrambi aggiungiamo ai giochi definitivi mergiati
foreach ($gameMultiplayer as $gameM) {
	$flag=false;
	foreach ($gameEveryeye as $gameE) {
		
		if(levenshtein(strtolower($gameM->name),strtolower($gameE->name))<3)
		{
			$game=new Game($gameM->name,"",$gameE->publisher,$gameE->img_link);
			$game->cooperative=$gameE->cooperative;
			$game->multiplayer=$gameE->multiplayer;
			$game->hw_suggested=$gameE->hw_suggested;
			$game->minimum_requirements=$gameE->minimum_requirements;
			$game->data=$gameE->data;
			$game->genre=$gameM->genre;
			$game->platform=$gameE->platform;
			$game->vote_multiplayer=$gameM->vote_multiplayer;
			$game->vote_everyeye=$gameE->vote_everyeye;
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

//per tutti i giochi che non ci sono in everyeye li prendiamo completamente da multiplayer con il link direttamente
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
				$gm->data[$platform]=$item->date;
			
			}
		}
		array_push($gameMerged,$gm);
}

//per tutti i giochi che non sono in multiplayer catalogati per mese (consideriamo tutti i giochi che sono in everyeye ma non in multiplayer)
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
		//api ricerca su multiplayer
		$ch = curl_init("https://api.import.io/store/connector/b39989fa-8435-4d9a-994f-acc5e5691143/_query?input=webpage/url:http%3A%2F%2Fmultiplayer.it%2Fricerca%2F%3Fq%3Dgioco%2520".urlencode(strtolower($gameE->name))."&&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		set_time_limit(0);
		$result = curl_exec($ch);
		curl_close($ch);
		$someObject = json_decode($result);
		$link=levenshteinMatch($serched,$someObject);
		if($link="")
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
					
				$item = $someObject->results[0];
				
				//genere da multiplayer
				$split_genre=split(",",$item->genre);
				$gameE->genre=array();
				foreach ($split_genre as $genre) {
					array_push($gameE->genre,$genre);
				}
				
				//voti per goni piattaforma da multiplayer
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
		//media voti
		$count=0;
		$votes=0;
		foreach ($gameE->vote_multiplayer as $vote) {
			if($vote!="")
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

print_r($gameMerged);


function levenshteinMatch($searched,$someObject)
{
	$min=50;
	$matchLink="";
	
	foreach ($someObject->results[0] as $word) {
		$lev=levenshtein(strtolower($searched), strtolower($word->{'name/_title'}));
		if($lev<$min)
		{
			$min=$lev;
			$matchLink=$word->name;
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









