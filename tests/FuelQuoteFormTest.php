<?php

    require_once 'vendor/autoload.php';

    use PHPUnit\Framework\TestCase;

    class FuelquoteformTest extends TestCase
    {
        // sets up test environment
        protected function setUp(): void
        {
            // CHANGE THESE VARIABLES TO TEST
            $_SESSION['username'] = 'joe';
            $_POST['gallon_req'] = "10";
            $_POST['del_date'] = "03/19/2021";

            $user_info = array(
                "joe" => array(
                    "client_name" => "Joe Wilson",
                    "client_add1" => "1234 Home street",
                    "client_add2" => "N/A",
                    "city" => "Houston",
                    "state" => "TX",
                    "zipcode" => "77036" 
                ),
                "jon" => array(
                    "client_name" => "Jon Smith",
                    "client_add1" => "4321 House street",
                    "client_add2" => "N/A",
                    "city" => "Austin",
                    "state" => "TX",
                    "zipcode" => "71081" 
                ),
                "joy" => array(
                    "client_name" => "Joy Swift",
                    "client_add1" => "558 Ghar street",
                    "client_add2" => "N/A",
                    "city" => "Dallas",
                    "state" => "TX",
                    "zipcode" => "87042" 
                ),
                "shavie" => array(
                    "client_name" => "Shavie Shinde",
                    "client_add1" => "7891 House street",
                    "client_add2" => "N/A",
                    "city" => "Baytown",
                    "state" => "TX",
                    "zipcode" => "77093" 
                )
            );

            $fuel_form = array(
                "joe" => array(
                    "gallon_req" => "10",
                    "client_add1" => "1234 Home street, Houston, TX, 77036",
                    "del_date" => "03/07/2021",
                    "pricing_mod" => "2",
                    "total" => "20" 
                ),
                "jon" => array(
                    "gallon_req" => "15",
                    "client_add1" => "4321 House street, Austin, TX, 71081",
                    "del_date" => "03/15/2021",
                    "pricing_mod" => "3",
                    "total" => "45" 
                ),
                "joy" => array(
                    "gallon_req" => "30",
                    "client_add1" => "558 Ghar street, Dallas, TX, 87042",
                    "del_date" => "03/08/2021",
                    "pricing_mod" => "1",
                    "total" => "30" 
                ),
                "shavie" => array(
                    "gallon_req" => "7",
                    "client_add1" => "7891 House street, Baytown, TX, 77093",
                    "del_date" => "03/12/2021",
                    "pricing_mod" => "5",
                    "total" => "35" 
                )
            );
        }

        //tests fuel quote form module
        public function testFuelQuoteForm()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';

            // if quote is submitted successfully, assert true
            $result = FuelFormHandler($fuel_form, $user_info);

            $this->assertEquals(true, $result);
        }

        //tests form field validator
        public function testInputValidatorFuelForm_true()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';
            // tests form field validator: if all valid, inputValidator will return true.
            $result = inputValidator_FuelForm();

            $this->assertEquals(true, $result);
        }

        //tests form field validator
        public function testInputValidatorFuelForm_false()
        {
            require_once 'program_code/back_end/backend_fuel_quote_form.php';

            $_POST['gallon_req'] = "-1";

            // tests form field validator: if a field is not valid, inputValidator will return false.
            $result = inputValidator_FuelForm();

            $this->assertEquals(false, $result);
        }
    }

?>