<?php
	class Support_Model extends Model{
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
        
        
        $statusfield ="";
        $clientidfield ="";
        $issuefiels ="";
        $locationfield ="";
        $datefield  ="";
        
		
        /**
		 * of all the filter fields if only one field is set
		 */
         $filterResult ="";
         if(isset($_POST['status']) && !empty($_POST['status'])){
            $statusfield .= " AND status = '".$_POST['status']."' ";
         }
         if(isset($_POST['clientid']) && !empty($_POST['clientid'])){
            $clientidfield .= " AND client_id='".$_POST['clientid']."' ";
         }
         
         if(isset($_POST['issue']) && !empty($_POST['issue'])){
            $issuefield .= " AND issue='".$_POST['issue']."' ";
         }
         if(isset($_POST['location']) && !empty($_POST['location'])){
            $locationfield .= " AND location='".$_POST['location']."' ";
         }
         
         if(isset($_POST['issue']) && !empty($_POST['issue'])){
            $issuefield .= " OR issue LIKE '%".$_POST['issue']."%' ";
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
        
        $filterResult .= $clientidfield.$locationfield.$issuefield.$datefield ;
        
		global $database;
		$resultEmployee = $database->db_query("SELECT * FROM support_ticket WHERE status='Open' OR status='Customer Reply'");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$myitems = Ticket::find_by_sql("SELECT * FROM support_ticket WHERE status='Open' OR status='Customer Reply' ORDER BY id DESC ". $filterResult." ".$pagin->pgLimit($pn));
		
			$index_array =array( "Supportticket"=>$myitems,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
    
    
    	public function getListClient($id="",$pg){
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
		$resultEmployee = $database->db_query("SELECT * FROM support_ticket");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$myitems = Ticket::find_by_sql("SELECT * FROM support_ticket WHERE client_id ='".$_SESSION["client_ident"]."' ".$pagin->pgLimit($pn));
		
			$index_array =array( "Supportticket"=>$myitems,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
	
	public function getById($id){
		return Ticket::find_by_id($id);
       // $myaccount = Accounts::find_by_phone($phone);
	}
	
	/**
     * load initail data for support ticket form needed during 
     * creating and editing support ticket
     * data 
     */
    
	public function getData(){
		global $database;
		$depts 			= Department::find_all();
		$role			= Roles::find_all();
		$country 		= Country::find_all();
        $vendors 		= Vendor::find_all();
		$myproducts		= Cproduct::find_all();
        /**
         * issues may arise that when database
         * is cleared emp_dept may not be 5
         */
        $techEmployee   = Employee::find_by_sql("SELECT * FROM employee WHERE emp_dept = 5");
		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"role"=>$role,"myproducts"=>$myproducts,"techstaff"=>$techEmployee);
		return $startups;		
	}
    
    
    /**
     * section that is used
     * to get support ticket information
     * basically needed tickets and associated
     * replies
     */
    public function getTicketData($id=""){
        $replies        =  Ticketreply::find_by_ticket($id);
        $ticket         =   Ticket::find_by_id($id);
        $tickdata       =   array("ticket"=>$ticket,"replies"=>$replies);
        return $tickdata;
    }
    
    /**
     * Dashboard statistics section
     */
     
     public function getDashboardStat(){
        global $database;
		$darray =  array();
		$open_ticket_count = ($database->dbNumRows($database->db_query("SELECT * FROM support_ticket WHERE status ='Open' ")));
        $open_schedule_count      =   ($database->dbNumRows($database->db_query("SELECT * FROM schedule WHERE status ='Open' ")));
        $open_worksheet_count         =   ($database->dbNumRows($database->db_query("SELECT * FROM work_sheet_form WHERE status ='Open' ")));
		$awaiting_ticket_count = ($database->dbNumRows($database->db_query("SELECT * FROM support_ticket WHERE status ='Customer Reply' ")));
        $closed_worksheet_count = ($database->dbNumRows($database->db_query("SELECT * FROM work_sheet_form WHERE status ='Closed' ")));
        $client_count           =($database->dbNumRows($database->db_query("SELECT * FROM tbl_client")));  
        $client_products           =($database->dbNumRows($database->db_query("SELECT * FROM client_product"))); 
		$darray = array("cproducts"=>$client_products,"clients"=>$client_count,"oworksheet"=>$open_worksheet_count,"oschedule"=>$open_schedule_count,"otcount"=>$open_ticket_count,"atcount"=>$awaiting_ticket_count);
		return $darray;
     }
    
    /**
     * function to handle client 
     * reply to a ticket
     */
    public function createAdminReply($id){
        
        if(isset($_POST["issues"]) && isset($_POST["conname"])){
            $newReply = new Ticketreply();
            $newReply->sender_id        =       $_SESSION["emp_ident"];
            $newReply->ticket_id        =       $id;
            $theUser                    =       Employee::find_by_id($_SESSION["emp_ident"]);
            $cemail                     =       array();
            $newReply->sender_name      =       $theUser->emp_fname." ".$theUser->emp_lname;
            $newReply->sender_type      =       "Admin";
            $newReply->message          =       $_POST['issues'];
            $newReply->datecreated      =       date("Y-m-d H:i:s");
            $cemail                     =       (!empty($_POST['cemail'])) ? explode(",",$_POST['cemail']) : "";
            
            $partTicket                 = Ticket::find_by_id($id);
           // print_r($partTicket);
                array_push($cemail,$partTicket->contact_email,$theUser->emp_email);
                $client                     =       Client::find_by_id($partTicket->client_id);
           // print_r($client);
                $partTicket->status         ="Admin Reply";
                $partTicket->datemodified   = date("Y-m-d H:i:s");
                //print_r($cemail);
                //mail("amedora09@gmail.com","Robert Johnson Holdings, Technical Support" , "all good");
                $this->sendMail($newReply->sender_name,"Robert Johnson Holdings(Technical Support)" ,$newReply->message,$cemail);
            if($newReply->create()){
                $partTicket->update();
                
                return 1;
            }else{
                return 2;
            }
        }else{
            return 3;
        }
    }
    
   
    
    
    
    /**
     * data from itdepartment model
     */
     
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
    
    public function getWorkSheetEmployeeid($id="",$pg){
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
		$resultWorksheet = $database->db_query("SELECT * FROM work_sheet_form WHERE cse_emp_id =".$id );
        //print_r($resultWorksheet);
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultWorksheet);
		$pagin->itemsPerPage = 20;
		
		$myworksheets = Worksheet::find_by_sql("SELECT * FROM work_sheet_form WHERE cse_emp_id =".$id." "  .$pagin->pgLimit($pn));
		print_r($myworksheets);
			$index_array =array( "worksheet"=>$myworksheets,
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
    
    
   	/**
 * public function getData(){
 * 		global $database;
 * 		$depts 			= Department::find_all();
 * 		$role			= Roles::find_all();
 * 		$country 		= Country::find_all();
 *         $vendors 		= Vendor::find_all();
 * 		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
 *         $clietproducts  = Cproduct::find_all();
 * 		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"role"=>$role,'products'=>$clietproducts);
 * 		return $startups;		
 * 	}
 */
    
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
                
                
                $mySchedule         =   Schedule::find_by_id($_POST['wsid']);
    			
                $newWorkSheet->prod_id              =   $_POST["prod_id"];
                $newWorkSheet->formid               =   $_POST['wsid'];
                $newWorkSheet->prod_name            =   $mySchedule->prod_name;
                $newWorkSheet->sheet_date           =   $_POST["w_date"];
            	$newWorkSheet->time_in              =   $_POST["time_in"];
            	$newWorkSheet->time_out             =   $_POST["time_out"];
            	$newWorkSheet->contact_person       =   $_POST["contact_person"];
            	$newWorkSheet->cse_emp_id           =   empty($_POST["emp_id"]) ? $mySchedule->emp_id : $_POST['emp_id'];
            	$newWorkSheet->problem              =   empty($_POST["problem"]) ? $mySchedule->issue : $_POST['problem'] ;
            	$newWorkSheet->cause                =   $_POST["cause"];
                $newWorkSheet->corrective_action    =   $_POST["corrective_action"];
            	$newWorkSheet->part_changed         =   $_POST["part_changed"];
            	$newWorkSheet->cse_remark           =   $_POST["cse_remark"];
            	$newWorkSheet->client_remark        =   $_POST["client_remark"];
                $newWorkSheet->datecreated          =   date("Y-m-d H:i:s");
              global $session;  			
			if($newWorkSheet->create()){
			// $schedulee      =   Schedule::find_by_id($_POST["wsid"]);
             
             $mySchedule->status =   "Closed";
             $mySchedule->datemodified  =   date("Y:m:d H:i:s");
			 $mySchedule->update();
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
			
			$obj->prod_id                        =   $_POST['prod_id'];	
			$obj->mag_stripe                     =   isset($_POST['mag_stripe']) ? 1:0;
			$obj->verve_card                     =   isset($_POST['verve']) ? 1:0;
			$obj->master_card                    =   isset($_POST['master_card']) ? 1:0;;
			$obj->visa_card                      =   isset($_POST['visa_card']) ? 1:0;;
			$obj->withdraw                       =   $_POST['withdraw'];
			$obj->withdraw_comment               =   $_POST['withdraw_area'];
			$obj->balance                        =   $_POST['balance'];
			$obj->balance_comment                =   $_POST['balance_area'];
			$obj->statement                      =   $_POST['statement'];
			$obj->statement_comment              =   $_POST['statement_area'];
			$obj->transfer                       =   $_POST['transfer'];
			$obj->transfer_comment               =   $_POST['transfer_area'];
			$obj->pin_change                     =   $_POST['pin_change'];
			$obj->pin_change_comment             =   $_POST['pin_change_area'];
			$obj->mobile_recharge                =   $_POST['mobile_recharge'];
			$obj->mobile_recharge_comment        =   $_POST['mobile_recharge_area'];
			$obj->camera_instal                  =   $_POST['camera'];
			$obj->inverter_status                =   $_POST["inverter"];
			$obj->AC_status                      =   $_POST["air_cond"];
			$obj->ATM_room_cond                  =   $_POST['atm_room'];
			$obj->cse_remark                     =   $_POST['cse_remark'];
			$obj->client_remark                  =   $_POST['client_remark'];
			$obj->employee_id                    =   $_SESSION["emp_ident"];
            $obj->datecreated                    =   date("Y-m-d H:i:s");
            $obj->status                         =   "Closed";
            
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
    
    
    
    public function updatesignoff(){
		if(isset($_POST['prod_id']) && !empty($_POST['prod_id']) && !empty($_POST['pgid'])){
			$error = array();
            $obj = Sign_off::find_by_id($_POST['pgid']);
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
			
			$obj->prod_id                        =   $_POST['prod_id'];	
			$obj->mag_stripe                     =   isset($_POST['mag_stripe']) ? 1:0;
			$obj->verve_card                     =   isset($_POST['verve']) ? 1:0;
			$obj->master_card                    =   isset($_POST['master_card']) ? 1:0;;
			$obj->visa_card                      =   isset($_POST['visa_card']) ? 1:0;;
			$obj->withdraw                       =   $_POST['withdraw'];
			$obj->withdraw_comment                =   $_POST['withdraw_area'];
			$obj->balance                        =   $_POST['balance'];
			$obj->balance_comment                =   $_POST['balance_area'];
			$obj->statement                      =   $_POST['statement'];
			$obj->statement_comment              =   $_POST['statement_area'];
			$obj->transfer                       =   $_POST['transfer'];
			$obj->transfer_comment               =   $_POST['transfer_area'];
			$obj->pin_change                     =   $_POST['pin_change'];
			$obj->pin_change_comment             =   $_POST['pin_change_area'];
			$obj->mobile_recharge                =   $_POST['mobile_recharge'];
			$obj->mobile_recharge_comment        =   $_POST['mobile_recharge_area'];
			$obj->camera_instal                  =   $_POST['camera'];
			$obj->inverter_status                =   $_POST["inverter"];
			$obj->AC_status                      =   $_POST["air_cond"];
			$obj->ATM_room_cond                  =   $_POST['atm_room'];
			$obj->cse_remark                     =   $_POST['cse_remark'];
			$obj->client_remark                  =   $_POST['client_remark'];
			//$obj->employee_id                    =   $_SESSION["emp_ident"];
            $obj->datemodified                   =   date("Y-m-d H:i:s");
            $obj->status                         =   "Closed";
            
             global $session;
		if($obj->update()){
			
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
    
    public function getSignOffByID($id){
        return Sign_off::find_by_id($id);
    }
    
    public function getEmployee($id){
        return Employee::find_by_id($id);
        
    }
    
    public function getClientProdByID($id){
        return Cproduct::find_by_id($id);
    }
    
    public function getClientByID($id){
        return Client::find_by_id($id);
    }
    
    
    public function getProdPartByWorkID($id){
        return Prodpart::find_by_WSheet($id);
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
     
     
     
     
      /**
     * method to close a ticket
     * 
     */
     
     public function closeTicket(){
        if(isset($_POST['id']) && !empty($_POST["id"])){
            $partTicket = Ticket::find_by_id($_POST["id"]);
            $partTicket->status     =   "Closed";
            $theUser                =   Employee::find_by_id($_SESSION['emp_ident']);
            
            $cemail                     =       (!empty($_POST['cemail'])) ? explode(",",$_POST['cemail']) : "";
            
           
           // print_r($partTicket);
                array_push($cemail,$partTicket->contact_email,$theUser->emp_email);
                $client                     =       Client::find_by_id($partTicket->client_id);
                array_push($cemail,$client->email);
                $partTicket->datemodified   = date("Y-m-d H:i:s");
                $msg                        = "Your Complaint ticket status has been closed<br />";
                $subject                    = "Robert Johnson Holdings(Technical Support) Ticket #'" . $partTicket->id ."' Close";
                //print_r($cemail);
                //mail("amedora09@gmail.com","Robert Johnson Holdings, Technical Support" , "all good");
                
            
            
            if($partTicket->update()){
			//	$this->sendMail("Customer",$subject ,$msg,$cemail);
                return true;
            }else{
                return false;
            }
        }
     }
     
     
     public function sendMail($name,$subject,$msg,$copy){
		//$mail                                     = new Mail(); 
        $copy       =   implode(",",$copy);
       
        
        //$headers .= 'To: $email". "\r\n";
        
        $headers = 'X-Mailer: PHP/' . phpversion() . "\r\n"; 
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        //$headers .= 'BCC: '. implode(",", $copy) . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: '.$name." <".' info@robertjohnsonholdings.com' . ">\r\n";
        
        //print_r($headers);
        
		$template                                 = new Mailtemplate();
		
			  $template->data['mail_from']              = "Robert Johnson Holdings Nig. Ltd.";
			  		$template->data['web_url']                = "http://robertjohnsonholdings.com";
			 		$template->data['logo']                   = "http://robertjohnsonholdings.com/control/public/img/logo.png";
			  		$template->data['company_name']           = "Robert Johnson Holdings Nig. Ltd.";
			  		$template->data['text_from']              = "Robert Johnson Holdings Nig. Ltd.";
			  		$template->data['text_greeting']          ="Dear ".$name;
			  		$template->data['text_footer']            ="Thank you";
			          $template->data['text_message']           = "<b>Technical Support/Maintenance</b>";
			  		$template->data['message']                = $msg;
			          
			  			//	print_r($copy);
			  			//	$mail->setTo("amedora09@gmail.com");
                         //  $mail->setCopy($copy);
			  			//	$mail->setFrom("info@robertjohnsonholdings.com");
			  			//	$mail->setSender("Robert Johnson Holdings Nig. Ltd.");
			  			//	$mail->setSubject("Robert Johnson Holdings, Technical Support");
                            //$mail->setText($msg);
			  				//$mail->setHtml($template->gettmp());	
              mail($copy, $subject, $template->gettmp(), $headers);
			 	
             		
			//$mail->send();
	}
    
    public function createAddPart(){
        if(isset($_POST['itemid']) && !empty($_POST['wid'])){
            $worksheet      =   Worksheet::find_by_id($_POST['wid']);
            $myItem         = Items::find_by_id($_POST['itemid']);
            $propart        =   new Prodpart();
            
            $propart->part_name = $myItem->item_name;
            $propart->qty       =   $_POST['qty'];
            $propart->works_id  =   $_POST['wid'];
            $propart->prod_id   =   $worksheet->prod_id;
            $propart->item_id   =   $_POST['itemid'];
            $propart->date_changed      =   date("Y:m:d H:i:s");
            $propart->desc              ="";
            $propart->unit_cost         =   $_POST['price'];
            $propart->total_cost        =   (int)$_POST['price'] * (int)$_POST['qty'];
            
            
            if($propart->create()){
                return $propart;
            }else{
                return false;
            }
            
        }
    }
    
    public function deletePart(){
        if(isset($_POST['itemid'])){
            
            $propart        =   Prodpart::find_by_id($_POST['itemid']);
            
                     
            if($propart->delete()){
                return $propart;
            }else{
                return false;
            }
            
        }
    }
    /**
     * this method finds
     * parts for work sheets
     * 
     * it used to get parts supplied to
     * a worksheet
     */
    public function getPartsWS($id){
        return Prodpart::find_by_WSheet($id);
    }
    

	}
?>