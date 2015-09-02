<div class="row">

	<div class="row">

    	<h3 class="text-center" style="background-color:#3F9">Edit News</h3>

        <a href="<?php echo URL; ?>news" class="button small right">Go Back</a>

    </div>

 	<div class="row">

    <form action="<?php echo URL ?>news/doUpdate" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" >

     <fieldset>

       	    <legend>Update News</legend>

            <input type="hidden" name="id" value="<?php echo $this->news->news_id?>" />

  <div class="row">

        <div class="twelve columns">

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Topic *</label>

    		</div>

            <div class="nine columns">

    			<input type="text" placeholder="Topic" class="six" required='required' maxlength="200" name="topic" value="<?php echo $this->news->news_topic; ?>" />

            </div>

          </div>

        </div>



        <div class="twelve columns">

          <div class="row">

            <div class="three columns">

    			<label for="right-label" >Content *</label>

            </div>

            <div class="nine columns">

            	<textarea name="content" class="ckeditor" id="editor2"><?php echo $this->news->news_content; ?></textarea>

            </div>

          </div>

        </div>

 		

        <?php

		if(!empty($this->news->news_image) && file_exists(IMAGES.$this->news->news_image)){

		?>

        <div class="twelve columns">

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Image</label>

    		</div>

            <div class="nine columns">

            	<img src="<?php echo IMAGES.$this->news->news_image; ?>" alt="<?php echo $this->news->news_image; ?>" />

            </div>

          </div>

        </div>

        <?php

		}

		?>

        

        <div class="twelve columns">

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Image</label>

    		</div>

            <div class="nine columns">

            	<input type="file" name="image" class="ten">

            </div>

          </div>

        </div>



        <div class="twelve columns">

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Visibility *</label>

    		</div>

            <div class="nine columns">

    			<select name="visible" class="two columns">

                	<option value="Show" <?php echo ($this->news->news_visible == "Show") ? "selected": ""; ?>>Show</option>

                    <option value="Hide" <?php echo ($this->news->news_visible == "Hide") ? "selected": ""; ?>>Hide</option>

        		</select>

            </div>

          </div>

        </div>



<br />

<br />        

        <div class="twelve columns">

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

        </div>

        

      </div>

      	 </fieldset>

        </form>

        

  </div><!-- Self defined -->

</div> 