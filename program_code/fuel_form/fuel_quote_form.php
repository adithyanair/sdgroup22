<?php include '../back_end/backend_fuel_quote_form.php';
      include '../back_end/backend_main.php';
      include '../back_end/backend_user_info.php'; ?>

<!DOCTYPE html>

<!--
<html>
    <head>
        <title> FUEL QUOTE FORM </title>
        <link rel="stylesheet" type="text/css" href="fuelform_style.css">
    </head>
	
	<div class="header">
		<h2>FUEL QUOTE FORM </h2>
	</div>

    <body>
        <form method="post" action="fuel_quote_form.php" >
        	<input type="number" step="any" class="form-control" placeholder="Number of Gallons Requested" name="gallon_req" min="0" onkeypress="return event.charCode != 45" required><br><br>
			
        	<input type="text" class="form-control" placeholder="Delivery Address" name="client_add1" readonly><br><br>

            <input type="text" class="form-control" placeholder="Delivery Date" name="del_date" onfocus="(this.type='date')" required><br><br>
            <input type="text" class="form-control" placeholder="Suggested Price Per Gallon" name="pricing_mod" readonly><br><br>

            <input type="text" class="form-control" placeholder="Total Amount Due" name="total" readonly><br><br>

        	<input type="submit" class="form-control submit" name="fuelform" value="Submit Quote">
		
			<a href='../main/index.php' style='color:#ffffff; font-size:17px; letter-spacing:1px; text-decoration:none; text-shadow:4px 4px 4px #000000; position:fixed; top:50px; right:100px;">'>Return to Main Menu</a>
			
			<p>Please fill this field: </p>
			
			<p2>Please fill this field: </p2>
        </form>
    </body>
</html>
-->

<html>
    <head>
        <title> FUEL QUOTE FORM </title>
        <link rel="stylesheet" type="text/css" href="fuelform_style.css">
    </head>
	
	<div class="header">
		<h2>FUEL QUOTE FORM </h2>
	</div>

    <body>
        <form method="post" action="fuel_quote_form.php" >
            <div class="container">
                <div class="d-flex">
                    <div class="inputinfo">
                        <label>
                            <span class="inputgallons">Gallons Requested: <span class="required">*</span></span>
                            <input type="number" step="any" class="form-control" placeholder="Please enter a number" name="gallon_req" min="0" onkeypress="return event.charCode != 45" required><br><br>
                        </label>
                        <label>
                            <span class="inputdate">Delivery Date: <span class="required">*</span></span>
                            <input type="text" class="form-control" placeholder="Please enter a date" name="del_date" onfocus="(this.type='date')" required><br><br>
                        </label>
                        <label>
                            <span>Delivering to: </span></span>
                            <p1> Address 1: </p1> <p2>1234 House street </p2><br>
                            <p1> Address 2: </p1> <p2> N/A </p2><br>
                            <p1> City: </p1> <p2>Houston </p2><br>
                            <p1> State: </p1> <p2>TX </p2><br>
                            <p1> Zip Code: </p1> <p2>77036 </p2><br>
                        </label>
                    </div>
                    <div class="orderinfo">
                        <table>
                            <tr>
                                <th colspan="2">Your Quote</th>
                            </tr>
                            <tr>
                                <td>Gallons Requested</td>
                                <td>1000.15</td>
                            </tr>
                            <tr>
                                <td>Price / Gallon</td>
                                <td>$1.50</td>
                            </tr>
                            <tr>
                                <td>Delivery Date</td>
                                <td>3/18/21</td>
                            </tr>
                            <tr>
                                <td>Total Amount Due</td>
                                <td>$1500.23</td>
                            </tr>
                        </table><br>

                        <input type="submit" class="order button" name="getquote" value="Get Quote"><br>
                        <input type="submit" class="order button" name="submitquote" value="Submit Quote">
                    </div>
                </div>
            </div>
        </form>

        <a href='../main/index.php' style='color:#ffffff; font-size:17px; letter-spacing:1px; text-decoration:none; text-shadow:4px 4px 4px #000000; position:fixed; top:50px; right:100px;">'>Return to Main Menu</a>

    </body>
</html>