<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Add New Artist</h3>
        <a href="<?php echo URL; ?>artists" class="button small right">Go Back</a>
    </div>
 	<div class="row">
    	<form action="<?php echo URL ?>artists/doCreate" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" class="custom" >
     <fieldset>
       	    <legend>Add New Artist</legend>
            
          <div class="row">
          
          	<div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Choose Category *</label>
                </div>
                <div class="nine columns">
                  	<label for="checkbox1" class="three columns"><input type="checkbox" name="music" value="1" id="checkbox1" > Music</label>
      				<label for="checkbox1" class="three columns"><input type="checkbox" name="dance" value="1" id="checkbox1"> Dance</label>
      				<label for="checkbox1" class="three columns"><input type="checkbox" name="poerty" value="1" id="checkbox1" > Poetry</label>
                    <label for="checkbox1" class="three columns"><input type="checkbox" name="drama" value="1" id="checkbox1">Drama</label>
                </div>
              </div>
            </div>
           
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Full Name *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Full Name" name="name" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Stage Name *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Stage Name" name="sname" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Instrument Played</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Instrument Played" name="instr" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Brief Descriotion</label>
                </div>
                <div class="nine columns">
                  <textarea name="desc" rows="4"></textarea>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Email *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Email" name="email" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Phone Number *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Phone Number" name="phone" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Address *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Address" name="addy" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">City *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="City" name="city" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">State *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="State" name="state" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Country *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Country" name="country" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Twitter Link</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Twitter Link" name="twitter" >
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Facebook Page</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Facebook Page" name="fb" >
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Youtube Video Link</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Youtube Video Link" name="youtube" >
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Image *</label>
                </div>
                <div class="nine columns">
                  <input type="file" id="right-label" name="pix" required>
                </div>
              </div>
            </div>
                    
            <div class="eight columns">
              <div class="row">
                <div class="three columns">
                  <p>&nbsp;</p>
                </div>
                <div class="small-2 columns">
                  <input type="submit" class="button" name="Submit" value="Save" id="submit"/>
                </div>
                <div class="small-2 columns">
                  <input type="reset" class="button" name="Reset" value="Reset" id="submit"/>
                </div>
                <div class="small-5 columns">
                </div>
              </div>
            </div>
            
          </div>

  
      	 </fieldset>
        </form>

  </div><!-- Self defined -->
</div> 
