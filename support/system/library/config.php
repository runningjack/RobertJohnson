<?php
/*define("SERVER_NAME", "localhost");
define("DB_USER_NAME", "robertjo_admin");
define("DB_PASS", "9StUxyBHKMyq");
define("DB_NAME", "robertjo_website");*/

define("SERVER_NAME", "localhost");
define("DB_USER_NAME", "root");
define("DB_PASS", "");
define("DB_NAME", "robertjohnson");


if (!get_magic_quotes_gpc()) {
	if (isset($_POST)) {
		foreach ($_POST as $key => $value) {
			$_POST[$key] =  trim(addslashes($value));
		}
	}
	if (isset($_GET)) {
		foreach ($_GET as $key => $value) {
			$_GET[$key] = trim(addslashes($value));
		}
	}	
}

//require_once 'connection.php';
//require_once 'functions.php';

?>

<?php
       function import($path=""){
               if($path == ""){ //no parameter returns the file import info tree;
                       $report = $_SESSION['imports'];
                       foreach($report as &$item) $item = array_flip($item);
                       return $report;
               }

               $current = str_replace("\\","/",getcwd())."/";
               $path = $current.str_replace(".","/",$path);
               if(substr($path,-1) != "*") $path .= ".class.php";

               $imports = &$_SESSION['imports'];
               if(!is_array($imports)) $imports = array();

               $control = &$imports[$_SERVER['SCRIPT_FILENAME']];
               if(!is_array($control)) $control = array();

               foreach(glob($path) as $file){
                       $file = str_replace($current,"",$file);
                       if(is_dir($file)) import($file.".*");
                       if(substr($file,-10) != ".class.php") continue;
                       if($control[$file]) continue;
                       $control[$file] = count($control);
                       require_once($file);
               }
       }
?> 
 