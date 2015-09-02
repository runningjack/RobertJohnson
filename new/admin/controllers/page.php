<?php
class Page extends Controller{
	
	function __construct(){
		parent::__construct();
		parent::CheckLogin();
		$role = parent::returnRole();
		if($role == "Staff"){
			$_SESSION['adminmessage'] ="You are not authorized to view Page page";
			parent::redirect_to("index");	
		}
		$this->view->title = "Page Content Management";
		
		//$this->index();
	}

	public function index($id=1){
		$this->view->pageMultiplier = $id;
		$this->view->allPages = $this->model->getList($id);
		$this->view->pag = $this->model->pagination($id);
		$this->view->render("page/index");
	}

	public function edit($id){
		$this->view->mypage = $this->model->getById($id);
		$this->view->render("page/edit");
	}

	public function create(){
		$this->view->render("page/create");
	}

	public function doUpdate($id){
		if($this->model->update($id)===1){
			$_SESSION['adminmessage'] ="Update Successful";
			parent::redirect_to('page');
		}elseif($this->model->update($id)===2){
			$_SESSION['adminmessage'] ="Unexpected error! Update Unsuccessful";
			parent::redirect_to('page');
		}elseif($this->model->update($id)===3){
			$_SESSION['adminmessage'] ="Unexpected error! Update was not successful";
			parent::redirect_to('page');
		}elseif($this->model->update($id)===4){
			$_SESSION['adminmessage'] ="Record not saved! Ensure that all required field are set";
			parent::redirect_to('page');
		}
	}

	public function doCreate(){
		if($this->model->create()===1){
			$_SESSION['adminmessage'] ="Page Creation Successful";
			parent::redirect_to('page');
		}elseif($this->model->create()===2){
			$_SESSION['adminmessage'] ="Unexpected error! Page Creation unsuccessful";
			parent::redirect_to('page/create');
		}elseif($this->model->create()===3){
			$_SESSION['adminmessage'] ="Unexpected error! Page with same title already exist.";
			parent::redirect_to('page/create');
		}elseif($this->model->create()===4){
			$_SESSION['adminmessage'] ="Record not saved! Ensure that all required field are set";
			parent::redirect_to('page/create');
		}
	}

	public function doDelete($id){
		$success = $this->model->delete($id);
		if($success === 1){
			$_SESSION['adminmessage'] ="Delete Successful";
			parent::redirect_to('page');
		}
		elseif($success === 2){
			$_SESSION['adminmessage'] ="Delete Unuccessful";
			parent::redirect_to('page');
		}
		elseif($success === 3){
			$_SESSION['adminmessage'] ="Index Page Cannot be deleted";
			parent::redirect_to('page');
		}
	}
	
	
}
?>