<?php
class Account extends Controller{
    function __construct(){
		parent::__construct();
		global $session;
		//check if user is logged in;		
		if(!$session->client_logged_in()){
			 redirect_to($this->uri->link("login/index"));
		}
		
	}
    
    public function index(){
        @$this->loadModel("Account");
        $datumo = $this->model->getData();
        $this->view->myAccount = $this->model->getById($_SESSION["client_ident"])   ;
        $this->view->prodcount =$datumo["countProd"];
        $this->view->tickcount =$datumo["countTick"];
        $this->view->schedule = $datumo["Schel"];
		$this->view->render("account/index");
    }
    
    public function edit(){
		@$this->loadModel("Account");
        $this->view->myaccount = $this->model->getById($_SESSION["client_ident"])   ;
		$this->view->render("account/edit");
	}
    
    public function changepassword(){
		@$this->loadModel("Account");
        $this->view->myaccount = $this->model->getById($_SESSION["client_ident"])   ;
		$this->view->render("account/changepassword");
	}
    
    public function doUpdate(){
        @$this->loadModel("Account");
        if($this->model->update()=== 1){
          echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
        }elseif($this->model->update()=== 2){
              echo"<div data-alert class='alert-box error'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
        }else{
          echo"<div data-alert class='alert-box error'>Please check your form <a href='#' class='close'>&times;</a></div>";     
        }
  }
}
?>