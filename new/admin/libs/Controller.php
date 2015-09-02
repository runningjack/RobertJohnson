<?php

class Controller {

	function __construct() {
		//echo 'Main controller<br />';
		$this->view = new View();
	}
	
	public function loadModel($name) {
		
		$path = 'models/'.$name.'_model.php';
		
		if (file_exists($path)) {
			require 'models/'.$name.'_model.php';
			
			$modelName = $name . '_Model';
			$this->model = new $modelName();
		}		
	}
	
	public function CheckLogin(){
			Session::init();
			$logged = Session::get('loggedIn');
			
			if($logged == false){
				Session::destroy();
				$link = URL."login";
				header("Location: $link");
			}
	}
	
	public function returnRole(){
		Session::init();
		$role = Session::get('admin_role');	
		return $role;
	}
	
	public function inLogin(){
		Session::init();
		$logged = Session::get('loggedIn');
		
		if($logged == true){
			header("location: index");
		}
	}
	
	public function redirect_to($link = ""){
		$url = URL.$link;
		header("location: $url");
	}

}