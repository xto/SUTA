<?php

	require_once 'src/selenium_helper/SeleniumDrivenUser.php';
	require_once 'src/selenium_helper/SeleniumExecutionContext.php';
	require_once 'configuration/Configuration.php';

	class SeleniumDrivenUserExpectations extends PHPUnit_Framework_TestCase
	{
		private static $selenium_execution_context;
		private static $selenium_driven_user;
		private static $selenium_test_page_path;

		public static function setUpBeforeClass()
        {
        	$configuration = new Configuration();
    		self::$selenium_test_page_path = $configuration->getSeleniumTestPagePath();

	        self::$selenium_execution_context = new SeleniumExecutionContext("firefox","file://".self::$selenium_test_page_path, "jQuery");
    		self::$selenium_driven_user = new SeleniumDrivenUser(self::$selenium_execution_context);
		}

		public static function tearDownAfterClass()
		{
			self::$selenium_driven_user->destroy();
		}

		public function setUp()
		{
			self::$selenium_driven_user->goesTo("file://".self::$selenium_test_page_path);
		}

		/**
		 * @test
		 */
		public function shouldSeeShouldRaiseAnExceptionIfElementIsNotThere()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("id('non_existant_id')");
				self::fail("shouldSee should have failed");
			}
			catch(Exception $e){}
		}

		/**
		 * @test
		 */
		public function shouldSeeShouldSucceedWhenElementIsFound()
		{
			self::$selenium_driven_user->shouldSee("//*[id('test_span')]");
		}

		/**
		 * @test
		 */
		public function shouldNotSeeShouldSucceedWhenElementIsNotFound()
		{
		    self::$selenium_driven_user->shouldNotSee("//*[id('id_that_dont_exist')]");
		}

		/**
		 * @test
		 */
		public function shouldNotSeeShouldFailWhenElementIsFound()
		{
		    try
		    {
		        self::$selenium_driven_user->shouldNotSee("//*[id('test_span')]");
		        self::fail("shouldNotSee should have failed");
		    }
		    catch (Exception $e)
		    {
		    }
		}

		/**
		 * @test
		 */
		public function withTextShouldRaiseAnExceptionIfTextDoesNotMatchParameter()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("//span[@id('test_span')]")->withText("Text that isn't there");
				self::fail("withText should have failed");
			}
			catch(Exception $e){}
		}

		/**
		 * @test
		 */
		public function withTextShouldSucceedIfTextMatchesParameter()
		{
			self::$selenium_driven_user->shouldSee("//span[id('test_span')]")->withText("Text");
		}

		/**
		 * @test
		 */
		public function checkedShouldRaiseAnExceptionIfElementIsNotACheckboxOrARadioButton()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("//span[id('test_span')]")->checked();
				self::fail("checked should have failed");
			}
			catch(Exception $e){}
		}

		/**
		 * @test
		 */
		public function checkedShouldSucceedIfElementIsACheckboxThatIsChecked()
		{
			self::$selenium_driven_user->clicks("//input[@name='test_checkbox']");
			self::$selenium_driven_user->shouldSee("//input[@name='test_checkbox']")->checked();

		}

		/**
		 * @test
		 */
		public function checkedShouldSucceedIfElementIsARadiobuttonThatIsChecked()
		{
			self::$selenium_driven_user->clicks("//input[@name='test_radio']");
			self::$selenium_driven_user->shouldSee("//input[@name='test_radio']")->checked();

		}

		/**
		 * @test
		 */
		public function checkedShouldFailIfElementIsAnUncheckedCheckbox()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("//input[@name='test_checkbox']")->checked();
				self::fail("checked should have failed");
			}
			catch(Exception $e){}
		}

		/**
		 * @test
		 */
		public function checkedShouldFailIfElementIsAnUncheckedRadiobutton()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("//input[@name='test_radio']")->checked();
				self::fail("checked should have failed");
			}
			catch(Exception $e){}
		}

		/**
		 * @test
		 */
		public function selectedFailWhenOptionDoesNotExist()
		{
			try
			{
				self::$selenium_driven_user->selects("Unknown Option")->from("test_select");
				self::$selenium_driven_user->shouldSee("//select/option[2]")->selected();
				self::fail("selected should have failed");
			}
			catch(Exception $e){}
		}

		/**
		 * @test
		 */
		public function selectedFailWhenOptionIsNotSelected()
		{
			try
			{
				self::$selenium_driven_user->selects("Option")->from("test_select");
				self::$selenium_driven_user->shouldSee("//select/option[1]")->selected();
				self::fail("selected should have failed");
			}
			catch(Exception $e){}
		}

		/**
		 * @test
		 */
		public function selectedShouldSucceedWhenOptionIsSelected()
		{
				self::$selenium_driven_user->selects("Option 2")->from("test_select");
				self::$selenium_driven_user->shouldSee("//select/option[2]")->selected();
		}


		/**
		 * @test
		 */
		public function waitsForAjaxShouldWaitForAjaxRequestToEndBeforeContinuingWithPrototype()
		{
            $timeout = 2;
			self::$selenium_driven_user->setJavascriptLibrary("Prototype");

			try
			{
				self::$selenium_driven_user->clicks("//a[id('test_Prototype_link')]")
		        ->and_then()->waitsForAjax($timeout);

		        self::fail("the waitForAjax should have timed out");
			}
			catch(SeleniumTimedOutException $e)
	        {}
		}

		/**
		 * @test
		 */
		public function waitsForAjaxShouldWaitForAjaxRequestToEndBeforeContinuingWithjQuery()
		{
			$timeout = 5000;
			self::$selenium_driven_user->setJavascriptLibrary("jQuery");
	        self::$selenium_driven_user->clicks("//a[id('test_jQuery_link')]")
	        ->and_then()->waitsForAjax($timeout);
		}

		/**
		 * @test
		 */
		public function waitsForAjaxShouldThrowAnExceptionWhenItTimesOutWithjQuery()
		{
			$timeout = 0;
			self::$selenium_driven_user->setJavascriptLibrary("jQuery");
	        try
	        {
	        	self::$selenium_driven_user->clicks("//a[id('test_jQuery_link')]")
	        	->and_then()->waitsForAjax($timeout);
	        	self::fail("the waitForAjax should have timed out");
	        }
	        catch(SeleniumTimedOutException $e)
	        {}
		}

		/**
		 * @test
		 */
		public function withValueShouldSucceedIfValueMatchesParameter()
		{
		    self::$selenium_driven_user->fillsOut("//input[@id='test_input_text']")->with("value of input");

			self::$selenium_driven_user->shouldSee("//input[@id='test_input_text']")->withValue("value of input");
		}
	}
?>