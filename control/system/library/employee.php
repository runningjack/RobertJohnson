<?php
class Employee{
	protected static $table_name="employee";
	protected static $db_fields=array('id','emp_id','emp_lname','emp_mname','emp_fname','emp_sex','emp_mstatus','emp_religion','emp_dob','emp_nationality','emp_soo','emp_lga','emp_email','emp_phone','emp_address','emp_date_employed','emp_date_terminate','emp_dept','emp_post_id','emp_post','emp_type','emp_uname','emp_pword','emp_qualification','datecreated','datemodified','img_url','emp_status');
	public $id;
	public $emp_id;
	public $emp_lname;
	public $emp_mname;
	public $emp_fname;
	public $emp_sex;
	public $emp_mstatus;
	public $emp_religion;
	public $emp_dob;
	public $emp_nationality;
	public $emp_soo;
	public $emp_lga;
	public $emp_email;
	public $emp_phone;
	public $emp_address;
	public $emp_date_employed;
	public $emp_date_terminate;
    public $emp_dept;
    public $emp_post_id;
    public $emp_post;
	public $emp_type;
    public $emp_uname;
    public $emp_pword;
	public $emp_qualification;
	public $datecreated;
	public $datemodified;
	public $img_url;
	public $emp_status;

	/**
	 * This section is used to auto generate 
     * employee id (Staff ID)
	 */
    
    public static function getID2($prefix,$tbl,$phone){
		global $database;
		$sql=("INSERT INTO ".$tbl." (name) VALUE('". $phone ."')");
		if ($database->db_query($sql)){
			$dbdata = $database->insert_id();
			$careid = $prefix.str_pad($dbdata, 4, "0", STR_PAD_LEFT);
			 return $careid;
		}
		else{
			return false;
		}
	}
    /**
     * this section is required to authenticate
     * an employee
     */
    public static function authenticate($username="", $password="") {
		global $database;
		$username = $database->escaped_value($username);
		$password = $database->escaped_value($password);
	
		$sql  = "SELECT * FROM ".self::$table_name." WHERE ((emp_email = '{$username}' or emp_uname ='{$username}') AND emp_pword = '".crypt($password,'$2a$07$usesomesillystringforsalt$')."')";
		
		$result_array = self::find_by_sql($sql);
			return !empty($result_array) ? array_shift($result_array) : false;
	}
	
    /**
     * this section is used to autogenerate
     * password to employee
     */
    public static function find_by_staff_id($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE emp_id='".$id."'");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
    
    public static function generatePassword($length=9, $strength=1) {
    	$vowels = 'aeuy';
    	$consonants = 'bdghjmnpqrstvz';
    	if ($strength & 1) {
    		$consonants .= 'BDGHJLMNPQRSTVWXZ';
    	}
    	if ($strength & 2) {
    		$vowels .= "AEUY";
    	}
    	if ($strength & 4) {
    		$consonants .= '23456789';
    	}
    	if ($strength & 8) {
    		$consonants .= '@#$%';
    	}
     
    	$password = '';
    	$alt = time() % 2;
    	for ($i = 0; $i < $length; $i++) {
    		if ($alt == 1) {
    			$password .= $consonants[(rand() % strlen($consonants))];
    			$alt = 0;
    		} else {
    			$password .= $vowels[(rand() % strlen($vowels))];
    			$alt = 1;
    		}
    	}
    	return $password;
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
		$sql .=")VALUES('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		
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
$employee = new Employee();
?>