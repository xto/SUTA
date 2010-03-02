<?php
    require_once 'PHPUnit/Framework.php';

    require_once 'src/selenium_helper/SeleniumExecutionContext.php';
    require_once 'src/selenium_helper/SeleniumActions.php';
    require_once 'src/Expectations.php';

    class SeleniumActionsExpectations extends PHPUnit_Framework_TestCase
    {
        public function setUp()
        {
            $browser = 'firefox';
            $url = 'http://some.url';
            $timeout = 10000;
        }

        /**
         * @test
         */
        public function waitsForAjaxShouldCallWaitForConditionWithjQueryConditionWhenjQueryIsTheLibrary()
        {
            $mock_seleniumExecutionContext = $this->getMock('SeleniumExecutionContext',array('getSelenium'),array($browser, $url, 'jQuery'));
            $mock_selenium = $this->getMock('SeleniumExtendedDriver',array(),array($browser, $url));

            $mock_seleniumExecutionContext->expects($this->any())->method('getSelenium')
            ->will($this->returnValue($mock_selenium));

            $seleniumActions = new SeleniumActions($mock_seleniumExecutionContext);

            $mock_selenium->expects($this->once())->method('waitForCondition')
            ->with("selenium.browserbot.getCurrentWindow().jQuery.active == 0");

            $seleniumActions->waitsForAjax($timeout);
        }

    	/**
         * @test
         */
        public function waitsForAjaxShouldCallWaitForConditionWithPrototypeConditionWhenPrototypeIsTheLibrary()
        {
            $mock_seleniumExecutionContext = $this->getMock('SeleniumExecutionContext',array('getSelenium'),array($browser, $url, 'Prototype'));
            $mock_selenium = $this->getMock('SeleniumExtendedDriver',array(),array($browser, $url));

            $mock_seleniumExecutionContext->expects($this->any())->method('getSelenium')
            ->will($this->returnValue($mock_selenium));

            $seleniumActions = new SeleniumActions($mock_seleniumExecutionContext);

            $mock_selenium->expects($this->once())->method('waitForCondition')
            ->with("selenium.browserbot.getCurrentWindow().Ajax.activeRequestCount == 0");

            $seleniumActions->waitsForAjax($timeout);
        }
    }
?>