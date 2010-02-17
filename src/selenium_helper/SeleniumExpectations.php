<?php
	class SeleniumExpectations
	{
		public function shouldSee($element_locator, $message = "Element was not found! Verify that the locator is correct!" ){
			Expectations::shouldBeTrue($this->selenium->isElementPresent($element_locator),$message );
			$this->lastKnownLocator = $element_locator;
			return $this;	
		}
		
		public function withText($expected_text)
		{
			Expectations::shouldNotBeNull($this->lastKnownLocator,"No element was specified. Did you forget the call to shouldSee ?");
			Expectations::shouldContain($expected_text,$this->selenium->getText($this->lastKnownLocator));
			$this->lastKnownLocator = null;
		}
		
		public function checked()
		{
			Expectations::shouldNotBeNull($this->lastKnownLocator,"No element was specified. Did you forget the call to shouldSee ?");
			Expectations::shouldBeTrue($this->selenium->isChecked($this->lastKnownLocator));
			$this->lastKnownLocator = null;
		}
		
		public function selected()
		{
			Expectations::shouldEqual($this->selenium->getValue($this->lastKnownLocator), $this->selenium->getSelectedLabel($this->lastKnownLocator."/.."));
			$this->lastKnownLocator = null;
		}

        public function shouldBeOnPage($expected_url)
        {
        	Expectations::shouldEqual($this->selenium->getLocation(), $expected_url);
		}
			
	}
	
?>