<div class="large-9 columns centre" role="conlarge-10t">
<!-- Table goes in the document BODY -->
<div class="panel callout">
	<h4 style="display:inline">New Vendor</h4>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("vendors/index") ?>"> &laquo;Back To Listing</a></span>
</div>
    <form action="<?php echo $uri->link("vendors/doCreate/") ?>" method="post"  name="frmEmp"  id="frmEmp" >
     <fieldset><div id="transalert"></div>
       	    <legend>Add New Vendor</legend>
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Vendor ID</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Enter Vendor ID" class="six"   name="vendid" id="vendid" required="required" />
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Company  <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Enter Company name" class="six" required='required'  name="compname" id="compname" />
    <div id="tm"></div>
    </div>
  </div>
  
  
 
 <fieldset>
 <legend>Contact Info</legend>
<div class="row">
    <div class="large-6 columns">
  <div class="row">
  <div class="large-12 columns">
 	<div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Contact Person</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder='Enter name of contact person' class="small-6" required='required'  name="contact" id="contact" />
    </div>
  </div>	
  </div>
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Address</label>
    </div>
    <div class="small-10 columns">
    <textarea class="six"   name="address" id="address"></textarea> 
    <div id="desc"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Country<span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
        <select id="country" name="country">
            <option value="">--SELECT COUNTRY--</option>
            <?php
                if($this->country){
                    foreach($this->country as $country){
                        echo "<option value='$country->country_id,$country->name'>$country->name</option>";
                    }
                }
            ?>
            <option value=""></option>            
        </select>
    <div id="errcount"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Region/State</label>
    </div>
    <div class="small-10 columns">
        <select id="state" name="state">
            <option value="">--SELECT COUNTRY--</option>
        </select>
    <div id="errstate"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">City</label>
    </div>
    <div class="small-10 columns">
        <select id="city" name="city">
            <option value="">--SELECT COUNTRY--</option>
        </select>
    <div id="errscity"></div>
    </div>
  </div>
  </div>
  <div class="large-6 columns">
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Telephone<span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
  <input type="text" placeholder='Company Phone' class="large-2 columns"  name="phone" id="phone" required="required" />
    <div id="errphone"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Email<span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="email" placeholder='Enter Email' class="large-2 columns" required='required'  name="email" id="email" />
    <div id="erremail"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Account No</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder='Enter Account Number' class="small-6" required='required'  name="accno" id="accno" />
    </div>
  </div>



  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Website</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder='Enter Company Website' class="small-6" required='required'  name="website" id="website" />
    </div>
  </div>
 </div>
 </div>
</fieldset><!-- End of lareg 12 --> 
  
  
    

    <div class="row">
    
   
          <input type="hidden" name="task" id="task" value="<?php //echo (isset($_GET['task']) && !empty($_GET['task'])) ? $_GET['task'] : "" ?>">
          <input type="hidden" name="pgid" id="pgid" value="<?php //echo $this->myrole->role_id ?>" />
        
           
       <input type="submit" class="button push-2" name="save" value="save Record" id="save"/>
          	 </div>    
      	 </fieldset>
        </form>
       
    </div>