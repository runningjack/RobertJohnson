<?php
class General_Model extends Model{
    function __construct()
	{
		parent::__construct();
	}
    
    
     /**
     * load initail data for employee form needed during 
     * creating and editing employee
     * data 
     */
	public function getData(){
		global $database;
		$depts 			= Department::find_all();
		$role			= Roles::find_all();
		$country 		= Country::find_all();
        $employee 		= Employee::find_all();
		$zone 			= Zone::find_by_sql("SELECT * FROM zone WHERE country_id=156");
		$startups 		= array("departs"=>$depts,"country"=>$country,"state"=>$zone,"employee"=>$employee,"role"=>$role);
		return $startups;		
	}
    
    
    /**
     * use with jquery to porpulate the local government  
     * listitem in  form 
     */
	public function lga($state_id){
        if(!empty($state_id)){
            return Lga::find_by_sql("SELECT * FROM lgas WHERE zone_id='".$state_id."'");
        }
    }
    
    
    public function state($country_id){
        if(!empty($country_id)){
            //$cid = explode(",",$_POST[])
            return Zone::find_by_sql("SELECT * FROM zone WHERE country_id=$country_id");
        }
    }
}
?>