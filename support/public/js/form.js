    $(document).foundation();
	$(document).ready(function(e) {
	   var globals = { 'payment_target':'catchable','empid':'','staffid':'','instname':'','qual':'','cert':'','grade':'','iyfro':'','iyto':'',};
	// $( "#datepicker" ).dtpicker();
        $('*[name=dob]').appendDtpicker();
       		
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
    
    
    /*
     Autocomple section for items
     */
     
     
     /*
          This section is needed for filters on vendors, and items and 
          transactions
          */
          
          
          $("#itemid").keyup(function(){
		var input= $("#itemid");
		if(input ){
			$.ajax({
				type:"post",
				url:"?url=stockin/doItemAutoComplete/",
				data:"input="+input.val(),
				success: function(outpt){
					
					$("#mySearchContainer").html(outpt);
					$("#mySearchContainer").slideDown(200);
					$("#mySearchContainer ul li").mouseover(function(){
						$("#mySearchContainer ul li").removeClass("hover");
						$(this).addClass("hover");
						
					})
					$("#mySearchContainer ul li").each(function(){
					$(this).click(function(){
						//$("#mySearchContainer div.sch").each(function(){
							var searchdata = $(this).find("div.sch").html();
							var hidfid = $(this).find("div.divvid").attr("vid");
                            var dress = $(this).find("div.divvid").attr("dress");
                            var cost = $(this).find("div.divvid").attr("vprice")
                            var pid =$(this).find("div.divvid").attr("prodid")
							$("#itemid").val(hidfid);
                            $("#price").val(cost);
                            $("#pid").val(pid)
							//$("#hidfid").val(hidfid);
                            
							$("#mySearchContainer").slideUp(200);
						//});
					})
					})
				}
			})
			
		}
		else if(input.lenght == 0){
			setTimeout(function() {
			jQuery('#mySearchContainer').hide();
			}, 600 );
			/*var mylabel = "Search for People, Books, Projects...";
		$(this).val(mylabel);*/
		}
		else{
			setTimeout(function() {
			jQuery('#mySearchContainer').hide();
			}, 600 );
		}
	});
    
    
    
    
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
    
    
    $("#btnwk").click(function(){
            $.ajax({url:"?url=employees/doInsertEmp_Wkexp",type:"POST",data:{empid:$("#empid").val(),comp:$("#company").val(),jtitle:$("#jobtitle").val(),compadd:$("#compaddress").val(),startdt:$("#empdatefro").val(),enddt:$("#empdateto").val()},
                    success : function(data){
                        $("#tblwk").html(data)
                    }
            })
            return false
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
