<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="<?php echo $this->page->page_meta_desc; ?>">

    <meta name="author" content="Aderopo Ayokunle, Ahmed Seraphin, Lanre Fawehinmi">

    <meta http-equiv="keywords" content="<?php echo $this->page->page_meta_keyword; ?>" />

    <link rel="shortcut icon" href="public/ico/favicon.png">



    <title><?php echo $this->page->page_title; ?></title>



    <!-- Bootstrap core CSS -->

    <link href="<?php echo CSS; ?>bootstrap.css" rel="stylesheet">

    <link href="http://www.google.com/fonts#UsePlace:use/Collection:Open+Sans" rel="stylesheet">

    <script src="<?php echo JS; ?>jquery.js"></script>



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="public/js/html5shiv.js"></script>

      <script src="public/js/respond.min.js"></script>

    <![endif]-->



    <!-- Custom styles for this template -->

    <!--<link href="carousel.css" rel="stylesheet">-->

    

  </head>

<!-- NAVBAR

================================================== -->

  <body>

  <div class="row" style="max-width:1000px; margin:0 auto">

    <div class="navbar-wrapper hidden-lg hidden-md">

      <div class="container">



        <div class="navbar navbar-inverse navbar-static-top">

          <div class="container">

            <div class="navbar-header">

              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

              </button>

              <a class="navbar-brand" href="<?php echo SITE_URL;?>">Robert Johnson Holdings Limited</a>

            </div>

            <div class="navbar-collapse collapse">

              <ul class="nav navbar-nav">

                <li <?php echo $this->page->page_link == "index" ? "class='active'" : ""?>><a href="<?php echo SITE_URL;?>">Home</a></li>

                <li <?php echo $this->page->page_link == "about" ? "class='active'" : ""?>><a href="<?php echo SITE_URL;?>about">About</a></li>

                <li class="dropdown <?php echo $this->page->page_link == "products" ? "active" : ""?>">

                  <a href="<?php echo SITE_URL;?>products" class="dropdown-toggle" data-toggle="dropdown">Product &amp; Services <b class="caret"></b></a>

                  <ul class="dropdown-menu">

                  <?php

						$categories = Category::get_categories();

						foreach($categories as $category){

							echo '<li><a href="'.SITE_URL.'products/'.$category->cat_link.'">'.$category->cat_name.'</a></li>';

						}

				  ?>

                  </ul>

                </li>

                <li <?php echo $this->page->page_link == "partner" ? "class='active'" : ""?>><a href="<?php echo SITE_URL;?>partner">Partners</a></li>

                <li <?php echo $this->page->page_link == "career" ? "class='active'" : ""?>><a href="<?php echo SITE_URL;?>career">Career</a></li>

                <li <?php echo $this->page->page_link == "contact" ? "class='active'" : ""?>><a href="<?php echo SITE_URL;?>contact">Our Contact</a></li>

              </ul>

            </div>

          </div>

        </div>



      </div>

    </div>

	<div class="row hidden-sm">

    <div class="col-12">

	<div id="wrap">

	<header>

		<div class="inner relative">

			<a class="logo" href="index.html"><img src="<?php echo IMAGES; ?>logo.png" alt="Robert Johnson Logo"></a>

			<a id="menu-toggle" class="button dark" href="#"><i class="icon-reorder"></i></a>

			<nav id="navigation">

				<ul id="main-menu">

					<li <?php echo $this->page->page_link == "index" ? "class='current-menu-item'" : ""?>><a href="<?php echo SITE_URL;?>">Home</a></li>

					<li class="parent <?php echo $this->page->page_link == "about" ? "current-menu-item" : ""?>">

						<a href="<?php echo SITE_URL;?>about">About us</a></li>
				

					<li class="parent <?php echo $this->page->page_link == "products" ? "current-menu-item" : ""?>">

						<a href="#">Product &amp; Services</a>

						<ul class="sub-menu">

                        	<?php

								$categories = Category::get_categories();

								foreach($categories as $category){

									echo '<li><a href="'.SITE_URL.'products/'.$category->cat_link.'">'.$category->cat_name.'</a></li>';

								}

							?>

						</ul>

					</li>

					<li <?php echo $this->page->page_link == "partner" ? "class='current-menu-item'" : ""?>><a href="<?php echo SITE_URL;?>partner">Partners</a></li>

                    <li <?php echo $this->page->page_link == "career" ? "class='current-menu-item'" : ""?>><a href="<?php echo SITE_URL;?>career">Career</a></li>

                    <li <?php echo $this->page->page_link == "contact" ? "class='current-menu-item'" : ""?>><a href="<?php echo SITE_URL;?>contact">Our Contact</a></li>

				</ul>

			</nav>

			<div class="clear"></div>

		</div>

	</header>	

