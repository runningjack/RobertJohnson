<?php
class Admins_Model extends Model{
	function __construct(){
		parent::__construct();
		SESSION::init();
	}
	
	public function getList($id){
		$allAdmins = Admin::find_order_limit($id);
		return $allAdmins;		 
	}
	
	public function getById($id){
		$admin = Admin::find_by_id($id);
		return $admin;
	}
	
	public function delete($id){
		if($id != 2){
			$admin = Admin::find_by_id($id);
			if($admin->delete()) {
				$_SESSION['adminmessage'] ="Admin deleted successfully";
			}
			else {
				$_SESSION['adminmessage'] ="An Error occured, try again later";
			}
		}else {
			$_SESSION['adminmessage'] ="Main Admin cannot be deleted";
		}
		return true;
	}
	
	public function create(){
		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['rpassword']) && !empty($_POST['rpassword']) && isset($_POST['role']) && !empty($_POST['role'])){
			if($_POST['rpassword'] == $_POST['password']){
				$admin = new Admin();
				$admin->admin_name = $_POST['name'];
				$admin->admin_email = $_POST['email'];
				$admin->admin_password = hashpassword('md5', $_POST['password'], HASH_PASSWORD_KEY);
				$admin->admin_role = $_POST['role'];
				if($admin->create()){
					$_SESSION['adminmessage'] ="Admin created successfully and Saved";
					return 1;	
				}else{
					$_SESSION['adminmessage'] ="Password do not match";
					return 2;
				}
			}else{
				$_SESSION['adminmessage'] ="Admin not Created, Please try again.";
				return 3;
			}
		}else{
			$_SESSION['adminmessage'] ="Please fill the required links.";
			return 4;
		}
	}
		
	public function update($id){
		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['role']) && !empty($_POST['role'])){
				$admin = Admin::find_by_id($id);
				$admin->admin_name = $_POST['name'];
				$admin->admin_email = $_POST['email'];
				if(isset($_POST['password']) && !empty($_POST['password']) && ($_POST['rpassword'] == $_POST['password'])){
					$admin->admin_password = hashpassword('md5', $_POST['password'], HASH_PASSWORD_KEY);
				}
				$admin->admin_role = $_POST['role'];
				if($admin->update()){
					$_SESSION['adminmessage'] ="Admin updated successfully and Saved";
					header("location: ../admins");	
				}else{
					$_SESSION['adminmessage'] ="Admin Not Updated";
					header("location: ../admins");
				}
			}else{
				$_SESSION['adminmessage'] ="Admin could not Update at this time, Please try again.";
				header("location: ../admins");
			}
	}
	
	function pagination($id){
		return getPagingLink($id,'admin',5,'','admins/index/');
	}
}
?>