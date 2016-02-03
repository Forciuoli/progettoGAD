<?php
include "getDetailByIdGame.php";
include "getResearchEveryEye.php";
include "getResearchMultiplayer.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GAD";
if(isset($_GET["name"]))
	$name=$_GET["name"];
// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//pulizia nome
	
	$sql = "SELECT * FROM games where Name LIKE '%".$name."%'";
	$result = $conn->query($sql);
	$conn -> close();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$idGame = $row['Id'];
			getDetailByIdGame($idGame);
		}
	}
	else
	{
		$gameE = getResearchEveryEye($name);
		$gameM = getResearchMultiplayer($name);
		
		if($gameM != "non trovato" && $gameE != "non trovato")
		{
			
			$game=new Game($gameE->name,"",$gameM->publisher,$gameE->img_link);
			$game->cooperative=$gameE->cooperative;
			$game->multiplayer=$gameE->multiplayer;
			$game->hw_suggested="";
			$game->minimum_requirements="";
			$game->data=$gameE->data;
			$game->genre=$gameM->genre;
			$game->platform=$gameE->platform;
			$game->vote_multiplayer=$gameM->vote_multiplayer;
			$game->vote_everyeye=$gameE->vote_everyeye;
			$game->review_everyeye=$gameE->review_everyeye;
			$game->review_multiplayer=$gameM->review_multiplayer;
			
		}
		else if($gameM == "non trovato" && $gameE == "non trovato")
		{
			return "";
		}
		else if($gameM == "non trovato")
		{
			
			$game=new Game($gameE->name,"",$gameE->publisher,$gameE->img_link);
			$game->cooperative=$gameE->cooperative;
			$game->multiplayer=$gameE->multiplayer;
			$game->hw_suggested="";
			$game->minimum_requirements="";
			$game->data=$gameE->data;
			$game->genre=$gameE->genre;
			$game->platform=$gameE->platform;
			$game->vote_multiplayer=0;
			$game->vote_everyeye=$gameE->vote_everyeye;
			$game->review_everyeye=$gameE->review_everyeye;
			$game->review_multiplayer="";
				
			
			
		}
		else if($gameE == "non trovato")
		{
			$game=new Game($gameM->name,"",$gameM->publisher,$gameM->img_link);
			$game->cooperative="";
			$game->multiplayer="";
			$game->hw_suggested="";
			$game->minimum_requirements="";
			$game->data=$gameM->data;
			$game->genre=$gameM->genre;
			$game->platform=$gameM->platform;
			$game->vote_multiplayer=$gameM->vote_multiplayer;
			$game->vote_everyeye=0;
			$game->review_everyeye="";
			$game->review_multiplayer=$gameM->review_multiplayer;
		}
		
		$game->review_everyeye = str_replace("'", "''", $game->review_everyeye);
		$game->review_multiplayer = str_replace("'", "''", $game->review_multiplayer);
		$game->name = str_replace("'", "''", $game->name);
		$game->multiplayer = str_replace("'", "''", $game->multiplayer);
		$game->minimum_requirements = str_replace("'", "''", $game->minimum_requirements);
		$game->publisher = str_replace("'", "''", $game->publisher);
		$game->name = str_replace("'", "''", $game->name);
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			//pulizia nome
			
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
																																													}
																																													else
																																													{
																																														echo "Error on ".$game->name.": " . $sql . "<br>" . $conn->error;
																																													}
		
																																													$sql = "SELECT * FROM games where Name='".$game->name."'";
																																													echo $sql;
																																													$result = $conn->query($sql);
																																													
																																													$conn -> close();
																																													
																																													if ($result->num_rows > 0) {
																																														// output data of each row
																																														while($row = $result->fetch_assoc()) {																																													
	echo '<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
						<div id="idGame" style="display:none">'.$row['Id'].'</div>
									<button onclick="hideDetail()" type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Ritorna all &apos; elenco prodotti
									</button>
							<div class="view-product">
								<img src="'.$row['Img_link'].'" alt="" />
								<h3>ZOOM</h3>
							</div>
																																													
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2>'.$row['Name'].'</h2>
								<p><b>Publisher:</b> '.$row['Publisher'].'</p>
								<p><b>Generes:</b> '.str_replace("&", ",", $row['Genres']).'</p>
								<p><b>Platform:</b> '.str_replace("&", ",", $row['Platforms']).'</p>
								<div class="container1">
									<img src="/gadProject/Eshopper/images/product-details/everyeyeLogo.jpg" style="width:250px;height:100px"/>
								    <div id="activeBorder" class="active-border">
																																													
								        <div id="circle" class="circle">
								            <span class="prec '.($row['Vote_everyeye']*36).'" id="prec">80%</span>
								        </div>
								    </div>
								</div>
								<div class="container1">
								     <img src="/gadProject/Eshopper/images/product-details/multiplayerLogo.png" style="width:250px;height:100px"/>
								    <div id="activeBorder1" class="active-border">
						
								        <div id="circle1" class="circle">
								            <span class="prec '.($row['Vote_multiplayer']*36).'" id="prec1">80%</span>
								        </div>
								    </div>
								</div>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
										<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12" style="margin-bottom:-30px">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Dettagli</a></li>
								<li><a href="#reviewMultiplayer" data-toggle="tab">Recensione MultiPlayer</a></li>
								<li><a href="#reviewEveryEye" data-toggle="tab">Recensione EveryEye</a></li>
								<li><a href="#comparaPrezzi" data-toggle="tab">Compara Prezzi</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
																																													
							<div class="tab-pane fade" id="reviewMultiplayer" >
								'.$row['review_multiplayer'].'
							</div>
							<div class="tab-pane fade" id="reviewEveryEye" >
								'.$row['review_everyeye'].'
							</div>
							<div class="tab-pane fade CSSTableGenerator" id="comparaPrezzi" >
			
																																													
																																													
																																													
																																													
					</div><!--/category-tab-->';
																																														}
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
	
	