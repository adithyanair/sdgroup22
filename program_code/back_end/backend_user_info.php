<?php
    @session_start();
    
    // checks form fill inputs and returns bool
    function inputValidator () {
        $isValid = false;
        //required form fill validations
        if (isset($_POST['client_name']) && isset($_POST['client_add1']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zipcode'])) {
            //required form size validations
            if (strlen($_POST['client_name']) <= 50 && strlen($_POST['client_add1']) <= 100 && strlen($_POST['city']) <= 100 && 
               strlen($_POST['state']) <= 2 && strlen($_POST['zipcode']) >= 5 && strlen($_POST['zipcode']) <= 9) {
                $isValid = true;
            }
        }
        //if address 2 is input, validate
        if (isset($_POST['client_add2'])) {
            if (strlen($_POST['client_add2']) > 100) {
                $isValid = false;
            }
        }
        return $isValid;
    }

    // user profile function
    function UserInfoHandler ($db){
        //setting vars
        $status = 0;
        $username = $_SESSION['username'];
        // if input form fields are valid
        if (inputValidator()) {
            // formats form input
            $client_name = mysqli_real_escape_string($db, $_POST['client_name']);
            $client_add1 = mysqli_real_escape_string($db, $_POST['client_add1']);
            $client_add2 = mysqli_real_escape_string($db, $_POST['client_add2']);
            $city = mysqli_real_escape_string($db, $_POST['city']);
            $state = mysqli_real_escape_string($db, $_POST['state']);
            $zipcode = mysqli_real_escape_string($db, $_POST['zipcode']);

            // query to fetch user id
            $ID_query = "SELECT iduser
                         FROM   user  
                         WHERE  username = '$username' ";

            $result_ID = mysqli_query($db, $ID_query);
            // error checking
            if (!$result_ID) {
                echo "Could not successfully run query ($ID_query) from DB.";
                exit;
            }
            if (mysqli_num_rows($result_ID) == 0) {
                echo "No rows found, nothing to print so am exiting";
                exit;
            }
            // fetches user id from db
            $value = $result_ID->fetch_object();
            $ID_user = $value->iduser;
            
            // finds if current user is new or existing user
			$user_status_query = "SELECT * FROM user_info WHERE iduser = '$ID_user'";
			$result_userExists = mysqli_query($db, $user_status_query);
            // error checking
            if (!$result_userExists) {
                echo "Could not successfully run query ($user_status_query) from DB.";
                exit;
            }
			// counts number of occurences where the username is found
			$count = mysqli_num_rows($result_userExists);

			// if count is 1, user exists therefore update existing profile information
			if ($count == 1) {
                $status = 1; 
                // updates user profile in user_info table
                $update_query = "UPDATE user_info SET 
                                        client_name = '$client_name', 
                                        client_add1 = '$client_add1', 
                                        client_add2 = '$client_add2',
                                        city = '$city',
                                        state = '$state',
                                        zipcode = '$zipcode'
                                 WHERE iduser = '$ID_user'";
                // error checking
                if (mysqli_query($db, $update_query)) {
                    // notifies user profile update is successful
                    echo '<script>alert("Your user profile has been updated."); 
                                  location = "../main/index.php"; </script>';
                } 
                else {
                    echo "Error updating record: " . mysqli_error($db);
                }                   
            }
            // else user is new, therefore insert new profile into db
            else {
                $status = 2; 
                // inserts data into new row in user_info table
                $insert_query = "INSERT INTO user_info (iduser, client_name, client_add1, client_add2, city, state, zipcode)
                                 VALUES ('$ID_user', '$client_name', '$client_add1', '$client_add2', '$city', '$state', '$zipcode')";
                // error checking
                if (mysqli_query($db, $insert_query)) { 
                    //$_SESSION['username'] = $username;
                    // notifies user profile creation is successful
                    echo '<script>alert("Your user profile has been created."); 
                                  location = "../main/index.php"; </script>';
                } 
                else {
                    echo "Error creating record: " . mysqli_error($db);
                }       
            }
        }
        return $status;
    }

    //connect to database
    $db = mysqli_connect('localhost', 'root', '', 'sduserdb');
    
    if (isset($_POST['submit'])) {
        // call login handler function
        UserInfoHandler($db);
    }

?>