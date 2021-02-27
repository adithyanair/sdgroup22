<!DOCTYPE html>

<html>

    <head>
        <title> FUEL QUOTE FORM </title>
        <link rel="stylesheet" type="text/css" href="fuelform_style.css">
    </head>
	
	<div class="header">
		<h2>FUEL QUOTE FORM </h2>
	</div>

    <body>
        <form method="post" action="../index.php" >
			
        	<input type="number" step="any" class="form-control" placeholder="Number of Gallons Requested" name="gallon_req" min="0" onkeypress="return event.charCode != 45" required><br><br>
			
			<!---this will be pulled later from DATABASE--->
        	<input type="text" class="form-control" placeholder="Delivery Address" name="client_add1" readonly><br><br>

            <input type="text" class="form-control" placeholder="Delivery Date" name="del_date" onfocus="(this.type='date')" required><br><br>
            <!---this will be calculated later from PRICING MODULE--->
            <input type="text" class="form-control" placeholder="Suggested Price Per Gallon" name="pricing_mod" readonly><br><br>

            <input type="text" class="form-control" placeholder="Total Amount Due" name="total" readonly><br><br>

        	<input type="submit" class="form-control submit" name="fuelform" value="Submit Form">
		
			<a href='../index.php' style='color:#ffffff; font-size:17px; letter-spacing:1px; text-decoration:none; text-shadow:4px 4px 4px #000000; position:fixed; top:50px; right:100px;">'>Return to Main Menu</a>
			
			<p>Please fill this field: </p>
			
			<p2>Please fill this field: </p2>
		
        </form>
    </body>

</html>