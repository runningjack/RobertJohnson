<?php
class Stockitems extends Controller{
	//$registry 	= Registry::singleton();
	function __construct(){
		parent::__construct();
		$GLOBALS["msg"] ="" ;
        global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	}
	public function index($mid=1){
		$itemlist ="";
		if(empty($mid)){
			redirect_to($this->uri->link("error/index"));
			exit;
		}
		$this->loadModel("Stockitems");
		$datum = $this->model->getList("","Stockitems");
		$this->view->myitems =$datum['items'];
        $uri = new Url("");
        $itemlist .="<table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Item ID</th><th>Item Name </th><th>Description </th><th>Qty In Stock </th><th>Date Modified </th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->myitems){
	  $x =1;
    foreach($this->view->myitems as $item){
    $itemlist .="<tr>
    	<td>$x</td><td>$item->item_id</td><td>$item->item_name </td><td>$item->item_description</td><td>$item->item_quantity</td><td>$item->item_datemodified</td><td><a href='".$uri->link("stockitems/edit/".$item->id."")."'>Edit</a></td><td><a href='".$uri->link("stockitems/doDelete/".$item->id."")."'>Delete</a></td>
    </tr>";
	$x++;
    }
  }else{
    $itemlist .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$itemlist .= "</tbody>
</table>";

$this->view->myitems = $itemlist;
		$this->view->render("stockitems/index");
	}
    
  public function create(){
		@$this->loadModel("Stockitems");
        $datum = $this->model->getData();
        $this->view->state = $datum['state'];
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("stockitems/create");
	}
    /**
     * this section is needed to 
     * display item form data from other
     * tables other than the item table
     * for the edit page
     */
  public function edit($id){
		@$this->loadModel("Stockitems");
    $this->view->myitem = $this->model->getById($id)   ;
		$this->view->render("stockitems/edit");
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
		@$this->loadModel("Stockitems");
		if($this->model->create()===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 3){
			echo"<div data-alert class='alert-box alert'>Please fill in the required fileds <a h`ref='#' class='close'>&times;</a></div>";
		}else{
      echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}	
	}

  public function doUpdate(){
    @$this->loadModel("Stockitems");
    if($this->model->update()=== 1){
      echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
    }elseif($this->model->update()=== 2){
          echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
    }else{
      echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";     
    }
  }
    
    public function doDelete($id){
      redirect_to($this->uri->link("stockitems/index"));
    }
    
    

}
?>