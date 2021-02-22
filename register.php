<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login and register</title>
	<link rel="stylesheet" type="text/css" href="style_login_page.css">
</head>
<body>
	<div class="header">
		<h2>REGISTER A NEW ACCOUNT</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>


		<div class="input-group">
			<input type="text" class="form-control" placeholder="Enter desired username." name="employee_fname" ?>">
		</div>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Enter desired Password" name="employee_lname" ?>">
		</div>
		

		<div class="input-group">
			<button type="submit" class="form-control submit" name="reg_user">Register</button>
		</div>
		<p>
		 <a href="login.php">Return to the log in page</a>
		</p>
	</form>
</body>
</html>