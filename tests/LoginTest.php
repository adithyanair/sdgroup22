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
    }

    //tests login module
    public function testLogin()
    {
        require_once 'test_code/main/server.php';
        // tests login: if user can login, loginHandler will return false
        $result = loginHandler();
        $this->assertEquals(false, $result);
    }
}

?>