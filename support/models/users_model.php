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
		$resultUser = $database->db_query("SELECT * FROM users_client");
		$pagin = new Pagination();
		$pagin->nr  = $database->dbNumRows($resultUser);
		$pagin->itemsPerPage = 20;
		
		$users = User::find_by_sql("SELECT * FROM users_client WHERE company_id=".$_SESSION['client_ident']. " ". $pagin->pgLimit($pn));
		
			$index_array =array( "myusers"=>$users,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
	public function getById($id){
		$myuser = Clientuser::find_by_id($id);
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
		if (isset($_POST['Submit'])  && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['mid'])){
			
			$theuser = Clientuser::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['mid'])) ;
			if($theuser){
				$company	=	Client::find_by_id($_SESSION['client_ident']);
				
				$theuser->fname				=	$_POST['fname'];
				$theuser->username			=	$_POST['email'];
				$theuser->lname				=	$_POST['sname'];
				$theuser->password			=	$_POST['password'];
				$theuser->phone				=	$_POST['phone'];
				$theuser->email				=	$_POST['email'];
				$theuser->company_id		=	$company->id;
				$theuser->company			=	$company->name;
				$theuser->date_modified		=	date("Y-m-d H:i:s");
				if(isset($_FILES['fupload']) && $_FILES['fupload']['error']==0){
					move_uploaded_file($_FILES['fupload']['tmp_name'],"public/uploads/".basename($_FILES['fupload']['name']));
					$image = new Imageresize(); // an instance of image resize object
					$image->load("public/uploads/".basename($_FILES['fupload']['name']));
					//$image->image =;
					$image->resize(280,280);
					$image->save("public/uploads/".basename($_FILES['fupload']['name']));
					
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
					rename("public/uploads/".basename($_FILES['fupload']['name']),"public/uploads/".$new_name);
					$photo = $new_name;
					$theuser->img_url = $photo;
					  
				}else{
					$theuser->img_url = $_POST['imgvalue'];
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
		if (isset($_POST['Submit'])  && !empty($_POST['password']) && !empty($_POST['email'])){
			$newuser = new Clientuser();
			$company	=	Client::find_by_id($_SESSION['client_ident']);
					 
			$newuser->fname				=	$_POST['fname'];
			$newuser->username			=	$_POST['email'];
			$newuser->lname				=	$_POST['sname'];
			$newuser->password			=	$_POST['password'];
			$newuser->phone				=	$_POST['phone'];
			$newuser->email				=	$_POST['email'];
			$newuser->company_id		=	$company->id;
			$newuser->company			=	$company->name;
            $newuser->client_id         = $company->id;
            $newuser->user_role         = "standard";
			$newuser->date_added		=	date("Y-m-d H:i:s");
			if(isset($_FILES['fupload']) && $_FILES['fupload']['error']==0){
				move_uploaded_file($_FILES['fupload']['tmp_name'],"public/uploads/".basename($_FILES['fupload']['name']));
				$image = new Imageresize(); // an instance of image resize object
				$image->load("public/uploads/".basename($_FILES['fupload']['name']));
				//$image->image =;
				$image->resize(280,280);
				$image->save("public/uploads/".basename($_FILES['fupload']['name']));
				
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
				rename("public/uploads/".basename($_FILES['fupload']['name']),"public/uploads/".$new_name);
				$photo = $new_name;
				$newuser->img_url = $photo;
				  
			  }
			  if($database->db_query("SELECT * FROM users_client WHERE username='".$newuser->username."' OR phone='".$newuser->phone."' OR email='".$newuser->email."'")){
					if($newuser->create()){
                        $to = $newuser->email;
                        $subject = 'RJ Support ATM Services Portal ';

                        $headers = "From: ".$company->name."<" . $company->email . ">\r\n";
                        $headers .= "Reply-To: ". $company->contact_email . "\r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                        $message ="<p>Your username and password on the Robert Johnson ATM Support Portal is as below </p> ";
                        $message .="<p><b>Username: </b>". $newuser->email."<br>";
                        $message .="<b>Password: </b>". $_POST['password']."<br></p>";
                        $message .= "<br><br> Thank You";


                        mail($to, $subject, $message, $headers);
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
    
    
   
    
	public function delete($id){
		$newuser = Clientuser::find_by_id($id);
		if($newuser->delete()){
			return true;
		}
	}
}