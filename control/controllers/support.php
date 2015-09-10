<?php
class Support extends Controller{
    public function __construct(){
	   parent::__construct();
       global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	}
    
    public function index($mid=1){
        $uri=new Url("");
        @$this->loadModel("Support");
        $dashData                       =   array();
        $dashData                       = $this->model->getDashboardStat();
        $this->view->oticketcount       =   $dashData['otcount'];
        $this->view->aticketcount       =   $dashData['atcount'];
        $this->view->oschedule           =   $dashData['oschedule'];
        $this->view->oworksheet          =   $dashData['oworksheet'];
        $this->view->clients            =   $dashData['clients'];
        $this->view->cproducts          =   $dashData['cproducts'];
        $lastmonth                      =   (int)date("m")-1;
        $curmonth                       =   date("n");
       
        $this->view->monthreport        =   $this->model->getMonthlyReportFinance(" Month(datecreated) ='".$curmonth."' AND Year(datecreated)='".date("Y")."'");
        $this->view->lastmonthreport    =   $this->model->getLastMonthlyReportFinance(" Month(datecreated) ='".$lastmonth."' AND Year(datecreated)='".date("Y")."'");
        $this->view->thisquarter        =   $this->model->getThisQuaterReportFinance(" Quarter(datecreated) ='".self::date_quarter()."' AND Year(datecreated)='".date("Y")."'");
        $this->view->render("support/index");
    }
    
    private static function date_quarter()
    {
        $month = date('n');
    
        if ($month <= 3) return 1;
        if ($month <= 6) return 2;
        if ($month <= 9) return 3;
    
        return 4;
    }
    
    public function email(){
        $uri=new Url("");
        @$this->loadModel("Support");
        $this->view->render("support/sendmail");
    }
    
    public function ticketlist($mid=1){
		$ticketlist ="";
		if(empty($mid)){
			redirect_to($this->uri->link("error/index"));
			exit;
		}
		$this->loadModel("Support");
		$datum = $this->model->getList("","support");
		$this->view->mytickets =$datum['Supportticket'];
        $uri = new Url("");
        $ticketlist .="<div class='row'><div class='large-12 columns'>".$datum['mypagin']; $ticketlist .="</div></div><div class='row'><div class='large-12 columns'><table class='pure-table'  width='100%'>
			<thead><tr>
				<th width='10%'>Date</th><th width='2%'>ticketID</th><th width='15%'>Product</th><th width='10%'>Client </th><th width='45%'>Issue(s)</th><th width='10%'>Status </th><th width='12%'>Date Modified </th><th width='5%'></th>
			</tr>
			</thead>
			<tbody>";
			
			  if($this->view->mytickets){
				  $x =1;
				foreach($this->view->mytickets as $ticket){
				$ticketlist .="<tr>
					<td>".date_format(new DateTime($ticket->datecreated),"M d Y H:i:s")."</td><td>$ticket->id</td><td>";
                    $cprod = $this->model->getClientProdByID($ticket->prod_id);
                    $ticketlist .= $cprod->prod_name." ". $cprod->install_address." ". $cprod->install_city;
                    
                    
                   $ticketlist .="</td><td>";
                   $client  =   $this->model->getClientByID($ticket->client_id);
                   $ticketlist .=$client->name ;
                   $ticketlist .="</td><td>$ticket->issue </td><td>$ticket->status</td><td>".date_format(new DateTime($ticket->datemodified),"M d Y H:i:s")."</td><td><a href='".$uri->link("support/detail/".$ticket->id."")."'>View Ticket</a></td>
				</tr>";
				$x++;
				}
			  }else{
				$ticketlist .= "<tr><td colspan='7'>No record to display</td></tr>";
			  }
			
			$ticketlist .= "</tbody>
			</table></div></div><div class='row'><div class='large-12 columns'>"; $ticketlist .=$datum['mypagin']."</div><p>&nbsp;</p></div>";
			
            
            $this->view->myvends = $ticketlist;
            if(isset($_POST['prodname'])){
                        echo $ticketlist;
                    }elseif(isset($_POST['rec'])){
                        echo $ticketlist;
                    }else{
                        $this->view->render("support/ticketlist");
                    }
			
		
	}
    
