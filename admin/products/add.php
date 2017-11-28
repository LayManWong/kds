<?php

session_start();

if(!isset($_SESSION["uid"]) OR $_SESSION['role'] != 'admin'){
    header("location:../../index.php");
}

require_once '../includes/database.php';
require_once '../includes/functions.php';

$db = new database();
$categories = $db->read(array('*'), 'categories');
$brands = $db->read(array('*'), 'brands');

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

                <form class="col-md-6" action="../action.php" method="post" enctype="multipart/form-data">
                    <h1>Add New Product</h1><br>
                    <div class="form-group">
                        <label>New Product Name</label>
                        <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" required="">
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <div class="input-group">
                            <span class="input-group-addon">RM</span>
                            <input type="number" name="product_price" class="form-control" placeholder="Enter Product Price in RM" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="product_desc" class="form-control" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <label>Product Category</label>
                        <select name="product_cat" class="form-control">

                            <?php foreach ($categories as $category) { ?>
                            
                            <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?></option>

                            <?php } ?>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Brand</label>
                        <select name="product_brand" class="form-control">

                            <?php foreach ($brands as $brand) { ?>
                            
                            <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_title']; ?></option>

                            <?php } ?>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Product Keywords</label>
                        <input type="text" name="product_keys" class="form-control" placeholder="Enter keywords for product" required="">
                    </div>

                    <div class="form-group">
                        <label>Product Image</label>
                        <input type="file" name="product_img" class="form-control" required="">
                    </div>

                    <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a>

                    <input type="hidden" name="data" value="product">

                    <button type="submit" class="btn btn-success" name="add">Submit</button>

                </form>
                
                
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php require_once '../includes/footer.html'; ?>

</body>

</html>
