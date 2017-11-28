<?php

session_start();

if(!isset($_SESSION["uid"]) OR $_SESSION['role'] != 'admin'){
    header("location:../../index.php");
}

require_once '../includes/database.php';
require_once '../includes/functions.php';

$db = new database();
$products = $db->run('
    SELECT products.*, brands.brand_title, categories.cat_title FROM products
    INNER JOIN brands ON products.product_brand = brands.brand_id
    INNER JOIN categories ON products.product_cat = categories.cat_id
    ')->fetchAll();

$i = 1; // initialize count value

?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once '../includes/header.html'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once '../includes/sidebar.html'; ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">

                <?php Flash(); // display flash message ?>

                <h1>
                    Product List
                    <a href="add.php" class="btn btn-info pull-right">Add Product</a>
                </h1><br>
                
                <table id="example" class="display table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th width="110px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                        	<tr>
                                <td><?php echo $i++; ?></td>
            	                <td><?php echo $product['product_title']; ?></td>
            	                <td> RM <?php echo $product['product_price']; ?></td>
            	                <td><?php echo $product['product_desc']; ?></td>
            	                <td><?php echo $product['cat_title']; ?></td>
            	                <td><?php echo $product['brand_title']; ?></td>
            	                <td><a href=""><i class="btn btn-primary glyphicon glyphicon-eye-open"></i></a>
                                    <a href="update.php?id=<?php echo $product['product_id']; ?>"><i class="btn btn-success glyphicon glyphicon-edit"></i></a>
            	                	<a href="../action.php?data=product&delete=<?php echo $product['product_id']; ?>&filename=<?php echo $product['product_image']; ?>"><i class="btn btn-danger glyphicon glyphicon-trash" onclick="return confirm('Are you sure?')"></i></a></td>
            	            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php require_once '../includes/footer.html'; ?>

</body>

</html>
