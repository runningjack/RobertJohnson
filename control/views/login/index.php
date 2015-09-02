<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<?php global $session ?>
<html class="no-js" lang="en" > <!--<![endif]-->
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Robert Johnson Administrative Page</title>
  <link rel="stylesheet" href="public/css/foundation.css">
  <script src="public/js/vendor/custom.modernizr.js"></script>
  
  <style>
  	.button{
		 padding:5px 20px;
	}
  </style>
</head>
<body>
	<div class="large-12 columns no-bg no-padding">
<div id="wrap">
    <header id="header">
<div class="wrapper">
          
</div>
</header>
</div>
</div>


<div class="row">
  <div class="large-12 columns"></div>
	<div class="large-4 columns centered" style="float: none; margin: 50px auto 0 auto; padding:0; border:.1em solid #c3c3c3">
      	<form action="" id="frmLogin" name="frmLogin" method="post" >
        	<div style=" text-align: center; background-color:#23A9EF; padding:5px"><img src="public/img/rj_logo.png" width="155" height="100" ></div><fieldset style="border:none; padding:2px 20px">
                <h5>Admin Login</h5><div id="alertme"><?php echo $this->msg ?></div>
            	<label>Username</label>
                <input type="text" placeholder="Username" name='username' id='username' value="<?php echo isset($_COOKIE['uname']) ? $_COOKIE['uname'] : '' ?>" class="large-12" />
                <label>Password</label>
                <input type="password" placeholder="Password" name="password" id="password" value="<?php echo isset($_COOKIE['pword']) ? $_COOKIE['pword'] : '' ?>" class="large-12" />
                <input type="button"  class="button right" id='login' name="login" value="Login" /> 
                <input type="checkbox" id="remember" name="remember" value="" /> Remember me <br />
                <a href="#" class=" center" data-reveal-id="forgetPassword">Forgot Password?</a>
        	</fieldset>
        </form>
        
    </div>
 </div>
 <div id="forgetPassword" class="reveal-modal small" data-animation="fade">
 <h4>Password recovery window,<small> Enter your email to recover your password</small></h4>
 <hr />
    <div id="msgforget"></div>
    <input type="text" id="memail" name="memail" autocomplete='off' required='required' />
    <button class="button" id="forget" name="forget">Recover</button>
   <a class="close-reveal-modal">&#215;</a>
  </div>
 </div>
 
 

 <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'public/js/vendor/zepto' : 'public/js/vendor/jquery') +
  '.js><\/script>')
  </script>
  
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
  
 
  
  <script>
    $(document).foundation();
	$(document).ready(function(e) {
        $("#login").click(function(){
            $.ajax({url:'?url=login/doEmpLogin',type:"POST",data:{username:$('#username').val(), password:$("#password").val(),remember:$("#remember").val()},
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
