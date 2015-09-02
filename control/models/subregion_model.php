<?php
class Subregion_Model extends Model{
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
		$resultEmployee = $database->db_query("SELECT * FROM subarea");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		$myitems = Subarea::find_by_sql("SELECT * FROM subarea ORDER BY id DESC ".$pagin->pgLimit($pn));
		$index_array =array( "regions"=>$myitems,"mypagin"=>$pagin->render($pg));
		return $index_array;
	}
    
    
	public function getById($id){
		return Subarea::find_by_id($id);
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
		if(!empty($_POST['area'])){
			
                        
			$thisArea = new Subarea();
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
					$thisArea->img_url = $photo;
					  
				}else{
					//$applicant->img_url = $_POST['imgvalue'];
				}
                $areaid                         =   explode(",",$_POST['area']);
                $areaid                         =   $areaid[0];
                $thisArea->name                 =   $_POST['subregion'];
                $thisArea->des                 =   $_POST['description'];
                $thisArea->area_id              =   $areaid; 
                //print_r($areaid);
	            $thisArea->datecreated          =   date("Y:m:s H:i:s");
              
			if($thisArea->create()){
			 
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
        if(!empty($_POST['area']) && !empty($_POST['pgid']) ){
            $thisArea                    =   Subarea::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['pgid']));
            
            $thisArea->name                              =   $_POST['subregion'];
            $thisArea->des                       =   $_POST['description'];
            $thisArea->area_id                          =   $_POST['area'];                 
	       	$thisArea->datemodified			     =	 date("Y-m-d H:i:s");

            if($thisArea->update()){
                return 1;
            }else{
                  return 2;
            }
        }
    }
    public function delete($id){
        $article = Subarea::find_by_id($id);
        if($article->delete()){
            return true;
        }
    }
   
   
}
?>