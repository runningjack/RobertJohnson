
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
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $this->tickopencount ?></h3>
                <p>Opened Tickets</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo $uri->link("supportticket/index") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $this->tickpendingcount ?></h3>
                <p>Pending Ticket</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo $uri->link("supportticket/index") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= $this->tickclosedcount ?></h3>
                <p>Closed Tickets</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo $uri->link("supportticket/index") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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



        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3><?= $this->usercount ?></h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= $_SESSION['user_role'] ==="admin" ? $uri->link("users/index") : "#"; ?>" class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>

            </div>
        </div><!-- ./col -->

</div><!-- /.row -->



