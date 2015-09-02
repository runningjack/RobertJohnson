<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Add New Admin</h3>
        <a href="<?php echo URL; ?>admins/index" class="button small right">Go Back</a>
    </div>
 	<div class="row">
    	<form action="<?php echo URL ?>admins/doCreate" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" >
     <fieldset>
       	    <legend>Add New Admin</legend>
      <div class="row">
        <div class="eight columns">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Name</label>
            </div>
            <div class="nine columns">
              <input type="text" id="right-label" placeholder="Name" name="name" required>
            </div>
          </div>
        </div>
        
        <div class="eight columns">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Email</label>
            </div>
            <div class="nine columns">
              <input type="text" id="right-label" placeholder="Email" name="email" required>
            </div>
          </div>
        </div>
        
        <div class="eight columns">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Password</label>
            </div>
            <div class="nine columns">
              <input type="password" id="right-label" placeholder="Password" name="password" required>
            </div>
          </div>
        </div>
        
        <div class="eight columns">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Repeat Password</label>
            </div>
            <div class="nine columns">
              <input type="password" id="right-label" placeholder="Repeat Password" name="rpassword" required>
            </div>
          </div>
        </div>

        <div class="eight columns">
          <div class="row">
            <div class="three columns">
              <label for="right-label" class="right inline">Role</label>
            </div>
            <div class="nine columns">
              <select name="role" id="role" required="required"  >
                 <option value="Staff" >Staff</option>
                 <option value="Admin">Admin</option>
                 <option value="Developer">Developer</option>
             </select>
            </div>
          </div>
        </div>
                
        <div class="eight columns">
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
