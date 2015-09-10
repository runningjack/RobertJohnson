<?php
class Role extends Controller
{
	
	function __construct(){
		parent::__construct();
        global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
	}

	public function index(){
		@$this->loadModel("Role");
		$this->view->myrole = $this->model->getList();

        if(Session::getRole()){
            if(in_array(strtolower(get_class($this)), $_SESSION['emp_role_module'])){
                $this->view->render("role/index");
            }else{

                $this->view->render("access/restricted");
            }
        }
	}
    public function grants($id){
        global $database;
        @$this->loadModel("Role");
        $Egrants = $this->model->getModules();
        $allPriv = $this->model->getPriviByRole($id);
        $modules = array();
        $access  = array(); 
        $access1  = array(); 
        $access2  = array(); 
        $access3  = array(); 
        if($allPriv){
            foreach($allPriv as $Priv){
                $modules[] = $Priv->module;
            }
             
        }
                
        
       
        //print_r($access);
        $thisrole ="";
        if($Egrants){
           $thisrole .="<div class='row'>";
           $x=1;
                foreach($Egrants as $grant){
                $thisrole .="<div class='large-6 columns'>";
                   if(in_array($grant->module,$modules)){
                    /**
                     * above in array is done to check if data is already existing 
                     * in the priviledges database
                     */
                        $thisrole .="<H4><input id='{$grant->accronym}' name='{$grant->accronym}' type='checkbox' checked='checked' value='{$grant->module}' />$grant->module</H4>
                        <hr />";
                        //for($z=1; $z<=3; $z++){///// finds a particular priviledge that is already existing in the 
                        //priviledge database
                            $ppp = $database->fetch_assoc($database->db_query("SELECT * FROM priviledges WHERE role_id='{$id}' AND module='{$grant->module}'"));
                            /**
                             * this hidden field is required to the id
                             * of the id of the role in the priviledges
                             * table for update purpose
                             */
                            $thisrole .="<input type='hidden' name='{$grant->accronym}name' id='{$grant->accronym}name' value='$ppp[id]' />"; 
                            $thisrole .="<div class='large-3 columns'><h6>Create</h6><select id='{$grant->accronym}create' name='{$grant->accronym}create'>
                              <option value=''>No Grant</option>";
                              //$ppp = array();
                              /**
                               * this secton loads access data into list menu
                               * to modification purpose
                               */
                        
                              $access= explode(",",$ppp['access']);
                              $thisrole .= in_array("Create",$access) ? "<option value='Create' selected='selected'>Grant</option>
                                </select>" :"<option value='Create' >Grant</option>"; $thisrole .= "</select></div>
                            ";
                        
                             $thisrole .="<div class='large-3 columns'><h6>View</h6><select id='{$grant->accronym}view' name='{$grant->accronym}view'>
							 	<option value=''>No Grant</option>";
                                $ppp = $database->fetch_assoc($database->db_query("SELECT * FROM priviledges WHERE role_id='{$id}' AND module='{$grant->module}'"));
                        
                              $access1= explode(",",$ppp['access']);
                              $thisrole .= in_array("View",$access1) ? "<option value='View' selected='selected'>Grant</option>
                                </select>" :"<option value='View' >Grant</option>"; $thisrole .= "</select></div>
                            ";
                            
                             $thisrole .="<div class='large-3 columns'><h6>Modify</h6><select id='{$grant->accronym}modify' name='{$grant->accronym}modify'>
							 	<option value=''>No Grant</option>";
                                $ppp = $database->fetch_assoc($database->db_query("SELECT * FROM priviledges WHERE role_id='{$id}' AND module='{$grant->module}'"));
                        
                              $access2= explode(",",$ppp['access']);
                              $thisrole .= in_array("Modify",$access2) ? "<option value='Modify' selected='selected'>Grant</option>
                                </select>" :"<option value='Modify' >Grant</option>"; $thisrole .= "</select></div>
                            ";
                            
                             $thisrole .="<div class='large-3 columns'><h6>Delete</h6><select id='{$grant->accronym}delete' name='{$grant->accronym}delete'>
							 	<option value=''>No Grant</option>";
                                $ppp = $database->fetch_assoc($database->db_query("SELECT * FROM priviledges WHERE role_id='{$id}' AND module='{$grant->module}'"));
                        
                              $access3= explode(",",$ppp['access']);
                              $thisrole .= in_array("Delete",$access3) ? "<option value='Delete' selected='selected'>Grant</option>
                                </select>" :"<option value='Delete' >Grant</option>"; $thisrole .= "</select></div>
                            ";
                       // }
                   }else{
                   /**
                    * this secction loads role and access data if not 
                    * found in the database
                    */
                        $thisrole .="<H4><input id='{$grant->accronym}' name='{$grant->accronym}' type='checkbox' value='{$grant->module}' />$grant->module</H4>
                        <hr />";
                        //for($z=1; $z<=3; $z++){
                            $thisrole .="<div class='large-3 columns'><h6>Create</h6><select id='{$grant->accronym}create' name='{$grant->accronym}create'>
                              <option value=''>No Grant</option>
                              <option value='Create'>Grant</option>
                                </select></div>
                            ";
                            
                             $thisrole .="<div class='large-3 columns'><h6>View</h6><select id='{$grant->accronym}view' name='{$grant->accronym}view'>
							 	<option value=''>No Grant</option>
                                <option value='View'>Grant</option>
                                </select></div>
                            ";
                            
                             $thisrole .="<div class='large-3 columns'><h6>Modify</h6><select id='{$grant->accronym}modify' name='{$grant->accronym}modify'>
							 	<option value=''>No Grant</option>
                                <option value='Modify'>Grant</option>
                                </select></div>
                            ";
                            
                             $thisrole .="<div class='large-3 columns'><h6>Delete</h6><select id='{$grant->accronym}delete' name='{$grant->accronym}delete'>
							 	<option value=''>No Grant</option>
                                <option value='Delete'>Grant</option>
                                </select></div>
                            ";
                       // }
                    
                    }$thisrole .="</div>";
                    $x++;
                }
           
           $thisrole .="</div>"; 
        }
        
        $this->view->mygrant = $thisrole;
        $this->view->myrole = $this->model->getById($id);
        $this->view->render("role/manage");
    }
	public function edit($id){
		@$this->loadModel("Role");
		$this->view->myrole = $this->model->getById($id);
		$this->view->render("role/edit");
	}
	public function create(){
		@$this->loadModel("Role");
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("role/create");
	}
	public function doCreate(){
		@$this->loadModel("Role");
		if($this->model->create() ===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}else{
			echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}
	}
    
    public function doCreatePreviledges(){
        @$this->loadModel("Role");
        $this->model->CreateManageRole();//
          echo"<div data-alert class='alert-box success'>Record  Saved <a href='#' class='close'>&times;</a></div>";
        //}else{
        //    echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>"; 
        //} 
    }
    
    public function doCheckTransLog($mainid){
        @$this->loadModel("Role");
       
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
    
	public function doUpdate(){
		@$this->loadModel("Role");
		if($this->model->update()=== 1){
			echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->update()=== 2){
		      echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
		}else{
		  echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";		  
		}
	}
	public function doDelete($id){
	   global $session;
		@$this->loadModel("Role");
		if($this->model->delete($id)){
		  
			redirect_to($this->uri->link("role/index"));
		}
	}
}
?>