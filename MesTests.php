<?php
/*
    Copyright 2010 Nicholas Lemay, Xavier Tô, Francis Falardeau

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/    
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
