<?php

session_start();

require_once 'includes/database.php'; // require database library
require_once 'includes/functions.php';

extract($_POST);
extract($_GET); // extract $_GET into var

$db = new database(); // initialize database object

if (isset($_POST['add'])) {
	
	switch ($data) {
		case 'product':
			$url = 'products/add.php';

			if(!(strtoupper(substr($_FILES['product_img']['name'],-4))==".JPG" || strtoupper(substr($_FILES['product_img']['name'],-5))==".JPEG"|| strtoupper(substr($_FILES['product_img']['name'],-4))==".GIF" || strtoupper(substr($_FILES['product_img']['name'],-4))==".PNG")) {
				setFlash(array('Please upload image only'), 'fail');
				break;
			}
				
			if(file_exists("public/default/upload_images/".$_FILES['product_img']['name'])) {
				setFlash(array('Image with the same name already uploaded'), 'fail');
				break;
			}

			$url = 'products/all.php';

			if ($db->create(array(
				'product_cat' => $product_cat,
				'product_brand' => $product_brand,
				'product_title' => $product_name,
				'product_price' => $product_price,
				'product_desc' => $product_desc,
				'product_keywords' => $product_keys,
				'product_image' => $_FILES['product_img']['name']
				), 'products')) {

				var_dump($_FILES);

				// move uploaded image into folder(upload_images)
				if (move_uploaded_file($_FILES['product_img']['tmp_name'],"../product_images/".$_FILES['product_img']['name'])) {
					
					$image_location = "../product_images/".$_FILES['product_img']['name'];

					setFlash(array('Product has been added'), 'success');
					break;
				}

				setFlash(array('Image upload fail. Please try again'), 'fail');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;

		case 'category':
			$url = 'categories/all.php';
			if ($db->create(array('cat_title' => $category_name), 'categories')) {

				setFlash(array('Category has been added'), 'success');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;

		case 'brand':
			$url = 'brands/all.php';
			if ($db->create(array('brand_title' => $brand_name), 'brands')) {

				setFlash(array('Brand has been added'), 'success');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;
		
		default:
			# code...
			break;
	}
}

if (isset($_POST['update'])) {
	
	switch ($data) {
		case 'product':
			$url = 'products/all.php';
			if ($db->update(array(
				'product_cat' => $product_cat,
				'product_brand' => $product_brand,
				'product_title' => $product_name,
				'product_price' => $product_price,
				'product_desc' => $product_desc,
				'product_keywords' => $product_keys,
				'product_image' => $_FILES['product_img']['name']
				), 'product_id=' . $id, 'products')) {
				
				// move uploaded image into folder(upload_images)
				if (move_uploaded_file($_FILES['product_img']['tmp_name'],"../product_images/".$_FILES['product_img']['name'])) {
					
					$image_location = "../product_images/".$_FILES['product_img']['name'];

					$filepath = '../product_images/' . $oldFilename;
					if (file_exists($filepath)) {
				    	unlink($filepath);
				    	echo $filepath;
				    	var_dump($_POST);
				    }

					setFlash(array('Product has been updated'), 'success');
					break;
				}

				setFlash(array('Image upload fail'), 'fail');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;

		case 'category':
			$url = 'categories/all.php';
			if ($db->update(array('cat_title' => $category_name), 'cat_id=' . $id, 'categories')) {

				setFlash(array('Category has been updated'), 'success');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;

		case 'brand':
			$url = 'brands/all.php';
			echo $brand_name;
			if ($db->update(array('brand_title' => $brand_name), 'brand_id=' . $id, 'brands')) {

				setFlash(array('Brand has been updated'), 'success');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;
		
		default:
			# code...
			break;
	}
}


if (isset($_GET['delete'])) {
	
	switch ($data) {
		case 'user':
			$url = 'users/all.php';
			if ($db->delete('user_id=' . $delete, 'user_info')) {

				setFlash(array('User has been deleted'), 'success');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;

		case 'product':
			$url = 'products/all.php';
			$filepath = '../product_images/' . $filename;
			if ($db->delete('product_id=' . $delete, 'products')) {
				if (file_exists($filepath)) {
			    	unlink($filepath);
			    }

				setFlash(array('Product has been deleted'), 'success');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;

		case 'category':
			$url = 'categories/all.php';
			if ($db->delete('cat_id=' . $delete, 'categories')) {

				setFlash(array('Category has been deleted'), 'success');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;

		case 'brand':
			$url = 'brands/all.php';
			if ($db->delete('brand_id=' . $delete, 'brands')) {

				setFlash(array('Brand has been deleted'), 'success');
				break;
			}
			setFlash(array('an error occured. Please try again'), 'fail');
			break;
		
		default:
			# code...
			break;
	}
}

redirect($url);