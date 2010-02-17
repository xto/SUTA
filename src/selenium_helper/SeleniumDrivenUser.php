<?php
	
    require_once 'Testing/Selenium.php';
	require_once dirname(__FILE__).'/../Expectations.php';
	require_once dirname(__FILE__).'/SeleniumActions.php';
	require_once dirname(__FILE__).'/SeleniumExpectations.php';
	
	class SeleniumDrivenUser
	{
			
		private $__seleniumExecutionContext;
		private $__seleniumActions;
		private $__seleniumExpectations;
		
		public function __construct($seleniumExecutionContext)
		{
			$this->__seleniumExecutionContext = $seleniumExecutionContext;
			$this->__seleniumActions = new SeleniumActions($this->__seleniumExecutionContext);
			$this->__seleniumExpectations = new SeleniumExpectations($this->__seleniumExecutionContext);
			$this->__seleniumExecutionContext->initialize();
			
			
		}
				
		public function destroy()
		{
            $this->__seleniumExecutionContext->destroy();
		}
				
		function __call($method_name, $args)
        {
            if(method_exists($this->__seleniumActions, $method_name))
            {
                call_user_func_array( array($this->__seleniumActions, $method_name), $args);
                return $this;
            }
            else if(method_exists(SeleniumExpectations, $method_name))
            {
                call_user_func_array( array($this->__seleniumExpectations, $method_name), $args);
                return $this;
            }
            else
            {
                throw new Exception('Unknown method '.$method_name."called on ".get_class($this)." instance.");	
            }
        }
        

			
	}
?>