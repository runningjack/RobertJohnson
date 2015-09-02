<?php
class Person{
	public $fname;
	public $lname;
	public $mname;
	public $email;
	public $phone;
	public $img_url;
	public $address;
	public $city;
	public $state;
	public $gender;
	public $title;
	public $occupation;
	public $lga;
	public $country;
	public $username;
	public $password;
	public $fullname;
	public $kin_fname;
	public $kin_lname;
	public $kin_gender;
	public $kin_address;
	public $kin_phone;
	public $kin_email;
	public $kin_relationship;
	
	public $prefix= "CN/CC/";
	public $tblname = "tblcareid";
	
	public function fullname(){
		if(isset($this->fname) && isset($this->lname)) {
		$this->fullname=$this->fname . " ". $this->mname." " . $this->lname;
		  return $this->fullname;
		} else {
		  return "";
		}
	}
	
	public function getID(){
		global $database;
		$sql=("INSERT INTO ".$this->tblname." (name) VALUE('". $this->phone ."')");
		if ($database->db_query($sql)){
			$dbdata = $database->insert_id();
			$careid = $this->prefix.str_pad($dbdata, 6, "0", STR_PAD_LEFT);
			 return $careid;
		}
		else{
			return false;
		}
	}
    
    	public static function getID2($prefix,$tbl,$phone){
		global $database;
		$sql=("INSERT INTO ".$tbl." (name) VALUE('". $phone ."')");
		if ($database->db_query($sql)){
			$dbdata = $database->insert_id();
			$careid = $prefix.str_pad($dbdata, 6, "0", STR_PAD_LEFT);
			 return $careid;
		}
		else{
			return false;
		}
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
 

}
?>