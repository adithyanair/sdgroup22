<?php

    require_once 'vendor/autoload.php';

    use PHPUnit\Framework\TestCase;

    class UserprofileTest extends TestCase
    {
        // sets up test environment
        protected function setUp(): void
        {
            // CHANGE THESE VARIABLES TO TEST
            $_POST['client_name'] = "John Jones";
            $_POST['client_add1'] = "9103 Jackwood Drive";
            $_POST['client_add2'] = "Apt. 103";
            $_POST['city'] = "Albany";
            $_POST['state'] = "NY";
            $_POST['zipcode'] = "45292-182";
        }

        //tests user profile module for existing user
        public function testUserProfile_ExistingUser()
        {
            require_once 'program_code/back_end/backend_user_info.php';

            // CHANGE THESE VARIABLES TO TEST
            $_SESSION['username'] = 'tyler';
            //connects to local database
	        $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // tests user profile management: if user exists, UserInfoHandler will return 1. If user is new, UserInfoHandler will return 2
            $result = UserInfoHandler($db_test);

            $this->assertEquals(1, $result);
        }

        //tests user profile module for new user
        public function testUserProfile_NewUser()
        {
            require_once 'program_code/back_end/backend_user_info.php';

            // CHANGE THESE VARIABLES TO TEST
            $_SESSION['username'] = 'john';
            //connects to local database
	        $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');
            // tests user profile management: if user exists, UserInfoHandler will return 1. If user is new, UserInfoHandler will return 2
            $result = UserInfoHandler($db_test);

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