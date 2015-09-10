<?php
	class Services extends Controller{
	   public function __construct(){
	       parent::__construct();
		   global $session;
		//check if user is logged in;		
		if(!$session->client_logged_in()){
			 redirect_to($this->uri->link("login/index"));
		}
       }


       
      public function index($mid=1){
		$servicelist ="";
		if(empty($mid)){
			redirect_to($this->uri->link("error/index"));
			exit;
		}
		@$this->loadModel("Services");
		$datum = $this->model->getList("","services");
		$this->view->myservices =$datum['myservices'];
        $uri = new Url("");
        $servicelist .="
		<table class='table table-striped table-bordered' width='100%' id='datatable_fixed_column'>
<thead><tr>
	<th>S/N</th><th>Terminal ID </th><th>Product</th><th>Location</th><th>City/State</th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->myservices){
	  $x =1;
    foreach($this->view->myservices as $service){
    $servicelist .="<tr>
    	<td>$x</td><td>$service->terminal_id</td><td>$service->prod_name </td><td>$service->install_address</td><td>$service->install_city</td><td><a href='".$uri->link("supportticket/create/".$service->id."")."'>Create Ticket</a></td>
    </tr>";
	$x++;
    }
  }else{
    $servicelist .= "<tr><td colspan='6'>No record to display</td></tr>";
  }

$servicelist .= "</tbody>
</table>";

$this->view->myservs = $servicelist;
		$this->view->render("services/index");
	}


        public  function activate(){
            $this->loadModel("Services");
            $this->view->message ="";
            $datum = $this->model->getData();
            $this->view->products = $datum['products'];
            $this->view->render("services/activate");
        }

        public  function doActivate(){
            global $session;
            $this->loadModel("Services");
            $result = $this->model->activate();
            if($result ==1){
                $_SESSION['message'] = "<div data-alert class='alert-box error'><a href='#' class='close'>&times;</a>Activation Request Sent</div>";
            }elseif($result ==2){
                $_SESSION['message'] ="<div data-alert class='alert-box error'><a href='#' class='close'>&times;</a>Unexpected Error</div>";
            }else{
                $_SESSION['message'] ="<div data-alert class='alert-box error'><a href='#' class='close'>&times;</a>Record Not created ensure that all mandatory fields are filled</div>";
            }
            //$this->view->render("services/activate");
            redirect_to($this->uri->link("services/activate"));
        }


	public function search(){
		$this->loadModel("Services");
		$datum = $this->model->search();
		$this->view->myservices =$datum['myservices'];
        $servicelist="";
        $uri = new Url("");
        $servicelist .="<table class='table'>
<thead><tr>
	<th>S/N</th><th>Product</th><th>Location</th><th>City/State</th><th>Date Installed </th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->myservices){
	  $x =1;
    foreach($this->view->myservices as $service){
    $servicelist .="<tr>
    	<td>$x</td><td>$service->prod_name </td><td>$service->install_address</td><td>$service->install_city ."/".$service->install_state</td><td>$service->sign_off_date</td><td><a href='".$uri->link("supportticket/create/".$service->id."")."'>Create Ticket</a></td>
    </tr>";
	$x++;
    }
  }else{
    $servicelist .= "<tr><td colspan='6'>No Result Found</td></tr>";
  }

$servicelist .= "</tbody>
</table>";

$this->view->myservs = $servicelist;
		$this->view->render("services/index");
	}
}
?>