<!DOCTYPE html>
<html lang="ko">
<head>
	<title>SUX관리자 메인화면</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="common/css/sux_default.min.css">
	<link rel="stylesheet" type="text/css" href="common/css/sux_common.min.css">
	<link rel="stylesheet" type="text/css" href="common/css/sux_layout.min.css">
	<link rel="stylesheet" type="text/css" href="common/css/sux_mobile_gnb.css">
	<link rel="stylesheet" type="text/css" href="common/css/swiper.min.css">	
</head>
<body>
<div class="wrapper">
	<div class="header">		
		<div class="util"></div>
		<h1 class="logo">
			<a href="index.php"><img class="logoimg" src="common/images/sux_logo.png" alt="streamxux" width="60px" height="30px"></a>
		</h1>		
		<div class="mobile-menu">
			<div class="mobile-btn">
				<div class="btn-hline1"></div>
				<div class="btn-hline2"></div>
				<div class="btn-hline2"></div>
			</div>
		</div>
		<div class="gnb-case">
			<div id="gnb" class="gnb"></div>
		</div>
	</div>
	<div class="visual-device">		
		<div class="swiper-container">
			<div class="swiper-wrapper">				
				<div class="swiper-slide color-gray-e3">
					<img data-src="../images/slider_img.jpg" style="height:100%" class="swiper-lazy">
					<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
				</div>
				<div class="swiper-slide color-gray-e3">
					<img data-src="../images/slider_img2.jpg" style="height:100%" class="swiper-lazy">
					<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
				</div>
				<div class="swiper-slide color-gray-e3">
					<img data-src="../images/slider_img3.jpg" style="height:100%" class="swiper-lazy">
					<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
				</div>
				<div class="swiper-slide color-gray-e3">
					<img data-src="../images/slider_img4.jpg" style="height:100%" class="swiper-lazy">
					<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
				</div>
			</div>
			<div class="swiper-pagination"></div>
		</div>		
	</div>
	<div class="container">
		
	</div>
</div>
<div class="footer">
	Copyright @ STREAMUX Corp
</div>
<div class="ui-bg-cover"></div>
<div class="mobile-gnb-case">
	<div class="header-panel">
		<div class="ui-user-info">
			<ul class="clearfix">
				<li><div class="ui-user-picture"></div></li>
				<li><span class="ui-user-nickname">Guest</span></li>
				<li><div class="ui-user-modify"></div></li>
			</ul>
		</div>
		<div class="ui-user-member clearfix">
			<ul class="clearfix">
				<li><div class="ui-link-login">로그인</div></li>
				<li><div class="ui-link-join">회원가입</div></li>
			</ul>
		</div>		
	</div>
	<div id="mobileGnb" class="body-panel">
		<div class="menu-panel">
			<ul>
				<!-- display first's depth menu list -->
			</ul>
		</div>
	</div>
</div>
<!-- template start -->
<script type="sux-templete" id="suxMobileGnbFirstMenu">
	<li data-code=""><a href="#"><span></span></a></li>
</script>
<script type="sux-templete" id="suxMobileGnbSecondMenuCase">
	<div class="second-menu">
		<ul>
			/*display second's depth menu list*/
		</ul>
	</div>
</script>
<script type="sux-templete" id="suxMobileGnbSecondMenu">
	<li data-code="" data-sub-code=""><a href="#"><span></span></a></li>
</script>
<!-- end -->
<script type="text/javascript">
	var is_page = 'main';
</script>
<script type="text/javascript" src="common/js/jquery.min.js"></script>	
<script type="text/javascript" src="common/js/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="common/js/TweenMax.min.js"></script>
<script type="text/javascript" src="common/js/idangerous.swiper.min.js"></script>
<!--[if (gte IE 6)&(lte IE 8)]>
	<script type="text/javascript" src="tpl/js/selectivizr-min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/main_ie8.css">
<![endif]-->
<script type="text/javascript" src="common/js/jsux.min.js"></script>
<script type="text/javascript" src="common/js/jsux_app.min.js"></script>
<script type="text/javascript" src="common/js/app/jsux_mobile_gnb.js"></script>
<script type="text/javascript" src="common/js/jsux_app_stage.min.js"></script>
</body>
</html>

