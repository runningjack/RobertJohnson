</div><!--End of container no border-->
<footer id="footer">
	<div class="row">
		<div class="large-12 columns">
		  <p> &copy; 2013 - Robert Johnson Holdings.</p>
		</div>
	</div>
</footer>
 <script src="public/js/vendor/zepto.js"></script>
   <script src="public/js/vendor/jquery.js"></script>
  <script src="public/js/foundation.min.js"></script>

  <script src="public/js/foundation/foundation.js"></script>
  
  <script src="public/js/foundation/foundation.interchange.js"></script>
  
  <script src="public/js/foundation/foundation.abide.js"></script>
  
  <script src="public/js/foundation/foundation.dropdown.js"></script>
  
  <script src="public/js/foundation/foundation.placeholder.js"></script>
  
  <script src="public/js/foundation/foundation.forms.js"></script>
  
  <script src="public/js/foundation/foundation.alerts.js"></script>
  
  <script src="public/js/foundation/foundation.magellan.js"></script>
  
  <script src="public/js/foundation/foundation.reveal.js"></script>
  
  <script src="public/js/foundation/foundation.tooltips.js"></script>
  
  <script src="public/js/foundation/foundation.clearing.js"></script>
  
  <script src="public/js/foundation/foundation.cookie.js"></script>
  
  <script src="public/js/foundation/foundation.joyride.js"></script>
  
  <script src="public/js/foundation/foundation.orbit.js"></script>
  
  <script src="public/js/foundation/foundation.section.js"></script>
  
  <script src="public/js/foundation/foundation.topbar.js"></script>
  <script type="text/javascript" src="public/js/jquery.form.js"></script>
  <link rel="stylesheet" type="text/css" href="public/css/jquery.simple-dtpicker.css"/>
  <script type="text/javascript" src="public/js/jquery.simple-dtpicker.js"></script>
 <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="public/js/excanvas.js"></script><![endif]-->
