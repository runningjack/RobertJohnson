<?php
class Clients_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getList(){
		$all = Client::find_all();
		return $all;
	}
	public function getById($id){
		$one = Client::find_by_id($id);
		return $one;
	}
	public function create()
	{
		if(isset($_POST['name']) && !empty($_POST['name'])){
			$obj            =   new Client();
			$error = array();
			$obj->name		=	strip_tags($_POST['name']);
			$obj->addy      =	strip_tags($_POST['addy']);
			$obj->visible 	=	$_POST['visible'];
			$obj->phone 	= 	$_POST['phone'];
			$obj->email		=	$_POST['email'];
			$obj->descr		=	$_POST['desc'];
			$obj->username	=	$_POST['username'];
			if($_POST['password'] == $_POST['r_password']){
				$obj->password	=	$_POST['password'];
			}else array_push($error, "Password do not match");
			if(empty($error)){
				if($obj->create()){
					return 1;
				}else{
					return 2;
				}
			}
		}
	}
	public function update()
	{
		if(isset($_POST['name']) && !empty($_POST['name'])){
			$error = array();
			$obj            = 	Client::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['client_id']));
			$obj->name		=	strip_tags($_POST['name']);
			$obj->addy      =	strip_tags($_POST['addy']);
			$obj->visible	=	$_POST['visible'];
			$obj->phone 	= 	$_POST['phone'];
			$obj->email		=	$_POST['email'];
			$obj->descr		=	$_POST['desc'];
			$obj->username	=	$_POST['username'];
			if(isset($_POST['password']) && !empty($_POST['password'])){
				if($_POST['password'] == $_POST['r_password']){
					$obj->password	=	$_POST['password'];
				}else array_push($error, "Password do not match");
			}
			if(empty($error)){
				if($obj->update()){
					return 1;
				}else{
					return 2;
				}
			}
		}
	}
	
	public function delete($id){
		$article = Client::find_by_id($id);
		if($article->delete()){
			return true;
		}
	}
	
}

?>