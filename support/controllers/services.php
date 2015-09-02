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
		".$datum['mypagin']."
		<table class='table'>
<thead><tr>
	<th>S/N</th><th>Product</th><th>Location</th><th>City/State</th><th>Date Installed </th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->myservices){
	  $x =1;
    foreach($this->view->myservices as $service){
    $servicelist .="<tr>
    	<td>$x</td><td>$service->prod_name </td><td>$service->install_address</td><td>$service->install_city</td><td>$service->sign_off_date</td><td><a href='".$uri->link("supportticket/create/".$service->id."")."'>Create Ticket</a></td>
    </tr>";
	$x++;
    }
  }else{
    $servicelist .= "<tr><td colspan='6'>No record to display</td></tr>";
  }

$servicelist .= "</tbody>
</table>
".$datum['mypagin']."";

$this->view->myservs = $servicelist;
		$this->view->render("services/index");
	}
	
	public function search(){
		$this->loadModel("Services");
		$datum = $this->model->search();
		$this->view->myservices =$datum['myservices'];
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
    	<td>$x</td><td>$service->prod_name </td><td>$service->install_address</td><td>$service->install_city</td><td>$service->sign_off_date</td><td><a href='".$uri->link("supportticket/create/".$service->id."")."'>Create Ticket</a></td>
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