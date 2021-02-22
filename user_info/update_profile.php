<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="user_style.css">
</head>
<body>
	<div class="header">
		<h2>ADD CLIENT INFO</h2>
        <h2>Complete setting up your profile</h2>
	</div>

	<form method="post" action="add_customer.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<input type="text" class="form-control" placeholder="Full Name" name="client_fname"required>
		</div>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Address 1" name="client_add1"required>
		</div>
		<div class="input-group">
            <!--- This is optional --->
			<input type="text" class="form-control" placeholder="Address 2" name="client_add2">
		</div>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="City" name="city"required>
		</div>

		<div class="input-group">
			<input type="text" class="form-control" placeholder="Zip Code" name="zipcode"required>
		</div> 

		<div class="input-group">
            <!--- This needs to be a dropdown
			<input type="text" class="form-control" placeholder="State" name="state">  
			This will be connected with DB for the list of states--->
			<select id = "state"> 
			<option class="form-control" placeholder="State">State</option>}  
 		    <option value="Alabama">AL</option>  
            <option value="Alaska">AK</option>  
            <option value="Arizona">AZ</option>  
            <option value="Arkansas">AR</option>  
            <option value="California">CA</option>  
            <option value="Colorado">CO</option>  
            <option value="Connecticut">CT</option>  
            <option value="Delaware">DE</option>  
			<select>  
		</div>


		
		<div class="input-group">
			<button type="submit" class="form-control submit" name="submit">Submit</button>
		</div>
		<p> <a href='../index.php' style='color: #050f63;'>back to home </a> </p>

	</form>
</body>
</html>
