<div class="row">

   	<h3 class="text-center" style="background-color:#3F9">Create Product for <?php echo $this->category->cat_name; ?></h3>

     <a href="<?php echo URL; ?>products/category" class="button small right">Go Back</a>

</div>

<hr />



    <form action="<?php echo URL ?>products/createProduct" method="post" enctype="multipart/form-data" >

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Product Name*</label>

    		</div>

            <div class="nine columns">

    			<input type="text" placeholder="Product Name" class="six" required='required' maxlength="200" name="name" />

            </div>

          </div>

          

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Product Series</label>

    		</div>

            <div class="nine columns">

    			<input type="text" placeholder="Product Series" class="six" maxlength="40" name="series" />

            </div>

          </div>

          

          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Company Name</label>

    		</div>

            <div class="nine columns">

    			<input type="text" placeholder="Company Name" class="six" maxlength="40" name="company" />

            </div>

          </div>



          <div class="row">

            <div class="three columns">

    			<label for="right-label" class="left inline">Product Description</label>

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