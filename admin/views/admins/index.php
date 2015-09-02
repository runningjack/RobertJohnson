<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Admin Management</h3>
        <?php echo $this->pag; ?>
        <a href="<?php echo URL; ?>admins/create" class="button small right">Add New</a>
    </div>
 <div class="row">	
<table width="100%">
<thead><tr>
	<th>S/No</th><th>Name</th><th>Email</th><th>Role</th><th></th><th></th>
</tr>
</thead>
<tbody>
<?php
if($this->allAdmin !=false){
	$i = (($this->pageMultiplier - 1) * SEARCH_NO) + 1;
foreach($this->allAdmin as $admin){
echo"<tr>
	<td>".$i++."</td><td>$admin->admin_name</td><td>$admin->admin_email</td><td>$admin->admin_role</td><td><a href='".URL."admins/edit/".$admin->admin_id."'>Edit</a></td><td><a href='".URL."admins/doDelete/".$admin->admin_id."'>Delete</a></td>
</tr>";
}
}
else echo "<tr><td colspan='6'>No Admin Personnel</td></tr>";
?>
</tbody>
</table>
<?php echo $this->pag; ?>
 </div>
</div>
 