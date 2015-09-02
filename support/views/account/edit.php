<div class="wrapper">

			<div class="container">
				<div class="heading">
				<h2>Contact Info</h2>

					<div class="button">
						<ul>
							<!--
<li><a href="#">« Back To Listing</a></li>
-->
						</ul>
					</div><!--button-->
				</div><!--heading-->
    <div id="mmm">
				<div class="transalert"></div>

				<fieldset><div id="transalert"></div>
		       	    <legend>Edit Contact Profile</legend>
			    <form action="<?php echo $uri->link("account/doUpdate") ?>" method="post" name="frmEmp" id="frmEmp">
				  <div class="row">
				    <div class="right-label">
				    <label>Contact Name</label>
				    </div>
				    <div>
				    <input class="col-6" name="cname" id="cname" rel="catchable" type="text" value="<?php echo $this->myaccount->contact_name ?>" />
				    </div>
				  </div>
				  
				  
				  <div class="row">
				    <div class="right-label">
				    <label>Contact Phone <span class="red">*</span></label>
				    </div>
				    <div>
				    <input class="col-6" required="required" rel="catchable" name="cphone" id="cphone" type="text" value="<?php echo $this->myaccount->contact_phone ?>" />
				    <div id="tm"></div>
				    </div>
				  </div>
				  
				  				  
				  <div class="row">
				    <div class="right-label">
				    <label>Email<span class="red">*</span></label>
				    </div>
				    <div>
				    <input  class="col-6" name="cemail" id="cemail" rel="catchable" type="text" value="<?php echo $this->myaccount->contact_email ?>" />
				    <div id="costp"></div>
				    </div>
				  </div>
				  
				   
				  
				  			  
				  

				    <div class="row">
				    
				   
				          <input name="task" id="task" value="" type="hidden">
				          <input name="pgid" id="pgid" value="" type="hidden">
				        
				       <a href="#" id="psave" class="btn btn-primary">Save</a>
				          	 </div>    
                             </fieldset>
				        </form>

		      	 

</div>


			</div><!--container-->
		</div>