    /**
     * this the detail listing 
     * for support session between 
     * customer and administrator
     */
    public function detail($id=""){
	   @$this->loadModel("Support");
        //$datum = $this->model->getData();
        $replyData = $this->model->getTicketData($id);
        //$this->view->state = $datum['state'];
        $uri = new Url("");
        $ticket = $replyData['ticket'];
        $replies    =   $replyData["replies"];
        //$this->view->employee =   Employee::find_by_sql("SELECT * FROM employee WHERE emp_dept='5'");
        $this->view->country = $datum['country'];
        $this->view->ticket     =   $replyData['ticket'];
		//$this->view->mymenu = $this->model->getById($id);
        
        $pgdetail ="";
        
        
        /**
         * hhhhhh
         */
        
         if($ticket){
            /**
             * form opens
             */
             
             $pgdetail .="<div class='row'><input type='hidden' name='cid' id='cid' value='$ticket->prod_id' />
     	<div class='large-12 columns'><div class='btn-group'><a href='".$uri->link("support/ticketlist")."'class='btn btn-info button'  >&laquo; Back</a> <a href='#' id='dh' class='btn btn-primary button'> Reply </a>"; ($ticket->status !="Closed") ? $pgdetail .="<a href='#' id='close' class='btn btn-danger button' >Close Ticket </a>" : ""; $pgdetail .="<a href='#' data-reveal-id='myModal5' class='btn btn-info button'>Assign Task to Employee</a></div>
     </div></div>
         </div> <!--closing to reload close -->
         <div id='hideme'><form action='". $uri->link("support/doCreateAdminReply/".$ticket->id."") ."' method='post' enctype='multipart/form-data' name='frmEmp5' id='frmEmp5'>
	     <fieldset><div id='transalert'></div>
   	       
	            <div class='row'>
                    <div class='large-12 columns'>
                    <input type='hidden'  name='cname' id='cname' value='Customer Support Robert Johnson Holdings'  />
                            <input type='hidden' id='disid' name='disid' value='".$ticket->id."' />
                            
                            
                            <div>Enter emails to copy here separate with commas</div>
	                      <input type='text' id='cemail' name='cemail' />
		                    <input type='hidden'   name='email' id='email'  />
		                    <div id='tm2'></div>
                            <div>Response</div>
	                      <textarea  name='issue' id='issue' ></textarea></td>
                  
		                <a class='btn btn-info' id='replysave' >Send Reply </a>
                    </div>
		                    
		                  
		                    
          </fieldset>
           </form></div>";
             
             
            /**
             * form close
             */
            
            
            $pgdetail .="<div id='granddiv'><div id='divclose'><div class='row'>
     	<div class='ticketdetailscontainer'>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Submitted
                <div class='detail'>".$ticket->datecreated."</div>
            </div>
        </div>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Department
                <div class='detail'>$ticket->department</div>
            </div>
        </div>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Priority
                <div class='detail'>$ticket->priority</div>
            </div>
        </div>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Status
                <div class='detail'>"; $pgdetail .= ($ticket->status =="Open") ? "<span style='color:#779500'>Open</span>" : "<span style='color:#f00'>$ticket->status</span>" ; $pgdetail .="</div>
            </div>
        </div>
        
        <div class='clear'></div>
    <br clear='all' />
                </div>
  	 </div><!-- Erred Close of grand div -->";
            
         }
         
    
         
  	 $pgdetail .= "
           <div class='ticketmsgs'>
           ";
           if($replies){
                foreach($replies as $reply){
                    if($reply->sender_type == "Client"){
                    
                    $pgdetail .= "<div class='clientheader'>
                    <div style='float:right;'>$reply->datecreated</div>
                                $reply->sender_name || Client
                    </div>
                    <div class='clientmsg'>
                                $reply->message
                   </div>";
                }else{
                    
                    $pgdetail .= "<div class='adminheader'>
                    <div style='float:right;'>$reply->datecreated</div>
                            $reply->sender_name || Staff
                    </div>
                    
                    <div class='adminmsg'>

                        $reply->message
                                             
                        <div class='clear'></div>
                    </div>";

                    
                }
               }
            
           }
        $pgdetail .= "</div></div>";
        $this->view->myReplyData = $pgdetail;
		$this->view->render("support/detail");
	}
    
    
    public function doCreateAdminReply($id){
		@$this->loadModel("Support");
		if($this->model->createAdminReply($id)===1){
		  
          $datum = $this->model->getData();
          $replyData = $this->model->getTicketData($id);
          $uri = new Url("");
          $ticket = $replyData['ticket'];
          $replies    =   $replyData["replies"];
          
          $pgdetail ="<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
          
          if($ticket){
            $pgdetail .="<div id='divclose'><div class='row'>
     	<div class='ticketdetailscontainer'>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Submitted
                <div class='detail'>".$ticket->datecreated."</div>
            </div>
        </div>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Department
                <div class='detail'>$ticket->department</div>
            </div>
        </div>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Priority
                <div class='detail'>$ticket->priority</div>
            </div>
        </div>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Status
                <div class='detail'>"; $pgdetail .= ($ticket->status =="Open") ? "<span style='color:#779500'>Open</span>" : "<span style='color:#f00'>$ticket->status</span>" ; $pgdetail .="</div>
            </div>
        </div>
        
        <div class='clear'></div>
    <br clear='all' />
                </div>";
          }
          
          
          $pgdetail .= "
           <div class='ticketmsgs'>
           ";
           if($replies){
                foreach($replies as $reply){
                    if($reply->sender_type == "Client"){
                    
                    $pgdetail .= "<div class='clientheader'>
                    <div style='float:right;'>$reply->datecreated</div>
                                $reply->sender_name || Client
                    </div>
                    <div class='clientmsg'>
                                $reply->message
                   </div>";
                }else{
                    
                    $pgdetail .= "<div class='adminheader'>
                    <div style='float:right;'>$reply->datecreated</div>
                            $reply->sender_name || Staff
                    </div>
                    
                    <div class='adminmsg'>

                        $reply->message
                                             
                        <div class='clear'></div>
                    </div>";

                    
                }
               }
            
           }
        $pgdetail .= "</div></div>";
          
			echo $pgdetail;
            
		}elseif($this->model->createAdminReply() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->createAdminReply() === 3){
			echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
		}elseif($this->model->createAdminReply() === 4){
			echo"<div data-alert class='alert-box alert'>Critical! <br />Cannot enter Duplicated vendor ID <a h`ref='#' class='close'>&times;</a></div>";
		}else{
      echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
	}
    
    public function doCloseTicket(){
        @$this->loadModel("Support");
        if($this->model->closeTicket()){
             $replyData = $this->model->getTicketData($_POST['id']);
        //$this->view->state = $datum['state'];
        $uri = new Url("");
        $ticket = $replyData['ticket'];
            if($ticket){
                
           
         $pgdetail ="";     
            $pgdetail .="<div class='row'>
     	<div class='ticketdetailscontainer'>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Submitted
                <div class='detail'>".$ticket->datecreated."</div>
            </div>
        </div>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Department
                <div class='detail'>$ticket->department</div>
            </div>
        </div>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Priority
                <div class='detail'>$ticket->priority</div>
            </div>
        </div>
        <div class='large-3 columns'>
            <div class='internalpadding'>
                Status
                <div class='detail'>"; $pgdetail .= ($ticket->status =="Open") ? "<span style='color:#779500'>Open</span>" : "<span style='color:#f00'>$ticket->status</span>" ; $pgdetail .="</div>
            </div>
        </div>
        
        <div class='clear'></div>
    <br clear='all' />";
            
         }
         
    
     
        }
        
        echo $pgdetail;
    }
    
    
    
    
    
    
    /**
     * this section gets the 
     * signoff form list 
     */
    public function signofflist(){
		
		$signofflisting ="";
		
		$this->loadModel("Support");
		$datum = $this->model->getSignOffList("","support");
		$this->view->signoffs =$datum['signoff'];
        $uri = new Url("");
         global $session;
        $signofflisting .="<div class='row'><div class='large-12 columns'>".$datum['mypagin']; $signofflisting .="</div></div><div class='row'><div class='large-12 columns'><table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Product/Machine</th><th>Client</th><th>Status</th><th>Emp ID</th><th>Client Remark</th><th>Date Generated </th><td></td><td></td><td></td>
</tr>
</thead>
<tbody>";

  if($this->view->signoffs){
	  $x =1;
    foreach($this->view->signoffs as $signoff){
    $signofflisting .="<tr>
    	<td>$x</td><td>";
        $cprod = $this->model->getClientProdByID($signoff->prod_id);
         $signofflisting .= $cprod->prod_name." ". $cprod->install_address." ".$cprod->install_city; $signofflisting .="</td>
         <td>"; //procedure to get client's detail
         $client = $this->model->getClientByID($cprod->client_id);
        
         $signofflisting .=$client->name;
         $signofflisting .="</td><td>$signoff->status </td><td>$signoff->employee_id</td><td>$signoff->client_remark</td><td>".date_format(new DateTime($signoff->datecreated),"M d Y H:i:s")."</td>";
        
        
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
                            $signofflisting .="<td><a href='".$uri->link("support/signoffdetail/".$signoff->id."")."'>View Detail</a></td>";
                    
                        }else{
                            $signofflisting .="<td></td>";
                        }
                        
                        if(in_array("Delete",$grant)){
                           
                            $signofflisting .="<td></td>";
                    
                        }else{
                            $signofflisting .="<td></td>";
                        }
                        
                        if(in_array("Modify",$grant)){
                           
                            $signofflisting .="<td><a href='".$uri->link("support/signoffedit/".$signoff->id."")."'>Edit</a></td>";
                    
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
</table></div></div><div class='row'><div class='large-12 columns'>"; $signofflisting .=$datum['mypagin']."</div><p>&nbsp;</p></div>";

$this->view->myvends = $signofflisting;
	        $this->view->render("support/signofflist");
    }
    
   
    public function addsignoff(){
        @$this->loadModel("Support");
        $retumo                 =   $this->model->getData();
        $this->view->products   =   $retumo["myproducts"];
        $this->view->techstaff  =   $retumo['techstaff'];
        $rand     =   mt_rand(1000,9999);
        $this->view->formid     =  str_pad($retumo['lastsf'].$rand, 8, "0", STR_PAD_LEFT) ;
        
        $this->view->render("support/addsignoff");
    }
    

    public function addnewws(){
        @$this->loadModel("Support");
        $retumo                 =   $this->model->getData();
        $rand     =   mt_rand(10000,99999);
        $this->view->formid     =  str_pad($retumo['lastws'].$rand, 10, "0", STR_PAD_LEFT) ;
        $this->view->techstaff  =   $retumo['techstaff'];
       // print_r($this->view->techstaff);
        $this->view->render("support/addnewws");
    }
    
    
    
	
	
	/**
	 * this section is
     * needed to list out worksheets
	 */
	
	public function worksheetlist(){
		
		$worksheetlisting ="";
		
		$this->loadModel("Support");
		$datum                        = $this->model->getWorkSheetList("","support");
		$this->view->worksheets       = $datum['worksheet'];
        $uri                          = new Url("");
         
        $worksheetlisting .="<div class='row'><div class='large-12 columns'>".$datum['mypagin']; $worksheetlisting .="</div></div><div class='row'><div class='large-12 columns'><table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Product/Machine</th><th>Issue</th><th>Status</th><th>Technician</th><th>Date Generated </th><th>Expenses</th><th></th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->worksheets){
	  $x =1;
    foreach($this->view->worksheets as $worksheet){
    $worksheetlisting .="<tr>
    	<td>$x</td><td>";
        $cprod = $this->model->getClientProdByID($worksheet->prod_id);
                    $worksheetlisting .= $cprod->prod_name." ". $cprod->install_address." ". $cprod->install_city;
        //print_r($worksheet->cse_emp_id);
         $worksheetlisting .="</td><td>$worksheet->problem</td><td>$worksheet->status </td><td>";
         $emp   =   $this->model->getEmployee((int)preg_replace('#[^0-9]#i','',$worksheet->cse_emp_id));
         //print_r($cprod);
         $worksheetlisting .= $emp->emp_fname." ". $emp->emp_lname ;
         $worksheetlisting .= "</td><td>".date_format(new DateTime($worksheet->sheet_date),"M d Y H:i:s")."</td><td>".Worksheet::getExpensesById($worksheet->id)."</td>";
        
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
                        if(in_array("Modify",$grant)  ){
                          
                            $worksheetlisting .="<td><a href='".$uri->link("support/tasksupport/".$worksheet->id."")."'>Allocate Resource</a></td>";
                    
                        }elseif(in_array("Modify",$grant)){
                            $worksheetlisting .="<td><a href='".$uri->link("support/worksheetedit/".$worksheet->id."")."'>Edit</a></td>";
                        }elseif($session->employee_role =='10'){
                            $worksheetlisting .="<td><a href='".$uri->link("support/worksheetedit/".$worksheet->id."")."'>Edit</a></td>";
                        }else{
                            $worksheetlisting .="<td></td>";
                        }
                        
                        
                        if(in_array("View",$grant)){
                           
                            $worksheetlisting .="<td><a href='".$uri->link("support/worksheetdetail/".$worksheet->id."")."'>View Detail</a></td>";
                    
                        }else{
                            $worksheetlisting .="<td></td>";
                        }
                        
                        
                        if(in_array("Delete",$grant)){
                           
                            $worksheetlisting .="<td></td>";
                    
                        }else{
                            $worksheetlisting .="<td></td>";
                        }
                       
                    }
                    
                }
        
        
        
        
    $worksheetlisting .="</tr>";
	$x++;
    }
  }else{
    $worksheetlisting .= "<tr><td colspan='9'>No record to display</td></tr>";
  }

$worksheetlisting .= "</tbody>
</table></div></div><div class='row'><div class='large-12 columns'>"; $worksheetlisting .=$datum['mypagin']."</div><p>&nbsp;</p></div>";

$this->view->myvends = $worksheetlisting;
            if(isset($_POST['clientid'])){
                echo $worksheetlisting;
            }elseif(isset($_POST['rec'])){
                echo $worksheetlisting;
            }else{
                $this->view->render("support/worksheetlist");
            }
	        
    }
    
    
    
