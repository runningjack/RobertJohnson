<div class="row">
   	<h3 class="text-center" style="background-color:#3F9">Create Product for <?php echo $this->category->cat_name; ?></h3>
     <a href="<?php echo URL; ?>products/category" class="button small right">Go Back</a>
</div>
<hr />
<form action="<?php echo URL?>products/createProduct" method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="three columns">
            Product Name:
        </div>
        <div class="nine columns">
            <input name="name" type="text" required="required" />
        </div>
    </div>
    <div class="row">   
        <div class="three columns">
            Product Series:
        </div>
        <div class="nine columns">
            <input name="series" type="text" max="30" />
        </div>
    </div>
    <div class="row">   
        <div class="three columns">
          	Company Name:  
        </div>
        <div class="nine columns">
            <input name="company" type="text" max="60" />
        </div>
    </div>
    <div class="row">   
        <div class="three columns">
            Product Description:
        </div>
        <div class="nine columns">
            <textarea name="desc" rows="4"></textarea>
        </div>
    </div>
    <div class="row">   
        <div class="three columns">
           Web Content:  
        </div>
        <div class="nine columns">
            <textarea id="editor2" name="editor2" class="ckeditor" ></textarea>
        </div>
    </div>
    <div class="row">   
        <div class="three columns">
            Display Online:
        </div>
        <div class="nine columns">
            <select name="display">
            	<option value="Hide">Hide</option>
                <option value="Show">Show</option>
            </select>
        </div>
    </div>
    <div class="row">   
        <div class="three columns">
            Upload Product Image:
        </div>
        <div class="nine columns">
            <input type="file" name="image" />
        </div>
    </div>
    <div class="row">   
        <div class="three columns">
            Upload Product Documentation:
        </div>
        <div class="nine columns">
            <input name="pdf" type="file" />
        </div>
    </div>
    <div class="row">   
        <div class="three columns">
            
        </div>
        <div class="two columns">
            <input type="submit" class="button" value="Submit" />
        </div>
        <div class="two columns">
            <input type="reset" class="button" value="Reset" />
        </div>
        <div class="five columns"></div>
    </div>

</form>