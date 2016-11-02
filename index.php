<!DOCTYPE html>
<html lang="ko">
<head>
	<title>SUX관리자 메인화면</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/xeicon/2/xeicon.min.css">
	<link rel="stylesheet" type="text/css" href="common/css/swiper.min.css">	
	<link rel="stylesheet" type="text/css" href="common/css/sux_default.min.css">
	<link rel="stylesheet" type="text/css" href="common/css/sux_common.min.css">
	<link rel="stylesheet" type="text/css" href="common/css/sux_layout.css">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="wrapper">
	<div class="header clearfix">		
		<div class="util"></div>
		<h1 class="logo">
			<a href="/sux/index.php"><img src="common/images/sux_logo.svg" onerror='this.src="common/images/sux_logo.png"' alt="streamxux"></a>
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
	<div class="section container">
		<div class="swiper-container swiper-container-contents">
			<div class="swiper-wrapper">				
				<div class="swiper-slide swiper-slide-article">
					<div class="header-contents">
						<div class="swiper-container swiper-container-visual">
							<div class="swiper-wrapper">
								<div class="swiper-slide swiper-slide-size">
									<img data-src="../images/slider_img.jpg" class="swiper-lazy">
									<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
								</div>
								<div class="swiper-slide swiper-slide-size">
									<img data-src="../images/slider_img2.jpg" class="swiper-lazy">
									<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
								</div>
								<div class="swiper-slide swiper-slide-size">
									<img data-src="../images/slider_img3.jpg" class="swiper-lazy">
									<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
								</div>
								<div class="swiper-slide swiper-slide-size">
									<img data-src="../images/slider_img4.jpg" class="swiper-lazy">
									<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
								</div>				
							</div>
							<div class="swiper-pagination swiper-pagination-visual"></div>
						</div>
					</div>
					<div class="section contents-body">						
						<div class="article about-us">
							<h1>ABOUT US</h1>
							<p class="title">WELCOME TO STREAMUX</p>
							<p class="comment">StreamUX는 사용자 친화적인 UX에 기반을 둔 설치형 CMS입니다. 간편한 설치와 설정을 통하여 자신만의 웹페이지를 쉽고 빠르게 만들 수 있습니다.</p>		
						</div>
						<div class="article user-guide">
							<h1>USER GUIDE</h1>
							<p class="title">START UP</p>
							<ul>
								<li>
									<a href="modules/member/member.admin.php?action=groupList" title="회원관리 하기">
										<span>
											<i class="xi-pen xi-2x"></i>
										</span>
									</a>
									<h2>회원 관리하기</h2>
									<p>회원 관리설정을 통해 체계적으로 관리해보세요. 회원 관리 메뉴는 <a href="modules/member/member.admin.php?action=groupList">[메뉴 > 관리자 설정 클릭 > 관리자 모드 > 회원 관리]</a>에서 회원그룹을 추가 삭제할 수 있습니다.</p>
								</li>
								<li>
									<a href="modules/board/board.admin.php?action=list" title="게시판 관리하기">
										<i class="xi-home xi-2x"></i>
									</a>
									<h2>게시판 관리하기</h2>
									<p>다양한 게시판를 생성해서 관리해보세요. 게시판 관리 메뉴는 <a href="modules/board/board.admin.php?action=list">[메뉴 > 관리자 설정 클릭 > 관리자 모드 > 게시판 관리]</a>에서 게시판을 생성 후 용도에 맞게 설정할 수 있습니다.</p>
								</li>
								<li>
									<a href="modules/popup/popup.admin.php?action=list" title="팝업 관리하기">
										<i class="xi-sitemap xi-2x"></i>
									</a>
									<h2>팝업 관리하기</h2>
									<p>가장 먼저 알리고 싶은 정보가 있다면 팝업관리를 이용해 보세요. 팝업 관리 메뉴는 <a href="modules/popup/popup.admin.php?action=list">[메뉴 > 관리자 설정 클릭 > 관리자 모드 > 팝업 관리]</a>에서 팝업 추가하기를 한 후 사용할 수 있습니다.</p>
								</li>								
								<li>
									<a href="modules/analytics/analytics.admin.php?action=connecterList" title="통계 관리하기">
										<i class="xi-palette xi-2x"></i>
									</a>
									<h2>통계 관리하기</h2>
									<p>기본적인 통계 관리 기능을 제공합니다. 통계 관리 메뉴는 <a href="modules/analytics/analytics.admin.php?action=connecterList">[메뉴 > 관리자 설정 클릭 > 관리자 모드 > 통계 관리]</a>에서 키워드를 추가한 후 사용 할 수 있습니다.</p>
								</li>
							</ul>	
						</div>						
					</div>					
				</div>		
			</div>
			<div class="swiper-scrollbar swiper-scrollbar-contents"></div>
		</div>	
		<div class="footer">
			<ul class="clearfix">
				<li><a href="modules/login/login.php?action=login">로그인</a></li>
				<li><a href="modules/member/member.php?action=join">회원가입</a></li>
				<li><a href="javascript:jsux.mobileGnbView.show();">사이트 맵</a></li>
			</ul>
			<p>
				<span>
					Copyright @ STREAMUX Corp
				</span>
			</p>		
		</div>
	</div>
</div>
<!-- mobile menu start -->
<div class="ui-bg-cover"></div>
<div class="mobile-gnb-case mobile-gnb-case-off">	
	<div class="header-panel">
		<div class="ui-user-info">
			<ul class="clearfix">
				<li><div class="ui-user-picture"></div></li>
				<li><span class="ui-user-nickname">Guest</span></li>
				<li><a href="/sux/admin" target="_blank"><img src="common/images/icon_gear_white.svg" onerror='this.src="/images/icon_gear_white.png"' class="ui-user-modify" alt="관리자 설정" /></a></li>
			</ul>
		</div>
		<div class="ui-user-member">
			<ul class="clearfix">
				<li>
					<div class="ui-link-login"><a href="modules/login/login.php?action=login">로그인</a></div>
				</li>
				<li>
					<div class="ui-link-join"><a href="modules/member/member.php?action=join">회원가입</a></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="body-panel">
		<div class="swiper-container swiper-container-mobilegnb">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<ul id="mobileGnb" class="menu-panel">
						<!-- display first's depth menu list -->
					</ul>
				</div>		
			</div>
			<div class="swiper-scrollbar swiper-scrollbar-mobilegnb"></div>
		</div>
	</div>	
</div>
<!-- end -->
<!-- template start -->
<script type="sux-templete" id="suxMobileGnbFirstMenu">
	<li data-code=""><a href="#"></a></li>
</script>
<script type="sux-templete" id="suxMobileGnbSecondMenuCase">
	<div class="second-menu">
		<ul>
			/*display second's depth menu list*/
		</ul>
	</div>
</script>
<script type="sux-templete" id="suxMobileGnbSecondMenu">
	<li data-code="" data-sub-code=""><a href="#"></a></li>
</script>
<!-- end -->
<script type="text/javascript">
	var is_page = 'main';
</script>
<!-- api start -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="common/js/jquery.min.js"><\/script>')</script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script>window.jQuery.tmpl || document.write('<script src="common/js/jquery.tmpl.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script>window.TweenMax || document.write('<script src="common/js/TweenMax.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"></script>
<script>window.Swiper || document.write('<script src="common/js/idangerous.swiper.min.js"><\/script>')</script>
<!-- end -->
<!-- customize start -->
<script src="common/js/jsux.min.js"></script>
<script src="common/js/jsux_app.min.js"></script>
<script src="common/js/jsux_app_stage.min.js"></script>
<!-- end -->
</body>
</html>

