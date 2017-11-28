<?php

session_start();

if(!isset($_SESSION["uid"]) OR $_SESSION['role'] != 'admin'){
	header("location:../../index.php");
}

require_once '../includes/database.php';
require_once '../includes/functions.php';

$db = new database();
$users = $db->read(array('*'), 'user_info');

$i = 1 // initialize count value

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

				<h1>System Users</h1><br>

                <table id="example" class="display table" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			            	<th> # </th>
			                <th>Name</th>
			                <th>E-mail</th>
			                <th>mobile</th>
			                <th>Address 1</th>
			                <th>Address 2</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($users as $user) { ?>
			            	<tr>
			            		<td><?php echo $i++; ?></th>
				                <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></th>
				                <td><?php echo $user['email']; ?></td>
				                <td><?php echo $user['mobile']; ?></td>
				                <td><?php echo $user['address1']; ?></td>
				                <td><?php echo $user['address2']; ?></td>
				                <td><a href="view.php?user_id=<?php echo $user['user_id']; ?>"><i class="btn btn-primary glyphicon glyphicon-eye-open"></i></a>
				                	<a href="../action.php?data=user&delete=<?php echo $user['user_id']; ?>"><i class="btn btn-danger glyphicon glyphicon-trash" onclick="return confirm('Are you sure?')"></i></a></td>
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
