<?php 
	session_start(); 

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title> MAIN MENU </title>
		<link rel="stylesheet" type="text/css" href="style_index.css">
	</head>
	
	<body>
		<div class="header">
			<h2>A.S.T. MAIN SERVICES MENU</h2>
		</div>
		<div class="content">		
			<!-- logged in user information -->
			<?php  if (isset($_SESSION['username'])) : ?>
			<p> <font color = white> Welcome <strong><?php echo $_SESSION['username']; ?></strong>! Please select a service:</p>
			<p> <a href="index.php?logout='1'" style='color:#ffffff; font-size:17px; letter-spacing:1px; text-decoration:none; text-shadow:4px 4px 4px #000000; position:fixed; top:50px; right:100px;">'>Logout</a> </p>
			
			<button class ="ins_btn" onclick="window.location.href = '../user_info/update_profile.php';">Update User Profile</button>
			<button class ="ins_btn" onclick="window.location.href = '../fuel_form/fuel_quote_form.php';">Get a Fuel Quote</button>
			<button class ="ins_btn" onclick="window.location.href = '../fuel_history/fuel_quote_history.php';">View Your Quote History</button>
			<?php endif ?>
			</form> 		
		</div>
			
		

	</body>
</html>