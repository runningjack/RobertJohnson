
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="http://charteredmarketersauction.com.ng/public/css/foundation.css">
 <link rel="stylesheet" href="http://charteredmarketersauction.com.ng/public/css/normalize.css">
  <link rel="stylesheet" href="http://charteredmarketersauction.com.ng/public/css/styles.css">
   <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Ubuntu:400,300,500,700">
  <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans">
  <style type='text/css'>
  header{
	background: #fff url(images/bg-header-line.png) no-repeat scroll center 93px;
	-webkit-box-shadow: 0 6px 32px -9px rgba(0, 0, 0, .4);
	box-shadow: 0 6px 32px -9px rgba(0, 0, 0, .4);
	position: relative;
    z-index: 3;
}
	#logo{
		border:  none;
		margin: 0;
		padding: 0;
		width: 304px;
		-webkit-transition: all 0.3s ease;
		-moz-transition: all 0.3s ease;
		-o-transition: all 0.3s ease;
		-ms-transition: all 0.3s ease;
		transition: all 0.3s ease;
	}
	#logo:hover{
		opacity: 0.7;
	}
	
/* ========
	Row Sections
======================= */
.alpha{
	background: #e4eded;
	padding: 30px 0;
}
.wrappy{
    background: #e4eded url(images/inner-bg.png) no-repeat scroll center top;
    position: relative;
}
.main-body,
.body{
    background: #fff;
    margin: 0;
	overflow: hidden;
    padding: 45px 20px 40px 40px;
}
.body{
	overflow: hidden;
	padding: 20px 20px 40px;
}

/* ========
	Buttons
======================= */
.btn-cta{
	color: #fff;
	display: block;
	font-family: 'RobotoCondensed', Arial, sans-serif;
	line-height: 16px;
	padding: 10px 25px 8px;
	text-align: center;
	text-transform: uppercase;
	
	-webkit-transition: all 0.45s ease;
	-moz-transition: all 0.45s ease;
	-o-transition: all 0.45s ease;
	-ms-transition: all 0.45s ease;
	transition: all 0.45s ease;
}
.btn-cta{
	background: #14212a;
	font-size: 16px;
	padding: 15px 10px 10px;
}
.btn-cta:active,
.btn-cta:hover{
	background: #82bab8;
	color: #fff;
}

/* ========
	Primary Navigation
======================= */
#utility{
	float: right;
}
#utility ul{
	margin: 0;
	overflow: hidden;
	padding: 0;
}
#utility ul li{
	display: inline;
	float: left;
}
	nav a,
	#utility a,
    aside li a{
		-webkit-transition: all 0.45s ease;
		-moz-transition: all 0.45s ease;
		-o-transition: all 0.45s ease;
		-ms-transition: all 0.45s ease;
		transition: all 0.45s ease;
	}
	
/* ========
	Utility Navigation
======================= */
#utility{
	margin: 12px 0 5px;
}
	#utility a:link,
	#utility a:visited{
		background: url(images/u-pipe.png) no-repeat scroll left center;
		color: #a5a5a5;
		display: block;
		font-size: 12px;
		padding: 9px 10px 7px;
	}
	#utility a:active,
	#utility a:hover,
	#utility .selected a{
		background-color: transparent;
		color: #82bab8;
	}
	#utility li:first-child a{
		background-image: none;
	}
	#utility a.btn-uty{
		background: #f6f6f6;
		color: #82bab8;
		font-family: 'RobotoCondensed', Arial, sans-serif;
		margin: 0 0 0 10px;
		text-transform: uppercase;
	}
	#utility a.btn-uty:active,
	#utility a.btn-uty:hover,
	#utility a.selected{
		background: #82bab8;
		color: #fff;
	}
	#utility a.btn-signin,
	#utility a.btn-signin:hover{
		background-image: url(images/icon-arrow-down.png);
		background-repeat: no-repeat;
		background-position: 54px 8px;
		padding-right: 33px;
	}
	
/* ========
	Sign In Box
======================= */
.sign-box{
	background: #f6f6f6;
	box-shadow: -1px 3px 7px rgba(0,0,0,0.2);
	display: none;
	margin: 5px 0 0;
	padding: 10px;
	position: absolute;
	right: 15px;
	width: 250px;
	z-index: 33;
}
.sign-box label{
	display: inline;
	font-size: 0.75em;
}
#utility .sign-box a.lpw{
	display: inline;
}
.placeholder { color: #aaa; }

/* ========
	Hero
======================= */
#hero{
	background: #9aabac url(images/bg-hero.png) repeat-x scroll center 105px;
	-webkit-box-shadow: inset 0 -6px 32px -9px rgba(0, 0, 0, .2);
	box-shadow: inset 0 -6px 32px -9px rgba(0, 0, 0, .2);
}
#hero h2{
    color: #a45627;
    text-transform: uppercase;
}
#hero h2 small{
    color: #a45627;
    display: block;
    font-size: 14px;
    margin: 4px;
}
#hero p{
    padding: 0 7px;
}
#hero ul{
	display: none;
}

