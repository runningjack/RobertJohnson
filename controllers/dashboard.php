<?php
class Dashboard extends Controller{
	function __construct(){
		parent::__construct();
        $this->uri 		= new Url("");
        global $session;
		if($session->emp_is_logged_in()){
		  $this->index();
        
		}else{
		  redirect_to($this->uri->link("login/index"));
		}
	}
	/*---------------------------------
	At this point index is the login page
	*---------------------------------*/
	public function index(){
		@$this->loadModel("Dashboard");
		$this->view->render("dashboard/index");
	}
	
	public function doLogout(){
		//@$session = new Session();
		global $session;
		$session->logout();
       	redirect_to($this->uri->link("login/index"));
		//$this->view->render("dashboard/index");
	}
}
?>