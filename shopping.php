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

	$sql = "CREATE TABLE $table1 (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(60) NOT NULL,
	password VARCHAR(20) NOT NULL,
	fullname VARCHAR(60),
	phone VARCHAR(20),
	email VARCHAR(20),
	address VARCHAR(256),
	img VARCHAR(256)
	)";

	$conn->query($sql); 

	$sql2 = "CREATE TABLE $table2 (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	userid INT(6),
	productname VARCHAR(100) NOT NULL,
	cat1 VARCHAR(10),
	cat2 VARCHAR(10),
	cat3 VARCHAR(10),
	cat4 VARCHAR(10),
	cat5 VARCHAR(10),
	price VARCHAR(10),
	quantity VARCHAR(10),
	description VARCHAR(256),
	img VARCHAR(256)
	)";

	$conn->query($sql2); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Bodogemu Shoppu</title>
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
					<form id="nav_search_form" action="../shopping.php" method="get">
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
						<a class="dropdown-item" href="#">Purchase History</a>
    					<a class="dropdown-item" href="myshoppu.php">My Shoppu</a>
    					<a class="dropdown-item" href="php/signout.php">Sign out</a>
  					</div>
				</div>
				<div></div>
				<div id="nav_cart">
					<a href="#signin_modal" data-toggle="modal">
						<img src="img/nav/cart.png">
						<div id="nav_cart_number"></div>
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

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  	<ol class="carousel-indicators">
	    	<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	   		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    	<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	    	<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
		</ol>
  		<div class="carousel-inner">
    		<div class="carousel-item active">
      			<img src="img/ad/1.jpg" class="d-block w-100" alt="...">
    		</div>
	    	<div class="carousel-item">
	      		<img src="img/ad/2.jpg" class="d-block w-100" alt="...">
	    	</div>
	    	<div class="carousel-item">
	      		<img src="img/ad/3.jpg" class="d-block w-100" alt="...">
	    	</div>
	    	<div class="carousel-item">
	      		<img src="img/ad/4.png" class="d-block w-100" alt="...">
	    	</div>
  		</div>
  		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    		<span class="sr-only">Previous</span>
  		</a>
  		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    		<span class="carousel-control-next-icon" aria-hidden="true"></span>
    		<span class="sr-only">Next</span>
  		</a>
	</div>

	<div class="content topic">
		<div></div><div></div><div>CATEGORIES</div><div></div><div></div>
	</div>
	<div class="content">
		<div></div>
		<div></div>
		<div class="five">
			<a href="../shopping.php?cat=1" class="whitebox categories">
				<div class="squareimg"><img src="img/cate/cate1.png"></div>
				<div>Family Games</div>
			</a>
			<a href="../shopping.php?cat=2" class="whitebox categories">
				<div class="squareimg"><img src="img/cate/cate2.png"></div>
				<div>Strategy Games</div>
			</a>
			<a href="i../shopping.php?cat=3" class="whitebox categories">
				<div class="squareimg"><img src="img/cate/cate3.png"></div>
				<div>Party Games</div>
			</a>
			<a href="../shopping.php?cat=4" class="whitebox categories">
				<div class="squareimg"><img src="img/cate/cate4.png"></div>
				<div>Abstract Games</div>
			</a>
			<a href="../shopping.php?cat=5" class="whitebox categories">
				<div class="squareimg"><img src="img/cate/cate5.png"></div>
				<div>Thematic Games</div>
			</a>
		</div>
		<div></div>
		<div></div>
	</div>
	<div class="content topic">
		<div></div><div></div>
		<div class="seeall">
			<div>BEST SELLERS</div>
			<a href="../shop.php?cat=0">See All ></a>
		</div>
		<div></div><div></div>
	</div>
	<div class="content">
		<div></div>
		<div></div>
		<div class="five">
			<a href="index.html" class="whitebox product">
				<div class="squareimg red squareimground">
				</div>
				<div class="productname">Product Name</div>
				<div class="priceandstar">
					<div class="productprice">฿1000</div>
					<div class="productstar">
						<div class="productstarnumber">4.8</div>
						<img src="img/star.png">
					</div>
				</div>
			</a>
			<a href="index.html" class="whitebox product">
				<div class="squareimg red squareimground">
				</div>
				<div class="productname">Product Name</div>
				<div class="priceandstar">
					<div class="productprice">฿1000</div>
					<div class="productstar">
						<div class="productstarnumber">4.8</div>
						<img src="img/star.png">
					</div>
				</div>
			</a>
			<a href="index.html" class="whitebox product">
				<div class="squareimg red squareimground">
				</div>
				<div class="productname">Product Name</div>
				<div class="priceandstar">
					<div class="productprice">฿1000</div>
					<div class="productstar">
						<div class="productstarnumber">4.8</div>
						<img src="img/star.png">
					</div>
				</div>
			</a>
			<a href="index.html" class="whitebox product">
				<div class="squareimg red squareimground">
				</div>
				<div class="productname">Product Name</div>
				<div class="priceandstar">
					<div class="productprice">฿1000</div>
					<div class="productstar">
						<div class="productstarnumber">4.8</div>
						<img src="img/star.png">
					</div>
				</div>
			</a>
			<a href="index.html" class="whitebox product">
				<div class="squareimg red squareimground">
				</div>
				<div class="productname">Product Name</div>
				<div class="priceandstar">
					<div class="productprice">฿1000</div>
					<div class="productstar">
						<div class="productstarnumber">4.8</div>
						<img src="img/star.png">
					</div>
				</div>
			</a>
		</div>
		<div></div>
		<div></div>
	</div>

	<!--------------------------------------------------------------------------------------->

	<div id="footer">
		<div id="navbar_darkblue" class="darkblue"></div>
		<div id="navbar_blue_footer" class="blue"></div>
	</div>
	
	

</body>
</html>