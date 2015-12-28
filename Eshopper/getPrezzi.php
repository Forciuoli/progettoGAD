<?php
require_once "../classGame.php";
include "../wrapAmazon.php";
include "../wrapEbay.php";

$search="";
$prezziMinimiAmazon = array("PS3"=>"800","PS3_link"=>"", "XBOXONE"=>"800","XBOXONE_link"=>"", "XBOX360"=>"800","XBOX360_link"=>"","PS4"=>"800","PS4_link"=>"","PC"=>"800","PC_link"=>"");
$prezziMinimiEbay = array("PS3"=>"800","PS3_link"=>"", "XBOXONE"=>"800","XBOXONE_link"=>"", "XBOX360"=>"800","XBOX360_link"=>"","PS4"=>"800","PS4_link"=>"","PC"=>"800","PC_link"=>"");


function getPrezzi($s){
	
global $search;
$search=$s;
$gamesAmazon=getAmazonGames($search);
$gamesEbay=getEbayGames($search);
$games=array();


function pulizia($array,$shop)
{
	//global $games;
	global $prezziMinimiAmazon;
	global $prezziMinimiEbay;
	foreach ($array as $gameA) {
		$name=$gameA->name;
		$name = str_replace(':', '', $name);
		$name = str_replace('-', '', $name);
		if(strpos($name,' II ') || strpos($name,' II') !== false || strpos($name,' III ') !== false || strpos($name,' III') !== false || strpos($name,' IV ') !== false || strpos($name,' IV:') !== false)
		{
			$name = str_replace('III', '3', $name);
			$name = str_replace('II', '2', $name);
			$name = str_replace('IV:', '4:', $name);
			$name = str_replace('IV', '4', $name);
		}
	
		$gameA->name=$name;
		global $search;
		$name=str_replace(' ', '', $name);
		$search1=str_replace(' ', '', $search);
		//echo "name= ".$name."</br>";
		//echo "search1= ".$search1."</br>";
		if(strpos(strtolower($name),strtolower($search1)) !== false)
		{
			//array_push($games,  $gameA);
		
		
		if($shop=="amazon")
		{
		    
			if(array_key_exists($gameA->publisher,$prezziMinimiAmazon)){
				//echo $gameA->img_link."</br>";
				$split=split(' ',$gameA->img_link);
				//print_r($split)."</br>";
				
				//nel caso il prezzo è uguale a 0 non aggiorno il prezzo relativo alla piattaforma
				if(count($split)==1)
					continue;
				
				if(floatval($prezziMinimiAmazon[$gameA->publisher])>floatval($split[1]))
				{
					
						$prezziMinimiAmazon[$gameA->publisher]=$split[1];
						$prezziMinimiAmazon[$gameA->publisher."_link"]=$gameA->link;
					
				}
			}
		}
		
		else if($shop=="ebay")
		{
			
			if(array_key_exists($gameA->publisher,$prezziMinimiEbay)){
				if(floatval($prezziMinimiEbay[$gameA->publisher])>floatval($gameA->img_link))
				{
					
						$prezziMinimiEbay[$gameA->publisher]=$gameA->img_link;
						$prezziMinimiEbay[$gameA->publisher."_link"]=$gameA->link;
					
				}
			}
		}
		
		}

	}
}

global $prezziMinimiAmazon;
global $prezziMinimiEbay;

pulizia($gamesAmazon,"amazon");
pulizia($gamesEbay,"ebay");

array_push($games,  $prezziMinimiAmazon);
array_push($games,  $prezziMinimiEbay);

return $games;
}



