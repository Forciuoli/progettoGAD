<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GAD";
$page=1;
$_GET["genre"]="all";
$_GET["platform"]="all";
if(isset($_GET["page"]))
       $page=$_GET["page"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM games LIMIT 12 OFFSET ".($page-1)*12;

$result = $conn->query($sql);

$conn -> close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Game</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/cocc.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<script src="js/index.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/spin.js"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<div id="dark_cover" style="display:none"></div>

	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.html" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.html">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
						<form onsubmit="getGame(this.inputSearch.value);return false;">
							<input name="inputSearch" type="text" placeholder="Search"/>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	
	<section id="mainSection">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Generi</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('all','','');return false;">Tutti</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Action','','');return false;">Azione</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Adventure','','');return false;">Avventura</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Casual','','');return false;">Casual</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Gestionale','','');return false;">Gestionale(manageriale)</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Guida','','');return false;">Gioco di guida</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Ruolo','','');return false;">Gioco di ruolo(giapponese)</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Online','','');return false;">Online</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Picchiaduro','','');return false;">Picchiaduro</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Platform','','');return false;">Platform</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Puzzle','','');return false;">Puzzle</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Simulazione','','');return false;">Simulazione</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Sparatutto','','');return false;">Sparatutto</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Sportivo','','');return false;">Sportivo</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Strategico','','');return false;">Strategico</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames('Survival','','');return false;">Survival</a></h4>
								</div>
							</div>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Piattaforme</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="" onclick="getFilteredGames('','all','');return false;"> <span class="pull-right"></span>Tutte</a></li>
									<li><a href="" onclick="getFilteredGames('','PC','');return false;"> <span class="pull-right"></span>Pc</a></li>
									<li><a href="" onclick="getFilteredGames('','PS4','');return false;"> <span class="pull-right"></span>Ps4</a></li>
									<li><a href="" onclick="getFilteredGames('','PS3','');return false;"> <span class="pull-right"></span>Ps3</a></li>
									<li><a href="" onclick="getFilteredGames('','XbOX 360','');return false;"> <span class="pull-right"></span>Xbox 360</a></li>
									<li><a href="" onclick="getFilteredGames('','Xbox one','');return false;"> <span class="pull-right"></span>Xbox One</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="" onclick="getFilteredGames('','all','');return false;"> <span class="pull-right"></span>Tutte</a></li>
									<li class="active"><a href="" onclick="getFilteredGames('','PC','');return false;"> <span class="pull-right"></span>Pc</a></li>
									<li><a href="" onclick="getFilteredGames('','PS4','');return false;"> <span class="pull-right"></span>Ps4</a></li>
									<li><a href="" onclick="getFilteredGames('','PS3','');return false;"> <span class="pull-right"></span>Ps3</a></li>
									<li><a href="" onclick="getFilteredGames('','XbOX 360','');return false;"> <span class="pull-right"></span>Xbox 360</a></li>
									<li><a href="" onclick="getFilteredGames('','Xbox one','');return false;"> <span class="pull-right"></span>Xbox One</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="elencoGiochi" >
							<?php 
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo '<div class="col-sm-3">
									<div class="product-image-wrapper" style="width:184px;height:367px">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="'.($row["Img_link"]==""?"/gadProject/Eshopper/images/product-details/imgNO.jpg":$row["Img_link"]).'" alt="" style="width:182px;height:256px"/>
												<h2></h2>
												<p>'.$row["Name"].'</p>
												<a onclick="getDetailGame('.$row["Id"].');return false;" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Dettagli</a>
											</div>
											
										</div>
									</div>
								</div>';
								}
							} else {
								echo "0 results";
							}
							?>
							
								
								
					</div><!--/category-tab-->
			
					
					
				</div>
						
			</div>
			<ul class="pagination">
			              <?php
			                $page=1;
			                $pag=1;
							if(isset($_GET["shift"]))
						       $page=$_GET["shift"];
						    if(isset($_GET["page"]))
						       $pag=$_GET["page"];
						    if($page>5)
						    echo '<li><a href="index.php?shift='.($page-5).'&page='.($page-5).'">&laquo;</a></li>';
						    for ($i = 0; $i < 5; $i++) {
						    	if($pag==$page+$i)
						    		echo '<li class="active"><a  href="index.php?page='.($page+$i).'&shift='.($page).'">'.($page+$i).'</a></li>';
						    	else
						    		echo '<li><a href="index.php?page='.($page+$i).'&shift='.($page).'">'.($page+$i).'</a></li>';
						    }	
						    echo '<li><a href="index.php?shift='.($page+5).'&page='.($page+5).'">&raquo;</a></li>';
							?>
						</ul>
		</div>
	</section>
	
	<div id="detailGame">
	</div>
	<footer id="footer"><!--Footer-->
		
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright � 2016 E-GAME Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">ancora NOI</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>