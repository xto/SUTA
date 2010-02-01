<?php


require_once 'PHPUnit/Framework.php';

class BDDAsserts extends PHPUnit_Framework_Assert 
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
}



?>
