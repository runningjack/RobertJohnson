<?php
class Products_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getList(){
		$all = Product::find_all();
		return $all;
	}
	public function getById($id){
		$one = Product::find_by_id($id);
		return $one;
	}
	public function create()
	{
		if(isset($_POST['prod_cat_id']) && !empty($_POST['prod_cat_id'])){
			$obj            			=   new Product();
			$error 						= 	array();
			$obj->prod_cat_id			=	$_POST['prod_cat_id'];
			$obj->prod_serial   		=	$_POST['prod_serial'];
			$obj->client_id 			=	$_POST['client_id'];
			$obj->incare_employee_id 	= 	$_POST['emp_id'];
			$obj->prod_location			=	$_POST['location'];
			$obj->model					=	$_POST['model'];
			if(empty($error)){
				if($obj->create()){
					return 1;
				}else{
					return 2;
				}
			}
		}
	}
	public function update()
	{
		if(isset($_POST['prod_cat_id']) && !empty($_POST['prod_cat_id'])){
			$error = array();
			$obj            = 	Product::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['prod_id']));
			$error 						= 	array();
			$obj->prod_cat_id			=	$_POST['prod_cat_id'];
			$obj->prod_serial   		=	$_POST['prod_serial'];
			$obj->client_id 			=	$_POST['client_id'];
			$obj->incare_employee_id 	= 	$_POST['emp_id'];
			$obj->prod_location			=	$_POST['location'];
			$obj->model					=	$_POST['model'];
			if(empty($error)){
				if($obj->update()){
					return 1;
				}else{
					return 2;
				}
			}
		}
	}
	
	public function delete($id){
		$article = Product::find_by_id($id);
		if($article->delete()){
			return true;
		}
	}
	//continue from here
	public function createsignoff(){
		if(isset($_POST['prod_id']) && !empty($_POST['prod_id'])){
			$error = array();
			$obj = new Sign_off();
			$obj->prod_id = $_POST['prod_id'];	
			$obj->mag_strip = isset($_POST['mag_strip']) ? 1:0;
			$obj->verve_card = isset($_POST['verve']) ? 1:0;
			$obj->master_card = isset($_POST['master_card']) ? 1:0;;
			$obj->visa_card = isset($_POST['visa_card']) ? 1:0;;
			$obj->withdraw = isset($_POST['withdraw']) ? $_POST['withdraw']:"";
			$obj->witdraw_comment = isset($_POST['withdraw_area']) ? htmlspecialchars(strip_tags($_POST['withdraw_area'])):"";
			$obj->balance = isset($_POST['balance']) ? $_POST['balance']:"";
			$obj->balance_comment = isset($_POST['balance_area']) ? htmlspecialchars(strip_tags($_POST['balance_area'])):"";
			$obj->statement = isset($_POST['statement']) ? $_POST['statement']:"";
			$obj->statement_comment = isset($_POST['statement_area']) ? htmlspecialchars(strip_tags($_POST['statement_area'])):"";
			$obj->transfer = isset($_POST['transfer']) ? $_POST['transfer']:"";
			$obj->transfer_comment = isset($_POST['transfer_area']) ? htmlspecialchars(strip_tags($_POST['transfer_area'])):"";
			$obj->pin_change = isset($_POST['pin_change']) ? $_POST['pin_change']:"";
			$obj->pin_change_comment = isset($_POST['pin_change_area']) ? htmlspecialchars(strip_tags($_POST['pin_change_area'])):"";
			$obj->mobile_recharge = isset($_POST['mobile_recharge']) ? $_POST['mobile_recharge']:"";
			$obj->mobile_recharge_comment = isset($_POST['mobile_recharge_area']) ? htmlspecialchars(strip_tags($_POST['mobile_recharge_area'])):"";
			$obj->camera_instal;
			$obj->inverter_status;
			$obj->AC_status;
			$obj->ATM_room_cond;
			$obj->cse_remark;
			$obj->client_remark;
			$obj->employee_id;
			$obj->scan_url;
		}
	}
	
}

?>