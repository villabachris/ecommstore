<?php require_once'../partials/template.php'; ?>

<?php function get_page_content() { ?>
<?php require_once'../controllers/connect.php' ?>
	<div class="container-fluid px-0">
		<div class="row">
			<!-- categories -->
			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Categories</h3>
					</div>
					<div class="card-body">
						<ul class="list-group">
							<a href="catalog.php">
							<li class="list-group-item">All</li>
							</a>

							<?php
								global $conn;
								$sql= "SELECT * FROM categories";
								$categories= mysqli_query($conn, $sql);
								foreach($categories as $category){?>
									<a href="catalog.php?category_id=<?php echo $category['id'] ?>">
									<li class="list-group-item">
									<?php echo $category['name'];?>
									</li>
									</a>
							<?php }?>
						</ul>
					</div>
				</div> 
				<div class="card mb-5">
					<div class="card-header">
						<h3 class="text-center">Sort</h3>
					</div>
						<div class="card-body" id="card">
							<ul class="list-group">
								<a href="../controllers/sort.php?sort=ASC">
									<li class="list-group-item"><small>Price (Lowest to Highest)</small></li>
								</a>
								<a href="../controllers/sort.php?sort=DESC">
									<li class="list-group-item"><small>Price (Highest to Lowest)</small></li>
								</a>
							</ul>
						</div>
				</div>
			</div>

			<!-- items -->
			<div class="col-sm-10">
				<div class="container">
					<?php 
						global $conn;
						
						$sql = "SELECT * FROM items";

						if (isset($_GET['category_id'])) {
							
						}

						if (isset($_GET['category_id'])) {
							$sql.= " WHERE category_id=".$_GET['category_id'];
						}
							//display sorted prices
						if (isset($_SESSION['sort'])) {
							$sql.= $_SESSION['sort'];
						}
						
						$items=mysqli_query($conn,$sql);

						echo "<div class='row'>";

						foreach($items as $item) { ?>
									
							<div class="col-sm-3 mb-5">
								<div class="card my-auto shadow h-100">
									<img class="card-img-top img-fluid" id="img" src="<?php echo $item['img_path']?>">
								<div class="card-body">
									<div>
									 <h4 class="card-title"><?php echo $item['name']?></h4>
										<p class="card-text"><?php echo $item['description']; ?></p>
										<br>
									</div>
								</div>
								<div class="card-footer bg-secondary">
									<input type="number" class="form-control text-center" value="1">
									<button type="button" class="btn form-control add-to-cart" data-id="<?php echo $item['id']?>">+ add to cart</button>
								</div>
								<div class="card-footer bg-primary">
										<p class="card-text text-center text-light">
											<?php echo ' Php '.$item['price'] ?>
										</p>	
								</div>
								</div>
								</div>
							
						<?php } ?>
				</div>	
			</div>

		</div>
	</div>
<?php } ?>