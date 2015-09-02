<?php
class Supportticket_Model extends Model{
	function __construct(){
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
		global $database;
		$resultEmployee = $database->db_query("SELECT * FROM support_ticket");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$myitems = Ticket::find_by_sql("SELECT * FROM support_ticket ORDER BY datemodified DESC ".$pagin->pgLimit($pn));
		
			$index_array =array( "supportticket"=>$myitems,
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
		$resultEmployee = $database->db_query("SELECT * FROM support_ticket WHERE client_id='".$_SESSION["client_ident"]."'");
		$pagin = new Pagination();//create the pagination object;
		$pagin->nr  = $database->dbNumRows($resultEmployee);
		$pagin->itemsPerPage = 20;
		
		$myitems = Ticket::find_by_sql("SELECT * FROM support_ticket WHERE client_id ='".$_SESSION["client_ident"]."' ORDER BY datemodified DESC ".$pagin->pgLimit($pn)."");
		
			$index_array =array( "supportticket"=>$myitems,
							"mypagin"=>$pagin->render($pg));
							return $index_array;
		
		return $index_array;
	}
	
	
	
	public function getById($id){
		return Ticket::find_by_id($id);
       // $myaccount = Accounts::find_by_phone($phone);
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
        $vendors 		= Vendor::find_all();
		$myproducts		= Cproduct::find_by_client($_SESSION['client_ident']);
		$zone 			= Zone::find_by_sql("SELECT * FROM zone");
		$issues			= Issue::find_all();
		$startups 		= array("departs"=>$depts,"country"=>$country,"zone"=>$zone,"vendors"=>$vendors,"role"=>$role,"myproducts"=>$myproducts,"issues"=>$issues);
		return $startups;		
	}
    
    public function getTicketData($id=""){
        $replies        =  Ticketreply::find_by_ticket($id);
        $ticket         =   Ticket::find_by_id($id);
        $tickdata       =   array("ticket"=>$ticket,"replies"=>$replies);
        return $tickdata;
    }
	
	
	public function create(){
		//if( !empty($_POST["issue"]) ){
		$newticket = new Ticket();
		$error = array();
		
		if(isset($_POST["cname"])){
			if($_POST['cname'] != ""){
				$newticket->contact_name = $_POST['cname'];
			}
			else array_push($error,"Name");
		}else array_push($error,"Name");

        if(isset($_POST["terminal_id"])){
            if($_POST['terminal_id'] != ""){
                $newticket->contact_name = $_POST['terminal_id'];
            }
            else array_push($error,"Name");
        }else array_push($error,"Name");
		
		if(isset($_POST["email"])){
			if($_POST['email'] != "" && preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST["email"])){
				$newticket->contact_email = $_POST['email'];
			}
			else array_push($error,"Email");
		}else array_push($error,"Email");
		
		if(isset($_POST["phone"])){
			if($_POST['phone'] != "" && ctype_digit($_POST['phone'])){
				$newticket->contact_phone = $_POST['phone'];
			}
			else array_push($error,"Phone Number");
		}else array_push($error,"Phone Number");
		
		if(isset($_POST["service"])){
			$cid = explode("_",$_POST["service"]);
			$newticket->prod_id = $cid[0];
            $newticket->prod_name = $cid[1];
			$newticket->location = $cid[2];
		}else array_push($error,"Product");
		
		if(isset($_POST["plevel"])){
			$newticket->priority = $_POST["plevel"];
		}else array_push($error,"Priority");
		
		
		
		if(isset($_POST["issue"])){
			$newticket->issue = htmlspecialchars($_POST['issue']);
		}else array_push($error,"Issue");
		
		$newticket->department = $_POST["dept"];
        $newticket->datecreated = $newticket->datemodified = date("Y-m-d H:i:s");
        $newticket->status = "Open";                   
        $newticket->client_id = $_SESSION["client_ident"];
		
		if(!empty($_FILES['fupload']['name']) && $_FILES['fupload']['error']==0){ //if file upload is set
			move_uploaded_file($_FILES['fupload']['tmp_name'],"public/uploads/".basename($_FILES['fupload']['name']));
			$ext = pathinfo($_FILES['fupload']['name'],PATHINFO_EXTENSION);
			$new_name = uniqid()."_".time().$ext; //new name for the image
			rename("public/uploads/".basename($_FILES['fupload']['name']),"public/uploads/".$new_name);
			$photo = $new_name;
			$newticket->file = $photo;
		}            
		if(empty($error)){
				
			if($newticket->create()){
				
				$ddticket					=		Ticket::find_by_id($newticket->id);				
				$issue							=		array();
				$objIssue						=		Issue::find_all();
				$ddticket->subject				=		"";
				foreach($objIssue as $objI){
					if(isset($_POST[$objI->issue_accronym])){
						$issueLog						=	new Issuelog();
						$issueLog->ticket_id			=	$newticket->id;
						$issueLog->issue_id				=	$objI->id;
						$issueLog->issue_accronym		=	$objI->issue_accronym;
						$issueLog->issue_name			=	$objI->issue_name;
						$issueLog->prod_id				=	$newticket->prod_id;
						$issueLog->datecreated			=	date("Y-m-d H:i:s");
						$ddticket->subject				.=	$_POST[$objI->issue_accronym]. ", ";
						$issueLog->create();
					}
					
				}
				$ddticket->issue			=	$ddticket->subject."\r\n". $_POST['issue'];	
				$ddticket->update();//					=		Ticket::find_by_id($newticket->id);
				$newReply = new Ticketreply();
				$newReply->sender_id        =       $newticket->client_id;
				$newReply->ticket_id        =       $newticket->id;
				$theCustomer                =       Client::find_by_id($_SESSION["client_ident"]);
				$newReply->sender_name      =       $theCustomer->name;
				$newReply->sender_type      =       "Client";
				$newReply->message          =       $newticket->issue;
				$newReply->datecreated      =       date("Y-m-d H:i:s");
				$newReply->create();
				if(!empty($_POST['ccemail'])){
					$emails = explode(",", $_POST['ccemail']);
					$emaillenght = count($emails) ;
					for($j=0; $j<$emaillenght; $j++){
						if(preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", trim($emails[$j]))){
							$ccemail = new Ccemail();
							$ccemail->email = trim($emails[$j]);
							$ccemail->ticket_id = $newticket->id;
							$ccemail->create();
						}
					}
				}
				$this->sendMail($newReply->id);
				return 1;     //returns 1 on success  
				
			}
			else{
				return 2;       // returns 2 on insert error
			}
		}else{
			$message = "Please check the following errors: ";
			$lenght = count($error);
			for($i = 0; $i < $lenght; $i++){
				$message = $message.$error[$i].", ";
			}
            echo "<div data-alert class='alert-box error'><a href='#' class='close'>&times;</a>$message</div>";
            exit;
		}
	}

