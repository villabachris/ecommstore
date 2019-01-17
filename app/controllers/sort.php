<?php 
	session_start();
	if (isset($_GET['sort'])) {
		if($_GET['sort']=='ASC'){
			$_SESSION['sort'] = " ORDER BY price ASC";
		}else{
			$_SESSION['sort'] = " ORDER BY price DESC";
		}
	}
	header('location:'.$_SERVER["HTTP_REFERER"]);
 ?>