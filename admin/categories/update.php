<?php

session_start();

if(!isset($_SESSION["uid"]) OR $_SESSION['role'] != 'admin'){
    header("location:../../index.php");
}

require_once '../includes/database.php';
require_once '../includes/functions.php';

$id = $_GET['id'];

$db = new database();
$category = $db->getID('cat_id=' . $id, 'categories');

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

                <form class="col-md-6" action="../action.php" method="post">
                    <h1>Edit Category</h1><br>
                    <div class="form-group">
                        <label>New Category Name</label>
                        <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name" value="<?php echo $category['cat_title']; ?>">
                    </div>

                    <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Toggle Menu</a>

                    <input type="hidden" name="data" value="category">
                    <input type="hidden" name="id" value="<?php echo $category['cat_id']; ?>">

                    <button type="submit" class="btn btn-success" name="update">Submit</button>

                </form>
                
                
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php require_once '../includes/footer.html'; ?>

</body>

</html>
