
<div class="panel callout">
	<h4 style="display:inline">Sign off Form Listing</h4>
    <a href="<?php echo $uri->link("support/addsignoff") ?>"><span class="button secondary button right" style="display:inline">Add New</span></a>
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
<div id="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>
<div id='emplisting'>
<?php echo $this->myvends; ?>
</div>  