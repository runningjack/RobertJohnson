<?php
require_once("Database.php");
//$database=new MySQLDatabase;
class Product {
	protected static $table_name="product";
	protected static $db_fields=array('prod_id','prod_name','prod_desc','prod_web_content','prod_image','prod_created', 'prod_modified', 'prod_visible', 'prod_company','prod_series','prod_pdf','prod_cat_id');
	public $prod_id;
	public $prod_name;
	public $prod_desc;
	public $prod_web_content;
	public $prod_image;
	public $prod_created;
	public $prod_modified;
	public $prod_visible;
	public $prod_company;
	public $prod_series;
	public $prod_pdf;
	public $prod_cat_id;
	
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
	
	public static function get_products_by_category($id){
		global $database;
		$sql = "SELECT * FROM ".self::$table_name." WHERE prod_cat_id =".$id;
		$result = self::find_by_sql($sql);
		return $result;
	}
	
	public static function get_showing_products_by_category($id){
		global $database;
		$sql = "SELECT * FROM ".self::$table_name." WHERE prod_visible = 'Show' AND prod_cat_id =".$id;
		$result = self::find_by_sql($sql);
		return $result;
	}
	
	public static function find_by_id($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE prod_id=".$id);
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
		$this->prod_created = date("Y-m-d H:i:s");
		$attributes = $this->attributes();
		$sql = "INSERT INTO ".self::$table_name."  (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=")VALUES('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		
		if ($database->db_query($sql)){
			$this->prod_id = $database->insert_id();
			return true;
		}
		else{
			return false;
		}
	}	
	
	public function update() {
	  global $database;
	  	$this->prod_modified = date("Y-m-d H:i:s");
		$attributes = $this->attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE prod_id=". $this->prod_id;
	  $database->db_query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
	
	public function delete(){
		global $database;
		$sql = "DELETE FROM ".self::$table_name." WHERE prod_id=".$this->prod_id;
		$database->db_query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	
}

?>