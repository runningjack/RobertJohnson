
<div class="panel callout">
	<h4 style="display:inline">Clients Product Listing</h4><a href="
    <?php 
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
    <a href="<?php echo $uri->link("clientproduct/create") ?>"><span class="button secondary right" style="display:inline">Add New</span></a>
</div>
<div id="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>
<div class="row filterbox" >
    <div class="large-12 columns" >
        <div class="large-3 columns">
            <label style="color: #fff;">Product</label>
            <small id="tm" class=""></small>
            <input name="prodname" id="prodname" type="text" placeholder="Filter by Product name" autocomplete="off" style="display: inline;" /><span id="plder" style="margin: 0;padding: 0; "></span>
            <div id="mySearchContainer" style="position: absolute;">
                    <div id="lcpsearchinner2"></div>
                </div>
            <input type="hidden" name="prodid" id="prodid" />
        </div>
        <div class="large-3 columns">
            <label>Client Name</label>
            <input type="text" id="clientname" name="clientname" placeholder="Filter by Client Name" autocomplete="off" style="display: inline;" /> <span id="clder" style="margin: 0;padding: 0; "></span>
            <input type="hidden" name="clientid" id="clientid" />
    <div id="mySearchContainer2" style="position: absolute; ">
                    <div id="lcpsearchinner"></div>
                </div>
        </div>
        <div class="large-3 columns">
            <label>Area</label>
            <select id="areaname" name="areaname" class="large-12 columns">
            <option value="">--SELECT AREA--</option>
             <?php
        
                foreach($this->area as $area){
                    echo "<option value='".$area->name."'>$area->name</option>";
                }
            ?>
        </select>
        </div>
        <div class="large-3 columns">
            <label>Region/City/Address</label>
            <input type="text" id="location" name="location" placeholder="Enter City" />
        </div>
        <div class="large-3 columns left">
            <label>Machine Type</label>
            <select id="machine" name="machine" class="large-12 columns">
                <option value="">--SELECT Type--</option>
                <option value="Through Wall">TTW; Through Wall</option>
                <option value="Lobby">Lobby</option>
            </select>
        </div>
        <br clear="all" />
        <div class="large-9 columns left">
        <hr />
            <a href="#" id="allrec" class="" style="color: #000;">View All Records</a>
        </div>
        <div class="large-3 columns right">
            <a href="#" id="cpfilter" class="btn btn-danger button">Filter Record</a>
        </div>
    </div>
    
</div>
<div id='prodlisting' style="margin:20px 10px;">
<?php echo $this->myprods; ?>
</div>


  