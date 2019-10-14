<?php 
	session_start();

	$servername = "localhost";
	$username = "bcc";
	$password = "3286";
	$dbname = "BodogemuShoppu";
	$table1 = "users";
	$table2 = "products";
	$table3 = "carts";
	$table4 = "history";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$userid = $_SESSION['id'];

	$sql = "SELECT * FROM $table3 WHERE userid='$userid'";
	$carts = $conn->query($sql);

	while ($row = $carts->fetch_assoc()){
		$cartid = $row['id'];
		$productid = $row['productid'];
		$sql = "INSERT INTO history (cartid, userid, productid) 
		VALUES ('$cartid', '$userid', '$productid')";
		$conn->query($sql);

		$sql = "SELECT * FROM $table2 WHERE id='$productid'";
		$sold = $conn->query($sql);
		$s = $sold->fetch_assoc();
		$ns = $s['sold'] + 1;
		$quantity = $s['quantity'] - 1;
		$sql = "UPDATE products SET sold='$ns', quantity='$quantity' WHERE id='$productid'";
		$conn->query($sql);
	}

	$sql = "SELECT * FROM $table4 WHERE userid='$userid'";
	$history = $conn->query($sql);

	while ($row = $history->fetch_assoc()){
		$cartid = $row['cartid'];
		$productid = $row['productid'];
		$sql = "DELETE FROM carts WHERE id='$cartid'";
		$conn->query($sql);
	}
	
	if ($conn->query($sql) === TRUE){
		header('location: ../success.php');
	}
	else{
		echo "Error: ".$sql."<br>".$conn->error;
	}
 ?>