<?php
class Clientproduct extends Controller{
    
    function __construct(){
		parent::__construct();
		global $session;
		//check if user is logged in;		
		if(!$session->client_logged_in()){
			 redirect_to($this->uri->link("login/index"));
		}
	}
    
    
    public function index($mid=1){
		$productlist ="";
		if(empty($mid)){
			redirect_to($this->uri->link("error/index"));
			exit;
		}
		$this->loadModel("Clientproduct");
		$datum = $this->model->getList("","Clientproduct");
		$this->view->myclientsproducts =$datum['clientproduct'];
        $uri = new Url("");
        $productlist .="<table  width='100%'>
            <thead><tr>
            	<th>S/N</th><th>Product </th><th>Client</th><th>Location</th><th>City </th><th></th><th></th>
            </tr>
            </thead>
            <tbody>";
            
              if($this->view->myclientsproducts){
            	  $x =1;
                foreach($this->view->myclientsproducts as $products){
                $productlist .="<tr>
                	<td>$x</td><td><a href='".$uri->link("clientproduct/detail/".$products->id)."'>$products->prod_name</a> </td><td>$products->client_name</td><td>$products->install_address</td><td>$products->install_city</td><td><a href='".$uri->link("clientproduct/edit/".$products->id."")."'>Edit</a></td><td><a href='".$uri->link("clientproduct/doDelete/".$products->id."")."'>Delete</a></td>
                </tr>";
            	$x++;
                }
              }else{
                $productlist .= "<tr><td colspan='7'>No record to display</td></tr>";
              }
            
            $productlist .= "</tbody>
            </table>";
            
            $this->view->myprods = $productlist;
            		$this->view->render("clientproduct/index");
	}
    
    public function create(){
        @$this->loadModel("Clientproduct");
        $datum = $this->model->getData();
        //$this->view->state = $datum['state'];
        $this->view->country = $datum['country'];
        //$this->view->mymenu = $this->model->getById($id);
        $this->view->render("clientproduct/create");
    }
    /**
     * this section is needed to 
     * display item form data from other
     * tables other than the item table
     * for the edit page
     */
    public function edit($id){
        @$this->loadModel("Clientproduct");
        $datum = $this->model->getData();
        $viewBag = array();
        $this->view->country = $datum['country'];
        //$viewBag = array("Country"=>$datum['country'],"myproduct"=>$this->model->getById($id));
        $this->view->myproduct =  $this->model->getById($id);
        
        $this->view->render("clientproduct/edit");
    }
    /**
     * Get details of a product for
     * the detail page
     */
    public function detail($id){
        @$this->loadModel("Clientproduct");
        $datum = $this->model->getData();
        $this->view->myproduct =  $this->model->getById($id);
        $this->view->render("clientproduct/detail");
    }


    public function doClientAutoComplete(){
        if(isset($_POST['input'])){
            @$this->loadModel("Clientproduct");
            if($this->model->clientID_AutoComplete($_POST['input'])){ // check if object is created succesfully
                $vendors = $this->model->clientID_AutoComplete($_POST['input']); //creates the vendor object
                $outpt = "<ul id='mySearch'>";
            foreach($vendors as $pep){
                $outpt .= "<li>";
                     $outpt .=" <div style='width:25%; float:left; ; z-index:1300' class='divvid' dress='' vid='$pep->id'> $pep->id </div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->name."</div></H6> </li><div style='clear:both'></div>";
                }
                $outpt .= "</ul>";
                
                echo $outpt;
            }
        }
        
    }

    /**
     * controler to perform product
     * auto complete
     */
     public function doProdAutoComplete(){
        if(isset($_POST['input'])){
            @$this->loadModel("Clientproduct");
            if($this->model->cProdID_AutoComplete($_POST['input'])){ // check if object is created succesfully
                $items = $this->model->cProdID_AutoComplete($_POST['input']); //creates the item object
                $outpt = "<ul id='mySearch'>";
            foreach($items as $pep){
                $outpt .= "<li>";
                     $outpt .=" <div style='width:25%; float:left; ; z-index:1300' class='divvid' prodid='$pep->id _ $pep->prod_name _ $pep->install_address' dress='$pep->prod_name; $pep->install_address ' vprice='' vid='$pep->prod_id'>$pep->install_city</div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->prod_name."; $pep->install_address</div></H6> </li><div style='clear:both'></div>";
                }
                $outpt .= "</ul>";
                
                echo $outpt;
            }
        }
        
    }


    public function doCreate(){
        @$this->loadModel("Clientproduct");
        if($this->model->create()===1){
            echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
        }elseif($this->model->create() === 2){
            echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
        }elseif($this->model->create() === 3){
            echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
        }elseif($this->model->create() === 4){
            echo"<div data-alert class='alert-box alert'>Critical! <br />The client you enter does not exist in the database <br /> Create this client before proceeding<a h`ref='#' class='close'>&times;</a></div>";
        }elseif($this->model->create() === 5){
            echo"<div data-alert class='alert-box alert'>Critical! <br />The product you enter does not exist in the database <br /> Create this product before proceeding<a h`ref='#' class='close'>&times;</a></div>";
        }else{
            echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
        }   
    }
    
    public function doUpdate(){
        @$this->loadModel("Clientproduct");
        if($this->model->update()===1){
            echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
        }elseif($this->model->update() === 2){
            echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
        }elseif($this->model->update() === 3){
            echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
        }elseif($this->model->update() === 4){
            echo"<div data-alert class='alert-box alert'>Critical! <br />The client you enter does not exist in the database <br /> Create this client before proceeding<a h`ref='#' class='close'>&times;</a></div>";
        }elseif($this->model->update() === 5){
            echo"<div data-alert class='alert-box alert'>Critical! <br />The product you enter does not exist in the database <br /> Create this product before proceeding<a h`ref='#' class='close'>&times;</a></div>";
        }else{
            echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
        }
    }
    
    
    public function doScheduleUpdate(){
        @$this->loadModel("Clientproduct");
        if($this->model->updateSchedule()){
            echo "<div data-alert class='alert-box success'>Record Saved </div>";
        }
    }
    
    

    
}
?>