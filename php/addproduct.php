<?php 
	session_start();

	$servername = "localhost";
	$username = "bcc";
	$password = "3286";
	$dbname = "BodogemuShoppu";
	$table2 = "products";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$target_dir = "../img/products/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

	$userid = $_SESSION['id'];
	$productname = $_POST["productname"];
	$cat1 = $_POST["cat1"];
	$cat2 = $_POST["cat2"];
	$cat3 = $_POST["cat3"];
	$cat4 = $_POST["cat4"];
	$cat5 = $_POST["cat5"];
	$price = $_POST["price"];
	$quantity = $_POST["quantity"];
	$description = $_POST["description"];
	$sold = 0;
	$img = basename($_FILES["fileToUpload"]["name"]);


	$sql = "INSERT INTO products (userid, productname, cat1, cat2, cat3, cat4,
	 cat5, price, quantity, description, sold, img) 
	VALUES ('$userid', '$productname', '$cat1', '$cat2', '$cat3', '$cat4',
	 '$cat5', '$price', '$quantity', '$description','$sold', '$img')";

	if ($conn->query($sql) === TRUE){
		header('location: ../myshoppu.php');
		exit;
	}
	else{
		echo "Error: ".$sql."<br>".$conn->error;
	}
 ?>