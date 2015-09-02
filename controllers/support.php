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
		$ticketlist ="";
		if(empty($mid)){
			redirect_to($this->uri->link("error/index"));
			exit;
		}
		$this->loadModel("Support");
		$datum = $this->model->getList("","Support");
		$this->view->mytickets =$datum['Supportticket'];
        $uri = new Url("");
        $ticketlist .="<table class='pure-table'  width='100%'>
			<thead><tr>
				<th width='10%'>Date</th><th width='5%'>ticketID</th><th width='50%'>Subject</th><th width='10%'>Status </th><th width='10%'>Department </th><th width='12%'>Date Modified </th><th width='5%'></th>
			</tr>
			</thead>
			<tbody>";
			
			  if($this->view->mytickets){
				  $x =1;
				foreach($this->view->mytickets as $ticket){
				$ticketlist .="<tr>
					<td>".date_format(new DateTime($ticket->datecreated),"M d Y H:i:s")."</td><td>$ticket->id</td><td>$ticket->subject </td><td>$ticket->status</td><td>$ticket->department</td><td>$ticket->datemodified</td><td><a href='".$uri->link("support/detail/".$ticket->id."")."'>View Ticket</a></td>
				</tr>";
				$x++;
				}
			  }else{
				$ticketlist .= "<tr><td colspan='7'>No record to display</td></tr>";
			  }
			
			$ticketlist .= "</tbody>
			</table>";
			
			$this->view->myvends = $ticketlist;
		$this->view->render("support/index");
	}
    
    /**
     * this the detail listing 
     * for support session between 
     * customer and administrator
     */
    public function detail($id=""){
	   @$this->loadModel("Support");
        $datum = $this->model->getData();
        $replyData = $this->model->getTicketData($id);
        //$this->view->state = $datum['state'];
        $uri = new Url("");
        $ticket = $replyData['ticket'];
        $replies    =   $replyData["replies"];
        $this->view->country = $datum['country'];
		//$this->view->mymenu = $this->model->getById($id);
        
        $pgdetail ="";
        
        
        /**
         * hhhhhh
         */
        
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
                </div>
  	 </div>";
            
         }
         
    
         
  	 $pgdetail .= "<div class='row'>
     	<div class='btn-group'><a href='".$uri->link("support/index")."'class='btn btn-info'  >&laquo; Back</a> <a href='#' id='dh' class='btn btn-primary'> Reply </a>"; ($ticket->status !="Closed") ? $pgdetail .="<a href='#' id='close' class='btn btn-danger' >Close Ticket </a>" : ""; $pgdetail .="</div>
     </div>
         </div> <!--closing to reload close -->
         <div id='hideme'><form action='". $uri->link("support/doCreateAdminReply/".$ticket->id."") ."' method='post' enctype='multipart/form-data' name='frmEmp5' id='frmEmp5'>
	     <fieldset><div id='transalert'></div>
   	       
	            <table width='100%' border='0'>
		              <tr>
		                <td width='39%'>
		                    <label>Name</label>
		                  
		                    <input type='text'  name='cname' id='cname'  />
                            <input type='hidden' id='disid' name='disid' value='".$ticket->id."' />
	                      </td>
		                <td width='20%'></td>
		                <td width='41%'>
		                  
		                    <label>Email <span class='red'>*</span></label>
	                      
		                    <input type='email'   name='email' id='email'  />
		                    <div id='tm2'></div>
	                      </td>
                  </tr>
		              
		              
		              <tr>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
                  </tr>
		              <tr>
		                <td>Issue</td>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
                  </tr>
		              <tr>
		                <td colspan='3'><textarea  name='issue' id='issue' ></textarea></td>
                  </tr>
		              <tr>
		                <td><label for='fupload'>Attach file</label>
                        <input type='file' name='fupload' id='fupload'></td>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
                  </tr>
		              <tr>
		                <td>&nbsp;</td>
		                <td><input type='submit' value='Submit'></td>
		                <td></td>
                  </tr>
           </table>
          </fieldset>
           </form></div>
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
        $pgdetail .= "</div>";
     
         
         
         
         /**
          * utuuut
          */
        
              
        $this->view->myReplyData = $pgdetail;
		$this->view->render("support/detail");
	}
    
    
    public function doCreateAdminReply($id){
		@$this->loadModel("Support");
		if($this->model->createAdminReply($id)===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
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
            $pgdetail .="<div id='divclose'><div class='row'>
     	<div class='ticketdetailscontainer'>
        <div class='col-3'>
            <div class='internalpadding'>
                Submitted
                <div class='detail'>".$ticket->datecreated."</div>
            </div>
        </div>
        <div class='col-3'>
            <div class='internalpadding'>
                Department
                <div class='detail'>$ticket->department</div>
            </div>
        </div>
        <div class='col-3'>
            <div class='internalpadding'>
                Priority
                <div class='detail'>$ticket->priority</div>
            </div>
        </div>
        <div class='col-3'>
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
     	<div class='btn-group'><a href='#'   class='btn btn-info' onclick='window.location='".$uri->link("support/index")."' >&laquo; Back</a> <a href='#' id='dh' class='btn btn-primary'> Reply </a>"; ($ticket->status !="Closed") ? $pgdetail .="<a href='#' id='close' class='btn btn-danger' >Close Ticket </a>" : ""; $pgdetail .="</div>
     </div>";
        }
        
        echo $pgdetail;
    }
} 
	
?>