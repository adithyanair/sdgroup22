<?php
    session_start();

    //Array of handcoded User Information.
    $user_info = array(
        "joe" => array
        (
            "client_name" => "Joe Wilson",
            "client_add1" => "1234 Home street",
            "client_add2" => "N/A",
            "city" => "Houston",
            "state" => "TX" 
        ),
        "jon" => array 
        (
            "client_name" => "Jon Smith",
            "client_add1" => "4321 House street",
            "client_add2" => "N/A",
            "city" => "Austin",
            "state" => "TX" 
        ),
        "joy" => array(
            "client_name" => "Joy Swift",
            "client_add1" => "558 Ghar street",
            "client_add2" => "N/A",
            "city" => "Dallas",
            "state" => "TX" 
        ),
        "Shavie" => array(
            "client_name" => "Shavie Shinde",
            "client_add1" => "7891 House street",
            "client_add2" => "N/A",
            "city" => "Baytown",
            "state" => "TX" 
        )
        );

        //user info function
        function UserInfoHandler (&$userinfo){
            if(isset($_POST['client_name']) && isset($_POST['client_add1'])
            && isset($_POST['client_add2']) && isset($_POST['client_city']) && isset($_POST['client_state']))
            {
                $client_name = $_POST['client_name'];
                $client_add1 = $_POST['client_add1'];
                $client_add2 = $_POST['client_add2'];
                $client_city = $_POST['client_city'];
                $client_state = $_POST['client_state'];
                //Push new clients to the user_info array.
                array_push($user_info, $client_name, $client_add1, $client_add2, 
                            $client_city, $client_state);

                //for the testing
                return true;
            }

            return false;
        }

        if (isset($_POST['submit'])) {
            // call login handler function
            UserInfoHandler($user_info);
        }