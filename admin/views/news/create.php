<div class="row">

	<div class="row">

    	<h3 class="text-center" style="background-color:#3F9">Create News</h3>

        <a href="<?php echo URL; ?>news" class="button small right">Go Back</a>

    </div>

 	<div class="row">

    <form action="<?php echo URL ?>news/doCreate" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" >

     <fieldset>

       	    <legend>Add News</legend>

  <div class="row">

        <div class="twelve columns">

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Topic *</label>

    		</div>

            <div class="nine columns">

    			<input type="text" placeholder="Topic" class="six" required='required' maxlength="200" name="topic" />

            </div>

          </div>

        </div>



        <div class="twelve columns">

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Content *</label>

            </div>

            <div class="nine columns">

            	<textarea name="content" class="ckeditor" id="editor2"></textarea>

            </div>

          </div>

        </div>

 

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

                	<option value="Show">Show</option>

                    <option value="Hide">Hide</option>

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