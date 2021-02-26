<?php 
/* WILL USE FOR LATER ASSIGNMENTS
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login/login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login/login.php");
	}
*/
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
	    <!-- WILL USE FOR LATER ASSIGNMENTS -->
		<!-- notification message -->
		<?php //if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php /*
						echo $_SESSION['success']; 
						unset($_SESSION['success']);*/
					?>
				</h3>
			</div>
		<?php //endif ?>
		
		<!-- logged in user information -->
		<?php // if (isset($_SESSION['username'])) : ?>
		<p> <p> <font color = white> Welcome! Please select a service: <strong><?php //echo $_SESSION['username']; ?></strong></p>
		<!-- <p> <a href="index.php?logout='1'" style='color:#ffffff; font-size:17px; letter-spacing:1px; text-decoration:none; text-shadow:4px 4px 4px #000000; position:fixed; top:50px; right:100px;">LOGOUT</a> </p>	-->
		
		<!-- REMOVE ME AFTER ASSIGNMENT 2 -->
		<p> <a href="login.php" style='color:#ffffff; font-size:17px; letter-spacing:1px; text-decoration:none; text-shadow:4px 4px 4px #000000; position:fixed; top:50px; right:100px;">'>LOGOUT</a> </p>	
        
		<button class ="ins_btn" onclick="window.location.href = 'user_info/update_profile.php';">Complete User Profile</button>
		<button class ="ins_btn" onclick="window.location.href = 'fuel_form/fuel_quote_form.php';">Fuel Quote Form</button>
		<button class ="ins_btn" onclick="window.location.href = 'fuel_history/fuel_quote_history.php';">Fuel Quote History</button>
		<?php endif ?>
		</form> 		
	</div>
		
</body>
</html>