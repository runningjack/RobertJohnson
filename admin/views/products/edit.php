<div class="row">
   	<h3 class="text-center" style="background-color:#3F9">Edit Product</h3>
     <a href="<?php echo URL; ?>products/category" class="button small right">Go Back</a>
</div>
<hr />

    <form action="<?php echo URL ?>products/updateProduct" method="post" enctype="multipart/form-data" >
    	<input type="hidden" name="prod_id" value="<?php echo $this->product->prod_id; ?>" />
          <div class="row">
            <div class="three columns">
    			<label for="right-label" class="left inline">Product Name*</label>
    		</div>
            <div class="nine columns">
    			<input type="text" placeholder="Product Name" class="six" required='required' maxlength="40" name="name" value="<?php echo $this->product->prod_name; ?>" />
            </div>
          </div>
          
          <div class="row">
            <div class="three columns">
    			<label for="right-label" class="left inline">Product Series</label>
    		</div>
            <div class="nine columns">
    			<input type="text" placeholder="Product Series" class="six" maxlength="40" name="series" value="<?php echo $this->product->prod_series; ?>" />
            </div>
          </div>
          
          <div class="row">
            <div class="three columns">
    			<label for="right-label" class="left inline">Company Name</label>
    		</div>
            <div class="nine columns">
    			<input type="text" placeholder="Company Name" class="six" maxlength="40" name="company" value="<?php echo $this->product->prod_company; ?>" />
            </div>
          </div>

          <div class="row">
            <div class="three columns">
    			<label for="right-label" class="left inline">Product Description</label>
    		</div>
            <div class="nine columns">
      			<textarea cols="10" name="desc" id="description" ><?php echo $this->product->prod_desc; ?></textarea>
            </div>
          </div>

          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Web Content*</label>
    		</div>
            <div class="nine columns">
    <textarea cols="80" id="editor2" name="editor2" rows="20" class="ckeditor" ><?php echo $this->product->prod_web_content; ?></textarea>
       
            </div>
          </div>
<br />
          <div class="row">
            <div class="three columns">
    			<label for="right-label" class="left inline">Display Page</label>
    		</div>
            <div class="nine columns">
     		 	<label for="show" class="three columns"><input type="radio" name="display" value="Show" <?php echo ($this->product->prod_visible == "Show") ? "checked='checked'" : ""; ?> />Show</label>
                <label for="hide" class="three columns"><input type="radio" name="display" value="Hide" <?php echo ($this->product->prod_visible == "Hide") ? "checked='checked'" : ""; ?> />Hide</label><label class="six columns"></label>
            </div>
          </div>
<?php
	$image_file = IMAGES.$this->product->prod_image;
	if(!file_exists($image_file)){
?>
		  <div class="row">
            <div class="three columns">
        	 	<label>Product Image</label>
    		</div>
            <div class="nine columns">            
      			<img src="<?php echo IMAGES.$this->product->prod_image; ?>" alt="<?php echo $this->product->prod_name; ?>" />
            </div>
          </div>
<?php
	}
?>          
          <div class="row">
            <div class="three columns">
        	 	<label>Upload Product Image</label>
    		</div>
            <div class="nine columns">            
      			<input type="file" name="image" class="ten" />
            </div>
          </div>
<br />
          <div class="row">
            <div class="three columns">
        	 	<label>Upload PDF/Doc File</label>
    		</div>
            <div class="nine columns">            
      			<input type="file" name="pdf" class="ten" />
            </div>
          </div>
<br />
          <div class="row">
            <div class="three columns">
              <p>&nbsp;</p>
            </div>
            <div class="two columns">
              <button type="submit" class="button">Submit</button>
            </div>
            <div class="two columns">
              <input type="reset" class="button" name="Reset" value="Reset" id="submit"/>
            </div>
            <div class="five columns">
            </div>
          </div>
    </form>