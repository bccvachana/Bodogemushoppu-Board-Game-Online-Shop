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
	$_SESSION['username'] = "bccvachana";
	$uu = $_SESSION['username'];

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}
	echo "Connected successfully <br>";

	$sql = "SELECT * FROM $table1 WHERE id='1'";
	$users = $conn->query($sql);

	$row = $users->fetch_assoc();
	echo $row['username'];
	echo $row['email'];
	
	$conn->error;
?>