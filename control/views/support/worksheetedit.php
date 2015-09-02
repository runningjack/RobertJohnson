<div class="panel callout">
	<h4 style="display:inline">Worksheet</h4><a href="<?php
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
    <a href="<?php echo $uri->link("support/worksheetlist") ?>"><span class="btn btn-danger  right button" style="display:inline"> &laquo;Back To Listing</span></a>
</div>
<?php
       $cproduct = Cproduct::find_by_id($this->myworksheet->prod_id)
?>

<h4 class="headline3"><?php echo $cproduct->prod_name ?></h4>
<div class="row">
<div class="large-4 columns">
    
    </div>
    <div class="large-8 columns">
        <div class="row">
            
            <div class='large-4 columns'><strong>Location</strong>:</div><div class='large-8 columns'><p><?php echo $cproduct->install_address ?></p></div>
            <div class='large-4 columns'><strong>Site Location</strong>:</div><div class='large-8 columns'><p> <?php echo $cproduct->install_city ?></p></div>
            <div class="large-4 columns"><strong>Branch</strong>:</div> <div class='large-8 columns'><p> <?php echo $cproduct->branch ?></p></div>
            <div class="large-4 columns"><strong>Operating System</strong>:</div> <div class="large-8 columns"><p> <?php echo $cproduct->myproduct->os ?></p></div>
        </div>
        
    </div>
  </div> 
<form id="frmpri" name="frmpri" method="post" action="<?php echo $uri->link("support/doTaskSupportWUpdate/".$this->myworksheet->id) ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Add Work Sheet</legend>
    <div id="transalert"></div>
    <div class="row">
      <div class="large-12 columns">
     <input type="hidden" id="prod_id" name="prod_id" value="<?php echo $this->myworksheet->prod_id;  ?>" /> 
      <input type="hidden" id="pgid" name="pgid" value="<?php echo $this->myworksheet->id; ?>" />
	
     </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Date</label>
        <input type="text" name="w_date" id="w_date" value="<?php echo $this->myworksheet->sheet_date ?>"/>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Time In</label>
        <input type="time" name="time_in" id="time_in" value="<?php echo $this->myworksheet->time_in ?>" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Time Out</label>
        <input type="time" name="time_out" id="time_out" value="<?php echo $this->myworksheet->time_out ?>" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Contact Person</label>
        <input type="text" name="contact_person" id="contact_person" placeholder="Contact Person" value="<?php echo $this->myworksheet->contact_person ?>" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>C.S.E. Name</label>
        <?php
        $emp = Employee::find_by_id($this->myworksheet->cse_emp_id);
        $empname = $emp->emp_lname." ".$emp->emp_fname;
        ?>
        <input type='hidden' name='cseid' id='cseid' value="<?php echo $this->myworksheet->cse_emp_id ?>" />
        <input type="text" name="cse_name" placeholder="C.S.E Name" id="cse_name" value="<?php echo $empname ?>" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Problem (Terminal Status)</label>
        <textarea name="problem" id="problem">
            <?php echo $this->myworksheet->problem  ?>
        </textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Causes</label>
        <textarea name="cause" id="cause"><?php echo $this->myworksheet->cause  ?>
        </textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Corrective Action</label>
        <textarea name="corrective_action" id="corrective_action"><?php echo $this->myworksheet->cause  ?>
        </textarea>
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
        <textarea name="cse_remark" id="cse_remark">
            <?php echo $this->myworksheet->corrective_action;  ?>
        </textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Client Remarks</label>
        <textarea name="client_remarks" id="client_remarks">
            <?php echo $this->myworksheet->client_remark  ?>
        </textarea>
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