<?php

	 require_once 'src/Expectations.php';
	 
	 class ExpectationsExpectations extends PHPUnit_Framework_TestCase
	 {
	 	
	 	/**
        * @test
        */
        public function ShouldBeTrueShouldBehaveJustLikeassertTrue()
        {
			Expectations::shouldBeTrue(true);
			self::assertTrue(true);
			
			try 
			{
				self::assertTrue(false);
				throw new Exception("assertTrue should fail with false");
			} 
			catch (PHPUnit_Framework_ExpectationFailedException $e)
			{				
			}
        	
			try 
			{
				Expectations::shouldBeTrue(false);
				throw new Exception("assertTrue should fail with false");
			} 
			catch (PHPUnit_Framework_ExpectationFailedException $e)
			{				
			}
			
			
        }
        
        /**
        * @test
        */
        public function ShouldBeFalseShouldBehaveJustLikeassertFalse()
        {
        	Expectations::shouldBeFalse(false);
			self::assertFalse(false);
			
			try 
			{
				self::assertFalse(True);
				throw new Exception("assertFalse should fail with true");
			} 
			catch (PHPUnit_Framework_ExpectationFailedException $e) 
			{				
			}
			
        	try 
			{
				Expectations::shouldBeFalse(true);
				throw new Exception("shouldBeFalse should fail with true");
			} 
			catch (PHPUnit_Framework_ExpectationFailedException $e) 
			{				
			}
        	
        }
        
        
        /**
        * @test
        */
        public function ShouldEqualShouldBehaveLikeAsserEqual()
        {
        	self::assertEquals("tom","tom");
        	Expectations::shouldEqual("tom","tom");
        	
            try 
			{
				self::assertEquals("foo", "bar");
				throw new Exception("assertEquals should fail with foo and bar");
			} 
			catch (PHPUnit_Framework_ExpectationFailedException $e) 
			{				
			}
        	
            try 
			{
				Expectations::shouldEqual("foo", "bar");
				throw new Exception("shouldEqual should fail with foo and bar");
			} 
			catch (PHPUnit_Framework_ExpectationFailedException $e) 
			{				
			}
			
        }
        
        public function ShouldBeNullShouldBehaveLikeAssertNull()
        {
        	Expectations::shouldBeNull(null);
        	self::assertNull(null);
        		
        	try {
        		self::assertNull("Something that isn't null");
        		throw new Exception("assertNull should fail if something not null");	
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e) 
        	{
        	}
        	
        	try {
        		Expectations::shouldBeNull("Something that isn't null");
        		throw new Exception("shouldBeNull should fail if something not null");	
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e) 
        	{
        	}
        }
	 	
        public function ShouldNotBeNullShouldBehaveLikeAssertNotNull()
        {
        	self::assertNotNull("Something not null");
        	Expectations::shouldNotBeNull("Something not null");
        	
        	try {
        		self::assertNotNull(null);
        		throw new Exception("assertNotNull should fail if something null");
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e) 
        	{
        	}
        	
        	try {
        		Expectations::shouldNotNull(null);
        		throw new Exception("shoulNotdBeNull should fail if something null");
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e) 
        	{
        	}
        }
	 }


?>