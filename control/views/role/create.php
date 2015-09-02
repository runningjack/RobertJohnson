<div class="panel callout">
	<h4 style="display:inline">Add New Role</h4>
    
    <a href="<?php 
        global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("dashboard/index");
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo $uri->link("dashboard/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
    
    ?>"><a href="<?php echo $uri->link("role/index") ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
</div>
<div id='transalert'></div>
    <form action="<?php echo $uri->link("role/doCreate/") ?>" method="post" name="frmpriviledge"  id="frmpriviledge" >
     <fieldset>
       	    <legend>Add New Role</legend>
  	<div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Title</label>
    </div>
    <div class="large-10 columns">
    <input type="text" placeholder="Caption" class="six" required='required'  name="rolename" id="rolename" value="<?php //echo $article->page_caption ?>"/>
    </div>
    </div>
    <div class="linethrough"></div>
    <div class="row">
    <div class="large-2 columns">
    <label for="right-label" class="left inline">Description</label>
    </div>
    <div class="large-10 columns">
      <textarea cols="10" name="description" id="description"  value="<?php /*echo $this->myarticle->page_desc*/ ?>" ></textarea>
    </div>
    </div>
    <div class="linethrough"></div>
    <div class="row">
    
   
        
          <input type="hidden" name="pgid" id="pgid" value="<?php //echo (isset($_GET['pageid']) && !empty($_GET['pageid'])) ? $_GET['pageid'] : "" ?>">
        
           
       <input type="submit" class="button offset-by-five" name="save" value="Save" id="save"/>
             	    <input type="reset" class="button offset-by-one" name="cancel" value="Cancel" />
                    </div>
      	 </fieldset>
        </form>
        

