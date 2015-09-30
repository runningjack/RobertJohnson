
	<div class="wrapper">
		<div class="container">
            <div class="row no-print">
                <div class="col-xs-12">
                    <!--<a href="javascript:void(0)" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
                    <a href="<?php echo $uri->link("users/create") ?>" class="btn btn-success pull-right"><i class="fa fa-backward"></i> Add New User</a>

                </div>
            </div>
            <div class="row" style="margin:0; padding:0">
                <div class="col-12" style="margin:0; padding:0">
                    <div class="transalert"><?php echo (isset($_SESSION['message']) && !empty($_SESSION['message'])) ? $_SESSION['message'] : "" ?></div>
                    <h2>User Listing </h2>
                </div><!--Ends Col-12-->
            </div><!--Ends Row-->
            <div class="row">
            	<div class="col-12">
                	<div class='transalert'><?php global $session; isset($_SESSION['message']) ? $_SESSION['message'] : "" ?></div>
                	<div id="usertable">
						<?php echo $this->myusers; ?>
                    </div>
                </div>
            </div>
        </div><!--container-->
	</div><!--wrapper-->

<br clear="all" />