<div class="panel callout">
	<h4 style="display:inline">Edit Product Category</h4><a href="<?php 
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
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("prod_cats/index") ?>"> &laquo;Back To Listing</a></span>
</div>

<form id="frmProdCatUpdate" method="post" action="<?php echo $uri->link("prod_cats/doUpdate") ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Edit Product Category</legend>

    <div class="row">
      <div class="large-12 columns">
        <label>Name<span class="red">*</span></label>
        <input type="text" placeholder ="Enter Name of Product Category" name="name" value="<?php echo $this->prod_cat->prod_cat_name ?>" />
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Manufacturer </label>
        <input type="text" placeholder="Enter Name of Manufacturer" name="manufacturer" value="<?php echo $this->prod_cat->prod_cat_manu ?>" />
      </div>
    </div>

    <div class="row">
      <div class="large-4 columns">
        <label>Make Visible</label>
            <select name="visible">
                <option value="show" <?php echo $this->prod_cat->visible == 'show' ? 'selected="selected"' :"" ?>>Show</option>
                <option value="hide" <?php echo $this->prod_cat->visible == 'hide' ? 'selected="selected"' :"" ?>>Hide</option>
            </select>
        <input type="hidden" name="prod_cat_id" value="<?php echo $this->prod_cat->prod_cat_id ?>" />
      </div>
    </div>
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="button" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
