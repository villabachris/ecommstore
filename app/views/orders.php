<?php require_once '../partials/template.php'?>
<?php function get_page_content(){
	global $conn ?>
	<?php 
		if(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1){

		}
	 ?>

	 	<div class="container">
	 		<h4>Orders Admin Page</h4>
	 		<div class="row">
	 			<div class="col-sm-8 offset-sm-2">
	 				<table class="table table-responsive table-striped">
	 					
	 				<thead>
	 					<th>Transaction Code</th>
	 					<th>Status</th>
	 					<th>Actions</th>
	 				</thead>

	 				<tbody>
	 					<?php 
	 						$orders_query = "SELECT o.id, o.transaction_code, o.status_id, s.name AS status FROM orders o JOIN statuses s ON (o.status_id = s.id) ORDER BY user_id DESC";
	 						$orders= mysqli_query($conn, $orders_query);
	 						foreach($orders as $order){
	 							//var_dump($order);
	 					 ?>
	 					 <tr>
	 					 	<td><?php echo $order['transaction_code']?></td>
	 					 	<td><?php echo $order['status']?></td>
	 					 	<td>
	 					 		<?php if($order['status'] == "pending"){?>
	 					 			<a href="../controllers/complete_order.php?id=<?php echo $order['id'] ?>" class="btn btn-success">Complete Order</a>
		 					 		<a href="../controllers/cancel_order.php?id=<?php echo $order['id'] ?>" class="btn btn-danger">Cancel Order</a>
	 					 		<?php } ?>

	 					 		
	 					 		
	 					 	</td>
	 					 </tr>
	 					<?php } ?>
	 				</tbody>
	 				</table>
	 			</div>
	 		 </div>
	 	</div>

<?php } ?>