<?php
class Controller{
	protected $registry;
	public function __construct(){
		$this->view 	= new View();
		$this->uri 		= new Url("");
		
	}
	
	public function loadModel($name, $modelPath = 'models/') {
        $path = $modelPath . strtolower($name).'_model.php';
        if (file_exists($path)) {
            require $modelPath .strtolower($name).'_model.php';
            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }        
    }
}
?>