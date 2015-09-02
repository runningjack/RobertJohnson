<?php
class Prod_Cats_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getList(){
		$all_prod_cat = Prod_Cat::find_all();
		return $all_prod_cat;
	}
	public function getById($id){
		$prod_cat = Prod_Cat::find_by_id($id);
		return $prod_cat;
	}
	public function create()
	{
		if(isset($_POST['name']) && !empty($_POST['name'])){
			$obj                 =   new Prod_Cat();
			$obj->prod_cat_name		=	strip_tags($_POST['name']);
			$obj->prod_cat_manu      =	strip_tags($_POST['manufacturer']);
			$obj->visible 	=	$_POST['visible'];
			if($obj->create()){
				return 1;
			}else{
				return 2;
			}
		}
	}
	public function update()
	{
		if(isset($_POST['name']) && !empty($_POST['name'])){
			$obj                 	= Prod_Cat::find_by_id((int)preg_replace('#[^0-9]#i','',$_POST['prod_cat_id']));
			$obj->prod_cat_name		= strip_tags($_POST['name']);
			$obj->prod_cat_manu     = strip_tags($_POST['manufacturer']);
			$obj->visible 			= $_POST['visible'];
			if($obj->create()){
				return 1;
			}else{
				return 2;
			}
		}
	}
	
	public function delete($id){
		$article = Prod_Cat::find_by_id($id);
		if($article->delete()){
			return true;
		}
	}
	
}

?>