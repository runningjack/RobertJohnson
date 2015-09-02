<div class="panel callout">
	<h4 style="display:inline">Update Client</h4><a href="<?php 
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
    <a href="<?php echo $uri->link("clients/index") ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<form id="frmAddClient" method="post" action="<?php echo $uri->link("clients/doUpdate") ?>" >
  <fieldset><div id="transalert"></div>
    <legend>Update Client</legend>

    <div class="row">
      <div class="large-12 columns">
        <label>Name<span class="red">*</span></label>
        <input type="text" placeholder="Client Name" name="names" id="names" value="<?php echo $this->client->name ?>" />
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Address</label>
        <input type="text" placeholder="Client Address" name="addy" id="addy" value="<?php echo $this->client->addy ?>"  />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Phone</label>
        <input type="text" placeholder="Client Phone" name="phone" id="phone" value="<?php echo $this->client->phone ?>"  />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Email</label>
        <input type="text" placeholder="Client Email" name="email" id="email" value="<?php echo $this->client->email ?>"  />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Username</label>
        <input type="text" placeholder="Client username" name="username" value="<?php echo $this->client->username ?>"  />
      </div>
    </div>
    
    
<div class="row">
      <div class="large-12 columns">
        <label>Password</label>
        <input type="password" placeholder="Client Password" name="password" id="password" value="<?php echo $this->client->password ?>" />
      </div>
    </div>

    
    <div class="row">
      <div class="large-12 columns">
        <label>Password</label>
        <input type="password" placeholder="Client Password" id="r_password" name="r_password" value="<?php echo $this->client->password ?>" />
      </div>
    </div>

    <div class="row">
      <div class="large-4 columns">
        <label>Visibility</label>
        <select name="visible" id="visible">
        	<option value="show" <?php echo $this->client->visible == 'show' ? 'selected="selected"' :"" ?>>Show</option>
            <option value="hide" <?php echo $this->client->visible == 'hide' ? 'selected="selected"' :"" ?>>Hide</option>
        </select>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Additional Information</label>
        <textarea placeholder="Additional Information" name="descr" id="descr"><?php echo $this->client->descr ?></textarea>
        <input type="hidden" name="client_id" id="client_id" value="<?php echo $this->client->id ?>" />
      </div>
    </div>
    
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="button" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
