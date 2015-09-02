<?php
ob_start('ob_gzhandler');
session_start();
session_cache_limiter('nocache');
header('Cache-Control: no-cache, must-revalidate, post-check=3600, pre-check=3600');
?>
<?php
$_SESSION['message']="";
echo "data collected";
?>