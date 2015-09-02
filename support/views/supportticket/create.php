<style type='text/css'>
input[type='checkbox']{
	background: none;
    border-color: none;
    border-radius: 0px;
	border: none;
	box-shadow: none;
	color: none;
	padding: 0 5px 0 0;
	height: auto;
	width: auto;
	
	-moz-box-sizing: none;
	transition: none;
}
</style>
<div id="main">
		<div class="wrapper">

			<div class="container">
			  <div class="heading">
				<h2>Add New </h2>

					<div class="button">
						<ul>
							<li><a href="#">« Back To Listing</a></li>
						</ul>
					</div><!--button-->
				</div><!--heading-->

				                
		<form action="<?php echo $uri->link("supportticket/doCreate") ?>" method="post" enctype="multipart/form-data" name="frmEm" id="frmEm">
	     <fieldset><div id="transalert"></div>
   	       <legend><h3>Open Ticket</h3></legend>
	            <table width="100%" border="0">
                    <tr>
                        <td width="39%">
                            <label>Terminal ID *</label>

                            <input type="text"  name="terminal_id" required="required"/>
                        </td>
                        <td width="20%"><label>ATM Type <span class="red">*</span></label>

                            <input type="text"   name="atm_type" required="required" /></td>
                        <td width="41%">

                            <label>Branch <span class="red">*</span></label>

                            <input type="text"   name="branch" required="required" />

                        </td>
                    </tr>  </td>
		              <tr>
		                <td width="39%">
		                    <label>Contact Person Name *</label>
		                  
		                    <input type="text"  name="cname" required="required" />
	                      </td>
		                <td width="20%"><label>Contact Person Phone <span class="red">*</span></label>
	                      
		                    <input type="text"   name="phone" required="required" /></td>
		                <td width="41%">
		                  
		                    <label>Contact Person Email <span class="red">*</span></label>
	                      
		                    <input type="email"   name="email" />
		                    <div id="tm2"></div>
	                      </td>
                  </tr>  </td>
                  </tr>
		              <tr>
		                <td colspan="3">
		                  
		                    <label><strong>Issue Type</strong><span class="red">*</span></label>
		                    
		                    <div class="row">
                           
	                      <?php
						  	if($this->issues){
								foreach($this->issues as $issue){
									echo"<div class='col-2'><label for='".$issue->issue_accronym."'><input type='checkbox' name='".$issue->issue_accronym."' id='".$issue->issue_accronym."' value='".$issue->issue_name."' />".$issue->issue_name."<label></div>";
								}
							}
						  ?>
                          </div>
	                      
		                    <input type="hidden"   name="subject"  />
		                    <div id="tm3"></div>
	                      </td>
                  </tr>
		              <tr>
		                <td>
		                  
		                    <label>Support Type <span class="red">*</span></label>
	                      
		                    <select id="dept" name="dept">
                          	<option value="Support">Technical Support</option>
                            <option value="Sales">Sales </option>
                            <option value="Billing">Billing</option>
                            <option value="Security">Security</option>
                           </select>
		                    <div id="tm4"></div>
	                      </td>
		                <td>
		                  <label> Priority Level</label>
		                    
	                      
		                    <select id="plevel" name="plevel">
                            <option value="Low">Low</option>
                          	<option value="Medium">Medium</option>
                            <option value="High">High</option>
                           </select>
		                    <div id="tm6"></div>
	                      </td>
		                <td>
		                  
		                   <label>Product/Location <span class="red">*</span></label>
		                   
		                   
		                   
		                   
		                    <input autocomplete="off" type="text"  class="six" required='required' value="<?php  ?>"  name="prodname" id="prodname" required="required"/>
    <div id="mySearchContainer" style="position: absolute;">
                    <div id="lcpsearchinner2"></div>
                </div>

    <input type="hidden" name="service" id="service" value="<?php  ?>" />
    <div id="tm"></div>
    
		                   
		                   
		                   
		                   
		                   
	                     
		                   
		                    <div id="tm5"></div></td>
                  </tr>
		              <tr>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
                  </tr>
		              <tr>
		                <td><strong>Issue Description</strong></td>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
                  </tr>
		              <tr>
		                <td colspan="3"><textarea  name="issue" ></textarea></td>
                  </tr>
                  <tr>
		                <td colspan="3">
		                  
		                    <label>Emails to Copy (Seperate with comma)</label>
	                      
		                    <input type="text"   name="ccemail" id='ccemail'  />
		                    <div id="tm3"></div>
	                      </td>
                  </tr>
		              <tr>
		                <td><label for="fupload">Attach file</label>
                        <input type="file" name="fupload" id="fupload"></td>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
                  </tr>
		              <tr>
		                <td>&nbsp;</td>
		                <td><input type="submit" id="submit" name='submit' value="Submit"></td>
		                <td></td>
                  </tr>
           </table>
          </fieldset>
           </form>

	      	 




			</div><!--container-->
		</div><!--wrapper-->
	</div>
	
	 <script>
$(document).ready(function(){
            $('#submit2').click(function(){
                var srt = $("#createTicket").serialize();
                
                $.ajax({
                    type: 'POST',
                    url: '?url=supportticket/doCreate',
                    data: srt,
                    success: function(d) {
                        $("#transalert").html(d);
                    }
            });
			return false;
         });
       });

</script>