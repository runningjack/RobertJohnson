
<div class="panel callout">
	<h4 style="display:inline">Edit Department</h4><a href="<?php 
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
    
    
    ?>"><a href="<?php echo $uri->link("departments/index") ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<form id="frmDepartmentUpdate" method="post" action="<?php echo $uri->link("departments/doUpdate") ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Add New Department</legend>

    <div class="row">
      <div class="large-12 columns">
        <label>Name of department <span class="red">*</span></label>
        <input type="text" placeholder ="Enter Department Name" id="deptname" name="deptname" value="<?php echo $this->mydepartments->dept_name ?>" />
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Description </label>
        <textarea placeholder ="Enter descriptive text or note of the department here" id="description" name="description" rows="20"><?php echo $this->mydepartments->dept_desc ?></textarea>
      </div>
    </div>

    <div class="row">
      <div class="large-4 columns">
        <label>Head of Department</label>
        <input type="text" placeholder ="Head of Department" id="hod" name="hod" value="<?php echo $this->mydepartments->dept_hod_name ?>" /><input type="hidden" id="pgid" name="pgid" value="<?php echo $this->mydepartments->id ?>" />
      </div>
    </div>
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="button" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
