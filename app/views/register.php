<?php require_once'../partials/template.php'?>
<?php function get_page_content(){
		global $conn?>
	<div class="jumbotron col-md-10 mx-auto mt-5 bg-primary">
		<h1 class="text-center text-light">Register</h1>
	</div>
	<div class="container">
		
	<form>
		<div class="row mb-5">
			<div class="col-md-6">
				<div class="form-group">
					<label for="fname">Firstname</label>
					<input type="text" name="firstname" id="fname" class="form-control" placeholder="Enter your firstname">
					<span class="validation"></span>
				</div>
				<div class="form-group">
					<label for="lname">Lastname</label>
					<input type="text" name="lastname" id="lname" class="form-control" placeholder="Enter your lastname">
					<span class="validation"></span>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
					<span class="validation"></span>
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" name="address" id="address" class="form-control" placeholder="Enter your address">
					<span class="validation"></span>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" placeholder="Enter your username">
					<span class="validation"></span>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
					<span class="validation"></span>
				</div>
				<div class="form-group">
					<label for="confirm">Confirm Password</label>
					<input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm your password">
					<span class="validation"></span>
				</div>
				
				
				</div>
				
			</div>
		</div>
	<div class="text-center py-4 mb-5">
		<a href="./login.php" class="btn btn-secondary"> Login </a>
		<button id="add_user" type="button" class="btn btn-primary">Register</button>
	</div>
	</form>




<?php } ?>
<!-- <div class="col-md-6">
				<div class="form-group">
					<label for="firstname">Firstname</label>
					<input type="text" name="firstname" id="fname" class="form-control">
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="firstname">Firstname</label>
					<input type="text" name="firstname" id="fname" class="form-control">
				</div>
			</div>	 -->