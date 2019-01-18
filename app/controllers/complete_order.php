<?php 
session_start();
require_once('./connect.php');
$id = $_GET['id'];


$sql = "UPDATE orders SET status_id = 2 WHERE orders.id = $id";
mysqli_query($conn, $sql);

//var_dump($sql);
header("location:../views/orders.php");
?>
