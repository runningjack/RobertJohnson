<?php
class Empreferee{
	protected static $table_name="employee_referee";
	protected static $db_fields= array("ref_id","emp_id","staff_id","ref_name","ref_off_address","ref_office","ref_phone","ref_email");
	public $ref_id;
	public $emp_id;
    public $staff_id;
	public $ref_name;
	public $ref_off_address;
	public $ref_office;
	public $ref_phone;
	public $ref_email;

	public static function find_all(){
		global $database;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." ");
		return $result_set;
	}
	
	public static function find_by_id($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE ref_id=".$id);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
    
     public static function find_by_empID($empid){
        global $database;
		$result_set =$database->db_query("SELECT * FROM ".self::$table_name." WHERE emp_id='{$empid}'");
        
        $object_array = array();
		while ($row = $database->fetch_array($result_set)) {
		  $object_array[] = self::instantiate($row);
		}
		return $object_array;
	
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
		$article->page_created		=	date("Y-m-d H:i:s");
		$attributes = $this->attributes();
		$sql = "INSERT INTO ".self::$table_name."  (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=")VALUES('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		
		if ($database->db_query($sql)){
			$this->ref_id = $database->insert_id();
			return true;
		}
		else{
			return false;
		}
	}	
	public function update() {
	  global $database;
	  	$this->page_modified = date("Y-m-d H:i:s");
		$attributes = $this->attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE ref_id=". $this->ref_id;
	  $database->db_query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
	public function delete(){
		global $database;
		$sql = "DELETE FROM ".self::$table_name." WHERE ref_id=".$this->ref_id;
		$database->db_query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
}
?>