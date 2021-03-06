<?php
class Dashboard extends Controller{
	function __construct(){
		parent::__construct();
		global $session;
		//check login		
		if($session->client_logged_in()){
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
		
		$datumo = $this->model->getData();
        $this->view->myAccount = $this->model->getById($_SESSION["client_ident"])   ;
        $this->view->prodcount =$datumo["countProd"];
        $this->view->tickcount =$datumo["countTick"];
        $this->view->tickopencount = $datumo["CountOpent"];
        $this->view->cschedule  =$datumo["cschedule"];
        $this->view->tickpendingcount = $datumo["CountPending"];
        $this->view->tickclosedcount = $datumo["CountClosed"];
        $this->view->usercount = $datumo["CountUsers"];
        $this->view->schedule = $datumo["Schel"];
        $this->view->cscheduleActivation = $datumo['SchelAct'];
       
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