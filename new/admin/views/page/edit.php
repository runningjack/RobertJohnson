<div class="row">
	<div class="row">
    	<h3 class="text-center" style="background-color:#3F9">Edit Page</h3>
        <a href="<?php echo URL; ?>page" class="button small right">Go Back</a>
    </div>
 	<div class="row">
    <form action="<?php echo URL ?>page/doUpdate/<?php echo $this->mypage->page_id; ?>"  method="post" enctype="multipart/form-data" name="frmpriviledge"  id="frmpriviledge" >
     <fieldset>
       	    <legend>Modify page</legend>
  <div class="row">
        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Page Title</label>
    		</div>
            <div class="nine columns">
    <input type="text" placeholder="Caption" class="six" required='required' maxlength="500" name="title" id="caption" value="<?php echo $this->mypage->page_title ?>" />
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Page Name</label>
            </div>
            <div class="nine columns">
    <input type="text" placeholder="Caption" class="six" required='required' maxlength="500" name="caption" id="caption" value="<?php echo $this->mypage->page_name ?>" />
            </div>
          </div>
        </div>
 
        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Page Link*</label>
    		</div>
            <div class="nine columns">
    <input type="text" placeholder="Page Link" class="six" required='required' maxlength="500" name="link" id="caption" value="<?php echo $this->mypage->page_link ?>" />
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Choose Template *</label>
    		</div>
            <div class="nine columns">
    	<select name="template" class="six">
        	<?php
				$files = getDirectoryList("template");
				foreach($files as $file){
					if($this->mypage->page_template == $file){
						echo "<option value='".$file."' selected='selected'>".$file."</option>";
					}
					else echo "<option value='".$file."'>".$file."</option>";	
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
    <textarea cols="10" name="description" id="description" ><?php echo $this->mypage->page_desc ?></textarea>
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
    <label for="right-label" class="left inline">Page Content</label>
    		</div>
            <div class="nine columns">
  
    <textarea cols="80" id="editor2" name="editor2" rows="20" required="required" >
			<?php echo $this->mypage->page_content ?>
		</textarea>
		<script>

			/// This call can be placed at any point after the
			/// <textarea>, or inside a <head><script> in a
			/// window.onload event handler.

			CKEDITOR.replace( 'editor2', {
				extraPlugins: 'magicline',	// Ensure that magicline plugin, which is required for this sample, is loaded.
				magicline_color: 'blue',	// Blue line
				uiColor: '#14B8C4',	
				allowedContent: true		// Switch off the ACF, so very complex content created to
											// show magicline's power isn't filtered.
			});

		</script>
       
            </div>
          </div>
        </div>
<br  />
<br />
        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
        <label for="right-label" class="left inline">Hide Page</label>
    		</div>
            <div class="nine columns">
          <input name="hide" type="checkbox" value="show" <?php if($this->mypage->page_hide == "show") echo "checked='checked'"?>/>
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
        <label for="right-label" class="left inline">Page Order</label>
    		</div>
            <div class="nine columns">
          <input type="text" class="six" placeholder="Order" name="order" value="<?php echo $this->mypage->page_order; ?>"/>
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">
        	<label for="metadesc"> Page Parent* </label>
    		</div>
            <div class="nine columns">         
            <select name="menuparent" id="menuparent" class="five" required="required" >
                    <option value="0" <?php if($this->mypage->page_parent == 0) echo "selected='selected'";?> >No Parent</option>
                   	 <?php
						$pages = Pages::find_all();
						foreach($pages as $page){
							if($this->mypage->page_parent == $page->page_id){
								echo "<option value='$page->page_id' selected='selected'>".$page->page_name."</option>";
							}
							else echo "<option value='$page->page_id'>".$page->page_name."</option>";
							
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
            <textarea name="metadesc" id='metadesc' cols="3" rows="3" placeholder="Meta Tag Description" class="ten" ><?php echo $this->mypage->page_meta_desc ?></textarea>	
            
            </div>
          </div>
        </div>

        <div class="twelve columns">
          <div class="row">
            <div class="three columns">            
            <label for="metakeyword"> Meta Tag Keywords</label>
    		</div>
            <div class="nine columns">                        
            <textarea name="metakeyword" id='metakeyword' cols="3" rows="3" placeholder="Meta Tag Keywords" class="ten"><?php echo $this->mypage->page_meta_keyword ?></textarea>
            </div>
          </div>
        </div>
		
        <?php 
			if(!empty($this->mypage->page_img)){
		?>
		<div class="twelve columns">
          <div class="row">
            <div class="three columns">
        	 	<label>Present Image</label>
    		</div>
            <div class="nine columns">            
        	 <img src="<?php echo IMAGES.$this->mypage->page_img; ?>" alt="<?php echo $this->mypage->page_name; ?>"  />
            </div>
          </div>
        </div>
 <br  />
 <br /> 
 		<?php
			}
		?>  
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
        </div>
    </div>
     <br class="clear" />
    </div><!-- Self defined -->
	</div>
