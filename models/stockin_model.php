<?php
class Stockin_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getList(){
		$purchases = Purchase::find_all();
		return $purchases;
	}
	public function getById($id){
		$mydepartment = Purchase::find_by_id($id);
		return $mydepartment;
	}
	public function create()
	{
		if(isset($_POST['purid']) && !empty($_POST['purdate']) && !empty($_POST['vendid'])){
			$newPurchase                 =   new Purchase();
			$newPurchase->pur_id         =   $_POST['purid']		 ;
			$newPurchase->ord_no         =   $_POST['odrno'];
			$newPurchase->vend_id        =   $_POST['vendid'];
			$newPurchase->pur_amount;
			$newPurchase->pur_discount;
			$newPurchase->pur_total;
			$newPurchase->pur_comment;
			$newPurchase->pur_datecreated;
			
			if($newPurchase->create()){
				return 1;
			}else{
				return 2;
			}
		}
	}
	public function update()
	{
		if(isset($_POST['deptname']) && !empty($_POST['deptname'])){
			$thisdepartment 					= 	Purchase::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['pgid']));
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
    /**
     * this  get an auto complete 
     * method on vendor for the purchase
     * or orther form
     */
    public function vendID_AutoComplete($id=""){
        return (Vendor::find_by_sql("SELECT * FROM vendors WHERE vend_id LIKE '%".$_POST['input']."%'"));
    }
    
    /**
     * this section is used to get auto complete
     * feature for the item 
     * textbox
     */
    public function itemID_AutoComplete($id=""){
        return (Items::find_by_sql("SELECT * FROM items WHERE item_id LIKE '%".$_POST['input']."%'"));
    }
    
    
    
    
    /**
     * this method is needed to 
     * delete from a vendor list
     */
	public function delete($id){
		$article = Purchase::find_by_id($id);
		if($article->delete()){
			return true;
		}
	}
	
}

?>