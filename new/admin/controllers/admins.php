<?php
class Admins extends Controller{
	
	function __construct(){
		parent::__construct();
		parent::CheckLogin();
		/*if(parent::returnRole() == "Developer" || parent::returnRole() == "Staff"){
			$_SESSION['adminmessage'] ="You are not authorized to view Admin page";
			redirect_to($this->uri->link("index"));	
		}*/
		$this->view->title = "Admin Management System";
	}

	public function index($id=1){
		$this->view->pageMultiplier = $id;
		$this->view->allAdmin = $this->model->getList($id);
		$this->view->pag = $this->model->pagination($id);
		$this->view->render("admins/index");
	}
	
	public function doCreate(){
		$result = $this->model->create();
			if($result == 1){
				parent::redirect_to("admins/index");	
			}
			elseif($result == 2){
				parent::redirect_to("admins/create");
			}
			elseif($result == 3){
				parent::redirect_to("admins/create");
			}
			else{
				parent::redirect_to("admins/create");
			}
	}
	
	public function doUpdate($id){
		$result = $this->model->update($id);
			if($result == 1){
				parent::redirect_to("admins/index");	
			}
			elseif($result == 2){
				parent::redirect_to("admins/index");
			}
			elseif($result!= 1 && $result!=2 && $result != ""){
				parent::redirect_to("admins/index");
			}
			else{
				parent::redirect_to("admins/index");
			}
	}
	
	public function create(){
		$this->view->render("admins/create");
	}
	
	public function edit($id){
		$this->view->admin = $this->model->getById($id);
		$this->view->render("admins/edit");
	}

	public function doDelete($id){
		$result = $this->model->delete($id);
		if($result)
		parent::redirect_to("admins");
	}
}
?>