/* ========
	Mini Slider
======================= */
.mini-slider{
    margin: 0 0 25px;
	position: relative;
}
.mini-slider .orbit-container .orbit-next{
	background: #a45627;
	height: 100%;
	right: 56.56845121%;
	top: 28px;
	width: 36px;
}
.mini-slider .orbit-container .orbit-prev,
.mini-slider .orbit-container .orbit-timer{
	display: none;
}
.mini-slider p{
	font-size: .75em /*12px*/;
}
.mini-col-1,
.mini-col-2{
	min-height: 290px;
	padding: 30px 25px;
}
.mini-col-1{
	background: #1e2f39;
}
.mini-col-1 p{
	color: #fff;
}
.mini-col-2{
	background: #fff;
}

/* ========
	Home Blog Styles
======================= */
.news-small{
	margin: 36px 0 0;
}
.news-small h4{
    margin: 0;
}
.news-small p{
    font-size: .875em /*14px*/;
}
.blog-post-alt{
	border-top: 1px solid #f9f9f9;
	margin: 5px 0 10px;
	overflow: hidden;
	padding: 15px 0 10px;
}
.blog-post-alt > a:link{
	color: #52a5a5;
	float: right;
	font-family: Helvetica, Arial, sans-serif;
	font-size: .875em /*14px*/;
	line-height: 16px;
	width: 75%;
}
.post-date-alt{
	float: left;
	font-family: 'RobotoCondensed', Arial, sans-serif;
	text-align: center;
	width: 15%;
}
.post-date-alt .date-month{
	display: block;
	font-size: 16px;
	margin-bottom: 4px;
}
.post-date-alt .date-day{
	font-size: 26px;
}

/* ========
	Home Newsletter
======================= */
.signup{
    border-bottom: 1px solid #eee;
    border-top: 1px solid #eee;
    margin: 1em 0;
    overflow: hidden;
    padding: 1em 0;
}
.signup h6{
    float: left;
    margin: 0;
    padding: 10px 0 0; 
}
.offers{
    float: right;
    margin: 0;
    width: 565px;
}
.offers .item,
.offers .item-last{
    float: left;
    margin: 0 15px 0 0;
    width: 209px;
}
.offers .item-last{
    margin: 0;
    width: auto;
}
.offers input[type="text"],
.offers input[type="email"]{
    height: 37px;
    margin: 0;
    width: 100%;
}

/* ========
	aside 
======================= */
aside{
    position: relative;
    z-index: 3;
}
aside ul{
    background: #14212a;
    margin: 0;
    padding: 20px;
}
aside li{
    border-bottom: 1px solid #30474e;
    margin: 0;
    padding: 0;
}
aside li:last-child{
    border-bottom: none;
}
aside li.a-title{
    background: #a45627;
    border: none;
	list-style: none;
    margin: 0 -37px 20px 0;
}
	aside li.a-title.selected a:link,
	aside li.a-title.selected a:visited{
		color: #fff;
	}
    aside li a:link,
    aside li a:visited{
        color: #fff;
        display: block;
        font-size: 0.9375em /*15px*/;
        padding: 10px 0 10px 15px;
        text-transform: uppercase;
    }
    aside li a:active,
    aside li a:hover,
	aside li.selected a{
        color: #82bab8;
    }

/* ========
	Console Form
======================= */
.console{
    background: #82bab8;
    overflow: hidden;
    padding: 25px;
}
.console h3{
	color: #fff;
}
.console h3 span{
	color: #a45627;
	display: block;
	margin: 5px 0 0;
}
.console p{
	color: #fff;
	font-size: .875em;
}

/* ========
	Staff List 
======================= */
.staff-list{
	background: #f5f6f7;
	margin: 10px 0;
	text-align: center;
}
.staff-img{
	background: #d3d3d3;
	margin: 0 0 15px;
}
.staff-img img{
	border: 3px solid #e4eded;
	border-radius: 50%;
	margin: 15px 0;
}
.staff-list p{
	color: #666;
	font-family: Georgia, serif;
	font-size: .875em;
	font-style: italic;
	padding: 10px 25px 0;
}
.staff-title{
	color: #82bab8;
	font-family: 'RobotoCondensed', Arial, sans-serif;
	font-size: .875em;
	text-transform: uppercase;
}

