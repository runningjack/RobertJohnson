<div class="panel callout">
	<h4 style="display:inline">Item Listing</h4><a href="<?php 
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
    ?>"><span class="button secondary right" style="display:inline"> &laquo; Back to Dashboard</span></a>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("stockitems/create") ?>">Add New</a></span>
</div>
<div id="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>

<div class="row filterbox" >
    <div class="large-12 columns" >
        
        <div class="large-3 columns">
            <label>Item Name</label><input type="hidden" name="itemid" id="itemid" />
            <input type="text" id="itemname" name="itemname" placeholder="Filter by Item Name" autocomplete="off" style="display: inline;" /><span id="clder" style="margin: 0;padding: 0; "></span>
            
    <div id="mySearchContainer" style="position: absolute;">
                    <div id="lcpsearchinner"></div>
                </div>
        </div>
        
        <div class="large-3 columns">
            <label>Name/Description</label>
            <input type="text" id="namedes" name="namedes"  />
        </select>  
        </div>
        <div class="large-3 columns">
        <label>price</label>
            <select  id="cond" name="cond" class="large-3 columns" style="display: inline;width: 55%;"  >
                <option value="=" selected="selected">Equal to</option>
                <option value=">">Greater Than</option>
                <option value="<">Less Than</option>
                <option value=">=">Greater Than or Equal to</option>
                <option value="<=">Less Than or Equal to</option>
                <option value="=">Equal to</option>
                <option value="!=">Not Equal to</option>
            </select>
            <input type="text" id="prices" name="prices" class="right" style="display: inline; width: 45%; float:right"  />
        </div>
        
        
        <br clear="all" />
        <div class="large-9 columns left">
        <hr />
            <a href="#" id="itallrec" class="" style="color: #000;">View All Records</a>
        </div>
        <div class="large-3 columns right">
            <a href="#" id="itfilter" class="btn btn-danger button">Filter Record</a>
        </div>
    </div>
    
</div>


<div id='emplisting'>
<?php echo $this->myitems; ?>
</div>