<?php

session_start();
if(!isset($_SESSION["uid"])){
	header("location:profile.php");
} elseif ($_SESSION['role'] == 'admin') {
	header("location:admin/users/all.php");
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Khim Design Studio</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
		<style></style>
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.php" class="navbar-brand">Khim Design Studio</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li>
				<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Proceed to Cart</a></li>
				<li><a href="portfolio1.php"><span class="glyphicon glyphicon-modal-picture"></span>Portfolio</a></li>
				<li><a href="game.html"><span class="glyphicon glyphicon-fire"></span>Play game</a></li>
				
			</ul>
			<form class="navbar-form navbar-left">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search" id="search">
		        </div>
		        <button type="submit" class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button>
		     </form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in $.</div>
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
						<li><a href="customer_registration.php?register=1"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
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
			<div class="col-md-1"></div>
			
			<div class="col-md-8 col-xs-12">
				<div class="row">
					<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
				</div>
				
					<div class="alert alert-info">
					  <strong>Need a custom design ?</strong> Check this <a href="custom.php">page</a> out.
					</div>
					<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book1</div>
					<div class='panel-body'>
						<img src='past_project/white-book1.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book2</div>
					<div class='panel-body'>
						<img src='past_project/white-book2.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book3</div>
					<div class='panel-body'>
						<img src='past_project/white-book3.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book4</div>
					<div class='panel-body'>
						<img src='past_project/white-book4.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book5</div>
					<div class='panel-body'>
						<img src='past_project/white-book5.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book6</div>
					<div class='panel-body'>
						<img src='past_project/white-book6.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book7</div>
					<div class='panel-body'>
						<img src='past_project/white-book7.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book8</div>
					<div class='panel-body'>
						<img src='past_project/white-book8.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book9</div>
					<div class='panel-body'>
						<img src='past_project/white-book9.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
			<div class='col-md-4'>
			<div class='panel panel-info'>
				<div class='panel-heading'>white-book10</div>
					<div class='panel-body'>
						<img src='past_project/white-book10.jpg' style='width:160px; height:250px;'/>
					</div>
				</div>
			</div>
					
				
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>
</html>
