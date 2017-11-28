<?php

session_start();

include "db.php";
require_once 'admin/includes/database.php';
require_once 'admin/includes/functions.php';

$db = new database();

$category = $db->getID("cat_title=User's Choice", 'categories');

/*
$choice = "User Choice";
$category_query = "SELECT * FROM categories WHERE cat_title='User Choice'";
$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
*/

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Khim Design Studio</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/bootstrap.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<style>
			@media screen and (max-width:480px){
				#search{width:80%;}
				#search_btn{width:30%;float:right;margin-top:-32px;margin-right:10px;}
			}
		</style>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only"> navigation toggle</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="profile.php" class="navbar-brand">Khim Design Studio</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li>
				<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Proceed to Cart</a></li>
				<li><a href="portfolio.php"><span class="glyphicon glyphicon-image"></span>Portfolio</a></li>
				<li><a href="game.html"><span class="glyphicon glyphicon-fire"></span>Play game</a></li>
				<li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control" id="search"></li>
				<li style="top:10px;left:20px;"><button class="btn btn-primary" id="search_btn">Search</button></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			
				<li><a href="#" id="cart_container" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3 col-xs-3">Sl.No</div>
									<div class="col-md-3 col-xs-3">Product Image</div>
									<div class="col-md-3 col-xs-3">Product Name</div>
									<div class="col-md-3 col-xs-3">Price in $.</div>
								</div>
							</div>
							<div class="panel-body">
								<div id="cart_product">
								<!--<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in $.</div>
								</div>-->
								</div>
							</div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
				
				<?php if (isset($_SESSION['uid'])) { ?>
				
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Hi,".$_SESSION["name"]; ?></a>
					<ul class="dropdown-menu">
						<li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Cart</a></li>
						<li class="divider"></li>
						
						<li class="divider"></li>
						<li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
					</ul>
				</li>
					
				<?php } else { ?>

				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>SignIn</a>
					<ul class="dropdown-menu">
						<div style="width:300px;">
							<div class="panel panel-primary">
								<div class="panel-heading">Login</div>
								<div class="panel-heading">
									<form onsubmit="return false" id="login">
										<label for="email">Email</label>
										<input type="email" class="form-control" name="email" id="email" required/>
										<label for="email">Password</label>
										<input type="password" class="form-control" name="password" id="password" required/>
										<p><br/></p>
										<a href="#" style="color:white; list-style:none;">Forgotten Password</a><input type="submit" class="btn btn-success" style="float:right;">
									</form>
								</div>
								<div class="panel-footer" id="e_msg"></div>
							</div>
						</div>
					</ul>
				</li>

				<?php } ?>
				
			</ul>
		</div>
	</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5">
				<div class="panel">
					<div class="col-md-12">
						<div class="row">
						<p><strong>Please save your design in .jpg/jpeg format</strong></p>
							<iframe src="Drawing1/index.html" height="800px" width="750px"></iframe>
							</div>
						
						
					</div>
				</div>
			</div>
			<div class="col-md-6">	
				<div class="row">
					<?php Flash(); // display flash message ?>
					<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
				</div>
				<div class="panel panel-info" id="scroll" >
					<div class="panel-heading">Custom Design</div>
					<div class="panel-body">

						<?php if (isset($_SESSION['uid'])) { ?>

						<form class="col-md-10" action="addCustom.php" method="post" enctype="multipart/form-data">
		                    <h1>Add Custom Design</h1><br>
		                    <div class="form-group">
		                        <label>Product Name</label>
		                        <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" required="">
		                    </div>
		                    <div class="form-group">
		                        <label>Product Price</label>
		                        <div class="input-group">
		                        	<span class="input-group-addon">RM</span>
		                        	<input type="number" name="product_price" class="form-control" value="100" disabled="">
		                        </div>
		                        <small class="form-text text-muted">Price for Custom Design is fix</small>
		                    </div>
		                    <div class="form-group">
		                        <label>Product Description</label>
		                        <textarea name="product_desc" class="form-control" required=""></textarea>
		                    </div>
		                    <div class="form-group">
		                        <label>Product Category</label>
		                        <select name="product_cats" class="form-control" disabled="">
		                            
		                            <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?></option>
		                            
		                        </select>
		                    </div>

		                    <div class="form-group">
		                        <label>Product Keywords</label>
		                        <input type="text" name="product_keys" class="form-control" placeholder="Enter keywords for product" required="">
		                    </div>

		                    <div class="form-group">
		                        <label>Product Image</label>
		                        <input type="file" name="product_img" class="form-control" required="">
		                    <input type="hidden" name="product_cat" value="<?php echo $category['cat_id']; ?>">
		                    <input type="hidden" name="data" value="product">
		                    <button type="submit" class="btn btn-success" name="custom">Submit</button>
							<br>
							<p><strong>Please upload file in .jpg/jpeg file only</strong></p>

		                </form>
						<?php } else { ?>

						<h2>You Must be <a href="login_form.php" >Logged in</a> to add custom design.</h2>

						<h3>If you don't have an account yet, please <a href="customer_registration.php?register=1">register</a> here.</h3>

						<?php } ?>
					</div>
					<div class="panel-footer">&copy; Developed by Khim Design Studio</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<center>
					<ul class="pagination" id="pageno">
						<li><a href="#">1</a></li>
					</ul>
				</center>
			</div>
		</div>
	</div>
</body>
</html>