<?php
define("SERVER_NAME", "localhost");
define("DB_USER_NAME", "robertjo_admin");
define("DB_PASS", "9StUxyBHKMyq");
define("DB_NAME", "robertjo_website");


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


?>