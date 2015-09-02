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
    
    public function runEmployee($username,$password){
        //print_r($_COOKIE);
		global $session;
		$userReg = Employee::authenticate($username,$password);
		if($userReg){
			$session->Employeelogin($userReg);
		
            return true;
            
		}else{
		  return false;
		}		
	}
}
?>