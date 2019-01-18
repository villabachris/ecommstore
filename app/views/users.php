<?php require_once('../partials/template.php') ?>
<?php function get_page_content(){ ?>
	<?php 
		if(isset($_SESSION['user']) && $_SESSION['user']['roles_id']==1){
		global $conn;
	?>

	<div class="container my-5">
		<h4 class="text-center">User Admin Page</h4>
		<div class="row">
			<div class="col-sm-10 offset-sm-2">
				<table class="table table-responsive table-striped">
					<thead>
						<tr class="text-center">
							<th>Username</th>
							<th colspan="2">Firstname</th>
							<th colspan="2">Lastname</th>
							<th>Email</th>
							<th>Role</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$get_user_details_query = "SELECT u.id, u.username, u.firstname, u.lastname, u.email, r.name AS role FROM users u JOIN roles r ON (u.roles_id = r.id)"; 
						$user_details= mysqli_query($conn, $get_user_details_query);
						foreach ($user_details as $indiv_user) {
						($indiv_user);
							
						?><tr>
							
						<td><?php echo $indiv_user['username'];?></td>
						<td colspan="2"><?php echo $indiv_user['firstname'];?></td>
						<td colspan="2"><?php echo $indiv_user['lastname'];?></td>
						<td><?php echo $indiv_user['email'];?></td>
						<td ><?php echo $indiv_user['role'];?></td>
						<td colspan="2">
							<?php  
								$id = $indiv_user['id'];
								if($indiv_user['role'] == "admin"){
									echo "<a href='../controllers/grant_admin.php?id=$id' class='btn btn-danger'>Revoke Admin</a>";
								}else{
									echo "<a href='../controllers/grant_admin.php?id=$id' class='btn btn-primary'>Make Admin</a>";
								}
							?>
								
						</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


<?php }else{
	header("Location:./error.php");
	} 
	?>
<?php } ?>