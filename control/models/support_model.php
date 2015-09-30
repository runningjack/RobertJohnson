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
        $prodnamefield  ="";
        $issuefiels ="";
        $locationfield ="";
        $datefield  ="";
        
		
        /**
		 * of all the filter fields if only one field is set
		 */
         $filterResult ="";
         if(isset($_REQUEST['status']) && !empty($_REQUEST['status'])){
             if(strtolower(($_REQUEST['status'])) == "pending"){
                 $statusfield .= " AND status = 'Admin Reply' OR status ='Customer Reply'";
             }else{
                 $statusfield .= " AND status = '".$_REQUEST['status']."' ";
             }

         }

         if(isset($_REQUEST['clientid']) && !empty($_REQUEST['clientid'])){
            $clientidfield .= " AND client_id='".$_REQUEST['clientid']."' ";
         }
         
         if(isset($_REQUEST['prodid']) && !empty($_REQUEST['prodid'])){
            $prodnamefield .= " AND prod_id = '".$_REQUEST['prodid']."' ";
         }
         
         if(isset($_REQUEST['location']) && !empty($_REQUEST['location'])){
            $locationfield .= " AND location LIKE '%".$_REQUEST['location']."%' ";
         }
         
         if(isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])){
            $issuefield .= " AND issue LIKE '%".$_REQUEST['issue']."%' ";
         }
         
         
         if(!empty($_REQUEST['fdate']) && !empty($_REQUEST['tdate'])){
            $datefield .= " AND datecreated BETWEEN  '".$_REQUEST['fdate']."' AND '".$_REQUEST['tdate']."' ";
         }
          if(empty($_REQUEST['fdate']) && !empty($_REQUEST['tdate'])){
            $datefield .= " AND datecreated < '".$_REQUEST['tdate']."' ";
         }
          if(!empty($_REQUEST['fdate']) && empty($_REQUEST['tdate'])){
            $datefield .= " AND datecreated >  '".$_REQUEST['fdate']."'  ";
         }
        
        $filterResult .= " WHERE id !=''".$statusfield.$clientidfield.$prodnamefield.$locationfield.$issuefield.$datefield ;
        
		global $database;
		$resultEmployee = $database->db_query("SELECT * FROM support_ticket ");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$myitems = Ticket::find_by_sql("SELECT * FROM support_ticket ".$filterResult." ORDER BY id DESC ".$pagin->pgLimit($pn));
		$index_array =array( "Supportticket"=>$myitems,"mypagin"=>$pagin->render($pg,"ticketlist"));
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
		
		$myitems = Ticket::find_by_sql("SELECT * FROM support_ticket WHERE client_id ='".$_SESSION["client_ident"]."' ORDER BY id DESC ".$pagin->pgLimit($pn));		
		$index_array =array( "Supportticket"=>$myitems,"mypagin"=>$pagin->render($pg));
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
        $lastSignoff    = array_shift($database->fetch_assoc($database->db_query("SELECT MAX(id) as lastID, prod_id FROM sign_off_form ")));
        $lastWorkSheet  = array_shift($database->fetch_assoc($database->db_query("SELECT MAX(id) as lastID, prod_id FROM work_sheet_form ")));
        /**
         * issues may arise that when database
         * is cleared emp_dept may not be 5
         */
        $clients = Client::find_all();
       // print_r($clients);
        $techEmployee   = Employee::find_by_sql("SELECT * FROM employee WHERE emp_dept = 5");
		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
		$startups 		= array("clients"=>$clients,"departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"role"=>$role,"myproducts"=>$myproducts,"techstaff"=>$techEmployee,"lastsf"=>$lastSignoff,"lastws"=>$lastWorkSheet);
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
		$open_ticket_count = ($database->dbNumRows($database->db_query("SELECT * FROM support_ticket WHERE status ='Open' ORDER BY id DESC")));
        $open_schedule_count      =   ($database->dbNumRows($database->db_query("SELECT * FROM schedule WHERE status ='Open' ORDER BY id DESC")));
        $open_worksheet_count         =   ($database->dbNumRows($database->db_query("SELECT * FROM work_sheet_form WHERE status ='Open' ORDER BY id DESC ")));
		$awaiting_ticket_count = ($database->dbNumRows($database->db_query("SELECT * FROM support_ticket WHERE status ='Customer Reply' ")));
        $closed_worksheet_count = ($database->dbNumRows($database->db_query("SELECT * FROM work_sheet_form WHERE status ='Closed' ")));
        $client_count           =($database->dbNumRows($database->db_query("SELECT * FROM tbl_client")));
         $openPendings          =Ticket::find_by_sql("SELECT * FROM support_ticket WHERE   status ='Open' ");
         print_r($openPendings);
        $client_products           =($database->dbNumRows($database->db_query("SELECT * FROM client_product")));
         $clients = Client::find_all();
		$darray = array("openPendings"=>$openPendings,"cproducts"=>$client_products,"clients"=>$clients,"oworksheet"=>$open_worksheet_count,"oschedule"=>$open_schedule_count,"otcount"=>$open_ticket_count,"atcount"=>$awaiting_ticket_count);
		return $darray;
     }
    
    /**
     * function to handle client 
     * reply to a ticket
     */
    public function createAdminReply($id){
        
        if(isset($_REQUEST["issues"]) && isset($_REQUEST["conname"])){
            $newReply = new Ticketreply();
            $newReply->sender_id        =       $_SESSION["emp_ident"];
            $newReply->ticket_id        =       $id;
            $theUser                    =       Employee::find_by_id($_SESSION["emp_ident"]);
            $cemail                     =       array();
            $newReply->sender_name      =       $theUser->emp_fname." ".$theUser->emp_lname;
            $newReply->sender_type      =       "Admin";
            $newReply->message          =       $_REQUEST['issues'];
            $newReply->datecreated      =       date("Y-m-d H:i:s");
            $cemail                     =       (!empty($_REQUEST['cemail'])) ? explode(",",$_REQUEST['cemail']) : "";
            
            $partTicket                 =       Ticket::find_by_id($id);
           // print_r($partTicket);
                array_push($cemail,$partTicket->contact_email,$theUser->emp_email);
                $client                     =       Client::find_by_id($partTicket->client_id);
           // print_r($client);
                $partTicket->status         ="Admin Reply";
                $partTicket->datemodified   = date("Y-m-d H:i:s");
                //print_r($cemail);
                //mail("amedora09@gmail.com","Robert Johnson Holdings, Technical Support" , "all good");
               // $this->sendMail($newReply->sender_name,"Robert Johnson Holdings(Technical Support)" ,$newReply->message,$cemail);
                
                /**
                 * Section to enter transaction log
                 */
                 
                 $Tlog   =   new Transaction();
                 $Tlog->com_id              =   $partTicket->main_id;
                 $Tlog->trans_type          =   "TICKET";
                 $Tlog->trans_description   =   "Admin Reply";
                 $Tlog->datecreated         =   date("Y-m-d H:i:s");
                 $Tlog->user_id             =   $_SESSION['emp_ident'];
                 
            if($newReply->create()){
                $partTicket->update();
                $Tlog->create();            
                
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
		$mysignoff = Sign_off::find_by_sql("SELECT * FROM sign_off_form ORDER BY id DESC ".$pagin->pgLimit($pn));
		$index_array =array( "signoff"=>$mysignoff,"mypagin"=>$pagin->render($pg,"signofflist"));
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
		
		$myworksheets = Worksheet::find_by_sql("SELECT * FROM work_sheet_form WHERE cse_emp_id =".$id." ORDER BY id DESC "  .$pagin->pgLimit($pn));
		$index_array =array( "worksheet"=>$myworksheets,"mypagin"=>$pagin->render($pg));
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
        
        
        $statusfield ="";
        $clientidfield ="";
        $issuefield ="";
       // $productidfield ="";
        $datefield  ="";
        
		
        /**
		 * of all the filter fields if only one field is set
		 */
         $filterResult ="";
         if(isset($_REQUEST['status']) && !empty($_REQUEST['status'])){
            $statusfield .= " AND status = '".$_REQUEST['status']."' ";
         }
         if(isset($_REQUEST['clientid']) && !empty($_REQUEST['clientid'])){
            $clientidfield .= " AND client_id=".$_REQUEST['clientid'];
         }
         if(isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])){
            $issuefield .= " AND problem LIKE '%".$_REQUEST['issue']."%' ";
         }
         
         //if(isset($_REQUEST['prodid']) && !empty($_REQUEST['prodid'])){
          //  $productidfield .= " AND prod_id = '".$_REQUEST['prodid']."' ";
         //}
         
         
         
         /*if(!empty($_REQUEST['fdate']) && !empty($_REQUEST['tdate'])){
            $datefield .= " AND datecreated BETWEEN  '".$_REQUEST['fdate']."' AND '".$_REQUEST['tdate']."' ";
         }
          if(empty($_REQUEST['fdate']) && !empty($_REQUEST['tdate'])){
            $datefield .= " AND datecreated < '".$_REQUEST['tdate']."' ";
         }
          if(!empty($_REQUEST['fdate']) && empty($_REQUEST['tdate'])){
            $datefield .= " AND datecreated >  '".$_REQUEST['fdate']."'  ";
         }*/
        
        $filterResult .= " WHERE id !=''".$clientidfield.$issuefield.$statusfield ;
        
        
        
		global $database;
		$resultWorksheet = $database->db_query("SELECT * FROM work_sheet_form ");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultWorksheet);
		$pagin->itemsPerPage = 20;
		$myworksheets = Ticket::find_by_sql("SELECT * FROM work_sheet_form ".$filterResult." ORDER BY id DESC ".$pagin->pgLimit($pn));
		$index_array =array( "worksheet"=>$myworksheets,"mypagin"=>$pagin->render($pg,"worksheetlist"));				
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
        
        $statusfield ="";
        $clientidfield ="";
        $prodnamefield  ="";
        $issuefiels ="";
        $locationfield ="";
        $datefield  ="";
        
		
        /**
		 * of all the filter fields if only one field is set
		 */
         $filterResult ="";
         if(isset($_REQUEST['status']) && !empty($_REQUEST['status'])){
            $statusfield .= " AND status = '".$_REQUEST['status']."' ";
         }
         if(isset($_REQUEST['clientid']) && !empty($_REQUEST['clientid'])){
            $clientidfield .= " AND client_id='".$_REQUEST['clientid']."' ";
         }
         
         if(isset($_REQUEST['prodid']) && !empty($_REQUEST['prodid'])){
            $prodnamefield .= " AND prod_id = '".$_REQUEST['prodid']."' ";
         }
         
                 
         if(isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])){
            $issuefield .= " AND issue LIKE '%".$_REQUEST['issue']."%' ";
         }
         
         
         if(!empty($_REQUEST['fdate']) && !empty($_REQUEST['tdate'])){
            $datefield .= " AND datecreated BETWEEN  '".$_REQUEST['fdate']."' AND '".$_REQUEST['tdate']."' ";
         }
          if(empty($_REQUEST['fdate']) && !empty($_REQUEST['tdate'])){
            $datefield .= " AND datecreated < '".$_REQUEST['tdate']."' ";
         }
          if(!empty($_REQUEST['fdate']) && empty($_REQUEST['tdate'])){
            $datefield .= " AND datecreated >  '".$_REQUEST['fdate']."'  ";
         }
        
        $filterResult .= " WHERE id !=''".$statusfield.$clientidfield.$prodnamefield.$issuefield.$datefield ;
        
        
        
        
		global $database;
		$resultSchedule = $database->db_query("SELECT * FROM schedule ");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultWorksheet);
		$pagin->itemsPerPage = 20;
		
		$AllSchedule = Schedule::find_by_sql("SELECT * FROM schedule ".$filterResult." ORDER BY id DESC ".$pagin->pgLimit($pn));
    	$index_array =array( "schedules"=>$AllSchedule,"mypagin"=>$pagin->render($pg,"taskmanager"));
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
        if( !empty($_REQUEST['wsid']) && !empty($_REQUEST['prod_id'])  ){
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
					//$applicant->img_url = $_REQUEST['imgvalue'];
				}
                
                if(!isset($_REQUEST['staff_id'])){
                $mySchedule         =   Schedule::find_by_id($_REQUEST['wsid']);
    			
                    $newWorkSheet->prod_id              =   $mySchedule->prod_id;
                    $newWorkSheet->client_id            =   $mySchedule->client_id;
                    $newWorkSheet->prod_name            =   $mySchedule->prod_name;
                    $newWorkSheet->cse_emp_id           =   empty($_REQUEST["emp_id"]) ? $mySchedule->emp_id : $_REQUEST['emp_id'];
                	$newWorkSheet->problem              =   empty($_REQUEST["problem"]) ? $mySchedule->issue : $_REQUEST['problem'] ;
                }else{ //if schedule does not exist for work sheet
                //following data can be porpulated like this
                //ie when the direct work sheet form is used
                    $newWorkSheet->prod_id              =   $_REQUEST['prod_id'];
                    $newWorkSheet->client_id            =   $_REQUEST['clientid'];
                    $newWorkSheet->prod_name            =   $_REQUEST['cprodname'];
                    $empInfo                            =   explode("_ ",$_REQUEST['staff_id']);
                    $newWorkSheet->cse_emp_id           =   $empInfo[0];//empty($_REQUEST["emp_id"]) ? $mySchedule->emp_id : $_REQUEST['emp_id'];
                    $newWorkSheet->cse_emp_name         =   $empInfo[1];
                	$newWorkSheet->problem              =   empty($_REQUEST["problem"]) ;
                    $newWorkSheet->status               =   $_REQUEST['wstatus'];
                }
                $newWorkSheet->formid               =   $_REQUEST['wsid'];
                $newWorkSheet->sheet_date           =   $_REQUEST["w_date"];
            	$newWorkSheet->time_in              =   $_REQUEST["time_in"];
            	$newWorkSheet->time_out             =   $_REQUEST["time_out"];
            	$newWorkSheet->contact_person       =   $_REQUEST["contact_person"];
            	$newWorkSheet->cause                =   $_REQUEST["cause"];
                $newWorkSheet->corrective_action    =   $_REQUEST["corrective_action"];
            	$newWorkSheet->part_changed         =   $_REQUEST["part_changed"];
            	$newWorkSheet->cse_remark           =   $_REQUEST["cse_remark"];
            	$newWorkSheet->client_remark        =   $_REQUEST["client_remark"];
                $newWorkSheet->datecreated          =   date("Y-m-d H:i:s");
              global $session;  
              
                 
              			
			if($newWorkSheet->create()){
			 if(!isset($_REQUEST['staff_id'])){
			     $mySchedule->status =   "Closed";
                 $mySchedule->datemodified  =   date("Y-m-d H:i:s");
    			 $mySchedule->update();
			     $Tlog   =   new Transaction();
                 $Tlog->com_id              =   $mySchedule->main_id;
                 $Tlog->trans_type          =   "SCHEDULE";
                 $Tlog->trans_description   =   "Schedule Closed";
                 $Tlog->datecreated         =   date("Y-m-d H:i:s");
                 $Tlog->user_id             =   $_SESSION['emp_ident'];
			     $Tlog->create();
                }
			// $schedulee      =   Schedule::find_by_id($_REQUEST["wsid"]);
             
             
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
		if(isset($_REQUEST['prod_id']) && !empty($_REQUEST['prod_id']) && !empty($_REQUEST['staff_id']) && !empty($_REQUEST['wsid']) && !empty($_REQUEST['clientid'])){
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
					//$applicant->img_url = $_REQUEST['imgvalue'];
				}
                
                
                
               
                    $obj->client_id                      =   $_REQUEST['clientid'];
                    $obj->prod_name                      =   $_REQUEST['cprodname'];
                    $obj->client_name                    =   $_REQUEST['clientname'];
                    $empInfo                             =   explode("_ ",$_REQUEST['staff_id']);
                    $obj->employee_id                    =   $empInfo[0];//empty($_REQUEST["emp_id"]) ? $mySchedule->emp_id : $_REQUEST['emp_id'];
                    $obj->employee_name                  =   $empInfo[1];
                    $obj->form_id                        =   $_REQUEST['wsid'];
        			$obj->prod_id                        =   $_REQUEST['prod_id'];	
        			$obj->mag_stripe                     =   isset($_REQUEST['mag_stripe']) ? 1:0;
        			$obj->verve_card                     =   isset($_REQUEST['verve']) ? 1:0;
        			$obj->master_card                    =   isset($_REQUEST['master_card']) ? 1:0;;
        			$obj->visa_card                      =   isset($_REQUEST['visa_card']) ? 1:0;;
        			$obj->withdraw                       =   $_REQUEST['withdraw'];
        			$obj->withdraw_comment               =   $_REQUEST['withdraw_area'];
        			$obj->balance                        =   $_REQUEST['balance'];
        			$obj->balance_comment                =   $_REQUEST['balance_area'];
        			$obj->statement                      =   $_REQUEST['statement'];
        			$obj->statement_comment              =   $_REQUEST['statement_area'];
        			$obj->transfer                       =   $_REQUEST['transfer'];
        			$obj->transfer_comment               =   $_REQUEST['transfer_area'];
        			$obj->pin_change                     =   $_REQUEST['pin_change'];
        			$obj->pin_change_comment             =   $_REQUEST['pin_change_area'];
        			$obj->mobile_recharge                =   $_REQUEST['mobile_recharge'];
        			$obj->mobile_recharge_comment        =   $_REQUEST['mobile_recharge_area'];
        			$obj->camera_instal                  =   $_REQUEST['camera'];
        			$obj->inverter_status                =   $_REQUEST["inverter"];
        			$obj->AC_status                      =   $_REQUEST["air_cond"];
        			$obj->ATM_room_cond                  =   $_REQUEST['atm_room'];
        			$obj->cse_remark                     =   $_REQUEST['cse_remark'];
        			$obj->client_remark                  =   $_REQUEST['client_remark'];
        			$obj->employee_id                    =   $_SESSION["emp_ident"];
                    $obj->datecreated                    =   date("Y-m-d H:i:s");
                    $obj->status                         =   "Closed";
            
            $cprod                               =  Cproduct::find_by_id($obj->prod_id);
            
                 $Tlog   =   new Transaction();
                 $Tlog->com_id              =   $cprod->main_id;
                 $Tlog->trans_type          =   "MACHINE SIGN OFF";
                 $Tlog->trans_description   =   "product Closed";
                 $Tlog->datecreated         =   date("Y-m-d H:i:s");
                 $Tlog->user_id             =   $_SESSION['emp_ident'];
            
             global $session;
		if($obj->create()){
			$Tlog->create();
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
		if(isset($_REQUEST['prod_id']) && !empty($_REQUEST['prod_id']) && !empty($_REQUEST['pgid']) && !empty($_REQUEST['staff_id']) && !empty($_REQUEST['clientid'])){
			$error = array();
            $obj = Sign_off::find_by_id($_REQUEST['pgid']);
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
					$applicant->img_url = $_REQUEST['imgvalue'];
				}
			$obj->client_id                      =   $_REQUEST['clientid'];
            $obj->client_name                    =   $_REQUEST['clientname'];
            $obj->prod_name                      =   $_REQUEST['cprodname'];
            $empInfo                             =   explode("_ ",$_REQUEST['staff_id']);
            $obj->employee_id                    =   $empInfo[0];//empty($_REQUEST["emp_id"]) ? $mySchedule->emp_id : $_REQUEST['emp_id'];
            $obj->employee_name                  =   $empInfo[1];
            $obj->form_id                        =   $_REQUEST['wsid'];
			$obj->prod_id                        =   $_REQUEST['prod_id'];	
			$obj->mag_stripe                     =   isset($_REQUEST['mag_stripe']) ? 1:0;
			$obj->verve_card                     =   isset($_REQUEST['verve']) ? 1:0;
			$obj->master_card                    =   isset($_REQUEST['master_card']) ? 1:0;;
			$obj->visa_card                      =   isset($_REQUEST['visa_card']) ? 1:0;;
			$obj->withdraw                       =   $_REQUEST['withdraw'];
			$obj->withdraw_comment               =   $_REQUEST['withdraw_area'];
			$obj->balance                        =   $_REQUEST['balance'];
			$obj->balance_comment                =   $_REQUEST['balance_area'];
			$obj->statement                      =   $_REQUEST['statement'];
			$obj->statement_comment              =   $_REQUEST['statement_area'];
			$obj->transfer                       =   $_REQUEST['transfer'];
			$obj->transfer_comment               =   $_REQUEST['transfer_area'];
			$obj->pin_change                     =   $_REQUEST['pin_change'];
			$obj->pin_change_comment             =   $_REQUEST['pin_change_area'];
			$obj->mobile_recharge                =   $_REQUEST['mobile_recharge'];
			$obj->mobile_recharge_comment        =   $_REQUEST['mobile_recharge_area'];
			$obj->camera_instal                  =   $_REQUEST['camera'];
			$obj->inverter_status                =   $_REQUEST["inverter"];
			$obj->AC_status                      =   $_REQUEST["air_cond"];
			$obj->ATM_room_cond                  =   $_REQUEST['atm_room'];
			$obj->cse_remark                     =   $_REQUEST['cse_remark'];
			$obj->client_remark                  =   $_REQUEST['client_remark'];
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
     print_r(Schedule::find_by_id($id));   
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


        public function getCloseScheduleTicket($id){
            $activityShed = Ticket::find_by_id($id);
                if($_REQUEST['status'] == "Open"){  // Condition to check if schedule is Open
                    $activityShed->status='Open';
                    $activityShed->datemodified =date("Y-m-d H:i:s");
                    $activityShed->update();
                    $schedule = Schedule::find_by_ticket_id($id);
                    if($schedule){
                        $schedule->status="Open";
                        $schedule->datemodified =date("Y-m-d H:i:s");
                        $schedule->update();
                    }
                    return true;
                }elseif($_REQUEST['status']=="Closed"){  // Condition to check if schedule is closed
                    $activityShed->status='Closed';
                    $activityShed->datemodified =date("Y-m-d H:i:s");
                    $activityShed->update();
                    $schedule = Schedule::find_by_ticket_id($id);
                    if($schedule){
                        $schedule->status="Closed";
                        $schedule->datemodified =date("Y-m-d H:i:s");
                        $schedule->update();
                    }
                    return true;
                }elseif($_REQUEST['status']=="In Progress"){  // Condition to check if schedule is in progress
                    $activityShed->status='Admin Reply';
                    $activityShed->datemodified =date("Y-m-d H:i:s");
                    $activityShed->update();
                    $schedule = Schedule::find_by_ticket_id($id);
                    if($schedule){
                        $schedule->status="In Progress";
                        $schedule->datemodified =date("Y-m-d H:i:s");
                        $schedule->update();
                    }
                    return true;
                }else{
                    return false;
                }

            //echo $schedule->update();

        }

        public function getCloseSchedule($id){
            $schedule = Schedule::find_by_id($id);
            //var_dump($_POST['status']);

            //Change in schedule should result in change
            //in ticket and activation call status

            /*
                    * checks if  $activityShed is a ticket
                    * if not then it is an activation
                    * call change the status corresponding to
                    * schedule status for each condition
                    * */
            if($_REQUEST['status'] == "Open"){  // Condition to check if schedule is Open

                $schedule->status = "Open";
                $activityShed = Ticket::find_by_id($schedule->ticket_id);
                if($activityShed){
                    $activityShed->status='Open';
                    $activityShed->datemodified =date("Y-m-d H:i:s");
                    $activityShed->update();
                }else{
                    $activityShed = Activation::find_by_id($schedule->ticket_id);
                    if($activityShed){
                        $activityShed->status = "Open";
                        $activityShed->created_at =date("Y-m-d H:i:s");
                        $activityShed->update();
                    }

                }

                $schedule->update();
                return true;
            }elseif($_REQUEST['status']=="Closed"){  // Condition to check if schedule is closed
                $schedule->status ="Closed";
                $activityShed = Ticket::find_by_id($schedule->ticket_id);
                if($activityShed){
                    $activityShed->status='Closed';
                    $activityShed->datemodified =date("Y-m-d H:i:s");
                    $activityShed->update();

                }else{
                    $activityShed = Activation::find_by_id($schedule->ticket_id);

                    if($activityShed){
                        $activityShed->status = "Closed";
                        $activityShed->created_at =date("Y-m-d H:i:s");
                        $activityShed->update();
                    }


                }

                $schedule->update();
                return true;
            }elseif($_REQUEST['status']=="In Progress"){  // Condition to check if schedule is in progress
                $schedule->status ="In Progress";
                $activityShed = Ticket::find_by_id($schedule->ticket_id);
                if($activityShed){
                    $activityShed->status='Admin Reply'; // admin reply stands for response for administrator for response to ticket or engineer assigned
                    $activityShed->datemodified =date("Y-m-d H:i:s");
                }else{
                    $activityShed = Activation::find_by_id($schedule->ticket_id);
                    if($activityShed){
                        $activityShed->status = "In Progress";
                        $activityShed->created_at =date("Y-m-d H:i:s");
                        $activityShed->update();
                    }

                }

                $schedule->update();
                return true;
            }else{
                return false;
            }

            //echo $schedule->update();
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
        if(isset($_REQUEST['pgid'])){
            
            if(isset($_REQUEST["prod_id"])){
                $cproduct = Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$_REQUEST["prod_id"]));
            }
            
            $WorkSheet                       =    Worksheet::find_by_id((int)preg_replace('#[^0-9]#i','',$id));
            $WorkSheet->prod_id              =   (isset($_REQUEST["prod_id"]) && !empty($_REQUEST["prod_id"])) ? $_REQUEST["prod_id"] : $WorkSheet->prod_id;           
            $WorkSheet->prod_name            =   (isset($_REQUEST["prod_id"]) && !empty($_REQUEST["prod_id"])) ? $cproduct->prod_name : $WorkSheet->prod_name;
            $WorkSheet->sheet_date           =   (isset($_REQUEST["w_date"]) && !empty($_REQUEST["w_date"])) ? $_REQUEST["w_date"] : $WorkSheet->sheet_date;
            $WorkSheet->time_in              =   (isset($_REQUEST["time_in"]) && !empty($_REQUEST["time_in"])) ? $_REQUEST["time_in"] : $WorkSheet->time_in;
            $WorkSheet->time_out             =   (isset($_REQUEST["time_out"]) && !empty($_REQUEST["time_out"])) ? $_REQUEST["time_out"] : $WorkSheet->time_out;
            $WorkSheet->contact_person       =   (isset($_REQUEST["contact_person"]) && !empty($_REQUEST["contact_person"])) ? $_REQUEST["contact_person"] : $WorkSheet->contact_person;
            $WorkSheet->cse_emp_id           =   (isset($_REQUEST["emp_id"]) && !empty($_REQUEST["emp_id"])) ? $_REQUEST["emp_id"] : $WorkSheet->emp_id;
            $WorkSheet->problem              =   (isset($_REQUEST["problem"]) && !empty($_REQUEST["problem"])) ? $_REQUEST["problem"] : $WorkSheet->problem;
            $WorkSheet->cause                =   (isset($_REQUEST["cause"]) && !empty($_REQUEST["cause"])) ? $_REQUEST["cause"] : $WorkSheet->cause;
            $WorkSheet->corrective_action    =   (isset($_REQUEST["corrective_action"]) && !empty($_REQUEST["corrective_action"])) ? $_REQUEST["corrective_action"] : $WorkSheet->corrective_action;
            $WorkSheet->part_changed         =   (isset($_REQUEST["part_changed"]) && !empty($_REQUEST["part_changed"])) ? $_REQUEST["part_changed"] : $WorkSheet->part_changed;
            $WorkSheet->cse_remark           =   (isset($_REQUEST["cse_remark"]) && !empty($_REQUEST["cse_remark"])) ? $_REQUEST["cse_remark"] : $WorkSheet->cse_remark;
            $WorkSheet->client_remark        =   (isset($_REQUEST["client_remark"]) && !empty($_REQUEST["client_remark"])) ? $_REQUEST["client_remark"] : $WorkSheet->client_remark;
            $WorkSheet->datemodified         =   date("Y-m-d H:i:s");
            $WorkSheet->fund                 =   (isset($_REQUEST["fund"]) && !empty($_REQUEST["fund"])) ? $_REQUEST["fund"] : $WorkSheet->fund;  
            $WorkSheet->part_supplied        =   (isset($_REQUEST["parts"]) && !empty($_REQUEST["parts"])) ? $_REQUEST["parts"] : $WorkSheet->part_supplied;
            
            
            
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

     public function ActivationList($id="",$pg){
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
         $prodnamefield  ="";
         $issuefield ="";
         $locationfield ="";
         $datefield  ="";


         /**
          * of all the filter fields if only one field is set
          */
         $filterResult ="";
         if(isset($_REQUEST['status']) && !empty($_REQUEST['status'])){
             if(strtolower(($_REQUEST['status'])) == "pending"){
                 $statusfield .= " AND status = 'Admin Reply' OR status ='Customer Reply'";
             }else{
                 $statusfield .= " AND status = '".$_REQUEST['status']."' ";
             }

         }

         if(isset($_REQUEST['clientid']) && !empty($_REQUEST['clientid'])){
             $clientidfield .= " AND client_id='".$_REQUEST['clientid']."' ";
         }

         if(isset($_REQUEST['prodid']) && !empty($_REQUEST['prodid'])){
             $prodnamefield .= " AND prod_id = '".$_REQUEST['prodid']."' ";
         }

         if(isset($_REQUEST['location']) && !empty($_REQUEST['location'])){
             $locationfield .= " AND location LIKE '%".$_REQUEST['location']."%' ";
         }

         if(isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])){
             $issuefield .= " AND issue LIKE '%".$_REQUEST['issue']."%' ";
         }


         if(!empty($_REQUEST['fdate']) && !empty($_REQUEST['tdate'])){
             $datefield .= " AND datecreated BETWEEN  '".$_REQUEST['fdate']."' AND '".$_REQUEST['tdate']."' ";
         }
         if(empty($_REQUEST['fdate']) && !empty($_REQUEST['tdate'])){
             $datefield .= " AND datecreated < '".$_REQUEST['tdate']."' ";
         }
         if(!empty($_REQUEST['fdate']) && empty($_REQUEST['tdate'])){
             $datefield .= " AND datecreated >  '".$_REQUEST['fdate']."'  ";
         }

         $filterResult .= " WHERE id !=''".$statusfield.$clientidfield.$prodnamefield.$locationfield.$issuefield.$datefield ;

         global $database;
         $resultEmployee = $database->db_query("SELECT * FROM activation ");
         $pagin = new Pagination();//create the pagination object;
         $pagin->nr  = $database->dbNumRows($resultEmployee);
         $pagin->itemsPerPage = 20;

         $myitems = Activation::find_by_sql("SELECT * FROM activation ".$filterResult." ORDER BY id DESC ".$pagin->pgLimit($pn));
         //print_r($myitems);
         $index_array =array( "activations"=>$myitems,"mypagin"=>$pagin->render($pg,"ticketlist"));
         return $index_array;
     }




      /**
     * method to close a ticket
     * 
     */
     
     public function closeTicket(){
        if(isset($_REQUEST['id']) && !empty($_REQUEST["id"])){
            $partTicket = Ticket::find_by_id($_REQUEST["id"]);

            $partTicket->status     =   "Closed";
            $theUser                =   Employee::find_by_id($_SESSION['emp_ident']);
            
            $cemail                     =       (!empty($_REQUEST['cemail'])) ? explode(",",$_REQUEST['cemail']) : "";
            
           
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
                $schedule = Schedule::find_by_ticket_id($_REQUEST["id"]);
                if($schedule){
                    $schedule->status = "Closed";
                    $schedule->update();

                }

				$this->sendMail("Customer",$subject ,$msg,$cemail);
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
        if(isset($_REQUEST['itemid']) && !empty($_REQUEST['wid'])){
            $worksheet                              =   Worksheet::find_by_id($_REQUEST['wid']);
            $myItem                                 =   Items::find_by_id($_REQUEST['itemid']);
            $propart                                =   new Prodpart();
            
            $propart->part_name                     =   $myItem->item_name;
            $propart->qty                           =   $_REQUEST['qty'];
            $propart->works_id                      =   $_REQUEST['wid'];
            $propart->prod_id                       =   $worksheet->prod_id;
            $propart->item_id                       =   $_REQUEST['itemid'];
            $propart->datecreated                   =   date("Y:m:d H:i:s");
            $propart->des                           =   "";
            $propart->unit_cost                     =   $_REQUEST['price'];
            $propart->total_cost                    =   (int)$_REQUEST['price'] * (int)$_REQUEST['qty'];
            
            $Tlog   =   new Transaction();
                 $Tlog->com_id                      =   $myItem->item_id;
                 $Tlog->trans_type                  =   "WORKSHEET PART SUPPLY";
                 $Tlog->trans_description           =   "allocation of resources to worksheet";
                 $Tlog->datecreated                 =   date("Y-m-d H:i:s");
                 $Tlog->user_id                     =   $_SESSION['emp_ident'];
            
            if($propart->create()){
                $Tlog->create();
                return $propart;
            }else{
                return false;
            }
            
        }
    }
    
    public function deletePart(){
        if(isset($_REQUEST['itemid'])){
            
            $propart        =   Prodpart::find_by_id($_REQUEST['itemid']);
            
                     
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
    
    
    public function getMonthlyReportFinance($date){
        global $database;
        $reportData                     =   array();
        $found                          =   $database->fetch_assoc($database->db_query("SELECT sum(fund) as fund,id FROM work_sheet_form WHERE ".$date));
        $partCost                       =   ($database->fetch_assoc($database->db_query("SELECT sum(total_cost) as total,id FROM tbl_part_replace WHERE ".$date)));
        $expences                       =   $found['fund'] + $partCost['total'];
        return number_format($expences,2,".",",") ;
     }
     
     
     public function getLastMonthlyReportFinance($date){
        global $database;
        $reportData                     =   array();
        $found                          =   $database->fetch_assoc($database->db_query("SELECT sum(fund) as fund,id FROM work_sheet_form WHERE ".$date));
        $partCost                       =   ($database->fetch_assoc($database->db_query("SELECT sum(total_cost) as total,id FROM tbl_part_replace WHERE ".$date)));
        $expences                       =   $found['fund'] + $partCost['total'];
        return number_format($expences,2,".",",") ;
     }
     
     public function getThisQuaterReportFinance($date){
        global $database;
        $reportData                     =   array();
        $found                          =   $database->fetch_assoc($database->db_query("SELECT sum(fund) as fund,id FROM work_sheet_form WHERE ".$date));
        $partCost                       =   ($database->fetch_assoc($database->db_query("SELECT sum(total_cost) as total,id FROM tbl_part_replace WHERE ".$date)));
        $expences                       =   $found['fund'] + $partCost['total'];
        return number_format($expences,2,".",",") ;
     }
    

	}
?>