<?php

session_start();

if(!isset($_SESSION["uid"]) OR $_SESSION['role'] != 'admin'){
    header("location:../../index.php");
}

require_once '../includes/database.php';
require_once '../includes/functions.php';

$id = $_GET['id'];

$db = new database();
$product = $db->run('
    SELECT products.*, brands.brand_title, categories.cat_title FROM products
    INNER JOIN brands ON products.product_brand = brands.brand_id
    INNER JOIN categories ON products.product_cat = categories.cat_id
    WHERE products.product_id = ' . $id . '
    ')->fetchAll();

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

                <form class="col-md-6" action="../action.php" method="post"  enctype="multipart/form-data">
                    <h1>Add New Product</h1><br>
                    <div class="form-group">
                        <label>New Product Name</label>
                        <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" value="<?php echo $product[0]['product_title']; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="number" name="product_price" class="form-control" placeholder="Enter Product Price in RM" value="<?php echo $product[0]['product_price']; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="product_desc" class="form-control" required=""><?php echo $product[0]['product_desc']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Product Category</label>
                        <select name="product_cat" class="form-control">
                            <option value="<?php echo $product[0]['product_cat']; ?>" selected><?php echo $product[0]['cat_title']; ?></option>

                            <?php foreach ($categories as $category) { ?>
                            
                            <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?></option>

                            <?php } ?>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Brand</label>
                        <select name="product_brand" class="form-control">
                            <option value="<?php echo $product[0]['product_brand']; ?>"><?php echo $product[0]['brand_title']; ?></option>

                            <?php foreach ($brands as $brand) { ?>
                            
                            <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_title']; ?></option>

                            <?php } ?>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Product Keywords</label>
                        <input type="text" name="product_keys" class="form-control" placeholder="Enter keywords for product" value="<?php echo $product[0]['product_keywords']; ?>" required="">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-offset-1">
                                <label>Product Image</label>
                                <input type="file" name="product_img" class="form-control" required="">

                                <input type="hidden" name="oldFilename" value="<?php echo $product[0]['product_image']; ?>">
                                <input type="hidden" name="data" value="product">
                                <input type="hidden" name="id" value="<?php echo $id; ?>"> <br>

                                <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a> 
                                <button type="submit" class="btn btn-success" name="update">Submit</button>
                            </div>
                            <div class="col-lg-5">
                                <label>Current Image : </label><br>
                                <img src="../../product_images/<?php echo $product[0]['product_image']; ?>" style='width:160px; height:250px;'> <br>
                            </div>
                        </div>
                    </div>

                </form>
                
                
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php require_once '../includes/footer.html'; ?>

</body>

</html>
