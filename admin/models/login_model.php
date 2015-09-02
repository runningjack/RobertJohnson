<?php

class Login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function run()
	{
		$email = $_POST['login'];
		$password = hashpassword('md5', $_POST['password'], HASH_PASSWORD_KEY);
		$admin = Admin::login($email, $password);
				
		if ($admin) {
			// login
			Session::init();
			Session::set('role', $admin->admin_role);
			Session::set('loggedIn', true);
			Session::set('admin_id', $admin->admin_id);
			header('location: ../index');
		} else {
			$_SESSION['adminmessage'] ="Username or Password is wrong.";
			header('location: ../login');
		}
		
	}
	
}