    public function createClientReply($id=""){
        if(!empty($_POST["issue"]) && !empty($_POST["cname"])){
            $newReply = new Ticketreply();
            $newReply->sender_id        =       $_SESSION["client_ident"];
            $newReply->ticket_id        =       $id;
            $theCustomer                =       Client::find_by_id($_SESSION["client_ident"]);
            $newReply->sender_name      =       $theCustomer->name;
            $newReply->sender_type      =       "Client";
            $newReply->message          =       $_POST['issue'];
            $newReply->datecreated      =       date("Y-m-d H:i:s");
            if($newReply->create()){
                $partTicket = Ticket::find_by_id($id);
                $partTicket->status ="Customer Reply";
                $partTicket->datemodified = date("Y-m-d H:i:s");
                $partTicket->update();
				$this->sendMail($newReply->id);
                return 1;
            }else{
                return 2;
            }
        }else{
            return 3;
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
            
            if($partTicket->update()){
				$this->sendMailCloseTicket($partTicket->id);
                return true;
            }else{
                return false;
            }
        }
     }
	 
	 public function search(){
		 $myitems = Ticket::search($_POST['subject'], $_POST['id'], $_POST['prod_name'], $_POST['priority'], $_POST['dept'], $_POST['status'], $_SESSION['client_ident']);
		
			$index_array =array( "Supportticket"=>$myitems,
							"mypagin"=>"");
							return $index_array;
		
		return $index_array;
	 }
	 
