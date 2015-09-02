<?php
class Products_Model extends Model{
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
		$resultEmployee = $database->db_query("SELECT * FROM product2");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		$myitems = Product::find_by_sql("SELECT * FROM product2 ORDER BY prod_id DESC ".$pagin->pgLimit($pn));
		$index_array =array( "products"=>$myitems,"mypagin"=>$pagin->render($pg));
		return $index_array;
	}
    
    
	public function getById($id){
		return Product::find_by_id($id);
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
		$area			= Area::find_all();
		$country 		= Country::find_all();
        $vendors 		= Vendor::find_all();
		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"area"=>$area);
		return $startups;		
	}
    
    
    
	public function create(){
		if(!empty($_POST['pname'])){
			
            global $session;            
			$thisProduct = new Product();
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
					$thisProduct->prod_image = $photo;
					  
				}else{
					//$applicant->img_url = $_POST['imgvalue'];
				}
                
                $thisProduct->prod_name                 =   $_POST['pname'];
                $thisProduct->prod_desc                 =   $_POST['description'];
                $thisProduct->prod_created               =   date("Y:m:s H:i:s");
              
			if($thisProduct->create()){
			 $_SESSION['message'] = "<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
				return 1;     //returns 1 on success                        
			}else{
			 $_SESSION['message']   =  "<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
			 return 2;       // returns 2 on insert error
			}
			
			
		}else{
		  $_SESSION['message'] = "<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
		  return 3; //returns 3 if requiered input field is not supplied
		}
	}


    public function update()
    {
        if(!empty($_POST['pname']) && !empty($_POST['pgid']) ){
            $Produc                    =   Product::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['pgid']));
            
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
					$Produc->prod_image = $photo;
					  
				}else{
					$Produc->prod_image = $_POST['imgvalue'];
				}
            
            
                $Produc->prod_name                 =   $_POST['pname'];
                $Produc->prod_desc                 =   $_POST['description'];
                $Produc->prod_modified             =   date("Y:m:s H:i:s");

            if($Produc->update()){
                $_SESSION['message'] = "<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
                return 1;
            }else{
                $_SESSION['message']   =  "<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
                  return 2;
            }
        }else{
             $_SESSION['message']   =  "<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
                  return 3;
        }
    }
    
    
    public function checkTransLog($id){
        if(!empty($id)){
            
            $transaction        =       Transaction::find_by_main_id($id);
           print_r($transaction);
            if($transaction){
                //echo "<p><strong class='alert-box alert'>Record cannot be deleted! <br /> History already existing for this record</strong></p>";
                    return 2;
            }else{
                $merole      =  Product::find_by_mainid(trim($id)) ;
               print_r($merole);
              if($merole->delete()) {
               return 1;
              }  
            }         
        }
    }
    
    
    public function delete($id){
        $article = Product::find_by_id($id);
        if($article->delete()){
            return true;
        }
    }
   
   
}
?>