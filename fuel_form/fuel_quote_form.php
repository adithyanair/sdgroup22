<!DOCTYPE html>

<html>

    <head>

        <title> FUEL QUOTE FORM </title>
        <link rel="stylesheet" type="text/css" href="fuelform_style.css">

    </head>
	<div class="header">
		<h2>FUEL QUOTE FORM </h2>
	</div>
	<div class="content">


    <body>

        <form action="fuel_quote_form.php" method="post">
			
        	<input type="number" step="any" class="form-control" placeholder="Number of Gallons Requested" name="gallon_req" required><br><br>
			
			<!---this will be pulled later from DATABASE--->
        	<input type="text" class="form-control" placeholder="Delivery Address" name="client_add1" readonly><br><br>

            <input type="date" class="form-control" placeholder="Delivery Date" name="del_date"><br><br>
            <!---this will be calculated later from PRICING MODULE--->
            <input type="text" class="form-control" placeholder="Suggested Price Per Gallon" name="pricing_mod" readonly><br><br>

            <input type="text" class="form-control" placeholder="Total Amount Due" name="total" readonly><br><br>

        	<input type="submit" class="form-control submit" name="fuelform" value="Submit Form">
		
		<a href='../index.php' style='color:#ffffff; font-size:17px; letter-spacing:2px; position:fixed; top:50px; right:100px;">'>Return to Main Menu</a>
		
		
		<p>Please fill this field: </p>
		

        </form>

    </body>


</html>