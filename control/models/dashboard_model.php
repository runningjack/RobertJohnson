<?php
class Dashboard_Model extends Model{
	function __construct(){
		parent::__construct();
	}
    
    /**
     * Dashboard statistics section
     */
     
     public function getDashboardStat(){
        global $database;
		$darray                       =   array();
		$open_ticket_count            =   ($database->dbNumRows($database->db_query("SELECT * FROM support_ticket WHERE status ='Open' ")));
        $open_schedule_count          =   ($database->dbNumRows($database->db_query("SELECT * FROM schedule WHERE status ='Open' ")));
        $open_worksheet_count         =   ($database->dbNumRows($database->db_query("SELECT * FROM work_sheet_form WHERE status ='Open' ")));
		$awaiting_ticket_count        =   ($database->dbNumRows($database->db_query("SELECT * FROM support_ticket WHERE status ='Customer Reply' ")));
        $closed_worksheet_count       =   ($database->dbNumRows($database->db_query("SELECT * FROM work_sheet_form WHERE status ='Closed' ")));
        $client_count                 =   ($database->dbNumRows($database->db_query("SELECT * FROM tbl_client")));  
        $client_products              =   ($database->dbNumRows($database->db_query("SELECT * FROM client_product")));
        //$schedule
        $openPendings          =Ticket::find_by_sql("SELECT * FROM support_ticket WHERE (status ='Admin Reply' OR status='Customer Reply') OR  status ='Open' ");
        // print_r($openPendings);
         $clients = Client::find_all();
		$darray                       =   array("cproducts"=>$client_products,"clients"=>$clients,"oworksheet"=>$open_worksheet_count,"oschedule"=>$open_schedule_count,"otcount"=>$open_ticket_count,"atcount"=>$awaiting_ticket_count,"openPend"=>$openPendings);
		return $darray;
     }
     
     public function getMonthlyReportFinance($date){
        global $database;
        $reportData                     =   array();
        $found                          =   $database->fetch_assoc($database->db_query("SELECT sum(fund) as fund,id FROM work_sheet_form WHERE ".$date));
        $partCost                       =   ($database->fetch_assoc($database->db_query("SELECT sum(total_cost) as total,id FROM tbl_part_replace WHERE ".$date)));
        $expences                       =   $found['fund'] + $partCost['total'];
        return number_format($expences,2,".",",") ;
     }
     
     
     public function getLastMonthlyReportFinance($date){
        global $database;
        $reportData                     =   array();
        $found                          =   $database->fetch_assoc($database->db_query("SELECT sum(fund) as fund,id FROM work_sheet_form WHERE ".$date));
        $partCost                       =   ($database->fetch_assoc($database->db_query("SELECT sum(total_cost) as total,id FROM tbl_part_replace WHERE ".$date)));
        $expences                       =   $found['fund'] + $partCost['total'];
        return number_format($expences,2,".",",") ;
     }
     
     public function getThisQuaterReportFinance($date){
        global $database;
        $reportData                     =   array();
        $found                          =   $database->fetch_assoc($database->db_query("SELECT sum(fund) as fund,id FROM work_sheet_form WHERE ".$date));
        $partCost                       =   ($database->fetch_assoc($database->db_query("SELECT sum(total_cost) as total,id FROM tbl_part_replace WHERE ".$date)));
        $expences                       =   $found['fund'] + $partCost['total'];
        return number_format($expences,2,".",",") ;
     }
}
?>