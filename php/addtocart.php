<?php 
	session_start();

	$servername = "localhost";
	$username = "bcc";
	$password = "3286";
	$dbname = "BodogemuShoppu";
	$table2 = "products";
	$table3 = "carts";

	$conn = new mysqli($servername, $username, $password, $dbname);
	$productid = $_GET["pid"];

	$userid = $_SESSION['id'];
	
	$sql = "INSERT INTO carts (userid, productid) 
	VALUES ('$userid', '$productid')";

	if ($conn->query($sql) === TRUE){
		header('location: ../shop.php');
	}
	else{
		echo "Error: ".$sql."<br>".$conn->error;
	}
 ?>