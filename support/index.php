<?php
ob_start('ob_gzhandler');
session_cache_limiter('nocache');
header('Cache-Control: no-cache, must-revalidate, post-check=3600, pre-check=3600');
date_default_timezone_set('Africa/Lagos');
?>
<?php
require "config.php";
// Startup
require_once(DIR_SYSTEM . 'starter.php');

$session = new Session();
//$_SESSION['message']="";
function __autoload($class) {
    require_once DIR_SYSTEM. "library/".strtolower($class).".php";
}
//$registry 	= Registry::singleton();
//require_once "bootstrap.php";
$app 		= new Bootstrap();
?>