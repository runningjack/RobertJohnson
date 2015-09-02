<div class="panel callout">
	<h4 style="display:inline">Task Schedule Listing</h4><a href="<?php
        global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("itdepartment/index");
    }elseif($session->rolename=="Customer Support Services" && in_array("support", $session->privil)){
        echo $uri->link("support/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    ?>"><span class="btn  right  btn-primary button" style="display:inline"> &laquo;Back To Dashboard</span></a>
    <a href="<?php echo $uri->link("support/addworksheet") ?>"><!--
<span class="btn btn-danger  right button" style="display:inline">Add New</span>
--></a>
</div>

<div id="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>

<div class="row filterbox" >
    <div class="large-12 columns" >
    
        <div class="large-3 columns">
            <label>Client Name</label>
            <input type="text" id="clientname" name="clientname" placeholder="Filter by Client Name" autocomplete="off" style="display: inline;" /> <span id="clder" style="margin: 0;padding: 0; "></span>
            <input type="hidden" name="clientid" id="clientid" />
    <div id="mySearchContainer2" style=" position: absolute; ">
                    <div id="lcpsearchinner"></div>
                </div>
        </div>
        
        <div class="large-3 columns" id="pmydiv" style="display: none;">
            
            <label style="color: #fff;">Client Product</label>
            <input name="cprodname" id="cprodname" type="text" placeholder="Filter by Product name / location" autocomplete="off" style="display: inline;" /><span id="plder"></span>
            <div id="mySearchContainer" style="position: absolute; background-color: #f58501;">
                    <div id="lcpsearchinner2"></div>
                </div>
            <input type="hidden" id="prod_id" name="prod_id" value="<?php  ?>" />
       
        </div>
        
        <div class="large-3 columns">
            <label>STATUS</label>
            <select id="status" name="status" class="large-12 columns">
            <option value="">--SELECT STATUS--</option>
            <option value="Open">Open</option> 
            <option value="Closed">Closed</option>
        </select>
        </div>
        <div class="large-3 columns">
            <label>Region/City/Address</label>
            <input type="text" id="location" name="location" placeholder="Enter City" />
        </div>
        
        <div class="large-3 columns">
            <label>Issues</label>
            <input type="text" id="issue" name="issue" placeholder="" />
        </div>
        
        <br clear="all" />
        <div class="large-9 columns left">
        <hr />
            <a href="#" id="tskallrec" class="" style="color: #000;">View All Records</a>
        </div>
        <div class="large-3 columns right">
            <a href="#" id="tskfilter" class="btn btn-danger button">Filter Record</a>
        </div>
    </div>
    
</div>



<div id='emplisting'>
<?php echo $this->myvends; ?>
</div>


  