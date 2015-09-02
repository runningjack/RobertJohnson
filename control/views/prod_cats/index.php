<div class="panel callout">
	<h4 style="display:inline">Available Products Categories</h4><a href="<?php 
    global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("dashboard/index");
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo $uri->link("dashboard/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    
    ?>"><span class="button secondary right" style="display:inline"> &laquo;Back to Dashboard</span></a>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("prod_cats/create") ?>">Add New</a></span>
</div>
<div id="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>
<table  width="100%">
<thead><tr>
	<th>S/No</th><th>Name</th><th>Manufacturer</th><th>Visibility</th><th></th>
</tr>
</thead>
<tbody>
<?php
$sno = 1;
if($this->prod_cats){
	foreach($this->prod_cats as $prods){
		echo"<tr>
			<td>$sno</td><td>$prods->prod_cat_name</td><td>$prods->prod_cat_manu</td><td>$prods->visible</td><td><a href='".$uri->link("prod_cats/edit/".$prods->prod_cat_id."")."'>Edit</a></td></tr>";
		$sno++;
	}
}else{
	echo"<tr><td colspan='5'> No record found </td></tr>";
}
?>
</tbody>
</table>