<?php
require_once("database.php");
//$database=new MySQLDatabase;
class User {
	
	protected static $table_name="users_client";
	protected static $db_fields=array('user_id','staff_id','fname','lname','address','city','state','country','phone','img_url','email','username','password','web_url','user_role','date_added','date_modified','company_id','company','branch_id','branch');
	public $user_id;
	public $staff_id;
	public $fname;
	public $lname;
	public $email;
	public $phone;
	public $img_url;
	public $address;
	public $city;
	public $state;
	public $country;
	public $username;
	public $password;
	public $web_url;
	public $company_id;
	public $company;
	public $branch_id;
	public $branch;
	public $user_role;
	public $date_added;
	public $date_modified;
	
	
	public $errors = array();
	
	//user photo properties
	public $filename;
	public $temp_path;
	public $size;
	public $type;
	
	public function full_name() {
    if(isset($this->fname) && isset($this->lname)) {
	  $this->fullname=$this->fname . " " . $this->lname;
	 // $this->update();
      return $this->fullname;
    } else {
      return "";
    }
  }
 	public function dir_name(){
	 	$artpos = strpos($this->email,"@");
		return $this->dir_name= substr($this->email,0,$artpos);
  	}
 	public function create_folder(){
	 if(!file_exists("../".$this->dir_name)){
	  mkdir("../".$this->dir_name."/pictures", 0777, true);
	  $this->username = $this->dir_name;
	  
	  return $this->update();
	 }
	 else{
		 return false;
	 }
  	}
	public static function authenticate($username="", $password="") {
		global $database;
		$username = $database->escaped_value($username);
		$password = $database->escaped_value($password);
	
		$sql  = "SELECT * FROM ".self::$table_name." WHERE ((email = '{$username}' or username ='{$username}') AND password = '{$password}')";
		
		$result_array = self::find_by_sql($sql);
			return !empty($result_array) ? array_shift($result_array) : false;
	}
	public static function authenticate2($username="", $password="") {
		global $database;
		$username = $database->escaped_value($username);
		$password = $database->escaped_value($password);
	
		$sql  = "SELECT * FROM ".self::$table_name." WHERE ((email = '{$username}' or username ='{$username}') AND password = '{$password}' AND user_type='Administrator')  ";
		
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
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE user_id=".$id);
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
		$attributes = $this->attributes();
		$sql = "INSERT INTO ".self::$table_name."  (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=")VALUES('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		
		if ($database->db_query($sql)){
			$this->user_id = $database->insert_id();
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
		$sql .= " WHERE user_id=". $this->user_id;
	  $database->db_query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
	public function delete(){
		global $database;
		$sql = "DELETE FROM ".self::$table_name." WHERE user_id=".$this->user_id;
		$database->db_query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	
}
$user = new User();

?>