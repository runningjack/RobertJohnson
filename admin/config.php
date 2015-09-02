<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', '/admin/');
define('LIBS', 'libs/');
define("SITE_URL","/");
// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');
define("SEARCH_NO", 30);
define("SITE_NAME", "Robert Johnson Holdings");
define("PUBLICPATH", SITE_URL."public/");
define("IMAGES", PUBLICPATH.'images/');
define("SLIDE", PUBLICPATH.'slider/');
define("CSS", PUBLICPATH.'css/');
define("JS", PUBLICPATH.'js/');
define("PDF", PUBLICPATH."documents/");
define("WEB_URL", 'http://www.robertjohnsonholding.com');
define("SITE_EMAIL", 'info@robertjohnsonholding.com');
date_default_timezone_set('Africa/Lagos');