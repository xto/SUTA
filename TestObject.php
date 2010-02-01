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
    require_once 'BDDAsserts.php';
    
    class User
    {
        private $__name;
        private $__registered;
        
        public function __construct($name,$registered)
        {
            $this->__name = $name;
            $this->__registered = $registered;
        }

        public function getName()
        {
            return $this->__name;
        }
        
        public function isRegistered()
        {
            return $this->__registered;
        }
    }

    class TestObject{

        private $__objectToTest;

        public function __construct($objectToTest)
        {
            $this->__objectToTest = $objectToTest;         
        }

        function __call($method_name, $args)
        {
            if(method_exists($this->__objectToTest, $method_name))
            {
	            return new TestObject(call_user_func_array( array($this->__objectToTest,$method_name), $args));
            }
            else if(method_exists(BDDAsserts, $method_name))
            {
                array_unshift($args,$this->__objectToTest);                
                return call_user_func_array( array(BDDAsserts,$method_name), $args);
            }
            else
            {
                throw new Exception('Unknown method '.$method_name."called on ".get_class($this->__objectToTest)." instance.");	
            }
        }

	    public function __toString()
	    {
	        return (string)$this->__objectToTest;
	    }

    }
    


?>
