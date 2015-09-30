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
		/*$pagin = new Pagination();
		$pagin->nr  = $database->dbNumRows($resultUser);
		$pagin->itemsPerPage = 20;*/
		
		$myservices = Cproduct::find_by_sql("SELECT * FROM client_product WHERE client_id='".$_SESSION['client_ident']."'");
		
		$index_array =array( "myservices"=>$myservices,"mypagin"=>"");
		return $index_array;
	}

        public function activate(){
            global $database;
            $error = array();
            $activate = new Activation();

            $input = $_REQUEST;

                if(isset($_POST["contact_name"])){
                    if($_POST['contact_name'] != ""){
                        $activate->contact_name = $_POST['contact_name'];
                    }
                    else array_push($error,"Contact Name");
                }else array_push($error,"Contact Name");
            if(isset($_POST["terminal_id"])){
                if($_POST['terminal_id'] != ""){
                    $activate->contact_name = $_POST['terminal_id'];
                }
                else array_push($error,"Terminal ID");
            }else array_push($error,"Terminal ID");

            if(empty($error)){
                $cproduct= Cproduct::find_by_terminal($_POST['terminal_id']);
                if($cproduct){
                    $cproduct->client_id 					=	$_SESSION["client_ident"];
                    //$cproduct->client_name				=	$_POST["clientname"];

                    $cproduct->terminal_id                  =   $_POST['terminal_id'];
                    $cproduct->prod_name                    =   $_POST['product_name'];
                    $cproduct->branch                       =   $_POST['branch'];
                    $cproduct->atm_type                     =   $_POST['atm_type'];
                    $cproduct->install_status				=	1;
                    $cproduct->status  					    =	1;
                    $cproduct->client_id                    = $_SESSION['client_ident'];
                    $cproduct->install_city                 = $_POST['city'];
                    $cproduct->install_address              = $_POST['location'];
                    $cproduct->install_state                = $_POST['state'];
                    $cproduct->update();
                }else{
                    $cproduct = new Cproduct();
                    $cproduct->client_id 					=	$_SESSION["client_ident"];
                    //$cproduct->client_name				=	$_POST["clientname"];
                    $cproduct->terminal_id                  =   $_POST['terminal_id'];
                    $cproduct->prod_name                    =   $_POST['product_name'];
                    $cproduct->branch                       =   $_POST['branch'];
                    $cproduct->atm_type                     =   $_POST['atm_type'];
                    $cproduct->install_status				=	1;
                    $cproduct->status  					    =	1;
                    $cproduct->datecreated  				=	date("Y-m-d H:i:s");
                    $cproduct->install_city                 = $_POST['city'];
                    $cproduct->install_address              = $_POST['location'];
                    $cproduct->install_state                = $_POST['state'];
                    $cproduct->create();


                }
                if(!empty($input)){
                    foreach($input as $key=>$value){
                        $activate->$key = $value;
                    }
                    $activate->client_id = $_SESSION['client_ident'];
                    $activate->prod_id  = $cproduct->id;
                    $activate->created_at = date("Y-m-d H:i:s");
                    $activate->updated_at = date("Y-m-d H:i:s");
                }
                if($activate->create()){
                    return 1;     //returns 1 on success
                }else{
                    return 2; //unexpected Error
                }
            }else{
               /* $message = "Please check the following errors: ";
                $lenght = count($error);
                for($i = 0; $i < $lenght; $i++){
                    $message = $message.$error[$i].", ";
                }
                echo "<div data-alert class='alert-box error'><a href='#' class='close'>&times;</a>$message</div>";*/

                return 3;

            }
        }


        public function updateActivate(){
            global $database;
            $error = array();
            $activate = Activation::find_by_id($_POST['pgid']);

            $input = $_REQUEST;

            if(isset($_POST["contact_name"])){
                if($_POST['contact_name'] != ""){
                    $activate->contact_name = $_POST['contact_name'];
                }
                else array_push($error,"Contact Name");
            }else array_push($error,"Contact Name");
            if(isset($_POST["terminal_id"])){
                if($_POST['terminal_id'] != ""){
                    $activate->contact_name = $_POST['terminal_id'];
                }
                else array_push($error,"Terminal ID");
            }else array_push($error,"Terminal ID");

            if(empty($error)){
                if(!empty($input)){





                    foreach($input as $key=>$value){
                        $activate->$key = $value;
                    }
                    $activate->client_id = $_SESSION['client_ident'];
                    $activate->updated_at = date("Y-m-d H:i:s");
                }
                if($activate->update()){
                    return 1;     //returns 1 on success
                }else{
                    return 2; //unexpected Error
                }
            }else{
                /* $message = "Please check the following errors: ";
                 $lenght = count($error);
                 for($i = 0; $i < $lenght; $i++){
                     $message = $message.$error[$i].", ";
                 }
                 echo "<div data-alert class='alert-box error'><a href='#' class='close'>&times;</a>$message</div>";*/

                return 3;

            }
        }
        
        public function getData(){
    		global $database;
    		$depts 			= Department::find_all();
    		$role			= Roles::find_all();
            $products        = Product::find_all();
    		$country 		= Country::find_all();
            $services 		= Cproduct::find_by_client($_SESSION["client_ident"]);
            $countAcc       = count(Cproduct::find_by_client($_SESSION["client_ident"]));
            $schedule       = Cproduct::getNextSchedule($_SESSION["client_ident"]);
            $countTic       = count(Ticket::find_by_client($_SESSION['client_ident']));
    		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
    		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"role"=>$role,"countProd"=>$countAcc,"countTick"=>$countTic,"Schel"=>$schedule,"products"=>$products);
    		return $startups;		
    	}

		public function search(){
			$myservices = Cproduct::search(strip_tags($_POST['product']), strip_tags($_POST['serial_no']), strip_tags($_POST['location']), $_POST['date'], $_SESSION['client_ident']);
		
			$index_array =array( "myservices"=>$myservices,"mypagin"=>"");
			return $index_array;
		}
	}
?>