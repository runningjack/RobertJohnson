

<!-- Table goes in the document BODY -->
<div class="panel callout">
	<h4 style="display:inline">Employee Listing</h4>
    <a href="<?php echo $uri->link("employees/create") ?>"><span class="button secondary right" style="display:inline">Add New</span></a>
    <?php
    global $session;
    //echo $session->department;
    //print_r($session->privil);

    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo" <a href='".  $uri->link("dasboard/index")."'><span class='btn btn-primary button right' style='display:inline'> &laquo;Back To Dashboard</span></a>";
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo" <a href='".  $uri->link("dashboard/index")."'><span class='btn btn-primary button right' style='display:inline'> &laquo;Back To Dashboard</span></a>";
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){

    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo" <a href='".  $uri->link("dashboard/index") ."'><span class='btn btn-primary button right' style='display:inline'> &laquo;Back To Dashboard</span></a>";
    }

    ?>

</div>
<div id='transalert'></div>
<div class="row filterbox" >
    <div class="large-12 columns" >
        <div class="large-3 columns">
            <label>First name/Last name</label>
            <input type="text" id="empname" name="empname" placeholder="Filter Record by Firstname or Lastname" autocomplete="off" />
            
        </div>
        
        <div class="large-3 columns">
            <label>Department</label>
            <select id='empdept' name='empdept' class="large-12 columns">
                           <option value='' selected='selected'>--SELECT DEPARTMENT--</option>
                            <?php
                            if($this->depts){
                                foreach($this->depts as $dept){
								    echo "<option value='{$dept->id}' >$dept->dept_name</option>" /*: ""*/;
								}
                            }
                            ?></select>
        </div>
        
        <div class="large-3 columns" >
            <label>Employee Role</label>
            <select id='emppost' name='emppost' class="large-12 columns">
                                 <option value='' selected='selected'>--SELECT DEPARTMENT--</option>
                            <?php
                            	if($this->role){
                                    foreach($this->role as $role){
									   echo "<option value='{$role->role_id}' >$role->role_name</option>" /*: ""*/;
									}
                                }
                            ?>
                            </select>
        </div>
        <br clear="all" />
        <div class="large-9 columns left">
        <hr />
            <a href="#" id="empallrec" class="" style="color: #000;">View All Records</a>
        </div>
        <div class="large-3 columns right">
            <a href="#" id="empfilter" class="btn btn-danger button">Filter Record</a>
        </div>
    </div>
</div>
<div id='emplisting'>
<?php echo $this->myemployee; ?>
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





  