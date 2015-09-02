<?php
	class Itdepartment extends Controller{
	   public $schedule;
	   public function __construct(){
	       parent::__construct();
          global $session;
          
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	   }
       
       public function index($mid=1){
        
        $this->view->render("itdepartment/index");
	   }
       
       public function account($id){
          @$this->loadModel("Itdepartment");
        
       $datan ="";
        $this->view->mee  = $this->model->getEmployee($id);
        $ptasks =Worksheet::find_by_sql("SELECT * FROM work_sheet_form WHERE cse_emp_id =".(int)trim($id)."");
        
 
        if($ptasks){
            $datan  .="<table  width='100%'>
              <thead><tr>
              	<th>S/N</th><th>Prod ID</th><th>Status</th><th>Emp ID</th><th>Issue</th><th>Date Generated </th><th></th><th></th><th></th>
              </tr>
              </thead>
              <tbody>";
              foreach($ptasks as $task){
                         $datan  .= "<td>$x</td><td>$worksheet->prod_id</td><td>$worksheet->status </td><td>$worksheet->cse_emp_id</td><td>$worksheet->problem</td><td>$worksheet->sheet_date</td><td><a href='".$uri->link("itdepartment/worksheetdetail/".$worksheet->id."")."'>View Detail</a></td><td></td><td></td>";
                }
        }else{
        }  
        $datan  .="</tbody></table>";
        $this->view->oldtask =  $datan;
        $this->view->render("itdepartment/staffaccount");
    }
	
	/**
	 * get list of staff particular 
     * to department
	 */
	
	public function stafflist(){
		$this->loadModel("Itdepartment");
		$datum = $this->model->getList("","Itdepartment");
		$this->view->myemployee =$datum['myemployee'];
        $uri = new Url("");
        $emplist .="<table  width='100%'>
<thead><tr>
	<th>Emp ID</th><th>Fullname</th><th>Department</th><th>Post </th><th>Date Employed </th><th></th><th></th>
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
         
        
        $emplist .="</td><td>$emp->emp_date_employed</td><td><a href='".$uri->link("employees/edit/".$emp->id."")."'>Edit</a></td><td><a href='".$uri->link("employees/doDelete/".$emp->id."")."'>Delete</a></td>
    </tr>";
	$x++;
    }
  }else{
    $emplist .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$emplist .= "</tbody>
</table>";

$this->view->myemployee = $emplist;



		$this->view->render("itdepartment/index");
	}
	
    
    
    
    /**
     * this section gets the 
     * signoff form list 
     */
    public function signofflist(){
		
		$signofflisting ="";
		
		$this->loadModel("Itdepartment");
		$datum = $this->model->getSignOffList("","Itdepartment");
		$this->view->signoffs =$datum['signoff'];
        $uri = new Url("");
        $signofflisting .="<table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Prod ID</th><th>Status</th><th>Emp ID</th><th>Client Remark</th><th>Date Generated </th><td></td><td></td><td></td>
</tr>
</thead>
<tbody>";

  if($this->view->signoffs){
	  $x =1;
    foreach($this->view->signoffs as $signoff){
    $signofflisting .="<tr>
    	<td>$x</td><td>$signoff->prod_id</td><td>$signoff->status </td><td>$vendor->employee_id</td><td>$signoff->client_remark</td><td>$vendor->vend_created</td>";
        
        
        /**
          * section to set grant and\
          * previledge
          */
         
         foreach($session->employee_role as $erole){
                    //$emodule = Modules::find_by_module($erole->module);
                    $grant      =   array();
                    $grant      = explode(",",$erole->access);
                   
                    if($erole->module == "signoffform"){
                        if(in_array("View",$grant)){
                          
                            $signofflisting .="<td><a href='".$uri->link("itdeparment/signoffdetail/".$signoff->id."")."'>View Detail</a></td>";
                    
                        }else{
                            $signofflisting .="<td></td>";
                        }
                        
                        if(in_array("Delete",$grant)){
                           
                            $signofflisting .="<td></td>";
                    
                        }else{
                            $signofflisting .="<td></td>";
                        }
                        
                        if(in_array("Modify",$grant)){
                           
                            $signofflisting .="<td><a href='".$uri->link("itdeparment/signoffedit/".$signoff->id."")."'>Edit</a></td>";
                    
                        }else{
                            $signofflisting .="<td></td>";
                        }
                       
                    }
                    
                }
        
         
        
        
    $signofflisting .="</tr
    >";
	$x++;
    }
  }else{
    $signofflisting .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$signofflisting .= "</tbody>
</table>";

$this->view->myvends = $signofflisting;
	        $this->view->render("itdepartment/signofflist");
    }
    
    public function addsignoff(){
        @$this->loadModel("Itdepartment");
        $retumo     =   $this->model->getData();
        $this->view->products   =   $retumo["products"];
        $this->view->render("itdepartment/addsignoff");
    }
	
	
	/**
	 * this section is
     * needed to list out worksheets
	 */
	
	public function worksheetlist(){
		
		$worksheetlisting ="";
		
		$this->loadModel("Itdepartment");
		$datum = $this->model->getWorkSheetList("","Itdepartment");
		$this->view->worksheets =$datum['worksheet'];
        $uri = new Url("");
        $worksheetlisting .="<table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Prod ID</th><th>Status</th><th>Emp ID</th><th>Issue</th><th>Date Generated </th><th></th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->worksheets){
	  $x =1;
    foreach($this->view->worksheets as $worksheet){
    $worksheetlisting .="<tr>
    	<td>$x</td><td>$worksheet->prod_id</td><td>$worksheet->status </td><td>$worksheet->cse_emp_id</td><td>$worksheet->problem</td><td>$worksheet->sheet_date</td>";
        
        /**
          * section to set grant and\
          * previledge
          */
         global $session;
         foreach($session->employee_role as $erole){
                    $emodule = Modules::find_by_module($erole->module);
                    $grant      =   array();
                    $grant      = explode(",",$erole->access);
                   
                    if($erole->module == "worksheetform"){
                        if(in_array("Modify",$grant) && $emodule->module =="support" && $worksheet->status=="Open"){
                          
                            $worksheetlisting .="<td><a href='".$uri->link("itdepartment/tasksupport/".$worksheet->id."")."'>Allocate Resource</a></td>";
                    
                        }elseif(in_array("Modify",$grant)  && $worksheet->status=="Open" ){
                            $worksheetlisting .="<td><a href='".$uri->link("itdepartment/taskedit/".$worksheet->id."")."'>Edit</a></td>";
                        }elseif($session->employee_role =='10'){
                            $worksheetlisting .="<td><a href='".$uri->link("itdepartment/taskedit/".$worksheet->id."")."'>Edit</a></td>";
                        }else{
                            $worksheetlisting .="<td></td>";
                        }
                        
                        
                        if(in_array("View",$grant)){
                           
                            $worksheetlisting .="<td><a href='".$uri->link("itdepartment/worksheetdetail/".$worksheet->id."")."'>View Detail</a></td>";
                    
                        }else{
                            $worksheetlisting .="<td></td>";
                        }
                        
                        
                        if(in_array("Delete",$grant)){
                           
                            $worksheetlisting .="<td><a href='".$uri->link("employees/doDelete/".$emp->id."")."'>Delete</a></td>";
                    
                        }else{
                            $worksheetlisting .="<td></td>";
                        }
                       
                    }
                    
                }
        
        
        
        
    $worksheetlisting .="</tr>";
	$x++;
    }
  }else{
    $worksheetlisting .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$worksheetlisting .= "</tbody>
</table>";

$this->view->myvends = $worksheetlisting;
	        $this->view->render("itdepartment/worksheetlist");
    }
    
    
    
    /**
	 * this section is
     * needed to list out worksheets
	 */
    public function worksheetdetail($id){
        $this->loadModel("Itdepartment");
        $this->view->myworksheet    =   $this->model->getWorkSheetByID($id);
        $this->view->render("itdepartment/worksheetdetail");
    }
	
	public function scheduleList(){
		
		$schedulelisting ="";
		
		$this->loadModel("Itdepartment");
		$datum = $this->model->getScheduleList("","Itdepartment");
		$this->view->schedules =$datum['schedules'];
        $uri = new Url("");
        $schedulelisting .="<table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Prod ID</th><th>Status</th><th>Technician ID</th><th>Issue</th><th>Date Generated </th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->schedules){
	  $x =1;
    foreach($this->view->schedules as $schedule){
    $schedulelisting .="<tr>
    	<td>$x</td><td>$schedule->prod_id</td><td>$schedule->status </td><td><input type='hidden' class='empid'  /> $schedule->emp_name</td><td>$schedule->issue</td><td>$schedule->sheet_date</td><td><a href='".$uri->link("itdepartment/addworksheet/".$schedule->id."")."'>Get Work Sheet</a></td><td><a href='".$uri->link("itdepartment/taskdetail/".$schedule->id."")."'>View Detail</a></td>
    </tr>";
	$x++;
    }
  }else{
    $schedulelisting .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$schedulelisting .= "</tbody>
</table>";

$this->view->myvends = $schedulelisting;
	        $this->view->render("itdepartment/taskmanager");
    }
    
    
    /**
     * section required to add
     * a new worksheet
     */
    
    public function addworksheet($id){
        @$this->loadModel("Itdepartment");
        $retumo     =   $this->model->getData();
        $this->view->products   =   $retumo["products"];
        $this->view->schedu     =   $this->model->getTaskById($id);
        $this->view->render("itdepartment/addworksheet");
    }
    
    /**
     * required to load
     * task support PAge
     */
    public function tasksupport($id){
        @$this->loadModel("Itdepartment");
        $this->view->myworksheet   =   $this->model->getWorkSheetByID($id);
        $this->view->render("itdepartment/tasksupport");
    }
    
    /**
     * required to update
     * task support PAge
     */
     
    public function doTaskSupportWUpdate($id){
        @$this->loadModel("Itdepartment");
		if($this->model->updateWorkSheet($id)===1){
		  redirect_to($this->uri->link("itdepartment/worksheet"));
			//echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->updateWorkSheet($id) === 2){
		  redirect_to($this->uri->link("itdepartment/worksheet"));
			//echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->updateWorkSheet($id) === 3){
		  redirect_to($this->uri->link("itdepartment/worksheet"));
			//echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a href='#' class='close'>&times;</a></div>";
		}else{
		  redirect_to($this->uri->link("itdepartment/worksheet"));
            //echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}
    }
    
    public function doCreateSignOff(){
        
		@$this->loadModel("Itdepartment");
		if($this->model->createsignoff()===1){
		  redirect_to($this->uri->link("itdepartment/signofflist"));
			//echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->createsignoff() === 2){
		  redirect_to($this->uri->link("itdepartment/signofflist"));
			//echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->createsignoff() === 3){
		  redirect_to($this->uri->link("itdepartment/signofflist"));
			//echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a href='#' class='close'>&times;</a></div>";
		}else{
		  redirect_to($this->uri->link("itdepartment/signofflist"));
            //echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
    }
    
    public function doCreateWorkSheet(){
        @$this->loadModel("Itdepartment");
		if($this->model->creatworksheet()===1){
            redirect_to($this->uri->link("itdepartment/worksheetlist"));
			
		}elseif($this->model->creatworksheet() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->creatworksheet() === 3){
			echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a href='#' class='close'>&times;</a></div>";
		}else{
            echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}
    }
    
    public function sche(){
        $worksheetlisting ="";
		
		$this->loadModel("Itdepartment");
		$datum = $this->model->getWorkSheetList("","Itdepartment");
		$this->view->worksheets =$datum['worksheet'];
        $uri = new Url("");
        $worksheetlisting .="<table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Prod ID</th><th>Status</th><th>Emp ID</th><th>Issue</th><th>Date Generated </th><th></th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->worksheets){
	  $x =1;
    foreach($this->view->worksheets as $worksheet){
    $worksheetlisting .="<tr>
    	<td>$x</td><td>$worksheet->prod_id</td><td>$worksheet->status </td><td>$worksheet->cse_emp_id</td><td>$worksheet->problem</td><td>$worksheet->sheet_date</td>";
        
        /**
          * section to set grant and\
          * previledge
          */
         global $session;
         foreach($session->employee_role as $erole){
                    $emodule = Modules::find_by_module($erole->module);
                    $grant      =   array();
                    $grant      = explode(",",$erole->access);
                   
                    if($erole->module == "worksheetform"){
                        if(in_array("Modify",$grant) && $emodule->module =="support" && $worksheet->status=="Open"){
                          
                            $worksheetlisting .="<td><a href='".$uri->link("itdepartment/tasksupport/".$worksheet->id."")."'>Allocate Resource</a></td>";
                    
                        }elseif(in_array("Modify",$grant)  && $worksheet->status=="Open" ){
                            $worksheetlisting .="<td><a href='".$uri->link("itdepartment/taskedit/".$worksheet->id."")."'>Edit</a></td>";
                        }elseif($session->employee_role =='10'){
                            $worksheetlisting .="<td><a href='".$uri->link("itdepartment/taskedit/".$worksheet->id."")."'>Edit</a></td>";
                        }else{
                            $worksheetlisting .="<td></td>";
                        }
                        
                        
                        if(in_array("View",$grant)){
                           
                            $worksheetlisting .="<td><a href='".$uri->link("itdepartment/worksheetdetail/".$worksheet->id."")."'>View Detail</a></td>";
                    
                        }else{
                            $worksheetlisting .="<td></td>";
                        }
                        
                        
                        if(in_array("Delete",$grant)){
                           
                            $worksheetlisting .="<td><a href='".$uri->link("employees/doDelete/".$emp->id."")."'>Delete</a></td>";
                    
                        }else{
                            $worksheetlisting .="<td></td>";
                        }
                       
                    }
                    
                }
        
        
        
        
    $worksheetlisting .="</tr>";
	$x++;
    }
  }else{
    $worksheetlisting .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$worksheetlisting .= "</tbody>
</table>";

return $worksheetlisting;
    }
	
}
?>