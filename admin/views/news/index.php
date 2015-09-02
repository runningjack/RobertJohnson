<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">News Management</h3>
        <?php echo $this->pag; ?>
        <a href="<?php echo URL ?>news/create" class="button small right">Add New</a>
    </div>
 	<div class="row">
    
<table  width="100%">
<thead><tr>
	<th width="5%">ID</th><th width="41%">Topic</th><th width="15%">Visible</th><th width="19%">Date Created</th><th width="16%">Last Date modified</th><th width="2%"></th><th width="2%"></th>
</tr>
</thead>
<tbody>
<?php
if($this->allNews){
$i = (($this->pageMultiplier - 1) * SEARCH_NO) + 1;
foreach($this->allNews as $news){
echo"<tr>
	<td>".$i++."</td><td>$news->news_topic</td><td>$news->news_visible</td><td>$news->news_created</td><td>$news->news_modified</td><td><a href='".URL."news/edit/".$news->news_id."'>Edit</a></td><td><a href='".URL."news/doDelete/".$news->news_id."'>Delete</a></td>
</tr>";
}
}
else echo "<tr><td colspan='7'>No News Created</td></tr>";
?>
</tbody>
</table>
<?php echo $this->pag; ?>
  </div><!-- Self defined -->
</div>