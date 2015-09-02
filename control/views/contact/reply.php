<div class="row" style="width:96%; margin:10px auto">

	<!--this is beginning of the content   -->
	
	<!--this is beginning of the content   -->
    <div class="heading">
      <h1><img src="views/common_util/images/001_57.png" alt="" />Mail Reply</h1>
      
      <div class="buttons"><a onclick="location = '<?php echo $uri->link("Client/index/") ?>'" class="button">Add New</a> <a onclick="location = '<?php echo $uri->link("Client/index/") ?>'" class="button">Cancel</a></div>
	

    </div>
    <div class='panelContainer'>
	<div class="twelve columns" role="content">
   
    <div id='malert'></div>
    
    <div class="popBox" style="padding-top:20px;">
    <form action="<?php  echo $uri->link("Contact/doReply") ?>" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge"  onReset="">
   
   <table width="75%" border="0" cellspacing="10">
          <tr>
            <td width="15%" height="38" align="right" class="txt-body"><strong>To:</strong></td>
            <td colspan="2"><dv class="changePhoto">
              
               <input name="to" type="text" id="to"  value="<?php echo $this->mycontact->contact_email ?>"  readonly="readonly"  />
            </dv></td>
          </tr>
          
          <tr>
            <td align="right" valign="top" class="txt-body"><strong>Subject</strong></td>
            <td colspan="2" class="txt-body"><input type="text" name="sender" id="sender" value="<?php echo 'Re'.$this->mycontact->contact_topic ?>" /></td>
          </tr>
          
          <tr>
            <td align="right" valign="top" class="txt-body"><strong>Message:</strong></td>
            <td colspan="2" class="txt-body"><textarea name="message" id="message" cols="60" rows="5" class="inputBox required"></textarea></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td width="16%"><input type="submit" name="save" id="save" value="SEND" /></td>
            <td width="69%"><input type="button" name="cancel" id="cancel" value="CANCEL" /></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
    </table>

  </form>
	<!--form action="" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge"  onReset="">
    <fieldset> 
     <legend>Reply Mail</legend>

<div class="row">
            	<div class="four columns">
                	<label for="right-label" class=" left inline">To:</label>
                </div>                
                <div class="eight columns">
    			<input name="to" id="to" type="text" class="eight">
                </div>
 </div> 
 <div class="row">              
                <div class="four columns">
                	<label for="right-label" class="left inline">Subject</label>
                </div>
                <div class="eight columns">
    			<input name="sub" id="sub" type="text" class="eight">
                </div>
  </div>
  <div class="row">               
                <div class="four columns">
                	<label for="right-label" class="left inline">Message</label>
                </div>
                <div class="eight columns">
    			<input name="mess" type="text" value="mess" size="25" maxlength="25" class="eight">
                </div>
  </div>
  
 				<input type="submit" class="button offset-by-five" name="Submit" value="Reply" id="submit"/>
             	<input type="reset" class="button offset-by-one" name="cancel" value="Cancel" />
             
        </fieldset>
        </form>-->
