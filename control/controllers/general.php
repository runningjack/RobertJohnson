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
    
    
    /**
     * jquery on blur checker for 
     * autocomplete inputs method 
     * for product
     */
    public function doGetProductByName($prodname){
        @$this->loadModel("General");
        if($this->model->getProductByName($prodname)!= 0){
            $productid    = $this->model->getProductByName($prodname);
            
            echo $productid->prod_id; //returns id for clientif hidden element
            
        }else{
            echo "Data not found";
        }
    }
    
    
    
    /**
     * jquery on blur checker for 
     * autocomplete inputs method 
     * for product
     */
    public function doGetCProductByName($prodname){
        @$this->loadModel("General");
        if($this->model->getCProductByID($prodname)!= 0){
            $productid    = $this->model->getCProductByID($prodname);
            
            echo $productid->id; //returns id for clientif hidden element
            
        }else{
            echo "Data not found";
        }
    }
    
    
    /**
     * jquery on blur checker for 
     * autocomplete inputs method
     * for client
     */
    public function doGetClientByName($clientname){
        @$this->loadModel("General");
        if($this->model->getClientByName($clientname)!= 0){
            $client    = $this->model->getClientByName($clientname);
            
            echo $client->id; //returns id for clientid hidden element jquery autoco
            
        }else{
            echo "Data not found";
        }
    }
    
    
    public function doGetItemByName($itemname){
        @$this->loadModel("General");
        if($this->model->getItemsByName($itemname)!= 0){
            $item    = $this->model->getItemsByName($itemname);
            
            echo $item->id; //returns id for clientid hidden element jquery autoco
            
        }else{
            echo "Data not found";
        }
    }
    
    public function doCheckClient($id){
        @$this->loadModel("General");
        if($this->model->getClientByID($id)!= 0){
            echo $this->model->getClientByID($id);
        }else{
            echo 0;
        }
    }
    
    public function doCheckTransLog($mainid){
        @$this->loadModel("General");
        if($this->model->checkTransLog($mainid)===1){
            echo("<p> <br /> History already existing for this record</p><a class='close-reveal-modal'>&#215;</a>");
        }else{
            echo("<p>Click to delete</p><a class='close-reveal-modal'>&#215;</a>");
        }
    }
    
     
     
   
}
?>