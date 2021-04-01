<?php

    require_once 'vendor/autoload.php';

    use PHPUnit\Framework\TestCase;

    class LoginTest extends TestCase
    {
        // sets up test environment
        protected function setUp(): void
        {
            // CHANGE THESE VARIABLES TO TEST
            $_POST['username'] = 'jon';
            $_POST['password'] = '654321';

            $users = [
                "joe" => "123456",
                "jon" => "654321",
                "joy" => "abcdef",
                "shavie" => "1234" 
            ];	
        }

        //tests login module
        public function testLogin()
        {
            require_once 'program_code/back_end/backend_main.php';
            // tests login: if user can login, loginHandler will return false
            $result = loginHandler($users);
            $this->assertEquals(false, $result);
        }
    }

?>