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

	$id = $_SESSION['id'];
	$total = 0;

	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM $table1 WHERE id='$id'";
	$users = $conn->query($sql);

	$row = $users->fetch_assoc();

	$sql = "SELECT * FROM $table3 WHERE userid='$id'";
	$carts = $conn->query($sql);

	$id = $_SESSION['id'];
	$sql = "SELECT * FROM $table3 WHERE userid='$id'";
	$result = $conn->query($sql);

	$cartnumber = $result->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link href="img/icon.png" type="image/png" rel="icon">
	<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link href="css/navbar.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="js/index.js"></script>
<body>
	<div id="navbar">
		<div id="navbar_blue" class="blue">
			<div></div>
			<nav>
				<div></div>
				<a href=".." id="nav_logo"><img src="img/nav/logo.png"></a>
				<div></div>
				<div id="nav_search">
					<form id="nav_search_form" action="../shop.php" method="get">
						<div></div>
						<input type="text" id="nav_search_text" name="search" placeholder="Search in Bodogemu Shoppu">
						<input type="image" id="nav_search__img" name="submit" src="img/nav/search.png">
						<div></div>
					</form>
				</div>
				<div></div>
				<div id="nav_user" class="dropdown">
					<?php 

						if(isset($_SESSION['username'])){
							echo "<a href=\"#\" role=\"button\" id=\"nav_user_dropdown\" data-toggle=\"dropdown\"
							aria-haspopup=\"true\" aria-expanded=\"false\">";
						} else{ echo "<a href=\"#signin_modal\" data-toggle=\"modal\">"; }
					?>
						<div></div>
						<img src="img/nav/user.png">
						<div></div>
						<div id="nav_user_text">
						<?php 
							if(isset($_SESSION['username'])){
								echo $_SESSION['username'];
							}else{ echo "SIGN IN";}
						?>
						</div>
						<div></div>
					</a>
					<div id="nudropdown" class="dropdown-menu" aria-labelledby="nav_user_dropdown">
						<a class="dropdown-item" href="history.php">Purchase History</a>
    					<a class="dropdown-item" href="myshoppu.php">My Shoppu</a>
    					<a class="dropdown-item" href="php/signout.php">Sign out</a>
  					</div>
				</div>
				<div></div>
				<div id="nav_cart">
					<?php 

						if(isset($_SESSION['username'])){
							echo "<a href=\"../cart.php\">";
						} else{ echo "<a href=\"#signin_modal\" data-toggle=\"modal\">"; }
					?>
						<img src="img/nav/cart.png">
						<div id="nav_cart_number"
							
					<?php 
						if($cartnumber>0){
							echo "class=\"nav_cart_num\">".$cartnumber;
						}
						else { echo ">"; }
					?>

						</div>
						<!--<div id="nav_cart_number" class="nav_cart_num">15</div>-->
					</a>
				</div>
				<div></div>
			</nav>
			<div></div>
		</div>
		<div id="navbar_darkblue" class="darkblue"></div>
	</div>

	<div id="signin_modal" class="modal fade">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
       		<div class="container">
            	<div class="row modal_title_row">
            		<div class="col-11 modal_title">Sign in</div>
            		<div class="col-1 closebutton"><a href="#navbar" data-dismiss="modal">X</a></div>
            	</div>		
            	<form class="form row" action="php/signin.php" method="get" accept-charset="utf-8">
					<input type="text" class="col-12 inputbox" name="username" value="" placeholder="Username" required>
					<input type="password" class="col-12 inputbox" name="password" value="" placeholder="Password" required>
					<div id="errordisplay" class="col-12"></div>
					<input type="submit" class="col-12 signinbutton" name="submit" value="Sign in">
				</form>
				<div class="col-12 createbutton"><a href="register.php">Create New Account</a></div>
            	</div>
            </div>
         </div>
  </div>

	<!--------------------------------------------------------------------------------------->

	<div class="screen">


	<div class="modal_title myshopputitle">
			<div>CART</div>
	</div>

	<div class="cartgrid">

	<?php while ($row = $carts->fetch_assoc()){
			$cartid = $row['productid'];
			$sql = "SELECT * FROM $table2 WHERE id='$cartid'";
			$products = $conn->query($sql);
			$roww = $products->fetch_assoc();
			$total = $total + $roww['price'];
	?>

	<div class="whitebox product cartitem">
		<a class="clbcart" href="#deleteid<?=$row['id'];?>" data-toggle="modal">X</a>
		<div class="squareimg2"><img src="../img/products/<?= $roww['img'] ?>"></div>
		<div class="cartcol2">
		<div class="cartproductname"><?=$roww['productname']?></div>
		<div class="cartprice">฿<?=$roww['price']?></div>
		</div>
	</div>
		<div id="deleteid<?=$row['id'];?>" class="modal fade deletebox0">
      				<div class="modal-dialog modal-ld">
        				<div class="modal-content">
       						<div class="container">
            					<div class="row modal_title_row">
            						<div class="col-11 modal_title delete_title">Are you sure to remove this product from your cart?</div>
									<div class="col-12 deletebox1">
									<div class="deletebox2 center">
										<a href="../php/deletecart.php/?id=<?= $row['id'] ?>">Yes</a>
										<div></div>
										<a href="#" data-dismiss="modal">No</a>
									</div>
									</div>
            					</div>		
        
            				</div>
         				</div>
  					</div>
  		</div>

  	<?php } ?>	

	</div>


	<div class="whitebox product total">
		<div>Total : <span>฿<?= $total ?></span></div>
		<div class="cbut"><a href="../php/purchase.php">
			<div class="cartbut blue"><div>Place Your Order</div></div>
		</a></div>
	</div>


	</div>

  	
	<!--------------------------------------------------------------------------------------->

	<div id="footer">
		<div id="navbar_darkblue" class="darkblue"></div>
		<div id="navbar_blue_footer" class="blue"></div>
	</div>
	
	

</body>
</html>