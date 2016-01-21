<?php
include "getDetailByIdGame.php";
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
		
	}
	