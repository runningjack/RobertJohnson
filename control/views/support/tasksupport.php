<div class="panel callout">
	<h4 style="display:inline">Task Support</h4><a href="<?php
        global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("itdepartment/index");
    }elseif($session->rolename=="Customer Support Services" && in_array("support", $session->privil)){
        echo $uri->link("support/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    ?>"><span class="btn  right  btn-primary button" style="display:inline"> &laquo;Back To Dashboard</span></a>
   <a href="<?php echo $uri->link("support/worksheetlist") ?>"> <span class="btn btn-danger  right button" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<form id="frmEmp3" name="frmEmp3" method="post" action="<?php echo $uri->link("support/doTaskSupportWUpdate/".$this->myworksheet->id) ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Support Supply</legend>
    <input type="hidden" name="prod_id" id="prod_id" value="<?php echo $this->myworksheet->prod_id ?>" />
    <input type="hidden" name="pgid" id="pgid" value="<?php echo $this->myworksheet->id ?>" />
    <input type="hidden" name="price" id="price"  />
    <div class="row">
      <div class="large-12 columns">
        <label>Fund <span class="red">*</span></label>
        <input type="text" placeholder="Fund Given To Technician" id="fund" name="fund" />
      </div>
    </div>
    <div id="ptable" class="large-12 columns"></div>
    <div class="row">
    <div class="large-1 columns">Parts Supplied</div>
      <div class="large-4 columns">
        
        <input type="text"  id="itemname" name="itemname" />
        <div id="mySearchContainer" style="position: absolute; background-color: #c4c5c9;">
                    <div id="lcpsearchinner2"></div>
                </div>
    
         <input type="hidden" id="itemid" name="itemid" />
         <!--<input type="hidden" id="itemname" name="itemname" />-->
      </div>
      <div class="large-2 columns ">
      <input type="number" id="qty" name="qty" value="1" />
      </div>
      <div class="large-4 columns  ">
        <a href="#" id="adpart" class="btn btn-primary button">Add Part</a>
      </div>
      <div class="large-1 columns  ">
        
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Comment </label>
        <textarea id="description" name="description" rows="20"></textarea>
      </div>
    </div>

    
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="button" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
