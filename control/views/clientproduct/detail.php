<div class="panel callout " style="margin-left: 0; max-width: 100%;">
	<h4 style="display:inline">Client Products</h4><a href="<?php 
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
    <a href="<?php echo $uri->link("clientproduct/index") ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
</div>

<div id="myModal4" class="reveal-modal medium" data-animation="fade" style="background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px" >
<h4>Set Preventive Maintenance Date</h4>
<div id="searchdata"  >
    <div class="large-12 columns">
        <div class="large-3 columns">
            <strong>Start Date</strong>
        </div>
        <div class="large-9 columns">
            <input type="hidden" id="cid" name="cid" value="<?php
	echo $this->myproduct->id;
?>" />

            <input type="hidden" id="clientid" name="clientid" value="<?php
            echo $this->myproduct->client_id;
            ?>" />
            <input type="date" name="sdate" id="sdate" />
        </div>
    </div>
    

<div class="large-12 columns">
        <div class="large-3 columns">
            <strong>Employee</strong>
        </div>
        <div class="large-9 columns">
            <select name="empfield" id="empfield">
                <?php
				$employees = Employee::find_all();
				foreach($employees as $emp){
					echo "<option value='$emp->emp_id'>$emp->emp_id; $emp->emp_fname $emp->emp_lname</option>";
				}
			     ?>
        
            </select>
        </div>
    </div>

    <div class="large-12 columns">
        <div class="large-3 columns">
        </div>
        <div class="large-9 columns">
            <button class="button" id="ssave" name="ssave">Save</button>
        </div>
    </div>
</div>
<a class="close-reveal-modal"><img src="public/icons/Close16.png" width="16" height="16" /></a>
</div>
<!--

<div id="myModal5" class="reveal-modal medium" data-animation="fade" style="background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px" >
<h4>Assign Corrective Maintenance Task</h4>
<hr />
<div id="ddddd"></div>
<div id="searchdata2"  >
    <div class="large-12 columns">
        <div class="large-3 columns">
            <strong>Start Date</strong><span class="red">*</span>
        </div>
        <div class="large-9 columns">
            
            <input type="date" name="taskdate" id="taskdate" rel='cachable' />
        </div>
        <div class="large-3 columns">
            <strong>Issue Type</strong><span class="red">*</span>
        </div>
        <div class="large-9 columns">
             
		                    <div class="row">
	                      <?php
/*						  	if($this->issues){
								foreach($this->issues as $issue){
									echo"<div class='large-4 columns iss'><label for='".$issue->issue_accronym."'><input type='checkbox' name='".$issue->issue_accronym."' id='".$issue->issue_accronym."' value='".$issue->issue_name."' rel='catchable' />".$issue->issue_name."<label></div>";
								}
							}
						  */?>
                          </div>
        </div>
        
        <div class="large-3 columns">
            <strong>maintenance Type</strong>
        </div>
        <div class="large-9 columns">
            
            <select  name="mtype" id="mtype" rel='catchable'   >
                <option value="">--SELECT MAINTENANCE TYPE--</option>
                <option value="Preventive"> Preventive Maintenance </option>
                <option value="Corrective"> Corrective Maintenance </option>
            </select>
        </div>
        
        
        <div class="large-3 columns">
            <strong>Comment/Note</strong>
        </div>
        <div class="large-9 columns">
            <textarea id="tissue" name="tissue" rel='catchable' ></textarea>
        </div>
        
        
        <div class="large-3 columns">
            <strong>Technician</strong>
        </div>
        <div class="large-9 columns">
            <select name="emp" id="emp" rel='catchable' >
            	<?php
/*					if($this->employee){
						foreach($this->employee as $emp)
						echo "<option value='$emp->id'>$emp->emp_id; $emp->emp_fname $emp->emp_lname</option>";
					}
				*/?>
            </select>
            
        </div>
    </div>
    
   
    <div class="large-12 columns">
        <div class="large-3 columns">
        </div>
        <div class="large-9 columns">
            <input type="submit" class="button" id="csavell" name="csavell" rel='catchable'  value="Save" />
        </div>
    </div>
</div>
<a class="close-reveal-modal"><img src="public/icons/Close16.png" width="16" height="16" /></a>
</div>

