<div class="panel callout">
	<h4 style="display:inline">New Item</h4><a href="<?php 
   global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("dashboard/index");
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo $uri->link("dashboard/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    ?>"><span class="button secondary right" style="display:inline"> &laquo;Back to Dashboard</span></a>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("stockitems/index") ?>"> &laquo;Back To Listing</a></span>
</div>
    <form action="<?php echo $uri->link("stockitems/doCreate/") ?>" method="post"  name="frmEmp"  id="frmEmp" >
     <fieldset><div id="transalert"></div>
       	    <legend>Add New Item</legend>
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Item ID</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Enter Item ID" class="six"   name="itemid" id="itemid" />
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Item Name <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Enter Item name" class="six" required='required'  name="itemnames" id="itemnames" />
    <div id="tm"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Description</label>
    </div>
    <div class="small-10 columns">
    <textarea class="six"   name="descript" id="descript"></textarea> 
    <div id="desc"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Cost Price<span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder='Enter Item Cost Price' required='required' class="large-2 columns"  name="cprice" id="cprice" />
    <div id="costp"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Quantity<span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder='Enter Quantity' class="large-2 columns" required='required'  name="qty" id="qty" />
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">ISBN Number</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder='Enter ISBN number' class="small-6"   name="isbn" id="isbn" />
    </div>
  </div>



  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Serial Number</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder='Enter Serial Number' class="small-6"   name="serial" id="serial" />
    </div>
  </div>
  
   
  
  
   <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Item Type</label>
    </div>
    <div class="small-10 columns">
    <select id="ttype" name="ttype">
        <option value="" >--SELECT TYPE--</option>
        <option value="Stock Item">Stock Item</option>
        <option value="Non-Stock Item">Non Stock Item</option>
        
      </select>
    </div>
  </div>
  
  
  

    <div class="row">
    
   
          <input type="hidden" name="task" id="task" value="<?php //echo (isset($_GET['task']) && !empty($_GET['task'])) ? $_GET['task'] : "" ?>">
          <input type="hidden" name="pgid" id="pgid" value="<?php //echo $this->myrole->role_id ?>" />
        
           
       <input type="submit" class="button offset-by-five" name="save" value="save" id="save"/>
          	 </div>    
      	 </fieldset>
        </form>