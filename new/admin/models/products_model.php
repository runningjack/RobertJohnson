<?php

class Products_Model extends Model{

	function __construct(){

		parent::__construct();

	}

	

	/* this categories section starts here */

	

	public function getCategories(){

		$allCategories = Category::find_all();

		return $allCategories;		 

	}

	public function getCategory($id){

		$category = Category::find_by_id($id);

		return $category;

	}

	

	public function createCategory(){

		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['editor2']) && !empty($_POST['editor2'])){

			$error = "";

			$category = new Category();

			$val = new Val();

			if($val->minlength($_POST['name'], 3) && $val->maxlength($_POST['name'], 200)){

				$category->cat_name = strip_tags($_POST['name']);	

			}else $error .= "Name, ";

			

			if($val->minlength($_POST['link'], 3) && $val->maxlength($_POST['link'], 10) && !preg_match('/\s/',$_POST['link'])){

				$category->cat_link = $_POST['link'];	

			}else $error .= "Link, ";

			

			$category->cat_web_content = htmlspecialchars($_POST['editor2']);

			

			$category->cat_visible = $_POST['display'];

			

			if(isset($_POST['desc']) && !empty($_POST['desc'])){

				$category->cat_desc  = $_POST['desc'];	

			}

			

			if(!empty($_FILES['image']['name'])){

				$filepath = $this->upload_pix();

				if($filepath){

					$category->cat_pic = $filepath;	

				}else $error .="Image, ";

			}

			

			if(!empty($_FILES['pdf']['name'])){

				$filepath = $this->upload_document();

				if($filepath){

					$category->cat_pdf = $filepath;	

				}else $error .="File, ";

			}

			

			if($error == ""){

				if($category->create()){

					$_SESSION['adminmessage']	= "Category created successfully";

				}else $error = "An error occured please try again";

			}

		}else $error = "Please fill all the required spaces";

		

		if($error==""){

			return true;	

		}

		else{

			$_SESSION['adminmessage']	= $error;

			return false;	

		}

	}

	public function updateCategory(){

		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['editor2']) && !empty($_POST['editor2']) && isset($_POST['id'])){

			$error = "";

			$category = Category::find_by_id($_POST['id']);

			$val = new Val();

			if($val->minlength($_POST['name'], 3) && $val->maxlength($_POST['name'], 200)){

				$category->cat_name = strip_tags($_POST['name']);	

			}else $error .= "Name, ";

			

			if($val->minlength($_POST['link'], 3) && $val->maxlength($_POST['link'], 10) && !preg_match('/\s/',$_POST['link'])){

				$category->cat_link = $_POST['link'];	

			}else $error .= "Link, ";

			

			$category->cat_web_content = htmlspecialchars($_POST['editor2']);

			

			$category->cat_visible = $_POST['display'];

			

			if(isset($_POST['desc']) && !empty($_POST['desc'])){

				$category->cat_desc  = $_POST['desc'];	

			}

			

			if(!empty($_FILES['image']['name'])){

				$filepath = $this->upload_pix();

				if($filepath){

					$category->cat_pic = $filepath;	

				}else $error .="Image, ";

			}

			

			if(!empty($_FILES['pdf']['name'])){

				$filepath = $this->upload_document();

				if($filepath){

					$category->cat_pdf = $filepath;	

				}else $error .="File";

			}

			

			if($error == ""){

				if($category->update()){

					$_SESSION['adminmessage']	= "Category updated successfully";

				}else $error = "An error occured please try again";

			}

		}else $error = "Please fill all the required spaces";

		

		if($error==""){

			return true;	

		}

		else{

			$_SESSION['adminmessage']	= $error;

			return false;	

		}

	}

	

	public function delete($id){

		$category = Category::find_by_id($id);

		if($category->delete()){	

			$_SESSION['adminmessage'] == "Deleted Successfully";

			return true;

		}

		else{

			$_SESSION['adminmessage'] == "Delete not successfully, try again";

			return true;

		}

	}

	

	/* the categories section ends here*/



	/* this products section starts here */

	

	public function getAllProducts(){

		$allProducts = Product::find_all();

		return $allProducts;		 

	}

	public function getProducts($id){

		$products = Product::get_products_by_category($id);

		return $products;

	}

	

	public function getProduct($id){

		$product = Product::find_by_id($id);

		return $product;

	}

	

	public function prodCategory($id){

		$cat = $this->getCategory($id);	

		return $cat;

	}

	

	public function setCatID($id){

		$_SESSION['cat_id'] = $id;	

	}

	

	public function getCatID(){

		$id = $_SESSION['cat_id'];

		if(ctype_digit($id) == true) return $id;

		else return false;

	}

	

	public function createProduct(){

		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['editor2']) && !empty($_POST['editor2'])){

			$error = "";

			$product = new Product();

			$val = new Val();

			if($val->minlength($_POST['name'], 3) && $val->maxlength($_POST['name'], 255)){

				$product->prod_name = $_POST['name'];	

			}else $error .= "Name, ";

			

			$product->prod_web_content = htmlspecialchars($_POST['editor2']);

			

			$product->prod_visible = $_POST['display'];

			

			if(isset($_POST['desc']) && !empty($_POST['desc'])){

				$product->prod_desc  = $_POST['desc'];	

			}

			

			if(isset($_POST['series']) && !empty($_POST['series'])){

				$product->prod_series  = $_POST['series'];	

			}

			

			if(isset($_POST['company']) && !empty($_POST['company'])){

				$product->prod_company  = $_POST['company'];	

			}

			

			if(!empty($_FILES['image']['name'])){

				$filepath = $this->upload_pix();

				if($filepath){

					$product->prod_image = $filepath;	

				}else $error .="Image, ";

			}

			

			if(!empty($_FILES['pdf']['name'])){

				$filepath = $this->upload_document();

				if($filepath){

					$product->prod_pdf = $filepath;	

				}else $error .="File, ";

			}

			

			$product->prod_cat_id = $this->getCatID();

			

			if($error == ""){

				if($product->create()){

					$_SESSION['adminmessage']	= "Product created successfully";

				}else $error = "An error occured please try again";

			}

		}else $error = "Please fill all the required spaces";

		

		if($error==""){

			return true;	

		}

		else{

			$_SESSION['adminmessage']	= $error;

			return false;	

		}

	}

	public function updateProduct(){

		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['editor2']) && !empty($_POST['editor2']) && isset($_POST['prod_id'])){

			$error = "";

			$product = Product::find_by_id($_POST['prod_id']);

			$val = new Val();

			if($val->minlength($_POST['name'], 3) && $val->maxlength($_POST['name'], 255)){

				$product->prod_name = strip_tags($_POST['name']);	

			}else $error .= "Name, ";

			

			$product->prod_web_content = htmlspecialchars($_POST['editor2']);

			

			$product->prod_visible = $_POST['display'];

			

			if(isset($_POST['desc']) && !empty($_POST['desc'])){

				$product->prod_desc  = $_POST['desc'];	

			}

			

			if(isset($_POST['series']) && !empty($_POST['series'])){

				$product->prod_series  = $_POST['series'];	

			}

			

			if(isset($_POST['company']) && !empty($_POST['company'])){

				$product->prod_company  = $_POST['company'];	

			}

			

			if(!empty($_FILES['image']['name'])){

				$filepath = $this->upload_pix();

				if($filepath){

					$product->prod_image = $filepath;	

				}else $error .="Image, ";

			}

			

			if(!empty($_FILES['pdf']['name'])){

				$filepath = $this->upload_document();

				if($filepath){

					$product->prod_pdf = $filepath;	

				}else $error .="File, ";

			}

			

			$product->prod_cat_id = $this->getCatID();

			

			if($error == ""){

				if($product->update()){

					$_SESSION['adminmessage']	= "Product updated successfully";

				}else $error = "An error occured please try again";

			}

		}else $error = "Please fill all the required spaces";

		

		if($error==""){

			return true;	

		}

		else{

			$_SESSION['adminmessage']	= $error;

			return false;	

		}

	}

	

	public function deleteProduct($id){

		$category = Category::find_by_id($id);

		if($category->delete()){	

			$_SESSION['adminmessage'] == "Deleted Successfully";

			return true;

		}

		else{

			$_SESSION['adminmessage'] == "Delete not successfully, try again";

			return true;

		}

	}

	

	/* the products section ends here*/



	

	/* this section is general to both categories and products */

	function upload_pix($filepath = ""){



		$ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);



		if($ext == 'jpg' || $ext == 'gif' || $ext == 'png' || $ext == 'jpeg'){



			$image = new Imageresize();



			$image->load($_FILES["image"]["tmp_name"]);



			//$image->resize(400,300);



			$custom_name = rand(3, 500)."_".time();



			$filepath = $custom_name.".".$ext;

			

			$path = "../public/images/".$filepath;



			$image->save($path);

			

			$image->create($filepath);



			return $filepath;



		}



		else return false;



	}

	

	function upload_document(){

		$ext = pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION);

		if($ext == 'doc' || $ext == 'docx'	|| $ext == "pdf"){

			$filepath = $_FILES['pdf']['name'];

			if(move_uploaded_file($_FILES["pdf"]["tmp_name"], "../public/documents/".$filepath)){

				return $filepath;

			}

			else return false;

		}

		else return false;

	}



					

	function pagination($id){

		return getPagingLink($id,'pages',5,'','page/index/');

	}

}

?>