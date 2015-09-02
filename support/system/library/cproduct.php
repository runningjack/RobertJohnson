<?php

class Cproduct{

	protected static $table_name="client_product";
	protected static $db_fields=array("id","terminal_id","atm_type","client_id","client_name","prod_id","prod_name","prod_serial","prod_ISDN","install_address","install_country","install_state","install_city","install_status","selling_price","datecreated","datemodified","sign_off_date","last_maint_date","next_maint_date");
	public $id;
    public $terminal_id;
    public $atm_type;
	public $client_id;
	public $client_name;
	public $prod_id;
	public $prod_name;
	public $prod_serial;
	public $prod_ISDN;
	public $install_address;
	public $install_country;
	public $install_state;
	public $install_city;
	public $install_status;
	public $status;
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

	

	public static function find_by_client($id){

		global $database;

		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE client_id='".$id."'");

		return $result_set;

	}
	
	public static function getDistinctProducts($id){
		global $database;
		$result_set = $database->db_query("SELECT DISTINCT (prod_id) AS prod_id FROM client_product WHERE client_id = ".$id);
		return $result_set;
	}
	
	public function search($product, $serial_no, $location, $date, $client_id){
		$query = array();
		if($product != ""){
			array_push($query,"prod_name LIKE '%$product%'");
		}
		if($serial!=""){
			array_push($query,"prod_serial ='$serial_no'");
		}
		if($location!=""){
			array_push($query,"install_address LIKE '%$location%'");
		}
		if($date!=""){
			$new_date = date_format(new DateTime($date),"Y-m-d H:i:s");
			array_push($query,"sign_off_date = '$new_date'");
		}
				
		$lenght = count($query);
		$sql = "SELECT * FROM ".self::$table_name." WHERE";
		if($lenght!= 0){
			for($i = 0; $i < $lenght; $i++){				
				$sql .= " ".$query[$i]. " AND";
			}
		}
		$sql .= " client_id = '".$client_id."'";
		$result_array =self::find_by_sql($sql);
		return !empty($result_array) ? $result_array : false;
	}

    public static function getNextSchedule($id){
        global $database;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE client_id='".$id."' AND next_maint_date > '".date('Y-m-d h:i:s', time())."'");
		return $result_set;
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