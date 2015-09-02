<div class="panel callout">
	<h4 style="display:inline">Roles</h4>
</div>
<span class="btn btn-danger right" style="display:inline"><a href="<?php echo $uri->link("role/create") ?>">Add New</a></span>
<div id='transalert'></div>
 <div id="datadiv">
<!-- Table goes in the document BODY -->
<table  width="100%">
<thead><tr>
	<th>ID</th><th>Role Name </th><th>Description</th><th>Date Created</th><th>Last Date modified</th><th></th><th></th><th></th>
</tr>
</thead>
<tbody>
<?php
  if($this->myrole){
	  $x =1;
    foreach($this->myrole as $page){
    echo"<tr>
    	<td>$x</td><td>$page->role_name</td><td>$page->role_description</td><td>$page->date_created</td><td>$page->date_modified</td><td><a href='".$uri->link("role/edit/".$page->role_id."")."'>Edit</a></td><td><a href='".$uri->link("role/grants/".$page->role_id."")."'>Manage</a></td><td><a class='dataDelete' data-reveal-id='firstModal$page->role_id' href='#'>Delete</a>
        
        
        <div id='firstModal$page->role_id' class='reveal-modal small' style='background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px'>
    <h2>Data Delete Console.</h2>
    <hr />
    <p>You are about to delete a record. Any record deleted will not longer be available in the database <br /> Are you sure you want to delete <b>$page->role_name</b> from the database?</p>
    <p><a href='?url=role/doCheckTransLog/$page->main_id' data-reveal-id='secondModal$page->role_id' class='btn button btn-danger' data-reveal-ajax='true'>Yes</a>&nbsp; &nbsp; &nbsp;<a pdid='$page->role_id' class='btn button btn-danger modalclose'>No</a></p>
    <a class='close-reveal-modal'>&#215;</a>
  </div>

  <div id='secondModal$page->role_id' class='reveal-modal small' style='background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px'>
    <h2>This is a second modal.</h2>
    <hr />
    <p></p>
    <a class='close-reveal-modal closemodal'>&#215;</a>
  </div>
        
        
        
        </td>
    </tr>";
	$x++;
    }
  }else{
    echo "<tr><td colspan='7'>No record to display</td></tr>";
  }
?>
</tbody>
</table>

</div>

  