<?php
class Reports_Model extends Model{
   function __construct(){
		parent::__construct();
	}
    
    public function issueStatByProd(){
        $issues                     =   Issue::find_all();
        $results                    =   array(array());
        $machineIssues              =   array();
        $machineIssuesCount         =   array();
        $finalData                  =   array();
        foreach($issues as $issue){
            
            $logCount               =   Issuelog::count_by_issue($issue->id);
            $machineIssues[]        =   $issue->issue_name;
            $machineIssuesCount[]   =   $logCount;
            $finalData[]            =   "'".$issue->issue_name."'".",".$logCount."_" ;
            
        }
         $results              =   $finalData;                // =  $machineIssues 
        return $results;
    } 
}
?>