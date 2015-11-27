<?php
require_once "classGame.php";
include "eltMultiPlayer.php";
include "etlEveryEye.php";
$gameMultiplayer=getGameMultiplayer();
$gameEveryeye=getGameEveryEye();
$gameMarged=array();
foreach ($gameMultiplayer as $gameM) {
	//echo "ciao";
	foreach ($gameEveryeye as $gameE) {
		if(strtolower($gameM->name)==strtolower($gameE->name))
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
			array_push($gameMarged,$game);
		}
	}
}

print_r ($gameMarged);