<?php
class Users_Model extends Model{
	function __construct(){
		parent::__construct();
	}
	public function getList($id="",$pg){
		 $purl = array();
		if(isset($_GET['url'])){
			
			$purl	=	$_GET['url'];
			$purl	=	rtrim($purl);
			$purl	=	explode('/',$_GET['url']);
			
			
		}else{
			$purl =null;
			
		}
		if(!isset($purl['2'])){
			$pn = 1;
		}else{
		$pn = $purl['2'];
		}
		
		global $database;
		$resultUser = $database->db_query("SELECT * FROM users");
		$pagin = new Pagination();
		$pagin->nr  = $database->dbNumRows($resultUser);
		$pagin->itemsPerPage = 20;
		
		$users = User::find_by_sql("SELECT * FROM users ".$pagin->pgLimit($pn));
		
			$index_array =array( "myusers"=>$users,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
	public function getById($id){
		$myuser = User::find_by_id($id);
		return $myuser;
	}
	public function getRoles(){
		$allRole = Roles::find_all();
		return $allRole;
	}
	/*
	* This section will be needed to collect 
	* logs of activity done by a user/staff wthin
	* the organization
	*/
	public function getHistory($id){
		$myissues = Issues::find_by_sql("SELECT * FROM issues WHERE issue_mem_id=".$id);
		return $myissues;
	}
	public function update(){
		global $database;
		if (isset($_POST['Submit']) && !empty($_POST['uname']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['mid'])){
			
			$theuser = User::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['mid'])) ;
			if($theuser){
				$limit = $_POST['limit'];
						$x=0;
						$urole = "";
						while ($x <=$limit){
							if(isset($_POST["utype$x"])){
								$urole .= $_POST["utype$x"];
								$urole .=",";
								
								goto Data;
							}
				Data:			$x++;
						}
						$urole = substr_replace($urole,"",-1);
				
				$theuser->fname				=	$_POST['fname'];
				$theuser->username			=	$_POST['uname'];
				$theuser->lname				=	$_POST['lname'];
				$theuser->password			=	$_POST['password'];
				$theuser->phone				=	$_POST['phone'];
				$theuser->email				=	$_POST['email'];
				$theuser->user_role			=	$urole;
				$theuser->date_modified		=	date("Y-m-d H:i:s");
				if(isset($_FILES['fupload']) && $_FILES['fupload']['error']==0){
					move_uploaded_file($_FILES['fupload']['tmp_name'],"../public/uploads/".basename($_FILES['fupload']['name']));
					$image = new Imageresize(); // an instance of image resize object
					$image->load("../public/uploads/".basename($_FILES['fupload']['name']));
					//$image->image =;
					$image->resize(276,390);
					$image->save("../public/uploads/".basename($_FILES['fupload']['name']));
					
					//this section is needed to get the extension for image type in renaming the image
					if ($_FILES['fupload']['type']=="image/gif"){
						$ext = ".gif";
					}
					if ($_FILES['fupload']['type']=="image/png"){
						$ext = ".png";
					}
					if ($_FILES['fupload']['type']=="image/jpeg"){
						$ext = ".jpeg";
					}
					if ($_FILES['fupload']['type']=="image/pjpeg"){
						$ext = ".jpeg";
					}
					if ($_FILES['fupload']['type']=="image/gif"){
						$ext = ".gif";
					}
					if ($_FILES['fupload']['type']=="image/jpg"){
						$ext = ".jpg";
					}
					$new_name = uniqid()."_".time().$ext; //new name for the image
					rename("../public/uploads/".basename($_FILES['fupload']['name']),"../public/uploads/".$new_name);
					$photo = $new_name;
					$theuser->img_url = $photo;
					  
				}
				
					if($theuser->update()){
						return 1;
					}else{
						return 2;
					}
				
			}else{
				return 3;
			}
		}else{
			return 4;
		}
	}
	public function create(){
		global $database;
		if (isset($_POST['Submit']) && !empty($_POST['uname']) && !empty($_POST['password']) && !empty($_POST['email'])){
			$newuser = new User();
			$limit = $_POST['limit'];
					$x=0;
					$urole = "";
					while ($x <=$limit){
						if(isset($_POST["utype$x"])){
							$urole .= $_POST["utype$x"];
							$urole .=",";
							
							goto Data;
						}
			Data:			$x++;
					}
					$urole = substr_replace($urole,"",-1);
					 
			$newuser->fname				=	$_POST['fname'];
			$newuser->username			=	$_POST['uname'];
			$newuser->lname				=	$_POST['lname'];
			$newuser->password			=	$_POST['password'];
			$newuser->phone				=	$_POST['phone'];
			$newuser->email				=	$_POST['email'];
			$newuser->user_role			=	$urole;
			$newuser->date_added		=	date("Y-m-d H:i:s");
			if(isset($_FILES['fupload'])){
				move_uploaded_file($_FILES['fupload']['tmp_name'],"../public/uploads/".basename($_FILES['fupload']['name']));
				$image = new Imageresize(); // an instance of image resize object
				$image->load("../public/uploads/".basename($_FILES['fupload']['name']));
				//$image->image =;
				$image->resize(276,390);
				$image->save("../public/uploads/".basename($_FILES['fupload']['name']));
				
				//this section is needed to get the extension for image type in renaming the image
				if ($_FILES['fupload']['type']=="image/gif"){
					$ext = ".gif";
				}
				if ($_FILES['fupload']['type']=="image/png"){
					$ext = ".png";
				}
				if ($_FILES['fupload']['type']=="image/jpeg"){
					$ext = ".jpeg";
				}
				if ($_FILES['fupload']['type']=="image/pjpeg"){
					$ext = ".jpeg";
				}
				if ($_FILES['fupload']['type']=="image/gif"){
					$ext = ".gif";
				}
				if ($_FILES['fupload']['type']=="image/jpg"){
					$ext = ".jpg";
				}
				$new_name = uniqid()."_".time().$ext; //new name for the image
				rename("../public/uploads/".basename($_FILES['fupload']['name']),"../public/uploads/".$new_name);
				$photo = $new_name;
				$newuser->img_url = $photo;
				  
			  }
			  if($database->db_query("SELECT * FROM users WHERE username='".$theuser->username."' OR phone='".$theuser->phone."' OR email='".$theuser->email."'")){
					if($newuser->create()){
						return 1;
					}else{
						return 2;
					}
			}else{
					return 5;
				}
			
		}else{
			return 4;
		}
	}
    
    
    /**
     * this section is used to check data 
     * before delete
     */
    public function checkMerch(){
        if(isset($_POST['uid'])){
            if(count(Cuscarelog::find_by_sql("SELECT * FROM care_pinlog WHERE pin_log_desc LIKE 'MERCHANT%' AND cuscare_id=$_POST[uid]"))>0){
                return true;
            }else{
                return false;
            }
        }
    }
    
	public function delete($id){
		$newuser = User::find_by_id($id);
		if($newuser->delete()){
			return true;
		}
	}
}