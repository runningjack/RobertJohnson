
	<div class="wrapper">
		<div class="container">
            <div class="row" style="margin:0; padding:0">
                <div class="col-12" style="margin:0; padding:0">
                    <div class="heading"><h2>User Linsting </h2>
                        <div class="button">
                            <ul>
                                <li><a class="btn btn-info" href="?url=users/create">Add New</a></li>
                            </ul>
                        </div><!--Ends Button-->
                    </div><!--Ends Heading-->
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