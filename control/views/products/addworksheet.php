
<div class="panel callout">
	<h4 style="display:inline">Add Work Sheet</h4>
    <a href="<?php echo $uri->link("products/view/".$this->prod->id) ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<form id="frmAddWorkSheet" method="post" action="<?php echo $uri->link("products/createworksheet") ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Add Work Sheet</legend>
	<input type="hidden" name="prod_id" value="<?php echo $this->prod->id; ?>" />
    
    
    <div class="row">
      <div class="large-12 columns">
        <label>Date</label>
        <input type="date" name="w_date" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Time In</label>
        <input type="time" name="time_in" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Time Out</label>
        <input type="time" name="time_out" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Contact Person</label>
        <input type="text" name="contact_person" placeholder="Contact Person" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>C.S.E. Name</label>
        <input type="text" name="cse_name" placeholder="C.S.E Name" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Problem (Terminal Status)</label>
        <textarea name="problem"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Causes</label>
        <textarea name="cause"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Corrective Action</label>
        <textarea name="corrective_action"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Part Changed <input type="checkbox" name="part_changed" value="1" /></label>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>CSE Remark</label>
        <textarea name="cse_remark"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Client Remarks</label>
        <textarea name="client_remarks"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Upload Scanned Form</label>
        <input type="file" name="worksheetimage" multiple />
      </div>
    </div>
    
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="button" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
</div>
