<h3 class="headline4">Technical Department (My Account)</h3>
<div id='secondModal' class='reveal-modal'>
   
    <h2 id='report'></h2>
    <a class='close-reveal-modal'>&#215;</a>
  </div>
<div class="row">
    <div class="large-12 columns">
    <h4 class="headline3"><?php echo $this->mee->emp_fname." ".$this->mee->emp_lname; ?></h4>
        <div class="large-4 columns">
        <?php
            echo (!empty($this->img_url) && file_exists("public/img/$this->img_url")) ? '<img src="public/img/$this->img_url" width="150" height="150" />':'<img src="public/img/anonym.png" width="150" height="150" />';
        ?>
        
        </div>
        <div class="large-8 columns">
            <div class="row">
                <div class="large-6 columns">
                </div>
                <div class="large-6 columns">
                    <div class="internalpadding">

                        <div class="page-header">
                            <div class="styled_title">
                                <h2>Account Overview</h2>
                            </div>
                        </div>
            
                        <p>Number of task Assigned: <a href="#"></a></p>
                        <p>Number of of Task Attended: <a href="#"></a></p>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="large-12 columns">
    <h4 class="headline3">Current Task</h4>
    <div id="scheddata">
         <?php  echo $this->schedule ?>
    </div>
    </div>
    
    
    <div class="large-12 columns">
    <h4 class="headline3">Past History</h4>
        
        <?php  echo $this->oldtask ?>
        
    </div>

</div>