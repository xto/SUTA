<?php
    
    require_once 'TestObject.php';
    
    class MesTests extends PHPUnit_Framework_TestCase
    {
        /**
        * @test
        */
        public function UsersRegistrationShouldBeSetProperlyWhenSetToTrue()
        {
            $nicholas = new TestObject(new User("Nicholas",true));
            $nicholas->isRegistered()->shouldBeTrue();
        }
        
        /**
        * @test
        * Test that fails on purpose
        */
        public function UsersRegistrationShouldBeSetProperlyWhenSetToFalse()
        {
            $nicholas = new TestObject(new User("Nicholas",true));
            $nicholas->isRegistered()->shouldBeFalse("Wow I Miss my python syntax");
        }
        
        /**
        * @test
        * 
        */
        public function UsersNameShouldBeSetProperly()
        {
            $nicholas = new TestObject(new User("Nicholas",true));
            $nicholas->getName()->shouldEqual("Nicholas");
        }
        
    }

?>
