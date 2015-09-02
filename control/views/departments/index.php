<div class="panel callout">
	<h4 style="display:inline">Department Listing</h4><a href="<?php 
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
    
    
    ?>"><a href="<?php echo $uri->link("departments/create") ?>"><span class="button secondary right" style="display:inline">Add New</span></a>
</div>
<table  width="100%">
<thead><tr>
	<th>Code</th><th>Department</th><th>Description</th><th>HOD</th><th>Members</th><th>Date Created</th><th>Last Modified</th><th></th>
</tr>
</thead>
<tbody>
<?php
if($this->mydepartments){
	foreach($this->mydepartments as $departments){
		echo"<tr>
			<td>$departments->dept_code</td><td>$departments->dept_name</td><td>$departments->dept_desc</td><td>$departments->dept_hod_name</td><td>$departments->mem_count</td><td>$departments->date_created</td><td>$departments->date_modified</td><td><a href='".$uri->link("departments/edit/".$departments->id."")."'>Edit</a></td></tr>";
	}
}else{
	echo"<tr><td colspan='10'> No record found </td></tr>";
}
?>
</tbody>
</table>