<?php include('server.php') ?>

<!DOCTYPE html>
<html>
	<head>
		<title> LOGIN </title>
		<link rel="stylesheet" type="text/css" href="style_login_page.css">
	</head>
	
	<body>
		<div class="header">
			<h1>Welcome to the A.S.T. Fuel Company!</h1>
			<h2>Please Login below to access our services...</h2>
		</div>
		
		<form method="post" action="login.php">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Username" name="username" required>
			</div>
			<div class="input-group">
				<input type="password" class="form-control" placeholder="Password" name="password" required>
			</div>
			<div class="input-group">
				<button type="submit" class="form-control submit" name="login_user">Login</button>
			</div>
				<a href="register.php" style='color:#d9eaff; font-size:18px; letter-spacing:1px; margin-top: 2px;">'>Don't have an account? Register Here</a>
		</form>
	</body>
</html>