<div class="panel callout">
	<h4 style="display:inline">Add Sign Off</h4>
    <a href="<?php echo $uri->link("products/view/".$this->prod->id) ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<form id="frmAddSignOff" method="post" action="<?php echo $uri->link("products/createsignoff") ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Add Sign Off Form</legend>
	<input type="hidden" name="prod_id" value="<?php echo $this->prod->id; ?>" />
    <div class="row">
      <div class="large-12 columns">
        <label>Tested Cards<span class="red">*</span></label>
        <span>Mag. Stripe <input type="checkbox" name="mag_stripe" value="1"></span><span></span>
        <span>Verve card <input type="checkbox" name="verve" value="1"></span><span></span>
        <span>Master Card <input type="checkbox" name="master_card" value="1"></span><span></span>
        <span>Visa card <input type="checkbox" name="visa_card" value="1"></span><span></span>
      </div>
    </div>
    
    <table width="100%" border="1">
      <tr>
        <th width="29%" scope="row">Cash Withdrawals (Saving and Current)</th>
        <td width="11%">
        	<select name="withdraw">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </td>
        <td width="60%">
        	<textarea name="withdraw_area"></textarea>
        </td>
      </tr>
      <tr>
        <th scope="row">Balance Inquiry (Saving and Current)</th>
        <td>
        	<select name="balance">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </td>
        <td><textarea name="balance_area"></textarea></td>
      </tr>
      <tr>
        <th scope="row">Mini Statement Inquiry (Saving and Current)</th>
        <td>
        	<select name="statement">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </td>
        <td><textarea name="statement_area"></textarea></td>
      </tr>
      <tr>
        <th scope="row">Fund Transfer (Savings and Current)</th>
        <td>
        	<select name="transfer">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </td>
        <td><textarea name="transfer_area"></textarea></td>
      </tr>
      <tr>
        <th scope="row">Pin Change</th>
        <td>
        	<select name="pin_change">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </td>
        <td><textarea name="pin_change_area"></textarea></td>
      </tr>
      <tr>
        <th scope="row">Mobile Recharge</th>
        <td>
        	<select name="mobile_recharge">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </td>
        <td><textarea name="mobile_recharge_area"></textarea></td>
      </tr>
    </table>

    
    <div class="row">
      <div class="large-12 columns">
        <label>Part Replaced <input type="checkbox" name="part_replaced" /></label>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Camera Installed</label>
        <select name="camera" class="large-2 columns">
        	<option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Inverter Status</label>
        <textarea name="inverter"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Air Condition Status</label>
        <textarea name="air_cond"></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>ATM Room Condition</label>
        <textarea name="atm_room"></textarea>
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
        <label>Upload Scanned Form</label>
        <input type="file" name="signoffimage" multiple />
      </div>
    </div>
    
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="button" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>

