<?php

class Login extends Controller {

	function __construct() {
		parent::__construct();
		parent::inLogin();
		$this->view->title = "Login Page";
	}
	
	function index() 
	{	
		$this->view->render('login/index', true);
	}
	
	function run()
	{
		$this->model->run();
	}
	

}