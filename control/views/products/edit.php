<div class="panel callout">
	<h4 style="display:inline">Products</h4><a href="<?php 
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
    
    
    ?>"><a href="<?php echo $uri->link("products/index") ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<form id="frmDep"  name="frmDep" method="post" action="<?php echo $uri->link("products/doUpdate") ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Maintain Product</legend>

    <div class="row">
      <div class="large-12 columns">
        <label>Name of Product <span class="red">*</span></label>
        <input type="text" placeholder="Enter General Product Name" id="pname" name="pname" value="<?php echo $this->myproduct->prod_name ?>" />
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Description </label>
        <textarea  id="description" name="description" rows="20"><?php echo $this->myproduct->description ?></textarea>
      </div>
    </div>
    <input type="hidden" id="pgid" name="pgid" value="<?php echo $this->myproduct->prod_id ?>" />
    <input type="hidden" id="imgvalue" name="imgvalue" value="<?php echo $this->myproduct->prod_image ?>" />
    <div class="row">
      <div class="large-12 columns">
        <label>Image <small>Generic Image for this product</small> </label>
        <input type="file" name="fupload" name="fupload" />
      </div>
    </div>
    
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="button" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
