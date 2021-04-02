<?php
    @session_start();

    //Pricing Module Class
    class pricing_module_class{
        public $current_price = 1.25; 
        public $margin = 0; 
        //Margin =  Current Price * (Location Factor - Rate History Factor + Gallons Requested Factor + Company Profit Factor)
        function estimatedPrice()
        {
            //$pricing_mod = $current_price + $margin;
            return $this -> current_price + $this -> margin; 
        }
        //Total calculator Function 
        function totalPrice($ppg, $gallon_req)
        {
            return $ppg * $gallon_req; 
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
        // error checking
        if (!$result_ID || mysqli_num_rows($result_ID) == 0) {
            echo "Could not successfully run query ($ID_query) from DB.";
            $failed = true;
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
            // error checking
            if (!$result_ID || mysqli_num_rows($result_ID) == 0) {
                echo "Could not successfully run query ($ID_query) from DB.";
                exit;
            }
            // fetches user id from db
            $value = $result_ID->fetch_object();
            $ID_user = $value->iduser;

            //query to fetch user profile info
            $profile_query = "SELECT client_add1, client_add2, city, state, zipcode
                              FROM   user_info
                              WHERE  iduser = '$ID_user' ";

            $result_profile = mysqli_query($db, $profile_query);
            // error checking
            if (!$result_profile || mysqli_num_rows($result_profile) == 0) {
                echo "Could not successfully run query ($profile_query) from DB.";
                exit;
            }
            //fetches user profile info from db
            $row_fetchProfile = mysqli_fetch_assoc($result_profile);

            //builds the user's whole address as one string for quote history submission
            if (is_null($row_fetchProfile["client_add2"]) || empty($row_fetchProfile["client_add2"])) {
                $user_add_for_quote = $row_fetchProfile["client_add1"].", ".$row_fetchProfile["city"].", ".$row_fetchProfile["state"].", ".$row_fetchProfile["zipcode"];
            }
            else {
                $user_add_for_quote = $row_fetchProfile["client_add1"].", ".$row_fetchProfile["client_add2"].", ".$row_fetchProfile["city"].", ".$row_fetchProfile["state"].", ".$row_fetchProfile["zipcode"];
            }

            //gets estimated prices from pricing module
            $pricing_mod = new pricing_module_class();
            $estimated_price = $pricing_mod->estimatedPrice();
            $total_price =  $pricing_mod->totalPrice($estimated_price, $num_gallon);

            //handles quote submission
            if (isset($_POST['submitquote'])) {
                //inserts into database
				$quote_submit_query = "INSERT INTO fuel_quote(del_date, del_add, gallon_req, pricing_mod, total, iduser_info)
                          	           VALUES ('$date_req', '$user_add_for_quote', '$num_gallon', '$estimated_price', '$total_price', '$ID_user')";
				$result_insert_quote_query = mysqli_query($db, $quote_submit_query);
                // error checking
                if (!$result_insert_quote_query) {
                    echo "Could not successfully run query ($quote_submit_query) from DB.";
                    //exit;
                }
                //alerts user of successful quote submission
                echo '<script>alert("Your quote has been submitted."); 
                              location = "../main/index.php"; </script>';  
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