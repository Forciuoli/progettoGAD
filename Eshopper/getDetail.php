<?php
$idGame=$_GET["id"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GAD";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = 'SELECT * FROM games where Id='.$idGame;
$result = $conn->query($sql);

$conn -> close();

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		//echo $row['review_everyeye'];
	
	

echo '<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
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