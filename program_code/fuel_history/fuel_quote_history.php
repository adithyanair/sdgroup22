<?php include 'backend_fuel_quote_history.php';
      include '../main/backend_main.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title> FUEL QUOTE HISTORY </title>
        <link rel="stylesheet" type="text/css" href="fuelhistory_style.css">
    </head>

	<div class="header">
		<h1>Your Fuel Quote History </h1>
	</div>

  <!-- calls the fuel quote history table from the backend -->
  <?php echo tableBuilder($fuel_history); ?>
  
  <p> <a href='../main/index.php' style='color:#ffffff; font-size:17px; letter-spacing:1px; text-decoration:none; text-shadow:4px 4px 4px #000000; position:fixed; top:50px; right:100px;">'>Return to Main Menu</a> </p>

</html>
