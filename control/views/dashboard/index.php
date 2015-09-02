
<div class="panel callout">
	<h4 style="display:inline">Dashboard</h4>
</div>

<div class="row">


<?php
global $session;
//print_r($session->employee_role);
if($session->employee_role){
    foreach($session->employee_role as $role){
        $module = Modules::find_by_module($role->module);
        if($module->status != "Hide"){
        echo"<div class='large-3  columns'>
	<a href='". $uri->link($module->module."/".$module->link)."'><div class='$module->css_class'>$module->description</div></a>
</div>";
}
    }
}

?>


<div class="large-3 columns ">
	<a href="<?php echo $uri->link("role/index") ?>"><div class="panel dashboard-icon role">Role</div></a>
</div>
<div class="large-3 columns ">
	<a href="<?php echo $uri->link("reports/index") ?>"><div class="panel dashboard-icon role">View Report</div></a>
</div>



<!--<div class="large-3 columns ">
	<a href="<?php echo $uri->link("role/index") ?>"><div class="panel dashboard-icon role">Role</div></a>
</div>
<div class="large-3  columns ">
	<a href="<?php echo $uri->link("users/index") ?>"><div class="panel dashboard-icon users">Users</div></a>
</div>
<div class="large-3  columns ">
	<a href="<?php echo $uri->link("departments/index") ?>"><div class="panel dashboard-icon depts">Departments</div></a>
</div>
<div class="large-3  columns ">
	<a href="<?php echo $uri->link("regions/index") ?>"><div class="panel dashboard-icon vendors">Area</div></a>
</div>

<div class="large-3  columns ">
	<a href="<?php echo $uri->link("subregion/index") ?>"><div class="panel dashboard-icon vendors">Subregion</div></a>
</div>
<div class="large-3  columns ">
	<a href="<?php echo $uri->link("clientproduct/index") ?>"><div class="panel dashboard-icon clients">Clients Products<h4>(120)</h4></div></a>
</div>
<div class="large-3  columns ">
	<a href="<?php echo $uri->link("stockitems/index") ?>"><div class="panel dashboard-icon stock">Stock Items</div></a>
</div>
<div class="large-3  columns ">
	<a href="<?php echo $uri->link("employees/index") ?>"><div class="panel dashboard-icon employee">Employee</div></a>
</div>
<div class="large-3  columns ">
	<a href="<?php echo $uri->link("vendors/index") ?>"><div class="panel dashboard-icon vendors">Vendors</div></a>
</div>
<div class="large-3  columns ">
	<a href="<?php echo $uri->link("stockin/index") ?>"><div class="panel dashboard-icon stock">Stockin</div></a>
</div>
<div class="large-3  columns">
	<a href="<?php echo $uri->link("prod_cats/index") ?>"><div class="panel dashboard-icon product_cats">Product Cats</div></a>
</div>
<div class="large-3  columns">
	<a href="<?php echo $uri->link("support/index") ?>"><div class="panel dashboard-icon ">Support</div></a>
</div>
<div class="large-3  columns">
	<a href="<?php echo $uri->link("products/index") ?>"><div class="panel dashboard-icon products">Products</div></a>
</div>
<div class="large-3  columns">
	<a href="<?php echo $uri->link("clients/index") ?>"><div class="panel dashboard-icon clients ">Clients</div></a>
</div>
<div class="large-3  columns">
	<a href="<?php echo $uri->link("itdepartment/index") ?>"><div class="panel dashboard-icon">Technical Dept</div></a>
</div>
</div>
-->

