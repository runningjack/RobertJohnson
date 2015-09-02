<div id="main">
	<div class="wrapper">
		<div class="container">
            <div class="row" style="margin:0; padding:0">
                <div class="col-12" style="margin:0; padding:0">
                    <div class="heading"><h2>Maintain User </h2>
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
                    <form class="form-horizontal" method="post" id="frmuser" name="frmuser" action="?url=users/doUpdate" enctype="multipart/form-data">	
                    <input type="hidden" name="mid" id="mid" value="<?php echo $this->myuser->user_id ?>"  />
                    	
                        <div class="form-group">
                            <label for="sname" class="col-sm-2 control-label">Surname</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="sname" name="sname" value="<?php echo $this->myuser->lname ?>" placeholder="Surname">
                            </div>
                         </div>
                         <div class="form-group">
                            <label for="fname" class="col-sm-2 control-label">Firstname</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $this->myuser->fname ?>" placeholder="Firstname">
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
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="Telephone" value="<?php echo $this->myuser->phone ?>">
                            </div>
                         </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $this->myuser->email ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $this->myuser->password ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                          
                            <div  class="col-sm-2 ">
                            
                            <img src='<?php echo !empty($this->myuser->img_url) && file_exists("public/uploads/".$this->myuser->img_url) ? "public/uploads/".$this->myuser->img_url :"public/img/anonymous.jpg" ; ?>' width="100" height='100' /><hr /> <strong>Photo</strong>
                            
                            </div>
                            <div class="col-sm-10">
                              <input name="fupload" id="fupload" type="file">
                              <input type="hidden" id="imgvalue" name="imgvalue" value="<?php echo $this->myuser->img_url ?>"
                            </div>
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