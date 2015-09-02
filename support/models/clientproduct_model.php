<?php
class Clientproduct_Model extends Model{
    
    
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
		$resultEmployee = $database->db_query("SELECT * FROM client_product");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$myitems = Cproduct::find_by_sql("SELECT * FROM client_product ".$pagin->pgLimit($pn));
		
			$index_array =array( "clientproduct"=>$myitems,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
    

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
    
	public function getById($id){
		return Cproduct::find_by_id($id);
       // $myaccount = Accounts::find_by_phone($phone);
       
	}


	/**
     * this  get an auto complete 
     * method on client for the purchase
     * or orther form
     */
    public function clientID_AutoComplete($id=""){
        return (Client::find_by_sql("SELECT * FROM tbl_client WHERE name LIKE '%".$_POST['input']."%'"));
    }
    
    /**
     * this section is used to get auto complete
     * feature for the product 
     * textbox
     */
    public function prodID_AutoComplete($id=""){
        return (Product::find_by_sql("SELECT * FROM product WHERE prod_name LIKE '%".$_POST['input']."%'"));
    }
public function cProdID_AutoComplete($id=""){
		return (Cproduct::find_by_sql("SELECT * FROM client_product WHERE prod_name LIKE '%".$_POST['input']."%'"));
	}
	
	public function create(){
		if(!empty($_POST['clientid']) && !empty($_POST['prodname']) && !empty($_POST['serial']) &&  !empty($_POST["address"])){
			
            /*if(Client::find_by_id($_POST['clientid'])){
                return 4; //Ensures that user creates the clients before proceeding
                exit;
            }

             if(Client::find_by_id($_POST['prodid'])){
                return 5; //Cannot enter ensures that users enter an existing product in the category
                exit;
            }*/
     
			$newProduct = new Cproduct();
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
					$newProduct->img_url = $photo;
					  
				}else{
					//$applicant->img_url = $_POST['imgvalue'];
				}
                

                $cid = explode(",",$_POST["country"]);
				$newProduct->client_id 					=	$_POST["clientid"];
				$newProduct->client_name				=	$_POST["clientname"];
                $newProduct->prod_id                     =   $_POST["prodid"];
				$newProduct->prod_name					=	$_POST["prodname"];
				$newProduct->prod_serial				=	$_POST["serial"];
				$newProduct->install_address			=	$_POST["address"];
				$newProduct->install_country			=	$cid[1];
				$newProduct->install_state				=	$_POST["state"];
				$newProduct->install_city				=	$_POST["city"];
				$newProduct->install_status				=	0;
				$newProduct->status  					=	0;
                $newProduct->selling_price              =   $_POST["amount"];                     
				$newProduct->datecreated  				=	date("Y-m-d H:i:s");
				
              	    
			
			if($newProduct->create()){
			 
				return 1;     //returns 1 on success                        
			}else{
			 return 2;       // returns 2 on insert error
			}
			
			
		}else{
		  return 3; //returns 3 if requiered input field is not supplied
		}
	}
    
    
    
