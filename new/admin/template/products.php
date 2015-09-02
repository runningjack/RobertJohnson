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
<div id="slider_background">
    <div class="container">
        <div id="carousel-example-generic" class="carousel slide">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
            <li data-target="#carousel-example-generic" data-slide-to="5"></li>
          </ol>
        
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img src="<?php echo IMAGES; ?>R1.png" class="img-responsive centered" alt="">
            </div>
            <div class="item">
              <img src="<?php echo IMAGES; ?>R2.png" class="img-responsive" alt="">
            </div>
            <div class="item">
              <img src="<?php echo IMAGES; ?>R3.png" class="img-responsive" alt="">
            </div>
            <div class="item">
              <img src="<?php echo IMAGES; ?>R4.png" class="img-responsive" alt="">
            </div>
            <div class="item">
              <img src="<?php echo IMAGES; ?>R5.png" class="img-responsive" alt="">
            </div>
            <div class="item">
              <img src="<?php echo IMAGES; ?>R6.png" class="img-responsive" alt="">
            </div>
          </div>
        
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="icon-prev"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="icon-next"></span>
          </a>
        </div>
    </div>
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
              <li <?php echo $this->page->page_link == "product" ? "class='present'" : ""?>><a href="<?php echo SITE_URL?>products">Product &amp; Services</a></li>
              <li <?php echo $this->page->page_link == "partners" ? "class='present'" : ""?>><a href="<?php echo SITE_URL?>partners">Our Partners</a></li>
              <li <?php echo $this->page->page_link == "robertjohnson" ? "class='present'" : ""?>><a href="<?php echo SITE_URL?>robertjohnson">Robert Johnson Holdings</a></li>
              <li <?php echo $this->page->page_link == "careers" ? "class='present'" : ""?>><a href="<?php echo SITE_URL?>careers">Careers</a></li>
              <li <?php echo $this->page->page_link == "contact_us" ? "class='present'" : ""?>><a href="<?php echo SITE_URL;?>contact_us">Contact Us</a></li>
            </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->
    <div class="row row-borders">
    	<div class="col-3">
            <div class="panel-group" id="accordion">
            <?php
				$id = 1;
				foreach($this->categories as $category){
					$href = "collapse".strval($id);
			?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $href; ?>">
                      <div id="<?php echo $category->cat_id; ?>" class="category"><?php echo $category->cat_name; ?></div>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                  <div class="panel-body">
                    <?php
						$products = Product::get_showing_products_by_category($category->cat_id);
						foreach($products as $product){
							echo "<a href='#' class='product' id='$product->prod_id'>".$product->prod_name."</a><br />";	
						}
				?>
                  </div>
                </div>
              </div>
              <?php
			  		$id++;
				}
			  ?>
            </div>
        </div>
        
        <div class="col-9" id="display">
        	<h3 class="text-left"><strong>Welcome to Robert Johnson Holdings</strong></h3>
        	<p>Robert-Johnson Technologies Limited; a subsidiary of Robert Johnson Nigeria Limited is an 
E-Banking Technology Company. We specialize in the Financial Self-Service sector and Banking Automation with special 
emphasis on Automated Teller Machine (ATM), Point-of-Sales (POS), Card Management System (CMS), EFT/POS Terminal Management System (TMS) and other Allied Technology Solutions.
</p>
<p>Our shared vision is to be the recognized leader in our business sector, where we will constantly outperform our customers’ expectations and set the performance standard to which our competitors aspire. We will also be an essential reference site for our PARTNERS worldwide and a happy and supportive team.
</p>
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
<div class="ajaxloading"><!-- Place at bottom of page --></div>
<!--the body ends here-->

<script type="text/javascript">
$('#carousel-example-generic').carousel()
$(".collapse").collapse()

$("#display").on({
    ajaxStart: function() { 
        $(this).addClass("loading"); 
    },
    ajaxStop: function() { 
        $(this).removeClass("loading"); 
    }    
});

$(document).ready(function() {
	$(".category").click(function(){
		var category = $(this).attr('id');
		$("#display").load("<?php echo SITE_URL; ?>forms/getCategoryWeb", {cat_id:$(this).attr('id'), ajax: 'true'})
		return false;
	})
	
	$(".product").click(function(){
		var product = $(this).attr('id');
		$("#display").load("<?php echo SITE_URL; ?>forms/getProductWeb", {prod_id:$(this).attr('id'), ajax: 'true'})
		return false;
	})
	
});

</script>
</body>
</html>