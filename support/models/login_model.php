<?php
class Login_Model extends Model{
	
	function __construct(){
		parent::__construct($this->registry);
		
	}
	public function passRecovery($email){
	   if(User::find_by_email($email) ){
	       return true;
	   }else{
	       return false;
	   }
	}
    
    
    public function run($username,$password){
		global $session;
		$userReg = Clientuser::authenticate($username,$password);
		if($userReg){
			$session->Clientlogin($userReg);
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
            return true;
		}else{
		  return false;
		}		
	}
}
?>