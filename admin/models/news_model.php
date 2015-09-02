<?php

class News_Model extends Model{

	function __construct(){

		parent::__construct();

	}

	public function getList($id){

		$allNews = RJ_News::find_order_limit($id);

		return $allNews;		 

	}

	public function getById($id){

		$news = RJ_News::find_by_id($id);

		return $news;

	}

	

	public function create(){

		global $database;

		if(!empty($_POST['topic']) && !empty($_POST['content'])){

			$article = new RJ_News();

			$val = new Val();

			$error = "";

			if($val->maxlength($_POST['topic'], 500)){

				$article->news_topic = htmlspecialchars($_POST['topic']);

			}

			else{

				$error .= "Topic Incorrect, ";	

			}

			$article->news_content			=	htmlspecialchars($_POST['content']);
			$article->news_visible			=	$_POST['visible'];
			if(!empty($_FILES['image']['name'])){

				$result = $this->upload;

				if($result){

					$article->news_image	=	$result;

				}

				else $error .= "Image Incorrect";

			}

			if($error == ""){

				if($article->create()){

					$_SESSION['adminmessage']	= "News successfully created";

					return true;

				}

				else{

					$_SESSION['adminmessage']	= "An error occured while connecting with database, please try again";

					return false;

				}

			}

			else{

				$_SESSION['adminmessage']	= $error;

				return false;	

			}

		}

		else{

			return false;

		}

	}

	

	public function update(){		
	global $database;

		if(!empty($_POST['id']) && ctype_digit($_POST['id'])){

			$id = $_POST["id"];

			$article = RJ_News::find_by_id($id);

			$val = new Val();

			$error = "";

			if($val->maxlength($_POST['topic'], 500)){

				$article->news_topic = htmlspecialchars($_POST['topic']);

			}

			else{

				$error .= "Topic Incorrect, ";	

			}

			$article->news_content			=	htmlspecialchars($_POST['content']);

			$article->news_visible			=	$_POST['visible'];

			if(!empty($_FILES['image']['name'])){

				$result = $this->upload;

				if($result){

					$article->news_image	=	$result;

				}

				else $error .= "Image Incorrect";

			}

			if($error == ""){

				if($article->update()){

					$_SESSION['adminmessage']	= "News successfully updated";

					return true;

				}

				else{

					$_SESSION['adminmessage']	= "An error occured while connecting with database, please try again";

					return false;

				}

			}

			else{

				$_SESSION['adminmessage']	= $error;

				return false;	

			}

		}

		else{

			return false;

		}

	}

	

	public function delete($id){

		if(ctype_digit($id)){

			$news = RJ_News::find_by_id($id);

			if(file_exists("../public/images/".$news->news_img)){

				unlink("../public/images/".$news->news_img);

			}

			if($news->delete())	{

				$_SESSION['adminmessage']	= "Deleted successfully";

			}

			else $_SESSION['adminmessage']	= "An error occured, please try again";

		}

		else $_SESSION['adminmessage']	= "Select the right file";

		return true;

	}

	

	function upload_pix($filepath = ""){



		$ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);



		if($ext == 'jpg' || $ext == 'gif' || $ext == 'png' || $ext == 'jpeg'){



			$image = new Imageresize();



			$image->load($_FILES["image"]["tmp_name"]);



			$image->resize(1200,300);



			$custom_name = rand(3, 500)."_".time();



			$filepath = $custom_name.".".$ext;

			

			$path = "../public/images/".$filepath;



			$image->save($path);

			

			$image->create($filepath);



			return $filepath;



		}



		else return false;



	}

					

	function pagination($id){

		return getPagingLink($id,'news',5,'','news/index/');

	}

}

?>