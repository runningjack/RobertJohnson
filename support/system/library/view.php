<?php
class View {
	function __construct(){
	}
	 public function render($name, $noInclude = false)
    {
        if ($noInclude == true) {
            require 'views/'.$name.'.php';    
        }
        else {
            require 'views/header.php';
            require 'views/'.$name.'.php';
            require 'views/footer.php';    
        }
    }
	 public function filerender($name, $noInclude = true)
    {
        if ($noInclude == true) {
            require 'views/'.$name.'.php';    
        }
        else {
            require 'views/header.php';
            require 'views/'.$name.'.php';
            require 'views/footer.php';    
        }
    }
	
}
?>