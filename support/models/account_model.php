<?php
class Account_Model extends Model{
    function __construct(){
		parent::__construct();
	}
    
    public function getById($id){
		return Client::find_by_id($id);
       // $myaccount = Accounts::find_by_phone($phone);
       
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
    
    
    public function update()
    {
        if( !empty($_POST['cname']) && !empty($_POST['cphone']) && !empty($_POST['cemail'])){
            $thisClient                     =   Client::find_by_id((int)preg_replace('#[^0-9]#i','',$_SESSION['client_ident']));
        	$error = array();
			if(ctype_digit($_POST["cphone"])==false){
				array_push($error,"Phone Number entered is incorrect");
			}else $thisClient->contact_phone          =       $_POST["cphone"];
			if(!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST["cemail"])){
				array_push($error,"Email entered is incorrect");
			}else $thisClient->contact_email  =       $_POST["cemail"];
            if(strlen($_POST["cname"])<3){
				array_push($error,"Name entered is incorrect");
			}else $thisClient->contact_name =  strip_tags($_POST["cname"]);
        	
			if(!empty($error)){
				$message = "Please check the following errors:<br /> ";
				$lenght = count($error);
				for($i = 0; $i < $lenght; $i++){
					$message = $message.$error[$i]."<br />";
				}
                echo "<div data-alert class='alert-box error'><a href='#' class='close'>&times;</a>$message</div>";
                exit;
            }           
            
            if($thisClient->update()){
                return 1;
            }else{
                  return 2;
            }
        }
        /**
         * Section to update password
         * for client
         */
        if( !empty($_POST['opword']) && !empty($_POST['pword'])){
            $thisClient                     =   Client::find_by_id((int)preg_replace('#[^0-9]#i','',$_SESSION['client_ident']));
			$error = array();
            if($thisClient->password !=$_POST["opword"]){
				array_push($error,"Old Password is Incorrect");
            }
            if($_POST["pword2"] !=$_POST["pword"]){
				array_push($error,"The new Password and Re-typed Password entered do not match.");
            }
			elseif(strlen($_POST['pword']) < 6){
				array_push($error,"Password entered is too short. Minimum of Six(6) characters required.");
			}
			if(!empty($error)){
				$message = "Please check the following errors:<br /> ";
				$lenght = count($error);
				for($i = 0; $i < $lenght; $i++){
					$message = $message.$error[$i]."<br />";
				}
                echo "<div data-alert class='alert-box error'><a href='#' class='close'>&times;</a>$message</div>";
                exit;
            }
           $thisClient->password          =       $_POST["pword"];
            
            if($thisClient->update()){
                return 1;
            }else{
                  return 2;
            }
        }
    }
}
?>