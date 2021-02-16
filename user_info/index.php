<?php 
	session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="user_style.css">
</head>
<body>
	<div class="header">
		<h2> Back to Home </h2>
	</div>
	<div class="content">
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

</body>
</html>