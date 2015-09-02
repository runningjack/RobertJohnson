<?php

class Dashboard extends Controller {

	function __construct() {
		parent::__construct();
		parent::CheckLogin();
		$this->view->title = "Admin Home";
		$this->view->js = array('dashboard/js/default.js');
	}
	
	function index() 
	{	
		$this->view->render('dashboard/index');
	}
	
	function tes() 
	{	
		$this->view->render('dashboard/tes', true);
	}
	
	function logout()
	{
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
	
	function xhrInsert()
	{
		$this->model->xhrInsert();
	}
	
	function xhrGetListings()
	{
		$this->model->xhrGetListings();
	}
	
	function xhrDeleteListing()
	{
		$this->model->xhrDeleteListing();
	}

}