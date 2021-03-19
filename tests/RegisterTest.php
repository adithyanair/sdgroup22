<?php

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{
    // sets up test environment
    protected function setUp(): void
    {
        // CHANGE THESE VARIABLES TO TEST
        $_POST['register_user'] = 'joe';
        $_POST['register_password'] = '654321';

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
        require_once 'program_code/main/backend_main.php';
        // tests login: if user can register, register_handler will return false
        $result = register_handler($users);
        $this->assertEquals(false, $result);
    }
}

?>