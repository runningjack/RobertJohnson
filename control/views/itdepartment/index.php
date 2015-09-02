	<h3 class="headline4">Technical Department Dashboard</h3>
<?php
global $session;
?>

<div class="large-12 columns">
    <div class="large-4  columns ">
        <div class="panel box callout ">
        <h3 style=" text-decoration: blink;">Task Monitor Console</h3>
        <hr />
        <div><p><strong>Total no of Open task(s):</strong> <a href="<?php echo $uri->link("support/scheduleList") ?>"><?php echo $this->oschedule ?> , View listing</a></p></div>
        <div><p><strong>Total no of pending tasks(s):</strong> <a href="<?php echo $uri->link("support/worksheetlist") ?>"><?php echo $this->oworksheet ?>, View listing</a></p></div>
        <div><p><strong>Total no of Conpleted task(s):</strong> <a href="<?php echo $uri->link("support/ticketlist") ?>"><?php echo $this->aticketcount ?>, View listing</a></p></div>
        </div>
    </div>
    <div class="large-4  columns ">
        <div class="panel box callout ">
        <h3 style=" text-decoration: blink;">Spending Summary</h3>
        <hr />
        <div><p><strong>This Month: </strong></p></div>
        <div><p><strong>Last Month: </strong></p></div>
        <div><p><strong>Last Quarter: </strong></p></div>
        <strong>Issues Statstical Analysis for the month</strong>
        <div id="pie1" style="height:200px;width:200px; "></div>
        <div>View Report</div>
        </div>
    </div>
    <div class="large-4  columns ">
        <div class="panel callout">
        <h3 style=" text-decoration: blink;">Support Alert</h3>
        <hr />
        <div><p><strong>No Opened Client Ticket(s):</strong> <a href="<?php echo $uri->link("support/ticketlist") ?>"><?php echo $this->oticketcount ?> , View listing</a></p></div>
        <div><p><strong>No Client Ticket Awaiting response(s):</strong> <a href="<?php echo $uri->link("support/ticketlist") ?>"><?php echo $this->aticketcount ?>, View listing</a></p></div>
        </div>
    </div>
</div>




<div class="row">
<div class="large-3 columns">
	<a href="<?php echo $uri->link("itdepartment/account/".$_SESSION["emp_ident"]) ?>"><div class="panel dashboard-icon users">My Account</div></a>
</div>
<div class="large-3 columns">
	<a href="<?php echo $uri->link("role/index") ?>"><div class="panel dashboard-icon users">Role</div></a>
</div>
<div class="large-3  columns">
	<a href="<?php echo $uri->link("support/scheduleList") ?>"><div class="panel dashboard-icon products">Task Manager</div></a>
</div>

<div class="large-3  columns">
	<a href="<?php echo $uri->link("clientproduct/index") ?>"><div class="panel dashboard-icon stock">Clients Products</div></a>
</div>

<div class="large-3  columns">
	<a href="<?php echo $uri->link("employees/index") ?>"><div class="panel dashboard-icon users">Employee</div></a>
</div>



<div class="large-3  columns">
	<a href="<?php echo $uri->link("clients/index") ?>"><div class="panel dashboard-icon product_cats">Clients</div></a>
</div>
<div class="large-3  columns">
	<a href="<?php echo $uri->link("support/signofflist") ?>"><div class="panel dashboard-icon product_cats">Sign Off Form</div></a>
</div>

<div class="large-3  columns">
	<a href="<?php echo $uri->link("support/worksheetlist") ?>"><div class="panel dashboard-icon">Work Sheet</div></a>
</div>

</div>

</div><!--End column eight-->