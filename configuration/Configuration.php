<?php
	class Configuration {
		private $SUTA_path = "/home/frank/projects/SUTA/";
		private $selenium_test_page_path = "expectations/selenium_expectations/selenium_test_page.html";	
		
		public function getSeleniumTestPagePath() 
		{
			return $this->SUTA_path.$this->selenium_test_page_path; 
		}
	}
?>