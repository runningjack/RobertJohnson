<?php
class Menu{
	protected static $table_name="menu";
	protected static $db_fields=array('menu_id','menu_caption','menu_has_dropdown','menu_descript','menu_parent_id','menu_link','menu_level','menu_icon','menu_status','menu_sort_order','menu_created','menu_modified');
	public $menu_id;
	public $menu_caption;
	public $menu_has_dropdown;
	public $menu_descript;
	public $menu_parent_id;
	public $menu_link;
	public $menu_level;
	public $menu_icon;
	public $menu_status;
	public $menu_sort_order;
	public $menu_created;
	public $menu_modified;
	
	
	public static function find_all(){
		global $database;
		$result_set =self::find_by_sql("SELECT * FROM ".self::$table_name." ");
		return $result_set;
	}
	
	public static function find_by_id($id){
		global $database;
		$result_array =self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE menu_id=".$id);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	
	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->db_query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
		  $object_array[] = self::instantiate($row);
		}
		return $object_array;
  	}
	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  $object_vars = $this->attributes();
	  return array_key_exists($attribute, $object_vars);
	}

	protected function attributes(){
		//return get_object_vars($this);
		$attributes = array();
		foreach(self::$db_fields as $field){
			if(property_exists($this,$field)){
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
 
  	public function create_folder(){
		
		$controllerFile ="../controllers/".strtolower($this->menu_link).".php";
		$modelFile ="../models/".$this->menu_link."_model.php";
		if(!file_exists("../views/".$this->menu_link)){
			//mkdir("../controllers/".$this->menu_link.".php", 0777, true);
			mkdir("../views/".$this->menu_link, 0777, true);
			copy("../views/tmp/index.php","../views/".strtolower($this->menu_link)."/index.php");
			file_put_contents($modelFile,'<?php
				class '.$this->menu_link.'_Model extends Model{
					
					function __construct(){
						parent::__construct($this->registry);
						
					}
					function get_content($mid){
						$mMenu = Menu::find_by_id($mid);
						if($mMenu){
							return $this->page = Page::find_by_column($mMenu->menu_id);
						}
					}
					
				}
				?>');
				file_put_contents($controllerFile,'<?php
					class '.$this->menu_link.' extends Controller{
						function __construct(){
							parent::__construct();
							//$this->index($pgcaption);
						}
						
						function index($mid){
							if(empty($mid)){
								redirect_to($this->uri->link("error/index"));
								exit;
							}
							$this->loadModel("'.$this->menu_link.'");
							$pageData = $this->model->get_content($mid);
							//print_r($pageData);
							$this->view->content =isset($pageData->page_content) && !empty($pageData->page_content)? $pageData->page_content :"";
							$this->view->title = isset($pageData->page_caption) && !empty($pageData->page_caption)? $pageData->page_caption :"Page is not available";
							$this->view->render("'.strtolower($this->menu_link).'/index");
						}
					} ?>');
			return true;
	 	}
 	}
	
	public function create(){
		global $database;
		$attributes = $this->attributes();
		$sql = "INSERT INTO ".self::$table_name."  (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=")VALUES('";
		$sql .= join("', '", array_values($attributes));
		$sql .="')"; 
		$this->create_folder();
			if ($database->db_query($sql)){
				$this->menu_id = $database->insert_id();
				if(!empty($this->menu_parent_id)){
					$this->update_parent();
				}
				return true;
			}
			else{
				return false;
			}
	}
	/*this method is needed to 
	update a menu to indicate that it has 
	children and that a menu is a child*/
	function update_parent(){
		global $database;
		if($this->menu_parent_id !=""){
			$parentmenu = $database->fetch_assoc($database->db_query("SELECT * FROM ".self::$table_name." WHERE menu_id=".$this->menu_parent_id));
			if($parentmenu['menu_has_dropdown'] != 1)/*checks if menu previouly has children or child*/{
				$sql2 = "UPDATE ".self::$table_name." SET menu_has_dropdown=1 WHERE menu_id=".$this->menu_parent_id;
				$database->db_query($sql2);
			}
		}
	}
	/*this method is needed to 
	output the children of a parent menu 
	within a list*/
	function get_children($parent_id){
		global $database;
		$resultsubmenu=$database->db_query("SELECT * FROM ".self::$table_name." WHERE menu_parent_id=".$parent_id);
		while ($submenu=$database->fetch_assoc($resultsubmenu)){
			extract($submenu);
			echo"<li><a href='".URL.$menu_link."'>$menu_caption</a></li> <li class='divider'></li>";
			
		}
	}
	public function update() {
	  global $database;
		$attributes = $this->attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE menu_id=".$this->menu_id;
				$this->create_folder();

		if(!empty($this->menu_parent_id)){
			$this->update_parent();
		}
	  $database->db_query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
	
	public function delete(){
		global $database;
		$sql = "DELETE FROM ".self::$table_name." WHERE menu_id=".$this->menu_id;
		$viewfile = BASE_PATH."/views/".$this->menu_link;
		$controllerfile = BASE_PATH."/controllers/".strtolower($this->menu_link).".php";
		$modelfile	= BASE_PATH."/models/".strtolower($this->menu_link)."_model.php";
		if(is_dir($viewfile)){
			rmdir($viewfile);
		}
		if(file_exists($controllerfile)){
			unlink($controllerfile);
		}
		if(file_exists($modelfile)){
			unlink($modelfile);
		}
		if($this->menu_has_dropdown == 1){
		}
		$database->db_query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
}
?>