/* ========
	Gallery
======================= */
.thumb-list {
	margin: 0 0 25px;
}

/* ========
	Blog
======================= */
.blog-post h2.post-title {
	border-bottom: 1px solid #ccc;
	font-size: 2em;
	margin: 0 0 10px;
	padding: 0 0 3px;
}

.blog-post .post-details {
	color: #888;
	font-size: 11px;
	margin: 0 0 18px;
}
.BlogRecentPost ul, .BlogTagList ul, .BlogPostArchive ul {
	margin: 0;
	padding: 0;
}
.BlogRecentPost li, .BlogTagList li, .BlogPostArchive li {
	font-size: 0.875em;
	list-style: none;
	margin: 0 0 9px;
}
.post-body{
	font-size: 81%;
}
.links {
	font-size: 11px;
	margin: 0 0 20px;
}
.links a{
	display: block;
	margin: 0 0 10px;	
}

/* ========
	Blog Comments
======================= */
.blog-comments{
	margin: 0;
	overflow: hidden;
	padding: 0;
}
.comments{
	list-style:  none;
}
.comment{
	margin: 5px 0;
	overflow: hidden;
}
.comment ul {
	font-size: 1em;
}
.comment-author{
	overflow: hidden;
}
.author-img{
	border-radius: 50%;
	float: left;
	width: 60px;
}
.author-deets{
	float: left;
	margin: 20px 0 0 10px;
	overflow: hidden;
}
.author,
.comment-date{
	float: left;
}
.author{
	font-size: 1.25em;
}
.comment-date{
	font-size: .825em;
	padding: 2px 0 0 15px;
}
.comment-date a{
	color: #999;
}
.comment-text{
	border: 1px solid #ddd;
	clear: both;
	font-size: 1.1em;
	margin: 10px 0;
	overflow: hidden;
	padding: 10px;
}
.comment-text p{
	font-size: 70%;
	margin: 0;
}
.comment-text .reply{
	font-size: .75em;
	float: right;
}
.comment-form{
	margin: 20px 0;
}
.contactform .item {
	clear: both;
}
.contactform .item:last-child{
	margin: 20px 0 0;
}
.contactform .item-pair label {
	float: left;
	width: 48%;
}
.contactform .item-pair label:last-child {
	float: right;
}

/* ========
	Pricing Table
======================= */
#bvr {
	left: 6px;
	position: absolute;
	top: -8px;
}
#pricing-table{
	background: #fdfdfd;
	border: 1px solid #e7e7e7;
	text-align: center;
	width: 100%;
}
#pricing-table td{
	border-bottom: 1px solid #e7e7e7;
}
#pricing-table td.title-a{
	background: #6c9b9e;
}
#pricing-table td.title-b{
	background: #a45627;
}
#pricing-table td.col-a{
	background: #def8fa;
}
#pricing-table td.col-b{
	background: #ffddc9;
	width: 42%;
}
#pricing-table h4,
#pricing-table h6{
	color: #fff;
	margin: 10px 0;
}
#pricing-table p{
	margin: 0;
	font-size: 0.875em;
}

/* ========
	Pro ducks
======================= */
.productSmall h5 {
	font-size: 1.3125em;
	font-weight: normal;
	margin: 0;
	min-height: 36px;
	padding: 18px 0 6px;
}
.shop-main .header {
	margin: 0 0 18px;
}
.productList ul{
	margin: 0;
	padding: 0;
}
.productList li.quantity {
	line-height: 30px;
	margin: 0 0 0 30px;
}
li.quantity input[type="text"] {
	display: inline;
	width: 50px;
}
.productSmall li.price {
	font-size: 11px;
}
.productSmall li.price strong {
	font-family: 'RobotoCondensed', Arial, sans-serif;
	font-size: 1.9em;
}
.productSmall .image {
	height: 120px;
	margin: 0 auto 9px;
	overflow: hidden;
	text-align: center;
}
.productList ul li {
	display: inline;
	float: left;
	font-size: 11px;
	margin: 0 0 6px;
}
.productSmall input.productSubmitInput {
	clear: both;
	margin: 20px 0;
}

