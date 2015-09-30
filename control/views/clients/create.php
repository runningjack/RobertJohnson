<div class="panel callout">
	<h4 style="display:inline">Add New Client</h4><a href="<?php 
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

<form id="frmAddClient" method="post" action="<?php echo $uri->link("clients/doCreate") ?>" enctype="multipart/form-data" >

  <fieldset><div id="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>
    <legend>Create Client</legend>

    <div class="row">
      <div class="large-12 columns">
        <label>Name<span class="red">*</span></label>
        <input type="text" placeholder="Client Name" name="name" />
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Address</label>
        <input type="text" placeholder="Client Address" name="addy" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Phone</label>
        <input type="text" placeholder="Client Phone" name="phone" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Email</label>
        <input type="text" placeholder="Client Email" name="email" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Username</label>
        <input type="text" placeholder="Client username" name="username" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Password</label>
        <input type="password" placeholder="Client Password" name="password" />
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Repeat Password</label>
        <input type="password" placeholder="Repeat Password" name="r_password" />
      </div>
    </div>

    <div class="row">
      <div class="large-4 columns">
        <label>Visibility</label>
        <select name="visible">
        	<option value="show">Show</option>
            <option value="hide">Hide</option>
        </select>
      </div>
    </div>

      <div class="row">
          <div class="large-12 columns">
              <label>Logo</label>
              <input type="file"  name="fupload" />
          </div>
      </div>
    
    <div class="row">
      <div class="large-12 columns">
        <label>Additional Information</label>
        <textarea placeholder="Additional Information" name="desc"></textarea>
      </div>
    </div>
    
    <div class="row">
    	<div class="large-4 columns">
        	<input type="submit" class="button" id="save" name="save"  />
        </div>
    </div>
</fieldset>
</form>
