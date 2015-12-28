<?php
function getEbayGames($name)
{
$link = "http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.1.0&SECURITY-APPNAME=ac8e33ea-3922-4089-a6bc-e528b903609f&GLOBAL-ID=EBAY-IT&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&categoryId=1249&itemFilter(0).name=Condition&itemFilter(0).value(0)=New&itemFilter(1).name=ListingType&itemFilter(1).value(0)=FixedPrice&keywords=".urlencode($name);
$ch = curl_init ($link);
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
// Disable SSL verification
curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
$result = curl_exec ( $ch );
curl_close ( $ch );
$games = array();
$someObject = json_decode ( $result );
if(!isset($someObject -> findItemsAdvancedResponse[0] -> searchResult[0] -> item))
{
	return $games;
}
for ($i = 0; $i < count($someObject -> findItemsAdvancedResponse[0] -> searchResult[0] -> item); $i++) {
	
	$items = $someObject -> findItemsAdvancedResponse[0] -> searchResult[0] -> item[$i];
	$title = $items -> title[0];
	$platform = "";
	if(stripos($title, "PS3") !== false || stripos($title, "Playstation 3") !== false)
	{
		$platform = "PS3";
	}
	if(stripos($title, "PS4") !== false || stripos($title, "Playstation 4") !== false)
	{
		$platform = "PS4";
	}
	if(stripos($title, "XBOXONE") !== false || stripos($title, "Xbox one") !== false)
	{
		$platform = "XBOXONE";
	}
	if(stripos($title, "XBOX360") !== false || stripos($title, "Xbox 360") !== false)
	{
		$platform = "XBOX360";
	}
	if(stripos($title, "PC") !== false || stripos($title, "Windows") !== false)
	{
		$platform = "PC";
	}
	
	$price = $items -> sellingStatus[0] -> convertedCurrentPrice[0] -> {'__value__'};
	$link = $items -> viewItemURL[0];
	
	
	$game = new Game($title, $link, $platform, $price);
	if($platform!="" && $items->country[0]=="IT" && stripos($title, "poster") === false
			&& stripos($title, "code") === false && stripos($title, "pass") === false
			&& stripos($title, "code-pass") === false && stripos($title, "pass-code") === false
			&& stripos($title, "key") === false && stripos($title, "chiave") === false)
		array_push($games, $game);
}
	return $games;
}
