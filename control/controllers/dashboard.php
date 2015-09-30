<?php
class Dashboard extends Controller{
	function __construct(){
		parent::__construct();
        $this->uri 		= new Url("");
        global $session;
		/*if($session->emp_is_logged_in() && $session){
		 $this->index();
		  
		}else{
		  redirect_to($this->uri->link("login/index"));
		}*/
	}
	/*---------------------------------
	At this point index is the login page
	*---------------------------------*/
	public function index(){
	   	@$this->loadModel("Dashboard");
        global $session;
        $dashData                       =   array();
        $dashData                       = $this->model->getDashboardStat();
        $this->view->oticketcount       =   $dashData['otcount'];
        $this->view->aticketcount       =   $dashData['atcount'];
        $this->view->oschedule           =   $dashData['oschedule'];
        $this->view->oworksheet          =   $dashData['oworksheet'];
        $this->view->clients            =   $dashData['clients'];
        $this->view->pendings           = $dashData['openPend'];
        $this->view->cproducts          =   $dashData['cproducts'];
        $lastmonth                      =   (int)date("n")-1;
        $curmonth                       =   date("n");

        $this->view->monthreport        =   $this->model->getMonthlyReportFinance(" Month(datecreated) ='".$curmonth."' AND Year(datecreated)='".date("Y")."'");
        $this->view->lastmonthreport    =   $this->model->getLastMonthlyReportFinance(" Month(datecreated) ='".$lastmonth."' AND Year(datecreated)='".date("Y")."'");
        $this->view->thisquarter        =   $this->model->getThisQuaterReportFinance(" Quarter(datecreated) ='".self::date_quarter()."' AND Year(datecreated)='".date("Y")."'");
        global $session;
        
         if($session->empright == "Super Admin"){
		      $this->view->render("dashboard/index");
		  }elseif($session->empright == "Customer Support Services" || $session->empright == "Customer Support Service"){
		        $this->view->render("support/index");
		      
		  }elseif($session->empright == "Customer Support Engineer" || $session->empright == "Customer Service Engineer"){
                @$this->loadModel("Itdepartment");
       global $session;
       $datan ="";
       $uri = new Url("");
        //$empworkdata =  $this->model->getWorkSheetEmployee($id,"");
        
       $ptasks = Worksheet::find_by_sql("SELECT * FROM work_sheet_form WHERE cse_emp_id =".$_SESSION['emp_ident'] );
       // print_r($ptasks);
         //$empworkdata['worksheet'];
         $x=1;
         $datan  .="<table  width='100%'>
              <thead><tr>
              	<th>S/N</th><th>Prod ID</th><th>Status</th><th>Emp ID</th><th>Issue</th><th>Date Generated </th><th></th><th></th>
              </tr>
              </thead>
              <tbody>";
        if($ptasks){
            
              foreach($ptasks as $task){
                         $datan  .= "<tr><td>$x</td><td>$task->prod_id</td><td>$task->status </td><td>$task->cse_emp_id</td><td>$task->problem</td><td>$task->sheet_date</td><td><a href='".$uri->link("itdepartment/worksheetdetail/".$task->id."")."'>View Detail</a></td><td></td></tr>";
                         $x++;
                }
        }else{
          $datan  .="<tr><td colspan='8'></td></tr>";
        }  
        $datan  .="</tbody></table>";
        
        $mysched ="<div id='transalert'>"; $mysched .=(isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : ""; $mysched .="</div>";
        
        $psched = Schedule::find_by_sql("SELECT * FROM schedule WHERE status !='Closed' AND emp_id =".$_SESSION['emp_ident']." ORDER BY id DESC" );
        //print_r($psched);
         //$empworkdata['worksheet'];
         $x=1;
         $mysched  .="<table  width='100%'>
              <thead><tr>
              	<th>S/N</th><th>Machine</th><th>Issue</th><th>Location</th><th>Task Type</th><th>Task Date </th><th></th><th></th><th></th>
              </tr>
              </thead>
              <tbody>";
        if($psched){
            
              foreach($psched as $task){
                         $mysched  .= "<tr><td>$x</td><td>$task->prod_name</td><td>$task->issue </td>"; 
                         $machine = Cproduct::find_by_id($task->prod_id);
                         
                         $mysched  .= "<td>$machine->install_address  $machine->install_city</td><td>$task->maint_type</td><td>$task->s_date</td><td>";
                         
                        if($task->status == "Open"){
                            $mysched  .="<a scheddata='{$task->id}' class='acceptTask'   href='#'>Accept Task</a>";
                        }
                        if($task->status == "In Progress"){
                            $mysched  .="<a href='".$uri->link("itdepartment/worksheetupdateEmp/".$task->id."")."'>Get Work Sheet</a>";
                        }
                            
                             $mysched  .="
                         
                         <div id='myModal{$task->id}' class='reveal-modal'>
  <h2>Accept Task </h2>
  <p class='lead'>Click on the button  below to accept task! </p>
  <form action='?url=itdepartment/doAcceptTask' method='post'>
  <input type='hidden' value='{$task->id}' name='mtaskid' id='mtaskid' />
  <p><a href='#' data-reveal-id='secondModal' class='secondary button acceptTast' >Accept</a></p>
  </form>
  <a class='close-reveal-modal'>&#215;</a>
</div>


                         
                         
                         </td><td></td><td></td></tr>";
                         $x++;
                }
        }else{
          $mysched  .="<tr><td colspan='8'>There is no task currently</td></tr>";
        }  
        $mysched  .="</tbody></table>";
        
        $this->view->oldtask =  $datan;
        $this->view->schedule = $mysched;
        $this->view->mee  = $this->model->getEmployee($_SESSION['emp_ident']);
        $this->view->render("itdepartment/staffaccount");
		  }else{
		      $this->view->render("login/index",true);
		  }
		
	}
    
     private static function date_quarter()
    {
        $month = date('n');
        if ($month <= 3) return 1;
        if ($month <= 6) return 2;
        if ($month <= 9) return 3;
        return 4;
    }

	public function doLogout(){
		//@$session = new Session();
		global $session;
		$session->logout();
       	redirect_to($this->uri->link("login/index"));
		//$this->view->render("dashboard/index");
	}
}
?>
