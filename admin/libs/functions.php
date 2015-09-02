<?php
require_once('config.php');

	function dbFetchArray($result, $resultType = MYSQL_NUM_ROWS) {
	return mysql_fetch_array($result, $resultType);
}
 function  checkEmail($email) {
 if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email)) {
  return false;
 }
 return true;
}

function checkPhone($phone){
if(preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $phone) ) { 
    return false;
}
return true;	
}
/************************************
*****SWF Function extract************
************************************/
if (!function_exists("dump")) {
	function dump($s) {
		echo "<pre>";
		print_r($s);
		echo "</pre>";
	}
}

if (!function_exists("trace")) {
	function trace($s) {
		if (SFB_DEBUG) {
			$oFile = @fopen("log.txt", "a");
			$sDump  = $s."\n";
			@fputs ($oFile, $sDump );
			@fclose($oFile);
		}
	}
}
/*public function invoice_no(){
		global $database; 
		$rec_date=strftime("%Y-%m-%d %H:%M:%S", time());
		$sql="INSERT INTO rec_count (rec_date) VALUES ('$rec_date')";
		
		if(!empty($input)){
			db_query($sql);
			$input=mysql_insert_id();
			$invoice_no = str_pad($input, 7, "0", STR_PAD_LEFT);
			return $invoice_no;
		}
		else{
			return false;
		}
	}*/
	function confirm_query($resultSet){
		if (!$resultSet) {
		die( "Query not executed" .mysql_error());
			}
		}
	function dbInsert($sql)
		{
			$result = mysql_query($sql);
			if ($result==1){
				$message="Record Saved";
			}
			else{
				$message="Unexpected Error! Record not Saved";
			}
			return $message;
		}	
	function dbNumRows($result){ 
			return mysql_num_rows($result);
		}
		
	function dbQuery($sql)
		{
			$result = mysql_query($sql) or die(mysql_error());
			confirm_query($result);
			return $result;
		}	

	function get_all_programmes($sql) {
		global $connection;
		$sqlquery ="SELECT * FROM $sql";
					//ORDER BY prog_name ASC";
		$all_programmes = mysql_query($sqlquery, $connection);
		confirm_query($all_programmes);
		return $all_programmes;
	}
	
	function ifexist($sql) {
		global $connection;
		$sqlquery =$sql;
					//ORDER BY prog_name ASC";
		$all_programmes = mysql_query($sqlquery, $connection);
		confirm_query($all_programmes);
		$rowexist = dbNumRows($all_programmes);
		if ($rowexist >= 1 ){
			return true;
		}
		else{
			return false;
		}
	}
	
	function get_any($sql) {
		global $connection;
		$sqlquery =$sql;
					//ORDER BY prog_name ASC";
		$all_programmes = mysql_query($sqlquery, $connection);
		confirm_query($all_programmes);
		return $all_programmes;
	}
	 
	function dbFetchAssoc($result)
	{
	return mysql_fetch_assoc($result);
	}
	
	function redirect_to($loc = NULL){
		if ($loc != NULL) {
			header("Location: {$loc}");
			exit;
		}
}
	
/*function __autoload($class_name){
	$class_name = strtolower($class_name);
	$path = "include/{$class_name}.php";
	if(file_exists($path)){
		require_once($path);
	}
	else{
		die("The file {$class_name}.php could not be found");
	}
}
*/function check_user(){
	if (!isset($_SESSION['LOGGEDIN']) ) {
		header("location: ../login.php");
		exit;
	}

}




