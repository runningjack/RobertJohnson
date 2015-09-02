	<div class="large-9 columns" role="conlarge-10t">
   
    <div id='malert'></div>
	
    	<form action="<?php  echo $uri->link("Users/doCreate") ?>" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge"  onReset="">
 
    
 
       	  <fieldset> 
             	    <legend>Add New Menu</legend>
<div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Username</label>
    </div>
    <div class="large-10 columns">
    	<input type="text" placeholder="Username" class="large-6 columns" id="uname" name="uname" required="required"  />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Firstname</label>
    </div>
    <div class="large-10 columns">
    	<input type="text" placeholder="Firstname" class="large-6 columns" id="fname" name="fname" required="required"  />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Lastname</label>
    </div>
    <div class="large-10 columns">
    	<input type="text" placeholder="Lastname" class="large-6 columns" id="lname" name="lname" required="required"  />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Password</label>
    </div>
    <div class="large-10 columns">
    <input type="password"  class="large-6 columns"   required='required' name="password" id="password" value="" />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Email</label>
    </div>
    <div class="large-10 columns">
    <input type="email" class="large-6 columns" name="email" id="email" value="" />
    </div>
</div>
<div class="linethrough"></div>            
<div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Telephone</label>
    </div>
    <div class="large-10 columns">
             	      <input type="text" name="phone" id="phone" value="" class="large-6  columns" />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Role</label>
    </div>
    <div class="large-10 columns">
    		<?php
    					if($this->allroles){
							$y=0;
							foreach($this->allroles as $role){
                                echo"<label for='utype{$y}'>
                      <input  type='checkbox' value='$role->role_name' name='utype{$y}' id='utype' /> $role->role_name </label>" ;
					  $y++;
                            }
							echo"<input type='hidden' name='limit' id='limit' value='$y' />";
                        }
    		?>
             	      <!--<select id="utype" name="utype" class="large-6" >
                      	<option value="Administrator">Administrator</option>
                        <option value="Developer">Developer</option>
                        <option value="User">User</option>
                      </select>-->
                      
    </div>
</div>   

<div class="linethrough"></div>
<div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Image</label>
    </div>
    <div class="large-10 columns">
   <input type="file" name="fupload" id="fupload" class="large-6  columns" >
    </div>
</div>
<div class="linethrough"></div>

             	    <input type="submit" class="button offset-by-five" name="Submit" value="Save" id="submit"/>
             	    <input type="reset" class="button offset-by-one" name="cancel" value="Cancel" />
             <!-- <input type="submit" class="button offset-by-five" name="Register" />
                <input type="reset" class="button offset-by-one" name="Reset All" />
                -->
        	</fieldset>
        </form>

	</div>
   