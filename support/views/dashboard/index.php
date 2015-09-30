
<div class="row">
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo $this->prodcount ?></h3>
                <p>ATM Terminals</p>
            </div>
            <div class="icon">
                <i class="ion ion-object-group"></i>
            </div>
            <a href="<?php echo $uri->link("services/index") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= $this->tickopencount ?></h3>
                <p>Opened Tickets</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo $uri->link("supportticket/index&status=Open") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3><?= $this->tickpendingcount ?></h3>
                <p>In Progress Tickets</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo $uri->link("supportticket/index&status=Pending") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $this->tickclosedcount ?></h3>
                <p>Closed Tickets</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo $uri->link("supportticket/index&status=Closed") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-2 col-xs-6">
              <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3><?= $this->tickcount ?></h3>
                    <p>Total Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo $uri->link("supportticket/index") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->


    <?php
    global $session;
    $user = Client::find_by_id($_SESSION['client_ident']);
    if($_SESSION['user_role'] =="admin"){
        echo "<div class='col-lg-2 col-xs-6'>
            <!-- small box -->
            <div class='small-box bg-teal'>
                <div class='inner'>
                    <h3>$this->usercount </h3>
                    <p>Users</p>
                </div>
                <div class='icon'>
                    <i class='ion ion-person-add'></i>
                </div>
                <a href='";echo $_SESSION['user_role'] ==='admin' ? $uri->link("users/index") : "javascript:void(0)" ; echo "' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>

            </div>
        </div>";
    }elseif(strtolower($_SESSION['user_role']) =="standard user" || strtolower($_SESSION['user_role']) =="standard" ){
        $me = Clientuser::find_by_id($_SESSION['user_ident']);

    }
    ?>


</div><!-- /.row -->

<div class="row">
    <div class="col-lg-6">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Terminals On Service Schedules</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div><!-- /.box-headerclass="table no-margin" -->
        <div class="box-body">
            <div class="table-responsive">
                <?php
                if(count($this->cschedule) >0){
                    echo "<table class='pure-table'  width='100%'>
                    			<thead><tr>
                    				<th>Term. ID</th><th>Location</th><th>Schedule Date</th><th>Engineer</th><th></th><th></th>
                    			</tr>
                    			</thead>
                    			<tbody>";
                    foreach($this->cschedule as $sched){

                        $cproduct = Cproduct::find_by_id($sched->prod_id);
                       // var_dump($cproduct);
                        if($cproduct){
                            echo"<tr><td>". $cproduct->terminal_id."</td><td>".$cproduct->install_address."</td><td>". date_format(date_create($sched->s_date),"M d Y ")."</td><td>$sched->emp_name</td>
                            <td><span class='";

                            if(strtolower($sched->status) == "open"){
                                echo" label bg-red ";
                            }elseif(strtolower($sched->status) == "closed"){
                                echo" label bg-green ";
                            }elseif(strtolower($sched->status) == "in progress" ){
                                echo" label bg-blue ";
                            }

                            echo"'>$sched->status</span></td><td><a href='".$uri->link("supportticket/detail/".$sched->ticket_id."")."'>Details</a></td></tr>" ;
                        }

                    }
                    echo "</tbody>
			                     </table>";
                }
                ?>
            </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">

            <a href="<?= $uri->link("supportticket/index") ?>" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
        </div><!-- /.box-footer -->
    </div>
    </div>

    <div class="col-lg-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Activation Requests</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-headerclass="table no-margin" -->
            <div class="box-body">
                <div class="table-responsive">
                    <?php
                    if(count($this->cscheduleActivation) >0){
                        echo "<table class='pure-table'  width='100%'>
                    			<thead><tr>
                    				<th>Term. ID</th><th>Location</th><th>Schedule Date</th><th>Engineer</th><th></th><th></th>
                    			</tr>
                    			</thead>
                    			<tbody>";
                        foreach($this->cscheduleActivation as $sched){

                            $cproduct = Cproduct::find_by_id($sched->prod_id);
                            // var_dump($cproduct);
                            if($cproduct){
                                echo"<tr><td>". $cproduct->terminal_id."</td><td>".$cproduct->install_address."</td><td>". date_format(date_create($sched->s_date),"M d Y ")."</td><td>$sched->emp_name</td>
                            <td><span class='";

                                if(strtolower($sched->status) == "open"){
                                    echo" label bg-red ";
                                }elseif(strtolower($sched->status) == "closed"){
                                    echo" label bg-green ";
                                }elseif(strtolower($sched->status) == "in progress" ){
                                    echo" label bg-blue ";
                                }

                                echo"'>$sched->status</span></td><td><a href='".$uri->link("supportticket/actdetails/$sched->ticket_id")."'>Details</a></td></tr>" ;
                            }

                        }
                        echo "</tbody>
			                     </table>";
                    }
                    ?>
                </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">

                <a href="<?= $uri->link("supportticket/activationlist") ?>" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
            </div><!-- /.box-footer -->
        </div>
    </div>


</div>


<div class="row">
    <div class="col-lg-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Service</h3>
            <h4>Schedule Preventive Maintenance Date</h4>
            <!--<div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>-->
        </div><!-- /.box-headerclass="table no-margin" -->
        <div class="box-body">
            <div class="table-responsive">
                <?php
                if(count($this->schedule) >0){
                    echo "<table class='pure-table'>
                    			<thead><tr>
                    				<th width='20%'>Prod Name</th><th width='30%'>Location</th><th width='20%'>Schedule Date</th>
                    			</tr>
                    			</thead>
                    			<tbody>";
                    foreach($this->schedule as $sched){

                        echo"<tr><td>$sched->prod_id, $sched->prod_name</td><td> $sched->install_address $sched->install_state</td><td>". date_format(date_create($sched->next_maint_date),"M d Y")."</td></tr>" ;
                    }
                    echo "</tbody>
			                     </table>";
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</div>

<script type="text/javascript">
    jQuery.noConflict();
    (function($) {
        //setInterval(window.location.reload(),1050000)
    })(jQuery);

</script>



