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
		$datum = $this->model->getList("","stockitems");
		$this->view->myitems =$datum['items'];
        $uri = new Url("");
        $itemlist .="<div class='row'><div class='large-12 columns'>".$datum['mypagin']; $itemlist .="</div></div><div class='row'><div class='large-12 columns'><table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Item ID</th><th>Item Name </th><th>Description </th><th>Qty In Stock </th><th>Date Modified </th><th></th><th></th>
</tr>
</thead>
<tbody>";

  if($this->view->myitems){
	  $x =1;
    foreach($this->view->myitems as $item){
    $itemlist .="<tr>
    	<td>$x</td><td>$item->item_id</td><td>$item->item_name </td><td>$item->item_description</td><td>$item->item_quantity</td><td>$item->item_datemodified</td><td><a href='".$uri->link("stockitems/edit/".$item->id."")."'>Edit</a></td><td><a class='dataDelete' data-reveal-id='firstModal$item->id' href='#'>Delete</a>
        
        
        
        <div id='firstModal$item->id' class='reveal-modal small' style='background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px'>
    <h2>Data Delete Console.</h2>
    <hr />
    <p>You are about to delete a record. Any record deleted will not longer be available in the database <br /> Are you sure you want to delete <b>$item->item_name</b> from the database?</p>
    <p><a href='?url=stockitems/doCheckTransLog/$item->item_id' data-reveal-id='secondModal$item->id' class='btn button btn-danger' data-reveal-ajax='true'>Yes</a>&nbsp; &nbsp; &nbsp;<a pdid='$item->id' class='btn button btn-danger modalclose'>No</a></p>
    <a class='close-reveal-modal'>&#215;</a>
  </div>

  <div id='secondModal$item->id' class='reveal-modal small' style='background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px'>
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
    $itemlist .= "<tr><td colspan='7'>No record to display</td></tr>";
  }

$itemlist .= "</tbody>
</table></div></div><div class='row'><div class='large-12 columns'>"; $itemlist .=$datum['mypagin']."</div><p>&nbsp;</p></div>";

$this->view->myitems = $itemlist;


    if(isset($_POST['itemname'])){
        echo $itemlist;
    }elseif(isset($_POST['rec'])){
        echo $itemlist;
    }else{
        $this->view->render("stockitems/index");
    }
		//$this->view->render("stockitems/index");
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
  
  
  public function doCheckTransLog($mainid){
        @$this->loadModel("Stockitems");
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
      redirect_to($this->uri->link("stockitems/index"));
    }
    
    

}
?>