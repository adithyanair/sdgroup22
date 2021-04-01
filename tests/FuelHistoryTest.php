<?php

    require_once 'vendor/autoload.php';

    use PHPUnit\Framework\TestCase;

    class FuelHistoryTest extends TestCase
    {
        // sets up test environment
        protected function setUp(): void
        {
            // CHANGE THESE VARIABLES TO TEST
            $_SESSION['username'] = 'joe';

            //Array of past quotes
            $fuel_history = array(
                array(
                    "Client ID" => "joe",
                    "Client Name" => "Joe Wilson",
                    "Delivery Address" => "1234 Home street, Houston, TX, 77036",
                    "Delivery Date" => "03/07/2021",
                    "Gallon(s) Requested" => "10",
                    "Price Per Gallon" => "2",
                    "Total Paid" => "20" 
                ),
                array(
                    "Client ID" => "joe",
                    "Client Name" => "Joe Wilson",
                    "Delivery Address" => "1234 Home street, Houston, TX, 77036",
                    "Delivery Date" => "03/11/2021",
                    "Gallon(s) Requested" => "11",
                    "Price Per Gallon" => "2",
                    "Total Paid" => "22" 
                ),
                array(
                    "Client ID" => "joe",
                    "Client Name" => "Joe Wilson",
                    "Delivery Address" => "1234 Home street, Houston, TX, 77036",
                    "Delivery Date" => "03/16/2021",
                    "Gallon(s) Requested" => "12",
                    "Price Per Gallon" => "2",
                    "Total Paid" => "24" 
                ),
                array(
                    "Client ID" => "jon",
                    "Client Name" => "Jon Smith",
                    "Delivery Address" => "4321 House street, Austin, TX, 71081",
                    "Delivery Date" => "03/15/2021",
                    "Gallon(s) Requested" => "15",
                    "Price Per Gallon" => "3",
                    "Total Paid" => "45" 
                ),
                array(
                    "Client ID" => "jon",
                    "Client Name" => "Jon Smith",
                    "Delivery Address" => "4321 House street, Austin, TX, 71081",
                    "Delivery Date" => "03/19/2021",
                    "Gallon(s) Requested" => "20",
                    "Price Per Gallon" => "3",
                    "Total Paid" => "60" 
                ),
                array(
                    "Client ID" => "joy",
                    "Client Name" => "Joy Swift",
                    "Delivery Address" => "558 Ghar street, Dallas, TX, 87042",
                    "Delivery Date" => "03/08/2021",
                    "Gallon(s) Requested" => "30",
                    "Price Per Gallon" => "1",
                    "Total Paid" => "30" 
                ),
                array(
                    "Client ID" => "shavie",
                    "Client Name" => "Shavie Shinde",
                    "Delivery Address" => "7891 House street, Baytown, TX, 77093",
                    "Delivery Date" => "03/12/2021",
                    "Gallon(s) Requested" => "7",
                    "Price Per Gallon" => "5",
                    "Total Paid" => "35" 
                ),
                array(
                    "Client ID" => "shavie",
                    "Client Name" => "Shavie Shinde",
                    "Delivery Address" => "7891 House street, Baytown, TX, 77093",
                    "Delivery Date" => "03/18/2021",
                    "Gallon(s) Requested" => "10",
                    "Price Per Gallon" => "5",
                    "Total Paid" => "50" 
                )
            );
        }

        //tests login module
        public function testFuelHistory()
        {
            require_once 'program_code/back_end/backend_fuel_quote_history.php';
            // tests fuel history: if table is successfully created, assert true
            $result = tableBuilder($fuel_history);
            $this->assertNotNull($result);
        }
    }

?>