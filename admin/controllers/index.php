<?php

class Index extends Controller {

	function __construct() {
		parent::__construct();
		parent::CheckLogin();
		$this->view->title = "Admin Home";
	}
	
	function index() {
		$this->view->render('index/index');
	}
	
	function details($id = 1) {
		$this->view->render('index/index');
	}
	
	function logout()
	{
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
	
}