function getPagingQuery($sql, $itemPerPage = 10)
{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}
	
	// start fetching from this row number
	$offset = ($page - 1) * $itemPerPage;
	
	return $sql . " LIMIT $offset, $itemPerPage";
}

	 
function getPagingLink($id, $table, $numLinks=5, $pagingLink="", $pagelink='')
{
		$pages = count_table($table);
		$totalPages = ceil($pages/SEARCH_NO);

		// create the paging links only if we have more than one page of results
		if ($totalPages > 1) {
			$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
	
			if (isset($id) && $id > 0) {
				$pageNumber = $id;
			} else {
				$pageNumber = 1;
			}
			
			// print 'previous' link only if we're not
			// on page one
			if ($pageNumber > 1) {
				$page = $pageNumber - 1;
				if ($page > 1) {
					$prev = " <a href=\"$self?url=".$pagelink."$page\">[Prev]</a> ";
				} else {
					$prev = " <a href=\"$self?url=".$pagelink."1\">[Prev]</a> ";
				}	
					
				$first = " <a href=\"$self?url=".$pagelink."1\">[First]</a> ";
			} else {
				$prev  = ''; // we're on page one, don't show 'previous' link
				$first = ''; // nor 'first page' link
			}
		
			// print 'next' link only if we're not
			// on the last page
			if ($pageNumber < $totalPages) {
				$page = $pageNumber + 1;
				$next = " <a href=\"$self?url=".$pagelink."$page\">[Next]</a> ";
				$last = " <a href=\"$self?url=".$pagelink."$totalPages\">[Last]</a> ";
			} else {
				$next = ''; // we're on the last page, don't show 'next' link
				$last = ''; // nor 'last page' link
			}
	
			$start = $pageNumber - ($pageNumber % $numLinks) + 1;
			$end   = $start + $numLinks - 1;		
			
			$end   = min($totalPages, $end);
			
			$pagingLink = array();
			for($page = $start; $page <= $end; $page++)	{
				if ($page == $pageNumber) {
					$pagingLink[] = " $page ";   // no need to create a link to current page
				} else {
					if ($page == 1) {
						$pagingLink[] = " <a href=\"$self?url=".$pagelink."$page\">$page</a> ";
					} else {	
						$pagingLink[] = " <a href=\"$self?url=".$pagelink."$page\">$page</a> ";
					}	
				}
		
			}
			
			$pagingLink = implode(' | ', $pagingLink);
			
			// return the page navigation link
			$pagingLink = $first . $prev . $pagingLink . $next . $last;
		}
		
		return $pagingLink;
	
		}
		
function get_curr_date() {
	$myTime = time();
	$currTime = strftime("%Y-%m-%d %H:%M:%S", $myTime);
	return $currTime;
}


function createRandomPassword() { 

    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789abcdefghijklmnopqrstuvwxyz"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 

    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 

    return $pass; 

} 
	
	function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago ";
}

	
	function assign_task($id, $mech, $dealer, $agent){
		global $database;
		$sql = "INSERT INTO user_type (user_id, mech, dealer, agent) VALUES (".$id.", ".$mech.", ".$dealer.", ".$agent.")";
		return ($database->db_query($sql)) ? true : false;
	}
	
	function check_username($uname){
		global $database;
		$sql = "SELECT * FROM users WHERE username = '".$uname."'";	
		$result = $database->db_query($sql);
		$rowexist = $database->dbNumRows($result);
		if ($rowexist >= 1){
			return false;
		}
		else{
			return true;
		}
	}
	
	function checkadmin($id){
		global $database;
		$sql = "SELECT level FROM admin_user_id WHERE user_id = $id";
		$result = $database->if_exist($sql);
		return ($result==true) ? true : false;
	}
	
	function adminLog($user_id, $activity, $admin_level){
		global $database;
		$log_time = date("Y-m-d H:i:s");
		$sql ="INSERT INTO admin_log (user_id, admin_level, activity, log_time) VALUES ($user_id, $admin_level, '$activity',  '$log_time')";
		$database->db_query($sql);
		
	}
	
	function userLog($user_id, $activity){
		global $database;
		$log_time = date("Y-m-d H:i:s");
		$sql ="INSERT INTO user_log (user_id, activity, log_time) VALUES ($user_id, '$activity', '$log_time')";
		$database->db_query($sql);
		
	}
	
	function getDirectoryList ($directory){
		
			// create an array to hold directory list
			$results = array();
		
			// create a handler for the directory
			$handler = opendir($directory);
		
			// open directory and walk through the filenames
			while ($file = readdir($handler)) {
		
			  // if file isn't this directory or its parent, add it to the results
			  if ($file != "." && $file != "..") {
				$results[] = $file;
			  }
		
			}
		
			// tidy up: close the handler
			closedir($handler);
		
			// done!
			return $results;
		
		  }
		  
	function count_table($table){
		$database = new Database;
		$result = $database->db_query('SELECT COUNT(*) FROM '.$table."");
		$row = $database->fetch_row($result);	
		return $row[0];
	}
	
	function hashpassword($algo, $data, $salt){
		$context = hash_init($algo, HASH_HMAC, $salt);
		hash_update($context, $data);
		
		return hash_final($context);
		
	}
	
	
	?>