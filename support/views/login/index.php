<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="initial-scale=1.0, width=device-width" />
<link href="public/css/style2.css" rel="stylesheet" type="text/css"/>
<style>
	@import url("public/css/resp.css") all and (max-width: 640px);
</style>
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>dist/css/AdminLTE.min.css">
<title>Robert Johnson Holdings</title>
</head>

<body style="background-image:url(public/images/loginpg.png); background-repeat:no-repeat; width:100%; height:auto">
	<div  ><div id="header">
		<div class="wrapper">
			

			<div class="right">
				<!--welcome-->

			</div><!--right-->
		</div><!--wrapper-->
	</div><!--header-->

    <div class="wrapper">
    	<div class="col-12" style="margin-top:200px;  margin-left:500px;  width:350px; padding-bottom:190px">
    	<form action="" id="frmLogin" name="frmLogin" method="post" >
        	<fieldset style="background: url(public/images/bg2.jpg) repeat-x;">
            
                <legend><h2>Client Login</h2></legend><div id="alertme"><?php echo $this->msg ?></div>
            	<label>Username</label>
                <input type="text" placeholder="Username" name='username' id='username' class="large-12" />
                <label>Password</label>
                <input type="password" placeholder="Password" name="password" id="password" class="large-12" />

                <label>Role</label>
                <select name="myrole" id="myrole">
                    <option value="">--Select Role--</option>
                    <option value="admin">Administrator</option>
                    <option value="standard user">Standard User</option>
                </select>

                <input type="button"  class="submit " id='login' name="login" value="Login" /> 
               <!-- <a href="#" class=" center" data-reveal-id="forgetPassword">Forgot Password?</a>-->
        	</fieldset>
        </form>
        <!--<div id="forgetPassword" class="reveal-modal small" data-animation="fade">
 <h4>Password recovery window,<small> Enter your email to recover your password</small></h4>
 <hr />
    <div id="msgforget"></div>
    <input type="text" id="memail" name="memail" autocomplete='off' required='required' />
    <button class="button" id="forget" name="forget">Recover</button>
   <a class="close-reveal-modal">&#215;</a>
  </div>-->
        
    </div>
 </div>
 </div>

    	  

	
   
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="public/js/jquery-1.7.2.min.js"></script>
        
    <script type="text/javascript">
		$(document).ready(function(e) {
        $("#login").click(function(){
            $.ajax({url:'?url=login/doLogin',type:"POST",data:{username:$('#username').val(), password:$("#password").val(),userole:$("#myrole").val()},
                success: function(result){
                    logmein(parseInt(result)) 
                },error: function(){
                   
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
						window.location.href = ("?url=dashboard/index");
                        //window.location = "?url=dashboard/index"
                    }
                    if(data===2){
                        $("#alertme").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Invalid username, password or role combination</div>");
                    }
        if(data===3){
            $("#alertme").html("<div  class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please select a role</div>");
        }
    }
		
		
	</script>
  </body>
</html>


