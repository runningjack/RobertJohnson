<?php
	class Services_Model extends Model{
        public function __construct(){
    		parent::__construct();
    	}
        
        public function getById($id){
    		return Client::find_by_id($id);
           // $myaccount = Accounts::find_by_phone($phone);
           
    	}
        
        public function getList($id="",$pg){
		 $purl = array();
		if(isset($_GET['url'])){
			
			$purl	=	$_GET['url'];
			$purl	=	rtrim($purl);
			$purl	=	explode('/',$_GET['url']);
			
			
		}else{
			$purl =null;
			
		}
		if(!isset($purl['2'])){
			$pn = 1;
		}else{
		$pn = $purl['2'];
		}
		
		global $database;
		$resultUser = $database->db_query("SELECT * FROM client_product WHERE client_id='".$_SESSION['client_ident']."'");
		$pagin = new Pagination();
		$pagin->nr  = $database->dbNumRows($resultUser);
		$pagin->itemsPerPage = 20;
		
		$myservices = Cproduct::find_by_sql("SELECT * FROM client_product WHERE client_id='".$_SESSION['client_ident']."'".$pagin->pgLimit($pn));
		
		$index_array =array( "myservices"=>$myservices,"mypagin"=>$pagin->render($pg));
		return $index_array;
	}
        
        public function getData(){
    		global $database;
    		$depts 			= Department::find_all();
    		$role			= Roles::find_all();
    		$country 		= Country::find_all();
            $services 		= Cproduct::find_by_client($_SESSION["client_ident"]);
            $countAcc       = count(Cproduct::find_by_client($_SESSION["client_ident"]));
            $schedule       =  Cproduct::getNextSchedule($_SESSION["client_ident"]);
            $countTic       = count(Ticket::find_by_client($_SESSION['client_ident']));
    		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
    		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"role"=>$role,"countProd"=>$countAcc,"countTick"=>$countTic,"Schel"=>$schedule);
    		return $startups;		
    	}
		
		public function search(){
			$myservices = Cproduct::search(strip_tags($_POST['product']), strip_tags($_POST['serial_no']), strip_tags($_POST['location']), $_POST['date'], $_SESSION['client_ident']);
		
			$index_array =array( "myservices"=>$myservices,"mypagin"=>"");
			return $index_array;
		}
	}
?>