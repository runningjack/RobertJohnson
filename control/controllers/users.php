<?php
class Users extends Controller{
	
	function __construct(){
		parent::__construct();
		//$this->index();
        global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	}
	public function index(){
		@$this->loadModel("Users");
		$datum=array();
		$datum= $this->model->getList("","users");
		$this->view->pagin = $datum['mypagin'];
		$this->view->alluser = $datum['myusers'];
		$this->view->render("users/index");
	}
	public function edit($id){
		@$this->loadModel("Users");
		$this->view->allroles = $this->model->getRoles();
		$this->view->myuser = $this->model->getById($id);
		$this->view->render("users/edit");
	}
	/**
	*
	*/
	public function create(){
		@$this->loadModel("Users");
		$this->view->allroles = $this->model->getRoles();
		$this->view->render("users/create");
	}
	public function detail($id){
		@$this->loadModel("Users");
		$this->view->myuser 	= 	$this->model->getById($id);
		//$this->view->history	=	$this->model->getHistory($id);
		$this->view->render("users/detail");
	}
	public function doCreate(){
		@$this->loadModel("Users");
		if($this->model->create()===1){
			$_SESSION['message'] ="<div data-alert class='alert-box success round'>Transaction Successful<a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("users/index"));
		}elseif($this->model->create()===2){
			$_SESSION['message'] ="<div data-alert class='alert-box alert round'><b>Unexpected error!</b> Transaction Unsuccessful <a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("users/index"));
		}elseif($this->model->create()===3){
			$_SESSION['message'] ="<div data-alert class='alert-box alert round'><b>Unexpected error!</b> Transaction was not successful <a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("users/index"));
		}elseif($this->model->create()===4){
			$_SESSION['message'] ="<div data-alert class='alert-box alert round'>Record not saved! Ensure that all required field are set <a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("users/index"));
		}
	}
	public function doUpdate(){
		//$uri = new Url("");
		@$this->loadModel("Users");
		if($this->model->update()===1){
			$_SESSION['message'] ="<div data-alert class='alert-box success round'>Transaction Successful<a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("users/index"));
		}elseif($this->model->update()===2){
			$_SESSION['message'] ="<div data-alert class='alert-box alert round'><b>Unexpected error!</b> Transaction Unsuccessful <a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("users/index"));
		}elseif($this->model->update()===3){
			$_SESSION['message'] ="<div data-alert class='alert-box alert round'><b>Unexpected error!</b> Transaction was not successful <a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("users/index"));
		}elseif($this->model->update()===4){
			$_SESSION['message'] ="<div data-alert class='alert-box alert round'>Record not saved! Ensure that all required field are set <a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("users/index"));
		}
	}
    
    
    public function doCheckUser(){
        @$this->loadModel("Users");
        if($this->model->checkUser()){
            echo("You cannot delete this record!");
        }else{
            echo"You are about to delete a record from the Network; Records deleted will not longer be available in the system?<input type='hidden' id='ok' name='ok' value='".$_POST['uid']."' /><br />
            <input type='button' rel='catchable' class='button' id='btnok' value='Delete' uid='".$_POST['uid']."' /> <input type='button' rel='catchable' class='button'   value='Cancel' />
            ";
        }
    }
    
	public function doDelete($id){
		@$this->loadModel("Users");
		if($this->model->delete($id)){
			echo"Reord succesfully deleted";
		}
	}
	
}
?>