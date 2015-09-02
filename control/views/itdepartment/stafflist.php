
<div class="panel callout">
	<h4 style="display:inline">Employee Listing</h4>
    <span class="button secondary button right" style="display:inline"><a href="<?php echo $uri->link("employees/create") ?>">Add New</a></span>
    <a href="<?php 
        global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("dashboard/index");
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo $uri->link("dashboard/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    
    ?>"><span class="btn btn-primary button right" style="display:inline"> &laquo;Back To Dashboard</span></a>
</div>
<div id='transalert'></div>
<div id='emplisting'>
<?php echo $this->myemployee; ?>
</div>

</div>
  