<?php
    //Array of handcoded User Information.
    $user_info = array(
        "joe" => array(
            "client_name" => "Joe Wilson",
            "client_add1" => "1234 Home street",
            "client_add2" => "N/A",
            "city" => "Houston",
            "state" => "TX" 
        ),
        "jon" => array(
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
        "shavie" => array(
            "client_name" => "Shavie Shinde",
            "client_add1" => "7891 House street",
            "client_add2" => "N/A",
            "city" => "Baytown",
            "state" => "TX" 
        )
    );

    //user info function
    function UserInfoHandler (&$userinfo){
        //setting vars
        $status = 0;
        $username = $_SESSION['username'];
        $client_name = $_POST['client_name'];
        $client_add1 = $_POST['client_add1'];
        $client_add2 = $_POST['client_add2'];
        $client_city = $_POST['city'];
        $client_state = $_POST['state'];
        // updating data for existing user
        if (isset($userinfo[$username])) {
            //notifies user of register failure
            $userinfo[$username]["client_name"] = $client_name;
            $userinfo[$username]["client_add1"] = $client_add1;
            $userinfo[$username]["client_add2"] = $client_add2;
            $userinfo[$username]["city"] = $client_city;
            $userinfo[$username]["state"] = $client_state;
            echo '<script>alert("Your user information has been updated."); 
                            location = "../main/index.php"; </script>';
            $status = 1;
        }
        // push new clients to the user_info array.
        else {
            $new_userinfo = array(
                "client_name" => $client_name,
                "client_add1" => $client_add1,
                "client_add2" => $client_add2,
                "city" => $client_city,
                "state" => $client_state
            ); 
            //add data into existing user_info array
            $userinfo[$username] = $new_userinfo;
            echo '<script>alert("Your user profile has been created."); 
                            location = "../main/index.php"; </script>';            
            $status = 2;
        }
    return $status;
    }

    if (isset($_POST['submit'])) {
        // call login handler function
        UserInfoHandler($user_info);
    }

?>