<?php
    require_once 'Testing/Selenium.php';

    class SeleniumTimedOutException extends Exception{}

    class SeleniumExtendedDriver extends Testing_Selenium
    {
        public function waitForCondition($script,$timeout)
        {
            $result = $this->doCommand("waitForCondition", array($script, $timeout));

            if(strpos($result,"Timed out") !== false){
                throw new SeleniumTimedOutException("Selenium waitForCondition has timed out");
            }
        }
    }
?>