.productLarge .price {
	font-size: 1.25em;
}
.productList.productLarge ul {
	margin: 0;
	padding: 0;
}
.productList.productLarge ul li {
	display: block;
	float: none;
	margin: 0 0 6px;
}

/* ========
	Footer List Blocks
======================= */
.list-blocks li{
    color: #7b7b7b;
    font-size: 0.625em /*10px*/;
    list-style: none;
    padding: 3px 0
}
.list-blocks .list-title{
    color: #818181;
    font-size: 12px;
    font-weight: bold;    
}
    .list-blocks li a:link,
    .list-blocks li a:visited{
        color: #7b7b7b;
        display: block;
    
		-webkit-transition: all 0.25s ease;
		-moz-transition: all 0.25s ease;
		-o-transition: all 0.25s ease;
		-ms-transition: all 0.25s ease;
		transition: all 0.25s ease;
    }
    .list-blocks li a:active,
    .list-blocks li a:hover{
        color: #4a4a4a;
    }

/* ========
	Footer
======================= */
.foot-copy{
    margin: 20px 0 0;
    line-height: 19px;
}
footer{
    border-top: 1px solid #e3e3e3;
    margin: 20px 0;
    overflow: hidden;
    padding: 10px 0;
}
footer ul{
    margin: 0;
    overflow: hidden;
    padding: 0;
}
footer ul li{
    color: #bababa;
    display: inline-block;
    float: left;
    font-size: 11px;
    margin: 0;
    padding: 0 10px 0 0;
}
footer ul li:last-child{
    padding: 0;
}
    footer ul li a:link,
    footer ul li a:visited{
        color: #bababa;
    }
    footer ul li a:active,
    footer ul li a:hover{
        color: #808080;
    }
.social-links{
    float: right;
}
    .social-links li:first-child,
    .social-links li a:link,
    .social-links li a:visited{
        color: #14212a;
        font-size: 12px;
        font-weight: bold;
    }
    .social-links li a:link,
    .social-links li a:visited{
        color: #6c9b9e;
    }
    .social-links li a:active,
    .social-links li a:hover{
        color: #4b7876;
    }

/* ========
	Events
======================= */

table.module-calendar {
	margin-bottom: 20px;
}

table.module-calendar td ul {
	padding: 5px;
}

table.module-calendar td ul li {
	padding: 0 5px 5px;
}

table.module-calendar td ul li:after {
	width:0;
	height:0;
}

/* ===== Forums ========================= */

/* ===== Photo Gallery ================== */

/* ===== News =========================== */

/* ===== FAQs =========================== */

/* ===== Facebook Comments ==================== */
.fb_iframe_widget, .fb_iframe_widget iframe, .fb_iframe_widget span {
	width: 100% !important;
}

/* ===== Checkout Form ==================== */

.form-row {
    border-bottom: 1px solid #EDEDED;
    overflow: hidden;
    padding: 15px 0;
}

legend {
	font-weight: bold;
}

.info-section {
	width:30%;
	float: left;
}

.info-section p {
	padding-right: 15px;
}

.form-section {
	width: 70%;
	float: left;
}

label.left {
	float: left;
	line-height: 35px;
	margin-right: 5px;
}

.shop-checkout.shop-form label {
	display: block;
}

.form-detail {
    float: left;
    width: 250px;
}
.form-detail legend{
	font-family: 'Open Sans', sans-serif;
	font-size: 1.4em;
	font-weight: 400;
}
.form-detail p{
	font-size: 12px;
}
.form-data {
    float: right;
    width: 450px;
}
#payment-form .form-detail {
    width: 255px;
}
#payment-form .form-data {
    width: 570px;
}
#payment-form label {
    width: auto;
}
#payment-form input.cat_textbox, #payment-form input.cat_listbox {
    margin-right: 20px;
    width: 92%;
}

#payment-form input.cat_textbox {
	border: 1px solid #999;
	padding: 3px;
}

#payment-form select.cat_dropdown {
    margin-right: 20px;
    width: 258px;
}

select.short,  {
    width: 117px !important;
    float:left;
}

input.cat_textbox.sm {
	width:70px !important;
}

#payment-form input.short, #payment-form input.short, #payment-form select.short {
    width: 110px;
}

#payment-form input.purchase-amount {
    background: none repeat scroll 0 0 transparent;
    border: medium none;
    color: #222222;
    display: inline;
    float: left;
    font-size: 13px;
    font-weight: bold;
    margin: 0;
    padding: 0;
    width: 53px;
}
#purchase-total {
    background: none repeat scroll 0 0 #FAFAFA;
    border-bottom: 1px solid #EDEDED;
    border-top: 1px solid #EDEDED;
    margin-bottom: 20px;
    padding: 10px;
}

