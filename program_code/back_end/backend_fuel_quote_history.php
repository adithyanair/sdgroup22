<?php
    //Array of past quotes
    $fuel_history = array(
        array(
            "Client ID" => "joe",
            "Client Name" => "Joe Wilson",
            "Delivery Address" => "1234 Home street, Houston, TX, 77036",
            "Delivery Date" => "03/07/2021",
            "Gallon(s) Requested" => "10",
            "Price Per Gallon" => "2",
            "Total Paid" => "20" 
        ),
        array(
            "Client ID" => "joe",
            "Client Name" => "Joe Wilson",
            "Delivery Address" => "1234 Home street, Houston, TX, 77036",
            "Delivery Date" => "03/11/2021",
            "Gallon(s) Requested" => "11",
            "Price Per Gallon" => "2",
            "Total Paid" => "22" 
        ),
        array(
            "Client ID" => "joe",
            "Client Name" => "Joe Wilson",
            "Delivery Address" => "1234 Home street, Houston, TX, 77036",
            "Delivery Date" => "03/16/2021",
            "Gallon(s) Requested" => "12",
            "Price Per Gallon" => "2",
            "Total Paid" => "24" 
        ),
        array(
            "Client ID" => "jon",
            "Client Name" => "Jon Smith",
            "Delivery Address" => "4321 House street, Austin, TX, 71081",
            "Delivery Date" => "03/15/2021",
            "Gallon(s) Requested" => "15",
            "Price Per Gallon" => "3",
            "Total Paid" => "45" 
        ),
        array(
            "Client ID" => "jon",
            "Client Name" => "Jon Smith",
            "Delivery Address" => "4321 House street, Austin, TX, 71081",
            "Delivery Date" => "03/19/2021",
            "Gallon(s) Requested" => "20",
            "Price Per Gallon" => "3",
            "Total Paid" => "60" 
        ),
        array(
            "Client ID" => "joy",
            "Client Name" => "Joy Swift",
            "Delivery Address" => "558 Ghar street, Dallas, TX, 87042",
            "Delivery Date" => "03/08/2021",
            "Gallon(s) Requested" => "30",
            "Price Per Gallon" => "1",
            "Total Paid" => "30" 
        ),
        array(
            "Client ID" => "shavie",
            "Client Name" => "Shavie Shinde",
            "Delivery Address" => "7891 House street, Baytown, TX, 77093",
            "Delivery Date" => "03/12/2021",
            "Gallon(s) Requested" => "7",
            "Price Per Gallon" => "5",
            "Total Paid" => "35" 
        ),
        array(
            "Client ID" => "shavie",
            "Client Name" => "Shavie Shinde",
            "Delivery Address" => "7891 House street, Baytown, TX, 77093",
            "Delivery Date" => "03/18/2021",
            "Gallon(s) Requested" => "10",
            "Price Per Gallon" => "5",
            "Total Paid" => "50" 
        )
    );

    //connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'sduserdb');
    
    //builds the table for fuel quote history
    function tableBuilder (&$fuelhistory)
    {
        $user = $_SESSION['username'];
        // starts table
        $html = '<table style = "width: 90%;
                                background-color: #f0f0dc;
                                margin-left: auto;
                                margin-right: auto;
                                box-shadow: 5px 10px 18px #000000;">';
        // builds header row
        $html .= '<tr>';
        $html .= '<th>' . htmlspecialchars("Delivery Address") . '</th>';
        $html .= '<th>' . htmlspecialchars("Delivery Date") . '</th>';
        $html .= '<th>' . htmlspecialchars("Gallon(s) Requested") . '</th>';
        $html .= '<th>' . htmlspecialchars("Price Per Gallon") . '</th>';
        $html .= '<th>' . htmlspecialchars("Total Amount Paid") . '</th>';
        $html .= '</tr>';

        $dataCounter = 0;

        // builds data rows
    foreach ($fuelhistory as $key=>$value) {
            if ($user == $value["Client ID"]) {
                $html .= '<tr>';
                foreach (array_slice($value,1) as $key2=>$value2) {
                    $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                }
                $html .= '</tr>';
                $dataCounter++;
            }
        }
        // validation: error message for brand new users
        if ($dataCounter == 0) {
            $html .= '<td>' . htmlspecialchars("No data found! You have not ordered from us yet.") . '</td>';
        }

        // finishes table and return it
        $html .= '</table>';
        return $html;
    }


?>
