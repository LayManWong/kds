<?php

session_start();

if(!isset($_SESSION["uid"]) OR $_SESSION['role'] != 'admin'){
    header("location:../../index.php");
}

require_once '../includes/database.php';
require_once '../includes/functions.php';

$db = new database();
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

                <h1>
                    Product Brands
                    <a href="add.php" class="btn btn-info pull-right">Add Brand</a>
                </h1><br>
                
                <table id="example" class="display table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th>Brand Title</th>
                            <th width="80px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($brands as $brand) { ?>
                        	<tr>
                                <td><?php echo $i++; ?></td>
            	                <td><?php echo $brand['brand_title']; ?></td>
            	                <td><a href="update.php?id=<?php echo $brand['brand_id']; ?>"><i class="btn btn-success glyphicon glyphicon-edit"></i></a>
            	                	<a href="../action.php?data=brand&delete=<?php echo $brand['brand_id']; ?>"><i class="btn btn-danger glyphicon glyphicon-trash" onclick="return confirm('Are you sure?')"></i></a></th>
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
