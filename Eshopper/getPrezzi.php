<?php
require_once "../classGame.php";
include "../wrapAmazon.php";
include "../wrapEbay.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GAD";

$avviso="non disponibile";
$ottocento="800";

$idGame = $_GET["id"];
//controllo cachetta

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//se � gi� stato visto
$sql = "SELECT * FROM games WHERE Id=".$idGame;
$result = $conn->query($sql);
$gameDB="";

if($result->num_rows > 0)
{
	$gameDB = $result -> fetch_assoc();
}

//se � gi� stato visto
$sql = "SELECT * FROM cache WHERE idGame=".$idGame;
$result = $conn->query($sql);
$dataNow = new DateTime(date('Y-m-d G:i:s'));

if($result->num_rows > 0)
{
	$table="<table>";
	$table.='<tr style="text-align:center"><td style="width:250px;"></td><td><img style="width:200px;height:80px" src="/gadProject/Eshopper/images/product-details/amazonLogo.png"></td><td><img style="width:200px;height:80px" src="/gadProject/Eshopper/images/product-details/ebayLogo.png"></td></tr>';
	$enter = false;
	while($row = $result -> fetch_assoc())
	{
		$dataGame = new DateTime($row["timeStamp"]);
		//echo "datagame= ".$dataGame."<br/>";
		//echo "datanow= ".$dataNow;
		
		$interval = $dataGame->diff($dataNow);
		$days = $interval->format('%a');
		if($days < 1)
		{
			if($row["platform"] == "PS4")
				$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/ps4.jpg"></td><td><a href='.$row["linkAmazon"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceAmazon"]==$ottocento?$avviso:($row["priceAmazon"].' €')).'</a></td><td><a href='.$row["linkEbay"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceEbay"]==$ottocento?$avviso:($row["priceEbay"].' €')).'</a></td></tr>';
				if($row["platform"] == "PS3")
					$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/ps3.png"></td><td><a href='.$row["linkAmazon"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceAmazon"]==$ottocento?$avviso:($row["priceAmazon"].' €')).'</a></td><td><a href='.$row["linkEbay"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceEbay"]==$ottocento?$avviso:($row["priceEbay"].' €')).'</a></td></tr>';
					if($row["platform"] == "XBOXONE")
						$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/xboxone.png"></td><td><a href='.$row["linkAmazon"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceAmazon"]==$ottocento?$avviso:($row["priceAmazon"].' €')).'</a></td><td><a href='.$row["linkEbay"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceEbay"]==$ottocento?$avviso:($row["priceEbay"].' €')).'</a></td></tr>';
						if($row["platform"] == "XBOX360")
							$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/xbox360.png"></td><td><a href='.$row["linkAmazon"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceAmazon"]==$ottocento?$avviso:($row["priceAmazon"].' €')).'</a></td><td><a href='.$row["linkEbay"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceEbay"]==$ottocento?$avviso:($row["priceEbay"].' €')).'</a></td></tr>';
							if($row["platform"] == "PC")
								$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/pc.jpg"></td><td><a href='.$row["linkAmazon"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceAmazon"]==$ottocento?$avviso:($row["priceAmazon"].' €')).'</a></td><td><a href='.$row["linkEbay"].' style="color:green;font-size:16px;font-weight:700;">'.($row["priceEbay"]==$ottocento?$avviso:($row["priceEbay"].' €')).'</a></td></tr>';
			$enter = true;
		}
		else
		{
			break;
		}
	}
	$table.="</table>";
	if($enter)
	{
		echo $table;
	}
	$conn -> close();
	
}
else 
{

	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	//se � gi� stato visto
	$sql = "DELETE FROM cache WHERE idGame=".$idGame;
	$result = $conn->query($sql);
	
	$conn -> close();
	
	$search=$gameDB["Name"];
	$prezziMinimiAmazon = array("PS3"=>"800","PS3_link"=>"", "XBOXONE"=>"800","XBOXONE_link"=>"", "XBOX360"=>"800","XBOX360_link"=>"","PS4"=>"800","PS4_link"=>"","PC"=>"800","PC_link"=>"");
	$prezziMinimiEbay = array("PS3"=>"800","PS3_link"=>"", "XBOXONE"=>"800","XBOXONE_link"=>"", "XBOX360"=>"800","XBOX360_link"=>"","PS4"=>"800","PS4_link"=>"","PC"=>"800","PC_link"=>"");
	
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
	
	$platforms = strtolower($gameDB["Platforms"]);
	$prezzi=$games;
	$avviso="non disponibile";
	$ottocento="800";
	//echo $prezzi[0]["PS4"]=="800"?$avviso:$prezzi[0]["PS4"];
	//print_r($prezzi);
	$table="<table>";
	$sql = "";
	$table.='<tr style="text-align:center"><td style="width:250px;"></td><td><img style="width:200px;height:80px" src="/gadProject/Eshopper/images/product-details/amazonLogo.png"></td><td><img style="width:200px;height:80px" src="/gadProject/Eshopper/images/product-details/ebayLogo.png"></td></tr>';
	if(stripos($platforms,"ps4")!==false)
	{
		$sql.= "INSERT INTO cache VALUES (".str_replace(',', '.', $prezziMinimiAmazon["PS4"]).",".str_replace(',', '.', $prezziMinimiEbay["PS4"]).",'PS4','".$prezziMinimiAmazon["PS4_link"]."','".$prezziMinimiEbay["PS4_link"]."',".$idGame.",'".date('Y-m-d G:i:s')."');";
		$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/ps4.jpg"></td><td><a href='.$prezzi[0]["PS4_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[0]["PS4"]==$ottocento?$avviso:($prezzi[0]["PS4"].' €')).'</a></td><td><a href='.$prezzi[1]["PS4_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[1]["PS4"]==$ottocento?$avviso:($prezzi[1]["PS4"].' €')).'</a></td></tr>';
	
	}
	if(stripos($platforms,"ps3")!==false)
	{
		$sql.= "INSERT INTO cache VALUES (".str_replace(',', '.', $prezziMinimiAmazon["PS3"]).",".str_replace(',', '.', $prezziMinimiEbay["PS3"]).",'PS3','".$prezziMinimiAmazon["PS3_link"]."','".$prezziMinimiEbay["PS3_link"]."',".$idGame.",'".date('Y-m-d G:i:s')."');";
		$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/ps3.png"></td><td><a href='.$prezzi[0]["PS3_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[0]["PS3"]==$ottocento?$avviso:($prezzi[0]["PS3"].' €')).'</a></td><td><a href='.$prezzi[1]["PS3_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[1]["PS3"]==$ottocento?$avviso:($prezzi[1]["PS3"].' €')).'</a></td></tr>';
	
	}
	if(stripos($platforms,"xboxone")!==false)
	{
		$sql.= "INSERT INTO cache VALUES (".str_replace(',', '.', $prezziMinimiAmazon["XBOXONE"]).",".str_replace(',', '.', $prezziMinimiEbay["XBOXONE"]).",'XBOXONE','".$prezziMinimiAmazon["XBOXONE_link"]."','".$prezziMinimiEbay["XBOXONE_link"]."',".$idGame.",'".date('Y-m-d G:i:s')."');";
		$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/xboxone.png"></td><td><a href='.$prezzi[0]["XBOXONE_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[0]["XBOXONE"]==$ottocento?$avviso:($prezzi[0]["XBOXONE"].' €')).'</a></td><td><a href='.$prezzi[1]["XBOXONE_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[1]["XBOXONE"]==$ottocento?$avviso:($prezzi[1]["XBOXONE"].' €')).'</a></td></tr>';
	
	}
	if(stripos($platforms,"xbox360")!==false)
	{
		$sql.= "INSERT INTO cache VALUES (".str_replace(',', '.', $prezziMinimiAmazon["XBOX360"]).",".str_replace(',', '.', $prezziMinimiEbay["XBOX360"]).",'XBOX360','".$prezziMinimiAmazon["XBOX360_link"]."','".$prezziMinimiEbay["XBOX360_link"]."',".$idGame.",'".date('Y-m-d G:i:s')."');";
		$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/xbox360.png"></td><td><a href='.$prezzi[0]["XBOX360_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[0]["XBOX360"]==$ottocento?$avviso:($prezzi[0]["XBOX360"].' €')).'</a></td><td><a href='.$prezzi[1]["XBOX360_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[1]["XBOX360"]==$ottocento?$avviso:($prezzi[1]["XBOX360"].' €')).'</a></td></tr>';
	
	}
	if(stripos($platforms,"pc")!==false)
	{
		$sql.= "INSERT INTO cache VALUES (".str_replace(',', '.', $prezziMinimiAmazon["PC"]).",".str_replace(',', '.', $prezziMinimiEbay["PC"]).",'PC','".$prezziMinimiAmazon["PC_link"]."','".$prezziMinimiEbay["PC_link"]."',".$idGame.",'".date('Y-m-d G:i:s')."');";
		$table.='<tr><td><img style="width:200px;height:60px" src="/gadProject/Eshopper/images/product-details/pc.jpg"></td><td><a href='.$prezzi[0]["PC_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[0]["PC"]==$ottocento?$avviso:($prezzi[0]["PC"].' €')).'</a></td><td><a href='.$prezzi[1]["PC_link"].' style="color:green;font-size:16px;font-weight:700;">'.($prezzi[1]["PC"]==$ottocento?$avviso:($prezzi[1]["PC"].' €')).'</a></td></tr>';
	
	}
	$table.="</table>";
	
	//echo $sql;
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$result = $conn->multi_query($sql);
	
	$conn -> close();
	
	echo $table;
}


	
