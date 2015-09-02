<?php
	class Itdepartment_Model extends Model{
	   public function __construct(){
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
		$resultEmployee = $database->db_query("SELECT * FROM employee WHERE emp_dept=5");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$myEmployee = Ticket::find_by_sql("SELECT * FROM employee WHERE emp_dept=5 ".$pagin->pgLimit($pn));
		
			$index_array =array( "myemployee"=>$myEmployee,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
	
	/**
	 * mothod to get the list of
     * sign off
	 */
	public function getSignOffList($id="",$pg){
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
		$resultEmployee = $database->db_query("SELECT * FROM sign_off_form ");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$mysignoff = Ticket::find_by_sql("SELECT * FROM sign_off_form ".$pagin->pgLimit($pn));
		
			$index_array =array( "signoff"=>$mysignoff,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
    
    public function getWorkSheetList($id="",$pg){
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
		$resultWorksheet = $database->db_query("SELECT * FROM work_sheet_form ");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultWorksheet);
		$pagin->itemsPerPage = 20;
		
		$myworksheets = Ticket::find_by_sql("SELECT * FROM work_sheet_form ".$pagin->pgLimit($pn));
		
			$index_array =array( "worksheet"=>$myworksheets,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
    
    
    public function getScheduleList($id="",$pg){
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
		$resultSchedule = $database->db_query("SELECT * FROM schedule ");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultWorksheet);
		$pagin->itemsPerPage = 20;
		
		$AllSchedule = Schedule::find_by_sql("SELECT * FROM schedule ".$pagin->pgLimit($pn));
		
			$index_array =array( "schedules"=>$AllSchedule,
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
        $clietproducts  = Cproduct::find_all();
		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"role"=>$role,'products'=>$clietproducts);
		return $startups;		
	}
    
    public function  creatworksheet(){
        if( !empty($_POST["prod_id"]) && !empty($_POST["w_date"]) ){
            $newWorkSheet = new Worksheet();
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
					$newWorkSheet->scan_url = $photo;
					  
				}else{
					//$applicant->img_url = $_POST['imgvalue'];
				}
                
                
                              
    			
                $newWorkSheet->prod_id              =   $_POST["prod_id"];
                $newWorkSheet->prod_name            =   "";
                $newWorkSheet->sheet_date           =   $_POST["w_date"];
            	$newWorkSheet->time_in              =   $_POST["time_in"];
            	$newWorkSheet->time_out             =   $_POST["time_out"];
            	$newWorkSheet->contact_person       =   $_POST["contact_person"];
            	$newWorkSheet->cse_emp_id           =   $_POST["emp_id"];
            	$newWorkSheet->problem              =   $_POST["problem"];
            	$newWorkSheet->cause                =   $_POST["cause"];
                $newWorkSheet->corrective_action    =   $_POST["corrective_action"];
            	$newWorkSheet->part_changed         =   $_POST["part_changed"];
            	$newWorkSheet->cse_remark           =   $_POST["cse_remark"];
            	$newWorkSheet->client_remark        =   $_POST["client_remark"];
                $newWorkSheet->datecreated          =   date("Y-m-d H:i:s");
              global $session;  			
			if($newWorkSheet->create()){
			 
			 $_SESSION["message"]="<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
				return 1;     //returns 1 on success                        
			}else{
			 $_SESSION["message"]="<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
			 return 2;       // returns 2 on insert error
			}
			
			
		}else{
		  $_SESSION["message"]="<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		  return 3; //returns 3 if requiered input field is not supplied
		}
        
    }
   
    
     
    
    
   	public function createsignoff(){
		if(isset($_POST['prod_id']) && !empty($_POST['prod_id'])){
			$error = array();
            $obj = new Sign_off();
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
					$obj->scan_url = $photo;
					  
				}else{
					//$applicant->img_url = $_POST['imgvalue'];
				}
			
			$obj->prod_id                        = $_POST['prod_id'];	
			//$obj->mag_strip                      = isset($_POST['mag_strip']) ? 1:0;
			$obj->verve_card                     = isset($_POST['verve']) ? 1:0;
			$obj->master_card                    = isset($_POST['master_card']) ? 1:0;;
			$obj->visa_card                      = isset($_POST['visa_card']) ? 1:0;;
			$obj->withdraw                       = isset($_POST['withdraw']) ? $_POST['withdraw']:"";
			$obj->witdraw_comment                = isset($_POST['withdraw_area']) ? $_POST['withdraw_area']:"";
			$obj->balance                        = isset($_POST['balance']) ? $_POST['balance']:"";
			$obj->balance_comment                = isset($_POST['balance_area']) ? $_POST['balance_area']:"";
			$obj->statement                      = isset($_POST['statement']) ? $_POST['statement']:"";
			$obj->statement_comment              = isset($_POST['statement_area']) ? $_POST['statement_area']:"";
			$obj->transfer                       = isset($_POST['transfer']) ? $_POST['transfer']:"";
			$obj->transfer_comment               = isset($_POST['transfer_area']) ? $_POST['transfer_area']:"";
			$obj->pin_change                     = isset($_POST['pin_change']) ? $_POST['pin_change']:"";
			$obj->pin_change_comment             = isset($_POST['pin_change_area']) ? $_POST['pin_change_area']:"";
			$obj->mobile_recharge                = isset($_POST['mobile_recharge']) ? $_POST['mobile_recharge']:"";
			$obj->mobile_recharge_comment        = isset($_POST['mobile_recharge_area']) ? $_POST['mobile_recharge_area']:"";
			$obj->camera_instal                  = isset($_POST['camera']) ? $_POST['camera']:"";
			$obj->inverter_status                =  $_POST["inverter"];
			$obj->AC_status                      =   $_POST["air_cond"];
			$obj->ATM_room_cond                  =   $_POST['atm_room'];
			$obj->cse_remark                     =   $_POST['cse_remark'];
			$obj->client_remark                  =   $_POST['client_remark'];
			$obj->employee_id                    =   $_SESSION["emp_ident"];
             global $session;
		if($obj->create()){
			
			 $_SESSION["message"]="<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
				return 1;     //returns 1 on success                        
			}else{
			  $_SESSION["message"]="<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
			 return 2;       // returns 2 on insert error
               
			}
			
			
		}else{
		  $_SESSION["message"]="<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		  return 3; //returns 3 if requiered input field is not supplied
		}
	}
    
    /**
     * Add tastsupport find task
     */
    public function getTaskById($id){
        return Schedule::find_by_id($id);
        
    }
    
    public function getTaskBySql(){
        return Schedule::find_by_sql();
    }
    
    public function getWorkSheetByID($id){
        return Worksheet::find_by_id($id);
        
    }
    
    public function getEmployee($id){
        return Employee::find_by_id($id);
        
    }
    
    
    
    /**
     * section to update 
     * work sheet on support
     * or care resource
     * supply
     */
     
     public function updateWorkSheet($id){
        if(isset($_POST['pgid'])){
            
            if(isset($_POST["prod_id"])){
                $cproduct = Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST["prod_id"]));
            }
            
            $WorkSheet                       =    Worksheet::find_by_id((int)preg_replace('#[^0-9]#i','',$id));
            $WorkSheet->prod_id              =   (isset($_POST["prod_id"]) && !empty($_POST["prod_id"])) ? $_POST["prod_id"] : $WorkSheet->prod_id;           
            $WorkSheet->prod_name            =   (isset($_POST["prod_id"]) && !empty($_POST["prod_id"])) ? $cproduct->prod_name : $WorkSheet->prod_name;
            $WorkSheet->sheet_date           =   (isset($_POST["w_date"]) && !empty($_POST["w_date"])) ? $_POST["w_date"] : $WorkSheet->sheet_date;
            $WorkSheet->time_in              =   (isset($_POST["time_in"]) && !empty($_POST["time_in"])) ? $_POST["time_in"] : $WorkSheet->time_in;
            $WorkSheet->time_out             =   (isset($_POST["time_out"]) && !empty($_POST["time_out"])) ? $_POST["time_out"] : $WorkSheet->time_out;
            $WorkSheet->contact_person       =   (isset($_POST["contact_person"]) && !empty($_POST["contact_person"])) ? $_POST["contact_person"] : $WorkSheet->contact_person;
            $WorkSheet->cse_emp_id           =   (isset($_POST["emp_id"]) && !empty($_POST["emp_id"])) ? $_POST["emp_id"] : $WorkSheet->emp_id;
            $WorkSheet->problem              =   (isset($_POST["problem"]) && !empty($_POST["problem"])) ? $_POST["problem"] : $WorkSheet->problem;
            $WorkSheet->cause                =   (isset($_POST["cause"]) && !empty($_POST["cause"])) ? $_POST["cause"] : $WorkSheet->cause;
            $WorkSheet->corrective_action    =   (isset($_POST["corrective_action"]) && !empty($_POST["corrective_action"])) ? $_POST["corrective_action"] : $WorkSheet->corrective_action;
            $WorkSheet->part_changed         =   (isset($_POST["part_changed"]) && !empty($_POST["part_changed"])) ? $_POST["part_changed"] : $WorkSheet->part_changed;
            $WorkSheet->cse_remark           =   (isset($_POST["cse_remark"]) && !empty($_POST["cse_remark"])) ? $_POST["cse_remark"] : $WorkSheet->cse_remark;
            $WorkSheet->client_remark        =   (isset($_POST["client_remark"]) && !empty($_POST["client_remark"])) ? $_POST["client_remark"] : $WorkSheet->client_remark;
            $WorkSheet->datemodified         =   date("Y-m-d H:i:s");
            $WorkSheet->fund                 =   (isset($_POST["fund"]) && !empty($_POST["fund"])) ? $_POST["fund"] : $WorkSheet->fund;  
            $WorkSheet->part_supplied        =   (isset($_POST["parts"]) && !empty($_POST["parts"])) ? $_POST["parts"] : $WorkSheet->part_supplied;
            
            global $session;
		if($WorkSheet->update()){
			
			 $_SESSION["message"]="<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
				return 1;     //returns 1 on success                        
			}else{
			  $_SESSION["message"]="<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
			 return 2;       // returns 2 on insert error
               
			}
            
        }
     }
}
?>
