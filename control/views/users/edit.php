 <div class="row" style="width:96%; margin:10px auto">

	<!--this is beginning of the content   -->
	
	<!--this is beginning of the content   -->
    <div class="heading">
      <h1><img src="views/common_util/images/001_57.png" alt="" />Users</h1>
      <div class="buttons"><a onclick="location = '<?php echo $uri->link("Users/index/") ?>'" class="button">Add New</a><a onclick="location = '<?php echo $uri->link("Users/index/") ?>'" class="button">Cancel</a></div>
    </div>
    <div class='panelContainer'>
	<div class="twelve columns" role="content">
   
    <div id='malert'></div>
	
    	<form action="<?php echo $uri->link("Users/doUpdate") ?>" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge"  onReset="">
       	  <fieldset> 
             	    <legend>Add New Menu</legend>
<div class="row">
    <div class="two columns">
    	<label for="right-label" class="left inline">Username</label>
    </div>
    <div class="ten columns">
    	<input type="text" placeholder="Username" class="six" id="uname" name="uname" required="required" value ="<?php echo $this->myuser->username ?>" />
        <input type="hidden" id="mid" name="mid" value="<?php echo $this->myuser->user_id ?>"  />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="two columns">
    	<label for="right-label" class="left inline">Firstname</label>
    </div>
    <div class="ten columns">
    	<input type="text" placeholder="Firstname" class="six" id="fname" name="fname" required="required" value="<?php echo $this->myuser->fname ?>"  />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="two columns">
    	<label for="right-label" class="left inline">Lastname</label>
    </div>
    <div class="ten columns">
    	<input type="text" placeholder="Lastname" class="six" id="lname" name="lname" required="required" value="<?php echo $this->myuser->lname ?>"  />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="two columns">
    	<label for="right-label" class="left inline">Password</label>
    </div>
    <div class="ten columns">
    	<input type="password"  class="six"   required='required' name="password" id="password" value="<?php echo $this->myuser->password ?>" />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="two columns">
    	<label for="right-label" class="left inline">Email</label>
    </div>
    <div class="ten columns">
    	<input type="email" class="six" name="email" id="email" value="<?php echo $this->myuser->email ?>" />
    </div>
</div>
<div class="linethrough"></div>            
<div class="row">
    <div class="two columns">
    	<label for="right-label" class="left inline">Telephone</label>
    </div>
    <div class="ten columns">
    	<input type="text" name="phone" id="phone" value="<?php echo $this->myuser->phone ?>" class="six" />
    </div>
</div>
<div class="linethrough"></div>
<div class="row">
    <div class="two columns">
    	<label for="right-label" class="left inline">Role</label>
    </div>
    <div class="ten columns">
        <?php
    					if($this->allroles){
							$y=0;
							$user_role = explode(",",$this->myuser->user_role);
							foreach($this->allroles as $role){
								if(in_array($role->role_name, $user_role)){
                                echo"<label for='utype{$y}'>
                      <input  type='checkbox' value='$role->role_name' name='utype{$y}' id='utype{$y}' checked='checked' /> $role->role_name </label>" ;
								}else{
									echo"<label for='utype{$y}'>
                      <input  type='checkbox' value='$role->role_name' name='utype{$y}' id='utype{$y}' /> $role->role_name </label>" ;
								}
					  $y++;
                            }
							echo"<input type='hidden' name='limit' id='limit' value='$y' />";
                        }
    		?>      	      
    </div>
</div>   

<div class="linethrough"></div>
<div class="row">
    <div class="two columns">
    	<label for="right-label" class="left inline">Image</label>
        <div><?php echo ($this->myuser->img_url !="" && file_exists(DIR_PUBLIC."uploads/".$this->myuser->img_url)) ?  "<img src='".DIR_PUBLIC."uploads/".$this->myuser->img_url."' width='50' height='60' >" :"<img src='".DIR_PUBLIC."images/anonymous.jpg' width='50' height='60' >"; ?></div>
    </div>
    <div class="ten columns">
   		<input type="file" name="fupload" id="fupload" class="six" >
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
    <br class="clear" />
    </div><!-- Self defined -->
 </div>
 <!--this is ending of the content   -->

    