<?php
$letter = '1,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z';
$letter2 = explode(",", $letter);
$api_key="1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef";
for ($j=0;$j<count($letter2);$j++)
{
	echo $letter2[$j]."<br/>";
$ch = curl_init("https://api.import.io/store/data/800fe53d-9a73-4e88-b598-a6e6e2897012/_query?input/webpage/url=http%3A%2F%2Fwww.gamerevolution.com%2Fgame%2Fall%2F".$letter2[$j]."%2Flong_name%2Fasc&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=".$api_key);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
//echo $result;
  $someObject = json_decode($result);
  
   for ($i=1;$i < count($someObject->results);$i++)
   {
   	$name = strtolower($someObject->results[$i]->{'name/_text'});
   	if(strpos($name,'ii') !== false || strpos($name,'iii') !== false)
   	{
   		$name = str_replace('iii', '3', $name);
   		$name = str_replace('ii', '2', $name);
   	}
   	echo $name.'<br/>';
   }
   
}
//   	$name2 = "http%3A%2F%2Fwww.gamerevolution.com%2Fgame%2F".$name;
//   	$url_single_publisher = "https://api.import.io/store/data/13daeba6-655e-4af9-93b3-34e89dcf842a/_query?input/webpage/url=".$name2."&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=".$api_key;
//   	$ch = curl_init($url_single_publisher);
//   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//   	$res = curl_exec($ch);
//   	$ob = json_decode($res);
//   	echo "game = ".$name." publisher = ".$ob -> results[0]->publisher."<br/>";
//   	curl_close($ch);
//   }
  
$letter = "1";
$api_key = "1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef";
$ch = curl_init ( "https://api.import.io/store/data/800fe53d-9a73-4e88-b598-a6e6e2897012/_query?input/webpage/url=http%3A%2F%2Fwww.gamerevolution.com%2Fgame%2Fall%2F" . $letter . "%2Flong_name%2Fasc&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=" . $api_key );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
// Disable SSL verification
curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
$result = curl_exec ( $ch );
curl_close ( $ch );
//echo $result;
$someObject = json_decode ( $result );
echo $someObject;
// echo $someObject->results[0]->name;
// for($i = 1; $i < count ( $someObject->results ); $i ++) {
// 	$name = substr ( $someObject->results [$i]->name, 35 );
// 	$name2 = "http%3A%2F%2Fwww.gamerevolution.com%2Fgame%2F" . $name;
// 	$url_single_publisher = "https://api.import.io/store/data/13daeba6-655e-4af9-93b3-34e89dcf842a/_query?input/webpage/url=" . $name2 . "&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=" . $api_key;
// 	$ch = curl_init ( $url_single_publisher );
// 	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
// 	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
// 	$res = curl_exec ( $ch );
// 	$ob = json_decode ( $res );
// 	echo "game = " . $name . " publisher = " . $ob->results [0]->publisher . "<br/>";
// 	curl_close ( $ch );
// }
  
//gamesEveryEye
//https://api.import.io/store/data/eb8721e7-d9de-43a4-af4c-a5c395e6d294/_query?input/webpage/url=http%3A%2F%2Fwww.everyeye.it%2Fgiochi%2F&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef

  //genre and publisher
  //https://api.import.io/store/data/13daeba6-655e-4af9-93b3-34e89dcf842a/_query?input/webpage/url=http%3A%2F%2Fwww.gamerevolution.com%2Fgame%2F0-day-attack-on-earth&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef

//link wipedia 2010/2011
//https://api.import.io/store/data/ced00686-b169-4950-8400-734195ed62a1/_query?input/webpage/url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2F2010_in_video_gaming&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef