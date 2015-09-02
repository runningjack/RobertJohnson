<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Pages Management</h3>
        <?php echo $this->pag; ?>
        <a href="<?php echo URL ?>page/create" class="button small right">Add New</a>
    </div>
 	<div class="row">
    
<table  width="100%">
<thead><tr>
	<th>ID</th><th>Name</th><th>Description</th><th>Date Created</th><th>Last Date modified</th><th></th><th></th>
</tr>
</thead>
<tbody>
<?php
if($this->allPages){
$i = (($this->pageMultiplier - 1) * SEARCH_NO) + 1;
foreach($this->allPages as $page){
echo"<tr>
	<td>".$i++."</td><td>$page->page_name</td><td>$page->page_desc</td><td>$page->page_created</td><td>$page->page_modified</td><td><a href='".URL."page/edit/".$page->page_id."'>Edit</a></td><td><a href='".URL."page/doDelete/".$page->page_id."'>Delete</a></td>
</tr>";
}
}
else echo "<tr><td colspan='7'>No Page Created</td></tr>";
?>
</tbody>
</table>
<?php echo $this->pag; ?>
  </div><!-- Self defined -->
</div>