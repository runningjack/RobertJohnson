<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Edit Artist</h3>
        <a href="<?php echo URL; ?>artists" class="button small right">Go Back</a>
    </div>
 	<div class="row">
    	<form action="<?php echo URL ?>artists/doUpdate/<?php echo $this->artist->artist_id; ?>" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" class="custom" >
     <fieldset>
       	    <legend>Edit Artist</legend>
            
          <div class="row">
          
          	<div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Choose Category *</label>
                </div>
                <div class="nine columns">
                  	<label for="checkbox1" class="three columns"><input type="checkbox" name="music" value="1" id="checkbox1" <?php echo ($this->artist->artist_music == "1") ? "checked" : ""; ?> > Music</label>
      				<label for="checkbox1" class="three columns"><input type="checkbox" name="dance" value="1" id="checkbox1" <?php echo ($this->artist->artist_dance == "1") ? "checked" : ""; ?>> Dance</label>
      				<label for="checkbox1" class="three columns"><input type="checkbox" name="poetry" value="1" id="checkbox1"
                    <?php echo ($this->artist->artist_poetry == "1") ? "checked" : ""; ?> > Poetry</label>
                    <label for="checkbox1" class="three columns"><input type="checkbox" name="drama" value="1" id="checkbox1"
                    <?php echo ($this->artist->artist_drama == "1") ? "checked" : ""; ?>>Drama</label>
                </div>
              </div>
            </div>
           
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Full Name *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Full Name" name="name" value="<?php echo $this->artist->artist_name; ?>" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Stage Name *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Stage Name" name="sname" value="<?php echo $this->artist->artist_s_name ?>" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Instrument Played</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Instrument Played" name="instr" value="<?php echo $this->artist->artist_instr; ?>">
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Brief Descriotion</label>
                </div>
                <div class="nine columns">
                  <textarea name="desc" rows="4"><?php echo $this->artist->artist_desc ?></textarea>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Email *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Email" name="email" value="<?php echo $this->artist->artist_email ?>" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Phone Number *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Phone Number" name="phone" value="<?php echo $this->artist->artist_phone ?>" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Address *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Address" name="addy" value="<?php echo $this->artist->artist_addy ?>" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">City *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="City" name="city" value="<?php echo $this->artist->artist_city ?>" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">State *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="State" name="state" value="<?php echo $this->artist->artist_state ?>" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Country *</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Country" name="country" value="<?php echo $this->artist->artist_country ?>" required>
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Twitter Link</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Twitter Link" name="twitter" value="<?php echo $this->artist->artist_twitter ?>" >
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Facebook Page</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Facebook Page" name="fb" value="<?php echo $this->artist->artist_fb ?>">
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Youtube Video Link</label>
                </div>
                <div class="nine columns">
                  <input type="text" id="right-label" placeholder="Youtube Video Link" name="youtube" value="<?php echo $this->artist->artist_youtube ?>" >
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Artist Image</label>
                </div>
                <div class="nine columns">
                  <img src="<?php echo SITE_URL."images/".$this->artist->artist_pix_link; ?>" alt="<?php echo $this->artist->artist_name; ?>"  />
                </div>
              </div>
            </div>
            
            <div class="ten columns">
              <div class="row">
                <div class="three columns">
                  <label for="right-label" class="right inline">Upload Image</label>
                </div>
                <div class="nine columns">
                  <input type="file" id="right-label" name="image">
                </div>
              </div>
            </div>
                    
            <div class="eight columns">
              <div class="row">
                <div class="three columns">
                	<input type="hidden" name="id" value="<?php echo $this->artist->artist_id?>" />
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
