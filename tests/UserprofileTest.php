<?php

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class UserprofileTest extends TestCase
{
    // sets up test environment
    protected function setUp(): void
    {
        // CHANGE THESE VARIABLES TO TEST
        $_SESSION['username'] = 'tyler';
        $_POST['client_name'] = "Tyler Hu";
        $_POST['client_add1'] = "9103 Jackwood Drive";
        $_POST['client_add2'] = "Apt. 103";
        $_POST['city'] = "Albany";
        $_POST['state'] = "NY";
        $_POST['zipcode'] = "45292-12";

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
    }

    //tests user profile module for existing user
    public function testUserProfile_ExistingUser()
    {
        require_once 'program_code/back_end/backend_user_info.php';

        $_SESSION['username'] = 'joe';

        // tests user profile management: if user exists, UserInfoHandler will return 1. If user is new, UserInfoHandler will return 2
        $result = UserInfoHandler($user_info);

        $this->assertEquals(1, $result);
    }

    //tests user profile module for new user
    public function testUserProfile_NewUser()
    {
        require_once 'program_code/back_end/backend_user_info.php';
        // tests user profile management: if user exists, UserInfoHandler will return 1. If user is new, UserInfoHandler will return 2
        $result = UserInfoHandler($user_info);

        $this->assertEquals(2, $result);
    }

    //tests form field validator
    public function testInputValidator_true()
    {
        require_once 'program_code/back_end/backend_user_info.php';
        // tests form field validator: if all valid, inputValidator will return true.
        $result = inputValidator();

        $this->assertEquals(true, $result);
    }

    //tests form field validator
    public function testInputValidator_false()
    {
        require_once 'program_code/back_end/backend_user_info.php';

        $_POST['client_add2'] = "10000000001000000000100000000010000000001000000000100000000010000000001000000000100000000010000000001";

        // tests form field validator: if a field is not valid, inputValidator will return false.
        $result = inputValidator();

        $this->assertEquals(false, $result);
    }
}

?>