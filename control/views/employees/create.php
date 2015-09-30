<div class="panel callout">
	<h4 style="display:inline">New Employee</h4>
    <a href="<?php echo $uri->link("employees/index") ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
    <?php
    global $session;
    //echo $session->department;
    //print_r($session->privil);

    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
   echo" <a href='".  $uri->link("dasboard/index")."'><span class='btn btn-primary button right' style='display:inline'> &laquo;Back To Dashboard</span></a>";
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo" <a href='".  $uri->link("dashboard/index")."'><span class='btn btn-primary button right' style='display:inline'> &laquo;Back To Dashboard</span></a>";
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){

    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo" <a href='".  $uri->link("dashboard/index") ."'><span class='btn btn-primary button right' style='display:inline'> &laquo;Back To Dashboard</span></a>";
    }

    ?>
</div>
    <form action="<?php echo $uri->link("employees/doCreate/") ?>" method="post"  name="frmEmp"  id="frmEmp"  >
     <fieldset><div id="transalert"></div>
       	    <legend>Add New Employee</legend>
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Title</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Title" class="six"   name="title" id="title" />
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Firstname <span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="firstname" class="six" required='required'  name="fname" id="fname" />
    <div id="fnm"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Lastname<span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="lastname" class="six" required='required'  name="lname" id="lname" />
    <div id="lnm"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Middlename</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Middle name" class="six"   name="mname" id="mname" />
    <div id="lnm"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Date of Birth</label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Date of Birth" class="six"   name="dob" id="dob" />
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Gender</label>
    </div>
    <div class="small-10 columns">
    <select id="gender"  name="gender">
        <option >--SELECT GENDER--</option>
        <option value="Female">Female</option>
        <option value="Male">Male</option>
        
      </select>
    </div>
  </div>
  
   <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Marital Statu</label>
    </div>
    <div class="small-10 columns">
    <select id="mstatus" name="mstatus">
        <option value="" >--SELECT Status--</option>
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Divorced">Divorced</option>
        <option value="Widow">Widow</option>
        <option value="Widower">Widower</option>
        
      </select>
    </div>
  </div>
  
  
   <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Religion</label>
    </div>
    <div class="small-10 columns">
    <select id="religion" name="religion">
        <option value="" >--SELECT RELIGION--</option>
        <option value="Christianity">Christianity</option>
        <option value="Islam">Islam</option>
        <option value="Othres">Others</option>      
      </select>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Address<span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <textarea id="address" name="address" rows="10" cols="10" required></textarea>
    <div id="add"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Nationality</label>
    </div>
    <div class="small-10 columns">
    <select id="nationality" name="nationality">
        <option value="" >--SELECT Nationality--</option>
        <option value="Nigerian">Nigerian</option>
        <option value="Othres">Others</option>      
      </select>
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">State of Origin</label>
    </div>
    <div class="small-10 columns">
    <select id="soo" name="soo">
        <option value="" >--SELECT STATE OF ORIGIN--</option>
        <?php
            if($this->state){
                foreach($this->state as $state){
                    echo "<option value='{$state->zone_id},{$state->name}'>$state->name</option>";
                }
           }
       ?>    
      </select>
      <div id="fsoo"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Local Government Area</label>
    </div>
    <div class="small-10 columns">
    <select id="lga" name="lga">
        <option value="" >--SELECT LGA--</option>
       
        <option value="Othres">Others</option>      
      </select>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Telephone(s)<small>seperate telephone numbers with comma(,)</small><span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="text" placeholder="Telephone" class="six" required='required'  name="phone" id="phone" />
    <div id="tph"></div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="small-2 columns">
    <label for="right-label" class="left inline">Email<span class="red">*</span></label>
    </div>
    <div class="small-10 columns">
    <input type="email" placeholder="Email" class="six" required='required'  name="email" id="email" />
    <div id="femail"></div>
    </div>
  </div>
  
 
  

    <div class="row">
    
   
          <input type="hidden" name="task" id="task" value="<?php //echo (isset($_GET['task']) && !empty($_GET['task'])) ? $_GET['task'] : "" ?>">
          <input type="hidden" name="pgid" id="pgid" value="<?php //echo $this->myrole->role_id ?>" />
        
           
       <input type="submit" class="button offset-by-five" name="submit" value="save" id="submit"/>
          	 </div>    
      	 </fieldset>
        </form>
       
 