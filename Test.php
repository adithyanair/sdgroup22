<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class Test extends TestCase
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
        require 'test_code/server.php';
        // tests login: if user can login, loginHandler will return false
        $this->assertEquals(false, loginHandler());
    }
}

?>