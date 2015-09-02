<?php
class Products extends Controller{
	//$registry 	= Registry::singleton();
	function __construct(){
		parent::__construct();
        global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	}
    
	public function index($mid=1){
		$vendorlist ="";
		if(empty($mid)){
			redirect_to($this->uri->link("error/index"));
			exit;
		}
		$this->loadModel("Products");
		$datum = $this->model->getList("","products");
		$this->view->myproducts =$datum['products'];
        $uri = new Url("");
        $vendorlist .="<div class='row'><div class='large-12 columns'>".$datum['mypagin']; $vendorlist .="</div></div><div class='row'><div class='large-12 columns'><table  width='100%'>
<thead><tr>
	<th>S/N</th><th>ProdID</th><th> Name </th><th>Description </th><th>Date Created </th><th>Date Modified </th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->myproducts){
	  $x =1;
    foreach($this->view->myproducts as $region){
    $vendorlist .="<tr>
    	<td>$x</td><td>$region->prod_id</td><td>$region->prod_name </td><td>$region->prod_desc</td><td>$region->prod_created</td><td>$region->Prod_modified</td><td><a href='".$uri->link("products/edit/".$region->prod_id."")."'>Edit</a></td><td><a class='dataDelete' data-reveal-id='firstModal$region->prod_id' href='#'>Delete</a>
        
        
        <div id='firstModal$region->prod_id' class='reveal-modal small' style='background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px'>
    <h2>Data Delete Console.</h2>
    <hr />
    <p>You are about to delete a record. Any record deleted will not longer be available in the database <br /> Are you sure you want to delete <b>$region->prod_name</b> from the database?</p>
    <p><a href='?url=products/doCheckTransLog/$region->main_id' data-reveal-id='secondModal$region->prod_id' class='btn button btn-danger' data-reveal-ajax='true'>Yes</a>&nbsp; &nbsp; &nbsp;<a pdid='$region->prod_id' class='btn button btn-danger modalclose'>No</a></p>
    <a class='close-reveal-modal'>&#215;</a>
  </div>

  <div id='secondModal$region->prod_id' class='reveal-modal small' style='background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px'>
    <h2>This is a second modal.</h2>
    <hr />
    <p></p>
    <a class='close-reveal-modal closemodal'>&#215;</a>
  </div>
        
        
        
        </td>
    </tr>";
	$x++;
    }
  }else{
    $vendorlist .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$vendorlist .= "</tbody>
</table></div></div><div class='row'><div class='large-12 columns'>"; $vendorlist .=$datum['mypagin']."</div><p>&nbsp;</p></div>";

$this->view->myvends = $vendorlist;
		$this->view->render("products/index");
	}
    
  public function create(){
		@$this->loadModel("Products");
        $datum = $this->model->getData();
        //$this->view->state = $datum['state'];
        $this->view->area = $datum['area'];
        
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("products/create");
	}
    /**
     * this section is needed to 
     * display item form data from other
     * tables other than the item table
     * for the edit page
     */
  public function edit($id){
		@$this->loadModel("Products");
    $this->view->myproduct = $this->model->getById($id)   ;
		$this->view->render("products/edit");
	}
    
    
    
    public function validateRegister(){
        if(isset($_POST['fname'])){
            if(empty($_POST['fname'])){
                echo "<span class='label error'>Please Firstname field must be filled</span>";
                
                exit;
            }
           
        }elseif(isset($_POST['lname'])){
            if(empty($_POST['lname'])){
                echo "<span class='label error'>Please surname field must be filled</span>";
               
                exit;
            
            }
        }elseif(isset($_POST['address'])){
            if(empty($_POST['address'])){
                echo "<span class='label error'>Please address field must be filled</span>";
                
                exit;
            }
        }elseif(isset($_POST['email'])){
            if(empty($_POST['email'])){
                echo "<span class='label error'>Please email field must be filled</span>";
                
                exit;
             }else{
                if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                echo "<span class='label error'>Please enter a valid email </span>";
                
                exit;
                }
             }
        }else{
            
            return 2; //meanining that validation is all good
        
        }
        
    }
    

	
	public function doCreate(){
	   global $session;
		@$this->loadModel("Products");
		if($this->model->create()===1){
			//echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
            redirect_to($this->uri->link("products/index"));
		}elseif($this->model->create() === 2){
			//echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 3){
			//echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
            redirect_to($this->uri->link("products/index"));
		}elseif($this->model->create() === 4){
			//echo"<div data-alert class='alert-box alert'>Critical! <br />Cannot enter Duplicated vendor ID <a h`ref='#' class='close'>&times;</a></div>";
            redirect_to($this->uri->link("products/index"));
		}else{
      echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
      $_SESSION['message'] = "<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
      redirect_to($this->uri->link("products/index"));
		}	
	}

  public function doUpdate(){
    global $session;
    @$this->loadModel("Products");
    if($this->model->update()=== 1){
      //echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
      redirect_to($this->uri->link("products/index"));
    }elseif($this->model->update()=== 2){
          //echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
          redirect_to($this->uri->link("products/index"));
    }elseif($this->model->update()=== 3){}
    else{
       echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
      $_SESSION['message'] = "<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
      redirect_to($this->uri->link("products/index"));     
    }
  }
  
  
  /**
   * this section is required 
   * to delete record from database
   * via ajax using foundation
   */
  
  public function doCheckTransLog($mainid){
        @$this->loadModel("Role");
       
       $data       = "<div style='width:150px; margin:25px auto;'>Loading Content...<img src='public/img/loading.gif'   height='20' /></div>";
        $result     =       $this->model->checkTransLog($mainid);
       //print_r($result);
          if($result===2){
                      $data = ("<p><strong class='alert-box alert'>Record cannot be deleted! <br /> History already existing for this record</strong></p><a class='close-reveal-modal closemodal'>&#215;</a>");
                  }elseif($result === 1){
                      $data = "<p><strong>Record Succesfully Deleted?</strong></p><a class='close-reveal-modal closemodal'>&#215;</a>";
                  }else{
                      $data = "Unexpected Error";
          }
          
          echo $data;
         
    }
  
  
  
  
    
    public function doDelete($id){
        @$this->loadModel("Products");
        $this->model->delete($id);
        $_SESSION['message'] = "<div data-alert class='alert-box success'>Record Deleted <a href='#' class='close'>&times;</a></div>";
      redirect_to($this->uri->link("products/index"));
    }
    
    

}
?>