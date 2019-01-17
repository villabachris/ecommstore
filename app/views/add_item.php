<?php require_once('../partials/template.php')?>
<?php function get_page_content(){ 
	global $conn?>
	<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles_id']==1){ ?>
	<?php if (!isset($_SESSION['user'])){

		header("Location:./login.php");
	}
	 ?>
	<div class="container-fluid bg-primary"><h2 class="text-light text-center">🍲 Add Food</h2></div>
	<div class="container mb-5">
		<div class="row">
			<div class="col-sm-8 offset-sm-2">
				<form action="../controllers/process_add_item.php" method="POST" enctype="multipart/form-data" id="add_form">
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" name="name" id="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="price">Price:</label>
						<input type="number" name="price" id="name" min="1" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="description">Description:</label>
						<textarea class="form-control col-8" rows="5" id="description" name="description" ></textarea>
					</div>
					<div class="form-group">
						<label for="categories">🥄 Category:</label>
						<select class="form-control col-8" name="category" id="categories" required>
							<?php 

							$sql= "SELECT * FROM categories";
							$categories= mysqli_query($conn, $sql);
							foreach ($categories as $category ) {
								
								extract($category);
								echo"<option value='$id'>$name</option>";
							}
							 ?>
						 </select>
					</div>
					<div class="form-group">
						<label for="image">Image:</label>
						<input type="file" name="image" id="image" class="form-control-file" required>
					</div>
					<button type="submit" class="btn btn-block btn-primary" id="add_item">Add New Food</button>
				</form>
			</div>
		</div>
	</div>
	<?php }else{ ?>

	<?php  
		header("location:./error.php");
	}?>
<?php } ?>