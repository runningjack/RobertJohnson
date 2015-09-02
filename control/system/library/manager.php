<?php

error_reporting(E_ALL);

include('library/Connector/FileManager.php');

// Please add your own authentication here
/*function UploadIsAuthenticated($get){
  if(!empty($get['session'])) return true;
  
  return false;
}*/

$browser = new FileManager(array(
  'directory' => 'admin/',
  'thumbnailPath' => 'admin/',
  'assetBasePath' => '../views/common_util/Assets/',
  'chmod' => 0777
));

$browser->fireEvent(!empty($_GET['event']) ? $_GET['event'] : null);