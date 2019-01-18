<?php $thisPage='items'; ?>
<?php require_once('../partials/template.php') ?>
<?php function get_page_content(){ 
	global $conn?>

	<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles_id']==1) {?>
	
	<div class="container my">
		<div class="row">
			<a href="./add_item.php" class="btn btn-primary"> Add New Food</a>
		</div>

		<?php 
			$sql = "SELECT * FROM items";
			$items = mysqli_query($conn, $sql);

		 
		
			echo '<div class="row mb-5">';
			foreach($items as $item){
		 ?>
			<div class="col-sm-3 py-2">
				<div class="card">
					<img src="<?php echo $item['img_path'] ?>" class="card-img-top">
					<div class="card-body">
						<h4 class="card-title"> <?php echo $item['name']?> </h4>
						<p class="card-text"><?php echo $item['description']?></p>
						<p class="card-text"><?php echo $item['price']?></p>

						<input type="hidden" value="<?php echo $item['id'] ?>">
					</div><!-- end  of card body -->

					<div class="card-footer">
						<a href="./edit_item.php?id=<?php echo $item['id'] ?>" class="btn btn-primary">Edit Item</a>
						<a href="../controllers/delete_item.php?id=<?php echo $item['id'] ?>" class="btn btn-danger">Delete Item</a>
					</div>
				</div>
			</div> <!-- end cols -->
	<?php } ?>
		</div><!-- end row -->
	</div>
	<?php }else{ ?>

	<?php  
		header("location:./login.php");
	}?>
<?php } ?>