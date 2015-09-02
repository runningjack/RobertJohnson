<?php

class Products extends Controller{

	

	function __construct(){

		parent::__construct();

		parent::CheckLogin();

		$role = parent::returnRole();

		if($role == "Staff"){

			$_SESSION['adminmessage'] ="You are not authorized to view Page page";

			parent::redirect_to("index");	

		}

		$this->view->title = "Products Management";

		

	}



	public function index($id=1){

		$this->view->pageMultiplier = $id;

		$this->view->allCategories = $this->model->getCategories($id);

		$this->view->pag = $this->model->pagination($id);

		$this->view->render("category/index");

	}



	public function edit($id){

		$this->view->category = $this->model->getCategory($id);

		$this->view->render("category/edit");

	}



	public function create(){

		$this->view->render("category/create");

	}



	public function updateCategory(){

		$result = $this->model->updateCategory();

		if($result){

			parent::redirect_to('products');

		}else{

			$id = $_POST['id'];

			parent::redirect_to('products/edit/'.$id);

		}

	}



	public function createCategory(){

		$result = $this->model->createCategory();

		if($result){

			parent::redirect_to('products');

		}else{

			parent::redirect_to('products/create');

		}

	}



	public function deleteCategory($id){

		$success = $this->model->delete($id);

		if($success){

			parent::redirect_to('products');

		}

		else{

			parent::redirect_to('products');

		}

	}

	

	public function category($cat_id = ""){

		if($cat_id !="" && ctype_digit($cat_id) == true){

			$this->model->setCatID($cat_id);	

		}

		$id = $this->model->getCatID();

		if($id){

			$this->view->allProducts = $this->model->getProducts($id);

			$this->view->category = $this->model->prodCategory($id);

			$this->view->render("products/index");

		}

		else parent::redirect_to("products");

	}

	

	public function viewproduct($id){

		$product = $this->model->getProduct($id);

		$this->view->render("products/view");

	}

	

	public function editproduct($id){

		$this->view->product =	$this->model->getProduct($id);

		$this->view->render("products/edit");

	}

	

	public function createprod(){

		$id = $this->model->getCatID();

		if($id){

			$this->view->category = $this->model->prodCategory($id);

			$this->view->render("products/create");	

		}

		else parent::redirect_to("products");

	}

	

	public function createProduct(){

		$result = $this->model->createProduct();

		if($result){

			parent::redirect_to("products/category");	

		}

		else{

			parent::redirect_to("products/createprod");

		}

	}

	

	public function updateProduct(){

		$result = $this->model->updateProduct();

		if($result){

			parent::redirect_to("products/category");	

		}

		else{

			$id = $_POST['prod_id'];

			parent::redirect_to("products/editproduct/".$id);

		}

	}

	

	public function deleteprod($id){

		$product = $this->model->deleteProduct($id);

		parent::redirect_to("products/category");	

	}

	

	

}

?>