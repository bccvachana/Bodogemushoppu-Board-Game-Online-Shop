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

	$target_dir = "../img/products/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

	$productid = $_GET["id"];

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
	$img = basename($_FILES["fileToUpload"]["name"]);


	$sql = "UPDATE products SET productname='$productname', cat1='$cat1', 
	cat2='$cat2', cat3='$cat3', cat4='$cat4', cat5='$cat5', price='$price',
	quantity='quantity', description='description', img='$img' WHERE id='$productid'";

	if ($conn->query($sql) === TRUE){
		header('location: http://bodogemushoppu:8888/myshoppu.php');
		exit;	
	}
?>