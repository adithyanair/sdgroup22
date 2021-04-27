<?php 
      include '../back_end/backend_fuel_quote_form.php';
      //include '../main/index.php';
      //include '../back_end/backend_main.php';
      //include '../back_end/backend_user_info.php'; ?>

<!DOCTYPE html>

<html>
    <!-- Check if user has setup their profile first -->
    <?php isProfileComplete($db,$user); ?>

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
                            <!-- calls the user's address from the backend -->
                            <p> <?php echo fetchAddress($db,$user); ?></p>
                        </label>
                    </div>
                    <div class="orderinfo">
                        <table>
                            <tr>
                                <th colspan="2">Your Quote</th>
                            </tr>
                            <tr>
                                <td>Gallons Requested</td>
                                <td>15</td>
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