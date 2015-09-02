
<div class="panel callout">
	<h4 style="display:inline">Maintain Client Products</h4><a href="<?php 
    global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("dashboard/index");
    }elseif($session->rolename=="Customer Support Services" && in_array("support", $session->privil)){
        echo $uri->link("dashboard/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
     
    
    
    ?>"><span class="button secondary right" style="display:inline"> &laquo;Back to Dashboard</span></a>
    <a href="<?php echo $uri->link("clientproduct/index") ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
</div>
    <form action="<?php echo $uri->link("clientproduct/doUpdate/") ?>" method="post"  name="frmEmprtt"  id="frmEmpdfd" >
     <fieldset><div id="transalert"></div>
       	    <legend>Modify Product</legend>
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Client <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Enter Client Name" class="six" value="<?php echo $this->myproduct->client_name ?>"   name="clientname" id="clientname" required="required" style="display: inline;" /><span id="clder" style="margin: 0;padding: 0; "></span>
    <input type="hidden" name="clientid" id="clientid" value="<?php echo $this->myproduct->client_id ?>" />
    <div id="mySearchContainer2" style="position: absolute; background-color: #f58501;">
                    <div id="lcpsearchinner"></div>
                </div>
    <div id="cm"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Product  <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Enter Product name" class="six" required='required' value="<?php echo $this->myproduct->prod_name ?>"  name="prodname" id="prodname" required="required style="display: inline;" /><span id="plder" style="margin: 0;padding: 0; "></span>
    <div id="mySearchContainer" style="position: absolute; background-color: #f58501;">
                    <div id="lcpsearchinner2"></div>
                </div>

    <input type="hidden" name="prodid" id="prodid" value="<?php echo $this->myproduct->prod_id ?>" />
    <div id="tm"></div>
    </div>
  </div>



  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Serial No  </label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Enter Product name" class="six"   name="serial" id="serial" value="<?php echo $this->myproduct->prod_serial ?>" />
    <div id="tm"></div>
    </div>
  </div>

  


  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Address  <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <textarea class="six"   name="address" id="address"><?php echo $this->myproduct->install_address ?></textarea> 
    <div id="desc"></div>
    </div>
  </div>


  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Country  <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <select id="country" name="country">
            
            <?php
                if($this->country){
                    foreach($this->country as $country){
                        if((trim($this->myproduct->install_country) == $country->name) ) {
                          echo "<option selected='selected' value='".$country->country_id.",".$country->name."' >$country->name </option>";
                        } 
                        echo "<option value='".$country->country_id,$country->name."'>$country->name</option>";
                    }
                }
            ?>
                     
        </select>
    <div id="errcount"></div>
    </div>
  </div>


  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Region/State  <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <select id="state" name="state">
            <option selected="selected" value="<?php echo $this->myproduct->install_state ?>" ><?php echo $this->myproduct->install_state ?></option>
        </select>
    <div id="errstate"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Installation Status<span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <select id="instatus" name="instatus">
            <option value="">--SELECT STATUS--</option>
            <?php
	/**
 * if(!empty($this->myproduct->status) && $myproduct->install_country == $country) {
 *                             echo "<option selected='selected' value='".$country->country_id.",".$this->myproduct->install_country."' >$this->myproduct->install_country </option>";
 *                         }
 */
?>
    </select>
    <div id="errstate"></div>
    </div>
  </div>


<fieldset>
<legend>Fill this section for ATM Machines</legend>


<div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Area  <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <select id="areaname" name="areaname">
            <option value="">--SELECT AREA--</option>
             <?php
        
        foreach($this->area as $area){
            
            if((trim($this->myproduct->install_city) == $area->name) ) {
                          echo "<option selected='selected' value='".$area->area_id.",".$area->name."' >$area->name </option>";
                        } 
            echo "<option value='".$area->id.",". $area->name."'>$area->name</option>";
        }
        ?>
        </select>
    <div id="errarea"></div>
    </div>
  </div>
  
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Region  <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <select id="sregion" name="sregion">
            <option value="<?php echo  $this->myproduct->install_city ?>"><?php echo  $this->myproduct->install_city ?></option>
             <option value="Other">Other</option>
        </select>
    <div id="errregion"></div>
    </div>
  </div>
  

<input type="hidden" name="city" id="city" value="<?php echo  $this->myproduct->install_city ?>" />




<div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Location</label>
    </div>
    <div class="small-10 columns">
        <input type="text" name="city" id="city" value="<?php echo  $this->myproduct->install_city ?>" />
    <div id="errscity"></div>
    </div>
  </div>

  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Site  <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <select id="site" name="site">
                 <?php
	echo (!empty($this->myproduct->branch) ) ?
                            "<option selected='selected' value='".$this->myproduct->branch."' >".$this->myproduct->branch." </option>"
                        : "<option elected='selected' value=''>--SELECT SITE--</option>"
?>
            <option value="Branch">Branch</option>
            <option value="Outbranch">Outbranch</option>
        </select>
    <div id="errsite"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Machine Type  </label>
    </div>
    <div class="small-10 columns">
    <select id="mmode" name="mmode">
              <?php
	echo (!empty($this->myproduct->atm_type) ) ?
                            "<option selected='selected' value='".$this->myproduct->atm_type."' >".$this->myproduct->atm_type." </option>"
                        : "<option elected='selected' value=''>--SELECT ATM MODEL/TYPE--</option>"
?>
            <option value="Through Wall">TTW; Through Wall</option>
            <option value="Lobby">Lobby</option>
        </select>
    <div id="errmmode"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Operating System Installed  <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <select id="os" name="os">
            
             <?php
	echo (!empty($this->myproduct->os) ) ?
                            "<option selected='selected' value='".$this->myproduct->os."' >".$this->myproduct->os ."</option>"
                        : "<option selected='selected' value=''>--SELECT OPERATING SYSTEM--</option>"
?>
            <option value="Windows CE">Windows CE</option>
            <option value="Windows XP">Windows XP</option>
            <option value="Windows Vista">Windows Vista</option>
            <option value="Windows 7">Windows 7</option>
            <option value="Windows 8">Windows 8</option>
             <option value="LINUX OS">LINUX OS</option>
             <option value="Apple IOS">Apple IOS</option>
            
            
        </select>
    <div id="erros"></div>
    </div>
  </div>
  
  
</fieldset>

 <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Selling Price</label>
    </div>
    <div class="small-10 columns">
        <input type="text" name="amount" id="amount" value="<?php echo $this->myproduct->selling_price ?>" />
    <div id="errsamount"></div>
    </div>
  </div> 
  
    <div class="row">
    
   
          <input type="hidden" name="task" id="task" value="<?php //echo (isset($_GET['task']) && !empty($_GET['task'])) ? $_GET['task'] : "" ?>">
          <input type="hidden" name="pgid" id="pgid" value="<?php echo $this->myproduct->id ?>" />
        
           
       <input type="submit" class="button push-2" name="save" value="save Record" id="save"/>
          	 </div>    
      	 </fieldset>
        </form>