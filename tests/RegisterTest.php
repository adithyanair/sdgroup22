<?php

    require_once 'vendor/autoload.php';

    use PHPUnit\Framework\TestCase;

    class RegisterTest extends TestCase
    {
        //tests registration module for success
        public function testRegistrationSuccess()
        {
            require_once 'program_code/back_end/backend_main.php';

            // CHANGE THESE VARIABLES TO TEST
            $_POST['register_user'] = 'test16';
            $_POST['register_password'] = '123';
            //connects to local database
	        $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // tests registration: if user can register, registrationHandler will return false
            $result = registrationHandler($db_test);
            $this->assertEquals(false, $result);
        }

        //tests registration module for failure
        public function testRegistrationFailure()
        {
            require_once 'program_code/back_end/backend_main.php';

            // CHANGE THESE VARIABLES TO TEST
            $_POST['register_user'] = 'tyler';
            $_POST['register_password'] = '11111';
            //connects to local database
	        $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // tests registration: if user can't register, registrationHandler will return true
            $result = registrationHandler($db_test);
            $this->assertEquals(true, $result);
        }
    }

?>