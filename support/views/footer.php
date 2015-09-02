</div><!--main-->

	<div id="footer">
		<div class="wrapper">
			<p>&copy; 2013 <b>Robert Johnson Holdings</b></p>
		</div><!--wrapper-->
	</div><!--footer-->
   
    <script type="text/javascript" src="public/js/jquery.form.js"></script>
    
 <script type="text/javascript">
 $(document).ready(function(e){
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
		$.ajax({url:"?url=supportticket/doCreateClientReply/" + $("#disid").val(), type:"POST", data:{issue:$("#issue").val(),cname:$("#cname").val()},
		success : function(data){
			$("#granddiv").html("")
				$("#granddiv").html(data)
			}
		})
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