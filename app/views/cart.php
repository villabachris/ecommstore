<?php require_once('../partials/template.php') ?>
<?php function get_page_content(){
	global $conn?>
	<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles_id']==2){ ?>
	<div class="container my-5">
		<div class="row">
			<div class="col-12">
				<h1> Cart Page </h1>
			</div>
		</div>
		<hr>
	</div>
	<div class="container">
		
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<thead>
				<th>Item Name</th>
				<th>Item Price</th>
				<th>Item Quantity</th>
				<th>Item Subtotal</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php
					
				 if(isset($_SESSION['cart']) && count($_SESSION['cart']) != 0){
					$cart_total=0;
					foreach ($_SESSION['cart'] as $id => $qty) {
						$sql="SELECT * FROM items WHERE id='$id'";

						$result= mysqli_query($conn, $sql);
						$item= mysqli_fetch_assoc($result);		
						$itemSubtotal= $_SESSION['cart'][$id] * $item['price'];
						$cart_total+= $itemSubtotal;
				 ?>
				 <tr>
				 	<td class="item_name"><?php echo $item['name']; ?></td>
				 	<td class="item_price "><?php echo $item['price']; ?></td>
				 	<td class="item_quantity">
				 		<input type="number" value="<?php echo $qty;?>" class="form-control " data-id="<?php echo $id;?>" min="1"></td>
				 	<td class="item_subtotal text-center"><?php echo $itemSubtotal ?></td>
				 	<td class="item_action text-center ">
				 		<button class="btn btn-danger item-remove center-block" data-id="<?php echo $id ?>">Remove from cart</button>
				 	</td>
				 </tr>
		<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					
					<td class="text=right font-weight-bold text-right" colspan="3">Total</td>
					<td class="text=right font-weight-bold text-center" id="total_price"><?php echo $cart_total; ?></td>
					<td></td>
				</tr>
					<td class="text-center" colspan="6">
						<a href="./checkout.php" class="btn btn-primary">Proceed to checkout</a>
					</td>
			</tfoot>
		<?php }else{
			echo "<tr>
					<td class='text-center' colspan='6'>No items in the cart</td>
				  </tr>";
		} ?>
		</table>
	</div>
	</div>
 <?php }else{ ?>

	<?php  
		header("location:./login.php");
	}?>
<?php } ?>