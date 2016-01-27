<?php
include "merge.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GAD";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br/>";

$gameMerged=getGameMerged();
foreach ($gameMerged as $game) {
	$game->review_everyeye = str_replace("'", "''", $game->review_everyeye);
	$game->review_multiplayer = str_replace("'", "''", $game->review_multiplayer);
	$game->name = str_replace("'", "''", $game->name);
	$game->multiplayer = str_replace("'", "''", $game->multiplayer);
	$game->minimum_requirements = str_replace("'", "''", $game->minimum_requirements);
	$game->publisher = str_replace("'", "''", $game->publisher);
	$game->name = str_replace("'", "''", $game->name);
	$sql = "INSERT INTO games(Name, Link, Info_multiplayer, Info_cooperative, Minimum_requirements, Hw_suggested, Publisher, Img_link, Genres, "
	."Platforms, Vote_multiplayer, Vote_everyeye, Vote_ps4_multiplayer, Vote_ps3_multiplayer, Vote_pc_multiplayer, Vote_x360_multiplayer, "
	."Vote_xone_multplayer, Data_ps4, review_everyeye, review_multiplayer) "
	."VALUES ('".$game->name."',"
			."'".$game->link."',"
			."'".$game->multiplayer."',"
			."'".$game->cooperative."',"
			."'".$game->minimum_requirements."',"
			."'".$game->hw_suggested."',"
			."'".$game->publisher."',"
			."'".$game->img_link."',"
			."'".getStringFromArray($game->genre)."',"
			."'".getStringFromArray($game->platform)."',"
			.$game->vote_multiplayer["all"]."," 
		    .$game->vote_everyeye["all"].","
		    .$game->vote_multiplayer["PlayStation 4"].","
		    .$game->vote_multiplayer["PlayStation 3"].","
		    .$game->vote_multiplayer["PC Windows"].","
		    .$game->vote_multiplayer["Xbox 360"].","
		    .$game->vote_multiplayer["Xbox One"].","
		    ."'".$game->data."',"
			."'".$game->review_everyeye."',"
			."'".$game->review_multiplayer."')";
					
			
	if ($conn->query($sql) === TRUE)
	{
		echo "New record created successfully";
	}
	else
	{
		echo "Error on ".$game->name.": " . $sql . "<br>" . $conn->error;
	}
}

function getStringFromArray($arrToSplit)
{
	$res = "";
	foreach ($arrToSplit as $value) {
		$res .= $value."&";
	}
	return $res;
}

		
$conn->close();
echo "finish";