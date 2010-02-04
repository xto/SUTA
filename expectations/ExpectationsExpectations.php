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
	 	
	 }


?>