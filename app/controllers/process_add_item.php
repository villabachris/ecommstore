<?php
	session_start(); 
	require_once('./connect.php');

	$name = $_POST['name'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$category_id = $_POST['category'];
	$image = '../assets/image'.$_FILES['image']['name'];//store img_path;
	move_uploaded_file($_FILES['image']['tmp_name'],"./".$image);

	$sql = "INSERT INTO items (name,description,price,img_path,category_id) VALUES('$name', '$description', '$price', '$image', '$category_id')";

	mysqli_query($conn, $sql);
	header('Location:../views/catalog.php');
 ?>