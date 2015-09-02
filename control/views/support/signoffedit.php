<div class="panel callout">
	<h4 style="display:inline">Add Sign Off</h4><a href="<?php 
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
    
    ?>"><span class="btn btn-primary right button" style="display:inline"> &laquo;Back To Dashboard</span></a>
    <a href="<?php echo $uri->link("support/signofflist") ?>"><span class="btn btn-danger  right button" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<form  method="post" id="frmsignoff" name="frmsignoff" action="<?php echo $uri->link("support/doUpdateSignOff") ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Add Sign Off Form</legend>
    <input type="hidden" id="pgid" name="pgid" value="<?php echo $this->mysignoff->id ?>" />
	<div id="transalert"></div>
    
    <div class="row">
      <div class="large-4 columns">
      <label>FORM ID <span class="red">*</span></label>
      <input type="text" id="wsid" name="wsid" value="<?php echo $this->mysignoff->form_id ?>" class="large-4 columns" />
     </div>  
    </div>
    
    
    <div class="row">
    
        <div class="large-6 columns">
            <label>Client Name <span class="red">*</span></label>
            <input type="text" id="clientname" name="clientname" value="<?php echo $this->mysignoff->client_name ?>" placeholder="Filter by Client Name" autocomplete="off" style="display: inline;" /><span id="clder"></span>
            <input type="hidden" name="clientid" id="clientid" value="<?php echo $this->mysignoff->client_id ?>" />
    <div id="mySearchContainer2" style="position: absolute;">
                    <div id="lcpsearchinner"></div>
                </div>
        </div>
    
    </div><!-- End of row -->
    
    
    <div class="row" id="pmydiv" >
        
        <div class="large-6 columns">
        <label>Product / Machine <span class="red">*</span></label>
            <label style="color: #fff;">Product</label>
            <input name="cprodname" id="cprodname" type="text"  value="<?php echo $this->mysignoff->prod_name ?>" placeholder="Filter by Product name / location" autocomplete="off" style="display: inline;" /><span id="plder"></span>
            <div id="mySearchContainer" style="position: absolute; background-color: #f58501;">
                    <div id="lcpsearchinner2"></div>
                </div>
            <input type="hidden" id="prod_id" name="prod_id" value="<?php echo $this->mysignoff->prod_id ?>" />
        </div>
    
    </div><!-- End of row -->
    <hr />
    
    
    
