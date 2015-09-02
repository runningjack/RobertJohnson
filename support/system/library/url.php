<?php
class Url {
	private $rawurl;
	private $ssl;
	private $rewrite = array();
	
	public function __construct($rawurl, $ssl = '') {
		$this->rawurl = $rawurl;
		$this->ssl = $ssl;
	}
		
	public function addRewrite($rewrite) {
		$this->rewrite[] = $rewrite;
	}
		
	public function link($route, $args = '', $connection = 'NONSSL') {
		if ($connection ==  'NONSSL') {
			$rawurl = $this->rawurl;
		} else {
			$rawurl = $this->ssl;	
		}
		
		$rawurl .= '?url=' . $route;
			
		if ($args) {
			$rawurl .= str_replace('&', '&amp;', '&' . ltrim($args, '&')); 
		}
		
		foreach ($this->rewrite as $rewrite) {
			$rawurl = $rewrite->rewrite($rawurl);
		}
				
		return $rawurl;
	}
}
$uri = new Url("");
?>