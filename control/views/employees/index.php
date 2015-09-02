

<!-- Table goes in the document BODY -->
<div class="panel callout">
	<h4 style="display:inline">Employee Listing</h4>
    <a href="<?php echo $uri->link("employees/create") ?>"><span class="button secondary right" style="display:inline">Add New</span></a>
    <a href="<?php 
    global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("dasboard/index");
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo $uri->link("dashboard/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
     
    ?>"><span class="btn btn-primary button right" style="display:inline"> &laquo;Back To Dashboard</span></a>
</div>
<div id='transalert'></div>
<div class="row filterbox" >
    <div class="large-12 columns" >
        <div class="large-3 columns">
            <label>First name/Last name</label>
            <input type="text" id="empname" name="empname" placeholder="Filter Record by Firstname or Lastname" autocomplete="off" />
            
        </div>
        
        <div class="large-3 columns">
            <label>Department</label>
            <select id='empdept' name='empdept' class="large-12 columns">
                           <option value='' selected='selected'>--SELECT DEPARTMENT--</option>
                            <?php
                            if($this->depts){
                                foreach($this->depts as $dept){
								    echo "<option value='{$dept->id}' >$dept->dept_name</option>" /*: ""*/;
								}
                            }
                            ?></select>
        </div>
        
        <div class="large-3 columns" >
            <label>Employee Role</label>
            <select id='emppost' name='emppost' class="large-12 columns">
                                 <option value='' selected='selected'>--SELECT DEPARTMENT--</option>
                            <?php
                            	if($this->role){
                                    foreach($this->role as $role){
									   echo "<option value='{$role->role_id}' >$role->role_name</option>" /*: ""*/;
									}
                                }
                            ?>
                            </select>
        </div>
        <br clear="all" />
        <div class="large-9 columns left">
        <hr />
            <a href="#" id="empallrec" class="" style="color: #000;">View All Records</a>
        </div>
        <div class="large-3 columns right">
            <a href="#" id="empfilter" class="btn btn-danger button">Filter Record</a>
        </div>
    </div>
</div>
<div id='emplisting'>
<?php echo $this->myemployee; ?>
</div>



  