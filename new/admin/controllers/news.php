<?php



class News extends Controller {



	function __construct() {

		parent::__construct();

		parent::CheckLogin();

		$this->view->title = "News Management";

	}

	

	function index($id = 1){

		$this->view->pageMultiplier = $id;

		$this->view->allNews = $this->model->getList($id);

		$this->view->pag = $this->model->pagination($id);

		$this->view->render('news/index');

	}

	

	function edit($id) {
		$this->view->news = $this->model->getById($id);
		$this->view->render('news/edit');
	}

	

	function create()

	{

		$this->view->render('news/create');

	}

	

	function doCreate(){

		$result = $this->model->create();

		if($result){

			parent::redirect_to("news/index");

		}else{

			parent::redirect_to("news/create");

		}

	}

	

	function doUpdate(){
		$result = $this->model->update();
		if($result){
			parent::redirect_to("news");
		}else{
			parent::redirect_to("news");
		}
	}

	

	function doDelete($id){

		$result = $this->model->delete($id);

		parent::redirect_to("news");

	}

	

}