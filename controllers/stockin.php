<?php
class Stockin extends Controller
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
		@$this->loadModel("Stockin");
		$this->view->mystockin = $this->model->getList();
		$this->view->render("stockin/index");
	}
	public function edit($id){
		@$this->loadModel("Stockin");
		$this->view->mystockin = $this->model->getById($id);
		$this->view->render("stockin/edit");
	}
	public function create(){
		@$this->loadModel("Stockin");
		//$this->view->mymenu = $this->model->getById($id);
		$this->view->render("stockin/purchases");
	}
	public function doCreate(){
		@$this->loadModel("Stockin");
		if($this->model->create()===1){
			echo"<div data-alert class='alert-box success'>Record Saved <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->create() === 2){
			echo"<div data-alert class='alert-box alert'>Record not Saved <a href='#' class='close'>&times;</a></div>";
		}else{
			echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Saved <a href='#' class='close'>&times;</a></div>";
		}
	}
    /**
     * controler to perform vendor
     * auto complete
     */
    public function doVendAutoComplete(){
        if(isset($_POST['input'])){
            @$this->loadModel("Stockin");
            if($this->model->vendID_AutoComplete($_POST['input'])){ // check if object is created succesfully
                $vendors = $this->model->vendID_AutoComplete($_POST['input']); //creates the vendor object
                $outpt = "<ul id='mySearch'>";
    		foreach($vendors as $pep){
    			$outpt .= "<li>";
    			     $outpt .="	<div style='width:25%; float:left; ; z-index:1300' class='divvid' dress='$pep->vend_name"."<br />".$pep->vend_address."<br />".$pep->vend_country."' vid='$pep->vend_id'>$pep->vend_id</div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->vend_name."</div></H6> </li><div style='clear:both'></div>";
        		}
        		$outpt .= "</ul>";
                
                echo $outpt;
            }
        }
        
    }
    
    
    /**
     * controler to perform item
     * auto complete
     */
    public function doItemAutoComplete(){
        if(isset($_POST['input'])){
            @$this->loadModel("Stockin");
            if($this->model->itemID_AutoComplete($_POST['input'])){ // check if object is created succesfully
                $items = $this->model->itemID_AutoComplete($_POST['input']); //creates the item object
                $outpt = "<ul id='mySearch'>";
    		foreach($items as $pep){
    			$outpt .= "<li>";
    			     $outpt .="	<div style='width:25%; float:left; ; z-index:1300' class='divvid' prodid='$pep->id' dress='$pep->item_name' vprice='$pep->item_cost' vid='$pep->item_id'>$pep->item_id</div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->item_name."</div></H6> </li><div style='clear:both'></div>";
        		}
        		$outpt .= "</ul>";
                
                echo $outpt;
            }
        }
        
    }
    
    
    
    /**
     * cart model to maitain items array
     * in cart befor it is been posted to 
     * the purchases table
     */
    
    public function doAddToCart(){
        $basket		= new Cart();
        $mcart		="";

$basket->addItem($_POST['ppid'],$_POST['ppname'],$_POST['pcatname'],$_POST['pqty'],$_POST['pprice']);
$myItems = $basket->getContents(); // the basket get arrays of items in the cart
$quantity = $_POST['pqty'];
$subTotal = ($basket->getTotal()); // the basket gets the total of the items as subtotal
$vat		= (0.05 * $subTotal); // calculates the vat
$total		= $subTotal+$vat;
$mcart .="<table id='minicart-a' summary='Employee Pay Sheet'>
    <thead>
    	<tr>
            <th width='10%' scope='col'>ItemID</th>
        	<th width='35%' scope='col' >Description</th>
            <th width='20%' scope='col'>Qty</th>
            <th width='10%' scope='col'>Cost</th>
            <th width='10%' scope='col'>Total</th>
            
        </tr>
    </thead>
    <tbody>";
    
    //print_r($item['itemName']);
    
    
    $qt =0;
            foreach($myItems as $item){
				$myproduct = Items::find_by_id($item['itemId']);
                //print_r($myproduct);
    	$mcart .="<tr>
              
              <td>".$item['itemName']."</td>
              <td>".$myproduct->item_description."</td>
              <td><span>
                <input type='text' name='qty' id='qty".$qt."' value='".$item['itemQuantity']."' style='width:40px; padding:2px; height:36px; text-align:center; '  />
              </span>&nbsp;&nbsp;<span><a href='#' class='modifyqty' prodid='".$item['itemId']."' prodqty='".$item['itemQuantity']."'  tprice='".$item['itemPrice']."' count ='".$qt."' ><img src='public/icons/Refresh16.png' width='18' height='18' /></a></span>&nbsp;&nbsp;<span><a href='#' class='deleteitem' prodid='".$item['itemId']."'  ><img src='public/icons/Delete16.png' width='18' height='18' /></a></span></td>
              <td>&#8358;".number_format($item['itemPrice'],2,'.',',')."</td>
              <td>&#8358;".number_format($item['itemTotal'],2,'.',',')."</td>
            </tr>";
			$qt++;
			}
    
    
    
    
	/**
 * foreach($myItems as $item){
 *     	$mcart .="<tr>
 *         	<td>".$item['itemQuantity']."</td>
 *             <td>".$item['itemName']."</td>
 *             <td>&#8358;".$item['itemName']."</td>
 *             <td>".number_format($item['itemPrice'],2,'.',',')."</td>
 *             <td><span class='bold'>&#8358;".number_format($item['itemTotal'],2,'.',',')."</span></td>
 *             <td><span class='bold'>x</span></td>
 *         </tr>
 *         
 *         ";
 * 	}
 */
		$mcart .="<tr>
        	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>       
	    <tr>
          <td>&nbsp;</td>
          <td colspan='3' align='right'><h3 class='black'>SubTotal:</h3></td>
          <td colspan='3' align='right'><span class='bold'>&#8358;".number_format($subTotal,2,'.',',')."</span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan='3' align='right'><h3 class='black'>VAT(5%):</h3></td>
          <td colspan='3' align='right'><span class='bold'>&#8358;".number_format($vat,2,'.',',')."</span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan='3' align='right'><h3><span class='black'>Total:</span></h3></td>
          <td colspan='3' align='right'><div class='divider'></div><h3 class='bold'>&#8358;".number_format($total,2,'.',',')."</h3><div class='divider'></div><div class='divider'></div></td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td colspan='3' align='right'><span style='margin:5px'><a href='#'>view cart</a></span></td>
            <td colspan='3'><span style='margin:5px'><a href='#'>Check out</a></span></td>
            </tr>
    </tbody>
</table>";
print_r($mcart);

    }
    
    
    /**
     * this section is required 
     * to modify items
     */
    
    public function doModifyCart(){
        $basket = new Cart();
        $basket->getContents();
        $newQty	= $_POST['newQty'];//preg_replace is required to clean up the url variable to numeric value
        $prodID = $_POST['pid'];
        $prodPrice = $_POST['price'];
        $basket->setQuantity($prodID,$newQty,$prodPrice);//sets the quantity of the item given the product id and quantity to change
    }
    
    /**
     * this section is required 
     * to remove an item from
     * the cart
     */
     
     public function doDeleteFromCart(){
        $basket = new Cart();
        $prodID= isset($_POST['pid']) ? $_POST['pid'] : "";
        $cngItem = $basket->getContents();
        $basket->deleteItem($prodID);
     }
    
	public function doUpdate(){
		@$this->loadModel("Stockin");
		if($this->model->update()=== 1){
			echo"<div data-alert class='alert-box success'>Record Updated <a href='#' class='close'>&times;</a></div>";
		}elseif($this->model->update()=== 2){
		      echo"<div data-alert class='alert-box success'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";
		}else{
		  echo"<div data-alert class='alert-box alert'>Unexpected Error! Record not Updated <a href='#' class='close'>&times;</a></div>";		  
		}
	}
	public function doDelete($id){
		@$this->loadModel("Stockin");
		if($this->model->delete($id)){
			redirect_to($this->uri->link("stockin/index"));
		}
	}
}
?>