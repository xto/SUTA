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
    require_once dirname(__FILE__).'/Expectations.php';

    class TestSubject{

        private $__subject;

        public function __construct($subject)
        {
            $this->__subject = $subject;

        }

        function __call($method_name, $args)
        {
            if(method_exists($this->__subject, $method_name))
            {
	            return new TestSubject(call_user_func_array( array($this->__subject, $method_name), $args));
            }
            else if(method_exists(Expectations, $method_name))
            {
                array_unshift($args,$this->__subject);
                return call_user_func_array( array(Expectations, $method_name), $args);
            }
            else
            {
                throw new Exception('Unknown method '.$method_name."called on ".get_class($this->__subject)." instance.");
            }
        }

	    public function __toString()
	    {
	        return (string)$this->__subject;
	    }

    }

?>
