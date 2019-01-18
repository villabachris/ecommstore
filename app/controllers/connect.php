<?php 
$host= 'db4free.net';
$username= 'chris_villaba';
$password= 'thoperio1990';
$dbname= 'ecommstore';
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
	die('Connection failed: '. mysqli_error($conn));
}
	/*echo "connected success";*/

 ?>