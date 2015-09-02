<?php

class Val 
{
	public function __construct()
	{
		
	}
	
	public function minlength($data, $arg)
	{
		if (strlen($data) < $arg) {
			return false;
		}
		else return true;
	}
	
	public function maxlength($data, $arg)
	{
		if (strlen($data) > $arg) {
			return false;
		}
		else return true;
	}
		
	public function digit($data)
	{
		if (ctype_digit($data) == false) {
			return false;
		}
		else return true;
	}
	
	public function checkEmail($email) {
	 if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email)) {
	  return false;
	 }
	 return true;
	}
	
	public function checkPhone($phone){
	if(preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $phone) ) { 
		return false;
	}
	return true;	
	}
	
	public function checkPassword($password, $rpassword){
		if($password == $rpassword) 
		return true;	
		else return false;
	}
	
	public function checkname($name){
		if(!preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $name))
		return false;
		else return true;
	}
	
	public function checkUsername($name){
		if (preg_match("/^[0-9A-Za-z_]+$/", $name) == 0) {
			return false;
		}
		else return true;
	}
}