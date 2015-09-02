<?php
class Page_Model extends Model{
	function __construct(){
		parent::__construct();
	}
	public function getList($id){
		$allPages = Pages::find_order_limit($id);
		return $allPages;		 
	}
	public function getById($id){
		$mypage = Pages::find_by_id($id);
		return $mypage;
	}
	
	public function create(){
		global $database;
		if(isset($_POST['Submit']) && !empty($_POST['editor2']) && !empty($_POST['name']) && !empty($_POST['link']) && !empty($_POST['title'])){
			$article = new Pages();
			$article->page_link			=	$_POST['link'];
			$article->page_name			=	$_POST['name'];
			$article->page_title		=	$_POST['title'];
			$article->page_desc			=	$_POST['description'];
			$article->page_template		= 	$_POST['template'];
			$article->page_content		=	htmlspecialchars($_POST['editor2']);
			$article->page_hide			=	$_POST['hide'];
			$article->page_parent		=	$_POST['menuparent'];
			$article->page_order		=	$_POST['order'];
			$article->page_meta_desc	=	$_POST['metadesc'];
			$article->page_meta_keyword =	$_POST['metakeyword'];
			$article->page_created		=	date("Y-m-d H:i:s");
			$article->page_img			=	$this->upload_pix();
			if(!$database->if_exist("SELECT * FROM pages WHERE page_title='".$article->page_title."'")){
								
				if($article->create()){
					return 1;
				}
				else{
					return 2;
				}
			}
			else{
				return 3;
			}
		}else{
			return 4;
		}
	}
	public function update($id){ 
		if(isset($_POST['Submit']) && !empty($_POST['editor2']) && !empty($_POST['caption']) && !empty($_POST['link']) && !empty($_POST['title'])){
			$article = Pages::find_by_id($id);
			if($article){
			$article->page_link			=	$_POST['link'];
			$article->page_name			=	$_POST['caption'];
			$article->page_title		=	$_POST['title'];
			$article->page_desc			=	$_POST['description'];
			$article->page_template		= 	$_POST['template'];
			$article->page_content		=	htmlspecialchars($_POST['editor2']);
			$article->page_hide			=	$_POST['hide'];
			$article->page_parent		=	$_POST['menuparent'];
			$article->page_order		=	$_POST['order'];
			$article->page_meta_desc	=	$_POST['metadesc'];
			$article->page_meta_keyword =	$_POST['metakeyword'];
			$article->page_modified		=	date("Y-m-d H:i:s");
			if(!empty($_FILES['image']['name'])){
				$article->page_img			=	$this->upload_pix();
			}
			
					if($article->update()){
						return 1;
					}else{
						return 2;
					}
				
			}else{
				return 3;
			}
		}else{
			return 4;
		}
	}
	public function delete($id){
		if($id != 7){
			$page = Pages::find_by_id($id);
			if(file_exists("../public/img/".$page->page_img)){
				unlink("../public/slider/".$cv->page_img);
			}
			if($page->delete())	return 1;
			else return 2;
		}
		else return 3;
	}
	
	function upload_pix($filepath = ""){

		$ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);

		if($ext == 'jpg' || $ext == 'gif' || $ext == 'png' || $ext == 'jpeg'){

			$image = new Imageresize();

			$image->load($_FILES["image"]["tmp_name"]);

			$image->resize(1300,400);

			$custom_name = rand(3, 500)."_".time();

			$filepath = $custom_name.".".$ext;
			
			$path = "../public/images/".$filepath;

			$image->save($path);
			
			$image->create($filepath);

			return $filepath;

		}

		else return 3;

	}
					
	function pagination($id){
		return getPagingLink($id,'pages',5,'','page/index/');
	}
}
?>