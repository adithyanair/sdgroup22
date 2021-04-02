<?php include '../back_end/backend_main.php'; 
 //include '../back_end/backend_user_info.php'; ?>

<!DOCTYPE html>
<html>
	<head>
		<title> REGISTRATION </title>
		<link rel="stylesheet" type="text/css" href="style_login_page.css">
	</head>
	
	<body>
		<div class="header">
			<h2>REGISTER A NEW ACCOUNT</h2>
		</div>
		
		<form method="post" action="register.php">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Enter desired username" name="register_user" required>
				
			</div>
			<div class="input-group">
				<input type="password" class="form-control" placeholder="Enter desired password" name="register_password" required>
			</div>

			<div class="input-group">
				<button type="submit" class="form-control submit" name="reg_user">Register</button>
			</div>
			
			<p>
			<a href="login.php" style='color:#d9eaff; font-size:18px; letter-spacing:1px;">'>Return to Login</a>
			</p>
		</form>
	</body>
</html>