<?php
		$cat = Prod_Cat::find_by_id($this->product->prod_cat_id);
		$prod_name = $cat->prod_cat_name;
		$client = Client::find_by_id($this->product->client_id);
		$client_name = $client->name;
		$employee = Employee::find_by_staff_id($this->product->incare_employee_id);
		$emp = $employee->emp_id." ".$employee->emp_fname." ".$employee->emp_lname;

?>
<div id='transalert'></div>
 <div class="large-9 columns centre" role="content">
<!-- Table goes in the document BODY -->
<div class="panel callout">
	<h4 style="display:inline"><?php echo $prod_name." ".$this->product->model ?></h4>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("products/index") ?>">Go Back</a></span>
</div>

<div class="row">
<div class="large-3 columns">
	<a href="<?php echo $uri->link("products/signoff") ?>"><div class="panel"><img src="public/icons/clock.png" />View Sign-Off Form</div></a>
</div>

<div class="large-3 columns">
	<a href="<?php echo $uri->link("products/preventive") ?>"><div class="panel"><img src="public/icons/clock.png" />View Preventive Form</div></a>
</div>

<div class="large-3 columns">
	<a href="<?php echo $uri->link("products/part") ?>"><div class="panel"><img src="public/icons/clock.png" />View Parts Replace</div></a>
</div>

<div class="large-3 columns">
	<a href="<?php echo $uri->link("products/worksheet") ?>"><div class="panel"><img src="public/icons/clock.png" />View WorkSheet Form</div></a>
</div>


<?php
	if($this->product->sign_off_status == 0){
?>
	<div class="large-4 columns">
		<a href="<?php echo $uri->link("products/addsignoff/".$this->product->id) ?>"><div class="panel"><img src="public/icons/clock.png" />Add Sign-Off Form</div></a>
    </div>
<?php
	}
?>

<div class="large-4 columns">
	<a href="<?php echo $uri->link("products/addpreventive/".$this->product->id) ?>"><div class="panel"><img src="public/icons/clock.png" />Add Preventive Form</div></a>
</div>

<div class="large-4 columns">
	<a href="<?php echo $uri->link("products/addworksheet/".$this->product->id) ?>"><div class="panel"><img src="public/icons/clock.png" />Add WorkSheet Form</div></a>
</div>
</div>
	<h3>Part Replacement Form</h3>
    <form action="<?php echo $uri->link("products/addReplacePart") ?>" name="replaceForm" method="post">
    <input type="hidden" name="prod_id" value="<?php echo $this->product->id ?>" />
	<table width="100%" border="1">
      <tr>
        <th width="25%" scope="col">Part Name</th>
        <th width="15%" scope="col">Date Changed</th>
        <th width="30%" scope="col">Description</th>
        <th width="30%" scope="col">Remark</th>
      </tr>
      <tr>
        <td><input type="text" name="part_name_1" placeholder="Part Name" /></td>
        <td><input type="date" name="date_1" /></td>
        <td><textarea name="desc_1" placeholder="Description"></textarea></td>
        <td><textarea name="remark_1" placeholder="Remark"></textarea></td>
      </tr>
      <tr>
        <td><input type="text" name="part_name_2" placeholder="Part Name" /></td>
        <td><input type="date" name="date_2" /></td>
        <td><textarea name="desc_2" placeholder="Description"></textarea></td>
        <td><textarea name="remark_2" placeholder="Remark"></textarea></td>
      </tr>
      <tr>
        <td><input type="text" name="part_name_3" placeholder="Part Name" /></td>
        <td><input type="date" name="date_3" /></td>
        <td><textarea name="desc_3" placeholder="Description"></textarea></td>
        <td><textarea name="remark_3" placeholder="Remark"></textarea></td>
      </tr>
      <tr>
        <td><input type="text" name="part_name_4" placeholder="Part Name" /></td>
        <td><input type="date" name="date_4" /></td>
        <td><textarea name="desc_4" placeholder="Description"></textarea></td>
        <td><textarea name="remark_4" placeholder="Remark"></textarea></td>
      </tr>
      <tr>
        <td><input type="text" name="part_name_5" placeholder="Part Name" /></td>
        <td><input type="date" name="date_5" /></td>
        <td><textarea name="desc_5" placeholder="Description"></textarea></td>
        <td><textarea name="remark_5" placeholder="Remark"></textarea></td>
      </tr>
    </table>
	<input type="submit" class="button" value="submit" name="submit" />
    </form>

</div>