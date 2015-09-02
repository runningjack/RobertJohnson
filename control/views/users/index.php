
<div class="panel callout">
	<h4 style="display:inline">User Listing</h4>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("users/create") ?>">Add New</a></span>
</div>
<div id="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>
<?php echo $this->pagin ?>
<table  width="100%">
<thead><tr>
	<th>ID</th><th>Image</th><th>Fullname</th><th>Email</th><th>Telephone</th><th>Role</th><th>Date Created</th><th>Last Modified</th><th></th><th></th>
</tr>
</thead>
<tbody>
<?php
if($this->alluser){
	foreach($this->alluser as $user){
		echo"<tr>
			<td>$user->user_id</td><td>"; echo $user->img_url != "" ? "<img src ='../public/uploads/$user->img_url' width='50' height='48'  />" : "<img src ='../public/images/anonymous.jpg' width='50' height='48'  />" ; echo "</td><td>$user->fname $user->lname</td><td>$user->email</td><td>$user->phone</td><td>$user->user_role</td><td>$user->date_added</td><td>$user->date_added</td><td><a href='".$uri->link("users/edit/".$user->user_id."")."'>Edit</a></td><td><a href='".$uri->link("users/detail/".$user->user_id."")."'>View Detail</a></td>
		</tr>";
	}
}else{
	echo"<tr><td colspan='10'> No record found </td></tr>";
}
?>
</tbody>
</table>

<!-- TIP: Generate your own CSS Gradients using this tool: http://www.colorzilla.com/gradient-editor/ -->

<?php echo $this->pagin ?>
  <!-- End Grid Section -->

