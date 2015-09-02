<?php

require_once("config.php");



class Database {

	private $connection;

	private $magic_quote_active;

	private $new_enough_php;

	public $connect_id;

	public  $db_table;

	public  $tbl_fields=array();

	public  $tbl_fields_values=array();

	

	function __construct(){

		$this->open_connection();

		$this->magic_quote_active = get_magic_quotes_gpc();

		$this->new_enough_php = function_exists("mysql_real_escape_string");

	}

	public function open_connection(){

		$this->connection = @mysql_connect(SERVER_NAME,DB_USER_NAME,DB_PASS);

		if (!$this->connection) {

			die("Database connection failed: " . mysql_error());

		}

		else{

			$select_db=mysql_select_db(DB_NAME,$this->connection);

			if(!$select_db){

				die("Database selection faild: " .mysql_error());

			}

			

		}

	}

	public function affected_rows() {

    return mysql_affected_rows($this->connection);

  }

	

	public function db_query($sql){

		$result = mysql_query($sql, $this->connection);

		$this->confirm_query($result);

		//$this->connect_id = mysql_insert_id($this->connection);

		return $result;

	}

	private function confirm_query($result){

		if(!$result		){

			die("Query failed: " .mysql_error());

		}

	}

	public function fetch_array($result_set){

		return mysql_fetch_array($result_set);

	}

	public function fetch_assoc($result_set){

		return mysql_fetch_assoc($result_set);

	}

	public function insert_id(){

		return mysql_insert_id($this->connection);

	}

	public function dbNumRows($result){ 

			return mysql_num_rows($result);

	}

	public function if_exist($sql) {

		$all_programmes = $this->db_query($sql);

		confirm_query($all_programmes);

		$rowexist = $this->dbNumRows($all_programmes);

		if ($rowexist >= 1 ){

			return true;

		}

		else{

			return false;

		}

	}

	public function escaped_value($value){

		 // i.e php >= v4.30 

		if($this->new_enough_php){ //PHP v4.30 or higher

			//undo

			if($this->magic_quote_active) { 

				$value = stripslashes($value); 

			}

			$value=mysql_real_escape_string($value);

		}

		else{ // before PHP v4.30

			if(!$this->magic_quote_active) { $value=addslashes($value); }

		}

				

	return $value;

	}

	public function close_connection(){

		if(isset($this->connection)){

			mysql_close($this->connection);

			unset($this->connection);

		}

		

	}

	

	public function insert(){

		$sql = "INSERT INTO ".$this->db_table."  (";

		$sql .= join(", ", array_keys($this->tbl_fields));

		$sql .=")VALUES('";

		$sql .= join("', '", array_values($this->tbl_fields_values));

		$sql .="')"; 

		

		if ($this->db_query($sql)){

			//$this->dept_id = $this->insert_id();

			return true;

		}

		else{

			return false;

		}

	}

	public function insert2(){

		$sql = "INSERT INTO ".$this->db_table."  (";

		$sql .= join(", ", array_keys($this->tbl_fields));

		$sql .=")VALUES('";

		$sql .= join("', '", array_values($this->tbl_fields_values));

		$sql .="')"; 

		

		if ($this->db_query($sql)){

			//$this->dept_id = $this->insert_id();

			return true;

		}

		else{

			return false;

		}

	}

}

$database = new Database();

?>