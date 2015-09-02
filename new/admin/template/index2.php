<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $this->page->page_title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo CSS; ?>bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo CSS; ?>style.css" rel="stylesheet" media="screen">
<script src="<?php echo JS; ?>jquery.js"></script>
<script src="<?php echo JS; ?>bootstrap.min.js"></script>
<meta http-equiv="description" content="<?php echo $this->page->page_meta_desc; ?>" />
<meta http-equiv="keywords" content="<?php echo $this->page->page_meta_keyword; ?>" />
</head>

<body>
<!--the header starts here-->
<div class="container" style="background-color:#fff;">

	<div class="row">
    	<div class="col-4"><img src="<?php echo IMAGES; ?>logo.png" alt="logo" /></div>
    </div>
</div>
<!--the header ends here-->

<!--the slider starts here-->
    <div class="container" style="background-color:#fff;">
        <img src="<?php  echo IMAGES.$this->page->page_img; ?>" alt="<?php echo $this->page->page_name; ?>" class="img-responsive" />
    </div>
<!--the slider ends here-->


<!--the body starts here-->
<div class="container" style="background-color:#fff;">
    <div class="navbar" id="top_bar_color">
      <div class="container">
    
        <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
  
        <!-- Place everything within .navbar-collapse to hide it until above 768px -->
        <div class="nav-collapse collapse navbar-responsive-collapse">
          	<ul class="nav navbar-nav" id="navigation">
              <li <?php echo $this->page->page_link == "index" ? "class='present'" : ""?>><a href="<?php echo SITE_URL;?>">Home</a></li>
              <li <?php echo $this->page->page_link == "about_us" ? "class='present'" : ""?>><a href="<?php echo SITE_URL?>about_us">About Us</a></li>
              <li <?php echo $this->page->page_link == "products" ? "class='present'" : ""?>><a href="<?php echo SITE_URL?>products">Product &amp; Services</a></li>
              <li <?php echo $this->page->page_link == "partners" ? "class='present'" : ""?>><a href="<?php echo SITE_URL?>partners">Our Partners</a></li>
              <li <?php echo $this->page->page_link == "robertjohnson" ? "class='present'" : ""?>><a href="<?php echo SITE_URL?>robertjohnson">Robert Johnson Holdings</a></li>
              <li <?php echo $this->page->page_link == "careers" ? "class='present'" : ""?>><a href="<?php echo SITE_URL?>careers">Careers</a></li>
              <li <?php echo $this->page->page_link == "contact_us" ? "class='present'" : ""?>><a href="<?php echo SITE_URL;?>contact_us">Contact Us</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->
    <div class="row row-borders">
    
    	<div class="col-12">
        	<?php echo html_entity_decode($this->page->page_content); ?>
        </div>
    
    </div>
    
    <div class="row boxes">
    	<div class="col-4 ">
        	<h3 class="text-center"><strong>We provide</strong></h3>
            uhiuhihiuho
            lhoiohoihj
            pijjpijpijpi
            poujppjpup uhiuhihiuho uhiuhihiuho uhiuhihiuho uhiuhihiuho uhiuhihiuho uhiuhihiuho
        </div>
        <div class="col-4 ">
        	<h3 class="text-center"><strong>Mission and Vision</strong></h3>
            uhiuhihiuho  uhiuhihiuho uhiuhihiuho uhiuhihiuho uhiuhihiuho uhiuhihiuho uhiuhihiuho
            lhoiohoihj
            pijjpijpijpi
            poujppjpup
        </div>
        <div class="col-4 ">
        	<h3 class="text-center"><strong>Join Us</strong></h3>
            uhiuhihiuho  uhiuhihiuho uhiuhihiuho uhiuhihiuho uhiuhihiuho uhiuhihiuho uhiuhihiuho
            lhoiohoihj
            pijjpijpijpi
            poujppjpup
        </div>
    
    </div>
    
    <div class="row row-borders">
    <hr />
    	<div class="col-2">
        	<img src="<?php echo IMAGES; ?>cs3cc5.jpg" alt="Incognito" class="img-responsive" />
        </div>
        <div class="col-2">
        	<img src="<?php echo IMAGES; ?>glory_logo.png" alt="Glory" class="img-responsive" />
        </div>
        <div class="col-2">
        	<img src="<?php echo IMAGES; ?>l_arius.gif" alt="Arius" class="img-responsive" />
        </div>
        <div class="col-2">
        	<img src="<?php echo IMAGES; ?>lexmark-logo.png" alt="Lexmark" class="img-responsive" />
        </div>
        <div class="col-2">
        	<img src="<?php echo IMAGES; ?>logo-header.jpg" alt="Diebold" class="img-responsive" />
        </div>
        <div class="col-2">
        	<img src="<?php echo IMAGES; ?>nbs logo.png" alt="Nbs Tech" class="img-responsive" />
        </div>
    </div>
    

</div>
<!--the body ends here-->

<script type="text/javascript">
$('#carousel-example-generic').carousel()

</script>
</body>
</html>