
<div class="panel callout">
	<h4 style="display:inline">Clients</h4><a href="<?php 
    global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("dashboard/index");
    }elseif($session->rolename=="Customer Support Services" && in_array("support", $session->privil)){
        echo $uri->link("dashboard/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    
    
    ?>"><span class="button secondary right" style="display:inline"> &laquo;Back to Dashboard</span></a>
    <a href="<?php echo $uri->link("clients/create") ?>"><span class="button secondary right" style="display:inline">Add New</span></a>
</div><div id='transalert'><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>
<table  width="100%">
<thead><tr>
	<th>S/No</th><th>Name</th><th>Address</th><th>Phone No</th><th>Username</th><th>Visibility</th><th></th>
</tr>
</thead>
<tbody>
<?php
$sno = 1;
if($this->clients){
	foreach($this->clients as $client){
		echo"<tr>
			<td>$sno</td><td>$client->name</td><td>$client->addy</td><td>$client->phone</td><td>$client->username</td><td>$client->visible</td><td><a href='".$uri->link("clients/edit/".$client->id."")."'>Edit</a></td></tr>";
		$sno++;
	}
}else{
	echo"<tr><td colspan='8'> No record found </td></tr>";
}
?>
</tbody>
</table>