<?php
require_once "classGame.php";
include "eltMultiPlayer.php";
include "etlEveryEye.php";
set_time_limit(1000000000);
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

foreach ($gameNotE as $gm) {
	
		$link=$gm->link;
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


$flag=false;
foreach ($gameEveryeye as $gameE) {
	$flag=false;
	foreach ($gameMultiplayer as $gameM) {

		if(levenshtein(($gameE->name),strtolower($gameM->name))<3)
		{
			$flag=true;
			break;
		}
	}

	if(!$flag)
	{
		array_push($gameMerged,$gameE);
	}
}

print_r($gameMerged);

