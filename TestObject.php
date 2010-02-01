<?php
    
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
