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
	$cat = $_GET["cat"];

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($cat==0) { $sql = "SELECT * FROM $table2"; $all="filterbutton2"; }
	if ($cat==1) { $sql = "SELECT * FROM $table2 WHERE cat1='1'"; $family="filterbutton2"; }
	if ($cat==2) { $sql = "SELECT * FROM $table2 WHERE cat2='1'"; $strategy="filterbutton2"; }
	if ($cat==3) { $sql = "SELECT * FROM $table2 WHERE cat3='1'"; $party="filterbutton2"; }
	if ($cat==4) { $sql = "SELECT * FROM $table2 WHERE cat4='1'"; $abstract="filterbutton2"; }
	if ($cat==5) { $sql = "SELECT * FROM $table2 WHERE cat5='1'"; $thematic="filterbutton2"; }

	if (isset($_GET["search"])) {
		$search = $conn->escape_string($_GET["search"]);
		$sql = "SELECT * FROM products WHERE productname LIKE '%{$search}%'";
	}

	$products = $conn->query($sql);

	$sql = "SELECT * FROM $table3 WHERE userid='$id'";
	$result = $conn->query($sql);

	$cartnumber = $result->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
	<title>SHOP</title>
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

	<div class="content">
		<div></div>
		<div></div>
		<div class="twentyfive">
			<div id="filter" class="">
				<div class="modal_title">FILTER BY</div>
				<div class="subtopic">Categories</div>
				<a href="../shop.php?cat=0" class="filterbutton <?= $all ?>">All</a>
				<a href="../shop.php?cat=1" class="filterbutton <?= $family ?>">Family Games</a>
				<a href="../shop.php?cat=2" class="filterbutton <?= $strategy ?>">Strategy Games</a>
				<a href="../shop.php?cat=3" class="filterbutton <?= $party ?>">Party Games</a>
				<a href="../shop.php?cat=4" class="filterbutton <?= $abstract ?>">Abstract Games</a>
				<a href="../shop.php?cat=5" class="filterbutton <?= $thematic ?>">Thematic Games</a>
			</div>
		<?php while ($row = $products->fetch_assoc()){?>
			<div class="whitebox product">
				<a href="#detailid<?=$row['id']?>" data-toggle="modal">
				<div class="squareimg2 squareimground red">
					<img src="../img/products/<?= $row['img'] ?>"></div>
				<div class="productname"><?= $row['productname'] ?></div>
				<div class="priceandstar">
					<div class="productprice">฿<?= $row['price']; ?></div>
					<div class="productstar">
						<div class="productstarnumber"><?= $row['sold']; ?> SOLD</div>
					</div>
				</div>
				</a>
			</div>

		<div id="detailid<?=$row['id']?>" class="detail_modal modal fade">
      				<div class="modal-dialog modal-xl">
       				 	<div class="modal-content">
       						<div class="grid-container">
       							<a class="clb" href="#navbar" data-dismiss="modal">X</a>
            					<div class="squareimg2 squareimground"><img src="../img/products/<?= $row['img'] ?>"></div>
            					<div class="modal_title producttitle"><?= $row['productname'] ?></div>
            					<div class="priceonmodal">฿<?= $row['price'] ?></div>
            					<div class="stockonmadal">Stock :    <?= $row['quantity'] ?></div>
            					<div class="descriptiononmadal"><?= $row['description'] ?></div>
            					<div class="detailbut1"><a

            					<?php 
									if(isset($_SESSION['username'])){
									echo "href=\"../php/addtocart.php?pid=".$row['id']."\">";
									} else{ echo "href=\"#signin_modal\" data-toggle=\"modal\" data-dismiss=\"modal\">"; }
								?>

            					<div class="detailbut2 blue"><div>Add to Cart</div></div></a></div>
            				</div> 
         				</div>
  					</div>
  				</div>



		<?php } ?>	
 		</div>
 		<div></div>
		<div></div>
	</div>	

	</div>
	<!--------------------------------------------------------------------------------------->

	<div id="footer">
		<div id="navbar_darkblue" class="darkblue"></div>
		<div id="navbar_blue_footer" class="blue"></div>
	</div>
	
	

</body>
</html>