
<div id="myModal5" class="reveal-modal medium" data-animation="fade" style="background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px" >
<h4>Assign Corrective Maintenance Task</h4>
<hr />
<div id="searchdata2"  >
    <div class="large-12 columns">
        <div class="large-3 columns">
            <strong>Start Date</strong>
        </div>
        <div class="large-9 columns">
            
            <input type="date" name="taskdate" id="taskdate" />
        </div>
        
        
        
        <div class="large-3 columns">
            <strong>maintenance Type</strong>
        </div>
        <div class="large-9 columns">
            
            <select  name="mtype" id="mtype">
                <option value="Corrective"> Corrective Maintenance </option>
                <option value="Preventive"> Preventive Maintenance </option>
            </select>
        </div>
        
        
        <div class="large-3 columns">
            <strong>Issue</strong>
        </div>
        <div class="large-9 columns">
            <textarea id="tissue" name="tissue"> <?php echo $this->ticket->issue ?></textarea>
        </div>
        
        
        <div class="large-3 columns">
            <strong>Technician</strong>
        </div>
        <div class="large-9 columns">
            <select name="emp" id="emp">
            	<?php
				$employees = Employee::find_all();
				foreach($employees as $emp){
					echo "<option value='$emp->id'>$emp->emp_id; $emp->emp_fname $emp->emp_lname</option>";
				}
			     ?>
            </select>
            
        </div>
    </div>
    
   
    <div class="large-12 columns">
        <div class="large-3 columns">
        </div>
        <div class="large-9 columns">
            <button class="button" id="csave" name="csave">Save</button>
        </div>
    </div>
</div>
<a class="close-reveal-modal"><img src="public/icons/Close16.png" width="16" height="16" /></a>
</div>




<div class="panel callout">
	<h4 style="display:inline">Support</h4><span class="btn  right  btn-primary button" style="display:inline"><a href="<?php 
        global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("itdepartment/index");
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo $uri->link("support/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    ?>"> &laquo;Back To Dashboard</a></span><span class="btn  right  btn-primary button" style="display:inline"><a href="<?php echo $uri->link("support/ticketlist") ?>">Back to Listing</a></span>"
</div>
<div class="row">

<div id='ticketlisting'>
 <?php echo $this->myReplyData; ?>
</div>
</div>
<!--</div> -->