<?php
class Sign_off{
	protected static $table_name="sign_off_form";
	protected static $db_fields=array('id','main_id','prod_id','prod_name','form_id','client_id','client_name','mag_stripe','verve_card','master_card','visa_card','withdraw','withdraw_comment','balance','balance_comment','statement','statement_comment','transfer','transfer_comment','pin_change','pin_change_comment','mobile_recharge','mobile_recharge_comment','part_replace','camera_instal','inverter_status','AC_status','ATM_room_cond','cse_remark','client_remark','employee_id','employee_name','scan_url','datecreated','datemodified','status');
	public $id;
    public $main_id;
    public $prod_id;
    public $prod_name;
    public $form_id;
    public $client_id;
    public $client_name;
	public $mag_stripe;
	public $verve_card;
	public $master_card;
	public $visa_card;
	public $withdraw;
	public $withdraw_comment;
    public $balance;
	public $balance_comment;
	public $statement;
	public $statement_comment;
	public $transfer;
	public $transfer_comment;
	public $pin_change;
    public $pin_change_comment;
	public $mobile_recharge;
	public $mobile_recharge_comment;
	public $camera_instal;
	public $inverter_status;
	public $AC_status;
	public $ATM_room_cond;
    public $cse_remark;
	public $client_remark;
	public $employee_id;
    public $employee_name;
	public $scan_url;
    public $datecreated;
    public $datemodified;
    public $status;
    
    
    public static function getID2($prefix="WKS",$tbl,$phone){
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
    protected static function getID($prefix,$id){
			$careid = $prefix.str_pad($id, 8, "0", STR_PAD_LEFT);
		    return $careid;
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
            $this->main_id  =  self::getID("SGNF",$this->id) ;
            $this->update();
			return true;
		}
		else{
			return false;
		}
	}	
	public function update() {
	  global $database;
	  	$this->main_id  =  self::getID("SGNF",$this->id) ;
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