<?php
session_start();

$fuel_history = array(
    "one" => array
    (
        "client_name" => "Joe Wilson",
        "gallon_req" => "Joe Wilson",
        "client_add1" => "1234 Home street",
        "del_date" => "03/07/2021",
        "pricing_mod" => "N/A",
        "total" => "N/A" 
    ),
    "two" => array 
    (
        "client_name" => "Jon Smith",
        "gallon_req" => "Jon Smith",
        "client_add1" => "4321 House street",
        "del_date" => "03/15/2021",
        "pricing_mod" => "N/A",
        "total" => "N/A" 
    ),
    "three" => array(
        "client_name" => "Joy Swift",
        "gallon_req" => "Joy Swift",
        "client_add1" => "558 Ghar street",
        "del_date" => "03/08/2021",
        "pricing_mod" => "N/A",
        "total" => "N/A" 
    ),
    "four" => array(
        "client_name" => "Shavie Shinde",
        "gallon_req" => "Shavie Shinde",
        "client_add1" => "7891 House street",
        "del_date" => "03/12/2021",
        "pricing_mod" => "N/A",
        "total" => "N/A" 
    )
    );

    function FuelHistFunc (&$fuel_history){
        if(isset($_POST['client_name']) && isset($_POST['gallon_req']) && isset($_POST['client_add1'])
        && isset($_POST['del_date']) && isset($_POST['pricing_mod']) && isset($_POST['total']))
        {
            $client_name = $_POST['client_name'];
            $gallon_req = $_POST['gallon_req'];
            $client_add1 = $_POST['client_add1'];
            $del_date = $_POST['del_date'];
            $pricing_mod = $_POST['pricing_mod'];
            $total = $_POST['total'];
            array_push($fuel_history, $client_name, $gallon_req, $client_add1, $del_date, 
                        $pricing_mod, $total);

            return true;
        }

        return false;
    }

    
    FuelHistFunc($fuel_history);


?>
