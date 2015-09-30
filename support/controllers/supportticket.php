<?php
class Supportticket extends Controller{

	function __construct(){
		parent::__construct();
		global $session;
		//check if user is logged in;		
		if(!$session->client_logged_in()){
			 redirect_to($this->uri->link("login/index"));
		}
		
	}
	
	public function index($mid=1){
		$ticketlist ="";
		if(empty($mid)){
			redirect_to($this->uri->link("error/index"));
			exit;
		}
		@$this->loadModel("Supportticket");
		$datum = $this->model->getListClient("","supportticket");
		$this->view->mytickets =$datum['supportticket'];
        $uri = new Url("");
        $ticketlist .="
		".$datum['mypagin']."
		<table class='table table-striped table-bordered' width='100%' id='datatable_fixed_column'>
			<thead><tr>
				<th width='15%'>Date Created</th><th width='10%'>Ticket ID</th><th>Terminal ID</th><th width='40%'>Subject</th><th width='5%'>Status </th><th width='10%'>Department </th><th width='10%'>Last Reply</th><th width='10%'></th>
			</tr>
			</thead>
			<tbody>";
			
			  if($this->view->mytickets){
				  $x =1;
				foreach($this->view->mytickets as $ticket){
				$ticketlist .="<tr>
					<td>".date_format(new DateTime($ticket->datecreated),"M d Y g:ia")."</td><td>$ticket->id</td><td>$ticket->terminal_id</td><td>$ticket->subject </td><td><span class='";
                    if(strtolower($ticket->status) == "open"){
                        $ticketlist .=" label bg-red ";
                    }elseif(strtolower($ticket->status) == "closed"){
                        $ticketlist .=" label bg-green ";
                    }elseif(strtolower($ticket->status) == "admin reply" || strtolower($ticket->status)=="customer reply"){
                        $ticketlist .=" label bg-blue ";
                    } $ticketlist .="'>"; $ticketlist .= ($ticket->status =="Admin Reply" || $ticket->status =="Customer Reply") ? "Pending" : $ticket->status ; $ticketlist .="</span></td><td>$ticket->department</td><td>".date_format(new DateTime($ticket->datemodified),"M d Y g:ia")."</td><td><a href='".$uri->link("supportticket/detail/".$ticket->id."")."'>View Ticket</a></td>
				</tr>";
				$x++;
				}
			  }else{
				$ticketlist .= "<tr><td colspan='7'>No record to display</td></tr>";
			  }
			
			$ticketlist .= "</tbody>
			</table>
			".$datum['mypagin']."";
			
			$this->view->myvends = $ticketlist;
		$this->view->render("supportticket/index");
	}



    public function activationlist($mid=1){
        $ticketlist ="";
        if(empty($mid)){
            redirect_to($this->uri->link("error/index"));
            exit;
        }
        @$this->loadModel("Supportticket");
        $datum = $this->model->getListActivation("","supportticket");
        $this->view->mytickets =$datum['supportticket'];
        $uri = new Url("");
        $ticketlist .="<table class='table table-striped table-bordered' width='100%' id='datatable_fixed_column'>
			<thead><tr>
				<th>Date Created</th><th >Terminal ID</th><th>Product</th><th>Status</th><th>Atm Type </th><th> Location</th><th>Branch</th><th >Contact</th><th>Contact Phone</th><th></th><th></th>
			</tr>
			</thead>
			<tbody>";

        if($this->view->mytickets){
            $x =1;
            foreach($this->view->mytickets as $ticket){
                $ticketlist .="<tr>
					<td>".date_format(date_create($ticket->created_at),"M d Y g:ia")."</td><td>$ticket->terminal_id</td><td>$ticket->product_name </td><td><span class='";
                if(strtolower($ticket->status) == "open"){
                    $ticketlist .=" label bg-red ";
                }elseif(strtolower($ticket->status) == "closed"){
                    $ticketlist .=" label bg-green ";
                }elseif(strtolower($ticket->status) == "admin reply" || strtolower($ticket->status)=="customer reply"){
                    $ticketlist .=" label bg-blue ";
                } $ticketlist .="'>"; $ticketlist .= ($ticket->status =="Admin Reply" || $ticket->status =="Customer Reply") ? "Pending" : $ticket->status ; $ticketlist .="</span></td><td>$ticket->atm_type</td><td>$ticket->location</td><td>$ticket->branch</td><td>$ticket->contact_name</td><td>$ticket->contact_phone</td><td>";
                if($ticket->status =="Closed" || $ticket->status =="In Progress"){

                }else{
                    $ticketlist .="<a href='".$uri->link("supportticket/editActivation/".$ticket->id."")."'>Edit</a>";
                }


                $ticketlist .="</td><td><a href='".$uri->link("supportticket/actdetails/".$ticket->id."")."'>Details</a></td></tr>";
                $x++;
            }
        }else{
            $ticketlist .= "<tr><td colspan='7'>No record to display</td></tr>";
        }

        $ticketlist .= "</tbody>
			</table>
			";

        $this->view->activations = $ticketlist;
        $this->view->render("supportticket/activationlist");
    }


