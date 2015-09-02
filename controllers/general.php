<?php
class General extends Controller{
    function __construct(){
		parent::__construct();
        global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	}
    
    /**
     * this function is used to populate local Govt
     * on blur event of a state dropdown
     */
    public function getLgas(){
        @$this->loadModel("General");
        $lg ="";
        if(isset($_POST['soo']) && !empty($_POST['soo'])){
            $scra = explode(",",$_POST['soo']);
            if($this->model->lga($scra[0])){
                $lgas = $this->model->lga($scra[0]);
                $lg .="<option value=''>--SELECT LGA--</option>";
                foreach($lgas as $lga){
                    $lg .="<option value='{$lga->LGA}'>$lga->LGA</option>";
                }
                $lg .="<option value='other'>Other</option>";
            }
        }
        echo $lg;
        
    }
    
    
    /**
     * State of
     */
    public function getSate(){
        @$this->loadModel("General");
        $lg ="";
        echo $_POST["country"];
        if(isset($_POST['country']) && !empty($_POST['country'])){
            $scra = explode(",",$_POST['country']);
            if($this->model->state($scra[0])){
                $lgas = $this->model->state($scra[0]);
                $lg .="<option value=''>--SELECT STATE--</option>";
                foreach($lgas as $lga){
                    $lg .="<option value='{$lga->name}'>$lga->name</option>";
                }
                $lg .="<option value='other'>Other</option>";
            }
        }
        echo $lg;
        
    }
    
     
     
   
}
?>