<div class="panel callout">
	<h4 style="display:inline">Purchases Invoice</h4><a href="<?php 
    global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("itdepartment/index");
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo $uri->link("support/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    ?>"><span class="button secondary right" style="display:inline"> &laquo;Back to Dashboard</span></a>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("stockin/index") ?>"> &laquo;Back To Listing</a></span>
</div>
    <form action="<?php echo $uri->link("purchases/doCreate/") ?>" method="post"  name="frmEmp"  id="frmEmp" >
     <fieldset><div id="transalert"></div>
       	    <legend><h4>New Purchase</h4></legend>
            
            <div class="row">
            
                <div class="large-5"><label for="vendid" class="left inline">Vendor ID
                
                </label><input type="hidden" id="hidfid" name="hidfid" value="" /><input type="text" required='required' placeholder="Enter Vendor ID" class="six"   name="vendid" id="vendid" />
                <div id="mySearchContainer2" style="position: absolute; background-color: #f58501;">
                    <div id="lcpsearchinner"></div>
                </div>
                <br />
				</div>            
            </div>
  <div class="row">
    <div class="small-5 columns" style="border:solid .23em #444; height: 180px;  padding-top: 15px;">
    <strong>Remit To:</strong>
   
    <blockquote id="dress">World Headquarters <br />
    5995 Mayfair Road <br />
    North Canton, OH 44720 <br />
    USA
    </blockquote>
    
    <div class="row">
    </div>
    </div>
    <div class="small-5 columns" style="border:solid .25em #444;  height: 180px; padding-top: 15px;">
    	<div class="row">
        	<div class="large-3 columns"><strong>Inv No</strong></div>
            <div class="large-9 columns"><input type="text" placeholder="Invoice No" class="six"   name="purid" id="purid" /></div>
        </div>
        <div class="row">
        	<div class="large-3 columns"><strong>Pur Date</strong></div>
            <div class="large-9 columns"><input type="text" placeholder="Purchases Date" class="six"   name="purdate" id="purdate" /></div>
        </div>
        <div class="row">
        	<div class="large-3 columns"><strong>Ord No</strong></div>
            <div class="large-9 columns"><input type="text" placeholder="Order No " class="six"   name="odrno" id="odrno" /></div>
            
        </div>
    </div>
  </div>
  <hr  />
  
  <div class="row">
    <div class="small-1 columns">
    <label for="right-label" class="left inline">Item ID </label>
    </div>
    <div class="small-3 columns">
    <input type="text" placeholder="" class="six"  name="itemid" id="itemid" /><input type="hidden" id="itemname" name="itemname" />
    <input type="hidden" name="pid" id="pid" />
    
    <div id="mySearchContainer" style="position: absolute; background-color: #f58501;">
                    <div id="lcpsearchinner2"></div>
                </div>
    </div>
    <div class="small-1 columns">
        <label for="right-label" class="left inline">Cost Price </label>
    </div>
    <div class="small-2 columns">
        <input type="text" class="" id="price" name="price" />
    </div>
    
    <div class="small-1 columns">
    <label for="right-label" class="left inline">Quantity </label>
    </div>
    <div class="small-2 columns">
    <input type="text" placeholder="" class="six"   name="qty" id="qty" />
    </div>
    <div class="small-2 columns">
    <a href="#" class="button addtocart">Add Item</a>
    </div>
  </div>
  <hr />
  
 
 <fieldset>
 <div id="palert"></div>
 <legend>Info</legend>
<div class="row" id="itemCart">
	<table>
      <thead>
        <tr>
          <th>Qty</th>
          <th>Item Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Content Goes Here</td>
          <td>Content Goes Here</td>
          <td>This is longer content Donec id elit non mi porta gravida at eget metus.</td>
          <td>Content Goes Here</td>
        </tr>
        <tr>
          <td>Content Goes Here</td>
          <td>Content Goes Here</td>
          <td>This is longer content Donec id elit non mi porta gravida at eget metus.</td>
          <td>Content Goes Here</td>
        </tr>
        <tr>
          <td>Content Goes Here</td>
          <td>Content Goes Here</td>
          <td>This is longer content Donec id elit non mi porta gravida at eget metus.</td>
          <td>Content Goes Here</td>
        </tr>
      </tbody>
    </table>
    
</div>
</fieldset><!-- End of lareg 12 --> 
<hr />
<div class="row">
	<div class="large-4 push-8">
    	<label>Discount</label>
        <input type="text" id="dis" name="dis"  />
    </div>
    <div class="large-4 push-8">
    	<label>Subtotal</label>
        <input type="text" id="subt" name="subt"  />
    </div>
    <div class="large-4 push-8">
    	<label>Subtotal</label>
        <input type="text" id="total" name="total"  />
    </div>
<div>
    </div>
</div>
  
  
    

    <div class="row">
    
   
          <input type="hidden" name="task" id="task" value="<?php //echo (isset($_GET['task']) && !empty($_GET['task'])) ? $_GET['task'] : "" ?>">
          <input type="hidden" name="pgid" id="pgid" value="<?php //echo $this->myrole->role_id ?>" />
        
           
       <input type="submit" class="button push-2" name="save" value="save Record" id="save"/>
          	 </div>    
      	 </fieldset>
        </form>