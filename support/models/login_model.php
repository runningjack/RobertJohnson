<?php
class Login_Model extends Model{
	
	function __construct(){
		parent::__construct($this->registry);
		
	}
	public function passRecovery($email){
	   if(User::find_by_email($email)){
	       return true;
	   }else{
	       return false;
	   }
	}
    
    
    public function run($username,$password){
		global $session;
		$userReg = User::authenticate($username,$password);
		if($userReg){
			$session->login($userReg);
		
            return true;
            
		}else{
		  return false;
		}		
	}
	
	public function runClient($username,$password){
		global $session;
		$userReg = Client::authenticate($username,$password);
		if($userReg){
			
			$session->Clientlogin($userReg);
			//echo $_SESSION['client_ident'];
		//redirect_to("?url=dashboard/index");
            return true;
            
		}else{
		  return false;
		}		
	}
}
?>