<?php
class Dashboard_Model extends Model{
	function __construct(){
		parent::__construct();
		
	}
	
	 public function getData(){
		global $database;
		$depts 			= Department::find_all();
		$role			= Roles::find_all();
		$country 		= Country::find_all();
        $vendors 		= Vendor::find_all();
        $countAcc       = count(Cproduct::find_by_client($_SESSION["client_ident"]));
        $schedule       =  Cproduct::getNextSchedule($_SESSION["client_ident"]);
        $countTic       = count(Ticket::find_by_client($_SESSION['client_ident']));
		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"role"=>$role,"countProd"=>$countAcc,"countTick"=>$countTic,"Schel"=>$schedule);
		return $startups;		
	}
	
	 public function getById($id){
		return Client::find_by_id($id);
       // $myaccount = Accounts::find_by_phone($phone);
       
	}
}
?>