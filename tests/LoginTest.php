<?php

    require_once 'vendor/autoload.php';

    use PHPUnit\Framework\TestCase;

    class LoginTest extends TestCase
    {
        //tests login module for login success
        public function testLoginSuccess()
        {
            require_once 'program_code/back_end/backend_main.php';

            // CHANGE THESE VARIABLES TO TEST
            $_POST['username'] = 'tyler';
            $_POST['password'] = '1111';
            //connects to local database
	        $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // tests login: if user can login, loginHandler will return false
            $result = loginHandler($db_test);
            $this->assertEquals(false, $result);
        }

        //tests login module for login failure
        public function testLoginFailure()
        {
            require_once 'program_code/back_end/backend_main.php';

            // CHANGE THESE VARIABLES TO TEST
            $_POST['username'] = 'john';
            $_POST['password'] = '1234';
            //connects to local database
	        $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // tests login: if user can't login, loginHandler will return true
            $result = loginHandler($db_test);
            $this->assertEquals(true, $result);
        }
    }

?>