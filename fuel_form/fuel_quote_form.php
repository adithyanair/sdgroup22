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

        	<input type="text" class="form-control" placeholder="Gallon Requested" name="gallon_req" required><br><br>

        	<input type="text" class="form-control" placeholder="Delivery Address" name="client_add1"><br><br>

            <input type="date" class="form-control" placeholder="Delivery Date" name="del_date"><br><br>
            <!---this will be calculated later PRICING MODULE--->
            <input type="text" class="form-control" placeholder="Suggested Price" name="pricing_mod" required><br><br>

            <input type="text" class="form-control" placeholder="Total Amount Due" name="total" required><br><br>

        	<input type="submit" class="form-control submit" name="fuelform" value="Submit Form">
		
		<p> <a href='../index.php' style='color:#050f63;'>return to home</a> </p>

        </form>

    </body>


</html>
