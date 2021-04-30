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
                            <input type="number" step="any" class="form-control" placeholder="Please enter a number" onchange="check()" oninput="check()" id="id_gr" name="gallon_req" min="0" onkeypress="return event.charCode != 45" required><br><br>
                        </label>
                        <label>
                            <span class="inputdate">Delivery Date: <span class="required">*</span></span>
                            <input type="text" class="form-control" placeholder="Please enter a date" id="id_dd" onchange="check()" oninput="check()"  name="del_date" onfocus="(this.type='date')" required><br><br>
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

                        <input type="submit"  id="id_getquote" name="getquote" value="Get Quote" 
                                                style="width: 80%; 
                                                height: 30px;
                                                margin-top: 10px;
                                                margin-left: 30px;
                                                margin-bottom: 20px;
                                                padding: 1px;
                                                border: none;
                                                border-radius: 20px;
                                                background: #808080;
                                                color: #fff;
                                                font-size: 20px;
                                                font-weight: bold;
                                                box-shadow: 1px 6px 10px #393945;
                                                transition-duration: 0.7s;"> <br>
                        <input type="submit"  id="id_submitquote" name="submitquote" value="Submit Quote" 
                                                style="width: 80%;
                                                height: 30px;
                                                margin-top: 10px;
                                                margin-left: 30px;
                                                margin-bottom: 20px;
                                                padding: 1px;
                                                border: none;
                                                border-radius: 20px;
                                                background: #808080;
                                                color: #fff;
                                                font-size: 20px;
                                                font-weight: bold;
                                                box-shadow: 1px 6px 10px #393945;
                                                transition-duration: 0.7s;" >
                        
                        <script>
                            function changeTheColorOfButtonDemo() {
                                if (document.getElementById("id_dd").value !== "") {
                                document.getElementById("id_submitquote").style.background = "green";
                                } else {
                                document.getElementById("id_submitquote").style.background = "skyblue";
                                }
                            }
                        </script>

                        <script type="text/javascript">
                            function check(){
                                var tocheck = ["gallon_req", "del_date"];
                                var tf = document.getElementById("my_form");
                                var ok = true;
                                var i;
                                for(i=0; i<tocheck.length; i++){
                                    ok = ok && tf.elements[tocheck[i]].value != "";
                                }
                                //new style for get quote button:
                                document.getElementById("id_getquote").style.background = ok ? "#050f63" : "#808080";

                                //new style for submit quote button:
                                document.getElementById("id_submitquote").style.background = ok ? "#050f63" : "#808080";
                            }
                        </script>

                        <script>
                        function s(){
                        var i=document.getElementById("id_gr");
                        var j=document.getElementById("id_dd");
                        if(i.value=="" || j.value=="")
                        {
                            document.getElementById("id_getquote").disabled=true;
                            document.getElementById("id_submitquote").disabled=true;
                            function mouseOver() {
                                document.getElementById("id_getquote").style.color = "red";
                            }

                            function mouseOut() {
                                document.getElementById("id_getquote").style.color = "black";
                            }
                        }
                        else
                        {
                            document.getElementById("id_getquote").disabled=false;
                            document.getElementById("id_submitquote").disabled=false;
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
                    $('#id_getquote').attr("disabled", false);
                    var isQuote = false;
                    var submit_gallon_req = document.getElementById("id_gr").value;
                    var submit_del_date = document.getElementById("id_dd").value;
                    
                    //behavior for get quote button
                    $('#id_getquote').click(function(){
                        submit_gallon_req = document.getElementById("id_gr").value;
                        submit_del_date = document.getElementById("id_dd").value;
                        //ajax call to get data from backend
                        jQuery.ajax({
                            //async: false,
                            type: 'POST',
                            url: "../back_end/backend_fuel_quote_form.php",
                            data: {getquote: 1, gallon_req:submit_gallon_req, del_date:submit_del_date},
                            dataType: "json",
                            success: function(response){
                                //updates fields in webpage
                                $('#gal_r').text(submit_gallon_req);
                                $('#d_date').text(submit_del_date);
                                $('#ppg').text('$' + response[0]);
                                $('#total').text('$' + response[1]);
                                //$('#id_getquote').attr("disabled", true);
                            },
                            error: function(){
                                $('#ppg').text('There is an error in getting quote.');
                            }
                        });
                        isQuote = true;
                        return false;
                    });
                    //behavior for submit quote button
                    $('#id_submitquote').click(function(){
                        submit_gallon_req2 = document.getElementById("id_gr").value;
                        submit_del_date2 = document.getElementById("id_dd").value;
                        if (isQuote == true && submit_gallon_req2 == submit_gallon_req && submit_del_date2 == submit_del_date) {                               
                            //ajax call to get data from backend            //FIX MULTIREQUESTS
                            jQuery.ajax({
                                async: false,
                                type: 'POST',
                                url: "../back_end/backend_fuel_quote_form.php",
                                data: {submitquote: 1, gallon_req:submit_gallon_req2, del_date:submit_del_date2},
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