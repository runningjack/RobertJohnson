<div class="panel callout">
	<h4 style="display:inline">Item Listing</h4><a href="<?php 
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
    
    ?>"><span class="button secondary right" style="display:inline"> &laquo;Back to Dashboard</span></a>
    <a href="<?php echo $uri->link("stockin/create") ?>"><span class="button secondary right" style="display:inline">Add New</span></a>
</div>
<div id="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>
<div id='emplisting'>
<?php echo $this->myvends; ?>
</div>