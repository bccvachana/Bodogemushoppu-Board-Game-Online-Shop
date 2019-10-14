<?php 
	session_start();
	
	$servername = "localhost";
	$username = "bcc";
	$password = "3286";
	$dbname = "BodogemuShoppu";
	$table1 = "users";
	$table2 = "products";
	$table3 = "orders";
	$table4 = "comment";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$productid = $_GET["id"];

	$sql = "DELETE FROM products WHERE id='$productid'";

	if ($conn->query($sql) === TRUE){
		header('location: http://bodogemushoppu:8888/myshoppu.php');
		exit;	
	}
?>