.purchase-amount {
	float: none !important;
	box-shadow: none !important;
}

#purchase-total span {
	font-weight: bold;
	font-size: 16px;
	color: #999;
	padding-left: 10px;
}

/* ===== Start Media Queries ======================= */
@media screen and (max-width:956px){
	header {
		background-color: #fff;
		background-image: none;
	}
	#logo{
		position: relative;
		z-index: 33;
	}
}
@media screen and (max-width:874px){
	#logo{
		width: 277px; }
}
@media screen and (max-width:780px){
	
	#calendar-container, .topics, .posts, .lastpost, .views, .date {
		display: none;
	}
	#cart-footer .span3, #cart-footer .span3.lastSpan {
		width:100% !important;
	}
	#shippingSpan {
		display: block;
		clear: both;
	}
	.half {
		width:100% !important;
		float: none !important;
	}

}
@media screen and (max-width:765px){
	.social-links{
		float: none;
		margin: 10px 0; }
}
@media screen and (max-width:690px){
	#utility{
		margin: 12px 0 0; }
	#logo{
		margin: 5px 0 25px; }
}
@media screen and (max-width:1000px){
	#hero .orbit-container .orbit-prev,
	#hero .orbit-container .orbit-next{
		display: none; }
	.orbit-container .orbit-slides-container img{
		width: 100%;
		margin: 0 auto; }
	.orbit-container .orbit-timer {
		position: absolute;
		bottom: 19px;
		right: 10px;
		height: 6px;
		width: 100px; }
}
@media screen and (max-width:966px){
	.signup h6{
		float: none;
	}
	.offers{
		float: none;
		margin: 10px 0 0;
		width: 100%;
		overflow: hidden;
	}
}
@media screen and (max-width:768px){
	.orbit-container .orbit-slides-container > * .orbit-caption{
		clear: both;
		height: auto;
		position: relative;
		top: auto;
		width: 100%; }
	.blog-post-alt > a:link{
		width: 85%; }
	.main-body, .body{
		padding: 45px 20px 40px; }
	aside li.a-title{
		margin: 0 0 20px;
	}
	.mini-slider .orbit-container .orbit-next{
		display: none;
	}
}
@media screen and (max-width:592px){	
	.offers .item, .offers .item-last {
		float: none;
		margin: 0 0 15px;
		width: 97%; }
}
@media screen and (max-width:418px){
	#utility a:link,
	#utility a:visited{
		display: none; }
}

/* ========
	@Font Face
======================= */
@font-face {
    font-family: 'RobotoCondensed';
    src: url('fonts/Roboto-Condensed-webfont.eot');
    src: url('fonts/Roboto-Condensed-webfont.eot?#iefix') format('embedded-opentype'),
         url('fonts/Roboto-Condensed-webfont.woff') format('woff'),
         url('fonts/Roboto-Condensed-webfont.ttf') format('truetype'),
         url('fonts/Roboto-Condensed-webfont.svg#RobotoCondensed') format('svg');
    font-weight: normal;
    font-style: normal;

}


  </style>
</head>
<body>
<div class="row" style="background-color:#f2f2f2">
    <div class="" style="max-width:500px; margin:40px auto; background-color:#fff">
    <a href="<?php echo "$web_url" ?>" title="<?php echo $mail_from; ?>"><img src="<?php echo $logo ?>" alt="<?php echo $company_name; ?>" /></a>
        
       
         <p><?php echo "<h4>".$text_greeting."</h4>"; ?></p>
         <p><?php echo "<h5>".$text_message."</h5>"; ?></p>
         <p><?php echo "".$message.""; ?></p>
         <p><?php echo "<h4>".$text_footer."</h4>"; ?></p>
        
        
        
        
       
       
    </div>
</div>

<script>
  document.write('<script src=' +
  ('__proto__' in {} ? '<?php echo DIR_FOLDERS_HTTP ?>js/vendor/zepto' : 'js/vendor/jquery') +
  '.js><\/script>')
  </script>
  
  <script src="http://charteredmarketersauction.com.ng/js/foundation.min.js"></script>
  
  
  <script src="http://charteredmarketersauction.com.ng/js/foundation.js"></script>
  
  <script src="<?php echo DIR_FOLDERS_HTTP ?>js/foundation/foundation.interchange.js"></script>
  
  
  
  
  <script>
    $(document).foundation();
  </script>
</body>
</html>