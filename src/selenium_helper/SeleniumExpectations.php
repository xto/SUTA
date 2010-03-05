<?php
	class SeleniumExpectations
	{

	    private $__seleniumExecutionContext;

        public function __construct($seleniumExecutionContext)
        {
            $this->__seleniumExecutionContext= $seleniumExecutionContext;
        }

        private function __getLastVisitedLocation()
        {
            return $this->__seleniumExecutionContext->getLastVisitedLocation();
        }

        private function __getSelenium()
        {
            return $this->__seleniumExecutionContext->getSelenium();
        }

        private function __resetLastVisitedLocation()
        {
             $this->__seleniumExecutionContext->resetLastVisitedLocation();
        }

	    private function __setLastVisitedLocation($location)
        {
             $this->__seleniumExecutionContext->setLastVisitedLocation($location);
        }

		public function shouldSee($element_locator, $message = "Element was not found! Verify that the locator is correct!" ){
			Expectations::shouldBeTrue($this->__getSelenium()->isElementPresent($element_locator),$message );
			$this->__setLastVisitedLocation($element_locator);
		}

	    public function shouldNotSee($element_locator, $message = "Element was found! Verify that the locator is correct and that it should not be found !!!" ){
			Expectations::shouldBeFalse($this->__getSelenium()->isElementPresent($element_locator),$message );
			$this->__setLastVisitedLocation($element_locator);
		}

		public function withText($expected_text)
		{
			Expectations::shouldNotBeNull($this->__getLastVisitedLocation(),"No element was specified. Did you forget the call to shouldSee ?");
			Expectations::shouldContain($expected_text,$this->__getSelenium()->getText($this->__getLastVisitedLocation()));
			$this->__resetLastVisitedLocation();
		}

	    public function withValue($expected_text)
		{
			Expectations::shouldNotBeNull($this->__getLastVisitedLocation(),"No element was specified. Did you forget the call to shouldSee ?");
			Expectations::shouldContain($expected_text,$this->__getSelenium()->getValue($this->__getLastVisitedLocation()));
			$this->__resetLastVisitedLocation();
		}

		public function checked()
		{
			Expectations::shouldNotBeNull($this->__getLastVisitedLocation(),"No element was specified. Did you forget the call to shouldSee ?");
			Expectations::shouldBeTrue($this->__getSelenium()->isChecked($this->__getLastVisitedLocation()));
			$this->__resetLastVisitedLocation();
		}

		public function unchecked()
		{
		    Expectations::shouldNotBeNull($this->__getLastVisitedLocation(),"No element was specified. Did you forget the call to shouldSee ?");
			Expectations::shouldBeFalse($this->__getSelenium()->isChecked($this->__getLastVisitedLocation()));
			$this->__resetLastVisitedLocation();
		}

		public function selected()
		{
			Expectations::shouldEqual($this->__getSelenium()->getValue($this->__getLastVisitedLocation()), $this->__getSelenium()->getSelectedLabel($this->__getLastVisitedLocation()."/.."));
			$this->__resetLastVisitedLocation();
		}

        public function shouldBeOnPage($expected_url)
        {
        	Expectations::shouldEqual($this->__getSelenium()->getLocation(), $expected_url);
		}

	}

?>
