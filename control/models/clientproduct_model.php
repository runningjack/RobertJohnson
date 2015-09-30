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

        $prodname ="";
        $clientname ="";
        $areaname ="";
        $regionname ="";
        $atmtype  ="";
        $clientid ="";

        /**
		 * of all the filter fields if only one field is set
		 */
         $filterResult ="";
         if(isset($_REQUEST['prodname']) && !empty($_REQUEST['prodname'])){
            $prodname .= " AND prod_name = '".$_REQUEST['prodname']."' ";
         }

        if(isset($_REQUEST['prodname']) && !empty($_REQUEST['prodname'])){
            $prodname .= " AND prod_name = '".$_REQUEST['prodname']."' ";
        }

        if(isset($_REQUEST['clientid']) && !empty($_REQUEST['clientid'])){
            $clientid .= " AND client_id ='".$_REQUEST['clientid']."'";
        }

         if(isset($_REQUEST['clientname']) && !empty($_REQUEST['clientname'])){
            $clientname .= " AND client_name='".$_REQUEST['clientname']."' ";
         }
         
         if(isset($_REQUEST['areaname']) && !empty($_REQUEST['areaname'])){
            $areaname .= " AND install_area='".$_REQUEST['areaname']."' ";
         }
         if(isset($_REQUEST['location']) && !empty($_REQUEST['location'])){
            $regionname .= " AND (install_city LIKE '%".$_REQUEST['location']."%' OR install_address LIKE '%".$_REQUEST['location']."%') ";
         }
         if(isset($_REQUEST['machine']) && !empty($_REQUEST['machine'])){
            $atmtype .= " AND atm_type='".$_REQUEST['machine']."' ";
         }
         
        
        
        $filterResult .=" WHERE id !='' ". $prodname.$clientname.$areaname.$regionname.$atmtype.$clientid ;

        print_r($filterResult);
        
        
        
		global $database;
        $result         =   $database->db_query("SELECT * FROM client_product ");
		$resultEmployee = $database->db_query("SELECT * FROM client_product ".$filterResult);
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
        $pagin->totalRec     = $database->dbNumRows($result);;
		
		$myitems = Cproduct::find_by_sql("SELECT * FROM client_product ".$filterResult." ORDER BY id DESC ".$pagin->pgLimit($pn));
		$index_array =array( "clientproduct"=>$myitems,"mypagin"=>$pagin->render($pg));
		return $index_array;

	}

    public function getData(){
		global $database;
		$depts 			= Department::find_all();
		$role			= Roles::find_all();
		$country 		= Country::find_all();
        $vendors 		= Vendor::find_all();
        $area			= Area::find_all();
        $issues			= Issue::find_all();
		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
        $techEmp        = Employee::find_by_sql("SELECT * FROM employee WHERE emp_dept='5'");
		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"role"=>$role,"techemp"=>$techEmp,"area"=>$area,"issues"=>$issues);
		return $startups;		
	}
    
    public function getWorkSheetId($id){
        return Worksheet::find_by_productid($id);
        
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
        return (Product::find_by_sql("SELECT * FROM product2 WHERE prod_name LIKE '%".$_POST['input']."%'"));
    }

    public function cprodID_AutoComplete($id=""){
        return (Cproduct::find_by_sql("SELECT * FROM client_product WHERE client_id='".$_POST['clientid']."' AND ( prod_name LIKE '%".$_POST['input']."%' OR install_city LIKE '%".$_POST['input']."%' OR install_address LIKE '%".$_POST['input']."%' )"));
    }
     /**
     * use with jquery to porpulate the region  
     * listitem in  form 
     */
	public function lga($area_id){
        if(!empty($area_id)){
            return Subarea::find_by_sql("SELECT * FROM subarea WHERE area_id=".$area_id);
        }
    }

	public function create(){
		if(!empty($_POST['clientid']) && !empty($_POST['prodname'])  &&  !empty($_POST["address"]) && !empty($_POST["country"]) && !empty($_POST["state"]) ){
			
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
                
                $areadata                               =   explode(",",$_POST['area']);
                
                $cid = explode(",",$_POST["country"]);
				$newProduct->client_id 					=	$_POST["clientid"];
				$newProduct->client_name				=	$_POST["clientname"];
                $newProduct->prod_id                    =   $_POST["prodid"];
                $newProduct->terminal_id                =   $_POST['terminal_id'];
				$newProduct->prod_name					=	$_POST["prodname"];//." ". $_POST["clientname"]." ".$_POST["sregion"]." ".$_POST['site'];
				$newProduct->prod_serial				=	$_POST["serial"];
				$newProduct->install_address			=	$_POST["address"];
				$newProduct->install_country			=	$cid[1];
				$newProduct->install_state				=	$_POST["state"];
                $newProduct->install_area_id            =   $areadata[0];
                $newProduct->install_area               =   $areadata[1];
				$newProduct->install_city				=	($_POST['sregion']=="Other" || !empty($_POST['sregion'])) ? $_POST["city"] : $_POST['sregion'] ;
				$newProduct->install_status				=	0;
				$newProduct->status  					=	0;
                $newProduct->branch                     =   $_POST['site'];
                $newProduct->atm_type                   =   $_POST["mmode"];
                $newProduct->os                         =   $_POST["os"];
                $newProduct->selling_price              =   $_POST["amount"];                     
				$newProduct->datecreated  				=	date("Y-m-d H:i:s");
                
                $prod                                   =   Product::find_by_id($_POST['prodid']);
                
                
                $Tlog2   =   new Transaction();
        $Tlog2->com_id              =   $prod->main_id;
        $Tlog2->trans_type          =   "CLIENT PRODUCT CREATION";
        $Tlog2->trans_description   =   $prod->prod_name. " assigned to".$_POST["clientname"]." Role";
        $Tlog2->datecreated         =   date("Y-m-d H:i:s");
        $Tlog2->user_id             =   $_SESSION['emp_ident'];
                $client             =   Client::find_by_id($_POST["clientid"]);
        
        $Tlog   =   new Transaction();
        $Tlog->com_id              =   $client->main_id;
        $Tlog->trans_type          =   "CLIENT ASSIGNED PRODUCT";
        $Tlog->trans_description   =   $prod->prod_name. " assigned to".$_POST["clientname"]." Role";
        $Tlog->datecreated         =   date("Y-m-d H:i:s");
        $Tlog->user_id             =   $_SESSION['emp_ident'];
				
              	    
			global $session;
			if($newProduct->create()){
			 $Tlog->create();
             $Tlog2->create();
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

    public function update(){
		if(!empty($_POST['clientid']) && !empty($_POST['prodname'])  &&  !empty($_POST["address"]) && !empty($_POST["country"]) && !empty($_POST["state"]) && !empty($_POST["pgid"])
        ){	
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
                
                $areadata                               =   explode(",",$_POST['area']);
                $cid                                    =   explode(",",$_POST["country"]);
				$thisclientproduct->client_id 					=	$_POST["clientid"];
				$thisclientproduct->client_name				    =	$_POST["clientname"];
                $thisclientproduct->prod_id                     =   $_POST["prodid"];
                $thisclientproduct->terminal_id                 =   $_POST['terminal_id'];
				$thisclientproduct->prod_name					=	$_POST["prodname"];
				$thisclientproduct->prod_serial				    =	$_POST["serial"];
				$thisclientproduct->install_address			    =	$_POST["address"];
				$thisclientproduct->install_country			    =	$cid[1];
				$thisclientproduct->install_state				=	$_POST["state"];
                $thisclientproduct->install_area_id             =   $areadata[0];
                $thisclientproduct->install_area                =   $areadata[1];
				$thisclientproduct->install_city				=	($_POST['sregion']=="Other" || !empty($_POST['sregion'])) ? $_POST["city"] : $_POST['sregion'] ;
				$thisclientproduct->install_status				=	0;
				$thisclientproduct->status  					=	0;
                $thisclientproduct->branch                      =   $_POST['site'];
                $thisclientproduct->atm_type                    =   $_POST["mmode"];
                $thisclientproduct->os                          =   $_POST["os"];
                $thisclientproduct->selling_price               =   $_POST["amount"];                     
				$thisclientproduct->datemodified  				=	date("Y-m-d H:i:s");
				
              	    
			global $session;  
			if($thisclientproduct->update()){
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
    
    function isWeekend($date) {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
    }
    
    public function updateSchedule(){
        if(!empty($_POST['sdate']) && !empty($_POST['cid'])){
            $thisclientproduct  =   Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['cid']));
            $thisSchedule       =   new Schedule();
            $postable = $_POST['sdate'];


            /*$thisclientproduct->last_maint_date     =   $postable;
            $weekendSatInterval="";
            $date = new DateTime($postable);
            $interval = new DateInterval('P3M');
            $date->add($interval);
            $holidays = array("Jan 1","Dec 24","Dec 25","Dec 26","Oct 1","April 18","April 21","May 1","May 24","June 29","Sept 23","Oct 5");
            if(date('l', strtotime($date))=="Saturday"){
                $weekendSatInterval = new DateInterval("P2D");
                $date->add($weekendSatInterval);
            }elseif(date('l', strtotime($date))=="Sunday"){
                $weekendSunInterval = new DateInterval("P1D");
                $date->add($weekendSatInterval);
            }*/
            $thisclientproduct->next_maint_date     = $postable;// $date->format("Y-m-d H:i:s");
            $msg="<strong>Dear Customer</strong> <br />
            <p>Please be informed that your machine with details below";
            
            $msg    .= "<table  width='100%'>
            <thead><tr><th>Terminal ID</th><th>Product </th><th>Location</th><th>Area/Region </th><th></th></tr>
            </thead>
            <tbody><tr><td>".$thisclientproduct->terminal_id."</td><td>".$thisclientproduct->prod_name."</td><td>".$thisclientproduct->install_address." </td><td>".$thisclientproduct->install_area." ".$thisclientproduct->install_city."</td><td></td></tr></tbody>
            </table>";
            
            $msg.=" will be due for maintenance on the". $_POST['sdate'].
            " This is to notify you ahead of time</p> <br /> <strong>Thanks</strong>";
            if($thisclientproduct->update()){

                $cemail     =   array("rjsupport@roberjohnsonsupport.com","iarowolo@robertjohnsonsupport.com");
                //$cemail   =   $thisclientproduct->
                $client     = $this->getClientByID($thisclientproduct->client_id);

              // $empArr                      = explode(";",$_POST['empfield']);
                $thisSchedule->client_id        = $thisclientproduct->client_id;
                $thisSchedule->terminal_id      = $thisclientproduct->terminal_id;
                $thisSchedule->ticket_id        = str_pad(mt_rand(8,1000000), 10, "0", STR_PAD_LEFT).time();
                $thisSchedule->prod_id          = $thisclientproduct->id;
                $employee                       = Employee::find_by_staff_id($_POST['emp']);
                $thisSchedule->emp_id           = $employee->id;
                $thisSchedule->s_date           = !empty($_POST['sdate']) ? ($_POST['sdate']) : date("Y-m-d H:i:s") ;
                $thisSchedule->emp_name         = $employee->emp_lname." ". $employee->emp_fname;
                $thisSchedule->datecreated      =   date("Y-m-d H:i:s");
                $thisSchedule->status           = "Open";
                $thisSchedule->maint_type       = "Activation";

                $thisSchedule->create();


                array_push($cemail,$client->contact_email);
                array_push($cemail,$client->email);
                
                $this->sendMail("Robert Johnson Holdings Ltd","Next Maintenance Schedule",$msg,$cemail);
                return true;
            }else{
                return false;
            }   
        } 
    }
    
    public function createSchedule($id=""){
        if(!empty($_POST['cid']) && !empty($_POST['empid']) ){
            $thisclientproduct          =   Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['cid']));
            $empdata                    = explode("_",$_POST['empid']);
            $thisemployee               =   Employee::find_by_staff_id($empdata[0]);
            //print_r($thisemployee);
            $thisSchedule               =   new Schedule();
            $clientTicket               =   Ticket::find_by_id((int)preg_replace('#[^0-9]#i','',$id));
            $thisclientproduct          =   Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$clientTicket->prod_id));
            if($_POST['mtype'] !="Activation" && (($_POST['Corrective'] ||$_POST['Preventive'] ) )){

                $clientTicket->status         =   "Admin Reply";
                $clientTicket->datemodified   =   date("Y-m-d H:i:s");
                $thisSchedule->status         =   "In Progress";
           }else{
                $clientTicket  = Activation::find_by_id((int)preg_replace('#[^0-9]#i','',$id));
                if($clientTicket){

                    $thisclientproduct          =   Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$clientTicket->prod_id));
                    $clientTicket->status         =   "In Progress";
                    $clientTicket->updated_at   =   date("Y-m-d H:i:s");
                }


            }
            $thisSchedule->status         =   "In Progress";
            $thisSchedule->emp_id         =  $thisemployee->id;
        	$thisSchedule->emp_name       =   $thisemployee->emp_fname." ". $thisemployee->emp_lname;
        	$thisSchedule->client_id      =   $thisclientproduct->client_id;
            $thisClient                   =   Client::find_by_id($thisclientproduct->client_id);
            $thisSchedule->prod_id        =   $thisclientproduct->id;

            $thisSchedule->ticket_id      =   $id;
            $thisSchedule->prod_name      =   $thisclientproduct->prod_name;
           // exit;
            /**
             * this is to check if ticket
             * is in existence
             */
            //print_r($theUser);
             global $session;
            //$partTicket                             =   ($id!="") ? Ticket::find_by_id($id) : ""; // get the ticket to get details needed for sending mail
            $theUser                                =   Employee::find_by_id($_SESSION["emp_ident"])  ; // get cse detail to retrieve email

        	$thisSchedule->s_date                   =   !empty($_POST['taskdate']) ? $_POST['taskdate'] : date("Y-m-d");
            $cemail                                 = array();

            
            $cemail                     =       (!empty($_POST['cemail']) && isset($_POST['cemail'])) ? explode(",",$_POST['cemail']) : array('iarowolo@gmail.com');
            
            array_push($cemail,$thisemployee->emp_email,(is_array($clientTicket)) ? $clientTicket->contact_email : "",$theUser->emp_email,$thisClient->email);
           array_push($cemail,$clientTicket->contact);
            array_push($cemail,$thisClient->contact_email);
            array_push($cemail,$thisClient->email);

            //print_r($cemail);

            $thisSchedule->issue                    =   $_POST["tissue"];
        	$thisSchedule->datecreated              =   date("Y-m-d H:i:s");
            $thisSchedule->maint_type               =   $_POST['mtype'];
            $subject                                =   "Maintenance Alert";
            $smsmsg                                 =   "Maintenance alert for". $thisclientproduct->terminal_id ." ". $thisclientproduct->prod_name ."at";
            $smsmsg                                 .=  $thisclientproduct->install_location .",". $thisclientproduct->branch;
            $smsmsg                                 .=  "\r\n issue:". $_POST["tissue"]."\r\n";
            $msg                                    =   "<h3>Maintenance Detail</h3> <hr />";
            $msg                                    .=  "<p><strong>Terminal ID: </strong>$thisclientproduct->terminal_id </p>";
            $msg                                    .=  "<p><strong>Machine: </strong>$thisclientproduct->prod_name </p>";
            $msg                                    .=  "<p><strong>Client: </strong> $thisClient->name</p>";
            $msg                                    .=  "<p><strong>Location: </strong>$thisclientproduct->install_location $thisclientproduct->branch $thisclientproduct->install_city </p>";
            $msg                                    .=  "<p><strong>Complaint: </strong>".(!empty($_POST['tissue']) ? $_POST['tissue'] : $clientTicket->issue)."</p>";
            $msg                                    .=  "<br /><br /> <h4>Technician Details</h4> <hr />";
            $msg                                    .=  "<p><strong>Name: </strong>".$thisemployee->emp_fname." ".$thisemployee->emp_lname."</p>";
            $msg                                    .=  "<p><strong>Email: </strong>".$thisemployee->emp_email."</p>";
            $msg                                    .=  "<p><strong>Telephone: </strong>".$thisemployee->emp_phone."</p>";
            $msg                                    .="<br /><br /><h4>Scheduled Date</h4> <hr />";
            $msg                                    .="<p><strong>$thisSchedule->s_date</strong></p><br /><br /><br /><br />";

            $newReply                   =   new Ticketreply();
            $newReply->sender_id        =   $_SESSION["emp_ident"];
            $newReply->ticket_id        =   $id;

            $newReply->sender_name      =   $theUser->emp_fname." ".$theUser->emp_lname;
            $newReply->sender_type      =   "Admin";
            $newReply->message          =   $msg;
            $newReply->datecreated      =   date("Y-m-d H:i:s");
            $newReply->datemodified    = date("Y-m-d H:i:s");
            //$newReply->create();
            
            /**
             * the transaction log is created
             * to ensure that the product already 
             * has history and cannot be deleted
             */

            $Tlog2   =   new Transaction();
            $Tlog2->com_id              =   $thisclientproduct->main_id;
            $Tlog2->trans_type          =   "TASK ASSIGNMENT";
            $Tlog2->trans_description   =   "Corrective Maintenance task assigned to ".$thisemployee->emp_fname ." ".$thisemployee->emp_lname."";
            $Tlog2->datecreated         =   date("Y-m-d H:i:s");
            $Tlog2->datemodified        =   date("Y-m-d H:i:s");
            $Tlog2->user_id             =   $_SESSION['emp_ident'];

            // print_r($msg);           
            if($newReply->create()){
                $thisSchedule->create();
                $clientTicket->datemodified = date("Y-m-d H:i:s");
                $clientTicket->update();

                $Tlog2->create();
                //$thisemployee->emp_phone                
                sendSms($thisemployee->emp_phone, $smsmsg);
                sendSms($thisClient->contact_phone,$smsmsg);
                sendSms($thisClient->phone,$smsmsg);
                $this->sendMail($thisSchedule->emp_name,$subject,$msg,$cemail);
                return true;
            }else{
                return false;
            }   
        } 
    }

    public function createSchedule_Detail($id=""){
       header('Content-Type: application/json');
       
       $data = json_decode(stripslashes($_POST['data']));
       foreach($data as $d=>$value){
            $cntdata[]=$d;
       }
        if(!empty($data->taskdate) && !empty($data->cid) && !empty($data->empid)){
            $issuefield      =   get_object_vars($data); // get the properties of an object into an array
            $thisclientproduct                      =   Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$data->cid));
            $thisemployee                           =   Employee::find_by_id((int)preg_replace('#[^0-9]#i','',$data->empid));
            $thisSchedule                           =   new Schedule();
       
            $thisSchedule->emp_id                   =   $issuefield['empid'];
        	$thisSchedule->emp_name                 =   $thisemployee->emp_fname." ". $thisemployee->emp_lname;
        	$thisSchedule->client_id                =   $thisclientproduct->client_id;
            $thisClient                             =   Client::find_by_id($thisclientproduct->client_id);
            //print_r($thisclientproduct);
            //print_r($thisClient);
            //print_r($thisemployee);
        	$thisSchedule->prod_id                  =      $issuefield['cid'];
            $thisSchedule->prod_name                =   $thisclientproduct->prod_name;
            /**
             * this is to check if ticket
             * is in existence
             */
            //print_r($theUser);
             global $session;
            //$partTicket                             =   ($id!="") ? Ticket::find_by_id($id) : ""; // get the ticket to get details needed for sending mail
            $theUser                                =   Employee::find_by_id($_SESSION["emp_ident"])  ; // get cse detail to retrieve email
            
        	$thisSchedule->s_date                   =   $data->taskdate;
            
            /**
             * section to configure and setup sms and email message 
             */
            
                $issue							=		array();
				$objIssue						=		Issue::find_all(); // creating the issue log object
                $message_issue                  =       "";
                //$thisemployee->emp_phone 
                foreach($objIssue as $objI){
					foreach($issuefield as $key=>$value){
					if($key == $objI->issue_accronym){
						$message_issue            .=  $objI->issue_name.", ";
					}
					}
				}               
            
            
            $cemail                                 = array();
        	$cemail                     =       (isset($_POST['cemail']) && !empty($_POST['cemail'])) ? explode(",",$_POST['cemail']) : array('iarowolo@robertjohsonholdings.com');
            
            array_push($cemail,$thisemployee->emp_email,(is_array($partTicket)) ? $partTicket->contact_email : "",$theUser->emp_email,$thisClient->email);
            //print_r($cemail);
            $thisSchedule->status                   = "Open";
            $thisSchedule->issue                    =   $message_issue;
        	$thisSchedule->datecreated              = date("Y-m-d H:i:s");
            $thisSchedule->maint_type               = $_POST['mtype'];
            $subject                                =   "Maintenance Alert";
            $smsmsg                                 =   "Maintenance alert for $thisclientproduct->prod_name at";
            $smsmsg                                 .=  $thisclientproduct->install_location .",". $thisclientproduct->branch;
            $smsmsg                                 .="\r\n Issue:".$message_issue."\r\n";
            $smsmsg                                 .="\r\n Comment:".$issuefield["tissue"]."\r\n";
            $msg                                    ="<h3>Maintenance Detail</h3> <hr />";
            $msg                                    .="<p><strong>Machine: </strong>$thisclientproduct->prod_name </p>";
            $msg                                    .="<p><strong>Client: </strong> $thisClient->name</p>";
            $msg                                    .="<p><strong>Location: </strong>$thisclientproduct->install_location $thisclientproduct->branch $thisclientproduct->install_city </p>";
            $msg                                    .="<p><strong>Issues: </strong>".$message_issue."</p>";
            $msg                                    .="<p><strong>Comment: </strong>".$issuefield["tissue"]."</p>";
            $msg                                    .="<br /><br /> <h4>Technician Details</h4> <hr />";
            $msg                                    .="<p><strong>Name: </strong>".$thisemployee->emp_fname." ".$thisemployee->emp_lname."</p>";
            $msg                                    .="<p><strong>Email: </strong>".$thisemployee->emp_email."</p>";
            $msg                                    .="<p><strong>Telephone: </strong>".$thisemployee->emp_phone."</p>";
            $msg                                    .="<br /><br /><h4>Scheduled Date</h4> <hr />";
            $msg                                    .="<p><strong>$thisSchedule->s_date</strong></p><br /><br /><br /><br />";
            
            /**
             * the transaction log is created
             * to ensure that the product already 
             * has history and cannot be deleted
             */
            $Tlog2   =   new Transaction();
            $Tlog2->com_id              =   $thisclientproduct->main_id;
            $Tlog2->trans_type          =   "TASK ASSIGNMENT";
            $Tlog2->trans_description   =   $issuefield["mtype"]." task assigned to ".$thisemployee->emp_fname ." ".$thisemployee->emp_lname."";
            $Tlog2->datecreated         =   date("Y-m-d H:i:s");
            
            
            $Tlog2->user_id             =   $_SESSION['emp_ident'];
            
            // print_r($msg);           
            if($thisSchedule->create()){
                $Tlog2->create();
                /**
                 * this section is needed
                 * to post issues to database table
                 * issuelog for statistical analysis on
                 * issues
                 */
            
                //$thisemployee->emp_phone 
                foreach($objIssue as $objI){
                    foreach($issuefield as $key=>$value){
					if($key == $objI->issue_accronym){
						$issueLog						=	new Issuelog();
						$issueLog->ticket_id			=	0;
						$issueLog->issue_id				=	$objI->id;
						$issueLog->issue_accronym		=	$objI->issue_accronym;
						$issueLog->issue_name			=	$objI->issue_name;
						$issueLog->prod_id				=	$issuefield['cid'];
						$issueLog->datecreated			=	date("Y-m-d H:i:s");
						//$ddticket->subject				.=	$_POST[$objI->issue_accronym]. ", ";
						$issueLog->create();
					}
                    }
					
				}               
                sendSms($thisemployee->emp_phone, $smsmsg); //method in function.php in the library folder helps to send sms
                $this->sendMail($thisSchedule->emp_name,$subject,$msg,$cemail); // sends email to employee
                return 1;
            }else{
                return 2;
            }   
        } 
    }
    
    private function has_attribute($attribute) {
	  $object_vars = $this->attributes();
	  return array_key_exists($attribute, $object_vars);
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
            $obj->datecreated               =   date("Y-m-d H:i:s");
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

    public function sendMail($name,$subject,$msg,$copy){
		//$mail                                     = new Mail(); 
        $copy       =   implode(",",$copy);
       
        
        //$headers .= 'To: $email". "\r\n";
        
        $headers = 'X-Mailer: PHP/' . phpversion() . "\r\n"; 
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        //$headers .= 'BCC: '. implode(",", $copy) . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: Robert Johnson Holdings Nig. Ltd <'.' info@robertjohnsonholdings.com' . ">\r\n";
        
        //print_r($headers);
        
		$template                                 = new Mailtemplate();
		
			  $template->data['mail_from']              = "Robert Johnson Holdings Nig. Ltd.";
			  		$template->data['web_url']                = "http://robertjohnsonholdings.com";
			 		$template->data['logo']                   = "http://robertjohnsonholdings.com/control/public/img/logo.png";
			  		$template->data['company_name']           = "Robert Johnson Holdings Nig. Ltd.";
			  		$template->data['text_from']              = "Robert Johnson Holdings Nig. Ltd.";
			  		$template->data['text_greeting']          ="";
			  		$template->data['text_footer']            ="Thank you";
			          $template->data['text_message']           = "<b>Technical Maintenance Alert</b>";
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
    
    
    /**

 *      
 *      public function sendMail($name,$phone,$email,$time,$msg,$copy){
 * 		$mail                                     = new Mail(); 
 * 		$template                                 = new Mailtemplate();
 * 		$template->data['mail_from']              = "Robert Johnson Holdings Nig. Ltd.";
 * 		$template->data['web_url']                = "http://robertjohnsonholdings.com";
 * 		$template->data['logo']                   = "http://robertjohnsonholdings.com/public/img/logo.png";
 * 		$template->data['company_name']           = "Robert Johnson Holdings Nig. Ltd.";
 * 		$template->data['text_from']              = "Robert Johnson Holdings Nig. Ltd.";
 * 		$template->data['text_greeting']          ="Dear $fname $mname ". strtoupper($lname) ;// $_POST['subject'];
 * 		$template->data['text_footer']            ="Thank you";
 *         $template->data['text_message']           = "<b>Technical Support/Maintenance</b>";
 * 		$template->data['message']                ="
 *         
 *         
 *         <p>$msg</p>
 *         <p>
 *         
 *         Thank you for contacting us our support deparment < br/>
 *         Please here are the details of the engineer coming to attend to your request
 *         </p>
 *                         <ul style='list-style:none; list-style-image:none;'>
 *                             <li><b>Name: </b>".$name."</li>
 *                             <li><b>Phone: </b>".$phone."</li>
 *                             <li><b>Email: </b>".$email."</li>
 *                             <li><b>Date/Time: </b>".$time."</li>
 *                         </ul>
 *                         <p>Thanks</p>";
 * 				
 * 				$mail->setTo($email);
 *                 $mail->setCopy($copy);
 * 				$mail->setFrom("support@robertjohnsonholdings.com");
 * 				$mail->setSender("Robert Johnson Holdings Nig. Ltd.");
 * 				$mail->setSubject("Robert Johnson Holdings, Technical Support");
 * 				$mail->setHtml($template->gettmp('http://robertjohnsonholdings.com/emailtmp/email1.php'));				
 * 				if($mail->send()){
 * 					return true;
 * 				}else{
 * 					return false;
 * 				}
 * 	}
 */
  
    public function getClientProdByID($id){
        return Cproduct::find_by_id($id);
    }
    
    public function getClientByID($id){
        return Client::find_by_id($id);
    }
    
    
    public function checkTransLog($id){
        if(!empty($id)){
            $transaction        =       Transaction::find_by_main_id($id);
            if($transaction){
                //echo "<p><strong class='alert-box alert'>Record cannot be deleted! <br /> History already existing for this record</strong></p>";
                return 2;
            }elseif(!$transaction){
                $merole      =  Cproduct::find_by_mainid($id);
              if($merole->delete()) {
                return 1;
              }   
            }else{
                return 3; ///Unexpected Error
            }            
        }
    }
    
    
    public function delete($id){
	   global $session;
		$article = Cproduct::find_by_id($id);
		if($article->delete()){
		  $_SESSION['message']    =   "<div data-alert class='alert-box success'>".$article->prod_name." successfully deleted <a href='#' class='close'>&times;</a></div>";
			return true;
		}
	}
    
    
}
?>