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

	$id = $_SESSION['id'];

	$conn = new mysqli($servername, $username, $password, $dbname);

	$fullname = $_GET["fullname"];
	$phone = $_GET["phone"];
	$email = $_GET["email"];
	$address = $_GET["address"];

	$sql = "UPDATE $table1 SET fullname='$fullname', phone='$phone', 
	email='$email', address='$address' WHERE id='$id'";

	if ($conn->query($sql) === TRUE){
		header('location: ../myshoppu.php');
		exit;	
	}
?>