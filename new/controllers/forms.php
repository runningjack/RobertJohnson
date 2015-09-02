<?php
	class forms extends Controller{
		function __construct(){
		parent::__construct();
		}
				
		function cv(){
			$result = $this->model->createCV();
			SESSION::init();
			if($result == 1){
				$_SESSION['message'] ="Your CV has been submitted successfully. A member of Vepsrecruit will get in touch with you shortly";
				redirect_to($this->uri->link("careers"));	
			}
			elseif($result == 2){
				$_SESSION['message'] ="Your upload was not successful, please try again.";
				redirect_to($this->uri->link("careers"));
			}
			elseif($result!= 1 && $result!=2 && $result != ""){
				$_SESSION['message'] ="Check the following errors: ".$result;
				redirect_to($this->uri->link("careers"));
			}
			else{
				$_SESSION['message'] ="An error occurred, please try again.";
				redirect_to($this->uri->link("careers"));
			}
		}
		
		function contact(){
			$result = $this->model->addContact();
			SESSION::init();
			if($result == 1){
				$_SESSION['message'] ="Your Comment/Suggestion has been submitted successfully. We will get back to you shortly";
				redirect_to($this->uri->link("contact_us"));	
			}
			elseif($result == 2){
				$_SESSION['message'] ="Your Comment/Suggestion was not successful, please try again.";
				redirect_to($this->uri->link("contact_us"));
			}
			elseif($result!= 1 && $result!=2 && $result != ""){
				$_SESSION['message'] ="Check the following errors: ".$result;
				redirect_to($this->uri->link("contact_us"));
			}
			else{
				$_SESSION['message'] ="An error occurred, please try again.";
				redirect_to($this->uri->link("contact_us"));
			}
		}
		
		function getCategoryWeb(){
			$category = $this->model->getCategoryWeb();
			echo html_entity_decode($category->cat_web_content);	
		}
		
		function getProductWeb(){
			$product = $this->model->getProductWeb();
			echo html_entity_decode($product->prod_web_content);
		}
			
		
	}
?>