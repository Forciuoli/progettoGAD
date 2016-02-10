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
    <title>Home | Find My Game</title>
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
					<img style="margin-left:25%;width:600px;height:80px" src="/gadProject/FindMyGame/images/product-details/logo1.png">
				</div>
			</div>
		</div><!--/header_top-->
		
		
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
			
						</div>
						<div class="mainmenu pull-left">
							
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
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'all','','');return false;">Tutti</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Action','','');return false;">Azione</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Adventure','','');return false;">Avventura</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Casual','','');return false;">Casual</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Gestionale','','');return false;">Gestionale</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Guida','','');return false;">Gioco di guida</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Ruolo','','');return false;">Gioco di ruolo</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Online','','');return false;">Online</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Picchiaduro','','');return false;">Picchiaduro</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Platform','','');return false;">Platform</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Puzzle','','');return false;">Puzzle</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Simulazione','','');return false;">Simulazione</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Sparatutto','','');return false;">Sparatutto</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Sportivo','','');return false;">Sportivo</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Strategico','','');return false;">Strategico</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="" onclick="getFilteredGames(this,'Survival','','');return false;">Survival</a></h4>
								</div>
							</div>
						</div><!--/category-products-->
					
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					
					
					<div class="category-tab"><!--category-tab-->
						<div id="accordian1" class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="" onclick="getFilteredGames(this,'','all','');return false;"> <span class="pull-right"></span>Tutte</a></li>
									<li><a href="" onclick="getFilteredGames(this,'','PC','');return false;"> <span class="pull-right"></span>Pc</a></li>
									<li><a href="" onclick="getFilteredGames(this,'','PS4','');return false;"> <span class="pull-right"></span>Ps4</a></li>
									<li><a href="" onclick="getFilteredGames(this,'','PS3','');return false;"> <span class="pull-right"></span>Ps3</a></li>
									<li><a href="" onclick="getFilteredGames(this,'','XbOX360','');return false;"> <span class="pull-right"></span>Xbox 360</a></li>
									<li><a href="" onclick="getFilteredGames(this,'','Xboxone','');return false;"> <span class="pull-right"></span>Xbox One</a></li>
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
												<img src="'.($row["Img_link"]==""?"/gadProject/FindMyGame/images/product-details/imgNO.jpg":$row["Img_link"]).'" alt="" style="width:182px;height:256px"/>
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
			<ul class="pagination" id="paginator">
			              <?php
			                $page=1;
			                $pag=1;
							if(isset($_GET["shift"]))
						       $page=$_GET["shift"];
						    if(isset($_GET["page"]))
						       $pag=$_GET["page"];
						    if($page>5)
						    echo "<li><a href=\"\" onclick=\"getFilteredGames(null,'','',".($page-5).",".($page-5).");return false;\">&laquo;</a></li>";
						    for ($i = 0; $i < 5; $i++) {
						    	if($pag==$page+$i)
						    		echo "<li><a href=\"\" onclick=\"getFilteredGames(null,'','',".($page+$i).",".($page).");return false;\">".($page+$i)."</a></li>";
						    	else
						    		echo "<li><a href=\"\" onclick=\"getFilteredGames(null,'','',".($page+$i).",".($page).");return false;\">".($page+$i)."</a></li>";
						    }	
						    echo "<li><a href=\"\" onclick=\"getFilteredGames(null,'','',".($page+5).",".($page+5).");return false;\">&raquo;</a></li>";
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
					<p class="pull-left"></p>
					<p class="pull-right"> <span></span></p>
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