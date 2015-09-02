

	<div class="row">

    	<h3 class="text-center" style="background-color:#3F9">Create Category</h3>

        <a href="<?php echo URL; ?>products" class="button small right">Go Back</a>

    </div>

    <hr />



    <form action="<?php echo URL ?>products/createCategory" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" >

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Category Name*</label>

    		</div>

            <div class="nine columns">

    			<input type="text" placeholder="Category Name" class="six" required='required' maxlength="100" name="name" />

            </div>

          </div>

          

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Category Link*(No Space)</label>

    		</div>

            <div class="nine columns">

    			<input type="text" placeholder="Category Link" class="six" required='required' maxlength="10" name="link" />

            </div>

          </div>



          <div class="row">

            <div class="three columns">

    <label for="right-label" class="left inline">Category Description</label>

    		</div>

            <div class="nine columns">

      <textarea cols="10" name="desc" id="description" ></textarea>

            </div>

          </div>



          <div class="row">

            <div class="three columns">

    <label for="right-label" class="left inline">Web Content*</label>

    		</div>

            <div class="nine columns">

    <textarea cols="80" id="editor2" name="editor2" rows="20" class="ckeditor" ></textarea>

       

            </div>

          </div>

<br />

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Display Page</label>

    		</div>

            <div class="nine columns">

     		 	<label for="show" class="three columns"><input type="radio" name="display" value="Show" />Show</label>

                <label for="hide" class="three columns"><input type="radio" name="display" value="Hide" checked="checked" />Hide</label><label class="six columns"></label>

            </div>

          </div>



          <div class="row">

            <div class="three columns">

        	 	<label>Upload Page Image</label>

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

        



