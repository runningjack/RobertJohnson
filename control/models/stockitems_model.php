<?php
class Stockitems_Model extends Model{
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
        
        
        
        $itemnamefield ="";
        $descfield ="";
        $condifield ="";
              
		print_r($_POST['condi']);
        /**
		 * of all the filter fields if only one field is set
		 */
         $filterResult ="";
         if(isset($_POST['itemname']) && !empty($_POST['itemname'])){
            $itemnamefield .= " AND item_name = '".$_POST['itemname']."' ";
         }
         if(isset($_POST['descript']) && !empty($_POST['descript'])){
            $descfield .= " AND item_description LIKE '%".$_POST['descript']."%' ";
         }
         
         if(!empty($_POST['price']) && !empty($_POST['condi'])){
            $condifield .= " AND item_cost ".$_POST['condi']." ".$_POST["price"];
         } 
         
         
         
         if(!empty($_POST['fdate']) && !empty($_POST['tdate'])){
            $datefield .= " AND datecreated BETWEEN  '".$_POST['fdate']."' AND '".$_POST['tdate']."' ";
         }
          if(empty($_POST['fdate']) && !empty($_POST['tdate'])){
            $datefield .= " AND datecreated < '".$_POST['tdate']."' ";
         }
          if(!empty($_POST['fdate']) && empty($_POST['tdate'])){
            $datefield .= " AND datecreated >  '".$_POST['fdate']."'  ";
         }
        
        $filterResult .=" WHERE id !='' ". $itemnamefield.$descfield.$condifield;
        
        
        
		global $database;
		$resultEmployee = $database->db_query("SELECT * FROM items ".$filterResult);
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$myitems = Items::find_by_sql("SELECT * FROM items ".$filterResult." ".$pagin->pgLimit($pn));
		$index_array =array( "items"=>$myitems,"mypagin"=>$pagin->render($pg));
		return $index_array;
	}
    
    
	public function getById($id){
		return Items::find_by_id($id);
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
        $items 		= Items::find_all();
		$zone 			= Zone::find_by_sql("SELECT * FROM zone WHERE country_id=156");
		$startups 		= array("departs"=>$depts,"country"=>$country,"state"=>$zone,"items"=>$items,"role"=>$role);
		return $startups;		
	}
    
    
    
	public function create(){
		if(!empty($_POST['itemid']) && !empty($_POST['itemnames']) && !empty($_POST['qty']) ){
			
			$newItem = new Items();
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
					$applicant->img_url = $photo;
					  
				}else{
					//$applicant->img_url = $_POST['imgvalue'];
				}
                
                
                              
			$newItem->item_id				        =	$_POST['itemid'];
			$newItem->item_name				        =	$_POST['itemnames'];
			$newItem->item_description				=	$_POST['descript'];
			$newItem->item_type				        =	$_POST['ttype'];
			$newItem->item_cost			            =	$_POST['cprice'];
			$newItem->item_quantity			        =	$_POST['qty'];
            $newItem->item_isbn                     =   $_POST['isbn'];
            $newItem->item_serial                   =   $_POST['serial'];
			
			$newItem->item_dateadded			    =	date("Y-m-d H:i:s");
			
			if($newItem->create()){
			 
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
        if(isset($_POST['itemnames']) && !empty($_POST['itemid']) && !empty($_POST['pgid'])){
            $thisItem                     =   Items::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['pgid']));
            
            $newItem->item_id				        =	$_POST['itemid'];
			$newItem->item_name				        =	$_POST['itemnames'];
			$newItem->item_description				=	$_POST['descript'];
			$newItem->item_type				        =	$_POST['ttype'];
			$newItem->item_cost			            =	$_POST['cprice'];
			$newItem->item_quantity			        =	$_POST['qty'];
            $newItem->item_isbn                     =   $_POST['isbn'];
            $newItem->item_serial                   =   $_POST['serial'];
            
            $thisItem->item_datemodified                =   date("Y-m-d H:i:s");
            if($thisItem->update()){
                return 1;
            }else{
                  return 2;
            }
        }
    }
    
    
    public function checkTransLog($id){
        if(!empty($id)){
            $transaction        =       Transaction::find_by_main_id($id);
            if($transaction){
                //echo "<p><strong class='alert-box alert'>Record cannot be deleted! <br /> History already existing for this record</strong></p>";
                return 2;
            }elseif(!$transaction){
                $merole      =  Items::find_by_itemid($id);
             if($merole->delete()) {
                print_r($merole);
                return 1;
             }   
            }else{
                return 3; ///Unexpected Error
            }            
        }
    }
    
    
    
    public function delete($id){
        $article = Items::find_by_id($id);
        if($article->delete()){
            return true;
        }
    }
   
   
}
?>