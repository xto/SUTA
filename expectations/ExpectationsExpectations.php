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
        public function ShouldEqualShouldBehaveLikeAssertEqual()
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

        /**
         * @test
         */
        public function ShouldNotBeEqualShouldBehaveLikeAssertNotEquals()
        {
            self::assertNotEquals(1,2);
            Expectations::shouldNotEqual(1,2);

            try
            {
                self::assertNotEquals(1,1);
                throw new Exception("assertNotEquals should fail when both elements are equal");
            }
            catch (PHPUnit_Framework_ExpectationFailedException $e)
            {
            }

            try
            {
                Expectations::shouldNotEqual(1,1);
                throw new Expection("shouldNotEqual should fail when both elements are equal");
            }
            catch (PHPUnit_Framework_ExpectationFailedException $e)
            {
            }
        }

        /**
        * @test
        */
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

        /**
        * @test
        */
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
        		Expectations::shouldNotBeNull(null);
        		throw new Exception("shoulNotdBeNull should fail if something null");
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e)
        	{
        	}
        }

        /**
        * @test
        */
        public function ShouldContainShouldBehaveLikeAssertContains()
        {
            self::assertContains("tom","tom petty");
            Expectations::shouldContain("tom", "tom petty");

            try {
        		self::assertContains("tom", "petty");
        		throw new Exception("assertContains should fail if the pattern is not in the value");
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e)
        	{
        	}

        	try {
        		Expectations::shouldContain("tom", "petty");
        		throw new Exception("shoudlContain should fail if the pattern is not in the value");
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e)
        	{
        	}
        }

	 	/**
        * @test
        */
        public function ShouldContainShouldFailOnEmptyStringsAsThePattern()
        {
            try {
        		Expectations::shouldContain("", "TOM");
        		throw new Exception("shoudlContain should fail if the pattern is an empty string");
        	}
        	catch (PHPUnit_Framework_Exception $e)
        	{
        	    Expectations::shouldContain("shouldBeEmpty", $e->getMessage());
        	}
        }

	 	/**
        * @test
        */
        public function ShouldContainShouldSucceedWhenLookingForAPatterninAnEmptyString()
        {
         	try {
        		Expectations::shouldContain("tom", "");
        		throw new Exception("shoudlContain should fail if the pattern is not in the value and the value is empty");
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e)
        	{
        	}
        }

        /**
         * @test
         */
        public function ShouldNotContainShouldBehaveLikeAssertNotContains()
        {
            self::assertNotContains("tom", "something else");
            Expectations::shouldNotContain("tom", "something else");

            try {
        		self::assertNotContains("tom", "tom");
        		throw new Exception("assertNotContains should fail if the pattern is in the value");
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e)
        	{
        	}

        	try {
        		Expectations::shouldNotContain("tom", "tom");
        		throw new Exception("shoulNotContain should fail if the pattern is in the value");
        	}
        	catch (PHPUnit_Framework_ExpectationFailedException $e)
        	{
        	}
        }

        /**
         * @test
         */
        public function ShouldRaiseExceptionShouldPassWhenExceptationRaisedMatchsExpectedException()
        {
        	$expected = new Exception("patate");
        	$actual = $expected;
        	Expectations::shouldRaiseException($actual, $expected);
        }


	     /**
         * @test
         */
        public function ShouldRaiseExceptionShouldFailWhenExceptationRaisedDoesNotMatchExpectedException()
        {
            $expected = new Exception("potato");
            $actual = new ErrorException("potato");
            try
            {
            	 Expectations::shouldRaiseException($actual, $expected);
            	 throw new Exception("shouldRaiseException() Should Fail When Exceptation Raised Does Not Match Expected Exception");
            }catch (PHPUnit_Framework_ExpectationFailedException $e)
            {
            }

        }

        /**
         * @test
         */
        public function ShouldEqualShouldPassWhenTheTwoObjectsAreExactlyTheSame()
        {
            $Nick = new DummyUser("Nick",true);
            $Xavier = new DummyUser("Xavier", false);
            $Francis = new DummyUser("Francis", true);

            $expected = array($Nick, $Xavier, $Francis);
            $actual = array($Nick,$Xavier,$Francis);

            Expectations::shouldEqual($actual,$expected);
        }

        /**
         * @test
         */
        public function ShouldEqualShouldFailWhenTheTwoObjectsAreNotExactlyTheSame()
        {
            $Nick = new DummyUser("Nick",true);
            $Xavier = new DummyUser("Xavier", false);
            $Francis = new DummyUser("Francis", true);

            $expected = array($Nick, $Xavier, $Francis);
            $actual = array($Xavier,$Francis);

            try{
                Expectations::shouldEqual($actual,$expected);
                throw new Exception("shouldNotEqual should fail when both elements are equal");
            }
            catch(PHPUnit_Framework_ExpectationFailedException $e)
            {}
        }

        /**
         * @test
         */
        public function ShouldBeEmptyShouldSucceedWhenUsingOnEmptyString()
        {
            Expectations::shouldBeEmpty("");
        }

	 	/**
         * @test
         */
        public function ShouldBeEmptyShouldSucceedWhenUsingOnEmptyArray()
        {
            Expectations::shouldBeEmpty(array());
        }


	 	/**
         * @test
         */
        public function ShouldBeEmptyShouldFailWhenOnNotEmptyString()
        {
            try{
                Expectations::shouldBeEmpty("This is not empty");
                throw new Expection("shouldBeEmpty should fail when object is not empty");
            }
            catch(PHPUnit_Framework_ExpectationFailedException $e)
            {}
        }

	 	/**
         * @test
         */
        public function ShouldBeEmptyShouldFailWhenUsedOnNotEmptyArray()
        {
            try
            {
                Expectations::shouldBeEmpty(array(1,2,3,4));
                throw new Expection("shouldBeEmpty should fail when object is not empty");
            }
            catch(PHPUnit_Framework_ExpectationFailedException $e)
            {}
        }

        /**
         * @test
         */
        public function ShouldBeEmptyShouldFailWhenUsedOnZero()
        {
            try
            {
                Expectations::shouldBeEmpty(0);
                throw new Exception("shouldBeEmpty should fail when object is a zero");
            }
            catch(PHPUnit_Framework_Exception $e)
            {
                Expectations::shouldContain("shouldEqual",$e->getMessage());
            }
        }

    }


?>