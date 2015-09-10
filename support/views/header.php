<?php 
$uri = new Url("");
 ?>
 <!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="initial-scale=1.0, width=device-width" />
<!--<link href="public/css/style2.css" rel="stylesheet" type="text/css"/>-->

 <script type="text/javascript" src="public/js/jquery-1.7.2.min.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Robert Johnson | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo DIR_ASSETS; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    <link rel="stylesheet" type="text/css" href="<?php echo DIR_ASSETS; ?>css/tableStyle.css"/>
<title>Robert Johnson Holdings</title>
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
<div class="wrapper">
	<div id="header">
		<!--<div class="wrapper">-->
			<img src="public/images/logo_2.png"/>

			<div class="right">
				<div class="welcome">
					<img src="public/images/user.png" alt=""/>
					<?php
                    global $session;
                    $user = Client::find_by_id($_SESSION['client_ident']);
                    if($_SESSION['user_role'] =="admin"){
						echo $user->contact_name." | ".$user->name." ";
                    }elseif($_SESSION['user_role'] =="standard user"){
                        $me = Clientuser::find_by_id($_SESSION['user_ident']);
                        echo $me->lname." | ".$user->name." ";
                    }
					?>
					| <a href="<?php echo $uri->link("dashboard/doLogout") ?>">Logout</a>
				</div><!--welcome-->

			</div><!--right-->
            <!--</div>wrapper-->
	</div><!--header-->

    <nav role="navigation" class="navbar navbar-default navbar-static" id="navbar-example" style="background-color: #515151;

	box-shadow: 2px 2px 4px #969494;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button data-target=".bs-example-js-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a href="<?php echo $uri->link("dashboard/index") ?>" class="navbar-brand">RJ SUPPORT</a> </div>
            <div class="collapse navbar-collapse bs-example-js-navbar-collapse">
                <ul class="nav navbar-nav">

                  <li><a href="<?php echo $uri->link("dashboard/index") ?>">Home</a></li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown">Support Tickets <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li <?php echo get_class()=="supportticket"? 'id="selected"' : ''; ?> ><a href="<?php echo $uri->link("supportticket/index") ?>">View Tickets</a></li>
                            <li <?php echo get_class()=="supportticket"? 'id="selected"' : ''; ?> ><a href="<?php echo $uri->link("supportticket/create") ?>">New Ticket</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown">Products <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li <?php echo get_class()=="services"? 'id="selected"' : ''; ?> ><a href="<?php echo $uri->link("services/index") ?>">My Products &amp; Services</a>
                            <li><a href="<?php echo $uri->link("services/activate")?>">Product Activation</a> </li>

                        </ul>
                    </li>

                    <li class="dropdown"><a href="#" data-toggle="dropdown">Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li <?php echo get_class()=="account"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("account/edit")?>">Modify Profile</a></li>
                            <li <?php echo get_class()=="account"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("account/changepassword") ?>">Change Password</a></li>
                        </ul>
                    </li>
<?php global $session ;
                    if($_SESSION['user_role'] ==="admin"){
                    echo "<li class='dropdown'><a href='#' data-toggle='dropdown'>Users <b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                            <li ><a href='".$uri->link("users/create")."'>Create User</a></li>
                            <li ><a href='".$uri->link("users/index")."'>Listing</a></li>
                        </ul>
                    </li>";
                    }
                ?>




                    <li <?php echo get_class()=="dashboard"? 'id="selected"' : ''; ?>><a href="<?php echo $uri->link("dashboard/doLogout") ?>">Log Out</a></li>

                </ul>

            </div>
            <!-- /.nav-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


<div row>
    <div class="wrapper">
        <div class="content">