<?php
	require_once 'Testing/Selenium.php';
	require_once dirname(__FILE__).'/../Expectations.php';
	class SeleniumTestSubject
	{
		
		private $selenium;
		private $lastKnownLocator;
		
		
		public function __construct($browser,$website)
		{
			$this->selenium = new Testing_Selenium($browser,$website);
			$this->selenium->start();
			return $this;
		}
		
		public function destroy()
		{
			$this->selenium->close();
			$this->selenium->stop();
		}
		
		function __call($method_name, $args)
        {
            if(method_exists($this->__subject, $method_name))
            {
	            return new SeleniumTestSubject(call_user_func_array( array($this->__subject, $method_name), $args));
            }
            else if(method_exists(SeleniumActions, $method_name))
            {
                array_unshift($args,$this->__subject);                
                return call_user_func_array( array(SeleniumActions, $method_name), $args);
            }
            else if(methods_exists(SeleniumExpectations,$method_name))
            {
            	array_unshift($args,$this->__subject);                
                return call_user_func_array( array(SeleniumExpectations, $method_name), $args);
            }
            else
            {
                throw new Exception('Unknown method '.$method_name."called on ".get_class($this->__subject)." instance.");	
            }
        }
        
		/**
		 * Actions
		 */
		public function goesTo($url)
		{
			$this->selenium->open($url);
			return $this;	
		}
		
		public function fillsOut($text_field_locator)
		{
			$this->lastKnownLocator = $text_field_locator;
			return $this;
		}
		
		public function with($value)
		{
			Expectations::shouldNotBeNull($this->lastKnownLocator,"Nowhere to type... Please specify where to type.");
			$this->selenium->type($this->lastKnownLocator,$value);
			$this->lastKnownLocator = null;
			return $this;
		}
		
		public function clicks($locator)
		{
			$this->selenium->click($locator);
			return $this;	
		}
		
		public function and_then()
		{
			return $this;
		}
		
		public function waitsForPageToLoad()
		{
			$this->selenium->waitForPageToLoad(30000);
		}
		
		public function drags($objects_locator)
		{
			$this->lastKnownLocator = $locator;
			return $this;
		}
		
		public function dropsOn($destinations_locator)
		{
			Expectations::shouldNotBeNull($this->lastKnownLocator,"Nowhere to drop... Please specify where to drop the object.");
			$this->selenium->dragAndDropToObject($this->lastKnownLocator,$destinations_locator);
			return $this;
		}
		
		public function checks($checkbox_or_radio_button_locator)
		{
			return $this->clicks($checkbox_or_radio_button_locator);
		}
		
		public function selects($value)
		{
			$this->lastKnownLocator = $value;
			return $this;		
		}
		
		public function from($dropdown_list_locator)
		{
			Expectations::shouldNotBeNull($this->lastKnownLocator,"Nowhere to pick from... Please specify where to find the selection.");
			$this->selenium->select($dropdown_list_locator,'label='.$this->lastKnownLocator);
			$this->lastKnownLocator = null;	
		}
		

		/**
		 * Expectations
		 */
		public function shouldSee($element_locator, $message = "Element was not found! Verify that the locator is correct!" ){
			Expectations::shouldBeTrue($this->selenium->isElementPresent($element_locator),$message );
			$this->lastKnownLocator = $element_locator;
			return $this;	
		}
		
		public function withText($expected_text)
		{
			Expectations::shouldNotBeNull($this->lastKnownLocator,"No element was specified. Did you forget the call to shouldSee ?");
			Expectations::shouldEqual($this->selenium->getText($this->lastKnownLocator), $expected_text);
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
		
		
	}
?>