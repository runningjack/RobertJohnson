<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Create Page</h3>
        <a href="<?php echo URL; ?>page" class="button small right">Go Back</a>
    </div>
 	<div class="row">
    <form action="<?php echo URL ?>page/doCreate" method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" >
     <fieldset>
       	    <legend>Add new page</legend>
  <div class="row">
        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    			<label for="right-label" class="left inline">Title *</label>
    		</div>
            <div class="nine columns">
    			<input type="text" placeholder="Title" class="six" required='required' maxlength="500" name="title" id="caption" />
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Page Name *</label>
            </div>
            <div class="nine columns">
    <input type="text" placeholder="Page Name" class="six" required='required' maxlength="500" name="name" id="caption"/>
            </div>
          </div>
        </div>
 
        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Page Link *</label>
    		</div>
            <div class="nine columns">
    <input type="text" placeholder="Page Link" class="six" required='required' maxlength="500" name="link" id="caption" />
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Choose Template *</label>
    		</div>
            <div class="nine columns">
    	<select name="template">
        	<?php
				$files = getDirectoryList("template");
				foreach($files as $file){
					echo "<option value='".$file."'>".$file."</option>";	
				}
			?>
        </select>
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Page Description</label>
    		</div>
            <div class="nine columns">
      <textarea cols="10" name="description" id="description" ></textarea>
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Page Content *</label>
    		</div>
            <div class="nine columns">
    <textarea cols="80" id="editor2" name="editor2" rows="20" required="required" class="ckeditor" >
		</textarea>
       
            </div>
          </div>
        </div>
<br  />
<br />
        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Show Page</label>
    		</div>
            <div class="nine columns">
      <input name="hide" type="checkbox" value="show" />
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Page Order</label>
    		</div>
            <div class="nine columns">
      <input type="text" class="six" placeholder="Order" name="order" />
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
        	<label for="metadesc"> Page Parent *</label>
    		</div>
            <div class="nine columns">
            <select name="menuparent" id="menuparent" required="required"  >
                    <option value="0" >No Parent</option>
                   	 <?php
						$pages = Pages::find_all();
						foreach($pages as $page){
							echo "<option value='$page->page_id'>".$page->page_name."</option>";
						}
					?>
           	   </select>
            </div>
          </div>
        </div>
<br  />
<br />
        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
        	<label for="metadesc"> Meta Tag Description </label>
    		</div>
            <div class="nine columns">            
            <textarea name="metadesc" id='metadesc' cols="3" rows="3" placeholder="Meta Tag Description" class="ten" value="" ></textarea>
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
            <label for="metakeyword"> Meta Tag Keywords</label>
    		</div>
            <div class="nine columns">            
            <textarea name="metakeyword" id='metakeyword' cols="3" rows="3" placeholder="Meta Tag Keywords" class="ten" value="" ></textarea>	
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
        	 	<label>Upload Page Image</label>
    		</div>
            <div class="nine columns">            
      			<input type="file" name="image" class="ten">
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