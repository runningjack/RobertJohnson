 <div class="row" style="width:96%; margin:10px auto">

<div class="heading">
      <h1><img src="views/common_util/images/001_57.png" alt="" />Contacts</h1>
      
    </div>
<div class='panelContainer'>
  <div id='transalert'><?php  echo $_SESSION['message']; ?></div>
 <div class="twelve centre" role="content">
<!-- Table goes in the document BODY -->
<table  width="100%">
<thead><tr>
	<th>ID</th><th>Name</th><th>Email / Phone</th><th>Subject</th><th>Date Created</th><th></th><th></th>
</tr>
</thead>
<tbody>
<?php
foreach($this->mymenus as $contact){
echo"<tr>
	<td>$contact->contact_id</td><td>$contact->contact_name</td><td>$contact->contact_email $contact->contact_phone</td><td>$contact->contact_topic</td><td>$contact->contact_date_created</td><td><a href='".$uri->link("contact/detail/".$contact->contact_id."")."'>View Detail</a></td><td><a href='".$uri->link("contact/doDelete/".$contact->contact_id."")."'>Delete</a></td>
</tr>";
}
?>
</tbody>
</table>
 
<!-- TIP: Generate your own CSS Gradients using this tool: http://www.colorzilla.com/gradient-editor/ -->


  <!-- End Grid Section -->

</div>
</div><!-- Self defined -->
   </div>   