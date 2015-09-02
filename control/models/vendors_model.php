<?php
class Vendors_Model extends Model{
	function __construct(){
		parent::__construct();
	}
    
    /**
     * the getList method is used to 
     * pupolate the listing table 
     */
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
		$resultEmployee = $database->db_query("SELECT * FROM vendors");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$myitems = Vendor::find_by_sql("SELECT * FROM vendors ".$pagin->pgLimit($pn));
		
			$index_array =array( "vendors"=>$myitems,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
    
    
	public function getById($id){
		return Vendor::find_by_id($id);
       // $myaccount = Accounts::find_by_phone($phone);
       
	}
    
    /**
     * load initail data for employee form needed during 
     * creating and editing employee
     * data 
     */
    
	public function getData(){
		global $database;
		$depts 			= Department::find_all();
		$role			= Roles::find_all();
		$country 		= Country::find_all();
        $vendors 		= Vendor::find_all();
		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"role"=>$role);
		return $startups;		
	}
    
    
    
	public function create(){
		if(!empty($_POST['vendid']) && !empty($_POST['compname']) && !empty($_POST['phone']) && !empty($_POST['email'])){
			
            if(Vendor::find_by_vendid($_POST['vendid'])){
                return 4; //Cannot enter Duplicated vendor ID
                exit;
            }
            
			$newVendor = new Vendor();
			if(isset($_FILES['fupload']) && $_FILES['fupload']['error']==0){ //if file upload is set
					move_uploaded_file($_FILES['fupload']['tmp_name'],"public/uploads/".basename($_FILES['fupload']['name']));
					$image = new Imageresize(); // an instance of image resize object
					$image->load("public/uploads/".basename($_FILES['fupload']['name']));
					//$image->image =;
					$image->resize(400,400);
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
					$newVendor->img_url = $photo;
					  
				}else{
					//$applicant->img_url = $_POST['imgvalue'];
				}
                
                
                              
			$newVendor->vend_id				            =	$_POST['vendid'];
			$newVendor->vend_name				        =	$_POST['compname'];
			$newVendor->vend_contact				    =	$_POST['contact'];
			$newVendor->vend_address				    =	$_POST['address'];
			$newVendor->vend_city			            =	$_POST['city'];
			$newVendor->vend_state			            =	$_POST['state'];
            $newVendor->vend_country                    =   $_POST['country'];
            $newVendor->vend_phone                      =   $_POST['phone'];
            $newVendor->vend_email                      =   $_POST['email'];
            $newVendor->vend_website                    =   $_POST['website'];
            $newVendor->vend_accno                      =   $_POST['accno'];
    		$newVendor->vend_datecreated			    =	date("Y-m-d H:i:s");
			
			if($newVendor->create()){
			 
				return 1;     //returns 1 on success                        
			}else{
			 return 2;       // returns 2 on insert error
			}
			
			
		}else{
		  return 3; //returns 3 if requiered input field is not supplied
		}
	}


    public function update()
    {
        if(!empty($_POST['vendid']) && !empty($_POST['compname']) && !empty($_POST['phone']) && !empty($_POST['email'])){
            $thisvendor                     =   Vendor::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['pgid']));
            
            //$thisvendor->vend_id				        =	$_POST['vendid'];
			$thisvendor->vend_name				        =	$_POST['compname'];
			$thisvendor->vend_contact				    =	$_POST['contact'];
			$thisvendor->vend_address				    =	$_POST['address'];
			$thisvendor->vend_city			            =	$_POST['city'];
			$thisvendor->vend_state			            =	$_POST['state'];
            $thisvendor->vend_country                   =   $_POST['country'];
            $thisvendor->vend_phone                     =   $_POST['phone'];
            $thisvendor->vend_email                     =   $_POST['email'];
            $thisvendor->vend_website                   =   $_POST['website'];
            $thisvendor->vend_accno                     =   $_POST['accno'];
    		$thisvendor->vend_datemodified			    =	date("Y-m-d H:i:s");
            
            
            if($thisvendor->update()){
                return 1;
            }else{
                  return 2;
            }
        }
    }
    public function delete($id){
        $article = Vendor::find_by_id($id);
        if($article->delete()){
            return true;
        }
    }
   
   
}
?>