<?php
    @session_start();

    //Pricing Module Class
    class pricing_module_class{
        //Suggested Price =  Current Price * (Location Factor - Rate History Factor + Gallons Requested Factor + Company Profit Factor)
      
        //if in texas = 2%, outside of texas = 4%
        function location_factor($db, $username)
        {
            $location_f = 0;
            
            // query to fetch user id
            $ID_query = "SELECT iduser
                         FROM   user  
                         WHERE  username = '$username' ";
            $result_ID = mysqli_query($db, $ID_query);

            // error checking
            if (!$result_ID || mysqli_num_rows($result_ID) == 0) {
                echo "Could not successfully run query ($ID_query) from DB.";
                exit;
            }

            // fetches user id from db
            $value = $result_ID->fetch_object();
            $ID_user = $value->iduser;

            // query to fetch STATE from the user_info table
            $profile_query = "SELECT state
                              FROM   user_info
                              WHERE  iduser = '$ID_user' ";
            $result_profile = mysqli_query($db, $profile_query);

            // fetches user profile info from db
            $row_fetchProfile = mysqli_fetch_assoc($result_profile);

            $state_fetch = $row_fetchProfile["state"];

            if($state_fetch == 'TX'){
                $location_f = 0.02;
            }
            else{
                $location_f = 0.04;
            }
            return $location_f;
        }
        
        //if client requested fuel before or check query fuel quote table to check if there are any rows for client
        function ratehistory_factor($db, $username)
        {
            $ratehistory = 0; 

            $ID_query = "SELECT iduser
                         FROM   user  
                         WHERE  username = '$username' ";
            $result_ID = mysqli_query($db, $ID_query);

            // error checking
            if (!$result_ID || mysqli_num_rows($result_ID) == 0) {
                echo "Could not successfully run query ($ID_query) from DB.";
                exit;
            }
            // fetches user id from db
            $value = $result_ID->fetch_object();
            $ID_user = $value->iduser;
    

            // query to fetch user profile info
            $userinfo_query = "SELECT iduser_info
                               FROM   user_info
                               WHERE  iduser = '$ID_user' ";
    
            $result_iduserinfo = mysqli_query($db, $userinfo_query);

            // fetches user profile info from db
            $value2 = $result_iduserinfo->fetch_object();
            $ID_userinfo = $value2->iduser_info;
    
            //query to fetch fuel quote info 
            $fuelquote_query = "SELECT * FROM fuel_quote WHERE iduser_info ='$ID_userinfo' LIMIT 1";
            $results = mysqli_query($db, $fuelquote_query);
            $count = mysqli_num_rows($results);

            // if count is great than 1, then there is client in the history
            if ($count) {
                $ratehistory = 0.01; 
            }
            else{
                $ratehistory = 0;
                
            }
            return $ratehistory; 
        }
        
        //2% = above 1000 gallon, 3% if below 1000 gallons
        function gallonrequested_factor($fuel_fetch)
        {
            $gallon_req_factor = 0; 
        
            if($fuel_fetch > 1000){
                $gallon_req_factor = 0.02; 
                /*echo '<script>alert("Welcome '.$fuel_fetch.'!"); 
                        location = "fuel_quote_form.php"; </script>';*/
                //$this -> gallon_req_factor = 0.02;
                //return $this -> gallon_req_factor;
            }
            if($fuel_fetch < 1000) 
            {
                $gallon_req_factor = 0.03; 
                //$this -> gallon_req_factor = 0.03; 
                //return $this -> gallon_req_factor;
            }
            return $gallon_req_factor; 
        }
    
        //For the calculation for margin 
        function margin_calculation($location , $rate_history , $gallon_req_fac)
        {
            $company_profit = 0.1; 
            $current_price = 1.5;
            $margin = ($location - $rate_history + $gallon_req_fac +$company_profit) * $current_price;
            return $margin; 
        }

        //Margin calculation + current price which is constant
        function suggestedPrice($margin)
        {
            $current_price = 1.5;
            $pricing_mod = $current_price + $margin;
            //return $this -> current_price + $this -> margin; 
            return $pricing_mod;
        }

        //Total calculator Function 
        function totalPrice($pricing_mod, $gallon_req)
        {
            return $pricing_mod * $gallon_req; 
        }
    }

    // checks if user profile is complete
    function isProfileComplete($db, $username)
    {
        // init value
        $failed = false;
        // query to fetch user id
        $ID_query = "SELECT iduser
                     FROM   user  
                     WHERE  username = '$username' ";

        $result_ID = mysqli_query($db, $ID_query);
        
        // fetches user id from db
        $value = $result_ID->fetch_object();
        $ID_user = $value->iduser;

        // query to fetch user profile info
        $profile_query = "SELECT client_add1, client_add2, city, state, zipcode
                          FROM   user_info
                          WHERE  iduser = '$ID_user' ";

        $result_profile = mysqli_query($db, $profile_query);
        // error checking
        if (mysqli_num_rows($result_profile) == 0) {
            $failed = true;
            echo '<script>alert("Your user information has not been filled out yet. Please setup your user profile."); 
						  location = "../main/index.php"; </script>';
        }
        return $failed;
    }

    // fetches user's address from the database and returns a string
    function fetchAddress($db, $username)
    {
        // query to fetch user id
        $ID_query = "SELECT iduser
                     FROM   user  
                     WHERE  username = '$username' ";

        $result_ID = mysqli_query($db, $ID_query);
        // error checking
        if (!$result_ID || mysqli_num_rows($result_ID) == 0) {
            echo "Could not successfully run query ($ID_query) from DB.";
            exit;
        }
        // fetches user id from db
        $value = $result_ID->fetch_object();
        $ID_user = $value->iduser;

        // query to fetch user profile info
        $profile_query = "SELECT client_add1, client_add2, city, state, zipcode
                          FROM   user_info
                          WHERE  iduser = '$ID_user' ";

        $result_profile = mysqli_query($db, $profile_query);
        // fetches user profile info from db
        $row_fetchProfile = mysqli_fetch_assoc($result_profile);

        // builds the user's whole address to be displayed in quote form
        $user_add_for_form = $row_fetchProfile["client_add1"]."<br>".$row_fetchProfile["client_add2"]."<br>".$row_fetchProfile["city"].", ".$row_fetchProfile["state"].", ".$row_fetchProfile["zipcode"];
        
        return $user_add_for_form;
    }

    // checks form fill inputs and returns bool
    function inputValidator_FuelForm () {
        $isValid = false;
        //required form fill validations
        if (isset($_POST['gallon_req']) && isset($_POST['del_date'])) {
            //required form size validations
            if (is_numeric($_POST['gallon_req']) && $_POST['gallon_req'] >= 0) {
                $isValid = true;
            }
        }
        return $isValid;
    }

    // fuel form main function
    function FuelFormHandler($db, $username)
    {
        if (inputValidator_FuelForm()) {
            // sets the variable values for a quote
            $num_gallon = $_POST['gallon_req'];
            $date_req = $_POST['del_date'];

            // query to fetch user id
            $ID_query = "SELECT iduser
                         FROM   user  
                         WHERE  username = '$username' ";

            $result_ID = mysqli_query($db, $ID_query);
            
            // fetches user id from db
            $value = $result_ID->fetch_object();
            $ID_user = $value->iduser;

            //query to fetch user profile info
            $profile_query = "SELECT client_add1, client_add2, city, state, zipcode
                              FROM   user_info
                              WHERE  iduser = '$ID_user' ";

            $result_profile = mysqli_query($db, $profile_query);
            
            //fetches user profile info from db
            $row_fetchProfile = mysqli_fetch_assoc($result_profile);

            //builds the user's whole address as one string for quote history submission
            if (is_null($row_fetchProfile["client_add2"]) || empty($row_fetchProfile["client_add2"])) {
                $user_add_for_quote = $row_fetchProfile["client_add1"].", ".$row_fetchProfile["city"].", ".$row_fetchProfile["state"].", ".$row_fetchProfile["zipcode"];
            }
            else {
                $user_add_for_quote = $row_fetchProfile["client_add1"].", ".$row_fetchProfile["client_add2"].", ".$row_fetchProfile["city"].", ".$row_fetchProfile["state"].", ".$row_fetchProfile["zipcode"];
            }

            //gets suggested price for pricing module
            $pricing_mod = new pricing_module_class();
            $location_f = $pricing_mod->location_factor($db, $username);
            $ratehistory_f = $pricing_mod->ratehistory_factor($db, $username); //no
            $gallon_requested_f = $pricing_mod->gallonrequested_factor($num_gallon);
            $margin = $pricing_mod->margin_calculation($location_f , $ratehistory_f , $gallon_requested_f);
            $suggestedPrice = $pricing_mod->suggestedPrice($margin);
            //gets total price for pricing module
            $total_price =  $pricing_mod->totalPrice($suggestedPrice, $num_gallon);
            
            //handles ajax quote getter
            if (isset($_POST['getquote'])) {
                //formats numbers
                $total_price_r = round($total_price, 2);
                $total_price_f = sprintf('%0.2f', $total_price_r);
                $return_values=array($suggestedPrice, $total_price_f);
                echo json_encode($return_values);
                //exit;
            }
            
            //handles quote submission
            if (isset($_POST['submitquote'])) {
                //inserts into database
				$quote_submit_query = "INSERT INTO fuel_quote(del_date, del_add, gallon_req, pricing_mod, total, iduser_info)
                          	           VALUES ('$date_req', '$user_add_for_quote', '$num_gallon', '$suggestedPrice', '$total_price', '$ID_user')";
				$result_insert_quote_query = mysqli_query($db, $quote_submit_query);
                // error checking
                if (!$result_insert_quote_query) {
                    echo "Could not successfully run query ($quote_submit_query) from DB.";
                    //exit;
                }
                //exit;
            }
            return true;
        }
        return false;
    }

    $db = mysqli_connect('localhost', 'root', '', 'sduserdb');
    $user = $_SESSION['username'];

    // calls function
    if (isset($_POST['getquote']) || isset($_POST['submitquote'])) {
        FuelFormHandler($db, $user);
    }
?>