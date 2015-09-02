<?php
class Reports extends Controller{
    function __construct(){
		parent::__construct();
        global $session;
		if(!$session->emp_is_logged_in()){
		  redirect_to($this->uri->link("login/index"));
          exit;
		}
		
	}
    public function index($mid=1){
        @$this->loadModel("Reports");
        //       =   $this->model->issueStatByProd();
       // header('ContentType: application/json; charset=utf-8');
        $md = json_encode($this->model->issueStatByProd()) ;
        $dd =   str_replace('_"',']',$md);
        
        $ndd    =   str_replace('"',"[",$dd);
        $ndd    =   str_replace("\/","",$ndd);

        $this->view->dato = $ndd;
        $this->view->render("reports/index");
    }
}
?>