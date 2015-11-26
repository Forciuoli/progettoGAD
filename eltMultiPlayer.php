<?php
set_time_limit(1000000);
$pepiFree=array();
for($i=1;$i<13;$i++){
	if($i==1)
		$ch = curl_init("https://api.import.io/store/data/647f1b46-43ec-430d-8c0f-b82a184138d0/_query?input/webpage/url=http%3A%2F%2Fmultiplayer.it%2Fgiochi%2F%3Fmonth%3D2015_10&_user=12c26aee-8ae3-4b58-af08-e4df583faf99&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
		else
		{
			$link="http://multiplayer.it/giochi/?pagina=".$i."&_=wjums&month=2015_10&querystring_key=pagina";
			echo $link."</br>";
			$ch = curl_init("https://api.import.io/store/data/647f1b46-43ec-430d-8c0f-b82a184138d0/_query?input/webpage/url=".urlencode($link)."&_user=12c26aee-8ae3-4b58-af08-e4df583faf99&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		//https://api.import.io/store/data/ee6f2895-03d9-41e3-a099-97025ea0e7d7/_query?input/webpage/url=http%3A%2F%2Fmultiplayer.it%2Fgiochi%2Fgod-of-war-per-ps2.html&_user=12c26aee-8ae3-4b58-af08-e4df583faf99&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326
		//echo $result;

		$someObject = json_decode($result);
		for ($j=0;$j < count($someObject->results);$j++)
		{
			//echo $someObject->results[$j]->{'name/_title'}."</br>";
			$platform = $someObject->results[$j]->{'platform/_text'};
			//echo $link."</br>";
			echo $platform;
			if($platform!="Android" && $platform!="iPad" && $platform!="iPhone" && $platform!="Playstation Vita" && $platform!="Nintendo 3DS")
			{
				array_push($pepiFree,$someObject->results[$j]);
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
}

print_r ($pepiFree);

//genre and publisher
//https://api.import.io/store/data/13daeba6-655e-4af9-93b3-34e89dcf842a/_query?input/webpage/url=http%3A%2F%2Fwww.gamerevolution.com%2Fgame%2F0-day-attack-on-earth&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef

//link wipedia 2010/2011
//https://api.import.io/store/data/ced00686-b169-4950-8400-734195ed62a1/_query?input/webpage/url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2F2010_in_video_gaming&_user=1612660c-6d35-44b0-bf1d-29a49efd169b&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef