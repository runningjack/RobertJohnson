<?php
class Bootstrap {
	function __construct(){
		//parent::_construct();
		global $database;
		$vari = $_SERVER['REQUEST_URI'];
		$vari = explode("/",$vari);
		if(isset($_GET['url'])){
			$url	=	$_GET['url'];
			$url	=	rtrim($url);
			$url	=	explode('/',$_GET['url']);
		}else{
			$url =null;
		}
		        
        if(empty($url[0])){
			require "controllers/dashboard.php";
			$controller = new Dashboard();
			$controller->index();
			exit;
		}
		
        
       
		$file = "controllers/".$url[0].".php";
		if(file_exists($file)){
			require $file;
		}elseif(($vari[1]=='scratch' && count($vari)===3)){
			require "controllers/pages.php";
			$controller = new Pages();
			$controller->index();
			exit;
		}else{
			require "controllers/error.php";
			$controller = new Error();
			return false;
		}
		
		$controller = new $url[0];
		if(isset($url[2]) && !empty($url[2])){
			$controller->{$url[1]}($url[2]);
		}
		else{
			if(isset($url[1])){
			$controller->{$url[1]}();
		}
		}
	}
}
?>