<div id="main">
	<div class="wrapper">
		<div class="container">
            <div class="row" style="margin:0; padding:0">
                <div class="col-12" style="margin:0; padding:0">
                    <div class="heading"><h2>Create User </h2>
                        <div class="button">
                            <ul>
                                <li><a class="btn btn-info" href="?url=users/index">&laquo; Back to Listing</a></li>
                            </ul>
                        </div><!--Ends Button-->
                    </div><!--Ends Heading-->
                </div><!--Ends Col-12-->
            </div><!--Ends Row-->
            <div class="row">
            	<div class="col-12">
                    <form class="form-horizontal" method="post" id="frmuser" name="frmuser" action="?url=users/doCreate" enctype="multipart/form-data">	
                    	
                        <div class="form-group">
                            <label for="sname" class="col-sm-2 control-label">Surname</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="sname" name="sname" placeholder="Surname">
                            </div>
                         </div>
                         <div class="form-group">
                            <label for="fname" class="col-sm-2 control-label">Firstname</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="fname" name="fname" placeholder="Firstname">
                            </div>
                         </div>
                         <!--<div class="form-group">
                            <label for="mname" class="col-sm-2 control-label">Othername(s)</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="oname" name="oname" placeholder="Othername(s)">
                            </div>
                         </div>-->
                         <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Telephone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="Telephone">
                            </div>
                         </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="fupload" class="col-sm-2 control-label">Photo</label>
                            <div class="col-sm-10">
                              <input name="fupload" id="fupload" type="file">
                            </div>
                          </div>
                          
                          <div class="form-group">
                          <label for="inputPassword3" class="col-sm-2 control-label"></label>
                            <div class=" col-sm-10">
                              <button type="submit" name="Submit" id="Submit" class="btn btn-primary">Save</button>
                            </div>
                          </div>
                    </form>
                </div>
            </div>
        </div><!--container-->
	</div><!--wrapper-->
</div><!--main-->