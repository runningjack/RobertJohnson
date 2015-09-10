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


        if(Session::getRole()){
            if(in_array(strtolower(get_class($this)), $_SESSION['emp_role_module'])){
                $this->view->render("clients/index");
            }else{

                $this->view->render("access/restricted");
            }
        }
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
		  redirect_to($this->uri->link("clients/index"));
			
		}elseif($this->model->update()=== 2){
		  redirect_to($this->uri->link("clients/index"));
		      
		}elseif($this->model->update()=== 3){
		  redirect_to($this->uri->link("clients/index"));
		}/**
 * else{        
 * 		  echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";		  
 * 		}
 */
	}
	public function doDelete($id){
		@$this->loadModel("Clients");
		if($this->model->delete($id)){
			redirect_to($this->uri->link("clients/index"));
		}
	}
}
?>