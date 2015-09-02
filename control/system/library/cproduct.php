<?php
class Cproduct{
	protected static $table_name="client_product";
	protected static $db_fields=array("id","main_id","client_id","client_name","prod_id","prod_name","prod_serial","prod_ISDN","install_address","install_country","install_state","install_area_id","install_area","install_city","install_status","branch","os","atm_type","selling_price","datecreated","datemodified","sign_off_date","last_maint_date","next_maint_date");
	
	public $id;
    public $main_id;
	public $client_id;
	public $client_name;
	public $prod_id;
	public $prod_name;
	public $prod_serial;
	public $prod_ISDN;
	public $install_address;
	public $install_country;
	public $install_state;
    public $install_area_id;
    public $install_area;
	public $install_city;
	public $install_status;
	public $status;
    public $branch;
    public $os;
    public $atm_type;
    public $selling_price;
	public $datecreated;
	public $datemodified;
    public $sign_off_date;
    public $last_maint_date;
    public $next_maint_date;

		
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
    
    
    public static function find_by_mainid($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE main_id='".$id."'");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
    
    
    public static function find_by_client($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE client_id='".$id."'");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
    
    protected static function getID($prefix,$id){
			$careid = $prefix.str_pad($id, 8, "0", STR_PAD_LEFT);
		    return $careid;
	}
    
    
    public static function getID2($prefix,$tbl,$phone){
		global $database;
		$sql=("INSERT INTO ".$tbl." (name) VALUE('". $phone ."')");
		if ($database->db_query($sql)){
			$dbdata = $database->insert_id();
			$careid = $prefix.str_pad($dbdata, 8, "0", STR_PAD_LEFT);
			 return $careid;
		}
		else{
			return false;
		}
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
		$sql .=") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		//echo $sql;
		
		if ($database->db_query($sql)){
			$this->id = $database->insert_id();
            $this->main_id  =  self::getID("CPD",$this->id) ;
            $this->update();
			return true;
		}
		else{
			return false;
		}
	}
    	
	public function update() {
	  global $database;
	  	$this->main_id  =  self::getID("CPD",$this->id) ;
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