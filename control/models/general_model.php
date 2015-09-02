<?php
class General_Model extends Model{
    function __construct()
	{
		parent::__construct();
	}
    
    
     /**
     * load initail data for employee form needed during 
     * creating and editing employee
     * data 
     */
	public function getData(){
		global $database;
		$depts 			= Department::find_all();
		$role			= Roles::find_all();
		$country 		= Country::find_all();
        $employee 		= Employee::find_all();
		$zone 			= Zone::find_by_sql("SELECT * FROM zone WHERE country_id=156");
		$startups 		= array("departs"=>$depts,"country"=>$country,"state"=>$zone,"employee"=>$employee,"role"=>$role);
		return $startups;		
	}
    
    
    /**
     * use with jquery to porpulate the local government  
     * listitem in  form 
     */
	public function lga($state_id){
        if(!empty($state_id)){
            return Lga::find_by_sql("SELECT * FROM lgas WHERE zone_id='".$state_id."'");
        }
    }
    
    
    public function state($country_id){
        if(!empty($country_id)){
            //$cid = explode(",",$_POST[])
            return Zone::find_by_sql("SELECT * FROM zone WHERE country_id=$country_id");
        }
    }
    
    public function checkTransLog($id){
        if(!empty($id)){
            
            $transaction        =       Transaction::find_by_main_id($id);
            if($transaction){
                return $transaction;
            }else{
                return false;
            }
            
        }
    }
    
    public function getClientProdByID($id){
        return Cproduct::find_by_id($id);
    }
    
    public function getClientByID($id){
        return Client::find_by_id($id);
    }
    
    public function getProductByID($id){
        $product =  Product::find_by_id($id);
		return in_array("id",$product) ? $product->id : 0;
       // $myaccount = Accounts::find_by_phone($phone);  
	}
    
    public function getCProductByID($id){
        $product =  Cproduct::find_by_id($id);
		return in_array("id",$product) ? $product->id : 0;
       // $myaccount = Accounts::find_by_phone($phone);  
	}
    
    public function getProductByName($prodname){
        return Product::find_by_prodname($prodname); 
	}
    
    public function getClientByName($clientname){
        return Client::find_by_clientname($clientname); 
	}
    
    public function getItemsByName($clientname){
        return Items::find_by_itemname($clientname); 
	}
}
?>