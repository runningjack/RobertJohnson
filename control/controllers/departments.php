<?php
class Departments extends Controller
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
		@$this->loadModel("Departments");
		$this->view->mydepartments = $this->model->getList();
		$this->view->render("departments/index");
	}
	public function edit($id){
		@$this->loadModel("Departments");
		$this->view->mydepartments = $this->model->getById($id);
		$this->view->render("departments/edit");
	}
	public function create(){
		@$this->loadModel("Departments");
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("departments/create");
	}
	public function doCreate(){
		@$this->loadModel("Departments");
		if($this->model->create()===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}else{
			echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}
	}
	public function doUpdate(){
		@$this->loadModel("Departments");
		if($this->model->update()=== 1){
			echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->update()=== 2){
		      echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
		}else{
		  echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";		  
		}
	}
	public function doDelete($id){
		@$this->loadModel("Departments");
		if($this->model->delete($id)){
			redirect_to($this->uri->link("departments/index"));
		}
	}
}
?>