<?php
ob_start();
?>
<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->

<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->

<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>

  <meta charset="utf-8" />



  <!-- Set the viewport width to device width for mobile -->

  <meta name="viewport" content="width=device-width" />



  <title><?php echo $this->title; ?></title>



  <!-- Included CSS Files (Uncompressed) -->

  <!--

  <link rel="stylesheet" href="stylesheets/foundation.css">

  -->

  

  <!-- Included CSS Files (Compressed) -->

  <link rel="stylesheet" href="<?php echo URL; ?>public/css/foundation.min.css">

  <link rel="stylesheet" href="<?php echo URL; ?>public/css/app.css">

  <script src="<?php echo URL; ?>public/js/jquery.js"></script>

	<script type="text/javascript" src="<?php echo URL; ?>public/ckeditor/ckeditor.js"></script>

  <script src="<?php echo URL; ?>public/js/modernizr.foundation.js"></script>

  <?php

	SESSION::init();

	if(isset($_SESSION['adminmessage']) && $_SESSION['adminmessage'] != ""){

		echo '<script type="text/javascript">alert("' . $_SESSION['adminmessage'] . '"); </script>';

		$_SESSION['adminmessage'] = "";

	}

?>

</head>

<body>



  <!-- Header and Nav -->



  <nav class="top-bar">

    <ul>

      <!-- Title Area -->

      <li class="name">

        <h1>

          <a href="<?php echo URL; ?>index">

            <?php echo SITE_NAME; ?> CMS

          </a>

        </h1>

      </li>

      <li class="toggle-topbar"><a href="#"></a></li>

    </ul>



    <section>

      <!-- Left Nav Section -->

      <ul class="left">

        <li class="divider"></li>

        <li><a href="<?php echo URL ?>">Home</a></li>

        <li class="divider"></li>

        <li><a href="<?php echo URL ?>page">Pages</a></li>

        <li class="divider"></li>

        <li><a href="<?php echo URL ?>products">Products</a></li>

        <li class="divider"></li>

        <li><a href="<?php echo URL ?>news">News</a></li>

        <li class="divider"></li>

        <li><a href="<?php echo URL ?>admins">Admin Users</a></li>

        <li class="divider"></li>

      </ul>



      <!-- Right Nav Section -->

      <ul class="right">

        <li class="divider"></li>

        <li><a href="<?php echo SITE_URL; ?>">View Website</a></li>

        <li class="divider"></li>

        <li><a href="<?php echo URL ?>index/logout">Log Out</a></li>

        <li class="divider"></li>

        

      </ul>

    </section>

  </nav>





  <!-- End Header and Nav -->