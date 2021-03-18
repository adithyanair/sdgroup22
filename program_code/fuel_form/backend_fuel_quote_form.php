<?php
    session_start();

    $fuel_form = array(
        "joe" => array
        (
            "gallon_req" => "Joe Wilson",
            "client_add1" => "1234 Home street",
            "del_date" => "03/07/2021",
            "pricing_mod" => "N/A",
            "total" => "N/A" 
        ),
        "jon" => array 
        (
            "gallon_req" => "Jon Smith",
            "client_add1" => "4321 House street",
            "del_date" => "03/15/2021",
            "pricing_mod" => "N/A",
            "total" => "N/A" 
        ),
        "joy" => array(
            "gallon_req" => "Joy Swift",
            "client_add1" => "558 Ghar street",
            "del_date" => "03/08/2021",
            "pricing_mod" => "N/A",
            "total" => "N/A" 
        ),
        "Shavie" => array(
            "gallon_req" => "Shavie Shinde",
            "client_add1" => "7891 House street",
            "del_date" => "03/12/2021",
            "pricing_mod" => "N/A",
            "total" => "N/A" 
        )
        );

        //Pricing Module Class
        class pricing_module_class{
            public $current_price = 1.25; 
            public $margin = 0; 
            //Margin =  Current Price * (Location Factor - Rate History Factor + Gallons Requested Factor + Company Profit Factor)
            function pricingmodule()
            {
                //$pricing_mod = $current_price + $margin;
                return $this -> current_price + $this -> margin; 
            }
        }
        //to return the results
        //$pricing_mod = new pricing_module_class(); 


        //Total Function 
        /*function totalFunc($pricing_mod, $gallon_req)
        {
            return $pricing_mod * $gallon_req; 
        }
        totalFunc($pricing_mod, $gallon_req)*/

        //Fuel Form Function
        function FuelFormFunc (&$fuel_form){
            if(isset($_POST['gallon_req']) && isset($_POST['client_add1'])
            && isset($_POST['del_date']) && isset($_POST['pricing_mod']) && isset($_POST['total']))
            {
                $gallon_req = $_POST['gallon_req'];
                $client_add1 = $_POST['client_add1'];
                $del_date = $_POST['del_date'];
                $pricing_mod = $_POST['pricing_mod'];
                $total = $_POST['total'];
                //Push new clients to the user_info array.
                array_push($fuel_form, $gallon_req, $client_add1, $del_date, 
                            $pricing_mod, $total);

                return true;
            }

            return false;
        }

        if (isset($_POST['submit'])) {
            FuelFormFunc($fuel_form);
        }