    public function update(){
		if(!empty($_POST['clientid']) && !empty($_POST["pgid"]) && !empty($_POST['prodname']) && !empty($_POST['serial']) &&  !empty($_POST["address"])){
			
            /*if(Client::find_by_id($_POST['clientid'])){
                return 4; //Ensures that user creates the clients before proceeding
                exit;
            }

             if(Client::find_by_id($_POST['prodid'])){
                return 5; //Cannot enter ensures that users enter an existing product in the category
                exit;
            }*/
     
			$thisclientproduct                    =   Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['pgid']));
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
					$thisclientproduct->img_url = $photo;
					  
				}else{
					//$applicant->img_url = $_POST['imgvalue'];
				}
                

                $cid = explode(",",$_POST["country"]);
				$thisclientproduct->client_id 					=	$_POST["clientid"];
				$thisclientproduct->client_name				    =	$_POST["clientname"];
                $thisclientproduct->prod_id                     =   $_POST["prodid"];
				$thisclientproduct->prod_name					=	$_POST["prodname"];
				$thisclientproduct->prod_serial				    =	$_POST["serial"];
				$thisclientproduct->install_address			    =	$_POST["address"];
				$thisclientproduct->install_country			    =	$cid[1];
				$thisclientproduct->install_state				=	$_POST["state"];
				$thisclientproduct->install_city				=	$_POST["city"];
				$thisclientproduct->install_status				=	0;
				$thisclientproduct->status  					=	0;
                $thisclientproduct->selling_price               =   $_POST["amount"];                     
				$thisclientproduct->datemodified  				=	date("Y-m-d H:i:s");
				
              	    
			
			if($thisclientproduct->update()){
			 
				return 1;     //returns 1 on success                        
			}else{
			 return 2;       // returns 2 on insert error
			}
			
			
		}else{
		  return 3; //returns 3 if requiered input field is not supplied
		}
	}
    
    public function updateSchedule(){
        if(!empty($_POST['sdate']) && !empty($_POST['cid'])){
            $thisclientproduct  =   Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['cid']));
            $postable = $_POST['sdate'];
            $thisclientproduct->last_maint_date     =   $postable;
            
            $date = new DateTime($postable);
            $interval = new DateInterval('P3M');
            $date->add($interval);
            $thisclientproduct->next_maint_date     =  $date->format("Y-m-d H:i:s");
            
            if($thisclientproduct->update()){
                return true;
            }else{
                return false;
            }
            
            
        }
        
        
    }
    
    public function createsignoff(){
		if(isset($_POST['prod_id']) && !empty($_POST['prod_id'])){
			$error = array();
			$obj = new Sign_off();
			$obj->prod_id = $_POST['prod_id'];	
			$obj->mag_strip = isset($_POST['mag_strip']) ? 1:0;
			$obj->verve_card = isset($_POST['verve']) ? 1:0;
			$obj->master_card = isset($_POST['master_card']) ? 1:0;;
			$obj->visa_card = isset($_POST['visa_card']) ? 1:0;;
			$obj->withdraw = isset($_POST['withdraw']) ? $_POST['withdraw']:"";
			$obj->witdraw_comment = isset($_POST['withdraw_area']) ? htmlspecialchars(strip_tags($_POST['withdraw_area'])):"";
			$obj->balance = isset($_POST['balance']) ? $_POST['balance']:"";
			$obj->balance_comment = isset($_POST['balance_area']) ? htmlspecialchars(strip_tags($_POST['balance_area'])):"";
			$obj->statement = isset($_POST['statement']) ? $_POST['statement']:"";
			$obj->statement_comment = isset($_POST['statement_area']) ? htmlspecialchars(strip_tags($_POST['statement_area'])):"";
			$obj->transfer = isset($_POST['transfer']) ? $_POST['transfer']:"";
			$obj->transfer_comment = isset($_POST['transfer_area']) ? htmlspecialchars(strip_tags($_POST['transfer_area'])):"";
			$obj->pin_change = isset($_POST['pin_change']) ? $_POST['pin_change']:"";
			$obj->pin_change_comment = isset($_POST['pin_change_area']) ? htmlspecialchars(strip_tags($_POST['pin_change_area'])):"";
			$obj->mobile_recharge = isset($_POST['mobile_recharge']) ? $_POST['mobile_recharge']:"";
			$obj->mobile_recharge_comment = isset($_POST['mobile_recharge_area']) ? htmlspecialchars(strip_tags($_POST['mobile_recharge_area'])):"";
			$obj->camera_instal;
			$obj->inverter_status;
			$obj->AC_status;
			$obj->ATM_room_cond;
			$obj->cse_remark;
			$obj->client_remark;
			$obj->employee_id;
			$obj->scan_url;
		}
	}
    
    
    public function updatesignoff(){
		if(isset($_POST['prod_id']) && !empty($_POST['prod_id'])){
			$error = array();
			$obj = new Sign_off();
			$obj->prod_id = $_POST['prod_id'];	
			$obj->mag_strip = isset($_POST['mag_strip']) ? 1:0;
			$obj->verve_card = isset($_POST['verve']) ? 1:0;
			$obj->master_card = isset($_POST['master_card']) ? 1:0;;
			$obj->visa_card = isset($_POST['visa_card']) ? 1:0;;
			$obj->withdraw = isset($_POST['withdraw']) ? $_POST['withdraw']:"";
			$obj->witdraw_comment = isset($_POST['withdraw_area']) ? htmlspecialchars(strip_tags($_POST['withdraw_area'])):"";
			$obj->balance = isset($_POST['balance']) ? $_POST['balance']:"";
			$obj->balance_comment = isset($_POST['balance_area']) ? htmlspecialchars(strip_tags($_POST['balance_area'])):"";
			$obj->statement = isset($_POST['statement']) ? $_POST['statement']:"";
			$obj->statement_comment = isset($_POST['statement_area']) ? htmlspecialchars(strip_tags($_POST['statement_area'])):"";
			$obj->transfer = isset($_POST['transfer']) ? $_POST['transfer']:"";
			$obj->transfer_comment = isset($_POST['transfer_area']) ? htmlspecialchars(strip_tags($_POST['transfer_area'])):"";
			$obj->pin_change = isset($_POST['pin_change']) ? $_POST['pin_change']:"";
			$obj->pin_change_comment = isset($_POST['pin_change_area']) ? htmlspecialchars(strip_tags($_POST['pin_change_area'])):"";
			$obj->mobile_recharge = isset($_POST['mobile_recharge']) ? $_POST['mobile_recharge']:"";
			$obj->mobile_recharge_comment = isset($_POST['mobile_recharge_area']) ? htmlspecialchars(strip_tags($_POST['mobile_recharge_area'])):"";
			$obj->camera_instal;
			$obj->inverter_status;
			$obj->AC_status;
			$obj->ATM_room_cond;
			$obj->cse_remark;
			$obj->client_remark;
			$obj->employee_id;
			$obj->scan_url;
		}
	}
    
    public function scheduleMaintenance(){
        
    }
    
}
?>