    /**
	 * this section is
     * needed to list out worksheets
	 */
    public function worksheetdetail($id){
        $this->loadModel("Support");
        $this->view->myworksheet    =   $this->model->getWorkSheetByID($id);
        $this->view->prodpart       =   $this->model->getProdPartByWorkID($id);
        $this->view->parttot        =   0;
        if($this->view->prodpart){
            
            foreach($this->view->prodpart as $part){
             $this->view->parttot += $part->total_cost;  
            }
        }
        $this->view->totexpend  =   (int)$this->view->parttot + (int)$this->view->myworksheet->fund;
        $this->view->render("support/worksheetdetail");
    }
    
    
    public function worksheetedit($id){
        @$this->loadModel("Support");
        $this->view->prodpart       =   $this->model->getProdPartByWorkID($id);
       // print_r()
        $this->view->myworksheet    =   $this->model->getWorkSheetByID($id);
        $this->view->render("support/worksheetedit");
    }
    
    public function doDeleteWorkSheet($id){
        
    }
    
    public function signoffdetail($id){
        @$this->loadModel("Support");
        $this->view->mysignoff    =   $this->model->getSignOffByID($id);
        $this->view->clientprod   =     $this->model->getClientProdByID($this->view->mysignoff->prod_id);
        $this->view->render("support/signoffdetail");
    }
	
    
    public function signoffedit($id){
        $this->loadModel("Support");
        $datum                    =     array();
        $datum                    =     $this->model->getData();
        $this->view->products     =     $datum['myproducts'];
        $this->view->mysignoff    =   $this->model->getSignOffByID($id);
        
        $this->view->techstaff  =   $datum['techstaff'];
        
        $this->view->clientprod   =     $this->model->getClientProdByID($this->view->mysignoff->prod_id);
        $this->view->render("support/signoffedit");
    }
    
    
	public function scheduleList(){
		
		$schedulelisting ="";
		 global $session;
		$this->loadModel("Support");
		$datum = $this->model->getScheduleList("","support");
		$this->view->schedules =$datum['schedules'];
        $uri = new Url("");
        $schedulelisting .="<div class='row'><div class='large-12 columns'>".$datum['mypagin']; $schedulelisting .="</div></div><div class='row'><div class='large-12 columns'><table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Product/Machine</th><th>Client</th><th>Status</th><th>Technician</th><th>Issue</th><th>Date Generated </th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->schedules){
	  $x =1;
    foreach($this->view->schedules as $schedule){
    $schedulelisting .="<tr>
    	<td>$x</td><td>";
        $cprod = $this->model->getClientProdByID($schedule->prod_id);
        $schedulelisting .= $cprod->prod_name." ". $cprod->install_address." ". $cprod->install_city;
        
         $schedulelisting .="</td><td>";
         
         $client = $this->model->getClientByID($schedule->client_id);
        
         $schedulelisting .=$client->name;
         $schedulelisting .="</td><td>$schedule->status </td><td><input type='hidden' class='empid'  /> $schedule->emp_name</td><td>$schedule->issue</td><td>".date_format(new DateTime($schedule->datecreated),"M d Y H:i:s")."</td><td>";
        
        if($schedule->status==="Open"){
            $schedulelisting .="<a href='".$uri->link("support/addworksheet/".$schedule->id."")."'>Get Work Sheet</a>";
        }/*else{
            $schedulelisting .="<a href='".$uri->link("support/taskdetail/".$schedule->id."")."'>View Detail</a>";
        }*/
        
    $schedulelisting .="</td></tr>";
	$x++;
    }
  }else{
    $schedulelisting .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$schedulelisting .= "</tbody>
</table></div></div><div class='row'><div class='large-12 columns'>"; $schedulelisting .=$datum['mypagin']."</div><p>&nbsp;</p></div>";

$this->view->myvends = $schedulelisting;
        if(isset($_POST['clientid'])){
                echo $schedulelisting;
            }elseif(isset($_POST['rec'])){
                echo $schedulelisting;
            }else{
                $this->view->render("support/taskmanager");
        }

    }
    
    
    /**
     * section required to add
     * a new worksheet
     */
    
