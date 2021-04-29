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
        <form id ="my_form" method="post" action>
            <div class="container">
                <div class="d-flex">
                    <div class="inputinfo">
                        <label>
                            <span class="inputgallons">Gallons Requested: <span class="required">*</span></span>
                            <input type="number" step="any" class="form-control" placeholder="Please enter a number" id="id_gr" name="gallon_req" min="0" onkeypress="return event.charCode != 45" required><br><br>
                        </label>
                        <label>
                            <span class="inputdate">Delivery Date: <span class="required">*</span></span>
                            <input type="text" class="form-control" placeholder="Please enter a date" id="id_dd" name="del_date" onfocus="(this.type='date')" required><br><br>
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
                                <td>Delivery Date</td>
                                <td id='d_date'>N/A</td>
                            </tr>
                            <tr>
                                <td>Gallons Requested</td>
                                <td id='gal_r'>0</td>
                            </tr>
                            <tr>
                                <td>Price / Gallon</td>
                                <td id='ppg'>$0.00</td>
                            </tr>
                            <tr>
                                <td>Total Amount Due</td>
                                <td id='total'>$0.00</td>
                            </tr>
                        </table><br>

                        <input type="submit" class="order button" id="id_getquote" name="getquote" value="Get Quote"> <br>
                        <input type="submit" class="order button" id="id_submitquote" name="submitquote" value="Submit Quote" >
                        
                        
                        <script>
                        function s(){
                        var i=document.getElementById("gallon_req");
                        var j=document.getElementById("del_date");
                        if(i.value=="" || j.value=="")
                        {
                            document.getElementById("getquote").disabled=true;
                            document.getElementById("submitquote").disabled=true;
                            document.getElementById("getquote").class = "order buttonnn";
                        }
                        else
                        {
                            document.getElementById("getquote").disabled=false;
                            document.getElementById("submitquote").disabled=false;
                        }
                        </script>

                    </div>
                </div>
            </div>
        </form>

        <a href='../main/index.php' style='color:#ffffff; font-size:17px; letter-spacing:1px; text-decoration:none; text-shadow:4px 4px 4px #000000; position:fixed; top:50px; right:100px;">'>Return to Main Menu</a>

        <!-- Script -->
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script>
        $(document).ready(function(){
            $('#my_form').validate({
                showErrors: function(errorMap, errorList) {
                    // Do nothing here
                },
                rules: {
                    gallon_req: {
                        required: true,
                        number: true,
                        minlength: 0
                    },
                    del_date: {
                        required: true,
                    }
                },
                submitHandler: function(form) {
                    var isQuote = false;
                    //behavior for get quote button
                    $('#id_getquote').click(function(){
                        var submit_gallon_req = document.getElementById("id_gr").value;
                        var submit_del_date = document.getElementById("id_dd").value;
                            //ajax call to get data from backend
                            jQuery.ajax({
                                type: 'POST',
                                url: "../back_end/backend_fuel_quote_form.php",
                                data: {getquote: 1, gallon_req:submit_gallon_req, del_date:submit_del_date},
                                success: function(price){
                                    //updates fields in webpage
                                    $('#gal_r').text(submit_gallon_req);
                                    $('#d_date').text(submit_del_date);
                                    $('#ppg').text('$' + price);
                                    $('#total').text('$' + price);    //FIX TOTAL VALUE TUPLE?
                                },
                                error: function(){
                                    $('#ppg').text('There is an error in getting quote.');
                                }
                            });
                            isQuote = true;
                    });
                    //behavior for submit quote button
                    $('#id_submitquote').click(function(){
                        var submit_gallon_req = document.getElementById("id_gr").value;
                        var submit_del_date = document.getElementById("id_dd").value;
                        if (isQuote == true) {                              //FIX REGET QUOTE  if new values != old values, fail 
                            //ajax call to get data from backend            //FIX MULTIREQUESTS
                            jQuery.ajax({
                                type: 'POST',
                                url: "../back_end/backend_fuel_quote_form.php",
                                data: {submitquote: 1, gallon_req:submit_gallon_req, del_date:submit_del_date},
                                success: function(price){
                                    //alerts user and redirects to main menu
                                    alert("Your quote has been submitted."); 
                                    location = "../main/index.php";
                                },
                                error: function(){
                                    $('#ppg').text('There is an error in submitting quote.');
                                }
                            });
                            isQuote = false; //resets checker variable to force the user to get a quote first before submitting it
                        }
                    });
                }
            });
            
        });
        </script>

    </body>
</html>