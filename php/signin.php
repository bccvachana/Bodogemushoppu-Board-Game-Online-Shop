<?php 
	session_start();

	$servername = "localhost";
	$username = "bcc";
	$password = "3286";
	$dbname = "BodogemuShoppu";
	$table1 = "users";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$username = $_GET["username"];
	$password = $_GET["password"];
	$sql = "SELECT * FROM $table1";
	$users = $conn->query($sql);

	while ($row = $users->fetch_assoc()) {
		if ($username == $row['username'] && $password == $row['password'])
		{
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $row['id'];
			header('location: ../index.php');
			exit;
		} else {
			header("location: ".$_SERVER['HTTP_REFERER']."?&error=1");
		}
	}	
?>