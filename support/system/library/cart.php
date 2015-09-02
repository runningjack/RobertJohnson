<?php
require_once("database.php");
class Cart{
	public $item_id;
	public $item_name;
	public $item_price;
	public $item_quantity;
	
	 public $items = array(); // Associative array of items

    function __construct(){
        $this->syncCartToSession();
    }
	
	public function addItem($item_id,$item_name,$sub_cat_name,$quantity,$price){       
			
			$this->items[$item_id]['itemName'] 			= $item_name;
			$this->items[$item_id]['itemSubCatName'] 	= $sub_cat_name;
            $this->items[$item_id]['itemQuantity'] 		= (int)$quantity;
			$this->items[$item_id]['itemPrice'] 		= (int)$price;
			$this->items[$item_id]['itemTotal']			= (int)$quantity * (int)$price;
			$this->items[$item_id]['itemId'] 			= $item_id;
              // Sync the session with the cart now
        $this->syncSessionToCart();
    }
    
    public function deleteItem($item_id){
        if (isset($this->items[$item_id]))
        {
            unset($this->items[$item_id]);
            // Sync the session with the cart now
            $this->syncSessionToCart();
        }
    }
    
    public function setQuantity($item_id, $newQuantity, $price){
        if (isset($this->items[$item_id]))
        {
            if ((int)$newQuantity <= 0)
            {
                $this->deleteItem($item_id);
            }
            else
            {
                $this->items[$item_id]['itemQuantity'] = (int)$newQuantity;
				$this->items[$item_id]['itemTotal'] = $this->modifyItemTotal($item_id,$price,$newQuantity);
            }
            
            // Sync the session with the cart now
            $this->syncSessionToCart();
        }
    }
	private function modifyItemTotal($item_id, $price, $newQuantity){
		//to be called privately if cart quantity is changed it gets the product of the quantity 
		//by the unit price
		$modifiedTotal = (int)$newQuantity * (int)$price;
		return $modifiedTotal;		
	}
    
    public function getQuantity($item_id){
        if (isset($this->items[$item_id]))
        {
            return ($this->items['itemQuantity']);
        }
    }
    
    public function numberOfItems(){
        if (isset($this->items))
        {
            $numberOfItems = 0;
            
            foreach ($this->items as $item)
            {
                $numberOfItems += $item['itemQuantity'];
            }
            return $numberOfItems;
        }
    }
    
    public function emptyCart(){
        unset($this->items);
        $this->items = array();
        // Sync the session with the cart now
        $this->syncSessionToCart();
    }

    public function getContents(){
        if (isset($this->items))
        {
            return $this->items;
        }
    }

    public function getTotal(){
        if (isset($this->items))
        {
            $total = 0;
            foreach ($this->items as $item)
            {
                $total += ($item['itemPrice']) * $item['itemQuantity'];
            }
            return $total;
        }
        else
        {
            return 0;
        }
    }
	
    public function serializeCart(){
        $serializedCart = serialize($this->items);
        
        return $serializedCart;
    }
    public function unserializeCart($serializedCart){
        $unserializedCart = unserialize($serializedCart);
        
        $this->items = $unserializedCart;
        
        $this->syncSessionToCart();
    }
    
    private function syncSessionToCart(){
        $_SESSION['myHamper'] = $this->items;
    }
    
    private function syncCartToSession(){
        if (isset($_SESSION['myHamper']))
        {
            $this->items = $_SESSION['myHamper'];
        }
    }
}


