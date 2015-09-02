<?php
class Vendors extends Controller{
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
		$this->loadModel("Vendors");
		$datum = $this->model->getList("","Vendors");
		$this->view->myvendors =$datum['vendors'];
        $uri = new Url("");
        $vendorlist .="<table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Vendor ID</th><th>Vendor Name </th><th>Email </th><th>Telephone </th><th>Date Modified </th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->myvendors){
	  $x =1;
    foreach($this->view->myvendors as $vendor){
    $vendorlist .="<tr>
    	<td>$x</td><td>$vendor->vend_id</td><td>$vendor->vend_name </td><td>$vendor->vend_email</td><td>$vendor->vend_phone</td><td>$vendor->vend_datemodified</td><td><a href='".$uri->link("vendors/edit/".$vendor->id."")."'>Edit</a></td><td><a href='".$uri->link("vendors/doDelete/".$vendor->id."")."'>Delete</a></td>
    </tr>";
	$x++;
    }
  }else{
    $vendorlist .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$vendorlist .= "</tbody>
</table>";

$this->view->myvends = $vendorlist;
		$this->view->render("vendors/index");
	}
    
  public function create(){
		@$this->loadModel("Vendors");
        $datum = $this->model->getData();
        //$this->view->state = $datum['state'];
        $this->view->country = $datum['country'];
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("vendors/create");
	}
    /**
     * this section is needed to 
     * display item form data from other
     * tables other than the item table
     * for the edit page
     */
  public function edit($id){
		@$this->loadModel("Vendors");
    $this->view->myvendor = $this->model->getById($id)   ;
		$this->view->render("vendors/edit");
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
		@$this->loadModel("Vendors");
		if($this->model->create()===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 3){
			echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 4){
			echo"<div data-alert class='alert-box alert'>Critical! <br />Cannot enter Duplicated vendor ID <a h`ref='#' class='close'>&times;</a></div>";
		}else{
      echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
	}

  public function doUpdate(){
    @$this->loadModel("Vendors");
    if($this->model->update()=== 1){
      echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
    }elseif($this->model->update()=== 2){
          echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
    }else{
      echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";     
    }
  }
    
    public function doDelete($id){
        @$this->loadModel("Vendors");
        $this->model->delete($id);
      redirect_to($this->uri->link("vendors/index"));
    }
    
    

}
?>