    public function create($id = ""){
		@$this->loadModel("Supportticket");
		if($id != ""){
			$this->view->product = Cproduct::find_by_id($id);	
		}
        $datum = $this->model->getData();
        $this->view->country 	= 	$datum['country'];
		$this->view->issues		=	$datum['issues'];
        $this->view->products  = $datum['products'];
		$this->view->render("supportticket/create");
	}
	
	public function edit(){
	   @$this->loadModel("Supportticket");
        $datum = $this->model->getData();
        //$this->view->state = $datum['state'];
        $this->view->country = $datum['country'];
        $this->view->products  = $datum['products'];
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("supportticket/create");
	}

    public function editActivation($id){
        @$this->loadModel("Supportticket");
        $datum = $this->model->getData();
        $myActivation = $this->model->getActivationData($id);
        //$this->view->state = $datum['state'];
        $this->view->country = $datum['country'];
        $this->view->products  = $datum['products'];
        $this->view->activation = $myActivation;

        $this->view->render("supportticket/activationdetails");
    }


    public function actdetails($id){
        $this->view->activation = Activation::find_by_id($id);
        $this->view->render("supportticket/actdetails");
    }
    
    public function detail($id=""){
	   @$this->loadModel("Supportticket");
        $datum = $this->model->getData();
        $replyData = $this->model->getTicketData($id);
        //$this->view->state = $datum['state'];
        $uri = new Url("");
        $ticket = $replyData['ticket'];
        $this->view->products  = $datum['products'];
        $replies    =   $replyData["replies"];
        $this->view->country = $datum['country'];
		//$this->view->mymenu = $this->model->getById($id);
        
        $pgdetail ="";
        
        
        /**
         * hhhhhh
         */
         if($ticket){
			 $pgdetail .= "<div class='row'>
     	<div class='btn-group'><a href='".$uri->link("supportticket/index")."'class='btn btn-info' >&laquo; Back</a>"; $pgdetail .= $ticket->status =="Closed" ? " " : "<a href='#' id='dh' class='btn btn-primary'> Reply </a>"; ($ticket->status !="Closed") ? $pgdetail .="<a href='#' id='close' class='btn btn-danger' >Close Ticket </a>" : ""; $pgdetail .="</div>
     </div>";
	 
	 
	 $pgdetail .= "
         
         <div id='hideme'><form action='". $uri->link("supportticket/doCreateClientReply/".$ticket->id."") ."' method='post' enctype='multipart/form-data' name='frmEmp3' id='frmEmp3'>
	     <fieldset><div id='transalert'></div>

	            <table class='table' border='0'>
		              <tr>
		                <td width='39%'>
		                    <label>Name</label>
		                  
		                    <input type='text' class='form-control'  name='cname' id='cname' value='".$ticket->contact_name."' />
                            <input type='hidden' id='disid' name='disid' value='".$ticket->id."' />
	                      </td>
		                <td width='20%'></td>
		                <td width='41%'>
		                  
		                    <label>Email <span class='red'>*</span></label>
	                      
		                    <input type='email' class='form-control'   name='email' id='email' value='".$ticket->contact_email."' />
		                    <div id='tm2'></div>
	                      </td>
                  </tr>
		              
		              
		              <tr>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
                  </tr>
		              <tr>
		                <td>Reply</td>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
                  </tr>
		              <tr>
		                <td colspan='3'><textarea class='form-control'  name='issue' id='issue' ></textarea></td>
                  </tr>
		              <tr>
		                <td><label for='fupload'>Attach file</label>
                        <input type='file' class='form-control' name='fupload' id='fupload'></td>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
                  </tr>
		              <tr>
		                <td>&nbsp;</td>
		                <td><a class='btn btn-info' id='replysave' >Send Reply</a></td>
		                <td></td>
                  </tr>
           </table>
          </fieldset>
           </form></div>";
            $pgdetail .="<div id='granddiv'><div id='divclose'><div class='row'>
     	<div class='row ticketdetailscontainer'>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Submitted
                <div class='detail'>".$ticket->datecreated."</div>
            </div>
        </div>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Department
                <div class='detail'>$ticket->department</div>
            </div>
        </div>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Priority
                <div class='detail'>$ticket->priority</div>
            </div>
        </div>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Status
                <div class='detail'>"; $pgdetail .= ($ticket->status =="Open") ? "<span style='color:#779500'>Open</span>" : "<span style='color:#f00'>$ticket->status</span>" ; $pgdetail .="</div>
            </div>
        </div>
        
        <div class='clear'></div>
    
                </div>
  	 </div></div> <!--closing to reload close -->";
            
         }
         
    
         
  	 
          $pgdetail .="<div class='ticketmsgs'>
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
        $pgdetail .= "</div></div>"; //last div closes for granddiv
     
         
         
         
         /**
          * utuuut
          */
        
              
        $this->view->myReplyData = $pgdetail;
		$this->view->render("supportticket/detail");
	}

