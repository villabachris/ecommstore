<?php 
	session_start();
	require_once('./connect.php');
	$id = $_GET['id'];
	
	$update_user_query = "SELECT roles_id FROM users WHERE id = $id";
	$user_to_edit = mysqli_query($conn, $update_user_query);
	$user = mysqli_fetch_assoc($user_to_edit); 
	if($user['roles_id'] == 2){
		$update_role_query="UPDATE users SET roles_id = 1 $roles_id WHERE id = $id";
	}else{
		$update_role_query="UPDATE users SET roles_id = 2 $roles_id WHERE id = $id";
	}
	
	$result=mysqli_query($conn, $update_role_query);
	if(!$result){
		echo mysqli_error($conn);
	}



//var_dump($update_role_query);
	header("Location:../views/users.php");
 ?>