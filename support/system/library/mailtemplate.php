<?php
class Mailtemplate{
	public $data = array();
	
	public function gettmp() {
		$file = "http://robertjohnsonholdings.com/emailtmp/email1.php";
    
		if (file_exists($file)) {
			extract($this->data);
			
      		ob_start();
      
	  		include($file);
      
	  		$content = ob_get_contents();

      		ob_end_clean();

      		return $content;
    	} else {
			trigger_error('Error: Could not load template ' . $file . '!');
			exit();				
    	}	
	}
}
?>