-->
<div class="row">
<h3 class="headline4"><?php echo $this->myproduct->prod_name ?></h3>
    <div class="large-4 columns">
    
    </div>
    <div class="large-8 columns">
        <div class="row">
            
            <div class='large-4 columns'><strong>Location</strong>:</div><div class='large-8 columns'><p><?php echo $this->myproduct->install_address ?></p></div>
            <div class='large-4 columns'><strong>Site Location</strong>:</div><div class='large-8 columns'><p> <?php echo $this->myproduct->install_city ?></p></div>
            <div class="large-4 columns"><strong>Branch</strong>:</div> <div class='large-8 columns'><p> <?php echo $this->myproduct->branch ?></p></div>
            <div class="large-4 columns"><strong>Operating System</strong>:</div> <div class="large-8 columns"><p> <?php echo $this->myproduct->os ?></p></div>
        </div>
        
    </div>
  </div>
  
 <div class="row">
        <div class="section-container auto" data-section >
          <section class="active">
            <p class="title" data-section-title ><a href="#panel1">Preventive Schedule</a></p>
            <div class="content"  data-section-content >
                <p><h4>Schedule for  </h4><i>Preventive Maintenance</i></p>
                <?php
	               echo ($this->myproduct->last_maint_date =="0000-00-00 00:00:00") ? "<p><a href='#' data-reveal-id='myModal4' >Set Intitial Maintenance Schedule</a></p>"  : "<hr /><strong>Next Maintenance</strong> ".date_format(new DateTime($this->myproduct->next_maint_date),"F d Y")
                ?>
                <a href="#" data-reveal-id='myModal5'>Create Corrective Schedule</a>
            </div>
          
          </section>
          
          <section>
            <p class="title" data-section-title ><a href="#panel2">Maintenance History</a></p>
            <div class="content" data-section-content >
                <p><h4>Maintainannce Records </h4>
                <table  width='100%'>
<thead><tr>
	<th>S/N</th><th>Product/Machine</th><th>Issue</th><th>Status</th><th>Technician</th><th>Date Generated </th><th>Expenses</th><th></th><th></th><th></th>
</tr>
			</thead>
			<tbody>
                <?php
                    
               if($this->worksheet){
                
	  $x =1;
    foreach($this->worksheet as $worksheet){
        
    $worksheetlisting .="<tr>
    	<td>$x</td><td>";
        $cprod = Cproduct::find_by_id($worksheet->prod_id);
                    $worksheetlisting .= $cprod->prod_name." ". $cprod->install_address." ". $cprod->install_city;
        //print_r($worksheet->cse_emp_id);
         $worksheetlisting .="</td><td>$worksheet->problem</td><td>$worksheet->status </td><td>";
         $emp   =   Employee::find_by_id((int)preg_replace('#[^0-9]#i','',$worksheet->cse_emp_id));
         //print_r($cprod);
         $worksheetlisting .= $emp->emp_fname." ". $emp->emp_lname ;
         $worksheetlisting .= "</td><td>".date_format(new DateTime($worksheet->sheet_date),"M d Y H:i:s")."</td><td>".Worksheet::getExpensesById($worksheet->id)."</td>";
        
        /**
          * section to set grant and\
          * previledge
          */
         global $session;
         $worksheetlisting .= "";

    $worksheetlisting .="</tr>";
	$x++;
    }
  }else{
    $worksheetlisting .= "<tr><td colspan='9'>No record to display</td></tr>";
    }
                echo $worksheetlisting;
                ?>
            
            </tbody>
            </table>
                
                </p>
            </div>
          
          </section>
  </div>
 </div>







<div id="myModal5" class="reveal-modal medium" data-animation="fade" style="background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px" >
    <h4>Assign Corrective Maintenance Task</h4>
    <hr />
    <div id="searchdata2"  >
        <div class="large-12 columns">
            <div class="large-3 columns">
                <strong>Start Date</strong>
            </div>
            <div class="large-9 columns">
                <input type="text" name="taskdate" id="taskdate" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="">
            </div>
            <div class="large-3 columns">
                <strong>maintenance Type</strong>
            </div>
            <div class="large-9 columns">
                <select  name="mtype" id="mtype">
                    <option value="Preventive"> Preventive Maintenance </option>
                    <option value="Corrective"> Corrective Maintenance </option>

                </select>
            </div>
            <div class="large-3 columns">
                <strong>Issue</strong>
            </div>
            <div class="large-9 columns">
                <textarea id="tissue" name="tissue"> <?php echo $this->ticket->issue ?></textarea>
            </div>


            <div class="large-3 columns">
                <strong>Technician</strong>
            </div>
            <div class="large-9 columns">
                <select name="emp" id="emp">
                    <?php
                    $employees = Employee::find_all();
                    foreach($employees as $emp){
                        echo "<option value='$emp->id'>$emp->emp_id; $emp->emp_fname $emp->emp_lname</option>";
                    }
                    ?>
                </select>

            </div>
        </div>


        <div class="large-12 columns">
            <div class="large-3 columns">
            </div>
            <div class="large-9 columns">
                <button class="button" id="csavell" name="csave">Save</button>
                <input name="disid" id="disid" value="" type="hidden">
                <input name="cemail" id="cemail" value="" type="hidden">
            </div>
        </div>
    </div>
    <a class="close-reveal-modal"><img src="public/icons/Close16.png" width="16" height="16" /></a>
</div>
