
<?php
require_once("prodpart.php");
class Worksheet{
	protected static $table_name="work_sheet_form";
	protected static $db_fields=array('id','main_id','client_id','prod_id','cse_emp_id','cse_emp_name','formid','prod_name','sheet_date','time_in','time_out','contact_person','problem','cause','corrective_action','part_changed','cse_remark','client_remark','scan_url','datecreated','datemodified','status','part_supplied','fund');
	public $id;
    public $main_id;
    public $client_id;
    public $prod_id;
    public $cse_emp_id;
    public $cse_emp_name;
    public $formid;
    public $prod_name;
    public $sheet_date;
	public $time_in;
	public $time_out;
	public $contact_person;
	public $problem;
	public $cause;
    public $corrective_action;
	public $part_changed;
	public $cse_remark;
	public $client_remark;
	public $scan_url;
    public $datecreated;
    public $datemodified;
    public $status;
    public $part_supplied;
    public $fund;
		
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
    public static function find_by_formid($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE formid=".$id);
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
    
    protected static function getID($prefix,$id){
			$careid = $prefix.str_pad($id, 8, "0", STR_PAD_LEFT);
		    return $careid;
	}
    
    public static function find_by_productid($id) {
		global $database;
		$result_set = $database->db_query("SELECT * FROM ".self::$table_name." WHERE prod_id='".$id."'");
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
		  $object_array[] = self::instantiate($row);
		}
		return $object_array;
  	}
    
    public static function find_by_clientid($id) {
		global $database;
		$result_set = $database->db_query("SELECT * FROM ".self::$table_name." WHERE client_id='".$id."'");
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
		  $object_array[] = self::instantiate($row);
		}
		return $object_array;
  	}
    /**
     * this method getExpensesById receives 1 or two parameters
     * the worksheetid, or date query string in this format "=2014-10-10 or <= 2014-10-10  "
     */
    public static function getExpensesById($id, $date=""){
        global $database;
        $found      = $database->fetch_assoc($database->db_query("SELECT sum(fund) as fund,id FROM ". self::$table_name. " WHERE id=".$id." OR datecreated='".$date."'"));
        $partCost   =   ($database->fetch_assoc($database->db_query("SELECT sum(total_cost) as total,id FROM tbl_part_replace WHERE works_id=".$id." OR datecreated='".$date."'")));
        $expences = $found['fund'] + $partCost['total'];
        return number_format($expences,2,".",",") ;
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
            $this->main_id  =  self::getID("WKS",$this->id) ;
            $this->update();
			return true;
		}
		else{
			return false;
		}
	}	
	public function update() {
	  global $database;
	  	$this->main_id  =  self::getID("WKS",$this->id) ;
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