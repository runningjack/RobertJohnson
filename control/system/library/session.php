<?php
require_once("user.php");
require_once("employee.php");
require_once("client.php");
$user =new User();
$client = new Client();
//$employee = new Employee();
class Session {
	private $logged_in=false;
	private $emp_logged_in = false;
	private $client_logged_in = false;
	public $user_id='';
    public $emproleid;
    public $rolename; /// gets employee role name
	public $emp_id;
    public $emp_work_id;
	public $username='';
	public $fullname;
	public $message="";
    public $employee_role;
    public $empright;
    public $emRoles ;
    public $privil = array();
    public $department; //needed to hold the employee department 
	
	
	function __construct(){
		session_start();
		$this->check_login();
	}
	public function is_logged_in(){
		return $this->logged_in;
	}
	
	public function emp_is_logged_in(){
		return $this->emp_logged_in;
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
    
    
    public function Employeelogin($employee){
		if($employee){
			$_SESSION['emp_ident']           =$employee->id;
			$this->emp_id                    =$employee->id;
			$this->emp_logged_in             =true;
            $_SESSION['fullname']            =$employee->emp_fname." ".$employee->emp_lname;
			$_SESSION['emp_role']            =$employee->emp_post;
            $this->emRole                          =Roles::find_by_id($employee->emp_post);
            
            if(isset($_POST['remember'])){
                setcookie("uname",$_POST["username"],time()+60*60*24*30);
                setcookie("pword",$_POST["password"],time()+60*60*24*30);
            }
            $depart                          =Department::find_by_id($employee->emp_dept);
            //print_r(($depart));
            $this->department               =$depart->dept_name;
            $this->empright                 =   $this->emRole->role_name;
            
		}
	}

    public static   function allModules(){
        $roles = Roles::find_all();
        $mRole = array();
        foreach($roles as $role){
            $mRole = $role->module;

        }
        return $mRole;
    }
    
    
    public function Clientlogin($client){
		if($client){
			$_SESSION['client_ident']=$client->id;
			$this->client_id = $client->id;
			$this->client_logged_in=true;            
		}
	}

   
	/*Gets The Role id of the employee*/
	public static function  getRole(){
		$userRole= array();
        if(isset($_SESSION['user_ident'])){
            $use = User::find_by_id($_SESSION['user_ident']);
            if($use){
                $userRole = explode(",",$use->user_role);
            }
            return $userRole;
        }elseif(isset($_SESSION['emp_ident'])){
            $myrole ="";
            $emp = Employee::find_by_id($_SESSION['emp_ident']);
            if($emp){
                $myrole = $emp->emp_post;
            }
            return $myrole;
        }else{
            return false;
        }
	}
	
	public function logout(){
		global $database;
		unset($_SESSION['emp_ident']);
		unset($_SESSION['user_ident']);
		unset($this->user_id);
			
		$this->logged_in          = false;
        $this->emp_logged_in          = false;
        session_unset();
		session_destroy();
	}
	
	
	private function check_login() {
    if(array_key_exists('user_ident',$_SESSION) && !empty($_SESSION['user_ident'])) {
      $this->user_id                =   $_SESSION['user_ident'];
      $this->logged_in              =   true;
    } else {
      unset($this->user_id);
      $this->logged_in              =   false;
    }
    
    if(array_key_exists('emp_ident',$_SESSION) && !empty($_SESSION['emp_ident'])){
        $employee                   =   Employee::find_by_id($_SESSION['emp_ident']);
        $this->emp_id               =   $employee->id;
        $this->emp_work_id          =   $employee->emp_id;
        $role                       =   Priviledges::find_by_sql("SELECT p.*, m.module FROM priviledges p INNER JOIN modules m ON p.module=m.module WHERE   p.role_id ='".$employee->emp_post."'");
        $this->emproleid            =   $employee->emp_post;
        $merole                     = Roles::find_by_id($employee->emp_post);
        //print_r($merole);
        $this->empright             =   $merole->role_name;
        $this->rolename =$merole->role_name;
        
        $this->emp_logged_in        =   true;
        $this->employee_role        =   $role;
        $dapart                     =   Department::find_by_id($employee->emp_dept);
        $this->department           =   $dapart->dept_name;
        
        foreach($role as $ro){
            $this->privil[] = $ro->module;
        }
        
        print_r($role);
    }else{
        unset($this->emp_id);
        unset($this->emp_work_id);
        $this->emp_logged_in        =   false;
        
    }
  }
	
}
//@$session = new Session();
?>