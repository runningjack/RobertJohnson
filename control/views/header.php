<?php $uri= new Url("") ?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Robert Johnson Administrative Page</title>
  <link rel="stylesheet" href="public/css/foundation.css">
  <script src="public/js/vendor/custom.modernizr.js"></script>
  <style>
  .dash-title{
	  width:auto;
	  
	  color:#fff;
	  padding:20px auto;
	  border-bottom:.3em solid #F30;
  }
  
  #hideme{
		display:none;
		}
  .dash-title h3{
	  background-color:#FF6901;
	  margin:0;
	  width:13em;
	  padding:.2em;
	  -moz-border-radius:5px 5px 0 0 ;
      -webkit-border-radius:5px 5px 0 0;
      -khtml-border-radius: 5px 5px 0 0;
      border-radius:5px 5px 0 0 ;
	  
  }
  
   #nav {
    float: left;
    width: 280px;
    border-top: 1px solid #999;
    border-right: 1px solid #999;
    border-left: 1px solid #999;
	list-style:none;
	list-style-image:none;
	list-style-type:none;
}
#nav li a {
    display: block;
    padding: 10px 15px;
    background: #ccc;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #999;
    text-decoration: none;
    color: #000;
}
#nav li a:hover, #nav li a.active {
    background: #999;
    color: #fff;
}
#nav li ul {
    display: none; /*/ used to hide sub-menus*/
	list-style:none;
	list-style-image:none;
	list-style-type:none;
	 background: #ececec; padding:none;
}
#nav li ul li{
	margin:0;
	padding:0;
}
#nav li ul li a {
    padding: 10px 25px;
    background: #ececec;
    border-bottom: 1px dotted #ccc;
	
}
.button{
	padding:5px 20px;
}






/* CSS Document */
#mySearchContainer, #mySearchContainer2{
	z-index:5000 !important;
	width:100%;
	background-color:#fff;  
	position:absolute; 
	display:none;
	 box-shadow: 0 0 3px #666;
    -moz-box-shadow: 0 0 3px #666;
    -webkit-box-shadow: 0 0 3px #666;
	
}
 #mySearchContainer2, #mySearchContainer{
	 height:200px;
     width: 350px;
	 overflow:scroll
 }
#mySearchContainer ul, #mySearchContainer2 ul{
	list-style:none;
	list-style-image:none;
	margin:0;
	padding:0;
	
}
#mySearchContainer ul li, #mySearchContainer2 ul li{
	float:left;
	color:#666666;
	padding: 5px;
    width: 100%;
	border-bottom-width: thin;
	border-bottom-style: dotted;
	border-bottom-color: #999;
}
#mySearchContainer ul li h3, #mySearchContainer2 ul li h3{
	font-size:11px;
}
.hover{
	background-color:#01A5E1;
}



</style>

<script type="text/javascript">
   
  window.onload = setInterval(clearMessage,5000);
 var xhr = false
function clearMessage(){
	if(document.getElementById('transalert')){
		if(document.getElementById('transalert').innerHTML !=""){
			if(window.XMLHttpRequest){
				xhr = new XMLHttpRequest();
			}else{
				if(window.ActiveXObject){
					try{
						xhr = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch(e){
		
					}
				}
			}
			if(xhr){
				xhr.onreadystatechange = showMessage;
				xhr.open("GET","system/library/clearalert.php", true);
				xhr.send(null);
			}/*else{
				alert("something went wrong")
			}*/
		}
	}
}

function showMessage(){
	if(xhr.readyState ==4){
		if(xhr.status ==200){
			document.getElementById("transalert").innerHTML="";
		}
	}
	
}
</script>
</head>
<body>

 	<div class="large-12 columns no-bg no-padding">
<div id="wrap">
    <header id="header">
      <div class="inner relative">
        <div class="wrapper">
          <a class="logo" href="#"><img src="public/img/logo.png" alt="fresh design web"></a>
          <a id="menu-toggle" class="button dark" href="#">MENU</a>

            <div class="welcome">
              <img src="public/img/user.png" alt=""/>
              Welcome, <b><?php
                global $session;
                echo $_SESSION['fullname'];
              ?>
              </b>! | <a href="<?php echo $uri->link("dashboard/doLogout") ?>">Logout</a>
            </div><!--welcome-->
        </div>

      <nav id="navigation">
        <div class="wrapper">
          <ul id="main-menu">
            <li class="current-menu-item"><a href="<?php echo $uri->link("dashboard/index"); ?>">Home</a></li>
            <!--<li class="parent">
              <a href="#">About us</a>
              <ul class="sub-menu">
                <li><a href="#"><i class="icon-wrench"></i> Our Mission</a></li>
                <li><a href="#"> Our Vission</a></li>
                <li><a href="#"><i class="icon-gift"></i> Our Clientele</a></li>

              </ul>
            </li>-->

           <!-- <li class="parent">
              <a href="#">Product &amp; Services</a>
              <ul class="sub-menu">
                            <li><a href="#">ATMs</a></li>
                <li><a href="#">POS Terminals</a></li>
                <li><a href="#">Counting Machines</a></li>
                <li><a href="#">Card Printers</a></li>
                <li><a href="#">Personalization Machines</a></li>

              </ul>
            </li>-->

                      <li><a href="<?php echo $uri->link("dashboard/doLogout") ?>">Log out</a></li>
          </ul>
        </div>
      </nav>
      <div class="clear"></div>
    </div>
  </header> 
</div>
</div><!--Large 12-->
<div class="clear"></div>
<div class="container no-border" >
