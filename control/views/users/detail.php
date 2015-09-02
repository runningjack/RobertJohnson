 <div class="row" style="width:96%; margin:10px auto">

	<!--this is beginning of the content   -->
	
	<!--this is beginning of the content   -->
    <div class="heading">
      <h1><img src="views/common_util/images/001_57.png" alt="" />Users</h1>
      <div class="buttons"><a onclick="location = '<?php echo $uri->link("Users/index/") ?>'" class="button">Add New</a><a onclick="location = '<?php echo $uri->link("Users/index/") ?>'" class="button">Cancel</a></div>
    </div>
    <div class='panelContainer'>
	<div class="twelve columns" role="content">

<?php
 /*echo "<h1>".$this->title."</h1><hr />";
 
 echo html_entity_decode($this->content);*/
 
?>
<div class="row">
    <div class="two columns">
        <div class="picture"><?php echo ($this->myuser->img_url !="" && file_exists("../public/uploads/".$this->myuser->img_url)) ?  "<img src='"."../public/uploads/".$this->myuser->img_url."' width='260' height='390' >" :"<img src='../public/uploads/anonymous.jpg' width='260' height='390' >"; ?></div>
        </div>
    <div class="ten columns">
        <div class="descriptText pad"><h4><?php echo $this->myuser->fname." ". $this->myuser->lname; ?></h4><hr />
        	<div class="row">
            	<div class="three columns">
                	<b> Firstname:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->myuser->fname ?>
                </div>
                
            </div>
            <div class="linethrough"></div>
            <div class="row">
            	<div class="three columns">
                	<b> Lastname:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->myuser->lname ?>
                </div>
            </div>
            <div class="linethrough"></div>
            <div class="row">
            	<div class="three columns">
                	<b> Address:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->myuser->address ?>
                </div>
            </div>
            <div class="linethrough"></div>
            <div class="row">
            	<div class="three columns">
                	<b> City:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->myuser->city ?>
                </div>
            </div>
            <div class="linethrough"></div>
             <div class="row">
            	<div class="three columns">
                	<b> State:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->myuser->state ?>
                </div>
            </div>
             <div class="linethrough"></div>
              <div class="row">
            	<div class="three columns">
                	<b> Country:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->myuser->country ?>
                </div>
            </div>
             <div class="linethrough"></div>
             <div class="row">
            	<div class="three columns">
                	<b> Email:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->myuser->email ?>
                </div>
            </div>
            <div class="linethrough"></div>
             <div class="row">
            	<div class="three columns">
                	<b> Phone:</b>
                </div>
                <div class="nine columns">
                	<?php echo $this->myuser->phone ?>
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

    