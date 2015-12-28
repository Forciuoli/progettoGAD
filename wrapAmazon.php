<?php
function getAmazonGames($name){
	$games=array();
	// Your AWS Access Key ID, as taken from the AWS Your Account page
	$aws_access_key_id = "AKIAJHZYEYD6EWCKBYWQ";
	
	// Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
	$aws_secret_key = "A7EllduWv/73s9VZP9IKQmStAqwo1w50t/foav2a";
	
	// The region you are interested in
	$endpoint = "webservices.amazon.it";
	
	$uri = "/onca/xml";
	
	$params = array(
			"Service" => "AWSECommerceService",
			"Operation" => "ItemSearch",
			"AWSAccessKeyId" => "AKIAJHZYEYD6EWCKBYWQ",
			"AssociateTag" => "prova0cb-21",
			"SearchIndex" => "VideoGames",
			"ResponseGroup" => "Offers,OfferFull,OfferListings,ItemAttributes",
			"Sort" => "relevancerank",
			"Keywords" => $name,
			"Version" => "2015-12-145"
	);
	
		$params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
	
	
	// Sort the parameters by key
	ksort($params);
	
	$pairs = array();
	
	foreach ($params as $key => $value) {
		array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
	}
	
	// Generate the canonical query
	$canonical_query_string = join("&", $pairs);
	
	// Generate the string to be signed
	$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
	
	// Generate the signature required by the Product Advertising API
	$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));
	
	// Generate the signed URL
	$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);
	
	//echo "Signed URL: \"".$request_url."\"";
	
	
	$ch = curl_init($request_url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $result = curl_exec($ch);
	    curl_close($ch);
	 
	//Catch the response in the $response object
	 
	     $parsed_xml = @simplexml_load_string($result);
	    // $xml = simplexml_load_string($parsed_xml);
	     $json = json_encode($parsed_xml);
	    $array = json_decode($json);
	    $ids=array();
	//echo $json;
	    if(!isset($array->Items->Item))
	    {
	    	return $games;
	    }
	     for ($i=0; $i<count($array->Items->Item); $i++) {
	     	
	     	if(!is_array($array->Items->Item))
	     	{
		     	if(isset($array->Items->Item->ParentASIN))
		     		array_push($ids,$array->Items->Item->ParentASIN);
		     	else{
		     		//print_r ($array->Items->Item[$i]);
		     		$name=$array->Items->Item->ItemAttributes->Title;
		     		$link=$array->Items->Item->DetailPageURL;
		     		$platform="";
		     		
		     		
		     		if(isset($array->Items->Item->ItemAttributes->Platform))
		     		{
		     			$platform=$array->Items->Item->ItemAttributes->Platform;
		     			if(is_array($platform)){
		     				$platform=$platform[0];
		     			}
		     			if(strtolower($platform)=="playstation 4" || strtolower($platform)=="playstation_4")
		     			{
		     				$platform = "PS4";
		     			}
		     			else if(strtolower($platform)=="playstation 3" || strtolower($platform)=="playstation_3")
		     			{
		     				$platform = "PS3";
		     			}
		     			else if(strtolower($platform)=="xbox 360" || strtolower($platform)=="xbox_360")
		     			{
		     				$platform = "XBOX360";
		     			}
		     			else if(strtolower($platform)=="xbox_one" || strtolower($platform)=="xbox one")
		     			{
		     				$platform = "XBOXONE";
		     			}
		     			else if(stripos($platform, "windows") !== false)
		     			{
		     				$platform = "PC";
		     			}
		     			
		     		}
		     		$prezzo=0;
		     		if(isset($array->Items->Item->Offers->Offer->OfferListing))
		     		 $prezzo= $array->Items->Item->Offers->Offer->OfferListing->Price->FormattedPrice;
		     		else if (isset($array->Items->Item->ItemAttributes->OfferSummary))
		     		$prezzo=  $array->Items->Item->ItemAttributes->OfferSummary->LowestNewPrice->FormattedPrice;
		     		else if (isset($array->Items->Item->ItemAttributes->ListPrice->FormattedPrice))
		     		$prezzo=  $array->Items->Item->ItemAttributes->ListPrice->FormattedPrice;
		     		
		     		$game= new Game($name,$link,$platform,$prezzo);
		     		array_push($games,  $game);
		     	}
	     	}
	     	else
	     	{
	     		if(isset($array->Items->Item[$i]->ParentASIN))
	     			array_push($ids,$array->Items->Item[$i]->ParentASIN);
	     			else{
	     				//print_r ($array->Items->Item[$i]);
	     				$name=$array->Items->Item[$i]->ItemAttributes->Title;
	     				$link=$array->Items->Item[$i]->DetailPageURL;
	     				$platform="";
	     		
	     		
	     				if(isset($array->Items->Item[$i]->ItemAttributes->Platform))
	     				{
	     					$platform=$array->Items->Item[$i]->ItemAttributes->Platform;
	     					if(is_array($platform)){
	     						$platform=$platform[0];
	     					}
	     					if(strtolower($platform)=="playstation 4" || strtolower($platform)=="playstation_4")
	     					{
	     						$platform = "PS4";
	     					}
	     					else if(strtolower($platform)=="playstation 3" || strtolower($platform)=="playstation_3")
	     					{
	     						$platform = "PS3";
	     					}
	     					else if(strtolower($platform)=="xbox 360" || strtolower($platform)=="xbox_360")
	     					{
	     						$platform = "XBOX360";
	     					}
	     					else if(strtolower($platform)=="xbox_one" || strtolower($platform)=="xbox one")
	     					{
	     						$platform = "XBOXONE";
	     					}
	     					else if(stripos($platform, "windows") !== false)
	     					{
	     						$platform = "PC";
	     					}
	     					 
	     				}
	     				$prezzo=0;
	     				if(isset($array->Items->Item[$i]->Offers->Offer->OfferListing))
	     					$prezzo= $array->Items->Item[$i]->Offers->Offer->OfferListing->Price->FormattedPrice;
	     					else if (isset($array->Items->Item[$i]->ItemAttributes->OfferSummary))
	     						$prezzo=  $array->Items->Item[$i]->ItemAttributes->OfferSummary->LowestNewPrice->FormattedPrice;
	     						else if (isset($array->Items->Item[$i]->ItemAttributes->ListPrice->FormattedPrice))
	     							$prezzo=  $array->Items->Item[$i]->ItemAttributes->ListPrice->FormattedPrice;
	     		
	     							$game= new Game($name,$link,$platform,$prezzo);
	     							array_push($games,  $game);
	     			}
	     	}
	     			
	     		
	     }
	    
	//print_r($ids);
	
	foreach ($ids as $id) {
		$params = array(
				"Service" => "AWSECommerceService",
				"Operation" => "ItemLookup",
				"AWSAccessKeyId" => "AKIAJHZYEYD6EWCKBYWQ",
				"AssociateTag" => "prova0cb-21",
				"ResponseGroup" => "ItemAttributes,Variations",
				"ItemId" => $id,
				"Version" => "2015-12-145"
		);
		
		$params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
		
		
		// Sort the parameters by key
		ksort($params);
		
		$pairs = array();
		
		foreach ($params as $key => $value) {
			array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
		}
		
		// Generate the canonical query
		$canonical_query_string = join("&", $pairs);
		
		// Generate the string to be signed
		$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
		
		// Generate the signature required by the Product Advertising API
		$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));
		
		// Generate the signed URL
		$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);
		
		$ch = curl_init($request_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		
		//Catch the response in the $response object
		
		$parsed_xml = @simplexml_load_string($result);
		// $xml = simplexml_load_string($parsed_xml);
		$json = json_encode($parsed_xml);
		//echo $json;
		$array = json_decode($json);
		
		
		
		for ($i=0; $i<count(count($array->Items->Item->Variations->Item)); $i++) {
			
			if(!is_array($array->Items->Item->Variations->Item))
			{
				//print_r($array);
				$name = $array->Items->Item->Variations->Item->ItemAttributes->Title;
				$link = $array->Items->Item->DetailPageURL;
					
				$prezzo=0;
				if(isset($array->Items->Item->Variations->Item->Offers))
					$prezzo = $array->Items->Item->Variations->Item->Offers->Offer->OfferListing->Price->FormattedPrice;
					else
						$prezzo =$array->Items->Item->Variations->Item->ItemAttributes->ListPrice->FormattedPrice;
							
						$platform=$array->Items->Item->Variations->Item->ItemAttributes->HardwarePlatform;
			}
		    else
		    {
		    	$name = $array->Items->Item->Variations->Item[$i]->ItemAttributes->Title;
		    	$link = $array->Items->Item->DetailPageURL;
		    		
		    	$prezzo=0;
		    	if(isset($array->Items->Item->Variations->Item[$i]->Offers))
		    		$prezzo = $array->Items->Item->Variations->Item[$i]->Offers->Offer->OfferListing->Price->FormattedPrice;
		    		else
		    			$prezzo =$array->Items->Item->Variations->Item[$i]->ItemAttributes->ListPrice->FormattedPrice;
		    				
		    			$platform=$array->Items->Item->Variations->Item[$i]->ItemAttributes->HardwarePlatform;
		    }
			
		    if(strtolower($platform)=="playstation 4" || strtolower($platform)=="playstation_4")
		    {
		    	$platform = "PS4";
		    }
		    else if(strtolower($platform)=="playstation 3" || strtolower($platform)=="playstation_3")
		    {
		    	$platform = "PS3";
		    }
		    else if(strtolower($platform)=="xbox 360" || strtolower($platform)=="xbox_360")
		    {
		    	$platform = "XBOX360";
		    }
		    else if(strtolower($platform)=="xbox_one" || strtolower($platform)=="xbox one")
		    {
		    	$platform = "XBOXONE";
		    }
		    else if(stripos($platform, "windows") !== false)
		    {
		    	$platform = "PC";
		    }
			
		    $game= new Game($name,$link,$platform,$prezzo);
		    
		    if(stripos($name, "bundle") === false)
		    	array_push($games,  $game);
			
		}
		
	}
	return $games; 
}
