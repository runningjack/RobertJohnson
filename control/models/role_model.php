<?php
class Role_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getList(){
		$roles = Roles::find_all();
		return $roles;
	}
	public function getById($id){
		$myrole = Roles::find_by_id($id);
		return $myrole;
	}
    
    public function getPriviByRole($id){
        return Priviledges::find_by_sql("SELECT * FROM priviledges WHERE role_id='{$id}'");
    }
    
    public function getModules(){
        return Modules::find_all();
    }
    
    
    public function checkTransLog($id){
        if(!empty($id)){
            
            $transaction        =       Transaction::find_by_main_id($id);
          
            if($transaction){
                //echo "<p><strong class='alert-box alert'>Record cannot be deleted! <br /> History already existing for this record</strong></p>";
                    return 2;
            }elseif(!$transaction){
                $merole      =  Roles::find_by_mainid($id) ;
               
              if($merole->delete()) {
                
               return 1;
              }
                 
            }else{
                return 3; ///Unexpected Error
            }            
        }
    }
    
    
	public function create()
	{
		if(isset($_POST['rolename']) && !empty($_POST['rolename'])){
			$role = new Roles();
			$role->role_name		=	$_POST['rolename'];
			$role->role_description =	$_POST['description'];
			$role->date_created 	=	date('Y-m-d H:i:s');
			if($role->create()){
				return 1;
			}else{
				return 2;
			}
		}
	}
	public function update()
	{
		if(isset($_POST['rolename']) && !empty($_POST['rolename'])){
			$thisrole 					= 	Roles::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['pgid']));
			$thisrole->role_name		=	$_POST['rolename'];
			$thisrole->role_description =	$_POST['description'];
			$thisrole->date_modified	=	date('Y-m-d H:i:s');
			$thisrole->role_id 			= preg_replace("#[^0-9]#i", '', $thisrole->role_id );
			if($thisrole->update()){
				return 1;
			}else{
			     return 2;
			}
		}
	}
    
    public function CreateManageRole(){
        $grantdatas   =   $this->getModules() ;
        
        foreach ($grantdatas as $grant){
            $updateaccess = "";
            if(!empty($_POST[$grant->accronym.'name']) && empty($_POST[$grant->accronym])){
                /**
                 * priviledges is deleted here
                 */
                 $thispriviledges = Priviledges::find_by_id($_POST[$grant->accronym.'name']);
                 if($thispriviledges){
                    $thispriviledges->delete();
                 }
                 
            }elseif(!empty($_POST[$grant->accronym.'name']) && !empty($_POST[$grant->accronym])){
                /**
                 * priviledges is updated here
                 */
                $thispriviledges = Priviledges::find_by_id($_POST[$grant->accronym.'name']);
            
                $thispriviledges->module  = $grant->module;
                if(!empty($_POST[$grant->accronym.'create'])){
                    $updateaccess .= $_POST[$grant->accronym.'create'].",";
                }
                if(!empty($_POST[$grant->accronym.'modify'])){
                    $updateaccess .= $_POST[$grant->accronym.'modify'].",";
                }
                if(!empty($_POST[$grant->accronym.'delete'])){
                    $updateaccess .= $_POST[$grant->accronym.'delete'].",";
                }
                if(!empty($_POST[$grant->accronym.'view'])){
                    $updateaccess .= $_POST[$grant->accronym.'view'].",";
                }
                $updateaccess =  substr_replace($updateaccess,"",-1);
                $thispriviledges->access = $updateaccess;
                $thispriviledges->datemodified  =date("Y-m-d H:i:s");
                $thispriviledges->update(); //return? true : false ;
            }elseif(isset($_POST[$grant->accronym]) && !empty($_POST[$grant->accronym])){
                /**
                 * new priviledge is created here
                 */
                $mypriviledges = new Priviledges();
                $access="";
                $mypriviledges->role_id = $_POST['pgid'];
                $mypriviledges->module  = $grant->module;
                if(!empty($_POST[$grant->accronym.'create'])){
                    $access .= $_POST[$grant->accronym.'create'].",";
                }
                if(!empty($_POST[$grant->accronym.'modify'])){
                    $access .= $_POST[$grant->accronym.'modify'].",";
                }
                if(!empty($_POST[$grant->accronym.'delete'])){
                    $access .= $_POST[$grant->accronym.'delete'].",";
                }
                if(!empty($_POST[$grant->accronym.'view'])){
                    $access .= $_POST[$grant->accronym.'view'].",";
                }
                $access =  substr_replace($access,"",-1);
                $mypriviledges->access = $access;
                $mypriviledges->datecreated = date("Y-m-d H:i:s");
                $mypriviledges->create(); //return? true : false ;
            }
            
            
             
        }
    }
               
        
	public function delete($id){
	 
		$article = Roles::find_by_id($id);
		if($article->delete()){
		 
			return true;
		}
	}
	
}

?>