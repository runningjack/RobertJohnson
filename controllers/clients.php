<?php
class Clients extends Controller
{
	
	function __construct(){
		parent::__construct();
        global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	}

	public function index(){
		@$this->loadModel("Clients");
		$this->view->clients = $this->model->getList();
		$this->view->render("clients/index");
	}
	public function edit($id){
		@$this->loadModel("Clients");
		$this->view->client = $this->model->getById($id);
		$this->view->render("clients/edit");
	}
	public function create(){
		$this->view->render("clients/create");
	}
	public function doCreate(){
		@$this->loadModel("Clients");
		$value = $this->model->create();
		if($value===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($value === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}else{
			echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}
	}
	public function doUpdate(){
		@$this->loadModel("Clients");
		if($this->model->update()=== 1){
			echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->update()=== 2){
		      echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
		}else{
		  echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";		  
		}
	}
	public function doDelete($id){
		@$this->loadModel("Clients");
		if($this->model->delete($id)){
			redirect_to($this->uri->link("clients/index"));
		}
	}
}
?>