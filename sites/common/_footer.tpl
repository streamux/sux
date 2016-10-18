				</div>
			</div>
			<div class="swiper-scrollbar swiper-scrollbar-contents"></div>
		</div>
		<div class="footer">
			{include file="$copyrightPath"}
		</div>
	</div>	
</div>
<!-- mobile menu start -->
<div class="ui-bg-cover ui-bg-cover-off"></div>
<div class="mobile-gnb-case mobile-gnb-case-off">	
	<div class="header-panel">
		<div class="ui-user-info">
			<ul class="clearfix">
				<li><div class="ui-user-picture"></div></li>
				<li><span class="ui-user-nickname">Guest</span></li>
				<li><div class="ui-user-modify"></div></li>
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
					<ul id="mobileGnb"" class="menu-panel">
						<!-- display first's depth menu list -->
					</ul>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 1-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 2-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 3-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 4-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 5-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 6-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 7-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 8-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 9-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 10-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 11-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 12-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 13-------------------</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>aaa</p>
					<p>---------------------footer 14-------------------</p>
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
	var is_page = 'sub';
</script>
<script type="text/javascript" src="../../common/js/jquery.min.js"></script>	
<script type="text/javascript" src="../../common/js/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="../../common/js/TweenMax.min.js"></script>
<script type="text/javascript" src="../../common/js/idangerous.swiper.min.js"></script>
<!--[if (gte IE 6)&(lte IE 8)]>
	<script type="text/javascript" src="tpl/js/selectivizr-min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/main_ie8.css">
<![endif]-->
<script type="text/javascript" src="../../common/js/jsux.min.js"></script>
<script type="text/javascript" src="../../common/js/jsux_common_js.min.js"></script>
<script type="text/javascript" src="../../common/js/jsux_app.min.js"></script>
<script type="text/javascript" src="../../common/js/jsux_app_stage.min.js"></script>
{if $requestData.jscode != ''}
<script type="text/javascript" src="{$skinPathList.dir}/js/board.js"></script>
<script type="text/javascript">
	jsux.fn['{$requestData.jscode}'].init();
</script>
{/if}
</body>
</html>