<?php
class Prod_Cats extends Controller
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
		@$this->loadModel("Prod_Cats");
		$this->view->prod_cats = $this->model->getList();
		$this->view->render("prod_cats/index");
	}
	public function edit($id){
		@$this->loadModel("Prod_Cats");
		$this->view->prod_cat = $this->model->getById($id);
		$this->view->render("prod_cats/edit");
	}
	public function create(){
		$this->view->render("prod_cats/create");
	}
	public function doCreate(){
		@$this->loadModel("Prod_Cats");
		$result = $this->model->create();
		if($result===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($result === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}else{
			echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}
	}
	public function doUpdate(){
		@$this->loadModel("Prod_Cats");
		$result = $this->model->update();
		if($result === 1){
			echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
		}elseif($result === 2){
		      echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
		}else{
		  echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";		  
		}
	}
	public function doDelete($id){
		@$this->loadModel("Prod_Cats");
		if($this->model->delete($id)){
			redirect_to($this->uri->link("prod_cats/index"));
		}
	}
}
?>