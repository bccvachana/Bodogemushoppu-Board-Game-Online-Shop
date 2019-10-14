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

	$userid = $_SESSION['id'];

	$conn = new mysqli($servername, $username, $password, $dbname);

	$id = $_GET["id"];

	$sql = "DELETE FROM carts WHERE id='$id'";

	if ($conn->query($sql) === TRUE){
		header('location: http://bodogemushoppu:8888/cart.php');
		exit;	
	}
?>