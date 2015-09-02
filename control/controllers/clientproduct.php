<?php
class Clientproduct extends Controller{
    
    function __construct(){
		parent::__construct();
        global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
		
	}
      
    
    public function index($mid=1){
		$productlist ="";
		if(empty($mid)){
			redirect_to($this->uri->link("error/index"));
			exit;
		}
		$this->loadModel("Clientproduct");
		$datum = $this->model->getList("","clientproduct");
		$this->view->myclientsproducts =$datum['clientproduct'];
        $this->view->area               =   Area::find_all();
        global $session;
        $uri = new Url("");
        
        $productlist .="<div class='row'><div class='large-12 columns'>".$datum['mypagin']; $productlist .="</div></div><div class='row'><div class='large-12 columns'><table  width='100%'>
            <thead><tr>
            	<th>S/N</th><th>Product </th><th>Client</th><th>Location</th><th>City </th><th></th><th></th>";
                /**
                 * check for priviledge
                 * for logged in users
                 * at table level
                 */
                
            $productlist .="</tr>
            </thead>
            <tbody>";
            
              if($this->view->myclientsproducts){
            	  $x =1;
                foreach($this->view->myclientsproducts as $products){
                $productlist .="<tr>
                	<td>$x</td><td><a href='".$uri->link("clientproduct/detail/".$products->id)."'>$products->prod_name</a> </td><td>$products->client_name</td><td>$products->install_address</td><td>$products->install_city</td>";
                    
                    foreach($session->employee_role as $erole){
                    //$emodule = Modules::find_by_module($erole->module);
                    $grant      =   array();
                    $grant      = explode(",",$erole->access);
                   
                    if($erole->module == "clientproduct"){
                        if(in_array("Modify",$grant)){
                          
                            $productlist .="<td><a href='".$uri->link("clientproduct/edit/".$products->id."")."'>Edit</a></td>";
                    
                        }else{
                            $productlist .="<td>";$productlist .="</td>";
                        }
                        
                        if(in_array("Delete",$grant)){
                           
                            $productlist .="<td><a class='dataDelete' data-reveal-id='firstModal$products->id' href='#'>Delete</a>
                            
                            
                             <div id='firstModal$products->id' class='reveal-modal small' style='background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px'>
    <h2>Data Delete Console.</h2>
    <hr />
    <p>You are about to delete a record. Any record deleted will not longer be available in the database <br /> Are you sure you want to delete <b>$products->prod_name</b> from the database?</p>
    <p><a href='?url=clientproduct/doCheckTransLog/$products->main_id' data-reveal-id='secondModal$products->id' class='btn button btn-danger' data-reveal-ajax='true'>Yes</a>&nbsp; &nbsp; &nbsp;<a pdid='$products->id' class='btn button btn-danger modalclose'>No</a></p>
    <a class='close-reveal-modal'>&#215;</a>
  </div>

  <div id='secondModal$products->id' class='reveal-modal small' style='background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px'>
    <h2>This is a second modal.</h2>
    <hr />
    <p></p>
    <a class='close-reveal-modal closemodal'>&#215;</a>
  </div>
                            </td>";
                    
                        }else{
                            $productlist .="<td></td>";
                        }  
                    }   
                }
                $productlist .="</tr>";
            	$x++;
                }
              }else{
                $productlist .= "<tr><td colspan='7'>No record to display</td></tr>";
              }
            
            $productlist .= "</tbody>
            </table></div></div><div class='row'><div class='large-12 columns'>"; $productlist .=$datum['mypagin']."</div><p>&nbsp;</p></div>";
            
            $this->view->myprods = $productlist;
            
            /**
             * this aim of doing this check is to
             * ensure that the view is not rendered during
             * when record is being filtered fron the db
             */
                    if(isset($_POST['areaname'])){
                        echo $productlist;
                    }elseif(isset($_POST['rec'])){
                        echo $productlist;
                    }else{
                        $this->view->render("clientproduct/index");
                    }
            		
	}
    
