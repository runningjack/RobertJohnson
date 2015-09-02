<div class="panel callout">
	<h4 style="display:inline">Work Form Listing</h4><a href="<?php
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
    ?>"><span class="btn  right button btn-primary " style="display:inline"> &laquo;Back To Dashboard</span></a>
    <a href="<?php echo $uri->link("support/addnewws") ?>">
<span class="btn btn-danger  right button" style="display:inline">Add New</span>
</a>
</div>
<div id="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>
<div class="row filterbox" >
    <div class="large-12 columns" >
        <!--
<div class="large-3 columns">
            <label style="color: #fff;">Product</label>
            <input name="prodname" id="prodname" type="text" placeholder="Filter by Product name" autocomplete="off" />
            <div id="mySearchContainer" style="position: absolute; background-color: #f58501;">
                    <div id="lcpsearchinner2"></div>
                </div>
            <input type="hidden" name="prodid" id="prodid" />
        </div>
-->
        <div class="large-3 columns">
            <label>Client Name</label>
            <input type="text" id="clientname" name="clientname" placeholder="Filter by Client Name" autocomplete="off" />
            <input type="hidden" name="clientid" id="clientid" />
    <div id="mySearchContainer2" style="position: absolute;">
                    <div id="lcpsearchinner"></div>
                </div>
        </div>
        <div class="large-3 columns">
            <label>Problem</label>
            <input type="text" id="issue" name="issue"  />
        </div>
        <div class="large-3 columns">
            <label>Status</label>
            <select id="status1" name="status1" class="large-12 columns">
            <option value="" selected="selected">--SELECT STATUS--</option>
            <option value="Open">Open</option>
            <option value="Closed">Closed</option>
        </select>
            
        </div>
        
        <br clear="all" />
        <div class="large-9 columns left">
        <hr />
            <a href="#" id="allrec" class="" style="color: #000;">View All Records</a>
        </div>
        <div class="large-3 columns right">
            <a href="#" id="wsfilter" class="btn btn-danger button">Filter Record</a>
        </div>
    </div>
    
</div>


<div id='emplisting'>
<?php echo $this->myvends; ?>
</div>

  