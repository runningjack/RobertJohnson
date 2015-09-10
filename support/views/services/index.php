<div id="main">
		<div class="wrapper">
			<div class="container">
				
				
<div class="heading"><h2>Products &amp; Services</h2>
					<!--<div class="button">
						<ul>
							<li><a data-toggle="modal" data-target="#myModal">
  Search
</a></li>
						</ul>
					</div>-->
				</div><!--button-->
                
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="myModalLabel">Search</h3>
                      </div>
                      <form action="<?php echo $uri->link("services/search") ?>" method="post" role="form">
                      <div class="modal-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Product</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Product" name="product" value="<?php echo isset($_POST["product"]) && !empty($_POST['product']) ? $_POST['product'] : ""; ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Serial Number</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Serial Number" name="serial_no" value="<?php echo isset($_POST["serial_no"]) && !empty($_POST['serial_no']) ? $_POST['serial_no'] : ""; ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Location</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Location" name="location" value="<?php echo isset($_POST["location"]) && !empty($_POST['location']) ? $_POST['location'] : ""; ?>">
                          </div>
                          <div class="form-group">
                          <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
                          <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
                          <script>
						  $(function() {
							$( "#datepicker" ).datepicker({
								changeMonth: true,
      							changeYear: true
								});
						  });
						  </script>
                            <label for="exampleInputPassword1">Date Installed</label>
                            <input type="text" class="form-control" id="datepicker" placeholder="Date Installed" name="date" value="<?php echo isset($_POST["date"]) && !empty($_POST['date']) ? $_POST['date'] : ""; ?>">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                      </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

				<!--<div class="success">Added Successfully</div>
				<div class="error">Error Adding</div>-->
                
				<?php echo $this->myservs; ?>
	     
			</div><!--container-->
		</div><!--wrapper-->
</div><!--main--