<?php 
$uri = new Url("");
 ?>
 <!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="initial-scale=1.0, width=device-width" />
<link href="public/css/style2.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css"/>
 <script type="text/javascript" src="public/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>

<style>
	@import url("public/css/resp.css") all and (max-width: 640px);
	#hideme{
		display:none;
		}
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
     width: 400px;
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
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css"/>
<title>Robert Johnson Holdings</title>
</head>

<body>
	<div id="header">
		<div class="wrapper">
			<img src="public/images/logo_2.png"/>

			<div class="right">
				<div class="welcome">
					<img src="public/images/user.png" alt=""/>
					<?php
						$user = Client::find_by_id($_SESSION['client_ident']);
						echo $user->contact_name." | ".$user->name." ";
					?>
					| <a href="<?php echo $uri->link("dashboard/doLogout") ?>">Logout</a>
				</div><!--welcome-->

			</div><!--right-->
		</div><!--wrapper-->
	</div><!--header-->

	<div id="menu">
    
		<div class="wrapper">
        
			<ul>
				<li <?php echo get_class()=="dashboard"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("dashboard/index") ?>">Home</a></li>
				<li <?php echo get_class()=="supportticket"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("supportticket/index") ?>">View Tickets</a></li>
				<li <?php echo get_class()=="supportticket"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("supportticket/create") ?>">Open New Tickets</a></li>
				<li <?php echo get_class()=="services"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("services/index") ?>">My Products &amp; Services</a></li>
				<li <?php echo get_class()=="account"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("account/edit")?>">Modify Profile</a></li>
                <li <?php echo get_class()=="account"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("account/changepassword") ?>">Change Password</a></li>
				<li <?php echo get_class()=="dashboard"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("dashboard/doLogout") ?>">Log Out</a></li>
			</ul>
		</div><!--wrapper-->
	</div><!--menu-->

	<div id="main">