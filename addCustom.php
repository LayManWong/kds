<?php

session_start();

include "db.php";
require_once 'admin/includes/database.php';
require_once 'admin/includes/functions.php';

var_dump($_POST);

$ip_add = getenv("REMOTE_ADDR");

$db = new database();
$error = 0;

$category_query = "SELECT brand_id FROM brands WHERE brand_title = 'Custom'";
$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));

$brand = mysqli_fetch_assoc($run_query);

extract($_POST);

echo "<pre>";
var_dump($_POST);
echo "</pre>";
echo $brand['brand_id'];

if (isset($_POST['custom'])) {

	if(!(strtoupper(substr($_FILES['product_img']['name'],-4))==".JPG" || strtoupper(substr($_FILES['product_img']['name'],-5))==".JPEG"|| strtoupper(substr($_FILES['product_img']['name'],-4))==".GIF" || strtoupper(substr($_FILES['product_img']['name'],-4))==".PNG")) {
		setFlash(array('Please upload image only'), 'fail');
		$error++;
	}
				
	if(file_exists("public/default/upload_images/".$_FILES['product_img']['name'])) {
		setFlash(array('Image with the same name already uploaded'), 'fail');
		$error++;
	}

	$url = 'custom.php';

	if ($error == 0) {
		if ($db->create(array(
			'product_cat' => $product_cat,
			'product_brand' => $brand['brand_id'],
			'product_title' => $product_name,
			'product_price' => '100',
			'product_desc' => $product_desc,
			'product_keywords' => $product_keys,
			'product_image' => $_FILES['product_img']['name']
			), 'products')) {

			// move uploaded image into folder(upload_images)
			move_uploaded_file($_FILES['product_img']['tmp_name'],"product_images/".$_FILES['product_img']['name']);
			$image_location = "product_images/".$_FILES['product_img']['name'];

			$p_id = $db->pdo->lastInsertId();
			$user_id = $_SESSION["uid"];

			$sql = "INSERT INTO `cart` (`p_id`, `ip_add`, `user_id`, `qty`) 
					VALUES ('$p_id','$ip_add','$user_id','1')";

					echo $p_id . $ip_add . $user_id;

			if(mysqli_query($con,$sql)){
				$url = 'cart.php';
				echo "success";
			}
		}
	}
}

header('location:' . $url);