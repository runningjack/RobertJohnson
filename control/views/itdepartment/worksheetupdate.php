<div class="panel callout">
	<h4 style="display:inline">Add Work Sheet</h4>
    <a href="<?php echo $uri->link("itdepartment/schedulelist") ?>"><span class="btn btn-danger button right" style="display:inline"> &laquo;Back To Listing</span></a>
    <a href="<?php 
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
    
    
     ?>"><span class="btn btn-primary button right" style="display:inline"> &laquo;Back To Dashboard</span></a>
</div>

<?php
       $cproduct = Cproduct::find_by_id((int)preg_replace('#[^0-9]#i','',$this->schedu->prod_id));
?>

<h4 class="headline3" style="display:"><?php echo $cproduct->prod_name ?> <span style="display: inline; float: right;">FORM NO:<?php  echo $this->schedu->id  ?></span></h4>
<div class="row">
<div class="large-4 columns">
    <img src="public/img/91_1380800432.jpg" width="235" height="204" />
    </div>
    <div class="large-8 columns">
        <div class="row">
            
            <div class='large-4 columns'><strong>Location</strong>:</div><div class='large-8 columns'><p><?php echo $cproduct->install_address ?></p></div>
            <div class='large-4 columns'><strong>Site Location</strong>:</div><div class='large-8 columns'><p> <?php echo $cproduct->install_city ?></p></div>
            <div class="large-4 columns"><strong>Branch</strong>:</div> <div class='large-8 columns'><p> <?php echo $cproduct->branch ?></p></div>
            <div class="large-4 columns"><strong>Operating System</strong>:</div> <div class="large-8 columns"><p> <?php echo $cproduct->myproduct->os ?></p></div>
        </div>
        
    </div>
    <br clear="all" />
    <div class="row">
        <div class="large-4 columns push-4"><h5 class="headline4">Schedule Date: <?php
         
         echo $this->schedu->s_date 
         
         ?> </h5></div>
    </div>
  </div> 

<form id="frmpri" name="frmpri" method="post" action="<?php echo $uri->link("itdepartment/doCreateWorkSheetEmp/".$this->schedu->id) ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Add Work Sheet</legend>
    <div id="transalert"></div>
    <div class="row">
      <div class="large-12 columns">
     
      <input type="hidden" id="prod_id" name="prod_id" value="<?php echo $cproduct->prod_id ?>" />
      <input type="hidden" id="wsid" name="wsid" value="<?php echo $this->schedu->id ?>" />
	
     </div>
    </div>
    
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
        <label>C.S.E. Name</label>
        <input type="text" name="cse_name" placeholder="C.S.E Name" id="cse_name" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Problem (Terminal Status)</label>
        <textarea name="problem" id="problem"></textarea>
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
