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
	
    require_once 'src/TestSubject.php';
    require_once 'DummyUser.php';
    
    class TestSubjectExpectations extends PHPUnit_Framework_TestCase
    {
        /**
        * @test
        */
        public function TestSubjectShouldSupportShouldBeTrueExpectation()
        {
            $nicholas = new TestSubject(new DummyUser("Nicholas",true));
            $nicholas->isRegistered()->shouldBeTrue();
        }
        
        /**
        * @test
        */
        public function TestSubjectShouldSupportShouldBeFalseExpectation()
        {
            $nicholas = new TestSubject(new DummyUser("Nicholas",false));
            $nicholas->isRegistered()->shouldBeFalse();
        }
        
        /**
        * @test
        */
        public function TestSubjectShouldSupportShouldEqualExpectation()
        {
            $nicholas = new TestSubject(new DummyUser("Nicholas",true));
            $nicholas->getName()->shouldEqual("Nicholas");
        }
        
        /**
        * @test
        */
        public function TestSubjectShouldSupportToStringInOrderToSupportDebug()
        {
            $nicholas = new TestSubject(new DummyUser("Nicholas",true));
            self::assertEquals($nicholas->__toString(), "Nicholas");
        }
        
        
        
    }

?>
