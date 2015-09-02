<div class="panel callout">
	<h4 style="display:inline">New Role</h4>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("role/index") ?>"> &laquo;Back To Listing</a></span>
</div>
<div id='transalert'></div>

    <h3><?php echo $this->myrole->role_name; ?></h3>
    <form action="<?php echo $uri->link("role/doCreatePreviledges/") ?>" method="post"  name="frmpriviledgeUpdate"  id="frmpriviledgeUpdate" ><fieldset><div id="transalert"></div>
     <fieldset>
       	    <legend>Manage Priviledges for <h4 style="display: inline; color: #ff764a;"><?php echo $this->myrole->role_name; ?></h4></legend>
  
            <?php echo $this->mygrant ?>
   
          <input type="hidden" name="task" id="task" value="<?php //echo (isset($_GET['task']) && !empty($_GET['task'])) ? $_GET['task'] : "" ?>">
          <input type="hidden" name="pgid" id="pgid" value="<?php echo $this->myrole->role_id ?>" />
        
           
       <input type="submit" class="button offset-by-five" name="update" value="Update" id="update"/>
             	    
      	 </fieldset>
        </form>
        
