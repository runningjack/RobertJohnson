<meta http-equiv="refresh" content="25" />

<?php
//include_once("/views/includes/head.php");
?>

<?php $uri = new Url(""); ?>
    <h3 class="headline4">Customer Support Dashboard</h3>
<div class="large-12 columns" style="background: #f5f5f5">
    <div class="row">

        <?php
        if(count($this->clients) >0){
            foreach($this->clients as $client){
                echo "<div class='large-2 columns'>
            <div class='your-account' style='margin: 0;padding: 0;'>
                <h4 class='bg-black text-white' style=''>$client->name</h4>
                <div class='row'>
                    <div class='medium-3 columns'>
                        <div style='margin:10px 10px;padding:0 0 0 5px' ><h3><a href='". $uri->link("clientproduct/index&clientid=".$client->id)."'>";
                        global $database;

                echo $database->dbNumRows($database->db_query("SELECT * FROM client_product WHERE client_id = ".$client->id));

                        echo"<small> Terminals</small> </a></h3></div>
                        <div class='summary-border-top'  ></div>
                    </div>
                    <div class='medium-9 columns ' >

                        <div style='margin:5px 10px 5px 10px;padding:0 0 0 5px'  >

                            <h6>Tickets</h6>
                            <ul>
                                <li class='label round bg-green'><a href='". $uri->link("support/ticketlist&status=Closed&clientid=".$client->id)."' class='text-white'>".$database->dbNumRows($database->db_query("SELECT * FROM support_ticket WHERE status='Closed' AND client_id = ".$client->id))."</a>
                                </li>
                                <li class='label round bg-red'><a href='".$uri->link("support/ticketlist&status=Open&clientid=".$client->id)."' class='text-white'>".$database->dbNumRows($database->db_query("SELECT * FROM support_ticket WHERE status='Open' AND client_id = ".$client->id))."</a>
                                </li>
                                <li class='label round bg-blue'><a href='". $uri->link("support/ticketlist&status=Pending&clientid=".$client->id)."' class='text-white'>".$database->dbNumRows($database->db_query("SELECT * FROM support_ticket WHERE (status='Admin Reply' OR status='Customer Reply') AND client_id = ".$client->id))."</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
            }
        }


        ?>

    </div>
    <div class="row">

        <div class="large-12 columns">
            <div class="box">
                <div class="box-header bg-transparent">

                    <h3 class="box-title"><i class=""></i>
                        <span>RECENT CLIENT TICKETS</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body " style="display: block;">

                    <div id="example_wrapper" class="dataTables_wrapper">

                    <table id="dt_basic" class=" pure-table table table-striped table-bordered" width="100%">

                    <thead>

                    <tr>
                        <th >Date</th><th >ticketID</th><th>Terminal</th><th>Location</th><th>Client </th><th>Technician</th><th>Issue(s)</th><th>Status </th><th>Date Modified </th><th></th><th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    if($this->pendings){
                        foreach($this->pendings as $pending){
                            echo"<tr>
                    <td>".date_format(date_create($pending->datecreated),"M d Y")."</td><td>$pending->id</td><td>$pending->terminal_id</td>";

                    $prod  = Cproduct::find_by_terminal_id($pending->terminal_id);

                    echo "<td>";

                            if(empty($pending->location)){
                                echo $prod->install_address.", ".$prod->install_city;
                            }else{
                                echo $pending->location;
                            }

echo " </td>";

                    echo"<td>";
                            //$pending->client_name
                            $myclient = Client::find_by_id($pending->client_id);
                            if($myclient){
                                echo $myclient->name;
                            }

                            echo"</td><td>";
                            $schedule = Schedule::find_by_ticket_id($pending->id);
                            //print_r($schedule);
                            if($schedule){
                                $myengineer = Employee::find_by_id($schedule->emp_id);

                                   echo $myengineer ? $myengineer->emp_lname." ".$myengineer->emp_fname :"" ;


                            }

                            echo" </td><td>$pending->issue</td><td>";

                            if($pending->status == 'Open'){
                                echo "<span class='label bg-red' style='padding:5px'>$pending->status";
                            }else{
                                echo "<span class='label bg-blue' style='padding:5px'>Pending";
                            }

                            echo"</td><td>$pending->datemodified </td><td><a href='".$uri->link("support/detail/".$pending->id."")."'>View</a></td><td>
                <select sid='$pending->id' class='cschedule2'><option values=''>--Select--</option><option values='0'>Open</option><option values='1'>Closed</option><option values='2'>In Progress</option></select></td></tr>";
                        }
                    }
                    ?>

                    </tbody>

                    </table>

                </div>
                <!-- end .timeline -->
            </div>
            <!-- box -->
        </div>


    </div>
</div>


    <script type="text/javascript">
        (function($) {
            "use strict";
            $('#example').dataTable({
                "order": [
                    [3, "desc"]
                ]
            });
        })(jQuery);



        (function($) {
            "use strict";
            $('#footable-res2').footable().bind('footable_filtering', function(e) {
                var selected = $('.filter-status').find(':selected').text();
                if (selected && selected.length > 0) {
                    e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                    e.clear = !e.filter;
                }
            });

            $('.clear-filter').click(function(e) {
                e.preventDefault();
                $('.filter-status').val('');
                $('table.demo').trigger('footable_clear_filter');
            });

            $('.filter-status').change(function(e) {
                e.preventDefault();
                $('table.demo').trigger('footable_filter', {
                    filter: $('#filter').val()
                });
            });

            $('.filter-api').click(function(e) {
                e.preventDefault();

                //get the footable filter object
                var footableFilter = $('table').data('footable-filter');

                alert('about to filter table by "tech"');
                //filter by 'tech'
                footableFilter.filter('tech');

                //clear the filter
                if (confirm('clear filter now?')) {
                    footableFilter.clearFilter();
                }
            });
        })(jQuery);
    </script>

