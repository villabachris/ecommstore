<?php 
	session_start();
	require_once('./connect.php');

	$id = $_GET['id'];

	$sql = "DELETE FROM items WHERE id = '$id'";
	mysqli_query($conn, $sql);

	header("Location:../views/items.php");
 ?>