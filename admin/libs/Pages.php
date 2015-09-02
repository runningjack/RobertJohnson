<?php

class Pages{

	protected static $table_name="pages";

	protected static $db_fields=array('page_id','page_name','page_title','page_desc','page_content','page_img','page_meta_desc','page_meta_keyword','page_created','page_modified', 'page_template', 'page_hide', 'page_parent', 'page_link', 'page_order');

	public $page_id;

	public $page_title;

	public $page_name;

	public $page_desc;

	public $page_content;

	public $page_img = "";

	public $page_meta_desc;

	public $page_meta_keyword;

	public $page_created;

	public $page_modified;

	public $page_template;

	public $page_hide = 'hide';

	public $page_parent;

	public $page_link;

	public $page_order;

	

	

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

			else {

				$lower = (($id - 1) * SEARCH_NO);

			}

			$upper = SEARCH_NO;			

		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." LIMIT $lower, $upper");

		return $result_set;

	}

	

	public static function find_by_id($id){

		global $database;

		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE page_id=".$id);

		return !empty($result_array) ? array_shift($result_array) : false;

	}

	

	public static function getProductsPage(){

		global $database;

		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE page_link='products'");

		return !empty($result_array) ? array_shift($result_array) : false;

	}
	
	public static function getNewsPage(){

		global $database;

		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE page_link='news'");

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

	

	public static function find_by_column($column){

		global $database;

		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE menu_id=".$column);

		return !empty($result_array) ? array_shift($result_array) : false;

	}

	

	public static function find_by_link($link){

		global $database;

		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE page_link='".$link."' AND page_hide = 'show' AND page_link != 'error'");

		return !empty($result_array) ? array_shift($result_array) : false;

	}

	

	public static function loadError(){

		global $database;

		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE page_link='error'");

		return !empty($result_array) ? array_shift($result_array) : false;

	}

	

	public static function page_exist($link){

		global $database;

		$result =$database->if_exist("SELECT * FROM ".self::$table_name." WHERE page_link='".$link."' AND page_link != 'error'");

		return ($result== true) ? true : false;

	}

	

	public static function find_parent_menus(){

		global $database;

		$result = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE page_parent = 0 AND page_hide = 'show' AND page_id != 7 ORDER BY page_order");

		return $result;

	}

	

	public static function get_sub_menus($id){

		global $database;

		$result = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE page_parent = $id AND page_hide = 'show' AND page_id != 7 ORDER BY page_order");

		return !empty($result) ? $result : false;

	}

	

	public static function get_sub_page($id, $page_name){

		global $database;

		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE page_parent = $id  AND page_link = '".$page_name."' AND page_hide = 'show'");

		return !empty($result_array) ? array_shift($result_array) : false;

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

		$this->page_created		=	date("Y-m-d H:i:s");

		$attributes = $this->attributes();

		$sql = "INSERT INTO ".self::$table_name."  (";

		$sql .= join(", ", array_keys($attributes));

		$sql .=")VALUES('";

		$sql .= join("', '", array_values($attributes));

		$sql .="')"; 

		

		if ($database->db_query($sql)){

			$this->page_id = $database->insert_id();

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

		$sql .= " WHERE page_id=". $this->page_id;

	  $database->db_query($sql);

	  return ($database->affected_rows() == 1) ? true : false;

	}

	public function delete(){

		global $database;

		$sql = "DELETE FROM ".self::$table_name." WHERE page_id=".$this->page_id;

		$database->db_query($sql);

		return ($database->affected_rows() == 1) ? true : false;

	}

}

?>