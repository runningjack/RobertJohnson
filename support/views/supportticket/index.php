<div id="main">
		<div class="wrapper">
			<div class="container">
				
				
<div class="heading"><h2>Tickets </h2>
					<div class="button">
						<ul>
							<li><a href="<?php echo $uri->link("supportticket/create") ?>">Create Ticket</a></li>
                            <li><a data-toggle="modal" data-target="#myModal">Search</a></li>
						</ul>
                 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Search</h4>
                      </div>
                      <form action="<?php echo $uri->link("supportticket/search") ?>" method="post" role="form">
                      <div class="modal-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Subject</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Subject" name="subject" value="<?php echo isset($_POST["subject"]) && !empty($_POST['subject']) ? $_POST['subject'] : ""; ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Ticket ID</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ticket ID" name="id" value="<?php echo isset($_POST["id"]) && !empty($_POST['id']) ? $_POST['id'] : ""; ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Product</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Product" name="product" value="<?php echo isset($_POST["prod_name"]) && !empty($_POST['prod_name']) ? $_POST['prod_name'] : ""; ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Priority</label>
                            <select name="priority">
                            	<option value="">Select Priority</option>
                            	<option value="low" <?php echo isset($_POST["priority"]) && $_POST['product'] == "low" ? "selected='selected'" : ""; ?>>Low</option>
                                <option value="medium" <?php echo isset($_POST["priority"]) && $_POST['product'] == "medium" ? "selected='selected'" : ""; ?>>Medium</option>
                                <option value="high" <?php echo isset($_POST["priority"]) && $_POST['product'] == "high" ? "selected='selected'" : ""; ?>>High</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Department</label>
                            <select name="dept">
                            	<option value="">Select Department</option>
                            	<option value="Support" <?php echo isset($_POST["dept"]) && $_POST['dept'] == "Support" ? "selected='selected'" : ""; ?>>Technical Supports</option>
                                <option value="Sales" <?php echo isset($_POST["dept"]) && $_POST['dept'] == "Sales" ? "selected='selected'" : ""; ?>>Sales</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status">
                            	<option value="">Select Status</option>
                            	<option value="Open" <?php echo isset($_POST["status"]) && $_POST['status'] == "Open" ? "selected='selected'" : ""; ?>>Open</option>
                                <option value="Customer Reply" <?php echo isset($_POST["status"]) && $_POST['status'] == "Customer Reply" ? "selected='selected'" : ""; ?>>Customer Reply</option>
                                <option value="Closed" <?php echo isset($_POST["status"]) && $_POST['status'] == "Closed" ? "selected='selected'" : ""; ?>>Closed</option>
                            </select>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                      </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
					</div>
				</div><!--button-->
                <br />
                <div class='transalert'><?php global $session; isset($_SESSION['message']) ? $_SESSION['message'] : "" ?></div>
				<?php echo $this->myvends; ?>
	     
			</div><!--container-->
		</div><!--wrapper-->
</div><!--main--