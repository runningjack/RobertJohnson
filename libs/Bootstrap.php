<?php

/**

* 

*/

class Bootstrap 

{

	

	function __construct()

	{

		# code...

		$url = isset($_GET['q']) ? $_GET['q'] : null;

		$url = rtrim($url, '/');



		$url = explode('/', $url);



		if(empty($url[0])){

			require 'controllers/index.php';

			$controller = new Index();

			$controller->LoadModel('index');

			$controller->index();

			return false;

		}



		$file = 'controllers/'.$url[0].'.php';



		

		if(Pages::page_exist($url[0])==true && !isset($url[1])){

			require 'controllers/index.php';

			$controller = new Index();

			$controller->LoadModel('index');

			$controller->load_page($url[0]);

			return false;	

		}
		elseif($url[0]=="news" && !empty($url[1])){
			require 'controllers/index.php';
			$controller = new Index();
			$controller->LoadModel('index');
			$controller->loadNews($url[1]);
			return false;
		}

		elseif(Pages::page_exist($url[0])==true && $url[0] != "products" && isset($url[1])){

			require 'controllers/index.php';

			$controller = new Index();

			$controller->LoadModel('index');

			$controller->get_sub_page($url[0], $url[1]);

			return false;

		}

		elseif($url[0]=="products" && isset($url[1])){

			require 'controllers/index.php';

			$controller = new Index();

			$controller->LoadModel('index');

			$controller->product($url[1]);

			return false;

		}		

		elseif(file_exists($file)){

			require $file;

			$controller = new $url[0];



			$controller->LoadModel($url[0]);

	

			if(isset($url[2])){

				if(method_exists($controller, $url[1])){

					$controller->{$url[1]}($url[2]);

				}

				else{

					$this->error();

				}

			}

			else{

				if(isset($url[1])){

					if(method_exists($controller, $url[1])){

						$controller->{$url[1]}();

					}

					else{

						$this->error();

					}

				}

				else $controller->index();

			}

		}

		

		else $this->error();

	}



	function error(){

		require 'controllers/index.php';

		$controller = new Index();

		$controller->LoadModel('index');

		$controller->loadError();

		return false;

	}

}

?>