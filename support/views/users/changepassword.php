<div class="wrapper">

			<div class="container">
				<div class="heading">
				<h2>Change Password</h2>

					<div class="button">
						<ul>
							<!--
<li><a href="#">� Back To Listing</a></li>
-->
						</ul>
					</div><!--button-->
				</div><!--heading-->

				

				<div  id="changepass">
		       	    
			    <form action="<?php echo $uri->link("account/doUpdate") ?>" method="post" name="frmEmp" id="changePassword">
                <fieldset>
                <div id="transalert"></div>
                <legend>Change Password</legend>
                  <div class="row">
                      <div class="col-lg-12">
				    <div class="right-label">
				    <label>Old Password <span class="red">*</span></label>
				    </div>
				    
				    <input class="form-control" required="required" rel="catchable" name="opword" id="opword" type="password" />
				    <div id="tm"></div>
				    </div>
				  </div>
                  
				  <div class="row">
                      <div class="col-lg-12">
				    <div class="right-label">
				    <label>New password <span class="red">*</span></label>
				    </div>

				    <input class="form-control" required="required" rel="catchable" name="pword" id="pword" type="password" value="" />
				    <div id="tm"></div>
				    </div>
				  </div>
				  
				  				  
				  <div class="row">
                      <div class="col-lg-12">
				    <div class="right-label">
				    <label>Re-enter New Password<span class="red">*</span></label>
				    </div>

				    <input  class="form-control" name="pword2" id="pword2" type="password" rel="catchable" value="" />
				    <div id="costp"></div>
				    </div>
				  </div>
				  
				    <div class="row">
				   
				          <input name="task" id="task" value="" type="hidden" />
				          <input name="pgid" id="pgid" value="" type="hidden" />
				        
				       <a href="#" class="btn btn-primary" name="pwsave" rel="catchable"  id="changepw" > Save</a>
				          	 </div>   
                               </fieldset> 
				        </form>

		      	 
</div>
<script>
$(document).ready(function(){
            $('#changepw').click(function(){
                var srt = $("#changePassword").serialize();
                // alert is working perfect
				//$("#transalert").html(srt);
               // alert(srt);
                $.ajax({
                    type: 'POST',
                    url: '?url=account/doUpdate',
                    data: srt,
                    success: function(d) {
                        $("#transalert").html(d);
                    }
            });
			return false;
         });
       });

</script>


			</div><!--container-->
		</div>