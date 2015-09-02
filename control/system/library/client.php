<?php
class Client{
	protected static $table_name="tbl_client";
	protected static $db_fields=array('id','main_id','name','addy','phone','email','descr','visible','username','password');
	public $id;
    public $main_id;
    public $name;
	public $addy;
	public $phone;
	public $email;
	public $descr;
	public $visible;
	public $username;
	public $password;
	
    
    
    public static function authenticate($username="", $password="") {
		global $database;
		$username = $database->escaped_value($username);
		$password = $database->escaped_value($password);
	
		$sql  = "SELECT * FROM ".self::$table_name." WHERE ((email = '{$username}' or username ='{$username}') AND password = '{$password}')";
		
		$result_array = self::find_by_sql($sql);
			return !empty($result_array) ? array_shift($result_array) : false;
	}
    	
	public static function find_all(){
		global $database;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." ");
		return $result_set;
	}
	
	public static function find_by_id($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id=".$id);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function getShowing(){
		global $database;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE visible = 'show' ");
		return $result_set;
	}
	
    public static function find_by_clientname($clientname){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE name='".$clientname."'");
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
    
    
    public static function getID2($prefix,$tbl,$phone){
		global $database;
		$sql=("INSERT INTO ".$tbl." (name) VALUE('". $phone ."')");
		if ($database->db_query($sql)){
			$dbdata = $database->insert_id();
			$careid = $prefix.str_pad($dbdata, 5, "0", STR_PAD_LEFT);
			 return $careid;
		}
		else{
			return false;
		}
	}
    
    
    public static function getID($prefix,$id){
			$careid = $prefix.str_pad($id, 5, "0", STR_PAD_LEFT);
		    return $careid;
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
	
	protected function array_attributes($tblarray){
		$array_attributes = array();
		foreach($tblarray as $field){
				$attributes[$field] = $field;
		}
		return $attributes;
	}
	
	public function create(){
		global $database;
		$attributes = $this->attributes();
		$sql = "INSERT INTO ".self::$table_name."  (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		//echo $sql;
		
		if ($database->db_query($sql)){
			$this->id = $database->insert_id();
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
		$sql .= " WHERE id=". $this->id;
	  $database->db_query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
	public function delete(){
		global $database;
		$sql = "DELETE FROM ".self::$table_name." WHERE id=".$this->id;
		$database->db_query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
}
?>