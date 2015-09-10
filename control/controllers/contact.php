<?php
class Contact extends Controller{
	public $mymenus = null;
	
	function __construct(){
		parent::__construct();
		global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	}
	public function index(){
		@$this->loadModel("Contact");
		$this->view->mymenus = $this->model->getList();
        if(Session::getRole()){
            if(in_array(strtolower(get_class($this)), $_SESSION['emp_role_module'])){
                $this->view->render("contact/index");
            }else{

                $this->view->render("access/restricted");
            }
        }
	}
	public function detail($id){
		@$this->loadModel("Contact");
		$this->view->mycontact = $this->model->getById($id);
		$this->view->render("contact/detail");
	}
	public function create(){
		@$this->loadModel("Contact");
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("contact/create");
	}
	public function doCreate(){
		@$this->loadModel("Contact");
		if($this->model->create()){
			$_SESSION['message']="New contact created successfully";
			redirect_to($this->uri->link("contact/index"));
		}else{
			$_SESSION['message']="<b>Unexpected error!</b> contact could no be created";
			redirect_to($this->uri->link("contact/index"));
		}
		
	}
	public function doReply(){
		@$this->loadModel("Contact");
		if($this->model->sendMail()){
			$_SESSION['message']="<div data-alert class='alert-box success round'>Mail Sent<a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("contact/index"));
		}else{
			$_SESSION['message']="<div data-alert class='alert-box alert round'><b>Unexpected error!</b> Mail could not be sent<a href='#' class='close'>&times;</a></div>";
			redirect_to($this->uri->link("contact/index"));
		}
		
	}
	public function doUpdate(){
		@$this->loadModel("Contact");
		if($this->model->update()){
			$_SESSION['message']= $thiscontact->contact_name ." redord updated successfully";
			redirect_to($this->uri->link("contact/index"));
		}else{
			$_SESSION['message']="<b>Unexpected error!</b> ". $thiscontact->contact_name ." redord could not be updated";
			redirect_to($this->uri->link("contact/index"));			
		}
		
	}
}
?>