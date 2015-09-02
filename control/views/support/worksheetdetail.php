<div class="panel callout">
	<h4 style="display:inline">Worksheet</h4><a href="<?php
        global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("itdepartment/index");
    }elseif($session->rolename=="Customer Support Services" && in_array("support", $session->privil)){
        echo $uri->link("support/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    ?>"><span class="btn  right  btn-primary button" style="display:inline"> &laquo;Back To Dashboard</span></a>
    <a href="<?php echo $uri->link("support/worksheetlist") ?>"><span class="btn btn-danger  right button" style="display:inline"> &laquo;Back To Listing</span></a>
</div>
<?php
       $cproduct = Cproduct::find_by_id($this->myworksheet->prod_id)
?>

<h4 class="headline3"><?php echo $cproduct->prod_name ?></h4>
<div class="row">
<div class="large-4 columns">
    
    </div>
    <div class="large-8 columns">
        <div class="row">
            
            <div class='large-4 columns'><strong>Location</strong>:</div><div class='large-8 columns'><p><?php echo $cproduct->install_address ?></p></div>
            <div class='large-4 columns'><strong>Site Location</strong>:</div><div class='large-8 columns'><p> <?php echo $cproduct->install_city ?></p></div>
            <div class="large-4 columns"><strong>Branch</strong>:</div> <div class='large-8 columns'><p> <?php echo $cproduct->branch ?></p></div>
            <div class="large-4 columns"><strong>Operating System</strong>:</div> <div class="large-8 columns"><p> <?php echo $cproduct->myproduct->os ?></p></div>
        </div>
        
    </div>
  </div> 
  
  <div class="row">
  <?php
    $technician         =   Employee::find_by_id($this->myworksheet->cse_emp_id);
  ?>
  <h3 class="headline3">Technician/Task Detail (<?php // echo $technician-> ?>)</h3>
    <div class="large-5">
    </div>
  </div>

    
    
    <div class="row">
      <div class="large-12 columns">
        <div class="large-4 columns"><h5>Work Sheet Date</h5></div>
        <div class="large-8 columns"><p> <?php echo $this->myworksheet->sheet_date ?></p></div>
      </div>
    </div>
    
    
    <div class="row">
      <div class="large-12 columns">
        <div class="large-4 columns"><h5>Time In</h5></div>
        <div class="large-8 columns"><p> <?php echo $this->myworksheet->time_in ?></p></div>
      </div>
    </div>
    
    
    <div class="row">
      <div class="large-12 columns">
        <div class="large-4 columns"><h5>Time Out</h5></div>
        <div class="large-8 columns"><p> <?php echo $this->myworksheet->time_out ?></p></div>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <div class="large-4 columns"><h5>Contact Person</h5></div>
        <div class="large-8 columns"><p> <?php echo $this->myworksheet->contact_person  ?></p></div>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <div class="large-4 columns"><h5>Customer Support Engineer</h5></div>
        <div class="large-8 columns"><p> <?php
        $emp = Employee::find_by_id($this->myworksheet->cse_emp_id);
        $empname = $emp->emp_lname." ".$emp->emp_fname;
        ?></p></div>
      </div>
    </div>
    
    
    
    
    <div class="row">
      <div class="large-12 columns">
        <div class="large-4 columns"><h5>Problem (Terminal Status)</h5></div>
        <div class="large-8 columns"><p>
        <?php echo $this->myworksheet->problem  ?>
        </p></div>
      </div>
    </div>
    
    
    <div class="row">
      <div class="large-12 columns">
        <div class="large-4 columns"><h5>Causes</h5></div>
        <div class="large-8 columns"><p>
        <?php echo $this->myworksheet->cause  ?>
        </p></div>
      </div>
    </div>
    
    
    <div class="row">
      <div class="large-12 columns">
        <div class="large-4 columns"><h5>Corrective Action</h5></div>
        <div class="large-8 columns"><p>
        <?php echo $this->myworksheet->corrective_action  ?>
        </p></div>
      </div>
    </div>
    
        
    <div class="row">
    <div class="large-12 columns">
        <div class="section-container auto" data-section >
          <section class="active">
            <p class="title" data-section-title ><a href="#panel1">Part Change</a></p>
            <div class="content" data-section-content >
            <p>
                <?php
                    echo"<table  width='50%'>
            <thead><tr>
            	<th>Part/Item ID</th><th>Part Name</th><th>QTy</th><th>unit cost</th><th>Total</th><th></th>
            </tr>
            </thead>
            <tbody>";
            $x=1;
           // print_r($this->prodpart);
            if($this->prodpart){
            foreach($this->prodpart as $part){
                echo"<tr><td>$part->item_id</td><td>$part->part_name</td><td>$part->qty</td><td>$part->unit_cost</td><td>$part->total_cost</td><td><a href='#' class='itdeletelink' itdid='{$part->id}'><img src='public/icons/Delete16.png' /></a></td></tr>" ;           
            }
            $x++;
            }else{
                echo("<tr><td colspan='5'> Not part used for this service</td></tr>");
            }
            echo "</tbody></table>";
                ?>
            
            
            </p>
            </div>
          </section>
          <section>
            <p class="title" data-section-title ><a href="#panel2">Finances</a></p>
            <div class="content" data-section-content >
            <p>
                <div class="row">
                    <div class="large-4 columns"><p><strong>Technician's Welfare:</strong></p></div><div class="large-8 columns"><p><?php echo number_format($this->myworksheet->fund,2,'.',',') ?></p></div>
                </div>
                <div class="row">
                   <div class="large-4 columns"><p><strong>Part Replacement Cost:</p></strong></div><div class="large-8 columns"><p><?php echo "".number_format($this->parttot,2,'.',',') ?></p></div>
                </div>
                <div class="row">
                   <div class="large-4 columns"><p><h4>Total Expenditure:</p></h4></div><div class="large-8 columns"><p><h4><?php echo number_format($this->totexpend,2,'.',',') ?></h4></p></div>
                </div>
            </p>
            </div>
          </section>
          <section>
            <p class="title" data-section-title ><a href="#panel3">Remarks</a></p>
            <div class="content" data-section-content >
            <p>
                <div class="row">
                    <div class="large-6 columns"><h6>Customer Support Engineer's Rmark</h6><?php echo  $this->mysignoff->cse_remark ?></div>
                    <div class="large-6 columns"><h6>Client's Remark</h6><?php echo  $this->mysignoff->client_remark ?></div>
                </div>
            
            </p>
            </div>
          </section>
        </div>
     </div>
     </div>   
    