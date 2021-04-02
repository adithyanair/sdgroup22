<?php
    @session_start();

    //connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'sduserdb');
    $user = $_SESSION['username'];
    
    //builds the table for fuel quote history
    function tableBuilder ($db, $username)
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

        // query to all quotes where the id's match
        $quote_query = "SELECT *
                        FROM   fuel_quote 
                        WHERE  iduser_info = '$ID_user' ";

        $result_quote = mysqli_query($db, $quote_query);
        // error checking
        if (!$result_quote) {
            echo "Could not successfully run query ($quote_query) from DB.";
            exit;
        }

        // starts table
        $html = '<table style = "width: 90%;
                                background-color: #f0f0dc;
                                margin-left: auto;
                                margin-right: auto;
                                box-shadow: 5px 10px 18px #000000;">';
        // builds header row
        $html .= '<tr>';
        $html .= '<th>' . htmlspecialchars("Delivery Date") . '</th>';
        $html .= '<th>' . htmlspecialchars("Delivery Address") . '</th>';
        $html .= '<th>' . htmlspecialchars("Gallon(s) Requested") . '</th>';
        $html .= '<th>' . htmlspecialchars("Price Per Gallon") . '</th>';
        $html .= '<th>' . htmlspecialchars("Total Amount Paid") . '</th>';
        $html .= '</tr>';

        $dataCounter = 0;

        //builds each row of quotes to be output to the table in the front end
        while($row = mysqli_fetch_array($result_quote)) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['del_date']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['del_add']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['gallon_req']) . '</td>';
            $html .= '<td>' . htmlspecialchars("$") . htmlspecialchars($row['pricing_mod']) . '</td>';
            $html .= '<td>' . htmlspecialchars("$") . htmlspecialchars($row['total']) . '</td>';
            $html .= '</tr>';
            $dataCounter++;
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