    public function addworksheet($id){
        @$this->loadModel("Support");
        $retumo     =   $this->model->getData();
        $this->view->products   =   $retumo["products"];
        $this->view->schedu     =   $this->model->getTaskById($id);
        $this->view->render("support/addworksheet");
    }
    
    /**
     * required to load
     * task support PAge
     */
    public function tasksupport($id){
        @$this->loadModel("Support");
        $this->view->myworksheet   =   $this->model->getWorkSheetByID($id);
        $this->view->render("support/tasksupport");
    }
    
    /**
     * required to update
     * task support PAge
     */
     
    public function doTaskSupportWUpdate($id){
        @$this->loadModel("Support");
		if($this->model->updateWorkSheet($id)===1){
		  redirect_to($this->uri->link("support/worksheetlist"));
			//echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->updateWorkSheet($id) === 2){
		  redirect_to($this->uri->link("support/worksheetlist"));
			//echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->updateWorkSheet($id) === 3){
		  redirect_to($this->uri->link("support/worksheetlist"));
			//echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a href='#' class='close'>&times;</a></div>";
		}else{
		  redirect_to($this->uri->link("support/worksheetlist"));
            //echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}
    }
    
    public function doCreateSignOff(){
        
		@$this->loadModel("Support");
		if($this->model->createsignoff()===1){
		  redirect_to($this->uri->link("support/signofflist"));
			//echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->createsignoff() === 2){
		  redirect_to($this->uri->link("support/signofflist"));
			//echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->createsignoff() === 3){
		  redirect_to($this->uri->link("support/signofflist"));
			//echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a href='#' class='close'>&times;</a></div>";
		}else{
		  redirect_to($this->uri->link("support/signofflist"));
            //echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
    }
    
    
    
    public function doUpdateSignOff(){
        
		@$this->loadModel("Support");
		if($this->model->updatesignoff()===1){
		  redirect_to($this->uri->link("support/signofflist"));
			//echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->updatesignoff() === 2){
		  redirect_to($this->uri->link("support/signofflist"));
			//echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->updatesignoff() === 3){
		  redirect_to($this->uri->link("support/signofflist"));
			//echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a href='#' class='close'>&times;</a></div>";
		}else{
		  redirect_to($this->uri->link("support/signofflist"));
            //echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
    }
    
    
    
    public function doCreateWorkSheet(){
        @$this->loadModel("Support");
		if($this->model->creatworksheet()===1){
            redirect_to($this->uri->link("support/worksheetlist"));
			
		}elseif($this->model->creatworksheet() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->creatworksheet() === 3){
			echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a href='#' class='close'>&times;</a></div>";
		}else{
            echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}
    }
    
    public function doCreateAddPart(){
        @$this->loadModel("Support");
		if($this->model->createAddPart()){
	
          $myPart = $this->model->getPartsWS($_POST['wid']);
          echo"<table  width='50%'>
            <thead><tr>
            	<th>Part/Item ID</th><th>Part Name</th><th>QTy</th><th>unit cost</th><th>Total</th><th></th>
            </tr>
            </thead>
            <tbody>";
            $x=1;
            foreach($myPart as $part){
                echo"<tr><td>$part->item_id</td><td>$part->part_name</td><td>$part->qty</td><td>$part->unit_cost</td><td>$part->total_cost</td><td><a href='#' class='itdeletelink' itdid='{$part->id}'><img src='public/icons/Delete16.png' /></a></td></tr>" ;           
            }
            $x++;
            echo "</tbody></table>";

		}
	}
    
    public function doDeleteAddPart(){
        @$this->loadModel("Support");
		if($this->model->deletePart()){
	
          $myPart = $this->model->getPartsWS($_POST['wid']);
          echo"<table  width='50%'>
            <thead><tr>
            	<th>Part/Item ID</th><th>Part Name</th><th>QTy</th><th>unit cost</th><th>Total</th><th></th>
            </tr>
            </thead>
            <tbody>";
            $x=1;
            foreach($myPart as $part){
                echo"<tr><td>$part->item_id</td><td>$part->part_name</td><td>$part->qty</td><td>$part->unit_cost</td><td>$part->total_cost</td><td><a href='#' class='itdeletelink' itdid='{$part->id}'><img src='public/icons/Delete16.png' /></a></td></tr>" ;           
            }
            $x++;
            echo "</tbody></table>";

		}
	}
    
    
} 
	
?>