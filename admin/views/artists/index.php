<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Artists Management</h3>
        <?php echo $this->pag; ?>
        <a href="<?php echo URL; ?>artists/create" class="button small right">Add New</a>
    </div>
 <div class="row">	
<table width="100%">
<thead><tr>
	<th>S/No</th><th>Name</th><th>Email</th><th>Phone</th><th></th><th></th>
</tr>
</thead>
<tbody>
<?php
if($this->allArtists !=false){
	$i = (($this->pageMultiplier - 1) * SEARCH_NO) + 1;
foreach($this->allArtists as $artists){
echo"<tr>
	<td>".$i++."</td><td>$artists->artist_name</td><td>$artists->artist_email</td><td>$artists->artist_phone</td><td><a href='".URL."artists/edit/".$artists->artist_id."'>Edit</a></td><td><a href='".URL."artists/delete/".$artists->artist_id."'>Delete</a></td>
</tr>";
}
}
else echo "<tr><td colspan='6'>No Artists Personnel</td></tr>";
?>
</tbody>
</table>
<?php echo $this->pag; ?>
 </div>
</div>
 