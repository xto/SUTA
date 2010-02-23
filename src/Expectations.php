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

	require_once 'PHPUnit/Framework.php';

	class Expectations extends PHPUnit_Framework_Assert
	{
        public static function shouldBeTrue($value, $message="")
        {
            self::assertThat($value, self::isTrue(), $message);
        }

        public static function shouldBeFalse($value, $message="")
        {
            self::assertThat($value, self::isFalse(), $message);
        }

        public static function shouldEqual($actual, $expected, $message = '')
        {
            self::assertEquals($expected, $actual, $message);
        }

	    public static function shouldNotEqual($actual, $expected, $message = '')
        {
            self::assertNotEquals($expected, $actual, $message);
        }
        public static function shouldBeNull($value, $message = '')
        {
            self::assertNull($value, $message);
        }

        public static function shouldNotBeNull($value, $message = '')
        {
            self::assertNotNull($value, $message);
        }

        public static function shouldContain($pattern, $value, $message = '')
        {
            self::assertContains($pattern, $value, $message);
        }

	    public static function shouldNotContain($pattern, $value, $message = '')
        {
            self::assertNotContains($pattern, $value, $message);
        }
        
        public static function shouldRaiseException($actual, $expected, $message="")
        {
        	self::assertEquals(get_class($actual),get_class($expected), $message);
        }

	}



?>
