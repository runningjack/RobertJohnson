<?php
class Contact_Model extends Model{
	function __construct(){
		parent::__construct();
	}
	public function getList(){
		$contact = Contacts::find_all();
		return $contact;
	}
	public function getById($id){
		$mycontact = Contacts::find_by_id($id);
		return $mycontact;
	}
	public function sendMail(){
		$mail = new Mail(); 
		$template = new Mailtemplate();
		$template->data['mail_from'] = "GMS Travels";
		$template->data['web_url'] = "http://www.gmstravels.com";
		$template->data['logo'] = "../public/images/logo.png";
		$template->data['company_name'] = "GMS Travels";
		$template->data['text_from']= "GMS Travels";
		$template->data['text_greeting'] ="Dear Madam/Sir";// $_POST['subject'];
		$template->data['text_footer']="Thank you";
		$template->data['message'] = $_POST['message'];
				
				$mail->setTo($_POST['to_email']);
				$mail->setFrom("info@gmstravels.com");
				$mail->setSender("GMS Travels");
				$mail->setSubject(html_entity_decode(sprintf($_POST['subject']), ENT_QUOTES, 'UTF-8'));
				$mail->setHtml($template->gettmp('../views/tmp/emailtmp.tpl'));				
				if($mail->send()){
					return true;
				}else{
					return false;
				}
	}
	
	public function update(){
		global $database;
		if (isset($_POST['Submit']) && (!empty($_POST['email'])) || (!empty($_POST['phone']))){
			
			$thiscontact = Contacts::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['contact_id'])) ;
			$thiscontact->contact_fname					=	$_POST['fname'];
			$thiscontact->contact_lname					=	$_POST['lname'];
			$thiscontact->contact_address				=	$_POST['address'];
			$thiscontact->contact_city					=	$_POST['city'];
			$thiscontact->contact_country				=	$_POST['country'];
			$thiscontact->contact_email					=	$_POST['email'];
			$thiscontact->contact_phone					=	$_POST['phone'];
			$thiscontact->contact_topic					=	$_POST['sub'];
			$thiscontact->contact_comment				=	$_POST['comment'];
			$thiscontact->contact_newsletter			=	$_POST['newsletter'];
			//$thiscontact->contact_ip					=	$_POST['ip'];
			$thiscontact->contact_date_created			=	date("Y-m-d H:i:s");
			//$thiscontact->contact_date_modified			=	date("Y-m-d H:i:s");
			
			  }	
	
			
			if(isset($_POST['contact_id'])){
				if(!empty($_POST['contact_id'])){
					if($database->if_exist("SELECT * FROM contacts WHERE contact_id=".$thiscontact->contact_id)){
						if($thiscontact->update()){
							return true;
						}
					}
				}
			}
		
	}
	public function create(){
		global $database;
		if (isset($_POST['Submit']) && (!empty($_POST['email'])) || (!empty($_POST['phone']))){
			$newcontact = new Contacts();
			$thiscontact->contact_fname					=	$_POST['fname'];
			$thiscontact->contact_lname					=	$_POST['lname'];
			$thiscontact->contact_address				=	$_POST['address'];
			$thiscontact->contact_city					=	$_POST['city'];
			$thiscontact->contact_country				=	$_POST['country'];
			$thiscontact->contact_email					=	$_POST['email'];
			$thiscontact->contact_phone					=	$_POST['phone'];
			$thiscontact->contact_subject				=	$_POST['sub'];
			$thiscontact->contact_comment				=	$_POST['comment'];
			$thiscontact->contact_newsletter			=	$_POST['newsletter'];
			//$thiscontact->contact_ip					=	$_POST['ip'];
			$thiscontact->contact_date_created			=	date("Y-m-d H:i:s");
			//$thiscontact->contact_date_modified			=	date("Y-m-d H:i:s");
		}
			if($newcontact->create()){
				return true;
			}
	}
	
			
	
	public function delete($id){
		$thiscontact = Contacts::find_by_id($id);
		if($thiscontact->delete()){
			$_SESSION['message']="contact ".$thiscontact->contact_name." Removed";
			return true;
		}
	}
}

?>