<script type="text/javascript" src="public/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="public/js/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="public/js/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="public/js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="public/js/plugins/jqplot.pointLabels.min.js"></script>
<link rel="stylesheet" type="text/css" href="public/css/jquery.jqplot.min.css" />
  
  <script >
    $(document).foundation();
	$(document).ready(function(e) {
	   var globals = { 'myissue':'','payment_target':'catchable','empid':'','staffid':'','instname':'','qual':'','cert':'','grade':'','iyfro':'','iyto':'',};
       var myDataArray  = new Object;
	// $( "#datepicker" ).dtpicker();
        $('*[name=dob]').appendDtpicker();
        $('*[name=w_date]').appendDtpicker();
      
              		
		/* MAIN MENU */
	$('#main-menu > li:has(ul.sub-menu)').addClass('parent');
	$('ul.sub-menu > li:has(ul.sub-menu) > a').addClass('parent');
		
	$('#menu-toggle').click(function() {
		$('#main-menu').slideToggle(300);
		return false;
	});
    
    
    $('#triglink1').click(function() {
        
		$('#divins').slideToggle(300);
		return false;
	});
    
    $('#triglink2').click(function() {
        
		$('#divwk').slideToggle(300);
		return false;
	});
    
    $('#triglink3').click(function() {
        
		$('#divaddnox').slideToggle(300);
		return false;
	});
    
    $('#triglink4').click(function() {
        
		$('#divref').slideToggle(300);
		return false;
	});		
	$(window).resize(function() {
		if($(window).width() > 700) {
			$('#main-menu').removeAttr('style');
		}
	});
	$("#soo").on('change', function(){
              
        $("#lgload").html("<img src='public/images/gif-load.gif' />Loading...")
            $.ajax({url:"?url=employees/getLgas", type:"POST",data:{soo:$("#soo").val()}, success: function(result){
                $("#lga").html(result);
            }  
        })
        $("#lgload").html("") 
    })
    
    
    $("#areaname").on('change', function(){
            $.ajax({url:"?url=clientproduct/getRegion", type:"POST",data:{area:$("#areaname").val()}, success: function(result){
                $("#sregion").html(result);
            }  
        })  
    })
    
    
	$('#frmpriviledge').bind('submit', function(e) {
    	e.preventDefault(); // <-- important
    	$(this).ajaxSubmit({
    	target:'#transalert'
    	});
        $(this).resetForm()
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
		
	$('#frmpriviledgeUpdate').bind('submit', function(e) {
    	e.preventDefault(); // <-- important
    	$(this).ajaxSubmit({
    	target:'#transalert'
    	});
        $(this).resetForm()
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
	$('#frmDepartment').bind('submit', function(e) {
    	e.preventDefault(); // <-- important
    	$(this).ajaxSubmit({
    	target:'#transalert'
    	});
        $(this).resetForm()
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
	
	$('#frmDepartmentUpdate').bind('submit', function(e) {
    	e.preventDefault(); // <-- important
    	$(this).ajaxSubmit({
    	target:'#transalert'
    	});
        $(this).resetForm()
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
    
    $('#frmEmp').bind('submit', function(e) {
    	e.preventDefault(); // <-- important
    	$(this).ajaxSubmit({
    	target:'#transalert'
    	});
        $(this).resetForm()
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
		
	$('#nav > li > a').click(function(){
    if ($(this).attr('class') != 'active'){
      $('#nav li ul').slideUp();
      $(this).next().slideToggle();
      $('#nav li a').removeClass('active');
      $(this).addClass('active');
    }
  });
  
  $("#fname").on('blur', function(e){
        $.ajax({url:"?url=employees/validateRegister", type:"POST",data:{fname:$("#fname").val()}, success: function(result){
                $("#fnm").html(result);
            }           
        })
               
  })
  $("#lname").on('blur', function(e){
        $.ajax({url:"?url=employees/validateRegister", type:"POST",data:{lname:$("#lname").val()}, success: function(result){
                $("#lnm").html(result);
            }           
        })
               
  })
  $("#email").on('blur', function(e){
        $.ajax({url:"?url=employees/validateRegister", type:"POST",data:{email:$("#email").val()}, success: function(result){
                $("#femail").html(result);
            }           
        })
               
  })
  
  $("#phone").on('blur', function(e){
        $.ajax({url:"?url=employees/validateRegister", type:"POST",data:{phone:$("#phone").val()}, success: function(result){
                $("#phone").html(result);
            }           
        })
               
  })
    
    $("#login").click(function(){
            $.ajax({url:'?url=login/doLogin',type:"POST",data:{username:$('#username').val(), password:$("#password").val()},
                success: function(result){
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
        
        
        /*
         this section is required for posting employee
         work experience;
         */
         
         $("#btnwk").click(function(){
            $.ajax({url:"?url=employees/doInsertEmp_Wkexp",type:"POST",data:{empid:$("#empid").val(),comp:$("#company").val(),jtitle:$("#jobtitle").val(),compadd:$("#compaddress").val(),startdt:$("#empdatefro").val(),enddt:$("#empdateto").val()},
                    success : function(data){
                        $("#tblwk").html(data)
                    }
            })
            return false
         })
         
         $("#btnref").click(function(){
            $.ajax({url:"?url=employees/doInsertEmp_Ref",type:"POST",data:{empid:$("#empid").val(),staffid:$("#staffid").val(),refname:$("#refname1").val(),refadd:$("#refaddress1").val(),refpost:$("#refdesignation1").val(),refphone:$("#refphone1").val(),refemail:$("#refemail1").val()},
                    success : function(data){
                        $("#tblref").html(data)
                    }
            })
            return false
         })
         
         $("#btnnox").click(function(){
            $.ajax({url:"?url=employees/doInsertEmp_NOK",type:"POST",data:{empid:$("#empid").val(),staffid:$("#staffid").val(),kinname:$("#gfname").val(),kinadd:$("#gaddress").val(),refpost:$("#grelationship").val(),kinphone:$("#gtelephone").val(),kinemail:$("#gemail").val()},
                    success : function(data){
                        $("#tblkin").html(data)
                    }
            })
            return false
         })
         
         $("#btnins").click(function(){
            $.ajax({url:"?url=employees/doInsertEmp_INS",type:"POST",data:{empid:$("#empid").val(),staffid:$("#staffid").val(),insname:$("#institution").val(),qual:$("#qualification").val(),grade:$("#grade").val(),cert:$("#cert").val(),datefro:$("#insdatefro").val(),dateto:$("#insdateto").val()},
                    success : function(data){
                        $("#tblins").html(data)
                    }
            })
            return false
         })
         
         
         $("#btnrole").click(function(){
            $.ajax({url:"?url=employees/doEmpRoleUpdate",type:"POST",data:{empid:$("#empid").val(),staffid:$("#staffid").val(),emppost:$("#emppost").val(),empdept:$('#empdept').val()},
                    success : function(data){
                        $("#p").html(data)
                    }
            })
            return false
         })
		 
		 
		 
		 $("#btnpword").click(function(){
            $.ajax({url:"?url=employees/doEmpPassUpdate",type:"POST",data:{empid:$("#empid").val(),staffid:$("#staffid").val(),emppass:$("#password").val()},
                    success : function(data){
                        $("#passdiv").html(data)
                    }
            })
            return false
         })
		 
         
       
         $("#instdataModal").on('click',function(e){
            
            console.log($("#institutionU").val())
            var rel = e.target.getAttribute('rel');
          
            if(rel === globals.payment_target && e.target.value ==="UpdateINS"){
                       $.ajax({url:"?url=employees/doUpdateEmp_INS",type:"POST",data:{instid:$('#instid').val(),empid:$("#empid").val(),staffid:$("#staffid").val(),insnameU:$("#institutionU").val(),qualU:$("#qualificationU").val(),gradeU:$("#gradeU").val(),certU:$("#certU").val(),datefroU:$("#insdatefroU").val(),datetoU:$("#insdatetoU").val()},
                               success : function(data){
                                   $("#tblins").html(data)
                                   $("alertme").html("Record Updated")
                               }
                       })
                       }
           
            return false 
         })
         
         
         $("#workdataModal").on('click',function(e){
            var rel = e.target.getAttribute('rel');
          
            if(rel === globals.payment_target && e.target.getAttribute("ddata") ==="UpdateWRK"){
                       $.ajax({url:"?url=employees/doUpdateEmp_WRK",type:"POST",data:{instid:$('#instid').val(),empid:$("#empid").val(),staffid:$("#staffid").val(),jobtitle:$("#jobtitleU").val(),jobtype:$("#jobtypeU").val(),company:$("#companyU").val(),compaddress:$("#compaddressU").val(),empdatefro:$("#empdatefroU").val(),empdateto:$("#empdatetoU").val()},
                               success : function(data){
                                   $("#tblwk").html(data)
                                   $("alertme").html("Record Updated")
                               }
                       })
                       }
           
            return false 
         })
         
         
         $("#nokdataModal").on('click',function(e){
            var rel = e.target.getAttribute('rel');
            if(rel === globals.payment_target && e.target.getAttribute("ddata") === "Update"){
                       $.ajax({url:"?url=employees/doUpdateEmp_NOK",type:"POST",data:{instid:$('#instid').val(),empid:$("#empid").val(),staffid:$("#staffid").val(),kinname:$("#gfnameU").val(),address:$("#gaddressU").val(),phone:$("#gtelephoneU").val(),email:$("#gemailU").val(),rela:$("#grelationshipU").val()},
                               success : function(data){
                                   $("#tblkin").html(data)
                                   $("alertme").html("Record Updated")
                               }
                       })
            }
            return false 
         })
         
         
         
         $("#nokdataModal").on('click',function(e){
            var rel = e.target.getAttribute('rel');
          
            if(rel === globals.payment_target && e.target.getAttribute("ddata") === "Update"){
                       $.ajax({url:"?url=employees/doUpdateEmp_NOK",type:"POST",data:{instid:$('#instid').val(),empid:$("#empid").val(),staffid:$("#staffid").val(),kinname:$("#gfnameU").val(),address:$("#gaddressU").val(),phone:$("#gtelephoneU").val(),email:$("#gemailU").val(),rela:$("#grelationshipU").val()},
                               success : function(data){
                                   $("#tblkin").html(data)
                                   $("alertme").html("Record Updated")
                               }
                       })
                       }
           
            return false 
         })
         
         
         $("#refdataModal").on('click',function(e){
            var rel = e.target.getAttribute('rel');
            if(rel === globals.payment_target && e.target.getAttribute("ddata") === "Update"){
                       $.ajax({url:"?url=employees/doUpdateEmp_REF",type:"POST",data:{instid:$('#instid').val(),empid:$("#empid").val(),staffid:$("#staffid").val(),refname:$("#refname1U").val(),address:$("#refaddress1U").val(),refpost:$("#refdesignation1U").val(),phone:$("#refphone1U").val(),email:$("#refemail1U").val()},
                               success : function(data){
                                   $("#tblref").html(data)
                                   $("alertme").html("Record Updated")
                               }
                       })
                       }
           
            return false 
         })
         
         /*
          this section loads 
          */
          
          $("a.insteditlink").each(function(){
            
            $(this).click(function(){
               
                $.ajax({url:"?url=employees/instituteU/",type:"POST",data:{instid:$(this).attr("instid")},
                        success : function(data){
                            $("#instdataModal").html(data)
                        }
                })
                
            })
         })
         
         
          $("a.workeditlink").each(function(){
            $(this).click(function(){
                $.ajax({url:"?url=employees/workU/",type:"POST",data:{instid:$(this).attr("instid")},
                        success : function(data){
                            $("#workdataModal").html(data)
                        }
                }) 
            })
         })
         
         
         $("a.refeditlink").each(function(){
            $(this).click(function(){
                $.ajax({url:"?url=employees/refU/",type:"POST",data:{instid:$(this).attr("instid")},
                        success : function(data){
                            $("#refdataModal").html(data)
                        }
                }) 
            })
         })
         
         
         $("a.kindatalink").each(function(){
            $(this).click(function(){
                
                $.ajax({url:"?url=employees/nokU/",type:"POST",data:{instid:$(this).attr("instid")},
                        success : function(data){
                            $("#nokdataModal").html(data)
                        }
                }) 
            })
         })
         
         /*
                 This section is used to check delete for customercare personnel can delete any listing
                 */
                $(".delData").each(function(){
                    $(this).click(function(){
                        $.ajax({
                            url:"?url=careperson/doCheckCuscare",
                            type:"POST",
                            data:{uid:$(this).attr("uid")},
                            success: function(result){
                                $("#getData").html("<h4>"+result+"</h4>")
                            }
                        })
                        
                    })
                })
                
                $('#getData').on('click',function(e){
				var rel = e.target.getAttribute('rel');
				var uid = e.target.getAttribute('uid')
				if(rel === globals.payment_target && e.target.value==="Delete"){
					 $.ajax({
					   url:"?url=careperson/doDelete/"+uid,
                       type:"POST",
                       data:{},
                       success: function(result){
                            $('#getData').html("<h4>"+result+"</h4>")
                            setInterval(window.location.reload(),20000)
                       }
					 })
                      
				}
                
                if(rel === globals.payment_target && e.target.value==="Cancel"){
                     window.location.reload()
				}					
			});
         
         
         /*
          This section is needed for filters on vendors, and items and 
          transactions
          */
          
          
        $("#vendid").keyup(function(){
    		var input= $("#vendid");
    		if(input ){
    			$.ajax({
    				type:"post",
    				url:"?url=stockin/doVendAutoComplete/",
    				data:"input="+input.val(),
    				success: function(outpt){
    					
    					$("#mySearchContainer2").html(outpt);
    					$("#mySearchContainer2").slideDown(200);
    					$("#mySearchContainer2 ul li").mouseover(function(){
    						$("#mySearchContainer2 ul li").removeClass("hover");
    						$(this).addClass("hover");
    						
    					})
    					$("#mySearchContainer2 ul li").each(function(){
    					$(this).click(function(){
    						//$("#mySearchContainer div.sch").each(function(){
    							var searchdata = $(this).find("div.sch").html();
    							var hidfid = $(this).find("div.divvid").attr("vid");
                                var dress = $(this).find("div.divvid").attr("dress");
    							$("#vendid").val(hidfid);
    							//$("#hidfid").val(hidfid);
                                $("#dress").html(dress)
    							$("#mySearchContainer2").slideUp(200);
    						//});
    					})
    					})
    				}
    			})
    			
    		}
    		else if(input.lenght == 0){
    			setTimeout(function() {
    			jQuery('#mySearchContainer2').hide();
    			}, 600 );
    			/*var mylabel = "Search for People, Books, Projects...";
    		$(this).val(mylabel);*/
    		}
    		else{
    			setTimeout(function() {
    			jQuery('#mySearchContainer2').hide();
    			}, 600 );
    		}
    	});
        
        $("a.modalclose").click(function(){
            var pdid    =   $(this).attr("pdid")
            $('#firstModal'+pdid).foundation('reveal', 'close');
        })
        
        
        /**$('#firstModal').foundation('reveal', 'open', {
            url: 'http://some-url',
            success: function(data) {
                alert('modal data loaded');
            },
            error: function() {
                alert('failed loading modal');
            }
        });



 * this is a generic autocomplete
 *method for client just replicate the 
 *inputs field as used below 
 * to keep thing consistence
 */
$("#clientname").keyup(function(){
        var input= $("#clientname");
        $("#mySearchContainer2").slideDown(200);
        $("#mySearchContainer2").html("<div style='width:150px; margin:25px auto;'>Loading Content...<img src='public/img/loading.gif'   height='20' /></div>");
        if(input.val() !="" ){
          $.ajax({
            type:"post",
            url:"?url=clientproduct/doClientAutoComplete/",
            data:"input="+input.val(),
            success: function(outpt){
               
            if(outpt.length > 6){
              $("#mySearchContainer2").html(outpt);
              
              $("#mySearchContainer2 ul li").mouseover(function(){
                $("#mySearchContainer2 ul li").removeClass("hover");
                $(this).addClass("hover");
                
              })
              
              $("#mySearchContainer2 ul li").each(function(){
              $(this).on("mousedown",function(){
                //$("#mySearchContainer div.sch").each(function(){
                  var searchdata = $(this).find("div.sch").html();
                  var hidfid = $(this).find("div.divvid").attr("vid");
                                var dress = $(this).find("div.divvid").attr("dress");
                  $("#clientid").val(hidfid);
                  $("#clientname").val(searchdata);
                                $("#dress").html(dress)
                  $("#mySearchContainer2").slideUp(200);
                //});
              })
              })
              
            }else{
                $("#mySearchContainer2").slideUp(200);
            }}
          })
          }else{
            $("#mySearchContainer2").slideUp(200);
          }
        
      });
      /*
   on blur method for 
   client autocomplete 
   method on clientname text input
   */
      
      $("#clientname").on("blur",function(){
            $("#mySearchContainer2").slideUp(200);
            $("#clientid").val("");
            $("#clder").css("position","absolute")
            $("#clder").css("background-color","#fff")
            $("#clder").html("<img src='public/img/loading2.gif' />");
            $.ajax({
                url:"?url=general/doGetClientByName/"+$("#clientname").val(),
                type:"POST",
                data:{input:$("#clientid").val(),input2:""},
                success: function(data){
                    
                    if(isNaN(data)){
                        $("#clientname").addClass("error")
                        //$("#tm").html(data);
                    }else{
                        $("#clientname").removeClass("error")
                        $("#clientid").val(data) 
                        $("#pmydiv").css("display","block")
                    }
                    $("#clder").html("");
                }  
            })  
      })
    clearMessage;
    /**
     *this is a generic autocomplete
     *method for stock items just replicate the 
     *inputs field as used below 
     * to keep thing consistence
     */
     
     
     $("#itemname").keyup(function(){
    var input= $("#itemname");
    $("#mySearchContainer").html("<div style='width:150px; margin:25px auto;'>Loading Content...<img src='public/img/loading.gif'   height='20' /></div>");
    if(input.val() !=""   ){
        //console.log(input.length)
      $.ajax({
        type:"post",
        url:"?url=stockin/doItemAutoComplete/"+input.val(),
        data:"input="+input.val(),
        success: function(outpt){
          if(outpt.length > 6){
            
            $("#mySearchContainer").html(outpt);
            $("#mySearchContainer").slideDown(200);
            $("#mySearchContainer ul li").hover(function(){
                $(this).toggleClass("hover");
            })//////////ooooo
                $("#mySearchContainer ul li").each(function(){
                  $(this).on("mousedown",function(){
                    //$("#mySearchContainer div.sch").each(function(){
                      var searchdata = $(this).find("div.sch").html();
                      var prodid = $(this).find("div.divvid").attr("prodid");
                      //console.log(prodid,searchdata)
                      
                      var searchdata = $(this).find("div.sch").html();
							var hidfid = $(this).find("div.divvid").attr("vid");
                            var dress = $(this).find("div.divvid").attr("dress");
                            var cost = $(this).find("div.divvid").attr("vprice")
                            var pid =$(this).find("div.divvid").attr("prodid")
							$("#itemid").val(hidfid);
                            $("#price").val(cost);
                            $("#pid").val(pid);
                            $("#itemname").val(dress);
                            //console.log($("#pid").val())
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
  
  
  $("#itemname").on("blur",function(){
            $("#mySearchContainer").slideUp(200);
            $("#plder").css("position","absolute")
            $("#plder").css("background-color","#fff")
            $("#plder").html("<img src='public/img/loading2.gif' />");
            $("#tm").html("");
            $("#prodid").val("");
            $.ajax({
                url:"?url=general/doGetItemByName/"+$("#itemname").val(),
                type:"POST",
                data:{input:$("#itemid").val(),input2:""},
                success: function(data){
                    $("#itemid").val("")
                    if(isNaN(data)){
                        $("#itemname").addClass("error")
                        //$("#tm").html(data);
                    }else{
                        $("#itemname").removeClass("error")
                       $("#itemid").val(data) 
                    }
                    $("#plder").html("");
                    console.log($("#itemid").val())
                }
            })
      })
  
      
        $(".callout a").css("color","#ce1010")
        $('#empsubmit').click(function(){
                var srt = $("#frmEmpup").serialize();
                
                $.ajax({
                    type: 'POST',
                    url: '?url=employees/doUpdate/',
                    data: srt,
                    success: function(d) {
                        $("#alertme2").html(d);
                    }
            });
            console.log("all good")
			return false;
         });
         
     
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
                      $("#prodid").val(pid);
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
  
  
  /*
   on blur method for 
   product autocomplete 
   method on prodname text input
   */
  
   $("#prodname").on("blur",function(){
            $("#mySearchContainer").slideUp(200);
            $("#plder").css("position","absolute")
            $("#plder").css("background-color","#fff")
            $("#plder").html("<img src='public/img/loading2.gif' />");
            $("#tm").html("");
            $("#prodid").val("");
            $.ajax({
                url:"?url=general/doGetProductByName/"+$("#prodname").val(),
                type:"POST",
                data:{input:$("#prodid").val(),input2:""},
                success: function(data){
                    
                    if(isNaN(data)){
                        $("#prodname").addClass("error")
                        //$("#tm").html(data);
                    }else{
                        $("#prodname").removeClass("error")
                       $("#prodid").val(data) 
                    }
                    $("#plder").html("");
                }
            })
      })
      
      
      /*
       section to search for 
       client product
       */
       
       
       
       $("#cprodname").keyup(function(){
    var input= $("#cprodname");
    var clientid=$("#clientid");
    $("#mySearchContainer").html("<div style='width:150px; margin:25px auto;'>Loading Content...<img src='public/img/loading.gif'   height='20' /></div>");
    if(input.val() !="" && clientid.val() !=""   ){
        //console.log(input.length)
      $.ajax({
        type:"post",
        url:"?url=clientproduct/doCProdAutoComplete/"+input.val(),
        data:{input:input.val(),clientid:$("#clientid").val()},
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
                      $("#prod_id").val(pid);
                      $("#cprodname").val(searchdata)
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
  
  /*
   on blur method for 
   product autocomplete 
   method on prodname text input
   */
  
   $("#cprodname").on("blur",function(){
            $("#mySearchContainer").slideUp(200);
            $("#plder").css("position","absolute")
            $("#plder").css("background-color","#fff")
            $("#plder").html("<img src='public/img/loading2.gif' />");
            $("#tm").html("");
            //$("#prod_id").val("");
            //console.log($("#prod_id").val())
            $.ajax({
                url:"?url=general/doGetCProductByName/"+$("#prod_id").val(),
                type:"POST",
                data:{input:$("#prod_id").val(),input2:""},
                success: function(data){
                    
                    if(isNaN(data)){
                        //$("#cprodname").addClass("error")
                        //$("#tm").html(data);
                    }else{
                        //$("#cprodname").removeClass("error")
                       //$("#prod_id").val(data) 
                    }
                    $("#plder").html("");
                }
            })
            
            console.log($("#prod_id").val())
      })
      
      
 
    $("a.modifyqty").each(function(e) {
		$(this).click(function(e) {
			var p =$(this).attr('prodid')
			var q = $(this).attr('count')
			var pr = $(this).attr('tprice')
		   $.post("library/modifyquantity.php",{pid:p,newQty:$('#qty'+q).val(),price:pr, ajax:true},function(){
				//alert(pr)
				window.location.reload()
			})
			return false;
		});
	});
	//deletes an item from the cart
	$(".deleteitem").each(function(e) {
		$(this).click(function(e) {
			$.post("library/deletefromcart.php",{pid:$(this).attr('prodid'), ajax:true},function(){
				window.location.reload()
			})
			return false;
		 });
    });
    
    
    
    /*
     Stock adding section
     this section is required to 
     work with the stock in purchases 
     form it is used to create a listing of products for purchase
     */
     
     $(".addtocart").click(function() {
        var pid 	= $("#pid").val()
		//var catname = $("#catname").val()
		var price	= $("#price").val()
		var pname	= $("#itemid").val()
		var qty		= $("#qty").val()
		
		$.post("?url=stockin/doAddToCart",{ppid:pid,pcatname:pname,pprice:price,ppname:pname,pqty:qty, ajax:true},function(data)
            {   
                $("div#itemCart").html(data)
               	$("#palert").html("<div data-alert class='alert success'>Success: You have added this item to your shopping cart!<a class='close'>&times</div></div>")
		
            })
		;
		$('html, body').animate({ scrollTop: 550 }, 'slow');
		
		
	
		return false
    });
    
    
    $("#dh").click(function(){
        $("#hideme").slideToggle();
        return false
    })
    
    $("#close").click(function(){
        $.ajax({url:"?url=support/doCloseTicket",type:"POST",data:{id:$("#disid").val(),cemail:$("cemail").val()},
            success : function(data){
                $("#divclose").html(data);
            }
        })
        return false
    })
    
    
    /* the section is needed 
	to update the client reply via ajax*/
	$("#replysave").click(function(){
	   //console.log($("#disid").val())
		$.ajax({url:"?url=support/doCreateAdminReply/" + $("#disid").val(), type:"POST", data:{cemail:$("#cemail").val(),issues:$("#issue").val(),conname:$("#cname").val()},
		success : function(data){
			
				$("#granddiv").html(data)
			}
            
		})
        $("#hideme").slideToggle();
	})
	/*close client reply ajax section*/
    
    $("#btnwk").click(function(){
            $.ajax({url:"?url=employees/doInsertEmp_Wkexp",type:"POST",data:{empid:$("#empid").val(),comp:$("#company").val(),jtitle:$("#jobtitle").val(),compadd:$("#compaddress").val(),startdt:$("#empdatefro").val(),enddt:$("#empdateto").val()},
                    success : function(data){
                        $("#tblwk").html(data)
                    }
            })
            return false
         })
    
    $("#country").on("change",function(){
        $.ajax({url:"?url=general/getSate", type:"POST",data:{country:$("#country").val()}, 
            success : function(data){
               $("#state").html(data); 
            }
        })
    })
    
    /*
     this section is require to \
     update schedule for client product
     */
    $("#ssave").click(function(){
        
        $.ajax({url:"?url=clientproduct/doScheduleUpdate", type:"POST", data:{cid:$("#cid").val(),sdate:$("#sdate").val()},
        success : function(data){
            $("#searchdata").html(data)
        }
        })
    })
    
     /*
     the section is needed to save sch
     edule to create a maintenance schedule
     at support ticket console
     */
    $("#csave").click(function(){
        //console.log($("#cid").val() +" "+ $("#mtype").val() +" "+ $("#taskdate").val() + " "+$("#emp").val())
        $.ajax({url:"?url=clientproduct/doCreateSchedule/" + $("#disid").val(), type:"POST", data:{cid:$("#cid").val(),mtype:$("#mtype").val(),taskdate:$("#taskdate").val(), empid:$("#emp").val(),tissue:$("#tissue").val(),cemail:$("#cemail").val(),},
         success : function(data){
            $("#searchdata2").html(data)
         }
        })
    })
    
    
    /*
     the section is needed to save sch
     edule to create a maintenance schedule
     */
    $("#csaves").click(function(){
        
        $.ajax({url:"?url=support/doCreateSchedule", type:"POST", data:{cid:$("#cid").val(),mtype:$("#mtype").val(),taskdate:$("#taskdate").val(), empid:$("#emp").val(),tissue:$("#tissue").val()},
         success : function(data){
            $("#searchdata2").html(data)
         }
        })
    })
    //name="locationthemes"]:checked'
    $("input[class='iss']:checked").each(function(){
        $(this).click(function(){
        var issuetype ="";
        //event.preventDefault();
        //if($(this).is(":checked")){
            var searchIDs = $(this).map(function(){
              globals.myissue += $(this).val()+",";
            }).get(); // <----
        //}else{
          //  globals.myissue.replace($(this).val()+",","") ;
        //}
    console.log(globals.myissue)
    
        })
    })
    
    
    
    
    $("#adpart").click(function(){
        $("#ptable").html("")
                $("#ptable").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
        $.ajax({url:"?url=support/doCreateAddPart", type:"POST", data:{price:$("#price").val(),itemname:$("#itemname").val(),prodid:$("#prod_id").val(),itemid:$("#itemid").val(),wid:$("#pgid").val(),itemname:$("#itemid").val(),qty:$("#qty").val()},
            success : function(data){
                $("#ptable").html(data);
            }
        })
        return false;
    })
    
    
    $("a.acceptTask").each(function(e){
        $(this).click(function(){
           var mtaskid      = $(this).attr("scheddata") 
           //$("#scheddata").html("<img src='public/img/loading.gif' style='text-align:center' >") 
            $.ajax({
                            url:"?url=itdepartment/doAcceptTask/"+mtaskid,
                            type:"POST",
                            data:{taskid:mtaskid,mid:'2'},
                            success: function(result){
                                //$("#report").html(result)
                                $("#scheddata").html(result)
                               
                            }
                        })
                        //$('#secondModal').foundation('reveal', 'open');
           return false;             
        })
       
    }) 
    
     /*
             this section handles delete for 
             the customer listing page
             */
             
            $(".itdeletelink").each(function(){
                    $(this).click(function(){
                        $.ajax({
                            url:"?url=support/doDeleteAddPart",
                            type:"POST",
                            data:{itemid:$(this).attr("itdid"),wid:$("#pgid").val()},
                            success: function(result){
                                $("#ptable").html("<h4>"+result+"</h4>")
                            }
                        })
                        return false;
                    })
            })
            
            
            $("#cpfilter").click(function(){
                $("#prodlisting").html("")
                $("#prodlisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=clientproduct/index",
                    type:"POST",
                    data:{prodname:$("#prodname").val(),clientname:$("#clientname").val(),areaname:$("#areaname").val(),location:$("#location").val(),machine:$("#machine").val()},
                    success: function(result){
                        $("#prodlisting").html(result);
                    }
                })
                return false;//empallrec
            })
            
            $("#empfilter").click(function(){
                $("#emplisting").html("")
                $("#emplisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=employees/index",
                    type:"POST",
                    data:{empname:$("#empname").val(),empdept:$("#empdept").val(),emppost:$("#emppost").val()},
                    success: function(result){
                        $("#emplisting").html(result);
                    }
                })
                return false;
            })
            
            $("#empallrec").click(function(){
                $("#emplisting").html("")
                $("#emplisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=employees/index",
                    type:"POST",
                    data:{rec:"All"},
                    success: function(result){
                        $("#emplisting").html(result);
                    }
                })
                return false;
            })
            
            
            $("#wsfilter").click(function(){
                $("#emplisting").html("")
                $("#emplisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=support/worksheetlist",
                    type:"POST",
                    data:{prodid:$("#prodid").val(),clientid:$("#clientid").val(),status:$("#status1").val(),issue:$("#issue").val()},
                    success: function(result){
                        $("#emplisting").html(result);
                    }
                })
                return false;
            })
            
            
            $("#allrec").click(function(){
                $("#prodlisting").html("")
                $("#prodlisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=clientproduct/index",
                    type:"POST",
                    data:{rec:"All"},
                    success: function(result){
                        $("#prodlisting").html(result);
                    }
                })
                return false;
            })
            
            
            $("#tkfilter").click(function(){
                $("#emplisting").html("")
                $("#emplisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=support/ticketlist",
                    type:"POST",
                    data:{prodname:$("#cprodname").val(),prodid:$("#prod_id").val(),clientid:$("#clientid").val(),status:$("#status").val(),issue:$("#issue").val()},
                    success: function(result){
                        $("#emplisting").html(result);
                    }
                })
                return false;
            })
            
            
            $("#tkallrec").click(function(){
                $("#prodlisting").html("")
                $("#prodlisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=support/ticketlist",
                    type:"POST",
                    data:{rec:"All"},
                    success: function(result){
                        $("#emplisting").html(result);
                    }
                })
                return false;
            })
            
            /**
             * Section to filter for task manager module
             */
             
             $("#tskfilter").click(function(){
                $("#emplisting").html("")
                $("#emplisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=support/scheduleList",
                    type:"POST",
                    data:{prodname:$("#cprodname").val(),prodid:$("#prod_id").val(),clientid:$("#clientid").val(),status:$("#status").val(),issue:$("#issue").val()},
                    success: function(result){
                        $("#emplisting").html(result);
                    }
                })
                return false;
            })
            
            
            $("#tskallrec").click(function(){
                $("#prodlisting").html("")
                $("#prodlisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=support/scheduleList",
                    type:"POST",
                    data:{rec:"All"},
                    success: function(result){
                        $("#emplisting").html(result);
                    }
                })
                return false;
            })
             
             
            
            $("#itfilter").click(function(){
                $("#emplisting").html("")
                $("#emplisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                var condit  =   $("#cond").val();
                var prices  =   $("#prices").val();
                var mycondi =   condit+" "+prices;
                $.ajax({
                    url:"?url=stockitems/index",
                    type:"POST",
                    data:{itemname:$("#itemname").val(),descript:$("#namedes").val(),condi:$("#cond").val(),price:$("#prices").val()},
                    success: function(result){
                        $("#emplisting").html(result);
                    }
                })
                return false;
            })
            
            $("#itallrec").click(function(){
                $("#emplisting").html("")
                $("#emplisting").append("<div class='ddd' style='width:150px; margin:50px auto; height:50px'></div>")
                $(".ddd").html("Loading Content...<img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                $.ajax({
                    url:"?url=stockitems/index",
                    type:"POST",
                    data:{rec:"All"},
                    success: function(result){
                        $("#emplisting").html(result);
                    }
                })
                return false;
            })
            
            
            
            
            $('#searchdata2').on('change',function(e){
				var rel = e.target.getAttribute('rel');
				//console.log(e.target.value+ " "+ e.target.checked)
				if(rel === globals.payment_target && e.target.checked===true){
				    myDataArray[e.target.getAttribute("name")]= e.target.value;
                   
                    myDataArray["cid"]          =   $("#cid").val()
                    
			        
				}
               
                if(rel === globals.payment_target && e.target.checked ===false){
                    delete myDataArray[e.target.getAttribute("name")]
                    
                }
                
                console.log(myDataArray)
				
			});
			
           $('#searchdata2').on('click',function(e){
			    var rel = e.target.getAttribute('rel');
				//console.log(e.target.value+ " "+ e.target.getAttribute('name'))
				if(rel === globals.payment_target && e.target.value =="Save"){
				    myDataArray["tissue"]       =   $("#tissue").val()
                    myDataArray["taskdate"]     =   $("#taskdate").val()
                    myDataArray["mtype"]        =   $("#mtype").val()
                     myDataArray["empid"]        =   $("#emp").val()
                    var jsonstring = JSON.stringify(myDataArray);
                    //var myglob    =JSON.stringify(globals)
                   // $("#searchdata2").html("Assigning Task...please wait!  <img src='public/img/loading.gif' style='width:500px; height:10px'   />");
                    
                    $.ajax({url:"?url=clientproduct/doCreateSchedule_Detail/" + $("#disid").val(),dataType:"json", type:"POST", data:{data:jsonstring},
                     success : function(data){
                     globals.myissue = data
                     }
                    })
                  // $("#searchdata2").html(globals.myissue)
				   	
				}
				
			});
            
            
            
            
                //[[['Dispenser',25],['Card reader',14],['Printer',7]]]
            //console.log(line);
        var plot1 = $.jqplot('pie1',[<?php echo $this->dato;?>] , {
        gridPadding: {top:0, bottom:38, left:0, right:0},
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer, 
            trendline:{ show:false }, 
            rendererOptions: { padding: 8, showDataLabels: true }
        },
        legend:{
            show:true, 
            placement: 'outside', 
            rendererOptions: {
                numberRows: 3
            }, 
            location:'s',
            marginTop: '15px',
            marginLeft: '20px'
        }       
    });
       
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
