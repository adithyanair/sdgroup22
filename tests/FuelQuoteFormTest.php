<?php

    require_once 'vendor/autoload.php';

    use PHPUnit\Framework\TestCase;

    class FuelquoteformTest extends TestCase
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

        // tests fuel quote form module success
        public function testFuelQuoteFormSuccess()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';

            // CHANGE THESE VARIABLES TO TEST
            $user = $_SESSION['username'];
            $_POST['gallon_req'] = "10";
            $_POST['submitquote'] = true;
            $_POST['del_date'] = "2021-04-02";
            // connects to local database
	        $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // if quote is submitted successfully, assert true
            $result = FuelFormHandler($db_test, $user);

            $this->assertEquals(true, $result);
        }

        // tests fuel quote form module failure
        public function testFuelQuoteFormFailure()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';

            // CHANGE THESE VARIABLES TO TEST
            $_POST['gallon_req'] = "-1";
            $_POST['submitquote'] = true;
            $user = $_SESSION['username'];
            // connects to local database
	        $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // if quote is submitted unsuccessfully, assert false
            $result = FuelFormHandler($db_test, $user);

            $this->assertEquals(false, $result);
        }

        // tests isProfileComplete function success
        public function testIsProfileCompleteSuccess()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';

            // CHANGE THESE VARIABLES TO TEST
            $user = $_SESSION['username'];
            // connects to local database
            $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // if profile is complete, assert false
            $result = isProfileComplete($db_test, $user);

            $this->assertEquals(false, $result);
        }

        // tests isProfileComplete function failure
        public function testIsProfileCompleteFailure()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';

            // CHANGE THESE VARIABLES TO TEST
            $_SESSION['username'] = 'john';
            $user = $_SESSION['username'];
            // connects to local database
            $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // if profile is incomplete, assert true
            $result = isProfileComplete($db_test, $user);

            $this->assertEquals(true, $result);
        }

        // tests fetch address function success
        public function testFetchAddress()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';

            // CHANGE THESE VARIABLES TO TEST
            $user = $_SESSION['username'];
            // connects to local database
            $db_test = mysqli_connect('localhost', 'root', '', 'sduserdb_test');

            // if profile is complete, assert false
            $result = fetchAddress($db_test, $user);

            $this->assertNotNull($result);
        }

        // tests form field validator
        public function testInputValidatorFuelForm_true()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';

            // CHANGE THESE VARIABLES TO TEST
            $_POST['gallon_req'] = "10";

            // tests form field validator: if all valid, inputValidator will return true.
            $result = inputValidator_FuelForm();

            $this->assertEquals(true, $result);
        }

        //tests form field validator
        public function testInputValidatorFuelForm_false()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';

            // CHANGE THESE VARIABLES TO TEST
            $_POST['gallon_req'] = "-1";

            // tests form field validator: if a field is not valid, inputValidator will return false.
            $result = inputValidator_FuelForm();

            $this->assertEquals(false, $result);
        }
    }

?>