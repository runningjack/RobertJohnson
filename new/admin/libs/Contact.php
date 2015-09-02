<?php
require_once("Database.php");
//$database=new MySQLDatabase;
class Contact {
	protected static $table_name="contact";
	protected static $db_fields=array('c_id','c_name','c_email','c_phone','c_comment','c_created');
	public $c_id;
	public $c_name;
	public $c_email;
	public $c_phone;
	public $c_comment;
	public $c_created;
	
	public static function find_all(){
		global $database;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." ");
		return $result_set;
	}
	
	public static function find_order_limit($id){
		global $database;
			if($id == 1){
				$lower = 0;	
			}
			else $lower = (($id - 1) * SEARCH_NO) - 1;
			$upper = $id * SEARCH_NO;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." LIMIT $lower, $upper");
		return $result_set;
	}
	
	public static function find_by_id($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE c_id=".$id);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_sql($sql="") {
		global $database;
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
		$this->c_created = date("Y-m-d H:i:s");
		$attributes = $this->attributes();
		$sql = "INSERT INTO ".self::$table_name."  (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=")VALUES('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		
		if ($database->db_query($sql)){
			$this->cv_id = $database->insert_id();
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
		$sql .= " WHERE c_id=". $this->c_id;
	  $database->db_query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
	public function delete(){
		global $database;
		$sql = "DELETE FROM ".self::$table_name." WHERE c_id=".$this->c_id;
		$database->db_query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	
}

?>