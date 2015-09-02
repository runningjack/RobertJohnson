<div class="panel callout">
	<h4 style="display:inline">New Area</h4><a href="<?php 
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
    
    
    ?>"><a href="<?php echo $uri->link("subregion/index") ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<form id="frmDepartment" method="post" action="<?php echo $uri->link("subregion/doCreate") ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Add New Region</legend>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Name of Area <span class="red">*</span></label>
        <select id="area" name="area">
        <?php
        
        foreach($this->area as $area){
            echo "<option value='".$area->id.",". $area->name."'>$area->name</option>";
        }
        ?>
           
        </select> 
      </div>
    </div>
    
    
    <div class="row">
      <div class="large-12 columns">
        <label>Name of Region <span class="red">*</span></label>
        <input type="text" placeholder="Enter Area Name" id="subregion" name="subregion" />
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Description </label>
        <textarea  id="description" name="description" rows="20"></textarea>
      </div>
    </div>
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="button" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
