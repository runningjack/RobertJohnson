<div class="panel callout">
	<h4 style="display:inline">Add Work Sheet</h4>
    <a href="<?php
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
    <a href="<?php echo $uri->link("support/schedulelist") ?>"><span class="btn btn-danger  right button" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<form id="frmpri" name="frmpri" method="post" action="<?php echo $uri->link("support/doCreateWorkSheet") ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Add Work Sheet</legend>
    <div id="transalert"></div>
    <div class="row">
      <div class="large-12 columns">
      <label>FORM ID</label>
      <input type="text" id="wsid" name="wsid" value="<?php echo $this->formid ?>" class="large-4 columns" />
     </div>  
    </div>
    
    
    <div class="row">
    <label>Client Name</label>
        <div class="large-6 columns">
            
            <input type="text" id="clientname" name="clientname" placeholder="Filter by Client Name" autocomplete="off" style="display: inline;" /><span id="clder"></span>
            <input type="hidden" name="clientid" id="clientid" />
    <div id="mySearchContainer2" style="position: absolute;">
                    <div id="lcpsearchinner"></div>
                </div>
        </div>
    
    </div><!-- End of row -->
    
    
    <div class="row" id="pmydiv" style="display: none;">
        <label>Product / Machine</label>
        <div class="large-6 columns">
            <label style="color: #fff;">Product</label>
            <input name="cprodname" id="cprodname" type="text" placeholder="Filter by Product name / location" autocomplete="off" style="display: inline;" /><span id="plder"></span>
            <div id="mySearchContainer" style="position: absolute; background-color: #f58501;">
                    <div id="lcpsearchinner2"></div>
                </div>
            <input type="hidden" id="prod_id" name="prod_id" value="<?php  ?>" />
        </div>
    
    </div><!-- End of row -->
    <hr />
    <div class="row">
      <div class="large-12 columns">
        <label>Date</label>
        <input type="text" name="w_date" id="w_date" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Time In</label>
        <input type="time" name="time_in" id="time_in" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Time Out</label>
        <input type="time" name="time_out" id="time_out" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Contact Person</label>
        <input type="text" name="contact_person" id="contact_person" placeholder="Contact Person" />
      </div>
    </div>
    
    
    <div class="row">
      <div class="large-12 columns">
      <label>Technician Assigned</label>
	<select id="staff_id" name="staff_id">
    <option value="">--SELECT TECHNICIAN--</option> 
        <?php
	       if($this->techstaff){
	           foreach($this->techstaff as $technician){
	               echo "<option value='$technician->id_ $technician->emp_fname $technician->emp_lname $technician->emp_mname'>$technician->emp_fname $technician->emp_lname $technician->emp_mname</option>";
	           }
	       }
        ?>
   </select>
     </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>C.S.E. Name</label>
        <input type="text" name="cse_name" placeholder="C.S.E Name" id="cse_name" value="" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Problem (Terminal Status)</label>
        <textarea name="problem" id="problem">
        <?php echo !empty($this->schedu->issue) ? $this->schedu->issue : "" ?>
        </textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Causes</label>
        <textarea name="cause" id="cause"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Corrective Action</label>
        <textarea name="corrective_action" id="corrective_action"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Part Changed <input type="checkbox" name="part_changed" id="part_changed" value="1" /></label>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>CSE Remark</label>
        <textarea name="cse_remark" id="cse_remark"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Client Remarks</label>
        <textarea name="client_remarks" id="client_remarks"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Upload Scanned Form</label>
        <input type="file" name="fupload" id="fupload" multiple />
      </div>
    </div>
    
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="btn btn-primary" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
