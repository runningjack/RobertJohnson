</div>
</div>
</div><!--main-->
<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Modal Default</h4>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.0
    </div>
    <strong>Copyright &copy; 2013-2015 <a href="http://robertjohnsontechnologies.com">Robert Johnson Holdings</a>.</strong> All rights reserved.
</footer>
<script src="<?php echo DIR_ASSETS; ?>js/jquery-2.0.2.min.js"></script>
<script src="<?php echo DIR_ASSETS; ?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/js/jquery.form.js"></script>

<script src="public/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/docs.min.js"></script>
<script src="public/js/dropdowns-enhancement.min.js"></script>
<script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>

<script src="<?php echo DIR_ASSETS; ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo DIR_ASSETS; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo DIR_ASSETS; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo DIR_ASSETS; ?>plugins/daterangepicker/daterangepicker.js"></script>

<script src="<?php echo DIR_ASSETS; ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo DIR_ASSETS; ?>js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo DIR_ASSETS; ?>js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo DIR_ASSETS; ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo DIR_ASSETS; ?>js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
    
 <script type="text/javascript">
 $(document).ready(function(e){

     //Datemask dd/mm/yyyy
     $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
     //Datemask2 mm/dd/yyyy
     $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
     //Money Euro
     $("[data-mask]").inputmask();

     /* BASIC ;*/
     var responsiveHelper_dt_basic = undefined;
     var responsiveHelper_datatable_fixed_column = undefined;
     var responsiveHelper_datatable_col_reorder = undefined;
     var responsiveHelper_datatable_tabletools = undefined;

     var breakpointDefinition = {
         tablet : 1024,
         phone : 480
     };



     /* END BASIC */


     /* COLUMN FILTER  */
     var otable = $('#datatable_fixed_column').DataTable({
         //"bFilter": false,
         //"bInfo": false,
         //"bLengthChange": false
         //"bAutoWidth": false,
         //"bPaginate": false,
         //"bStateSave": true // saves sort state using localStorage
         "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
             "t"+
             "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",

         "autoWidth" : true,
         "preDrawCallback" : function() {
             // Initialize the responsive datatables helper once.
             if (!responsiveHelper_datatable_fixed_column) {
                 responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
             }
         },
         "rowCallback" : function(nRow) {
             responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
         },
         "drawCallback" : function(oSettings) {
             responsiveHelper_datatable_fixed_column.respond();
         }

     });

     // custom toolbar
     $("div.toolbar").html('<div class="text-right"></div>');

     // Apply the filter
     $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {

         otable
             .column( $(this).parent().index()+':visible' )
             .search( this.value )
             .draw();

     } );

     $("#datatable_fixed_column_filter label").addClass("input-group")
     $("#datatable_fixed_column_filter label input.form-control").attr("placeholder","Search by any field")
          /* END COLUMN FILTER */




     var globals = { 'payment_target':'catchable','amt':0,'transcost':0,'total':0,'mReport':0 };
    $('#frmEmp').bind('submit', function(e) {
    	e.preventDefault(); // <-- important
    	$(this).ajaxSubmit({
    	target:'#transalert'
    	});
        $(this).resetForm()
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
    
    $("#dh").click(function(){
        $("#hideme").slideToggle();
        return false
    })
    
    
    
    $("#prodname").keyup(function(){
    var input= $("#prodname");
    $("#mySearchContainer").html("<div style='width:150px; margin:25px auto;'>Loading Content...<img src='public/img/loading.gif'   height='20' /></div>");
    if(input.val() !=""   ){
        //console.log(input.length)
      $.ajax({
        type:"post",
        url:"?url=clientproduct/doProdAutoComplete/"+input.val(),
        data:"input="+input.val(),
        success: function(outpt){
          if(outpt.length > 6){
            
            $("#mySearchContainer").html(outpt);
            $("#mySearchContainer").slideDown(200);
            $("#mySearchContainer ul li").hover(function(){
                $(this).toggleClass("hover");
            })
                $("#mySearchContainer ul li").each(function(){
                  $(this).on("mousedown",function(){
                    //$("#mySearchContainer div.sch").each(function(){
                      var searchdata = $(this).find("div.sch").html();
                      var prodid = $(this).find("div.divvid").attr("prodid");
                      //console.log(prodid,searchdata)
                                    var dress = $(this).find("div.divvid").attr("dress");
                                    var cost = $(this).find("div.divvid").attr("vprice")
                                    var pid =$(this).find("div.divvid").attr("prodid")
                      $("#service").val(pid);
                      console.log($("#service").val());
                      $("#prodname").val(searchdata)
                                    $("#price").val(cost);
                                    
                                    
                      $("#mySearchContainer").slideUp(200);
                  });
                  });
            
          }else{
            $('#mySearchContainer').slideUp(200);
          }
        }
        })
                
    }else{
       $('#mySearchContainer').slideUp(200);
    }    
  })
  

  
  $("#prodname").on("blur",function(){
    $('#mySearchContainer').slideUp(200);
  })
  
  $("#mySearchContainer ul li").each(function(){
	  $(this).hover(function(){
		$(this).toggleClass("hover");
		})
	})
  
  
  
	
    
    $("#close").click(function(){
        $.ajax({url:"?url=supportticket/doCloseTicket",type:"POST",data:{id:$("#disid").val()},
            success : function(data){
                $("#divclose").html(data);

            }
        })
        document.location.reload(true);
        return false
    })
    
    $("#psave").click(function(){
        $.ajax({url:"?url=account/doUpdate", type:"POST", data:{cname:$("#cname").val(),cphone:$("#cphone").val(),cemail:$("#cemail").val()}, success : function(result){
            $("#transalert").html(result);
        }
        })
        return false;
    })
	
	$("#pwsave").click(function(){
        $.ajax({url:"?url=account/doUpdate", type:"POST", data:{opword:$("#opword").val(),pword:$("#pword").val(),pword2:$("#pword2").val()}, success : function(result){
            $("#transalert").html(result);
        }
        })
        return false;
    })
    
    $("#mmm").on("click", function(e){
        var rel =e.target.getAttribute("rel");
        if(rel === globals.payment_target && e.target.getAttribute("id")==="psave"){
            $.ajax({url:"?url=account/doUpdate", type:"POST", data:{cname:$("#cname").val(),cphone:$("#cphone").val(),cemail:$("#cemail").val()}, success : function(result){
            $("#transalert").html(result);
        }
        })
    }
    })
	
	
	/* the section is needed 
	to update the client reply via ajax*/
	$("#replysave").click(function(){

        $("#transalert").html("<div style=' width:317px; margin:10px auto'><img src='<?php echo DIR_ASSETS;?>img/bigLoader.gif'  ><h2>Sending Reply to RJ Support...Please Wait</h2><div>")
		$.ajax({url:"?url=supportticket/doCreateClientReply/" + $("#disid").val(), type:"POST", data:{issue:$("#issue").val(),cname:$("#cname").val()},
		success : function(data){
            $("#granddiv").html(data)
			}
		})
        $("#transalert").html("");
        $("#issue").val("")
        $("#hideme").slideToggle();
        //$("#hideme").html("<div style=' width:317px; margin:10px auto'><img src='<?php echo DIR_ASSETS;?>img/bigLoader.gif'  ><h2>Sending Reply to RJ Support...Please Wait</h2><div>")
        //$("#hideme").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4>	<i class='icon fa fa-check'></i> Alert!</h4>Success alert preview. This alert is dismissable.</div>")
        // window.location.reload(true);
       // window.location = window.location.href
	})
	/*close client reply ajax section*/
    
    $("#changepass").on("click", function(e){
        var rel =e.target.getAttribute("rel");
        if(rel === globals.payment_target && e.target.getAttribute("id")==="pwsave"){
            $.ajax({url:"?url=account/doUpdate", type:"POST", data:{uname:$("#uname").val(),opword:$("#opword").val(),pword:$("#pword").val(),pword2:$("#pword2").val()}, success : function(result){
            $("#transalert").html(result);
        }
        })
    }
    })
	
	$("#login").click(function(){
            console.log("All good")
            $.ajax({url:'?url=login/doLogin',type:"POST",data:{username:$('#username').val(), password:$("#password").val()},
                success: function(result){ 
                    console.log(result)
                    logmein(parseInt(result)) 
                },error: function(){
                    alert("Unexpected Error")
                }
            })
        })
        
        $("#forget").click(function(){
            $.ajax({url:"?url=login/validateEmail", type:"POST", data:{memail:$("#memail").val()},
                success: function(result){
                    $("#msgforget").html(result)
                }
            })
        })
	
	
 });
 
 
 function logmein(data){
        if(data===1){
            window.location = "?url=dashboard/index"
        }
        if(data===2){
            $("#alertme").html("<div data-alert class='alert-box alert'>Invalid username and password combination<a href='#' class='close'>&times;</a></div>");
        }
    }
 </script>
</body>
</html>