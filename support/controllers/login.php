<?php
class Login extends Controller{
	function __construct(){
		$this->view 	= new View();
		$this->uri 		= new Url("");
        $this->view->msg="";
		//parent::__construct();
		//$this->index();
	}
	public function index(){
		//echo $_SESSION['cuscare_id'];
		@$this->loadModel("Login");
		$this->view->render("login/index", true);
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
           }elseif(!User::find_by_email($_POST['memail'])){
                echo "<div data-alert class='alert-box alert'>Email not found in our database<a href='#' class='close'>&times;</a></div></div>";
               return "<div data-alert class='alert-box alert'>Email not found in our database<a href='#' class='close'>&times;</a></div></div>";
               exit;
           }else{
                if($this->doRecorvery($_POST['memail'])){
                    $pruser = User::find_by_email($_POST['memail']);
                    if($this->sendMail($pruser->fname,$pruser->lname,"",$pruser->password,$pruser->username,$pruser->email)){
                        echo "<div data-alert class='alert-box'>You login details has been sent to your email box. please get the detail and retry<a href='#' class='close'>&times;</a></div></div>";
               return "<div data-alert class='alert-box'>You login details has been sent to your email box. please get the detail and retry<a href='#' class='close'>&times;</a></div></div>";
               exit;
                    }
                }
           }
       }
    }
    
    public function doRecorvery($email){
        @$this->loadModel("Login");
        if($this->model->passRecovery($email)){
            return true;
        }
    }
    
	public function doLogin(){
	   @$this->loadModel("Login");
		$username = $_POST["username"];
		$password = $_POST["password"];
		if($this->model->runClient($username,$password)){
		      //redirect_to($this->uri->link("dashboard/index"));
              //exit;
              echo 1;
		}else{
		      echo 2;
		}
		  
		
	}
    
    public function doClientLogin(){
		global $session;
        @$this->loadModel("Login");
		$username = $_POST["username"];
		$password = $_POST["password"];
		if($this->model->runClient($username,$password)){
		
		echo 1;
		}else{
		      echo 2;
		}
    }
    
    public function sendMail($fname,$lname,$mname,$pass,$uname,$email){
		$mail                                     = new Mail(); 
		$template                                 = new Mailtemplate();
		$template->data['mail_from']              = "Robert Johnson Holdings Nig. Ltd.";
		$template->data['web_url']                = "http://http://robertjohnsonholdings.com";
		$template->data['logo']                   = "http://http://robertjohnsonholdings.com/public/img/logo.png";
		$template->data['company_name']           = "Robert Johnson Holdings Nig. Ltd.";
		$template->data['text_from']              = "Robert Johnson Holdings Nig. Ltd.";
		$template->data['text_greeting']          ="Dear $fname $mname ". strtoupper($lname) ;// $_POST['subject'];
		$template->data['text_footer']            ="Thank you";
        $template->data['text_message']           = "<b>Your login details</b>";
		$template->data['message']                ="<p>Robert Johnson Holdings password recovery console. Here is your login details are as follows</p>
                        <ul style='list-style:none; list-style-image:none;'>
                            <li><b>Username: </b>".$uname."</li>
                            <li><b>Password: </b>".$pass."</li>
                        </ul>
                        <p>Please keep these as they will be required when you want to access your account portal on the Collo Network website</p>";
				
				$mail->setTo($email);
				$mail->setFrom("support@robertjohnsonholdings.com");
				$mail->setSender("Robert Johnson Holdings Nig. Ltd.");
				$mail->setSubject("Robert Johnson Holdings password recovery");
				$mail->setHtml($template->gettmp('http://robertjohnsonholdings.com/emailtmp/email1.php'));				
				if($mail->send()){
					return true;
				}else{
					return false;
				}
	}
	
}
?>