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

//$link = "http%3A%2F%2Fwww.everyeye.it%2Farticoli%2Frecensione-anoxemia-24715.html";
$ch = curl_init ("https://api.import.io/store/connector/0453b716-4774-4802-913e-e64060955f17/_query?input=webpage/url:http%3A%2F%2Fmultiplayer.it%2Frecensioni%2F158555-call-of-duty-black-ops-iii-mental-ops.html%3Fpiattaforma%3Dps4&&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
// Disable SSL verification
curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
$result = curl_exec ( $ch );
curl_close ( $ch );
$someObject = json_decode ( $result );
echo $someObject -> results[0] -> review;