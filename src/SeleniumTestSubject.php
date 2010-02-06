<?php
	require_once 'Testing/Selenium.php';
	
	class SeleniumTestSubject
	{
		
		private $selenium;
		private $lastKnownLocator;
		
		public function __construct($browser,$website)
		{
			$this->selenium = new Testing_Selenium($browser,$website);
			$this->selenium->start();
			$this->selenium->open($website);
			return $this;
		}
		
		public function fillsOut($locator)
		{
			$this->lastKnownLocator = $locator;
			return $this;
		}
		
		public function with($value)
		{
			$this->selenium->type($this->lastKnownLocator,$value);
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
		
	}
?>