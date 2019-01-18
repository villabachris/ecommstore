<?php require_once('../partials/template.php') ?>
<?php function get_page_content(){
	global $conn ?>
<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles_id']==1){ ?>
	<?php 
		$item_id = $_GET['id'];
		$sql = "SELECT * FROM items WHERE id = '$item_id'";
		$result =  mysqli_query($conn, $sql);
		$item = mysqli_fetch_assoc($result);
		//var_dump($result);
	 ?>

	 <div class="container">
	 	<div class="row">
 			<div class="col-sm-8 offset-sm-2">
		 		<form action="../controllers/process_edit_item.php" method="POST">
	 				<div class="form-group">
	 					<label for="name"> Name: </label>
	 					<input class="form-control" type="text" name="name" value=" <?php echo $item['name']?>">
	 				</div>
	 				<div class="form-group">
	 					<label for="description"> Description: </label>
	 					<textarea class="form-control" rows="5" type="text" name="description" value=" <?php echo $item['description']?>"></textarea>
	 				</div>
	 				<div class="form-group">
	 					<label for="price"> Price: </label>
	 					<input class="form-control" type="text" name="price" value=" <?php echo $item['price']?>">
	 				</div>
	 				<div class="form-group">
	 					<label for="categories">Category: </label>
	 					<select name="category_id" class="form-control" id="category" required>
	 						<?php 
	 							$sql = "SELECT * FROM categories";
	 							$categories= mysqli_query($conn, $sql);

	 							foreach ($categories as $category) {
	 								extract($category);
	 								//ternary operator
	 								$selected = $item['category_id'] == $id?'selected': '';
	 								echo "<option value='$id' $selected>$name</option>";

	 							}
	 						 ?>

	 					</select>

	 				</div>
	 				<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	 				<button type="submit" class="btn btn-primary">Update Changes</button>
		 		</form><!-- end edit form -->
 			</div> <!-- end cols -->
	 	</div><!-- end row -->
	 </div>
	  <?php }else{ ?>

	<?php  
		header("location:./error.php");
	}?>
<?php } ?>