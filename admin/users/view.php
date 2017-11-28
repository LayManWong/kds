<?php

session_start();

if(!isset($_SESSION["uid"]) OR $_SESSION['role'] != 'admin'){
	header("location:../../index.php");
}

require_once '../includes/database.php';
require_once '../includes/functions.php';

$user_id = $_GET['user_id'];

$db = new database();
$user = $db->getID('user_id=' . $user_id, 'user_info');

$products = $db->run('
    SELECT products.*, brands.brand_title, categories.cat_title FROM products
    INNER JOIN brands ON products.product_brand = brands.brand_id
    INNER JOIN categories ON products.product_cat = categories.cat_id
    ')->fetchAll();

$orders = $db->run('
	SELECT products.product_title, brands.brand_title, orders.qty FROM orders
	INNER JOIN user_info ON orders.user_id = user_info.user_id
	INNER JOIN products ON orders.product_id = products.product_id
	INNER JOIN brands ON products.product_brand = brands.brand_id
	WHERE user_info.user_id = ' . $user["user_id"] . '
	')->fetchAll();

$i = 1 // initialize count value

?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once '../includes/header.html'; ?>

</head>
<style type="text/css">
	.card {
		position: relative;
	    display: -webkit-box;
	    display: -webkit-flex;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-orient: vertical;
	    -webkit-box-direction: normal;
	    -webkit-flex-direction: column;
	    -ms-flex-direction: column;
	    flex-direction: column;
	    background-color: #fff;
	    border: 1px solid rgba(0,0,0,.125);
	    border-radius: .25rem;
	}

	.card-block {
		-webkit-box-flex: 1;
	    -webkit-flex: 1 1 auto;
	    -ms-flex: 1 1 auto;
	    flex: 1 1 auto;
	    padding: 1.25rem;
	}

	.card-header {
		padding: .75rem 1.25rem;
	    margin-bottom: 0;
	    background-color: #f7f7f9;
	    border-bottom: 1px solid rgba(0,0,0,.125);
	}

	.details {
		width: 100%;
	}

	.details th, td {
		height: 40px;
	}
</style>
<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once '../includes/sidebar.html'; ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">

				<?php Flash(); // display flash message ?>

                <div class="card col-md-6">
				  <div class="card-block">
				    <h1 class="card-title">User Details</h1>
				    <hr>

				    	<p>First Name : <?php echo $user['first_name']; ?></p>
				    	<p>Last Name : <?php echo $user['last_name']; ?></p>
				    	<p>E-mail : <?php echo $user['email']; ?></p>
				    	<p>Mobile : <?php echo $user['mobile']; ?></p>
				    	<p>Address 1 : <?php echo $user['address1']; ?></p>
				    	<p>Address 2 : <?php echo $user['address2']; ?></p>
				  </div>
				</div>
				<div class="card col-md-6">
				  <div class="card-block">
				    <h1 class="card-title">Orders</h1>
				    <hr>
					<table id="example" class="display table" cellspacing="0" width="100%">
				        <thead>
				            <tr>
				            	<th> # </th>
				                <th>Product</th>
				                <th>Brand</th>
				                <th>Quantity</th>
				            </tr>
				        </thead>
				        <tbody>
				            <?php foreach ($orders as $order) { ?>
				            	<tr>
				            		<td><?php echo $i++; ?></th>
					                <td><?php echo $order['product_title']; ?></td>
					                <td><?php echo $order['brand_title']; ?></td>
					                <td><?php echo $order['qty']; ?></td>
					            </tr>
				            <?php } ?>
				        </tbody>
				    </table>
				  </div>
				</div>
                <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php require_once '../includes/footer.html'; ?>

</body>

</html>
