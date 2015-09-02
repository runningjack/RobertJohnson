<div class="panel callout">
	<h4 style="display:inline">Reports</h4><a href="<?php 
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
    ?>"><span class="button secondary right" style="display:inline"> &laquo;Back to Dashboard</span></a>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("stockitems/index") ?>"> &laquo;Back To Listing</a></span>
</div>
<div style="margin: 10px;">
<strong>Issues Statstical Analysis for the month</strong>
        <div id="pie1" style="max-height:350px;max-width:350px; "></div>
        <br />



</div>

