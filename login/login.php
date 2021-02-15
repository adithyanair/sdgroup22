<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login and Register</title>
	<link rel="stylesheet" type="text/css" href="style_login_page.css">
</head>
<body>

	<div class="header">
		<h2>Hello! Welcome to the Fuel Rate Predictor!</h2>
		<h2>LOGIN PAGE</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<input type="text" class="form-control" placeholder="Username" name="username" >
		</div>
		<div class="input-group">
			<input type="password" class="form-control" placeholder="Password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="form-control submit" name="login_user">Login</button>
		</div>
		<p>
			<a href="register.php">Don't have an account? Register here</a>
		</p>
	</form>


</body>
</html>