<?php
class Employees_Model extends Model{
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
        
        $empname ="";
        $empdept ="";
        $emppost ="";
       
        
        
		
        /**
		 * of all the filter fields if only one field is set
		 */
         $filterResult ="";
         if(isset($_POST['empname']) && !empty($_POST['empname'])){
            $empname .= " AND emp_fname = '".$_POST['empname']."' OR emp_lname = '".$_POST['empname']."' ";
         }
         if(isset($_POST['empdept']) && !empty($_POST['empdept'])){
            $empdept .= " AND emp_dept='".$_POST['empdept']."' ";
         }
         
         if(isset($_POST['emppost']) && !empty($_POST['emppost'])){
            $emppost .= " AND emp_post='".$_POST['emppost']."' ";
         }
              
        
        
        $filterResult .=" WHERE id !='' ". $empname.$empdept.$emppost ;
        global $database;
		$resultEmployee = $database->db_query("SELECT * FROM employee");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 50;
		
		$customers = Employee::find_by_sql("SELECT * FROM employee ".$filterResult." ORDER BY id DESC ");
		$index_array =array( "myemployee"=>$customers,"mypagin"=>$pagin->render($pg));
		return $index_array;
	}
    
    
	public function getById($phone){
		return Employee::find_by_id($phone);
       // $myaccount = Accounts::find_by_phone($phone); 
	}
    
    /**
     * this section gets the pool of employee work
     * experience from the database table
     */
     
     public function getEmpWkExp($id){
       return Empwork::find_by_empID($id);        
     }
     
     /**
     * this section gets the pool of next of kin
     * data from the database table
     */
     
     public function getEmpNOK($id){
       return Empnok::find_by_empID($id);       
     }
     
     /**
     * this section gets the pool of emp institutes
     * data from the database table
     */
     
     public function getEmpINS($id){
       return Empinstitution::find_by_empID($id);        
     }

     /**
     * this section gets the pool of emp referee
     * data from the database table
     */
     
     public function getEmpRef($id){
       return Empreferee::find_by_empID($id);        
     }

     /**
      * this section is reqired to
      * insert a new employee wk expereince
      */
    public function InsertEmp_Wkexp(){
        if(isset($_POST['empid']) && !empty($_POST['empid'])){
            $wkexp                      =   new Empwork();
            $wkexp->emp_id              =   $_POST['empid'];
            $wkexp->staff_id            =   "";
            $wkexp->comp_name           =   $_POST['comp'];
            $wkexp->comp_address        =   $_POST['compadd'];
            $wkexp->p_post              =   $_POST['jtitle'];
            $wkexp->start_year          =   $_POST['startdt'];
            $wkexp->end_year            =   $_POST['enddt'];
            
            if($wkexp->create()){
                return true;
            }else{
                return false;
            }
            
        }
    }
    
    
    /**
      * this section is reqired to
      * insert a new employee referees
      */
    public function InsertEmp_Ref(){
        if(isset($_POST['empid']) && !empty($_POST['empid'])){
            $empref                         =   new Empreferee();
            $empref->emp_id                 =   $_POST['empid'];
            $empref->staff_id               =   $_POST["staffid"];
            $empref->ref_name               =   $_POST['refname'];
            $empref->ref_off_address        =   $_POST['refadd'];
            $empref->ref_office             =   $_POST['refpost'];
            $empref->ref_phone              =   $_POST['refphone'];
            $empref->ref_email              =   $_POST['refemail'];
            
            if($empref->create()){
                return true;
            }else{
                return false;
            }
            
        }
    }
    
    /**
      * this section is reqired to
      * insert a new next of kin
      */
    public function InsertEmp_NOK(){
        if(isset($_POST['empid']) && !empty($_POST['empid'])){
            $empnok                         =   new Empnok();
            $empnok->emp_id                 =   $_POST['empid'];
            $empnok->staff_id               =   $_POST["staffid"];
            $empnok->kin_name               =   $_POST['kinname'];
            $empnok->kin_address            =   $_POST['kinadd'];
            $empnok->kin_relationship       =   $_POST['refpost'];
            $empnok->kin_telephone              =   $_POST['kinphone'];
            $empnok->kin_email              =   $_POST['kinemail'];
            
            if($empnok->create()){
                return true;
            }else{
                return false;
            }
            
        }
    }
    
    
    /**
      * this section is reqired to
      * insert a new next of kin
      */
    public function InsertEmp_INS(){
        if(isset($_POST['empid']) && !empty($_POST['empid'])){
            $empins                         =   new Empinstitution();
            $empins->emp_id                 =   $_POST['empid'];
            $empins->staff_id               =   $_POST["staffid"];
            $empins->inst_name              =   $_POST['insname'];
            $empins->inst_qualification            =   $_POST['qual'];
            $empins->inst_certificate       =   $_POST['cert'];
            $empins->inst_grade             =   $_POST['grade'];
            $empins->inst_start_year              =   $_POST['datefro'];
            $empins->inst_end_year          =   $_POST['dateto'];
            
            if($empins->create()){
                return true;
            }else{
                return false;
            }
            
        }
    }
    
    /**
     * thsis section is needed to 
     * update employee
     * Institution 
     */
     
     
     public function UpdateEmp_INS(){
        if(isset($_POST['empid']) && !empty($_POST['empid'])){
            $empins                         =   Empinstitution::find_by_id($_POST['instid']);
            $empins->emp_id                 =   $_POST['empid'];
            $empins->staff_id               =   $_POST["staffid"];
            $empins->inst_name              =   $_POST['insnameU'];
            $empins->inst_qualification            =   $_POST['qualU'];
            $empins->inst_certificate       =   $_POST['certU'];
            $empins->inst_grade             =   $_POST['gradeU'];
            $empins->inst_start_year              =   $_POST['datefroU'];
            $empins->inst_end_year          =   $_POST['datetoU'];
           
            if($empins->update()){
                return true;
            }else{
                return false;
            }
            
        }
    }
    /**
     * thsis section is needed to 
     * update employee
     * work experience 
     */
    public function UpdateEmp_WORK(){
       if(isset($_POST['empid']) && !empty($_POST['empid'])){
            $empwrk                         =   Empwork::find_by_id($_POST['instid']);
               
           
            $empwrk->emp_id              =   $_POST['empid'];
            $empwrk->staff_id            =   $_POST['staffid'];            
            //$empwrk->empl_name           =   $_POST[''];
			$empwrk->comp_name           =   $_POST['company'];
			$empwrk->comp_address        =   $_POST['compaddress'];
			$empwrk->start_year          =   $_POST['empdatefro'];
			$empwrk->end_year            =   $_POST['empdateto'];

			$empwrk->p_post              =   $_POST['jobtitle'];
			
           
            if($empwrk->update()){
                                
                return true;
            }else{
                return false;
            }
            
        }
    }
    
    
    
     /**
      * this section is reqired to
      * insert a new next of kin
      */
    public function UpdateEmp_NOK(){
        if(isset($_POST['empid']) && !empty($_POST['empid'])){
            $empnok                         =   Empnok::find_by_id($_POST['instid']);
            $empnok->emp_id                 =   $_POST['empid'];
            $empnok->staff_id               =   $_POST["staffid"];
            $empnok->kin_name               =   $_POST['kinname'];
            $empnok->kin_address            =   $_POST['address'];
            $empnok->kin_relationship       =   $_POST['rela'];
            $empnok->kin_telephone          =   $_POST['phone'];
            $empnok->kin_email              =   $_POST['email'];
            
            if($empnok->update()){
                return true;
            }else{
                return false;
            }
            
        }
    }
    
    
     /**
      * this section is reqired to
      * insert a new next of kin
      */
    public function UpdateEmp_REF(){
        if(isset($_POST['empid']) && !empty($_POST['empid'])){
            $empref                         =   Empreferee::find_by_id($_POST['instid']);
            $empref->emp_id                 =   $_POST['empid'];
            $empref->staff_id               =   $_POST["staffid"];
            $empref->ref_name               =   $_POST['refname'];
            $empref->ref_off_address           =   $_POST['address'];
            $empref->ref_office       =   $_POST['refpost'];
            $empref->ref_phone          =   $_POST['phone'];
            $empref->ref_email              =   $_POST['email'];
            
            if($empref->update()){
                return true;
            }else{
                return false;
            }
            
        }
    }
	
	/*
	* This module is used to change the employee password
	*/
	
	public function UpdateEmp_PASS(){
	   if(empty($_POST['emppass']) || !isset($_POST['emppass'])){
	       return false;
           exit;
	   }
        if(isset($_POST['empid']) && !empty($_POST['empid'])){
            $employee                         =   Employee::find_by_id($_POST['empid']);
            $employee->emp_pword              =  crypt($_POST['emppass'],'$2a$07$usesomesillystringforsalt$');
            
            if($employee->update()){
                return true;
            }else{
                return false;
            }
            
        }
    }
    
    public function findRole($id){
        $empRole = Roles::find_by_id($id);
        if($empRole){
            return $empRole;
            //print_r($empRole);
        }else{
            return false;
        }
    }
    
    
    public function findDepartment($id){
        $empDept = Department::find_by_id($id);
        if($empDept){
            return $empDept;
            //print_r($empRole);
        }else{
            return false;
        }
    }
    
     
    
    /**
     * we shall need this section to update
     * employee sub-info
     */
    public function getEmployeeInstituteById($id){
       return $employeeInst   =   Empinstitution::find_by_id($id);
        
    }
    
    public function getEmployeeWorkById($id){
       return $employeeWork   =   Empwork::find_by_id($id);
        
    }
    
    
    public function getEmployeeNokById($id){
       return $employeeNok  =   Empnok::find_by_id($id);
        
    }
    
    public function getEmployeeRefById($id){
       return $employeeRef  =   Empreferee::find_by_id($id);
        
    }
    
    /**
     * this section is required 
     * to update employee role
     */
    public function UpdateEmpRole(){
        $rEmployee  = Employee::find_by_id($_POST['empid']);
        $rEmployee->emp_post    =   $_POST['emppost'];
        $rEmployee->emp_dept    =   $_POST['empdept'];
        
        $empDept                =   Department::find_by_id($_POST['empdept']);
        $Tlog   =   new Transaction();
        $Tlog->com_id              =   $empDept->dept_code;
        $Tlog->trans_type          =   "HR DEPARTMENT";
        $Tlog->trans_description   =   "Employee assigned to ".$empDept->dept_name." Department";
        $Tlog->datecreated         =   date("Y-m-d H:i:s");
        $Tlog->user_id             =   $_SESSION['emp_ident'];
        
        $empRole                =   Roles::find_by_id($_POST['emppost']);
        
        $Tlog2   =   new Transaction();
        $Tlog2->com_id              =   $empRole->main_id;
        $Tlog2->trans_type          =   "HR DEPARTMENT";
        $Tlog2->trans_description   =   "Employee assigned ".$empRole->role_name." Role";
        $Tlog2->datecreated         =   date("Y-m-d H:i:s");
        $Tlog2->user_id             =   $_SESSION['emp_ident'];
        
        if($rEmployee->update()){
            $Tlog2->create();
            $Tlog->create();
            return true;
        }else{
            return false;
        }
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
        $employee 		= Employee::find_all();
		$zone 			= Zone::find_by_sql("SELECT * FROM zone WHERE country_id=156");
		$startups 		= array("departs"=>$depts,"country"=>$country,"state"=>$zone,"employee"=>$employee,"role"=>$role);
		return $startups;		
	}

    /**
     * use with jquery to porpulate the local government  
     * listitem in  form 
     */
	public function lga($state_id){
        if(!empty($state_id)){
            return Lga::find_by_sql("SELECT * FROM lgas WHERE zone_id='".$state_id."'");
        }
    }
    
	public function create(){
		if(!empty($_POST['lname']) && !empty($_POST['fname'])  && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['address'])){
			
			$applicant = new Employee();
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
                
                
                              
			$applicant->emp_lname				=	$_POST['lname'];
			$applicant->emp_fname				=	$_POST['fname'];
			$applicant->emp_mname				=	$_POST['mname'];
			$applicant->emp_sex				    =	$_POST['gender'];
			$applicant->emp_mstatus			    =	$_POST['mstatus'];
			$applicant->emp_religion			=	$_POST['religion'];
			$applicant->emp_dob					=	$_POST['dob'];
			$applicant->emp_nationality			=	$_POST['nationality'];
			$applicant->emp_soo					=	$_POST['soo'];
			$applicant->emp_lga					=   $_POST['lga'];
			$applicant->emp_address			    =	$_POST['address'];
			$applicant->emp_email				=	$_POST['email'];
			$applicant->emp_phone			    =	$_POST['phone'];
            $applicant->emp_uname               =   $_POST['email'];
            $pass                               =   Employee::generatePassword(8,2);
            $applicant->emp_pword               =   crypt($pass,'$2a$07$usesomesillystringforsalt$');
            $applicant->emp_id                  =   Employee::getID2("RJH/S/","tblemp", $applicant->emp_fname. " ". $applicant->emp_lname);
		
			$applicant->datecreated		    =	date("Y-m-d H:i:s");

			if($applicant->create()){

			 $this->sendMail($applicant->fname,$applicant->lname,$applicant->emp_mname,$pass ,$applicant->emp_uname,$applicant->emp_email );
				 return 1;     //returns 1 on success                        
			}else{
			     return 2;       // returns 2 on insert error
			}
		}else{
		  return 3; //returns 3 if requiered input field is not supplied
		}
	}
    
    
    
    
    	public function update(){
		if(!empty($_POST['lname']) && !empty($_POST['empid'])){
			
			
            $applicant = Employee::find_by_id($_POST['empid']);
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
                
                
                              
			$applicant->emp_lname				=	$_POST['lname'];
			$applicant->emp_fname				=	$_POST['fname'];
			$applicant->emp_mname				=	$_POST['mname'];
			$applicant->emp_sex				    =	$_POST['gender'];
			$applicant->emp_mstatus			    =	$_POST['mstatus'];
			$applicant->emp_religion			=	$_POST['religion'];
			$applicant->emp_dob					=	$_POST['dob'];
			$applicant->emp_nationality			=	$_POST['nationality'];
			$applicant->emp_soo					=	$_POST['soo'];
			$applicant->emp_lga					=   $_POST['lga'];
			$applicant->emp_address			    =	$_POST['address'];
			$applicant->emp_email				=	$_POST['email'];
			$applicant->emp_phone			    =	$_POST['phone'];
            $applicant->emp_uname               =   $_POST['email'];
            //$pass                               =   Employee::generatePassword(8,2);
            //$applicant->emp_pword               =   crypt($pass,'$2a$07$usesomesillystringforsalt$');
            //$applicant->emp_id                  =   Employee::getID2("RJH/S/","tblemp", $applicant->emp_fname. " ". $applicant->emp_lname);
		
			$applicant->datemodified		    =	date("Y-m-d H:i:s");
			
			if($applicant->update()){
			 //$this->sendMail($applicant->fname,$applicant->lname,$applicant->emp_mname,$pass ,$applicant->emp_uname,$applicant->emp_email );
				return 1;     //returns 1 on success                        
			}else{
			 return 2;       // returns 2 on insert error
			}
			
			
		}else{
		  return 3; //returns 3 if requiered input field is not supplied
		}
	}

    public function sendMail($fname,$lname,$mname,$pass,$uname,$email){
        $to = $email;
        $subject = 'Technician Registration';
        $headers = "From: RJ SUPPORT rjsupport@robertjohnsonsupport.com\r\n";
        $headers .= "Reply-To: rjsupport@robertjohnsonsupport.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .=  'X-Mailer: PHP/' . phpversion()."\r\n";
        /* $smtp = \Mail::factory('smtp', array(
             'host' => 'ssl://n1plcpnl0021.prod.ams1.secureserver.net',
             'port' => '465',
             'auth' => true,
             'username' => 'rjsupport@robertjohnsonsupport.com',
             'password' => 'rjsupport2015'
         ));*/
        $message = "Dear $fname $mname ". strtoupper($lname);
        $message .= "<br><p> Here is your login details are as follows, this will be required to login into your staff portal to access your account</p>
                        <ul style='list-style:none; list-style-image:none;'>
                            <li><b>Username: </b>".$uname."</li>
                            <li><b>Password: </b>".$pass."</li>
                        </ul>
                        <p>Please keep these as they will be required when you want to access your account portal on the Chartered Marketers Auction Website </p>";

        if(mail($to, $subject, $message, $headers)){
            return true;
        }else return false;

    }


    public function sendMail2($fname,$lname,$mname,$pass,$uname,$email){
		$mail                                     = new Mail(); 
		$template                                 = new Mailtemplate();
		$template->data['mail_from']              = "Robert Johnson Holdings";
		$template->data['web_url']                = "http://robertjohnsonsupport.com";
		$template->data['logo']                   = "http://robertjohnsonsupport.com/public/img/logo.png";
		$template->data['company_name']           = "Robert Johnson Holdings";
		$template->data['text_from']              = "Robert Johnson Holdings";
		$template->data['text_greeting']          ="Dear $fname $mname ". strtoupper($lname) ;// $_POST['subject'];
		$template->data['text_footer']            ="Thank you";
        $template->data['text_message']           = "<b>Your login details</b>";
		$template->data['message']                ="<p> Here is your login details are as follows, this will be required to login into your staff portal to access your account</p>
                        <ul style='list-style:none; list-style-image:none;'>
                            <li><b>Username: </b>".$uname."</li>
                            <li><b>Password: </b>".$pass."</li>
                        </ul>
                        <p>Please keep these as they will be required when you want to access your account portal on the Chartered Marketers Auction Website </p>";
				
				$mail->setTo($email);
				$mail->setFrom("rjsupport@robertjohnsonsupport.com");
				$mail->setSender("RobertJohnson Support.");
				$mail->setSubject("Robert Johnson Holdings Registration");
				$mail->setHtml($template->gettmp('http://robertjohnsonsupport.com/control/emailtmp/email1.tpl'));
				if($mail->send()){
					return true;
				}else{
					return false;
				}
	}
    
   
}
?>