<?php
require_once("user.php");
require_once("employee.php");
require_once("client.php");
$user =new User();
$client = new Client();
$employee = new Employee();
class Session {
	private $logged_in=false;
	private $cuscare_logged_in = false;
	private $merchant_logged_in = false;
	private $client_logged_in = false;
	public $user_id='';
	public $cuscare_id;
	public $merchant_id;
	public $username='';
	public $fullname='';
	public $message="";
	public $pin_id;
	
	
	function __construct(){
		session_start();
		$this->check_login();
	}
	public function is_logged_in(){
		return $this->logged_in;
	}
	
	public  function client_logged_in(){
		return $this->client_logged_in;
	}
	
	public function cuscare_is_logged_in(){
		return $this->cuscare_logged_in;
	}
	
	public function login($user){
		if($user){
			$username =$user->username;
			$_SESSION['user_ident']=$user->user_id;
			$this->user_id = $user->user_id;
			$this->logged_in=true;
			$_SESSION['Role'] = explode(",",$user->user_role);
		}
	}
    
	 public function Clientlogin($client){
		if($client){
			$_SESSION['client_ident']=$client->id;
			$this->client_id = $client->id;
			$this->client_logged_in=true;            
		}
	}
    
    public function Employeelogin($employee){
		if($user){
			$_SESSION['emp_ident']=$employee->id;
			$this->user_id = $employee->user_id;
			$this->logged_in=true;
			$_SESSION['emp_role'] = $employee->emp_post;
            
		}
	}

   
	
	public static function  getRole(){
		$userRole= array();
		$use = User::find_by_id($_SESSION['user_ident']);
		$userRole = explode(",",$use->user_role);
		return $userRole;
	}
	
	public function logout(){
		global $database;
		unset($_SESSION['client_ident']);
		unset($_SESSION['user_ident']);
		unset($this->user_id);
		unset($this->client_id);
		
		session_unset();
		session_destroy();
		$this->logged_in = false;
		$this->client_logged_in = false;
	}
	
	public function cuscareLogout(){
		global $database;
		
		unset($_SESSION['cuscare_id']);
		unset($this->cuscare_id);
		
		session_unset();
		session_destroy();
		$this->cuscare_logged_in = false;
	}
	private function check_login() {
    if(isset($_SESSION['client_ident'])) {
      $this->client_id = $_SESSION['client_ident'];
      $this->client_logged_in =true;
    } else {
      unset($this->client_id);
      $this->client_logged_in = false;
	  unset($_SESSION['client_ident']);
    }
  }
	
}
//@$session = new Session();
?>