    public function doCreate(){
		@$this->loadModel("Supportticket");
		$result = $this->model->create();
		if($result==1){
			global $session;
			$_SESSION['message']="<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
			redirect_to("?url=supportticket/index");
			
		}elseif($result== 2){
			global $session;
			$_SESSION['message']="<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		
		}elseif($result== 3){
			global $session;
			$_SESSION['message']="<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
		}elseif($result== 4){
			echo"<div data-alert class='alert-box alert'>Critical! <br />Cannot enter Duplicated vendor ID <a h`ref='#' class='close'>&times;</a></div>";
		}else{
      echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
	}

    public function doCreateClientReply($id){
		@$this->loadModel("Supportticket");
		if($this->model->createClientReply($id)===1){
			//echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		$_SESSION['message']="Reply Sent to RJ Support Team";
		$datum = $this->model->getData();
        $replyData = $this->model->getTicketData($id);
        //$this->view->state = $datum['state'];
        $uri = new Url("");
        $ticket = $replyData['ticket'];
        $replies    =   $replyData["replies"];
       
        
        $pgdetail ="<div id='transalert'></div>


        <div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <h4>	<i class='icon fa fa-check'></i> Alert!</h4>
                   Ticket Successfully sent.
                  </div>



       ";
        
        
        /**
         * hhhhhh
         */
         if($ticket){
            $pgdetail .="<div id='divclose'><div class='row'>
     	<div class='row ticketdetailscontainer'>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Submitted
                <div class='detail'>".$ticket->datecreated."</div>
            </div>
        </div>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Department
                <div class='detail'>$ticket->department</div>
            </div>
        </div>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Priority
                <div class='detail'>$ticket->priority</div>
            </div>
        </div>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Status
                <div class='detail'>"; $pgdetail .= ($ticket->status =="Open") ? "<span style='color:#779500'>Open</span>" : "<span style='color:#f00'>$ticket->status</span>" ; $pgdetail .="</div>
            </div>
        </div>
        
        <div class='clear'></div>
    
                </div>
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
        $pgdetail .= "</div>"; //last div closes for granddiv
			echo ($pgdetail);
			
		}elseif($this->model->createClientReply() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->createClientReply() === 3){
			echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
		}elseif($this->model->createClientReply() === 4){
			echo"<div data-alert class='alert-box alert'>Critical! <br />Cannot enter Duplicated vendor ID <a h`ref='#' class='close'>&times;</a></div>";
		}else{
      echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
	}
    
    public function doCloseTicket(){
        @$this->loadModel("Supportticket");
        if($this->model->closeTicket()){
             $replyData = $this->model->getTicketData($_POST['id']);
        //$this->view->state = $datum['state'];
        $uri = new Url("");
        $ticket = $replyData['ticket'];
            if($ticket){
                
           
         $pgdetail ="";     
            $pgdetail .="<div id='divclose'><div class='row'>
     	<div class='row ticketdetailscontainer'>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Submitted
                <div class='detail'>".$ticket->datecreated."</div>
            </div>
        </div>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Department
                <div class='detail'>$ticket->department</div>
            </div>
        </div>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Priority
                <div class='detail'>$ticket->priority</div>
            </div>
        </div>
        <div class='col-lg-3'>
            <div class='internalpadding'>
                Status
                <div class='detail'>"; $pgdetail .= ($ticket->status =="Open") ? "<span style='color:#779500'>Open</span>" : "<span style='color:#f00'>$ticket->status</span>" ; $pgdetail .="</div>
            </div>
        </div>
        
        <div class='clear'></div>
    
                </div>
  	 </div>";
            
         }

  	 $pgdetail .= "<div class='row'>
     	<div class='btn-group'><a href='#'   class='btn Action' onclick='window.location='".$uri->link("supportticket/index")."' >&laquo; Back</a>"; $ticket->status =="Closed" ? "" :  $pgdetail .="<a href='#' id='dh' class='btn btn-primary'> Reply </a>"; $pgdetail .=  ($ticket->status !="Closed") ? "<a href='#' id='close' class='btn btn-danger' >Close Ticket </a>" : ""; $pgdetail .="</div>
     </div>";
        }
        
        echo $pgdetail;
    }
	
	public function search(){
		$this->loadModel("Supportticket");
		$datum = $this->model->search();
		$this->view->mytickets =$datum['Supportticket'];
        $uri = new Url("");
        $ticketlist .="<table class='table table-bordered'>
			<thead><tr>
				<th width='15%'>Date Created</th><th width='10%'>Ticket ID</th><th width='40%'>Subject</th><th width='5%'>Status </th><th width='10%'>Department </th><th width='10%'>Last Reply</th><th width='10%'></th>
			</tr>
			</thead>
			<tbody>";
			
			  if($this->view->mytickets){
				  $x =1;
				foreach($this->view->mytickets as $ticket){
				$ticketlist .="<tr>
					<td>".date_format(new DateTime($ticket->datecreated),"M d Y g:ia")."</td><td>$ticket->id</td><td>$ticket->subject </td><td>$ticket->status</td><td>$ticket->department</td><td>".date_format(new DateTime($ticket->datemodified),"M d Y g:ia")."</td><td><a href='".$uri->link("supportticket/detail/".$ticket->id."")."'>View Ticket</a></td>
				</tr>";
				$x++;
				}
			  }else{
				$ticketlist .= "<tr><td colspan='7'>No Result Found</td></tr>";
			  }
			
			$ticketlist .= "</tbody>
			</table>";
			
			$this->view->myvends = $ticketlist;
		$this->view->render("supportticket/index");
	}

}
?>