<?php

$ch = curl_init("https://api.import.io/store/data/ad239e5f-a9ce-487c-98ae-d374dc1d9c13/_query?input/webpage/url=http%3A%2F%2Fwww.gamerevolution.com%2Fgame%2Fall%2F1%2Flong_name%2Fasc&_user=12c26aee-8ae3-4b58-af08-e4df583faf99&_apikey=12c26aee8ae34b58af08e4df583faf9998be34fe53a13dfaa52cf5ddf1659d6a7b653a5b9635b9a5163de392f0cd19b9aee504b936fc41c39753801434669d86b936fd19499a91ddee477b8c5196a326");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
  $someObject = json_decode($result);
  echo $someObject->results[0]->pepo;

