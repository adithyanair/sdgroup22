<?php
    //Arrays of handcoded User Information.
    $_SESSION['username'] = "joe";

    $user_info = array(
        "joe" => array(
            "client_name" => "Joe Wilson",
            "client_add1" => "1234 Home street",
            "client_add2" => "N/A",
            "city" => "Houston",
            "state" => "TX",
            "zipcode" => "77036" 
        ),
        "jon" => array(
            "client_name" => "Jon Smith",
            "client_add1" => "4321 House street",
            "client_add2" => "N/A",
            "city" => "Austin",
            "state" => "TX",
            "zipcode" => "71081" 
        ),
        "joy" => array(
            "client_name" => "Joy Swift",
            "client_add1" => "558 Ghar street",
            "client_add2" => "N/A",
            "city" => "Dallas",
            "state" => "TX",
            "zipcode" => "87042" 
        ),
        "shavie" => array(
            "client_name" => "Shavie Shinde",
            "client_add1" => "7891 House street",
            "client_add2" => "N/A",
            "city" => "Baytown",
            "state" => "TX",
            "zipcode" => "77093" 
        )
    );
    $fuel_form = array(
        "joe" => array(
            "gallon_req" => "10",
            "client_add1" => "1234 Home street, Houston, TX, 77036",
            "del_date" => "03/07/2021",
            "pricing_mod" => "2",
            "total" => "20" 
        ),
        "jon" => array(
            "gallon_req" => "15",
            "client_add1" => "4321 House street, Austin, TX, 71081",
            "del_date" => "03/15/2021",
            "pricing_mod" => "3",
            "total" => "45" 
        ),
        "joy" => array(
            "gallon_req" => "30",
            "client_add1" => "558 Ghar street, Dallas, TX, 87042",
            "del_date" => "03/08/2021",
            "pricing_mod" => "1",
            "total" => "30" 
        ),
        "shavie" => array(
            "gallon_req" => "7",
            "client_add1" => "7891 House street, Baytown, TX, 77093",
            "del_date" => "03/12/2021",
            "pricing_mod" => "5",
            "total" => "35" 
        )
    );

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
    }

    //Total calculator Function 
    function totalPrice($ppg, $gallon_req)
    {
        return $ppg * $gallon_req; 
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

    //Fuel Form Function
    function FuelFormHandler(&$fuel_form, &$user_info)
    {
        $username = $_SESSION['username'];
        if(inputValidator_FuelForm()) {
            //sets the variable values for a quote
            $num_gallon = $_POST['gallon_req'];
            $date_req = $_POST['del_date'];
            //fetches user's profile data
            foreach($user_info as $key => $value) {
                if ($username == $key) {
                    $user_data = array();
                    $user_data = $user_info[$key];
                }
            }
            //builds the user's whole address as one string
            $user_add = $user_data["client_add1"].", ".$user_data["client_add2"].", ".$user_data["city"].", ".$user_data["state"].", ".$user_data["zipcode"];
            
            //gets estimated prices from pricing module
            $pricing_mod = new pricing_module_class();
            $estimated_price = $pricing_mod->estimatedPrice();
            $total_price = totalPrice($estimated_price, $num_gallon);

            //builds new quote
            $new_quote = array(
                "gallon_req" => $num_gallon,
                "client_add1" => $user_add,
                "del_date" => $date_req,
                "pricing_mod" => $estimated_price,
                "total" => $total_price 
            ); 

            if (isset($_POST['submitquote'])) {
                //add data into existing fuel form array
                $fuel_form[$username] = $new_quote;
                //alerts user of successful quote submission
                echo '<script>alert("Your quote has been submitted."); 
                              location = "../main/index.php"; </script>';  
            }
            return true;
        }
        return false;
    }
    // calls function
    if (isset($_POST['getquote']) || isset($_POST['submitquote'])) {
        FuelFormHandler($fuel_form, $user_info);
    }
?>