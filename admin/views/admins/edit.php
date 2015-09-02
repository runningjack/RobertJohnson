<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Edit Admin</h3>
        <a href="<?php echo URL;?>admins" class="button small right">Go Back</a>
    </div>
 	<div class="row">
    	<form action="<?php echo URL ?>admins/doUpdate/<?php echo $this->admin->admin_id ?>" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" >
     <fieldset>
       	    <legend>Edit Admin</legend>
      <div class="row">
        <div class="eight">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Name</label>
            </div>
            <div class="nine columns">
              <input type="text" id="right-label" placeholder="Name" name="name" value="<?php echo $this->admin->admin_name; ?>" required>
            </div>
          </div>
        </div>
        
        <div class="eight">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Email</label>
            </div>
            <div class="nine columns">
              <input type="text" id="right-label" placeholder="Email" name="email" value="<?php echo $this->admin->admin_email; ?>" required>
            </div>
          </div>
        </div>
        
        <div class="eight">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Password <small>(If you are not changing the password please leave empty)</small></label>
            </div>
            <div class="nine columns">
              <input type="password" id="right-label" placeholder="Password" name="password">
            </div>
          </div>
        </div>
        
        <div class="eight">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Repeat Password</label>
            </div>
            <div class="nine columns">
              <input type="password" id="right-label" placeholder="Repeat Password" name="rpassword">
            </div>
          </div>
        </div>

        <div class="eight">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Role</label>
            </div>
            <div class="nine columns">
              <select name="role" id="role" required="required"  >
                 <option value="Staff" <?php echo ($this->admin->admin_role == 'Staff') ? "selected='selected'" : ""?> >Staff</option>
                 <option value="Admin" <?php echo ($this->admin->admin_role == 'Admin') ? "selected='selected'" : ""?>>Admin</option>
                 <option value="Developer" <?php echo ($this->admin->admin_role == 'Developer') ? "selected='selected'" : ""?>>Developer</option>
             </select>
            </div>
          </div>
        </div>
                
        <div class="eight">
          <div class="row">
            <div class="three columns">
              <p>&nbsp;</p>
            </div>
            <div class="small-2 columns">
              <input type="submit" class="button" name="Submit" value="Save" id="submit"/>
            </div>
            <div class="small-2 columns">
              <input type="reset" class="button" name="Reset" value="Reset" id="submit"/>
            </div>
            <div class="small-5 columns">
            </div>
          </div>
        </div>
        
      </div>

  
      	 </fieldset>
        </form>

  </div><!-- Self defined -->
</div> 
