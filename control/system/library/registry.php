<?php

class Registry{
    
    public static $instance;
    public static $objects = array();
    public static $settings = array("config" => array(), "autoload" => array(), "system" => array());
    public static $uri = array();
    public static $raw_uri;
	private $data = array();
	
	public static function singleton(){
		if(empty(self::$instance)){
			$obj = __CLASS__;
			self::$instance = new $obj;
			return self::$instance;
		}
	}
    
    public function get($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : NULL);
	}

	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	public function has($key) {
    	return isset($this->data[$key]);
  	}
    
    public static function instance($class_name){
        if(empty($objects[$class_name])){
            self::$objects[$class_name]= new $class_name;
        }
        return self::$instance;
    }
    
    
    
    
}
?>