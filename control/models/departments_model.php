<?php
class Departments_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getList(){
		$departments = Department::find_all();
		return $departments;
	}
	public function getById($id){
		$mydepartment = Department::find_by_id($id);
		return $mydepartment;
	}
	public function create()
	{
		if(isset($_POST['deptname']) && !empty($_POST['deptname'])){
			$department                 =   new Department();
			$department->dept_name		=	$_POST['deptname'];
			$department->dept_desc      =	$_POST['description'];
			$department->date_created 	=	date('Y-m-d H:i:s');
            $department->dept_hod_name  =   $_POST['hod'];
            //$department->dept_hod_id    =   $_POST[''];
			$department->dept_code 	    =	Department::getID2("RJHD","tbldept",$department->dept_name);
			if($department->create()){
				return 1;
			}else{
				return 2;
			}
		}
	}
	public function update()
	{
		if(isset($_POST['deptname']) && !empty($_POST['deptname'])){
			$thisdepartment 					= 	Department::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['pgid']));
			$thisdepartment->dept_name		    =	$_POST['deptname'];
			$thisdepartment->dept_desc          =	$_POST['description'];
			$thisdepartment->date_modified 	    =	date('Y-m-d H:i:s');
            $thisdepartment->dept_hod_name      =   $_POST['hod'];
			
			if($thisdepartment->update()){
				return 1;
			}else{
		          return 2;
			}
		}
	}
	public function delete($id){
		$article = Department::find_by_id($id);
		if($article->delete()){
			return true;
		}
	}
	
}

?>