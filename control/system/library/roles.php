<?php
class Roles{
	protected static $table_name="roles";
	protected static $db_fields=array('role_id','main_id','role_name','role_description','date_created','date_modified');
	public $role_id;
    public $main_id;
	public $role_name;
	public $role_description;
	public $date_created;
	public $date_modified;
	
	public function create(){
		global $database;
		$attributes = $this->attributes();
		$sql = "INSERT INTO ".self::$table_name."  (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=")VALUES('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		
		if ($database->db_query($sql)){
			$this->role_id = $database->insert_id();
            $this->main_id  =  self::getID("ROL",$this->role_id) ;
            $this->update();
			return true;
		}
		else{
			return false;
		}
	}
	public static function find_all(){
		global $database;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." ");
		return $result_set;
	}
	
	public static function find_by_id($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE role_id=".$id);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
    
    public static function find_by_mainid($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE main_id='".$id."'");
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
    
    
    protected static function getID($prefix,$id){
			$careid = $prefix.str_pad($id, 4, "0", STR_PAD_LEFT);
		    return $careid;
	}
		
	
	public function update() {
	  global $database;
      $this->main_id  =  self::getID("ROL",$this->role_id) ;
		$attributes = $this->attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE role_id=". $this->role_id;
	  $database->db_query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
    
    public function delete(){
		global $database;
		$sql = "DELETE FROM ".self::$table_name." WHERE role_id=".$this->role_id;
		$database->db_query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
}
?>