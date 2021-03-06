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

            $phpFileUploadErrors = array(
                0 => 'There is no error, the file uploaded with success',
                1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                3 => 'The uploaded file was only partially uploaded',
                4 => 'No file was uploaded',
                6 => 'Missing a temporary folder',
                7 => 'Failed to write file to disk.',
                8 => 'A PHP extension stopped the file upload.',
            );

            if(isset($_FILES['fupload']) && $_FILES['fupload']['error']==0){ //if file upload is set
                move_uploaded_file($_FILES['fupload']['tmp_name'],"../public/uploads/".basename($_FILES['fupload']['name']));
                $image = new Imageresize(); // an instance of image resize object
                $image->load("../public/uploads/".basename($_FILES['fupload']['name']));
                //$image->image =;
                $image->resize(400,400);
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
                $obj->image = $photo;

            }else{
                //$applicant->img_url = $_REQUEST['imgvalue'];

                echo $phpFileUploadErrors[$_FILES['fupload']['error']];
                exit;
            }



			if($_POST['password'] == $_POST['r_password']){
				$obj->password	=	$_POST['password'];
			}else array_push($error, "Password do not match");
			if(empty($error)){
				if($obj->create()){
				    $obj->main_id    =   Client::getID("CLT",$obj->id);
                    $obj->update();
					return 1;
				}else{
					return 2;
				}
			}
		}
	}
	public function update()
	{
		if(isset($_POST['names']) && !empty($_POST['client_id'])){
			
			$client            = 	Client::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['client_id']));
            //print_r($obj);
			$client->name		=	($_POST['names']);
			$client->addy      =	($_POST['addy']);
			$client->visible	=	$_POST['visible'];
			$client->phone 	= 	$_POST['phone'];
			$client->email		=	$_POST['email'];
			$client->descr		=	$_POST['descr'];
			$client->username	=	$_POST['username'];
            $client->main_id    =   Client::getID("CLT",$client->id);
            if($_POST['password'] == $_POST['r_password']){
				$client->password	=	$_POST['password'];
			}else $_SESSION['message'] = "<div data-alert class='alert-box error'>Record not Saved Password do not match<a href='#' class='close'>&times;</a></div>";
			if($client->update()){
			     $_SESSION['message'] = "<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
			     return 1;
			}else{
			 $_SESSION['message'] = "<div data-alert class='alert-box error'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
			     return 2;
			}
			//}
		}else{
		  $_SESSION['message']="<div data-alert class='alert-box error'>Fill in required fields <a href='#' class='close'>&times;</a></div>";
		  return 3; //fill in empty required field
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