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

	$id = $_SESSION['id'];

	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM $table2 WHERE userid='$id'";
	$products = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php while ($row = $products->fetch_assoc()){ ?>
	<div>
		<img src="../img/products/<?= $row['img'] ?>">
	</div>
<?php  } ?>
</body>
</html>

<div class="whitebox product">
			<a href="index.html">
				<div class="squareimg red squareimground">
					<img src="img/products/<?php echo $products['img'];  ?>">
				</div>
				<div class="productname"><?php echo $products['productname'];  ?></div>
				<div class="priceandstar">
					<div class="productprice">฿<?php echo $products['price'];  ?></div>
					<div class="productstar">
						<div class="productstarnumber">4.8</div>
						<img src="img/star.png">
					</div>
				</div>
			</a>
				<div class="editdel0">
				<div class="editdel">
					<a href="#editproduct_modal" data-toggle="modal">Edit</a>
					<div></div>
					<a href="#delete<?php echo $products['id'];  ?>" data-toggle="modal">Delete</a>
				</div>
				</div>
			</div>

			<div id="delete<?php echo $products['id'];  ?>" class="modal fade deletebox0">
      			<div class="modal-dialog modal-ld">
        		<div class="modal-content">
       			<div class="container">
            	<div class="row modal_title_row">
            		<div class="col-11 modal_title delete_title">Are you sure to delete this product?</div>
            		<div class="col-1 closebutton"><a href="#navbar" data-dismiss="modal">X</a></div>
				<div class="col-12 deletebox1">
				<div class="deletebox2 center">
					<a href="#editproduct_modal" data-toggle="modal">Yes</a>
					<div></div>
					<a href="#">No</a>
				</div>
				</div>
            	</div>		
        
            </div>
         </div>
  	</div>
  </div>

			<a href="#addproduct_modal" data-toggle="modal" class="whitebox product addproduct"><div>+</div></a>










<div id="addproduct_modal" class="modal fade">
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
					<input type="file" id="fileField" name="fileToUpload" value="fileToUpload" placeholder=""required>
					<div class="col-3"></div>
					<div id="errordisplay" class="col-12"></div>
					<input type="submit" class="col-12 signinbutton" name="submit" value="Add a Product">
				</form>
            </div>
         </div>
  	</div>
  </div>
			