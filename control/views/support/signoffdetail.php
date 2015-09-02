<div class="panel callout">
	<h4 style="display:inline">Sign Off Form Detail</h4>
    <a href="<?php
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
    <a href="<?php echo $uri->link("support/signofflist") ?>"><span class="btn btn-danger  right button" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<?php
       $cproduct = $this->clientprod;
?>

<h4 class="headline3" style="display:"><?php echo $cproduct->prod_name ?> <span style="display: inline; float: right;">FORM NO:<?php  echo $this->schedu->id  ?></span></h4>
<div class="row">
<div class="large-4 columns">
    <img src="public/img/91_1380800432.jpg" width="235" height="204" />
    </div>
    <div class="large-8 columns">
        <div class="row">
            
            <div class='large-4 columns'><strong>Location</strong>:</div><div class='large-8 columns'><p><?php echo $cproduct->install_address ?></p></div>
            <div class='large-4 columns'><strong>Site Location</strong>:</div><div class='large-8 columns'><p> <?php echo $cproduct->install_city ?></p></div>
            <div class="large-4 columns"><strong>Branch</strong>:</div> <div class='large-8 columns'><p> <?php echo $cproduct->branch ?></p></div>
            <div class="large-4 columns"><strong>Operating System</strong>:</div> <div class="large-8 columns"><p> <?php echo $cproduct->myproduct->os ?></p></div>
        </div>
        
    </div>
    <br clear="all" />
<div class="row">
<fieldset>
    <legend ><h4 class='headline3'>Tested Cards</h4></legend>
    <?php
    echo $this->mysignoff->verve_card != "0" ? "<div class='large-12 columns'><p> <strong>Verve Card</strong></p> </div>" : "";
    echo $this->mysignoff->master_card != "0" ? "<div class='large-12 columns'><p> <strong>Master Card</strong></p> </div>" : "";
    echo $this->mysignoff->visa_card != "0" ? "<div class='large-12 columns'><p><strong> Visa Card</strong></p> </div>" : "";
    echo $this->mysignoff->mag_stripe != "0" ? "<div class='large-12 columns'><p><strong> Magnetic Stripe Card</strong></p> </div>" : "";
    
     ?>
</fieldset>
</div>

<div class="row">
<fieldset>
    <legend><h4 class='headline3'>Transactions Tested</h4></legend>
    <?php
    echo"<div class='large-12 columns'><div class='large-4 columns'><p><h3>Transaction</h3></div><div class='large-8 columns'><p> <strong><h3>Comment</h3></strong></p></div><hr /></div>";
    echo"<div class='large-12 columns'>"; echo ($this->mysignoff->withdraw === "0") ? "<div class='large-4 columns'><p><img src='public/icons/Delete16.png' /> &nbsp; Withdrawal Not Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->withdraw_comment."</strong></p></div> " : "<div class='large-4 columns'><p><img src='public/icons/Accept16.png' />  &nbsp; Withdrawal Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->withdraw_comment."</strong></p></div> "; echo"</div>";
    echo"<div class='large-12 columns'>"; echo ($this->mysignoff->balance === "0") ? "<div class='large-4 columns'><p><img src='public/icons/Delete16.png' /> &nbsp; Balance Not Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->balance_comment."</strong></p></div> " : "<div class='large-4 columns'><p><img src='public/icons/Accept16.png' />  &nbsp; Balance Enquiry Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->balance_comment."</strong></p></div> "; echo"</div>";
    echo"<div class='large-12 columns'>"; echo ($this->mysignoff->statement === "0") ? "<div class='large-4 columns'><p><img src='public/icons/Delete16.png' /> &nbsp; Statement Not Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->statement_comment."</strong></p></div> " : "<div class='large-4 columns'><p><img src='public/icons/Accept16.png' />  &nbsp; Statement Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->statement_comment."</strong></p></div> "; echo"</div>";
    echo"<div class='large-12 columns'>"; echo ($this->mysignoff->transfer === "0") ? "<div class='large-4 columns'><p><img src='public/icons/Delete16.png' /> &nbsp; Transfer Not Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->transfer_comment."</strong></p></div> " : "<div class='large-4 columns'><p><img src='public/icons/Accept16.png' />  &nbsp; Transfer Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->transfer_comment."</strong></p></div> "; echo"</div>";
    echo"<div class='large-12 columns'>"; echo ($this->mysignoff->pin_change === "0") ? "<div class='large-4 columns'><p><img src='public/icons/Delete16.png' /> &nbsp; Pin Change Not Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->pin_change_comment."</strong></p></div> " : "<div class='large-4 columns'><p><img src='public/icons/Accept16.png' />  &nbsp; Pin Change Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->pin_change_comment."</strong></p></div> "; echo"</div>";
    echo"<div class='large-12 columns'>"; echo ($this->mysignoff->mobile_recharge === "0") ? "<div class='large-4 columns'><p><img src='public/icons/Delete16.png' /> &nbsp; Mobile Recharge Not Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->mobile_recharge_comment."</strong></p></div> " : "<div class='large-4 columns'><p><img src='public/icons/Accept16.png' />  &nbsp; Mobile Recharge Tested</p></div><div class='large-8 columns'><p> <strong>".$this->mysignoff->mobile_recharge_comment."</strong></p></div> "; echo"</div>";
    
    
     ?>
</fieldset>
</div>


<div class="row">
    <fieldset>
        <legend><h4 class='headline3'>Facilities and Status Info</h4></legend>
        <?php
            echo"<div class='large-12 columns'>";
                echo"<div class='large-3 columns'>";  echo $this->mysignoff->camera_instal !="0" ? "<h4>Camera Installed</h4><img src='public/img/WebCam.png' />": "<h4>Camera Not Installed</h4><img src='public/img/NoWebCam.png' />"; echo"</div>";
                echo"<div class='large-3 columns'><h4>Inverter Status</h4><img src='public/img/inverter.png' /> <p> {$this->mysignoff->inverter_status}</p> </div>";
                echo"<div class='large-3 columns'><h4>AC Status</h4><img src='public/img/ac.png' /> <p> {$this->mysignoff->AC_status}</p></div>";
                echo"<div class='large-3 columns'><h4>ATM Room Condition</h4><img src='public/img/room.png' /> <p> {$this->mysignoff->ATM_room_cond}</p></div>";
            echo"</div>";
        ?>
        
    </fieldset>
</div>

<div class="row">
<fieldset>
<legend><h4 class='headline3'>Remarks</h4></legend>


    <div class="large-6 columns">
       <h5>CSE Remarks</h5>
       <hr />
       <p><?php echo $this->mysignoff->cse_remark ?></p>
    </div>
    <div class="large-6 columns">
        <h5>Client Remark</h5>
        <hr />
        <p><?php echo $this->mysignoff->client_remark ?></p>
    </div>
</fieldset>

</div>