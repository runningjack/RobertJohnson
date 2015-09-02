<?php
class Products extends Controller
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
		@$this->loadModel("Products");
		$this->view->allProducts = $this->model->getList();
		$this->view->render("products/index");
	}
	public function edit($id){
		@$this->loadModel("Products");
		$this->view->product = $this->model->getById($id);
		$this->view->render("products/edit");
	}
	public function create(){
		$this->view->render("products/create");
	}
	public function view($id){
		@$this->loadModel("Products");
		$this->view->product = $this->model->getById($id);
		$this->view->render("products/view");
	}
	public function doCreate(){
		@$this->loadModel("Products");
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
		@$this->loadModel("Products");
		if($this->model->update()=== 1){
			echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->update()=== 2){
		      echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
		}else{
		  echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";		  
		}
	}
	public function doDelete($id){
		@$this->loadModel("Products");
		if($this->model->delete($id)){
			redirect_to($this->uri->link("products/index"));
		}
	}
	
	public function addsignoff($id){
		@$this->loadModel("Products");
		$this->view->prod = $this->model->getById($id);
		$this->view->render("products/addsignoff");
	}
	
	public function addpreventive($id){
		@$this->loadModel("Products");
		$this->view->prod = $this->model->getById($id);
		$this->view->render("products/addpreventive");
	}
	
	public function part($id){
		@$this->loadModel("Products");
		$this->view->prod = $this->model->getById($id);
		$this->view->render("products/partform");
	}
	
	public function addworksheet($id){
		@$this->loadModel("Products");
		$this->view->prod = $this->model->getById($id);
		$this->view->render("products/addworksheet");
	}
	
	public function createsignoff(){
		@$this->loadModel("Products");
		$id = $_POST['prod_id'];
		$result = $this->model->createsignoff();
		if($result){
			redirect_to($this->uri->link("products/addsignoff/".$id));
		}
	}
	public function createpreventive($id){
		@$this->loadModel("Products");
		$id = $_POST['prod_id'];
		$result = $this->model->createpreventive();
		if($result){
			redirect_to($this->uri->link("products/preventive/".$id));
		}
	}
	public function createworksheet($id){
		@$this->loadModel("Products");
		$result = $this->model->createworksheet();
		$id = $_POST['prod_id'];
		if($result){
			redirect_to($this->uri->link("products/worksheet/".$id));
		}
	}
}
?>