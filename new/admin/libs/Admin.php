<?php
require_once("Database.php");
//$database=new MySQLDatabase;
class Admin {
	protected static $table_name="admin";
	protected static $db_fields=array('admin_id','admin_name','admin_email','admin_password','admin_role');
	public $admin_id;
	public $admin_name;
	public $admin_email;
	public $admin_password;
	public $admin_role;
	
	public static function login($email, $password){
		global $database;
		$sql = "SELECT * FROM ".self::$table_name." WHERE admin_email= '".$email."' AND admin_password = '".$password."'";
		$result_array =self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;		
	}
	
	public static function find_all(){
		global $database;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." ");
		return $result_set;
	}
	
	public static function find_by_id($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE admin_id=".$id);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_order_limit($id){
		global $database;
			if($id == 1){
				$lower = 0;	
			}
			else {
				$lower = (($id - 1) * SEARCH_NO);
			}
			$upper = SEARCH_NO;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." LIMIT $lower, $upper");
		return $result_set;
	}
	
	public static function find_by_sql($sql="") {
		$database = new Database;
		$result_set = $database->db_query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
		  $object_array[] = self::instantiate($row);
		}
		return $object_array;
  	}
	
	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  $object_vars = $this->attributes();
	  return array_key_exists($attribute, $object_vars);
	}

	protected function attributes(){
		//return get_object_vars($this);
		$attributes = array();
		foreach(self::$db_fields as $field){
			if(property_exists($this,$field)){
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	public function create(){
		global $database;
		$attributes = $this->attributes();
		$sql = "INSERT INTO ".self::$table_name."  (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=")VALUES('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		
		if ($database->db_query($sql)){
			$this->admin_id = $database->insert_id();
			return true;
		}
		else{
			return false;
		}
	}	
	
	public function update() {
	  global $database;
		$attributes = $this->attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE admin_id=". $this->admin_id;
	  $database->db_query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
	public function delete(){
		global $database;
		$sql = "DELETE FROM ".self::$table_name." WHERE admin_id=".$this->admin_id;
		$database->db_query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	
}

?>