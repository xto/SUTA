<?php

    require_once dirname(__FILE__).'/SeleniumExtendedDriver.php';

    class SeleniumExecutionContext
    {
    	private $__browser;
    	private $__website;
    	private $__selenium;
        private $__isInitialized;
    	private $__lastVisitedLocation;
    	private $__javascript_library;

    	public function __construct($browser, $website, $javascript_library)
    	{
    	   $this->__browser = $browser;
    	   $this->__website = $website;
    	   $this->__javascript_library = $javascript_library;
    	   $this->__selenium = new SeleniumExtendedDriver($browser, $website);
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

    	public function getJavascriptLibrary()
    	{
    	    return $this->__javascript_library;
    	}

    	public function setJavascriptLibrary($javascriptLibrary)
    	{
    		$this->__javascript_library = $javascriptLibrary;
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
             $this->__isInitialized = true;
        }

        private function __stopSelenium()
        {
            $this->__selenium->close();
            $this->__selenium->stop();
        }

    }
?>