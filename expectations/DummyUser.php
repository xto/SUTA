  

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

    class DummyUser
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
        
        public function __toString()
        {
        	return $this->__name;
        }
    }

?>