    public function create(){
        @$this->loadModel("Clientproduct");
        $datum = $this->model->getData();
        //$this->view->state = $datum['state'];
        $this->view->area = $datum['area'];
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
        $this->view->area = $datum['area'];
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
        $this->view->worksheet =  $this->model->getWorkSheetId($id);
        $this->view->employee   =   $datum["techemp"];
        $this->view->issues     =   $datum["issues"];
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
            if($this->model->prodID_AutoComplete($_POST['input'])){ // check if object is created succesfully
                $items = $this->model->prodID_AutoComplete($_POST['input']); //creates the item object
                $outpt = "<ul id='mySearch'>";
            foreach($items as $pep){
                $outpt .= "<li>";
                     $outpt .=" <div style='width:25%; float:left; ; z-index:1300' class='divvid' prodid='$pep->prod_id' dress='$pep->prod_name' vprice='' vid='$pep->prod_id'>$pep->prod_id</div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->prod_name."</div></H6> </li><div style='clear:both'></div>";
                }
                $outpt .= "</ul>";
                
                echo $outpt;
            }
        }
        
    }
    
    
    
    /**
     * controler to perform client product
     * auto complete
     */
    public function doCProdAutoComplete(){
        if(isset($_POST['input'])){
            @$this->loadModel("Clientproduct");
            if($this->model->cprodID_AutoComplete($_POST['input'])){ // check if object is created succesfully
                $items = $this->model->cprodID_AutoComplete($_POST['input']); //creates the item object
                $outpt = "<ul id='mySearch'>";
            foreach($items as $pep){
                $outpt .= "<li>";
                     $outpt .=" <div style='width:25%; float:left; ; z-index:1300' class='divvid' prodid='$pep->id' dress='$pep->prod_name' vprice='' vid='$pep->id'>$pep->id</div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->prod_name.", ". $pep->install_city. "</div></H6> </li><div style='clear:both'></div>";
                }
                $outpt .= "</ul>";
                
                echo $outpt;
            }
        }
        
    }


    public function doCreate(){
        @$this->loadModel("Clientproduct");
        if($this->model->create()===1){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
        }elseif($this->model->create() === 2){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
        }elseif($this->model->create() === 3){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
        }elseif($this->model->create() === 4){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Critical! <br />The client you enter does not exist in the database <br /> Create this client before proceeding<a h`ref='#' class='close'>&times;</a></div>";
        }elseif($this->model->create() === 5){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Critical! <br />The product you enter does not exist in the database <br /> Create this product before proceeding<a h`ref='#' class='close'>&times;</a></div>";
        }else{
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
        }   
    }
    
    
    
    public function doUpdate(){
        @$this->loadModel("Clientproduct");
        if($this->model->update()===1){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
        }elseif($this->model->update() === 2){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
        }elseif($this->model->update() === 3){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
        }elseif($this->model->update() === 4){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Critical! <br />The client you enter does not exist in the database <br /> Create this client before proceeding<a h`ref='#' class='close'>&times;</a></div>";
        }elseif($this->model->update() === 5){
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Critical! <br />The product you enter does not exist in the database <br /> Create this product before proceeding<a h`ref='#' class='close'>&times;</a></div>";
        }else{
            redirect_to($this->uri->link("clientproduct/index"));
            //echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
        }
    }
    
    
    public function doScheduleUpdate(){
        @$this->loadModel("Clientproduct");
        if($this->model->updateSchedule()){
            echo "<div data-alert class='alert-box success'>Record Saved </div>";
        }
    }
    
    
    public function doCreateSchedule($id=""){
        @$this->loadModel("Clientproduct");
        if($this->model->createSchedule($id)===1){
            echo "<div data-alert class='alert-box success'>Record Saved </div>";
        }elseif($this->model->createSchedule($id)===2){
            echo "<div data-alert class='alert-box success'>Record not Saved  <br /> Unexpected Error </div>";
        }
    }
    
    
    public function doCreateSchedule_Detail($id=""){//Content-Type: text/html
        @$this->loadModel("Clientproduct");
        if($this->model->createSchedule_Detail($id)===1){
            header('Content-Type: text/html');
            echo "<div data-alert class='alert-box success'>Record Saved </div>";
        }elseif($this->model->createSchedule_Detail($id)===2){
            header('Content-Type: text/html');
            echo "<div data-alert class='alert-box success'>Record not Saved  <br /> Unexpected Error </div>";
        }
    }
    
    
    /**
     * this function is used to populate region
     * on blur event of a state dropdown
     */
    public function getRegion(){
        @$this->loadModel("Clientproduct");
        $lg ="";
        if(isset($_POST['area']) && !empty($_POST['area'])){
            $scra = explode(",",$_POST['area']);
            if($this->model->lga($scra[0])){
                $lgas = $this->model->lga($scra[0]);
                $lg .="<option value=''>--SELECT REGION--</option>";
                foreach($lgas as $lga){
                    $lg .="<option value='".$lga->name."'>$lga->name</option>";
                }
                $lg .="<option value='other'>Other</option>";
            }
        }
        echo $lg;
        
    }
    
    
    public function doCheckTransLog($mainid){
        @$this->loadModel("Clientproduct");
       
       $data       = "<div style='width:150px; margin:25px auto;'>Loading Content...<img src='public/img/loading.gif'   height='20' /></div>";
        $result     =       $this->model->checkTransLog($mainid);
       // print_r($result);
          if($result===2){
                      $data = ("<p><strong class='alert-box alert'>Record cannot be deleted! <br /> History already existing for this record</strong></p><a class='close-reveal-modal closemodal'>&#215;</a>");
                  }elseif($result === 1){
                      $data = ("<p><strong>Record Succesfully Deleted?</strong></p><a class='close-reveal-modal closemodal'>&#215;</a>");
                  }else{
                      $data = "Unexpected Error";
          }
          
          echo $data;
         
    }
    
    
    
    public function doDelete($id){
        global $session;
		@$this->loadModel("Clientproduct");
		if($this->model->delete($id)){
		  
			redirect_to($this->uri->link("clientproduct/index"));
		}
	}
    
}
?>