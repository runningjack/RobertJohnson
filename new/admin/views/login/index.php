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

  <title><?php echo $this->title; ?></title>

  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/css/foundation.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>public/css/app.css">
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
      <!-- Right Nav Section -->
      <ul class="right">
        <li class="divider"></li>
        <li><a href="<?php echo SITE_URL; ?>">Go Back to Website</a></li>
        <li class="divider"></li>
      </ul>
    </section>
  </nav>


  <!-- End Header and Nav -->
<div class="row">
<h1>Login</h1>

<form action="login/run" method="post">
	
	<label>Login</label><input type="text" name="login" /><br />
	<label>Password</label><input type="password" name="password" /><br />
	<label></label><input type="submit" />
</form>
</div>

<footer class="row">
    <div class="twelve columns">
      <hr />
      <div class="row">
        <div class="six columns">
          <p>&copy; Copyright Robert Johnson Holdings Limited <?php echo date('Y'); ?></p>
        </div>
        <div class="six columns">
        </div>
      </div>
    </div>
  </footer>
  
  <!-- Included JS Files (Uncompressed) -->
  <!--
  
  <script src="javascripts/jquery.js"></script>
  
  <script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  
  <script src="javascripts/jquery.foundation.forms.js"></script>
  
  <script src="javascripts/jquery.event.move.js"></script>
  
  <script src="javascripts/jquery.event.swipe.js"></script>
  
  <script src="javascripts/jquery.foundation.reveal.js"></script>
  
  <script src="javascripts/jquery.foundation.orbit.js"></script>
  
  <script src="javascripts/jquery.foundation.navigation.js"></script>
  
  <script src="javascripts/jquery.foundation.buttons.js"></script>
  
  <script src="javascripts/jquery.foundation.tabs.js"></script>
  
  <script src="javascripts/jquery.foundation.tooltips.js"></script>
  
  <script src="javascripts/jquery.foundation.accordion.js"></script>
  
  <script src="javascripts/jquery.placeholder.js"></script>
  
  <script src="javascripts/jquery.foundation.alerts.js"></script>
  
  <script src="javascripts/jquery.foundation.topbar.js"></script>
  
  <script src="javascripts/jquery.foundation.joyride.js"></script>
  
  <script src="javascripts/jquery.foundation.clearing.js"></script>
  
  <script src="javascripts/jquery.foundation.magellan.js"></script>
  
  -->
  
  <!-- Included JS Files (Compressed) -->
  
  <script src="<?php echo URL; ?>public/js/foundation.min.js"></script>
  
  <!-- Initialize JS Plugins -->
  <script src="<?php echo URL; ?>public/js/app.js"></script>
</body>
</html>