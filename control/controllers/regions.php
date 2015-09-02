<?php
class Regions extends Controller{
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
		$this->loadModel("Regions");
		$datum = $this->model->getList("","regions");
		$this->view->myregions =$datum['regions'];
        $uri = new Url("");
        $vendorlist .="<table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Area ID</th><th> Name </th><th>Description </th><th>Date Created </th><th>Date Modified </th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->myregions){
	  $x =1;
    foreach($this->view->myregions as $region){
    $vendorlist .="<tr>
    	<td>$x</td><td>$region->id</td><td>$region->name </td><td>$region->description</td><td>$region->datecreated</td><td>$region->datemodified</td><td><a href='".$uri->link("regions/edit/".$region->id."")."'>Edit</a></td><td><a href='".$uri->link("regions/doDelete/".$region->id."")."'>Delete</a></td>
    </tr>";
	$x++;
    }
  }else{
    $vendorlist .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$vendorlist .= "</tbody>
</table>";

$this->view->myvends = $vendorlist;
		$this->view->render("regions/index");
	}
    
  public function create(){
		@$this->loadModel("Regions");
        $datum = $this->model->getData();
        //$this->view->state = $datum['state'];
        $this->view->country = $datum['country'];
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("regions/create");
	}
    /**
     * this section is needed to 
     * display item form data from other
     * tables other than the item table
     * for the edit page
     */
  public function edit($id){
		@$this->loadModel("Regions");
    $this->view->myvendor = $this->model->getById($id)   ;
		$this->view->render("regions/edit");
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
		@$this->loadModel("Regions");
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
    @$this->loadModel("Regions");
    if($this->model->update()=== 1){
      echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
    }elseif($this->model->update()=== 2){
          echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
    }else{
      echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";     
    }
  }
    
    public function doDelete($id){
        @$this->loadModel("Regions");
        $this->model->delete($id);
      redirect_to($this->uri->link("subregion/index"));
    }
    
    

}
?>