</div>

	</div>

	</div>



	<div class="slide">

    	<img src="<?php echo IMAGES.$this->page->page_img; ?>" alt="Image" class="img-responsive"/>

    </div>

    <!-- Carousel

    ================================================== -->

    







    <!-- Marketing messaging and featurettes

    ================================================== -->

    <!-- Wrap the rest of the page in another container to center all the content. -->

    

    <div class="row">

    <p class="hidden-sm">&nbsp;</p>

    	<div class="col-md-9 col-lg-9">

        <h2><?php echo html_entity_decode($this->page->page_name); ?></h2>

        

        <div class="col-12 hidden-sm">

        <div id="slider1">

		<a class="buttons prev" href="#">left</a>

		<div class="viewport">

			<ul class="overview">

				<li><img src="<?php echo IMAGES; ?>D1.png" /></li>

				<li><img src="<?php echo IMAGES; ?>D2.png" /></li>

				<li><img src="<?php echo IMAGES; ?>D3.png" /></li>									

				<li><img src="<?php echo IMAGES; ?>D4.png"/></li>

				<li><img src="<?php echo IMAGES; ?>D6.png" /></li>

			</ul>

		</div>

		<a class="buttons next" href="#">right</a>

        </div>

        </div>

       <p>&nbsp;</p>

       		<?php echo html_entity_decode($this->page->page_content); ?>

               

    </div>

    	<div class="col-md-3 col-lg-3 hidden-sm" id="sidebar">

        	

			<ul class="nav nav-pills" >



				<li>

					<h2>Quick Link</h2>

					<ul>

						<li><a href="<?php echo SITE_URL;?>">Home</a></li>

						<li><a href="<?php echo SITE_URL;?>about">About Us</a></li>

						<li><a href="<?php echo SITE_URL;?>products">Products &amp; Services</a></li>

						<li><a href="<?php echo SITE_URL;?>partner">Partners</a></li>

						<li><a href="<?php echo SITE_URL;?>contact">Our Contact</a></li>

						<li><a href="<?php echo SITE_URL;?>career">Careers</a></li>

					</ul>

				</li>

                

			</ul>

		

        </div>

    </div>

   

	<p>&nbsp;</p> 

      <!-- Three columns of text below the carousel -->

      

     <!-- <div class="row">-->

     <!--<div class="col-12 hidden-sm" style="background-color:#0b242f; color:#fff; padding:10px 0">

      <div class="row">

				<div class="col-md-12 col-lg-12">

					<div class="col-md-2 col-lg-2" style="width: 20%;">

						<ul class="unstyled">

							<li><img src="<?php // echo IMAGES; ?>T1.png" class="img-responsive" /></li>

							<li><a href="#">About us</a></li>

						</ul>

					</div>

					<div class="col-md-2 col-lg-2" style="width: 20%;">

						<ul class="unstyled">

							<li><img src="<?php // echo IMAGES; ?>T2.png" class="img-responsive" /></li>

							<li><a href="#">Products &amp; Services</a></li>

						</ul>

					</div>

					<div class="col-md-2 col-lg-2" style="width: 20%;">

						<ul class="unstyled">

							<li><img src="<?php // echo IMAGES; ?>T3.png" class="img-responsive" /></li>

							<li><a href="#">Web analytics</a></li>

						</ul>

					</div>

					<div class="col-md-2 col-lg-2" style="width: 20%;">

						<ul class="unstyled">

							<li><img src="<?php // echo IMAGES; ?>T4.png" class="img-responsive" /></li>

							<li><a href="#">Partners</a></li>

						</ul>

					</div>	

					<div class="col-md-2 col-lg-2" style="width: 20%;">

						<ul class="unstyled">

							<li><img src="<?php // echo IMAGES; ?>T5.png" class="img-responsive" /></li>

							<li><a href="#">Our Contacts</a></li>

						</ul>

					</div>					

				</div>

			</div>

          </div>-->

     <!-- </div> /.row -->



      <!-- FOOTER -->

      <br clear="all">

      

     <footer>

        <div class="row">

        	<div class="col-2"><img src="<?php echo IMAGES; ?>cs3cc5.jpg" class="img-responsive"></div>

            <div class="col-2"><img src="<?php echo IMAGES; ?>nbs logo.png" class="img-responsive"></div>

            <div class="col-2"><img src="<?php echo IMAGES; ?>glory_logo.png" class="img-responsive" ></div>

            <div class="col-2"><img src="<?php echo IMAGES; ?>l_arius.gif" class="img-responsive"></div>

            <div class="col-2"><img src="<?php echo IMAGES; ?>lexmark-logo.png" class="img-responsive"></div>

            <div class="col-2"><img src="<?php echo IMAGES; ?>logo-header.jpg" class="img-responsive"></div>

        </div>

        <br clear="all">

        <p class="pull-right"><a href="#">Back to top</a></p>

        <p>&copy; <?php echo date("Y") ?> Robert Johnson Holdings Limited. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>

      </footer>



    <!-- /.container -->

</div>



    <!-- Bootstrap core JavaScript

    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->

    <script type="text/javascript" src="<?php echo JS; ?>jquery.tinycarousel.min.js"></script>

    <script src="<?php echo JS; ?>bootstrap.min.js"></script>

    <script src="<?php echo JS; ?>holder.js"></script>

    <script src="<?php echo JS; ?>jquery.tinycarousel.min.js" ></script>

    

    <script type="text/javascript">

		$(document).ready(function(){

			$('#slider1').tinycarousel();	

		});

	</script>

  </body>

</html>



