<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Category Management</h3>
        <a href="<?php echo URL ?>products/create" class="button small right">Add New</a>
    </div>
 	<div class="row">
    
<table  width="100%">
<thead><tr>
	<th>S/No</th><th>Name</th><th>Description</th><th>Date Created</th><th>Last Date modified</th><th>Visible</th><th></th><th></th>
</tr>
</thead>
<tbody>
<?php
if($this->allCategories){
$i = 1;
foreach($this->allCategories as $category){
echo"<tr>
	<td>".$i++."</td><td><a href='".URL."products/category/".$category->cat_id."'>$category->cat_name</a></td><td>$category->cat_desc</td><td>$category->cat_created</td><td>$category->cat_modified</td><td>$category->cat_visible</td><td><a href='".URL."products/edit/".$category->cat_id."'>Edit</a></td><td><a href='".URL."products/deleteCategory/".$category->cat_id."'>Delete</a></td>
</tr>";
}
}
else echo "<tr><td colspan='7'>No Category Created</td></tr>";
?>
</tbody>
</table>
  </div><!-- Self defined -->
</div>