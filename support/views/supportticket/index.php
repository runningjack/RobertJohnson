<div id="main">
		<div class="wrapper">
			<div class="container">
                <div class="row no-print">
                    <div class="col-xs-12">
                        <!--<a href="javascript:void(0)" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
                        <a href="<?php echo $uri->link("supportticket/create") ?>" class="btn btn-success pull-right"><i class="fa fa-sticky-note"></i> Create Ticket</a>

                    </div>
                </div>


				
<div class="heading"><h2>Tickets </h2><hr>

                <div class='transalert'><?php global $session; isset($_SESSION['message']) ? $_SESSION['message'] : "" ?></div>
				<?php echo $this->myvends; ?>
	     
			</div><!--container-->
		</div><!--wrapper-->
</div><!--main-->
    </div>
