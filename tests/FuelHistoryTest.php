<?php

    require_once 'vendor/autoload.php';

    use PHPUnit\Framework\TestCase;

    class FuelHistoryTest extends TestCase
    {
        // sets up test environment
        protected function setUp(): void
        {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            // CHANGE THESE VARIABLES TO TEST
            $_SESSION['username'] = 'tyler';
        }

        //tests login module
        public function testFuelHistory()
        {
            require_once 'program_code/back_end/backend_fuel_quote_history.php';

            // CHANGE THESE VARIABLES TO TEST
            $user = $_SESSION['username'];
            // connects to local database
	        $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // tests fuel history: if table is successfully created, assert true
            $result = tableBuilder($db_test, $user);
            $this->assertNotNull($result);
        }
    }

?>