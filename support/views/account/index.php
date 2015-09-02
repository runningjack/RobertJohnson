<div class="wrapper">

			<div class="container">
            
            <div class="row">

    <div class="col-6">
        <div class="internalpadding">

            <div class="page-header">
                <div class="styled_title">
                    <h2>Account Information &nbsp;&nbsp;&nbsp;<small><a href="<?php echo $uri->link("account/edit") ?>">Update Your Details</a></small></h2>
                </div>
            </div>
            <p><strong><?php echo  $this->myAccount->contact_name ." (". $this->myAccount->name .")"; ?> </strong></p>
            <p><?php $this->myAccount->addy ?></p>
            <p>Ikeja, Lagos, 2341</p>
            <p>Nigeria</p>
            <p><a href="mailto:<?php $this->myAccount->email ?>"><?php $this->myAccount->email ?></a></p>

        </div>
    </div>
    <div class="col-6">
        <div class="internalpadding">

            <div class="page-header">
                <div class="styled_title">
                    <h2>Account Overview</h2>
                </div>
            </div>

            <p>Number of Products/Services: <a href="<?php echo $uri->link("cproducts/index") ?>"><strong><?php echo $this->prodcount ?></strong> - View &raquo;</a></p>
            <p>Number of Support Tickets: <a href="<?php echo $uri->link("supportticket/index") ?>"><strong><?php echo $this->tickcount ?></strong> - View &raquo;</a></p>
             
        </div>
    </div>
</div>

<div class="row">
<div class=" col-8 small_container">
				
				<div class="block">
					<div class="smaller_heading">
					<h2>Services</h2>
					</div><!--heading-->
					<div class="content">
						<p><div class="styled_title"><h3>Schedule Preventive Maintenance Date</h3></div>
                        <?php
                            if(count($this->schedule) >0){
                                echo "<table class='pure-table'  width='100%'>
                    			<thead><tr>
                    				<th width='20%'>Prod Name</th><th width='30%'>Location</th><th width='20%'>Schedule Date</th><th width='20%'>Engineer</th>
                    			</tr>
                    			</thead>
                    			<tbody>";
                                foreach($this->schedule as $sched){
                                    
                                    echo"<tr><td>$sched->prod_id, $sched->prod_name</td><td> $sched->install_address $sched->install_state</td><td>". date_format(new DateTime($sched->next_maint_date),"M d Y H:i:s")."</td><td></td></tr>" ;
                                }
                               echo "</tbody>
			                     </table>";
                            }
                        ?>
                        </p>

						
					</div><!--content-->
				</div><!--block-->

			</div>
</div><!--end Row -->
<div class="col-4">

</div>
			</div><!--container-->
		</div>