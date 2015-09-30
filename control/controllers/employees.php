<?php
class Employees extends Controller{
	//$registry 	= Registry::singleton();
	function __construct(){
		parent::__construct();
		$GLOBALS["msg"] ="" ;
        global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	}
 	public function index($mid=1){
		$emplist ="";
		if(empty($mid)){
			redirect_to($this->uri->link("error/index"));
			exit;
		}
		$this->loadModel("Employees");
		$datum = $this->model->getList("","Employees");
		$this->view->myemployee =$datum['myemployee'];
        $datumo                  =   $this->model->getData(); //get general array data
        $this->view->state      =   $datumo['state'];        //get state of origin from array
       // $this->view->employee    =   $this->model->getById($id);
        $this->view->role       =   $datumo['role'];
        $this->view->depts      =   $datumo['departs'];
        $uri = new Url("");
        $emplist .="<div class='row'><div class='large-12 columns'>"; $emplist .="</div></div><div class='row'><div class='large-12 columns'><table id='dt_basic'  width='100%'>
<thead><tr>
	<th>Emp ID</th><th>Fullname </th><th>Department </th><th>Post </th><th>Date Employed </th><th></th><th></th>
</tr>
</thead>
<tbody>";
  if($this->view->myemployee){
	  $x =1;
    foreach($this->view->myemployee as $emp){
    $emplist .="<tr>
    	<td>$emp->emp_id</td><td>$emp->emp_fname $emp->emp_mname ".strtoupper("$emp->emp_lname")."</td><td>";
        if(!empty($emp->emp_dept)){
           if($this->model->findDepartment($emp->emp_dept)){
                $empDept = $this->model->findDepartment($emp->emp_dept)  ;
                $emplist .= $empDept->dept_name;
           }
        }
        
            
        
        
        $emplist .="</td><td>";
        if(!empty($emp->emp_post)){
           if($this->model->findRole($emp->emp_post)){
                $empRole = $this->model->findRole($emp->emp_post)  ;
                $emplist .= $empRole->role_name;
           }
        }
         $emplist .="</td><td>$emp->emp_date_employed</td>";
         
         /**
          * section to set grant and\
          * previledge
          */
         $emplist .="<td><a href='".$uri->link("employees/edit/".$emp->id."")."'>Edit</a></td>";
         foreach($session->employee_role as $erole){
                    //$emodule = Modules::find_by_module($erole->module);
                    $grant      =   array();
                    $grant      = explode(",",$erole->access);
                   
                   // if($erole->module == "employees" || $erole->module == "itdepartment" ){
                        //if(in_array("Modify",$grant)){
                          
                            
                    
                       // }
                        
                        if(in_array("Delete",$grant)){
                           
                            $emplist .="<td><a href='".$uri->link("employees/doDelete/".$emp->id."")."'>Delete</a></td>";
                    
                        }else{
                           $emplist .="<td></td>";
                        }
                       
                   // }
                    
                }
         
        
        $emplist .="
    </tr>";
	$x++;
    }
  }else{
    $emplist .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$emplist .= "</tbody>
</table></div></div><div class='row'><div class='large-12 columns'>"; $emplist .="</div><p>&nbsp;</p></div>";

$this->view->myemployee = $emplist;

/**
 * the section below is 
 * provided to check for that the 
 * view to render is not called 
 * when doing ajax filter
 */
       // echo $session->empRole;

        if(Session::getRole()){
            if(in_array(strtolower(get_class($this)), $_SESSION['emp_role_module'])){
                if(isset($_POST['empname'])){
                    echo $emplist;
                }elseif(isset($_POST['rec'])){
                    echo $emplist;
                }else{
                    $this->view->render("employees/index");
                }
            }else{

                $this->view->render("access/restricted");
            }
        }
		
	}
    public function doEmpRoleUpdate(){
	   @$this->loadModel("Employees");
       if($this->model->UpdateEmpRole()){
         echo"<div data-alert class='alert-box success'>Employee data updated<a href='#' class='close'>&times;</a></div></div>";
       } 
    }
    public function create(){
		@$this->loadModel("Employees");
        $datum = $this->model->getData();
        $this->view->state = $datum['state'];
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("employees/create");
	}
    /**
     * this section is needed to 
     * display employee form data from other
     * tables other than the employee table
     * for the edit page
     */
    public function edit($id){
		@$this->loadModel("Employees");
        $datum                  =   $this->model->getData(); //get general array data
        $this->view->state      =   $datum['state'];        //get state of origin from array
        $this->view->employee    =   $this->model->getById($id);
        $this->view->role       =   $datum['role'];
        $this->view->depts      =   $datum['departs'];
         
		//$this->view->mymenu = $this->model->getById($id);
        $wkdata                 =   $this->model->getEmpWkExp($id);
        $refdata                =   $this->model->getEmpRef($id);
        $nokdata                =   $this->model->getEmpNOK($id);
        $insdata                =   $this->model->getEmpINS($id);
    
        $exp ="";
        $ref="";
        $nok="";
        $ins="";
        
        /**
         * this section is required to
         * get employee job experience data into 
         * the employee table
         */
        $exp .= "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Company </th><th>Address </th><th>Job Title </th><th>Job Type </th><th>Date</th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($wkdata){
							$x=1;
							foreach($wkdata as $empwkexp){
								$exp .="<tr>
									<td>$x</td><td>$empwkexp->comp_name </td><td>$empwkexp->comp_address </td><td>$empwkexp->p_post </td><td>Post </td><td>$empwkexp->start_year to $empwkexp->end_year </td><td><a href='#' class='workeditlink' data-reveal-id='myModal2' instid='{$empwkexp->id}'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							$exp .="<tr><td colspan='8'>No Work experience for this employee</td></tr>";
						}
                  
                   $exp .="</tbody>
                </table>";
                
                /**
                 * this section is to get employee referee
                 * data to the detail table
                 */
      $ref .= "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Fullname </th><th>Address </th><th>Telephone </th><th>Email </th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($refdata){
						  
							$x=1;
							foreach($refdata as $refdt){
								$ref .="<tr>
									<td>$x</td><td>$refdt->ref_name </td><td>$refdt->ref_off_address </td><td>$refdt->ref_phone </td><td>$refdt->ref_email </td><td><a href='#' data-reveal-id='myModal4' class='refeditlink' instid='{$refdt->ref_id}'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							$ref .="<tr><td colspan='8'>No referee for this employee</td></tr>";
						}
                  
                   $ref .="</tbody>
                </table>";
                
      $nok .= "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Fullname </th><th>Address </th><th>Telephone </th><th>Email </th><th>Relationship </th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($nokdata){
						 
							$x=1;
							foreach($nokdata as $refdt){
								$nok .="<tr>
									<td>$x</td><td>$refdt->kin_name </td><td>$refdt->kin_address </td><td>$refdt->kin_telephone </td><td>$refdt->kin_email </td><td>$refdt->kin_relationship </td><td><a href='#' data-reveal-id='myModal3' instid='{$refdt->kin_id}' class='kindatalink'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							$nok .="<tr><td colspan='8'>No referee for this employee</td></tr>";
						}
                  
                   $nok .="</tbody>
                </table>";
                
      $ins .= "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Institution </th><th>Qualification </th><th>Certificate </th><th>Grade </th><th>Year </th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($insdata){
						  
							$x=1;
							foreach($insdata as $refdt){
								$ins .="<tr>
									<td>$x</td><td>$refdt->inst_name </td><td>$refdt->inst_qualification </td><td>$refdt->inst_certificate </td><td>$refdt->inst_grade </td><td>$refdt->inst_start_year - $refdt->inst_end_year </td><td><a href='#' instid='{$refdt->inst_id}'  data-reveal-id='myModal' class='insteditlink'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							$ins .="<tr><td colspan='8'>No institution record for this employee</td></tr>";
						}
                  
                   $ins .="</tbody>
                </table>";
                
    
        
        $this->view->empwkexpy =$exp;
        $this->view->empref     = $ref;
        $this->view->empnok     =   $nok;
        $this->view->empinst    =   $ins;

		$this->view->render("employees/edit");
	}
    
    public function doInsertEmp_Wkexp(){
        @$this->loadModel("Employees");
        if($this->model->InsertEmp_Wkexp()){
            $empexp = $this->model->getEmpWkExp($_POST['empid']);
           
                echo "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Company </th><th>Address </th><th>Job Title </th><th>Job Type </th><th>Date</th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                   
						if($empexp){
							$x=1;
							foreach($empexp as $empwkexp){
								echo"<tr>
									<td>$x</td><td>$empwkexp->comp_name </td><td>$empwkexp->comp_address </td><td>$empwkexp->p_post </td><td>Post </td><td>$empwkexp->start_year to $empwkexp->end_year </td><td><a href='#' data-reveal-id='myModal2' class='workeditlink' instid='{$thisInfo->id}'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							echo"<tr><td colspan='8'>No Work experience for this employee</td></tr>";
						}
                     
                    echo"</tbody>
                </table>";
          
        }
    }
    
    
    public function doInsertEmp_Ref(){
        $this->loadModel("Employees");
        if($this->model->InsertEmp_Ref()){       
        $refdata = $this->model->getEmpRef($_POST['empid']);
        
        echo "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Fullname </th><th>Address </th><th>Telephone </th><th>Email </th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($refdata){
						 
							$x=1;
							foreach($refdata as $refdt){
								echo "<tr>
									<td>$x</td><td>$refdt->ref_name </td><td>$refdt->ref_off_address </td><td>$refdt->ref_phone </td><td>$refdt->ref_email </td><td><a href='#' data-reveal-id='myModal2' class='workeditlink' instid='{$thisInfo->id}'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							echo"<tr><td colspan='8'>No referee for this employee</td></tr>";
						}
                  
                   echo"</tbody>
                </table>";
      }
    }
    
    public function doInsertEmp_NOK(){
        $this->loadModel("Employees");
        if($this->model->InsertEmp_NOK()){       
        $nokdata = $this->model->getEmpNOK($_POST['empid']);
        
        echo"<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Fullname </th><th>Address </th><th>Telephone </th><th>Email </th><th>Relationship </th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($nokdata){
						 
							$x=1;
							foreach($nokdata as $refdt){
								echo"<tr>
									<td>$x</td><td>$refdt->kin_name </td><td>$refdt->kin_address </td><td>$refdt->kin_telephone </td><td>$refdt->kin_email </td><td>$refdt->kin_relationship </td><td><a href='#' instid='{$refdt->kin_id}' class='kindatalink' data-reveal-id='myModal3'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							echo"<tr><td colspan='8'>No next of kin for this employee</td></tr>";
						}
                  
                   echo"</tbody>
                </table>";
      }
    }
    
    
    public function doInsertEmp_INS(){
        $this->loadModel("Employees");
        if($this->model->InsertEmp_INS()){       
        $instdata = $this->model->getEmpINS($_POST['empid']);
        
       echo "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Institution </th><th>Qualification </th><th>Certificate </th><th>Grade </th><th>Year </th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($instdata){
						  
							$x=1;
							foreach($instdata as $refdt){
								echo"<tr>
									<td>$x</td><td>$refdt->inst_name </td><td>$refdt->inst_qualification </td><td>$refdt->inst_certificate </td><td>$refdt->inst_grade </td><td>$refdt->inst_start_year - $refdt->inst_end_year </td><td><a href='#' instid='{$refdt->inst_id}' class='insteditlink' data-reveal-id='myModal'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							echo"<tr><td colspan='8'>No institution record for this employee</td></tr>";
						}
                  
                   echo"</tbody>
                </table>";
      }
    }
    
    public function doUpdateEmp_INS(){
        $this->loadModel("Employees");
       
        if($this->model->UpdateEmp_INS()){       
        $instdata = $this->model->getEmpINS($_POST['empid']);
      
       echo "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Institution </th><th>Qualification </th><th>Certificate </th><th>Grade </th><th>Year </th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($instdata){
						  
							$x=1;
							foreach($instdata as $refdt){
								echo"<tr>
									<td>$x</td><td>$refdt->inst_name </td><td>$refdt->inst_qualification </td><td>$refdt->inst_certificate </td><td>$refdt->inst_grade </td><td>$refdt->inst_start_year - $refdt->inst_end_year </td><td><a href='#' instid='{$refdt->inst_id}' class='insteditlink' data-reveal-id='myModal'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							echo"<tr><td colspan='8'>No institution record for this employee</td></tr>";
						}
                  
                   echo"</tbody>
                </table>";
      }
    }
    
    
    public function doUpdateEmp_WRK(){
         $this->loadModel("Employees");
      
        if($this->model->UpdateEmp_WORK()){       
       
      $empexp = $this->model->getEmpWkExp($_POST['empid']);
          
                echo "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Company </th><th>Address </th><th>Job Title </th><th>Job Type </th><th>Date</th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                   
						if($empexp){
							$x=1;
							foreach($empexp as $empwkexp){
								echo"<tr>
									<td>$x</td><td>$empwkexp->comp_name </td><td>$empwkexp->comp_address </td><td>$empwkexp->p_post </td><td>Post </td><td>$empwkexp->start_year to $empwkexp->end_year </td><td><a href='#' data-reveal-id='myModal2' class='workeditlink' instid='{$empwkexp->id}'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							echo"<tr><td colspan='8'>No Work experience for this employee</td></tr>";
						}
                     
                    echo"</tbody>
                </table>";
      }
    }
    /**
     * this setion mis used to call the model 
     * to update the employee next of kin data
     * and also load the nok table with jquery
     */
    
    public function doUpdateEmp_NOK(){
         $this->loadModel("Employees");
      
      if($this->model->UpdateEmp_NOK()){ 
        
        $nokdata                =   $this->model->getEmpNOK($_POST['empid']);
        echo "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Fullname </th><th>Address </th><th>Telephone </th><th>Email </th><th>Relationship </th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($nokdata){
						 
							$x=1;
							foreach($nokdata as $refdt){
								echo"<tr>
									<td>$x</td><td>$refdt->kin_name </td><td>$refdt->kin_address </td><td>$refdt->kin_telephone </td><td>$refdt->kin_email </td><td>$refdt->kin_relationship </td><td><a href='#' data-reveal-id='myModal3' instid='{$refdt->kin_id}' class='kindatalink'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							echo "<tr><td colspan='8'>No referee for this employee</td></tr>";
						}
                  
                   echo "</tbody>
                </table>";     
      }
    }
    
    
    
    /**
     * this setion mis used to call the model 
     * to update the employee refree data
     * and also load the referee table with jquery
     */
    
    public function doUpdateEmp_REF(){
         $this->loadModel("Employees");
      
      if($this->model->UpdateEmp_REF()){ 
        
        $refdata                =   $this->model->getEmpRef($_POST['empid']);
        echo "<table  width='100%'>
                    <thead>
                    	<tr>
                        	<th>S/N</th><th>Fullname </th><th>Address </th><th>Telephone </th><th>Email </th><th></th><th></th>
                    	</tr>
                    </thead>
                    <tbody>";
                     
						if($refdata){
						  
							$x=1;
							foreach($refdata as $refdt){
								echo"<tr>
									<td>$x</td><td>$refdt->ref_name </td><td>$refdt->ref_off_address </td><td>$refdt->ref_phone </td><td>$refdt->ref_email </td><td><a href='#' data-reveal-id='myModal4' class='refeditlink' instid='{$refdt->ref_id}'><img src='public/icons/Edit16.png' /></a></td><td><img src='public/icons/Delete16.png' /></td>
								</tr>";$x++;
							}
						}else{
							echo"<tr><td colspan='8'>No referee for this employee</td></tr>";
						}
                  
                   echo"</tbody>
                </table>";     
      }
    }
    
    public function doEmpPassUpdate(){
        $this->loadModel("Employees");
        if($this->model->UpdateEmp_PASS()){
            echo("<div class='alert-box success'>employee password successfully changed<a href='#' class='close'>&times;</a></div>");
        }else{
            echo("<div class='alert-box alert'>Unexpected Error, Ensure that password field is not empty<a href='#' class='close'>&times;</a></div>");
        }
    }
    
    
    
    
    
    
    public function instituteU(){
        $this->loadModel("Employees");
        if($this->model->getEmployeeInstituteById($_POST['instid'])){
			$thisInfo =$this->model->getEmployeeInstituteById($_POST['instid']);
            echo"
              <div class='row'>
                <div class='small-2 columns'>
                <input type='hidden' id='instid' name='instid' value='{$thisInfo->inst_id}' >
                <label for='right-label' class='left inline'>Institution</label>
                </div>
                <div class='small-10 columns'>
                    <input type='text' name='institutionU' rel='catchable' id='institutionU' value='{$thisInfo->inst_name}' />
                </div>
              </div>
              <div class='row'>
                <div class='small-2 columns'>
                <label for='right-label' class='left inline'>Year</label>
                </div>
                <div class='small-10 columns'>
                    <div class='small-1 columns'><label>From</label></div>
                    <div class='small-5 columns'>
                        <select id='insdatefroU' name='insdatefroU'>
                            <option label='Year'  rel='catchable' selected='selected' value='"; echo !empty($thisInfo->inst_start_year) ? $thisInfo->inst_start_year : ''; echo "'>"; 
                            echo !empty($thisInfo->inst_start_year) ? $thisInfo->inst_start_year : 'Year' ; echo"</option>
                            <option label='1970' value='1970'>1970</option>
                            <option label='1971' value='1971'>1971</option>
                            <option label='1972' value='1972'>1972</option>
                            <option label='1973' value='1973'>1973</option>
                            <option label='1974' value='1974'>1974</option>
                            <option label='1975' value='1975'>1975</option>
                            <option label='1976' value='1976'>1976</option>
                            <option label='1977' value='1977'>1977</option>
                            <option label='1978' value='1978'>1978</option>
                            <option label='1979' value='1979'>1979</option>
                            <option label='1980' value='1980'>1980</option>
                            <option label='1981' value='1981'>1981</option>
                            <option label='1982' value='1982'>1982</option>
                            <option label='1983' value='1983'>1983</option>
                            <option label='1984' value='1984'>1984</option>
                            <option label='1985' value='1985'>1985</option>
                            <option label='1986' value='1986'>1986</option>
                            <option label='1987' value='1987'>1987</option>
                            <option label='1988' value='1988'>1988</option>
                            <option label='1989' value='1989'>1989</option>
                            <option label='1990' value='1990'>1990</option>
                            <option label='1991' value='1991'>1991</option>
                            <option label='1992' value='1992'>1992</option>
                            <option label='1993' value='1993'>1993</option>
                            <option label='1994' value='1994'>1994</option>
                            <option label='1995' value='1995'>1995</option>
                            <option label='1996' value='1996'>1996</option>
                            <option label='1997' value='1997'>1997</option>
                            <option label='1998' value='1998'>1998</option>
                            <option label='1999' value='1999'>1999</option>
                            <option label='2000' value='2000'>2000</option>
                            <option label='2001' value='2001'>2001</option>
                            <option label='2002' value='2002'>2002</option>
                            <option label='2003' value='2003'>2003</option>
                            <option label='2004' value='2004'>2004</option>
                            <option label='2005' value='2005'>2005</option>
                            <option label='2006' value='2006'>2006</option>
                            <option label='2007' value='2007'>2007</option>
                            <option label='2008' value='2008'>2008</option>
                            <option label='2009' value='2009'>2009</option>
                            <option label='2010' value='2010'>2010</option>
                            <option label='2011' value='2011'>2011</option>
                            <option label='2012' value='2012'>2012</option>
                            <option label='2013' value='2013'>2013</option>
                            <option label='2014' value='2014'>2014</option>
                        </select>
                        
                    </div>
                    <div class='small-1 columns'><label>To</label></div>
                    <div class='small-5 columns'>
                        <select id='insdatetoU' name='insdatetoU' rel='catchable'>
                            <option label='Year' value='"; echo !empty($thisInfo->inst_end_year) ? $thisInfo->inst_end_year : ''; echo "'>"; 
                            echo !empty($thisInfo->inst_end_year) ? $thisInfo->inst_end_year : 'Year' ; echo"</option>
                            <option label='1970' value='1970'>1970</option>
                            <option label='1971' value='1971'>1971</option>
                            <option label='1972' value='1972'>1972</option>
                            <option label='1973' value='1973'>1973</option>
                            <option label='1974' value='1974'>1974</option>
                            <option label='1975' value='1975'>1975</option>
                            <option label='1976' value='1976'>1976</option>
                            <option label='1977' value='1977'>1977</option>
                            <option label='1978' value='1978'>1978</option>
                            <option label='1979' value='1979'>1979</option>
                            <option label='1980' value='1980'>1980</option>
                            <option label='1981' value='1981'>1981</option>
                            <option label='1982' value='1982'>1982</option>
                            <option label='1983' value='1983'>1983</option>
                            <option label='1984' value='1984'>1984</option>
                            <option label='1985' value='1985'>1985</option>
                            <option label='1986' value='1986'>1986</option>
                            <option label='1987' value='1987'>1987</option>
                            <option label='1988' value='1988'>1988</option>
                            <option label='1989' value='1989'>1989</option>
                            <option label='1990' value='1990'>1990</option>
                            <option label='1991' value='1991'>1991</option>
                            <option label='1992' value='1992'>1992</option>
                            <option label='1993' value='1993'>1993</option>
                            <option label='1994' value='1994'>1994</option>
                            <option label='1995' value='1995'>1995</option>
                            <option label='1996' value='1996'>1996</option>
                            <option label='1997' value='1997'>1997</option>
                            <option label='1998' value='1998'>1998</option>
                            <option label='1999' value='1999'>1999</option>
                            <option label='2000' value='2000'>2000</option>
                            <option label='2001' value='2001'>2001</option>
                            <option label='2002' value='2002'>2002</option>
                            <option label='2003' value='2003'>2003</option>
                            <option label='2004' value='2004'>2004</option>
                            <option label='2005' value='2005'>2005</option>
                            <option label='2006' value='2006'>2006</option>
                            <option label='2007' value='2007'>2007</option>
                            <option label='2008' value='2008'>2008</option>
                            <option label='2009' value='2009'>2009</option>
                            <option label='2010' value='2010'>2010</option>
                            <option label='2011' value='2011'>2011</option>
                            <option label='2012' value='2012'>2012</option>
                            <option label='2013' value='2013'>2013</option>
                            <option label='2014' value='2014'>2014</option>
                            </select>
                    </div>
                </div>
              </div>
              <div class='row'>
                <div class='small-2 columns'>
                <label for='right-label' class='left inline'>Qualification</label>
                </div>
                <div class='small-10 columns'>
                    <select type='text' name='qualificationU' id='qualificationU' rel='catchable' >
                        <option selected='selected' value='"; echo !empty($thisInfo->inst_qualification) ? $thisInfo->inst_qualification : ''; echo "'>"; 
                            echo !empty($thisInfo->inst_qualification) ? $thisInfo->inst_qualification : '--SELECT--' ; echo"</option>
                        <option label='MPhil / PhD' value='MPhil / PhD'>MPhil / PhD</option>
                        <option label='MBA / MSc' value='MBA / MSc'>MBA / MSc</option>
                        <option label='MBBS' value='MBBS'>MBBS</option>
                        <option label='Degree' value='Degree'>Degree</option>
                        <option label='HND' value='HND'>HND</option>
                        <option label='OND' value='OND'>OND</option>
                        <option label='N.C.E' value='N.C.E'>N.C.E</option>
                        <option label='Diploma' value='Diploma'>Diploma</option>
                        <option label='High School (S.S.C.E)' value='High School (S.S.C.E)'>High School (S.S.C.E)</option>
                        <option label='Vocational' value='Vocational'>Vocational</option>
                        <option label='Others' value='Others'>Others</option>
                    </select>
                </div>
              </div>
              <div class='row'>
                    <div class='small-2 columns'>
                        <label> Grade</label>
                    </div>
                    <div class='small-10 columns'>
                        <select name='gradeU' id='gradeU' class='input-large' rel='catchable'>
                            <option selected='selected' value='"; echo !empty($thisInfo->inst_grade) ? $thisInfo->inst_grade : ''; echo "'>"; 
                            echo !empty($thisInfo->inst_grade) ? $thisInfo->inst_grade : 'No Clasification' ; echo"</option>
                            <option label='First Class/Distinction' value='First Class/Distinction'>First Class/Distinction</option>
                            <option label='Second Class Upper/Upper Credit' value='Second Class Upper/Upper Credit'>Second Class Upper/Upper Credit</option>
                            <option label='Second Class Lower/Lower Credit' value='Second Class Lower/Lower Credit'>Second Class Lower/Lower Credit</option>
                            <option label='Third Class' value='Third Class'>Third Class</option>
                            <option label='Pass' value='Pass'>Pass</option>
                        </select>
                    </div>
              </div>
              <div class='row'>
                <div class='small-2 columns'>
                <label for='right-label' class='left inline'>Certificate Obtained</label>
                </div>
                <div class='small-10 columns'>
                    <input type='text' name='certU' id='certU' value='{$thisInfo->inst_certificate}' rel='catchable' />
                </div>
              </div>
              <input type='button'  id='btninsU' name='btninsU' class='button' rel='catchable' value='UpdateINS' />
            ";
        }
    }
    
    /**
     * loads work experience update
     * form
     */
    
     public function workU(){
        $this->loadModel("Employees");
        if($this->model->getEmployeeWorkById($_POST['instid'])){
			$thisInfo =$this->model->getEmployeeWorkById($_POST['instid']);
            echo"<div class='row'>
                    <div class='small-2 columns'>
                    <input type='hidden' id='instid' name='instid' value='{$thisInfo->id}' >
                    <label for='right-label' class='left inline'>Job Title</label>
                    </div>
                    <div class='small-10 columns'>
                        <input name='jobtitleU' id='jobtitleU' rel='catchable' placeholder='Web Designer' value='{$thisInfo->p_post}' type='text' title='Please specify the Employee  or portfolio occupied in the previouse organisation.' class=''/>
                    </div>
                </div>
                <div class='row'>
                    <div class='small-2 columns'>
                    <label for='right-label' class='left inline'>Job Type</label>
                    </div>
                    <div class='small-10 columns'>
                        <select name='jobtypeU' rel='catchable' id='jobtypeU' class='input-small' title='Please specify work type' style='width: 90px; margin-right: 5px;'><option label='Full-Time' value='1'>Full-Time</option>
        <option label='Intern' value='2'>Intern</option>
        <option label='Contract' value='3'>Contract</option>
        </select>
                    </div>
                </div>
                <div class='row'>
                    <div class='small-2 columns'>
                    <label for='right-label' class='left inline'>company</label>
                    </div>
                    <div class='small-10 columns'>
                        <input name='companyU' rel='catchable' placeholder='Company' id='companyU' value='{$thisInfo->comp_name}' type='text' title='Please specify the organisation which Employee worked with' />
                    </div>
                </div>
                <div class='row'>
                    <div class='small-2 columns'>
                    <label for='right-label' class='left inline'>company</label>
                    </div>
                    <div class='small-10 columns'>
                        <input name='compaddressU' rel='catchable' placeholder='Company Address' id='compaddressU' value='{$thisInfo->comp_address}' type='text' title='Please specify the organisation which Employee worked with' />
                    </div>
                </div>
                <div class='row'>
                    <div class='small-2 columns'>
                    <label for='right-label' class='left inline'>Year</label>
                    </div>
                    <div class='small-10 columns'>
                        <div class='small-1 columns'><label>From</label></div>
                        <div class='small-5 columns'>
                            <select id='empdatefroU' rel='catchable' name='empdatefroU'>
                               
                                <option  selected='selected' value='"; echo !empty($thisInfo->start_year) ? $thisInfo->start_year :''; echo "'>"; echo !empty($thisInfo->start_year) ? $thisInfo->start_year :''; echo"</option>
                                <option label='1970' value='1970'>1970</option>
                                <option label='1971' value='1971'>1971</option>
                                <option label='1972' value='1972'>1972</option>
                                <option label='1973' value='1973'>1973</option>
                                <option label='1974' value='1974'>1974</option>
                                <option label='1975' value='1975'>1975</option>
                                <option label='1976' value='1976'>1976</option>
                                <option label='1977' value='1977'>1977</option>
                                <option label='1978' value='1978'>1978</option>
                                <option label='1979' value='1979'>1979</option>
                                <option label='1980' value='1980'>1980</option>
                                <option label='1981' value='1981'>1981</option>
                                <option label='1982' value='1982'>1982</option>
                                <option label='1983' value='1983'>1983</option>
                                <option label='1984' value='1984'>1984</option>
                                <option label='1985' value='1985'>1985</option>
                                <option label='1986' value='1986'>1986</option>
                                <option label='1987' value='1987'>1987</option>
                                <option label='1988' value='1988'>1988</option>
                                <option label='1989' value='1989'>1989</option>
                                <option label='1990' value='1990'>1990</option>
                                <option label='1991' value='1991'>1991</option>
                                <option label='1992' value='1992'>1992</option>
                                <option label='1993' value='1993'>1993</option>
                                <option label='1994' value='1994'>1994</option>
                                <option label='1995' value='1995'>1995</option>
                                <option label='1996' value='1996'>1996</option>
                                <option label='1997' value='1997'>1997</option>
                                <option label='1998' value='1998'>1998</option>
                                <option label='1999' value='1999'>1999</option>
                                <option label='2000' value='2000'>2000</option>
                                <option label='2001' value='2001'>2001</option>
                                <option label='2002' value='2002'>2002</option>
                                <option label='2003' value='2003'>2003</option>
                                <option label='2004' value='2004'>2004</option>
                                <option label='2005' value='2005'>2005</option>
                                <option label='2006' value='2006'>2006</option>
                                <option label='2007' value='2007'>2007</option>
                                <option label='2008' value='2008'>2008</option>
                                <option label='2009' value='2009'>2009</option>
                                <option label='2010' value='2010'>2010</option>
                                <option label='2011' value='2011'>2011</option>
                                <option label='2012' value='2012'>2012</option>
                                <option label='2013' value='2013'>2013</option>
                                <option label='2014' value='2014'>2014</option>
                            </select>
                        </div>
                        <div class='small-1 columns'><label>To</label></div>
                        <div class='small-5 columns'>
                            <select id='empdatetoU' rel='catchable' name='empdatetoU' class='large-12 columns'>
                                <option selected='selected' value='"; echo !empty($thisInfo->end_year) ? $thisInfo->end_year :''; echo "'>"; echo !empty($thisInfo->end_year) ? $thisInfo->end_year :''; echo"</option>
                                <option label='1970' value='1970'>1970</option>
                                <option label='1971' value='1971'>1971</option>
                                <option label='1972' value='1972'>1972</option>
                                <option label='1973' value='1973'>1973</option>
                                <option label='1974' value='1974'>1974</option>
                                <option label='1975' value='1975'>1975</option>
                                <option label='1976' value='1976'>1976</option>
                                <option label='1977' value='1977'>1977</option>
                                <option label='1978' value='1978'>1978</option>
                                <option label='1979' value='1979'>1979</option>
                                <option label='1980' value='1980'>1980</option>
                                <option label='1981' value='1981'>1981</option>
                                <option label='1982' value='1982'>1982</option>
                                <option label='1983' value='1983'>1983</option>
                                <option label='1984' value='1984'>1984</option>
                                <option label='1985' value='1985'>1985</option>
                                <option label='1986' value='1986'>1986</option>
                                <option label='1987' value='1987'>1987</option>
                                <option label='1988' value='1988'>1988</option>
                                <option label='1989' value='1989'>1989</option>
                                <option label='1990' value='1990'>1990</option>
                                <option label='1991' value='1991'>1991</option>
                                <option label='1992' value='1992'>1992</option>
                                <option label='1993' value='1993'>1993</option>
                                <option label='1994' value='1994'>1994</option>
                                <option label='1995' value='1995'>1995</option>
                                <option label='1996' value='1996'>1996</option>
                                <option label='1997' value='1997'>1997</option>
                                <option label='1998' value='1998'>1998</option>
                                <option label='1999' value='1999'>1999</option>
                                <option label='2000' value='2000'>2000</option>
                                <option label='2001' value='2001'>2001</option>
                                <option label='2002' value='2002'>2002</option>
                                <option label='2003' value='2003'>2003</option>
                                <option label='2004' value='2004'>2004</option>
                                <option label='2005' value='2005'>2005</option>
                                <option label='2006' value='2006'>2006</option>
                                <option label='2007' value='2007'>2007</option>
                                <option label='2008' value='2008'>2008</option>
                                <option label='2009' value='2009'>2009</option>
                                <option label='2010' value='2010'>2010</option>
                                <option label='2011' value='2011'>2011</option>
                                <option label='2012' value='2012'>2012</option>
                                <option label='2013' value='2013'>2013</option>
                                <option label='2014' value='2014'>2014</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <a href='#'  id='btnwkU' name='btnwkU' class='button' rel='catchable' ddata='UpdateWRK' >Update</a>
                           
            ";
        }
   }
   
    public function nokU(){
        $this->loadModel("Employees");
        if($this->model->getEmployeeNokById($_POST['instid'])){
			$thisInfo =$this->model->getEmployeeNokById($_POST['instid']);
            
            
            echo"<div class='control-group'>
                        <label class='control-label' for='gfname'>Full Name</label>
                        <div class='controls'>
                        <input type='text' id='gfnameU' name='gfnameU' placeholder='Next of King's Full Name'  value='{$thisInfo->kin_name}' />
                        <input type='hidden' id='instid' name='instid' value='{$thisInfo->kin_id}' />
                        </div>
                    </div>
                    <div class='control-group'>
                        <label class='control-label' for='gaddress'>Address</label>
                        <div class='controls'>
                        <textarea name='gaddressU' id='gaddressU' class='span12' rel='catchable' cols='10' rows='10'> $thisInfo->kin_address</textarea>
                        </div>
                    </div>
                    <div class='control-group'>
                        <label class='control-label' for='gtelephone' >Telephone</label>
                       <div class='controls'>
                        <input type='text' id='gtelephoneU' name='gtelephoneU' rel='catchable' placeholder='Telephone' value='{$thisInfo->kin_telephone}'>
                       </div>
                      </div> 
                    <div class='control-group'>
                            <label class='control-label' for='gemail'>Email</label>
                        <div class='controls'>
                            <input type='text' id='gemailU' name='gemailU' rel='catchable' placeholder='Email' value='{$thisInfo->kin_email}'>
                        </div>
                    </div> 
                    <div class='control-group'>
                        <label class='control-label' for='relationship'>Relationship</label>
                            <div class='controls'>
                                <input type='text' id='grelationshipU' name='grelationshipU' rel='catchable' placeholder='Relationship' value='{$thisInfo->kin_relationship}'>
                            </div>
                    </div>
                    <a href='#' type='button' rel='catchable' id='btnnoxU' name='btnnoxU' class='button' ddata='Update'> Update Record </a>";
        }
   }
   /**
    *  this section is used to load
    * employee reff form for update
    */
   
   public function refU(){
        $this->loadModel("Employees");
        if($this->model->getEmployeeRefById($_POST['instid'])){
			$thisInfo =$this->model->getEmployeeRefById($_POST['instid']);
            
            echo "<div class='large-6 columns'>
                     <div class='control-group'>
                        <label class='control-label' for='refname1'>Name</label>
                        <div class='controls'><input type='hidden' rel='catchable' name='instid' id='instid' value='{$thisInfo->ref_id}' />
                            <input type='text' id='refname1U' rel='catchable' name='refname1U'  value='{$thisInfo->ref_name}' >
                        </div>
                     </div>
                     <div class='control-group'>
                        <label class='control-label' for='refaddress1'>Office Address</label>
                        <div class='controls'>
                            <textarea id='refaddress1U' rel='catchable' name='refaddress1U' rows='45' cols='20'  >$thisInfo->ref_off_address</textarea>
                        </div>
                     </div>
                     <div class='control-group'>
                        <label class='control-label' for='refdesignation1'>Designation</label>
                        <div class='controls'>
                            <input type='text' id='refdesignation1U' rel='catchable' name='refdesignation1U'  value='{$thisInfo->ref_office}'>
                        </div>
                     </div>
                     <div class='control-group'>
                        <label class='control-label' for='refphone1'>Telephone</label>
                        <div class='controls'>
                            <input type='text' id='refphone1U' rel='catchable' name='refphone1U' value='{$thisInfo->ref_phone}'>
                        </div>
                     </div>
                     <div class='control-group'>
                        <label class='control-label' for='refemail1'>E-mail</label>
                        <div class='controls'>
                            <input type='text' id='refemail1U' rel='catchable' name='refemail1U' placeholder='Email' value='{$thisInfo->ref_email}'>
                        </div>
                     </div>
                     <div class='control-group'>
                        
                        <div class='controls'>
                           <a href='#' id='btnrefU' rel='catchable' name='btnrefU' instid='$thisInfo->ref_id' class='button' ddata='Update'> Update Record </a>
                        </div>
                     </div>
                 </div>";
            
        }
   }
   
   
   
    /**
     * this function is used to populate local Govt
     * on blur event of a state dropdown
     */
    public function getLgas(){
        @$this->loadModel("Employees");
        $lg ="";
        if(isset($_POST['soo']) && !empty($_POST['soo'])){
            $scra = explode(",",$_POST['soo']);
            if($this->model->lga($scra[0])){
                $lgas = $this->model->lga($scra[0]);
                $lg .="<option value=''>--SELECT LGA--</option>";
                foreach($lgas as $lga){
                    $lg .="<option value='{$lga->LGA}'>$lga->LGA</option>";
                }
                $lg .="<option value='other'>Other</option>";
            }
        }
        echo $lg;
        
    }
	
    
    public function validateEmail(){
       $emailreg ="/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
       if(isset($_POST['memail'])){
          if($_POST['memail']==""){
                echo "<div data-alert class='alert-box'>Please enter your email address<a href='#' class='close'>&times;</a></div></div>";
               return "<div data-alert class='alert-box'>Please enter your email address<a href='#' class='close'>&times;</a></div></div>";
               exit;
           } elseif(!filter_var($_POST['memail'], FILTER_VALIDATE_EMAIL)){
               echo "<div data-alert class='alert-box alert'>Invalid email Please enter a valid email<a href='#' class='close'>&times;</a></div></div>";
               return "<div data-alert class='alert-box alert'>Invalid email Please enter a valid email<a href='#' class='close'>&times;</a></div></div>";
               exit;
           }elseif(!Student::find_by_email($_POST['memail'])){
                echo "<div data-alert class='alert-box alert'>Email not found in our database<a href='#' class='close'>&times;</a></div></div>";
               return "<div data-alert class='alert-box alert'>Email not found in our database<a href='#' class='close'>&times;</a></div></div>";
               exit;
           }else{
                if($this->doRecorvery($_POST['memail'])){
                    $pruser = Student::find_by_email($_POST['memail']);
                    if($this->sendMail($pruser->fname,$pruser->lname,"",$pruser->password,$pruser->username,$pruser->email)){
                        echo "<div data-alert class='alert-box'>You login details has been sent to your email box. please get the detail and retry<a href='#' class='close'>&times;</a></div></div>";
               return "<div data-alert class='alert-box'>You login details has been sent to your email box. please get the detail and retry<a href='#' class='close'>&times;</a></div></div>";
               exit;
                    }
                }
           }
       }
    }
    
    /**
     * communicate with the model to recover password and 
     *     send an email this method is supplied during emial 
     *     verification
     */
    
    public function doRecorvery($email){
        @$this->loadModel("Account");
        if($this->model->passRecovery($email)){
            return true;
        }
    }
    
    
    
   
    
    public function validateRegister(){
        if(isset($_POST['fname'])){
            if(empty($_POST['fname'])){
                echo "<span class='label error'>Please Firstname field must be filled</span>";
                
                exit;
            }
           
        }elseif(isset($_POST['lname'])){
            if(empty($_POST['lname'])){
                echo "<span class='label error'>Please surname field must be filled</span>";
               
                exit;
            
            }
        }elseif(isset($_POST['address'])){
            if(empty($_POST['address'])){
                echo "<span class='label error'>Please address field must be filled</span>";
                
                exit;
            }
        }elseif(isset($_POST['email'])){
            if(empty($_POST['email'])){
                echo "<span class='label error'>Please email field must be filled</span>";
                
                exit;
             }else{
                if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                echo "<span class='label error'>Please enter a valid email </span>";
                
                exit;
                }
             }
        }else{
            
            return 2; //meanining that validation is all good
        
        }
        
    }
    

	
	public function doCreate(){
		@$this->loadModel("Employees");
		if($this->model->create()===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 3){
			echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a href='#' class='close'>&times;</a></div>";
		}else{
            echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
	}
    
    
    	public function doUpdate(){
		@$this->loadModel("Employees");
		if($this->model->update()===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->update() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->update() === 3){
			echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a href='#' class='close'>&times;</a></div>";
		}else{
            echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
	}
    
    public function doDelete($id){
      redirect_to($this->uri->link("employees/index"));
    }
    
    

}
?>