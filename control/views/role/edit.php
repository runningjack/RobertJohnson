<div class="large-9 columns centre" role="content">
<!-- Table goes in the document BODY -->
<div class="panel callout">
	<h4 style="display:inline">Maintain Role</h4>
    <span class="button secondary right" style="display:inline"><a href="<?php echo $uri->link("role/index") ?>"> &laquo;Back To Listing</a></span>
</div>
    <form action="<?php echo $uri->link("role/doUpdate/") ?>" method="post"  name="frmpriviledgeUpdate"  id="frmpriviledgeUpdate" ><fieldset><div id="transalert"></div>
     <fieldset>
       	    <legend>Modify Employee Role</legend>
  <div class="row">
    <div class="two columns">
    <label for="right-label" class="left inline">Title</label>
    </div>
    <div class="ten columns">
    <input type="text" placeholder="Caption" class="six" required='required'  name="rolename" id="rolename" value="<?php echo $this->myrole->role_name ?>"/>
    </div>
    </div>
    <div class="linethrough"></div>
    <div class="row">
    <div class="two columns">
    <label for="right-label" class="left inline">Description</label>
    </div>
    <div class="ten columns">
      <textarea cols="10" name="description" id="description" > <?php echo $this->myrole->role_description ?> </textarea>
    </div>
    </div>
    <div class="linethrough"></div>
    <div class="row">
    
   
          <input type="hidden" name="task" id="task" value="<?php //echo (isset($_GET['task']) && !empty($_GET['task'])) ? $_GET['task'] : "" ?>">
          <input type="hidden" name="pgid" id="pgid" value="<?php echo $this->myrole->role_id ?>" />
        
           
       <input type="submit" class="button offset-by-five" name="update" value="Update" id="update"/>
             	    
      	 </fieldset>
        </form>
        
    </div>