 <div class="row" style="width:96%; margin:10px auto">

	<!--this is beginning of the content   -->
	
	<!--this is beginning of the content   -->
    <div class="heading">
      <h1><img src="views/common_util/images/001_57.png" alt="" />Contacts</h1>
      <div class="buttons"><a onclick="location = '<?php echo $uri->link("Contact/index/") ?>'" class="button">Add New</a><a onclick="location = '<?php echo $uri->link("Contact/index/") ?>'" class="button">Cancel</a></div>
    </div>
    <div class='panelContainer'>
	<div class="twelve columns" role="content">

<?php
 /*echo "<h1>".$this->title."</h1><hr />";
 
 echo html_entity_decode($this->content);*/
 
?>
<div class="row">

    
    <div class="twelve columns">
        <div class="descriptText pad"><h4>Contact Page Mails</h4><hr />
        	<div class="row">
            	<div class="three columns">
                	<b> Name:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->mycontact->contact_name ?>
                </div>
                
            </div>
            <div class="linethrough"></div>
            <div class="row">
            	<div class="three columns">
                	<b> Email:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->mycontact->contact_email ?>
                </div>
            </div>
            <div class="linethrough"></div>
            <div class="row">
            	<div class="three columns">
                	<b> Phone:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->mycontact->contact_phone ?>
                </div>
            </div>
            <div class="linethrough"></div>
           
             <div class="row">
            	<div class="three columns">
                	<b> Subject:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->mycontact->contact_topic ?>
                   
                 </div></div> <div class="linethrough"></div>
              <div class="row">
            	<div class="three columns">
                	<b>Message:</b>
                </div>
                <div class="nine columns">  
                    <div class="panel" style="margin:5px; padding:5px">
                    <?php echo $this->mycontact->contact_comment ?>
                    </div>
                </div>
            </div>
             <div class="linethrough"></div>
              
           
            
                
            
        <p>
        
        </p>
        
        
        </div>
	</div>
</div>
<div class="clear"></div>


<div class="divider"></div>
 <br />
      <!--<dl class="tabs">
        <dd class="active"><a href="#simple1">History</a></dd>
        <dd><a href="#simple2">My Requests &amp; Status</a></dd>
        <dd><a href="#simple3">My Wish List</a></dd>
      </dl>-->

      <!--<ul class="tabs-content">
        <li class="active" id="simple1Tab">
        	<table  width="100%">
                <thead><tr>
                    <th>ID</th><th>Resource Title</th><th>Booking Date</th><th>Return Date</th><th>Status</th>
                </tr>
                </thead>
                <tbody>-->
                <?php
				
                /*if($this->history){
                    foreach($this->history as $hist){
                    echo"<tr>
                        <td>$hist->issue_id</td><td>$hist->issue_resource_title</td><td>$hist->issue_date_issued</td><td>$hist->issue_return_date</td><td>$hist->issue_status</td></tr>";
                    }
                }else{
                    echo "<tr><td colspan='7'>There is no record to display</td></tr>";
                }*/
                ?>
                <!--</tbody>
            </table>
        </li>
        <li id="simple2Tab">
            <table  width="100%">
                <thead><tr>
                    <th>ID</th><th>Resource Title</th><th>Booking Date</th><th>Return Date</th><th>Status</th><th></th><th></th>
                </tr>
                </thead>
                <tbody>-->
                <?php
				
                /*if($this->mybooks){
                    foreach($this->mybooks as $book){
                    echo"<tr>
                        <td>$book->book_id</td><td>$book->resource_title</td><td>$book->book_date</td><td>$book->return_date</td><td>"; echo ($book->book_status == 0) ? "On Queue" : "Seen" ; echo "</td><td>";
						if($book->book_status ==0){
							echo"<a href='".$uri->link("account/doEditbook/".$book->book_id."")."'>Edit</a>";
							
						}
						echo"</td><td>";
						if($book->book_status ==0){
							echo"<a href='".$uri->link("account/doDeletebook/".$book->book_id."")."'>cancel</a>";
						}
                   	echo"</td></tr>";
                    }
                }else{
                    echo "<tr><td colspan='7'>There is no record to display</td></tr>";
                }*/
                ?>
               <!-- </tbody>
            </table>
		</li>
        <li id="simple3Tab">This is simple tab 3's content. It's, you know...okay.</li>
      </ul>-->
      </div>
    <br class="clear" />
    </div><!-- Self defined -->
 </div>
 <!--this is ending of the content   -->

   <div class="row">
<div class="twelve columns">
      <h3>Reply</h3>
      <p><a href="#" data-reveal-id="exampleModal" class="button">Reply Mail</a></p>
    </div>
 </div> 
 
 <div id="exampleModal" class="reveal-modal">
    
    
<form action="<?php echo $uri->link("contact/doReply") ?>" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge"  onReset="">

<div class="row">

            	<div class="twelve columns">
                	<b> Reply Mail</b>
                </div>
            	               	
                <div class="four columns">
                	<label for="right-label" class="left inline">To:</label>
                </div>
                <div class="eight columns">
    			<input name="to_email" type="text" id="to_email"  value="<?php echo $this->mycontact->contact_email ?>"    class="eight"  />
                </div>
  </div>
  <div class="row">              
                <div class="four columns">
                	<label for="right-label" class="left inline">Subject:</label>
                </div>
                <div class="eight columns">
    			<input  type="text" name="subject" id="subject" value="<?php echo 'Re:'.''.$this->mycontact->contact_topic ?>"  class="eight" />
                </div>
  </div>
  <div class="row">
                 <div class="four columns">
                	<label for="right-label" class="left inline">Message:</label>
                </div>
                <div class="eight columns">
    			<textarea name="message" id="message" cols="60" rows="5" class="inputBox required" class="eight"></textarea>
                </div>
            </div>
    	



             	    <input type="submit" class="button offset-by-five" name="Submit" value="SEND" id="submit"/>
             	    <input type="reset" class="button offset-by-one" name="cancel" value="CANCEL" />
             
        
        </form>
	
<a class="close-reveal-modal">×</a>
  </div>
</div> 