	 public function sendMail($id){
		 $reply = Ticketreply::find_by_id($id);
		 $ticket = Ticket::find_by_id($reply->ticket_id);
		 $ccemails = Ccemail::find_by_ticket($reply->ticket_id);
		 $client = Client::find_by_id($_SESSION['client_ident']);
		 

		$to = 'support@robertjohnsonholdings.com';

		$subject = 'RE: Ticket Number: #'.str_pad($ticket->id,8,"0",STR_PAD_LEFT)." ".$ticket->subject;
		
		$headers = "From: ".$client->name."<" . $client->email . ">\r\n";
		$headers .= "Reply-To: ". $ticket->contact_email . "\r\n";
		if($ccemails){
			 $copyaddy = array();
			 $cc = "";
			foreach($ccemails as $ccemail){
				array_push($copyaddy, $ccemail->email);
			}
			for($i = 0; $i < count($copyaddy); $i++){
				if($i == (count($copyaddy)-1)){
					$cc .= $copyaddy[$i];	
				}else $cc .= $copyaddy[$i].", ";
			}
			$to .= ", ".$cc;
		 }
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$message = '
			<html><body>
			<h1>Robert Johnson Holdings Limited</h1>
			<img src="http://www.robertjohnsonholdings.com/public/images/logo.png" alt="Robert Johnson Logo"/>
			<h2>Ticket Number #'.str_pad($ticket->id,8,"0",STR_PAD_LEFT).'</h2>
				<table width="100%" border="0">
				  <tr>
					<th scope="row" width="30%">Client</th>
					<td width="70%">'.$reply->sender_name.'</td>
				  </tr>
				  <tr>
					<th scope="row">Contact Person</th>
					<td>'.$ticket->contact_name.'</td>
				  </tr>
				  <tr>
					<th scope="row">Contact Phone Number</th>
					<td>'.$ticket->contact_phone.'</td>
				  </tr>
				  <tr>
					<th scope="row">Contact Email</th>
					<td>'.$ticket->contact_email.'</td>
				  </tr>';
				if($ccemails){
					$message .= '<tr>
							<th scope="row">Copied Emails</th>
							<td>'.$cc.'</td>
						  </tr>
						  <tr>';
				}
		$message .=	'<th scope="row">Department</th>
					<td>'.$ticket->department.'</td>
				  </tr>
				  <tr>
					<th scope="row">Ticket Status</th>
					<td>'.$ticket->status.'</td>
				  </tr>
				  <tr>
					<th scope="row">Priority Level</th>
					<td>'.$ticket->priority.'</td>
				  </tr>
				  <tr>
					<th scope="row">Related Product/Service</th>
					<td>'.$ticket->prod_name.' at '.$ticket->location.'</td>
				  </tr>
				  <tr>
					<th scope="row">Subject</th>
					<td>'.$ticket->subject.'</td>
				  </tr>
				  <tr>
					<th scope="row">Issue/Complaint/Suggestion</th>
					<td>'.$reply->message.'</td>
				  </tr>
				</table>
			</body></html>';
		 if(mail($to, $subject, $message, $headers)){
			return true; 
		 }else return false;
	 }
	 
	 public function sendMailCloseTicket($id){
		 $ticket = Ticket::find_by_id($id);
		 $ccemails = Ccemail::find_by_ticket($id);
		 $client = Client::find_by_id($_SESSION['client_ident']);

		$to = 'support@robertjohnsonholdings.com';

		$subject = 'RE: Ticket Number: #'.str_pad($ticket->id,8,"0",STR_PAD_LEFT)." ".$ticket->subject;
		
		$headers = "From: ".$client->name."<" . $client->email . ">\r\n";
		$headers .= "Reply-To: ". $ticket->contact_email . "\r\n";
		if($ccemails){
			 $copyaddy = array();
			 $cc = "";
			foreach($ccemails as $ccemail){
				array_push($copyaddy, $ccemail->email);
			}
			for($i = 0; $i < count($copyaddy); $i++){
				if($i == (count($copyaddy)-1)){
					$cc .= $copyaddy[$i];	
				}else $cc .= $copyaddy[$i].", ";
			}
			$to .= ", ".$cc;
		 }
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		

		$message = '
			<html><body>
			<h1>Robert Johnson Holdings Limited</h1>
			<img src="http://www.robertjohnsonholdings.com/public/images/logo.png" alt="Robert Johnson Logo"/>
			<h2>Ticket Number #'.str_pad($ticket->id,8,"0",STR_PAD_LEFT).'</h2>
				<table width="100%" border="0">
				  <tr>
					<th scope="row" width="30%">Client</th>
					<td width="70%">'.$client->name.'</td>
				  </tr>
				  <tr>
					<th scope="row">Contact Person</th>
					<td>'.$ticket->contact_name.'</td>
				  </tr>
				  <tr>
					<th scope="row">Contact Phone Number</th>
					<td>'.$ticket->contact_phone.'</td>
				  </tr>
				  <tr>
					<th scope="row">Contact Email</th>
					<td>'.$ticket->contact_email.'</td>
				  </tr>';
				if($ccemails){
					$message .= '<tr>
							<th scope="row">Copied Emails</th>
							<td>'.$cc.'</td>
						  </tr>
						  <tr>';
				}
		$message .=	'<th scope="row">Department</th>
					<td>'.$ticket->department.'</td>
				  </tr>
				  <tr>
					<th scope="row">Ticket Status</th>
					<td>'.$ticket->status.'</td>
				  </tr>
				  <tr>
					<th scope="row">Priority Level</th>
					<td>'.$ticket->priority.'</td>
				  </tr>
				  <tr>
					<th scope="row">Related Product/Service</th>
					<td>'.$ticket->prod_name.' at '.$ticket->location.'</td>
				  </tr>
				  <tr>
					<th scope="row">Subject</th>
					<td>'.$ticket->subject.'</td>
				  </tr>
				  <tr>
					<th scope="row">Issue/Complaint/Suggestion</th>
					<td>Ticket has been closed.</td>
				  </tr>
				</table>
			</body></html>';
		 if(mail($to, $subject, $message, $headers)){
			return true; 
		 }else return false;
	 }
 
}
?>