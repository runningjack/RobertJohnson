<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>GMS Travels | New Contact</title>

  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" type="text/css" href="../../../css/foundation.min.css">
  <link rel="stylesheet" type="text/css" href="../../../css/app.css">
 

		
  </script>
</head>
<body>

  <!-- Header and Nav -->

  <!-- End Header and Nav -->

  <!-- Main Grid Section -->

  

	<!--this is beginning of the content   -->
    
	<div id='malert'></div>
	
    	<form action="<?php echo $uri->link("contact/doSave/") ?>" id='adminform' name='adminform' method="post" onSubmit="return false" onReset="">
        	<fieldset>
            <legend> Add New </legend>
             	<input type="text" placeholder="Name" class="ten" required = "required" name="name" id="name" value='<?php //echo $this->contacts->contact_name ?>'/>
                <input type="email" placeholder="Email" class="ten" required = "required" name="email" id="email" value='<?php //echo $this->contacts->contact_email ?>'/>
                <input type="tel" placeholder="Phone Number" class="ten" required = "required" name="phone" id="phone" value='<?php //echo $this->contacts->contact_phone ?>'/>
                <input type="text" placeholder="Subject" class="ten" required = "required" name="subject" id="subject" value='<?php //echo $this->contacts->contact_subject ?>'/>
                <input type="text" placeholder="Comment" class="ten" required = "required" name="comment" id="comment" value='<?php //echo $this->contacts->contact_comment ?>'/>
                 <input type="text" placeholder="Newsletter" class="ten" required = "required" name="newsletter" id="newsletter" value='<?php //echo $this->contacts->contact_newsletter ?>'/>
                 
                  
              <div class="buttons"><a onclick="location = '<?php echo $uri->link("contact/index/") ?>'" class="button">Add New</a><a onclick="location = '<?php echo $uri->link("contact/index/") ?>'" class="button">Cancel</a></div>
	<div class="eight columns center"> 
                
               
               
                
                
                
        	</fieldset>
        </form>
