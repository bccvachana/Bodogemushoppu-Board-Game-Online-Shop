<?php 
	$servername = "localhost";
	$username = "bcc";
	$password = "3286";
	$dbname = "BodogemuShoppu";
	$table1 = "users";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$username = $_GET["username"];
	$password = $_GET["password"];
	$fullname = $_GET["fullname"];
	$phone = $_GET["phone"];
	$email = $_GET["email"];
	$address = $_GET["address"];

	$sql = "INSERT INTO $table1 (username, password, fullname, phone, email, address) 
	VALUES ('$username', '$password', '$fullname', '$phone', '$email', '$address')";

	if ($conn->query($sql) === TRUE){
		header('location: ../index.php?register=1');
		exit;
	}
	else{
		echo "Error: ".$sql."<br>".$conn->error;
	}
 ?>