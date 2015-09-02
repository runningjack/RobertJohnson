<?php

	class index extends Controller{

		function __construct(){

		parent::__construct();

		}

				

		function index(){

			$this->view->page = $this->model->get_content();

			$this->view->latestNews = $this->model->getLatestNews();

			$this->view->template($this->view->page->page_template);

		}

		

		function loadError(){

			$this->view->page = $this->model->loadError();

			$this->view->template($this->view->page->page_template);

		}

			

		function array_count($id){

			echo $id;	

		}

		

		function load_page($page){

			$this->view->page = $this->model->loadPage($page);

			if($this->view->page != false){

				$this->view->template($this->view->page->page_template);	

			}

			else $this->loadError();

		}

		

		function get_sub_page($parent_page, $page){

			$this->view->page = $this->model->get_sub_page($parent_page, $page);

			if($this->view->page){

				$this->view->template($this->view->page->page_template);

			}

			else $this->loadError();

		}

		

		function check_page($link){

			return $this->model->page_exist($link);

		}

		

		function product($cat_link){

			$this->view->category = $this->model->getCategory($cat_link);

			if($this->view->category){

				$this->view->page = $this->model->products_page();

				$this->view->template("new_products.php");

			}

			else $this->loadError();

		}
		
		function loadNews($news_id){
			$this->view->news = $this->model->loadnews($news_id);
			if($this->view->news){
				$this->view->page = $this->model->news_page();
				$this->view->template("new_news.php");	
			}
			else $this->loadError();
		}

	}

?>