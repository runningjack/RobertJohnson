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
<div class="wrapper">
    <div class="container">
        <div class="row no-print">
            <div class="col-xs-12">
                <!--<a href="javascript:void(0)" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
                <a href="<?php echo $uri->link("supportticket/index") ?>" class="btn btn-success pull-right"><i class="fa fa-backward"></i> Back To Listing</a>

            </div>
        </div>
              <form role="form" action="<?php echo $uri->link("supportticket/doCreate") ?>" method="post" enctype="multipart/form-data" name="frmEm" id="frmEm">
                  <fieldset>
                      <legend><h3>Open Ticket</h3></legend>

                  <div class="box-body">
                  <div class="row">
                      <div id="transalert"></div>

                      <div class="box-header with-border ">
                          <h3 class="box-title"><span class="label pull-right bg-orange">Terminal & Location Info</span></h3>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Terminal ID</label>
                              <input type="text" class="form-control"  name="terminal_id" required="required" value="<?php echo isset ($this->product->terminal_id) ? $this->product->terminal_id :"" ?>"/>
                          </div>
                      </div>

                      <div class="col-lg-3">
                          <div class="form-group">
                              <label>Product Name<span class="red">*</span></label>
                              <select id="product_name" name="product_name" class="form-control">
                                  <option value="">--SELECT Product Name --</option>
                                  <?php
                                  foreach($this->products as $product){
                                      echo "<option value='".$product->prod_name."'>$product->prod_name</option>";
                                  }
                                  ?>
                              </select>
                          </div>
                      </div>

                      <div class="col-lg-3">
                          <div class="form-group">
                              <label>ATM Type <span class="red">*</span></label>
                              <select id="atm_type" name="atm_type" class="form-control">
                                  <option value="">--SELECT Product Name --</option>
                                  <option value='Through Wall'>TTW; Through Wall</option>
                                  <option value='In-Lobby'>In-Lobby</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                              <label>Branch <span class="red">*</span></label>

                              <input type="text" class="form-control"   name="branch" required="required" value="<?= isset($this->product->branch) ? $this->product->branch : "" ?>" />
                          </div>
                      </div>
                  </div>

                      <div class="row">
                          <div class="form-group">
                          <div class="col-lg-4">
                              <label>Address/Location <span class="red">*</span></label>
                              <textarea name="location" class="form-control" rows="3" placeholder="Enter ..."><?= isset ($this->product->install_address)  ? $this->product->install_address : "" ?></textarea>
                          </div>
                          <div class="col-lg-4">
                              <label>City <span class="red">*</span></label>
                              <input type="text" class="form-control"  name="city" id="city" value="<?= isset($this->product->install_city) ? $this->product->install_city : "" ?>">
                          </div>
                          <div class="col-lg-4">
                              <label>State <span class="red">*</span></label>
                              <input type="text" class="form-control"  name="state" id="state" value="<?= isset($this->product->install_state) ? $this->product->install_state : "" ?>">
                          </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="box-header with-border ">
                              <h3 class="box-title"><span class="label pull-right bg-orange">Contact Person</span></h3>
                          </div>

                          <div class="form-group">
                          <div class="col-lg-4">
                              <label>Contact Person Name *</label>
                              <input type="text" class="form-control"  name="cname" required="required" />
                          </div>
                          <div class="col-lg-4">
                              <label>Contact Person Phone <span class="red">*</span></label>
                              <input type="text" class="form-control"   name="phone" required="required" />
                          </div>
                          <div class="col-lg-4">
                              <label>Contact Person Email </label>
                              <input type="text" class="form-control" type="email"   name="email" />
                          </div>

                          </div>
                      </div>

                      <div class="row">
                          <div class="box-header with-border ">
                              <h3 class="box-title"><span class="label pull-right bg-orange">Issue(s)</span></h3>
                          </div>

                          <div class="form-group">
                          <?php
                          if($this->issues){
                              foreach($this->issues as $issue){
                                  echo"<div class='col-lg-2'><label for='".$issue->issue_accronym."'><input type='checkbox' name='".$issue->issue_accronym."' id='".$issue->issue_accronym."' value='".$issue->issue_name."' />".$issue->issue_name."<label></div>";
                              }
                          }
                          ?>
                              </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-4">
                              <div class="form-group">
                              <label>Support Type <span class="red">*</span></label>

                              <select id="dept" name="dept" class="form-control">
                                  <option value="Support">Technical Support</option>
                                  <option value="Sales">Sales </option>
                                  <option value="Billing">Billing</option>
                                  <option value="Security">Security</option>
                              </select>
                              <div id="tm4"></div>
                             </div>
                          </div>


                          <div class="col-lg-4">
                              <div class="form-group">
                              <label> Priority Level</label>
                              <select id="plevel" name="plevel" class="form-control">
                                  <option value="Low">Low</option>
                                  <option value="Medium">Medium</option>
                                  <option value="High">High</option>
                              </select>
                              <div id="tm6"></div>
                              </div>
                          </div>

                          <div class="col-lg-4">
                              <div class="form-group">
                              <input type="hidden"   name="subject" class="form-control"  />
                                  </div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="box-header with-border ">
                              <h3 class="box-title"><span class="label pull-right bg-orange"><label>Description</label></span></h3>
                          </div>
                          <div class="form-group">

                              <textarea  name="issue" class="form-control" rows="5" ></textarea>
                          </div>
                      </div>

                      <div class="row">
                          <div class="form-group">
                              <label>Emails to Copy (Seperate with comma)</label>
                              <input type="text"  class="form-control"  name="ccemail" id='ccemail'  />
                              <div id="tm3"></div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="form-group">
                              <label for="fupload">Attach file</label>
                              <input type="file" class="form-control file" name="fupload" id="fupload">
                          </div>

                      </div>
                    </div>


                  <div class="box-footer">
                      <input type="hidden" name="service" id="service" value="<?php  ?>" />
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  </fieldset>
              </form>


    </div>
</div>
<!--container <input autocomplete="off" type="hidden"  class="six" value="<?php  ?>"  name="prodname" id="prodname" />
    <div id="mySearchContainer" style="position: absolute;">
                    <div id="lcpsearchinner2"></div>-->


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