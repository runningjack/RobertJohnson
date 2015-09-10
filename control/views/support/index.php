	<?php $uri = new Url(""); ?>
    <h3 class="headline4">Customer Support Dashboard</h3>
<div class="large-12 columns">
    <div class="large-4  columns ">
        <div class="panel box callout ">
        <h3 style=" text-decoration: blink;">Task Monitor Console</h3>
        <hr />
        <div><p><strong>Total no of Open task(s):</strong> <a href="<?php echo $uri->link("support/scheduleList") ?>"><?php echo $this->oschedule ?> , View listing</a></p></div>
        <div><p><strong>Total no of pending tasks(s):</strong> <a href="<?php echo $uri->link("support/worksheetlist") ?>"><?php echo $this->oworksheet ?>, View listing</a></p></div>
        <div><p><strong>Total no of Conpleted task(s):</strong> <a href="<?php echo $uri->link("support/ticketlist") ?>"><?php echo $this->aticketcount ?>, View listing</a></p></div>
        </div>
    </div>
    <div class="large-4  columns ">
        <div class="panel box callout ">
        <h3 style=" text-decoration: blink;">Spending Summary</h3>
        <hr />
        <div><p><strong>This Month: <?php echo $this->monthreport ?> </strong></p></div>
        <div><p><strong>Last Month: <?php echo $this->lastmonthreport ?> </strong></p></div>
        <div><p><strong>This Quarter: <?php echo $this->thisquarter ?> </strong></p></div>
        
        <div><a href="?url=reports/index" >View Report</a></div>
        </div>
    </div>
    <div class="large-4  columns ">
        <div class="panel callout">
        <h3 style=" text-decoration: blink;">Support Alert</h3>
        <hr />
        <div><p><strong>No Opened Client Ticket(s):</strong> <a href="<?php echo $uri->link("support/ticketlist") ?>"><?php echo $this->oticketcount ?> , View listing</a></p></div>
        <div><p><strong>No Client Ticket Awaiting response(s):</strong> <a href="<?php echo $uri->link("support/ticketlist") ?>"><?php echo $this->aticketcount ?>, View listing</a></p></div>
        </div>
    </div>
</div>

<div class="row">
   <?php if(Session::getRole()){
    if(true){
        $modules = $_SESSION['emp_role_module'];
        foreach($modules as $module){
            $thisModule = Modules::find_by_module($module);
            echo"
            <div class='large-3  columns'><a href='". $uri->link($module.'/'.$thisModule->link) ."'><div class='".$thisModule->css_class."'>
             $thisModule->description</div></a>
            </div>";
        }
    }else{

    $this->view->render("access/restricted");
    }
    }

   ?>




</div>
<div class="row">
<div class="large-12 columns">

</div>
<br clear="All" />
</div>
</div><!--End column eight-->



