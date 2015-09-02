

	<div class="row">

    	<h3 class="text-center" style="background-color:#3F9">Update Category</h3>

        <a href="<?php echo URL; ?>products" class="button small right">Go Back</a>

    </div>

    <hr />



    <form action="<?php echo URL ?>products/updateCategory" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" >

    	<input type="hidden" value="<?php echo $this->category->cat_id?>" name="id" />

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Category Name*</label>

    		</div>

            <div class="nine columns">

    			<input type="text" placeholder="Category Name" class="six" required='required' maxlength="200" name="name" value="<?php echo $this->category->cat_name; ?>" />

            </div>

          </div>



		  <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Category Link*(No Space)</label>

    		</div>

            <div class="nine columns">

    			<input type="text" placeholder="Category Link" class="six" required='required' maxlength="10" name="link" value="<?php echo $this->category->cat_link; ?>" />

            </div>

          </div>



          <div class="row">

            <div class="three columns">

    <label for="right-label" class="left inline">Category Description</label>

    		</div>

            <div class="nine columns">

      <textarea cols="10" name="desc" id="description" ><?php echo $this->category->cat_desc; ?></textarea>

            </div>

          </div>



          <div class="row">

            <div class="three columns">

    <label for="right-label" class="left inline">Web Content*</label>

    		</div>

            <div class="nine columns">

    <textarea cols="80" id="editor2" name="editor2" rows="20" class="ckeditor" ><?php echo $this->category->cat_web_content; ?></textarea>

       

            </div>

          </div>

<br />

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Display Page</label>

    		</div>

            <div class="nine columns">

     		 	<label for="show" class="three columns"><input type="radio" name="display" value="Show" <?php echo ($this->category->cat_visible == "Show") ? "checked" : ""; ?> />Show</label>

                <label for="hide" class="three columns"><input type="radio" name="display" value="Hide" <?php echo ($this->category->cat_visible == "Hide") ? "checked" : ""; ?> />Hide</label><label class="six columns"></label>

            </div>

          </div>

          <?php

		  	if(!empty($this->category->cat_pic) && file_exists(IMAGES.$this->category->cat_pic)){

		  ?>

          <div class="row">

            <div class="three columns">

        	 	<label>Page Image</label>

    		</div>

            <div class="nine columns">            

      			<img src="<?php echo IMAGES.$this->category->cat_pic; ?>" alt="<?php echo $this->category->cat_pic; ?>" />

            </div>

          </div>

		<?php

			}

		?>

          <div class="row">

            <div class="three columns">

        	 	<label>Upload Category Image</label>

    		</div>

            <div class="nine columns">            

      			<input type="file" name="image" class="ten">

            </div>

          </div>

<br />

          <div class="row">

            <div class="three columns">

        	 	<label>Upload PDF/Doc File</label>

    		</div>

            <div class="nine columns">            

      			<input type="file" name="pdf" class="ten">

            </div>

          </div>

<br />

          <div class="row">

            <div class="three columns">

              <p>&nbsp;</p>

            </div>

            <div class="two columns">

              <input type="submit" class="button" name="Submit" value="Save" id="submit"/>

            </div>

            <div class="two columns">

              <input type="reset" class="button" name="Reset" value="Reset" id="submit"/>

            </div>

            <div class="five columns">

            </div>

          </div>

    </form>

        



