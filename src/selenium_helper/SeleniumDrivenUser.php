<?php
	require_once 'Testing/Selenium.php';
	require_once dirname(__FILE__).'/../Expectations.php';
	class SeleniumDrivenUser
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
				/**
		 * Expectations
		 */
			
	}
?>