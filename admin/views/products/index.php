<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9"><?php echo $this->category->cat_name; ?> Products</h3>
        <a href="<?php echo URL?>products" class="button small left">Go Back</a>
        <a href="<?php echo URL ?>products/createprod" class="button small right">Add New</a>
    </div>
 	<div class="row">
    
<table  width="100%">
<thead><tr>
	<th>S/No</th><th>Name</th><th>Description</th><th>Date Created</th><th>Last Date modified</th><th>Visible</th><th></th><th></th>
</tr>
</thead>
<tbody>
<?php
if($this->allProducts){
$i = 1;
foreach($this->allProducts as $product){
echo"<tr>
	<td>".$i++."</td><td>$product->prod_name</td><td>$product->prod_desc</td><td>$product->prod_created</td><td>$product->prod_modified</td><td>$product->prod_visible</td><td><a href='".URL."products/editproduct/".$product->prod_id."'>Edit</a></td><td><a href='".URL."product/deleteProduct/".$product->prod_id."'>Delete</a></td>
</tr>";
}
}
else echo "<tr><td colspan='7'>No Product Available</td></tr>";
?>
</tbody>
</table>
  </div><!-- Self defined -->
</div>