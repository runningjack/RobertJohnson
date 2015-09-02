<?php

				class index_Model extends Model{

					

					function __construct(){

						parent::__construct();

						

					}

					

					function get_content(){

						return $page = Pages::find_by_link("index");

					}

					

					function loadPage($link){

							$page = Pages::find_by_link($link);

							if(isset($page))

								return $page;

							else return false;

					}

					

					function page_exist($link){

						return Pages::page_exist($link) ? true : false;	

					}

					

					function loadError(){

						return $error = Pages::loadError();

					}

					

					function get_sub_page($parent_page, $page){

						$parent = Pages::find_by_link($parent_page);

						if($parent){

						$subpage = Pages::get_sub_page($parent->page_id, $page);

							return !empty($subpage) ? $subpage : false;

						}

						else return false;

					}

					

					function getLatestNews(){

						$latestNews = RJ_News::getLatestNews();

						return $latestNews;	

					}

					

					function products_page(){

						$products_page = Pages::getProductsPage();

						return $products_page;

					}

					

					function getCategory($link){

						$category = Category::get_by_cat_link($link);

						return $category;	

					}
					
					function loadnews($id){
						$news = RJ_News::get_news_show($id);	
						return $news;
					}
					
					function news_page(){
						$newPage = Pages::getNewsPage();
						return $newPage;
					}
					

					

				}

				?>