<?php
// $nameSelected = "call of duty";
// $api_key = "1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef";
// $ch = curl_init ("https://api.import.io/store/connector/dcdd2e3c-6e3c-48f2-a9b9-015ef2f43b66/_query?input=webpage/url:http%3A%2F%2Fwww.consoleplanet.it%2Fcatalogsearch%2Fresult%2Findex%2F%3Fcat%3D0%26limit%3D36%26q%3D".urlencode($nameSelected)."&&_apikey=". $api_key );
// curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
// // Disable SSL verification
// curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
// $result = curl_exec ( $ch );
// curl_close ( $ch );
// //echo $result;
// $someObject = json_decode ( $result );
// print_r($someObject -> results);

$link = "http%3A%2F%2Fwww.everyeye.it%2Farticoli%2Frecensione-anoxemia-24715.html";
$ch = curl_init ("https://api.import.io/store/connector/a7f8384c-bab9-4cb7-ae28-66868f6fb34a/_query?input=webpage/url:".$link."&&_apikey=1612660c6d3544b0bf1d29a49efd169bf68f20bae1b1e7fe100d0c943b328a0b9266dedd030dd5c9f87c9863938967c52c8d7be1b9d2674cfd6318083e289aa38f29f192f864849a7d6e7341951a47ef");
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
// Disable SSL verification
curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
$result = curl_exec ( $ch );
curl_close ( $ch );
$someObject = json_decode ( $result );
echo $someObject -> results[0] -> review;