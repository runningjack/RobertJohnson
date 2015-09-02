<?php

class View {

	function __construct() {
		//echo 'this is the view';
	}

	public function render($name, $noInclude = false)
	{
		if ($noInclude == true) {
			require 'views/' . $name . '.php';	
		}
		else {
			require 'views/header.php';
			require 'views/' . $name . '.php';
			require 'views/footer.php';	
		}
	}

	public function template($name){
		$file = 'admin/template/'.$name;
		if(file_exists($file)){
			require $file;	
		}
		else require 'admin/template/default.php';
	}

}