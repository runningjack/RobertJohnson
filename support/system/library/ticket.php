<?php

	class Ticket{

	   protected static $table_name="support_ticket";

	   protected static $db_fields=array("id","terminal_id","atm_type","branch","client_id","contact_name","contact_email","contact_phone","prod_id","prod_name","location","priority","subject","department","issue","datecreated","datemodified","status");

       

       public $id;

        public $terminal_id;

        public $atm_type;

        public $branch;

       public $client_id;

	   public $contact_name;

       public $contact_email;

       public $contact_phone;

       public $prod_id;

	   public $prod_name;

       public $location;

       public $priority;

	   public $subject;

       public $department;

       public $issue;

       public $datecreated;

       public $datemodified;

       public $status;

       

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
	
	public function search($subject, $id, $prod_name, $priority, $dept, $status, $client_id){
		$query = array();
		if($subject != ""){
			array_push($query,"subject LIKE '%$subject%'");
		}
		if($id!=""){
			array_push($query,"id LIKE '%$id%'");
		}
		if($prod_name!=""){
			array_push($query,"prod_name LIKE '%$prod_name%'");
		}
		if($priority!=""){
			array_push($query,"priority LIKE '%$priority%'");
		}
		if($dept!=""){
			array_push($query,"department = '$dept'");
		}
		if($status!=""){
			array_push($query,"status = '$status'");
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

		$database = new Database;

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