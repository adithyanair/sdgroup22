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
    }

    //tests user profile module for existing user
    public function testUserProfile_ExistingUser()
    {
        require_once 'program_code/user_info/backend_user_info.php';

        $_SESSION['username'] = 'joe';

        // tests user profile management: if user exists, UserInfoHandler will return 1. If user is new, UserInfoHandler will return 2
        $result = UserInfoHandler($user_info);

        $this->assertEquals(1, $result);
    }

    //tests user profile module for new user
    public function testUserProfile_NewUser()
    {
        require_once 'program_code/user_info/backend_user_info.php';
        // tests user profile management: if user exists, UserInfoHandler will return 1. If user is new, UserInfoHandler will return 2
        $result = UserInfoHandler($user_info);

        $this->assertEquals(2, $result);
    }
}

?>