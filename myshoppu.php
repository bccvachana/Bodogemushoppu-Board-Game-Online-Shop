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

	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM $table1 WHERE id='$id'";
	$users = $conn->query($sql);

	$roww = $users->fetch_assoc();

	$sql = "SELECT * FROM $table2 WHERE userid='$id'";
	$products = $conn->query($sql);

	$sql = "SELECT * FROM $table3 WHERE userid='$id'";
	$result = $conn->query($sql);

	$cartnumber = $result->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
	<title>MY SHOPPU</title>
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
				<div class="col-12 createbutton"><a href="register.html">Create New Account</a></div>
            	</div>
            </div>
         </div>
  </div>

	<!--------------------------------------------------------------------------------------->


		<div class="modal_title myshopputitle">
			<div>MY SHOPPU</div>
			<a href="#editinfo_modal" data-toggle="modal">Edit Your Information</a>
		</div>

	<div class="content">
		<div></div>
		<div></div>

		<div class="twenty">

			<?php while ($row = $products->fetch_assoc()){ ?>
			<div class="whitebox product"> <!---------------------------------------------->
				<div class="squareimg2 squareimground">
					<img src="../img/products/<?= $row['img'] ?>">
				</div>
				<div class="productname"><?= $row['productname'] ?></div>
				<div class="priceandstar">
					<div class="productprice">฿<?= $row['price']; ?></div>
					<div class="productstar">
						<div class="productstarnumber"><?= $row['sold']; ?> SOLD</div>
					</div>
				</div>
				<div class="editdel0">
					<div class="editdel">
						<a href="#editid<?= $row['id'] ?>" data-toggle="modal">Edit</a>
						<div></div>
						<a href="#deleteid<?=$row['id'];?>" data-toggle="modal">Delete</a>
					</div>
				</div>
			</div>

				<div id="editid<?= $row['id'] ?>" class="product_modal modal fade">
      				<div class="modal-dialog modal-lg">
       				 	<div class="modal-content">
       						<div class="container">
            					<div class="row modal_title_row">
            						<div class="col-11 modal_title">Edit Product</div>
            						<div class="col-1 closebutton"><a href="#navbar" data-dismiss="modal">X</a></div>
            					</div>		
            				<form class="form row" action="php/editproduct.php/?id=<?= $row['id'] ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
								<input type="text" class="col-12 inputbox" name="productname" value="<?= $row['productname'] ?>" placeholder="Product Name" required>
								<div class="col-12 registitle center addmar">Categories</div>
								<div class="col-1"></div>
								<div class="col-5"><input type="checkbox" name="cat1"
									value="<?= $row['cat1'] ?>">   Family Games</div>
								<div class="col-5"><input type="checkbox" name="cat2"
									value="<?= $row['cat2'] ?>">   Strategy Games</div>
								<div class="col-1"></div>
								<div class="col-1"></div>
								<div class="col-5"><input type="checkbox" name="cat3"
									value="<?= $row['cat3'] ?>">   Party Games</div>
								<div class="col-5"><input type="checkbox" name="cat4"
									value="<?= $row['cat3'] ?>">   Abstract Games</div>
								<div class="col-1"></div>
								<div class="col-1"></div>
								<div class="col-5"><input type="checkbox" name="cat5"
									value="<?= $row['cat5'] ?>">   Thematic Games</div>
								<div class="col-6"></div>
								<div class="firstlast addmar2">
									<input type="text" class="col-12 inputbox" name="price"
										value="<?= $row['price'] ?>" placeholder="Price (Bath)" required>
									<input type="text" class="col-12 inputbox" name="quantity"
										value="<?= $row['quantity'] ?>" placeholder="Quantity" required>
								</div>
								<textarea name="description" rows="5" cols="80"
									placeholder="Product Description"><?= $row['description'] ?></textarea>
								<div class="col-3"></div>
								<input type="file" id="fileField" name="fileToUpload" value="fileToUpload" placeholder="">
								<div class="col-3"></div>
								<div id="errordisplay" class="col-12"></div>
								<input type="submit" class="col-12 signinbutton" name="submit" value="Save">
							</form>
            				</div> 
         				</div>
  					</div>
  				</div>

  				<div id="deleteid<?=$row['id'];?>" class="modal fade deletebox0">
      				<div class="modal-dialog modal-ld">
        				<div class="modal-content">
       						<div class="container">
            					<div class="row modal_title_row">
            						<div class="col-11 modal_title delete_title">Are you sure to delete this product?</div>
            						<div class="col-1 closebutton"><a href="#navbar" data-dismiss="modal">X</a></div>
									<div class="col-12 deletebox1">
									<div class="deletebox2 center">
										<a href="../php/deleteproduct.php/?id=<?= $row['id'] ?>">Yes</a>
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

			<a href="#addproduct_modal" data-toggle="modal" class="whitebox product addproduct"><div>+</div></a>

		</div>
		<div></div>
		<div></div>


	</div>

	<div id="editinfo_modal" class="modal fade">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
       		<div class="container">
            	<div class="row modal_title_row">
            		<div class="col-11 modal_title">Edit Your Information</div>
            		<div class="col-1 closebutton"><a href="#navbar" data-dismiss="modal">X</a></div>
            	</div>		
            	<form class="form row" action="php/edituser.php" method="get" accept-charset="utf-8">
					<input type="text" class="col-12 inputbox" name="fullname" value="<?php echo $roww['fullname']; ?>" placeholder="Full Name" required>
					<div class="firstlast">
						<input type="text" class="col-12 inputbox" name="phone" value="<?php echo $roww['phone']; ?>" placeholder="Phone Number" required>
						<input type="text" class="col-12 inputbox" name="email" value="<?php echo $roww['email']; ?>" placeholder="Email Address" required>
					</div>
					<input type="text" class="col-12 inputbox" name="address"
					value="<?php echo $roww['address']; ?>" placeholder="Address" required>
					<div id="errordisplay" class="col-12"></div>
					<input type="submit" class="col-12 signinbutton" name="submit" value="Save">
				</form>
            </div>
         </div>
  	</div>
  </div>

  	<div id="addproduct_modal" class=" product_modal modal fade">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
       		<div class="container">
            	<div class="row modal_title_row">
            		<div class="col-11 modal_title">Add a Product</div>
            		<div class="col-1 closebutton"><a href="#navbar" data-dismiss="modal">X</a></div>
            	</div>		
            	<form class="form row" action="php/addproduct.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<input type="text" class="col-12 inputbox" name="productname" value="" placeholder="Product Name" required>
						<div class="col-12 registitle center addmar">Categories</div>
						<div class="col-1"></div>
						<div class="col-5"><input type="checkbox" name="cat1" value="1">   Family Games</div>
						<div class="col-5"><input type="checkbox" name="cat2" value="1">   Strategy Games</div>
						<div class="col-1"></div>
						<div class="col-1"></div>
						<div class="col-5"><input type="checkbox" name="cat3" value="1">   Party Games</div>
						<div class="col-5"><input type="checkbox" name="cat4" value="1">   Abstract Games</div>
						<div class="col-1"></div>
						<div class="col-1"></div>
						<div class="col-5"><input type="checkbox" name="cat5" value="1">   Thematic Games</div>
						<div class="col-6"></div>
					<div class="firstlast addmar2">
						<input type="text" class="col-12 inputbox" name="price" value="" placeholder="Price (Bath)" required>
						<input type="text" class="col-12 inputbox" name="quantity" value="" placeholder="Quantity" required>
					</div>
					<textarea name="description" rows="5" cols="80"
					placeholder="Product Description"></textarea>
					<div class="col-3"></div>
					<input type="file" id="fileField" name="fileToUpload" value="fileToUpload" placeholder="">
					<div class="col-3"></div>
					<div id="errordisplay" class="col-12"></div>
					<input type="submit" class="col-12 signinbutton" name="submit" value="Add a Product">
				</form>
            </div>
         </div>
  	</div>
  </div>
  	
	<!--------------------------------------------------------------------------------------->

	<div id="footer">
		<div id="navbar_darkblue" class="darkblue"></div>
		<div id="navbar_blue_footer" class="blue"></div>
	</div>
	
	

</body>
</html>