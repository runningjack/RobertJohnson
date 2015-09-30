<div id="main">
		<div class="wrapper">

			<div class="container">
                <div class="row no-print">
                    <div class="col-xs-12">
                        <!--<a href="javascript:void(0)" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
                        <a href="<?php echo $uri->link("supportticket/index") ?>" class="btn btn-success pull-right"><i class="fa fa-backward"></i>Back To Listing</a>

                    </div>
                </div>
			  <div class="row">


					<div class="col-lg-12">
                        <h2>Ticket Reply </h2>
					</div><!--button-->
				</div><!--heading-->
				                
     
     <?php echo $this->myReplyData; ?>
     
        
            </div><!--container-->
		</div><!--wrapper-->
	</div>