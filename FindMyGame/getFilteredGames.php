<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GAD";
$page=1;

if(isset($_GET["page"]))
	$page=$_GET["page"];
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if(isset($_GET["genre"]) && isset($_GET["platform"]))
	{
		$genre=$_GET["genre"];
		$platform=$_GET["platform"];
		if($genre=="all" && $platform=="all")
		{
			$sql = "SELECT * FROM games LIMIT 12 OFFSET ".($page-1)*12;
		}
		else if($genre=="all" && $platform!="all")
		{
			$sql = "SELECT * FROM games WHERE Platforms LIKE '%".$platform."%' LIMIT 12 OFFSET ".($page-1)*12;
		}
		else if($genre!="all" && $platform=="all")
		{
			
			$sql = "SELECT * FROM games WHERE Genres LIKE '%".$genre."%' LIMIT 12 OFFSET ".($page-1)*12;
		}
		else
		{
			$sql = "SELECT * FROM games WHERE Genres LIKE '%".$genre."%' AND Platforms LIKE '%".$platform."%' LIMIT 12 OFFSET ".($page-1)*12;
		}

	}
	//echo $sql;
	$result = $conn->query($sql);

	$conn -> close();





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