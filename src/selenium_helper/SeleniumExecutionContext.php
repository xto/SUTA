<?php

    class SeleniumExecutionContext
    {
    	private $__browser;
    	private $__website;
    	private $__selenium;
        private $__isInitialized;
    	private $__lastVisitedLocation;
    	
    	public function __construct($browser, $website)
    	{
    	   $this->__browser = $browser;
    	   $this->__website = $website;	
    	   $this->__selenium = new Testing_Selenium($browser, $website);      
    	   $this->__isInitialized = false;
    	   $this->resetLastVisitedLocation();
    	}
    	
    	public function getBrowser()
    	{
    		return $this->__browser;
    	}
    	
    	public function getWebSite()
    	{
    		return $this->__website;
    	}
    	
        public function getSelenium()
        {
            return $this->__selenium;
        }
        
    	public function setLastVisitedLocation($location)
    	{
    	   	$this->__lastVisitedLocation = $location; 
    	}
    	
    	public function getLastVisitedLocation()
    	{
    		return $this->__lastVisitedLocation;
    	}
    	
    	public function resetLastVisitedLocation()
    	{
            $this->__lastVisitedLocation = null;      		
    	}
    	       
        public function initialize()
        {
            if(!$this->__isInitialized)
               $this->__startSelenium();
        }
        
        public function destroy()
        {
            if($this->__isInitialized)
                $this->__stopSelenium();
        }
        
        private function __startSelenium()
        {
            $this->__selenium->start();
             $this->__isStarted = true;
        }
        
        private function __stopSelenium()
        {
            $this->__selenium->close();
            $this->__selenium->stop();
        }
    	
    }
?>