<?php require_once'../partials/template.php'; ?>
<?php function get_page_content(){ ?>
	<div class="card col-md-6 mx-auto my-5">
	<div class="container">
		<div class="jumbotron bg-dark text-light text-center mt-2">
			<h4>Login</h4>
		</div>
	</div>
		
	<form>
		<div class="form-group">
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" class="form-control">
			<span class="validation"></span>
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" class="form-control">
			<span class="validation"></span>
		</div>
		<div class="text-center py-4">
			<a href="./register.php">Register</a>
			<button type="button" class="btn btn-primary" id="login">Login</button>
		</div>
	</form>
	</div>
<?php } ?>