<div class="row">
      <div class="large-12 columns">
      <label>Technician Assigned <span class="red">*</span></label>
	<select id="staff_id" name="staff_id">
   
        <?php
	       if($this->techstaff){
	           foreach($this->techstaff as $technician){
	               if($technician->id == $this->mysignoff->employee_id){
	                   echo "<option selected ='selected' value='$technician->id_ $technician->emp_fname $technician->emp_lname $technician->emp_mname'>$technician->emp_fname $technician->emp_lname $technician->emp_mname</option>";
	               }else{
	                   echo "<option value='$technician->id_ $technician->emp_fname $technician->emp_lname $technician->emp_mname'>$technician->emp_fname $technician->emp_lname $technician->emp_mname</option>";
                   }
	           }
	       }
        ?>
   </select>
     </div>
    </div>
    
    
    
    
    
      
    

    <div class="row">
      <div class="large-12 columns">
        <label>Tested Cards<span class="red">*</span></label>
        <span>Mag. Stripe <input type="checkbox" name="mag_stripe" <?php echo $this->mysignoff->mag_stripe =="1" ? "value='1' checked='checked'" : "value='0'"  ?> ></span><span></span>
        <span>Verve card <input type="checkbox" name="verve" <?php echo $this->mysignoff->verve_card =="1" ? "value='1' checked='checked'" : "value='0'"  ?>></span><span></span>
        <span>Master Card <input type="checkbox" name="master_card" <?php echo $this->mysignoff->master_card =="1" ? "value='1' checked='checked'" : "value='0'"  ?> ></span><span></span>
        <span>Visa card <input type="checkbox" name="visa_card"  <?php echo $this->mysignoff->visa_card =="1" ? "value='1' checked='checked'" : "value='0'"  ?> ></span><span></span>
      </div>
    </div>
    
    <table width="100%" border="1">
      <tr>
        <th width="29%" scope="row">Cash Withdrawals (Saving and Current)</th>
        <td width="11%">
        	<select name="withdraw">
            
            <?php 
               echo $this->mysignoff->withdraw == "1" ? "<option value='1' selected='selected'>Yes</option>" : "<option value='0' selected='selected'>No</option>";
            ?>
                <option value='1'>Yes</option>
                <option value="0">No</option>
            </select>
        </td>
        <td width="60%">
        	<textarea name="withdraw_area"><?php echo $this->mysignoff->withdraw_comment ?></textarea>
        </td>
      </tr>
      <tr>
        <th scope="row">Balance Inquiry (Saving and Current)</th>
        <td>
        	<select name="balance">
            <?php 
               echo $this->mysignoff->balance == "1" ? "<option value='1' selected='selected'>Yes</option>" : "<option value='0' selected='selected'>No</option>";
            ?>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </td>
        <td><textarea name="balance_area"><?php echo $this->mysignoff->balance_comment ?></textarea></td>
      </tr>
      <tr>
        <th scope="row">Mini Statement Inquiry (Saving and Current)</th>
        <td>
        	<select name="statement">
            <?php 
               echo $this->mysignoff->statement == "1" ? "<option value='1' selected='selected'>Yes</option>" : "<option value='0' selected='selected'>No</option>";
            ?>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </td>
        <td><textarea name="statement_area"><?php echo $this->mysignoff->statement_comment ?></textarea></td>
      </tr>
      <tr>
        <th scope="row">Fund Transfer (Savings and Current)</th>
        <td>
        	<select name="transfer">
                <?php 
                   echo $this->mysignoff->trasfer == "1" ? "<option value='1' selected='selected'>Yes</option>" : "<option value='0' selected='selected'>No</option>";
                ?>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </td>
        <td><textarea name="transfer_area"><?php echo $this->mysignoff->transfer_comment ?></textarea></td>
      </tr>
      <tr>
        <th scope="row">Pin Change</th>
        <td>
        	<select name="pin_change">
                <?php 
                   echo $this->mysignoff->trasfer == "1" ? "<option value='1' selected='selected'>Yes</option>" : "<option value='0' selected='selected'>No</option>";
                ?>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </td>
        <td><textarea name="pin_change_area"><?php echo $this->mysignoff->pin_change_comment?></textarea></td>
      </tr>
      <tr>
        <th scope="row">Mobile Recharge</th>
        <td>
        	<select name="mobile_recharge">
                <?php 
                   echo $this->mysignoff->mobile_recharge == "1" ? "<option value='1' selected='selected'>Yes</option>" : "<option value='0' selected='selected'>No</option>";
                ?>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </td>
        <td><textarea name="mobile_recharge_area"><?php echo $this->mysignoff->mobile_recharge_comment ?></textarea></td>
      </tr>
    </table>

    
    <!--
<div class="row">
      <div class="large-12 columns">
        <label>Part Replaced <input type="checkbox" name="part_replaced" /></label>
      </div>
    </div>
-->
    
    <div class="row">
      <div class="large-12 columns">
        <label>Camera Installed</label>
        <select name="camera" class="large-2 columns">
            <?php 
                echo $this->mysignoff->camera_instal == "1" ? "<option value='1' selected='selected'>Yes</option>" : "<option value='0' selected='selected'>No</option>";
            ?>
        	<option value="1">Yes</option>
            <option value="0">No</option>
        </select>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Inverter Status</label>
        <textarea name="inverter"><?php echo $this->mysignoff->inverter_status ?></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Air Condition Status</label>
        <textarea name="air_cond"><?php echo $this->mysignoff->AC_status ?></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>ATM Room Condition</label>
        <textarea name="atm_room"><?php echo $this->mysignoff->ATM_room_cond ?></textarea>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Client Remark</label>
        <textarea name="client_remark"><?php echo $this->mysignoff->client_remark ?></textarea>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>CSE Remark</label>
        <textarea name="cse_remark"><?php echo $this->mysignoff->cse_remark ?></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Upload Scanned Form</label>
        <input type="file" name="signoffimage" />
        <input type="hidden" name="imgvalue" id="imgvalue" value="<?php echo $this->mysignoff->scan_url ?>"/>
      </div>
    </div>
    
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="btn btn-primary" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
