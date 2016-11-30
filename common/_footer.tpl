		<div class="footer">
			<ul class="clearfix">
				<li><a href="{$rootPath}login/login.php?action=login">로그인</a></li>
				<li><a href="{$rootPath}member/member.php?action=join">회원가입</a></li>
				<li><a href="#" onclick="jsux.mobileGnbView.showSitemap();">사이트 맵</a></li>
			</ul>	
			<p>
				<span>{include file="$copyrightPath"}</span>
			</p>
		</div>
	</div>	
</div>

<!-- mobile menu start -->
<div class="ui-bg-cover ui-bg-cover-off"></div>
<div class="mobile-gnb-case mobile-gnb-case-off">
	<div class="menu-btn-close">
		<div class="ui-h-3stick">
			<div class="hline1"></div>
			<div class="hline2"></div>
			<div class="hline3"></div>
		</div>
	</div>
	<div class="header-panel">
		<div class="ui-user-info">
			<ul class="clearfix">
				<li><div class="ui-user-picture"></div></li>
				<li><span class="ui-user-nickname">Guest</span></li>
				<li><a href="/sux/admin" target="_blank"><img src="{$rootPath}common/images/icon_gear_white.svg" onerror='this.src="{$rootPath}common/images/icon_gear_white.png"' class="ui-user-modify" alt="관리자 설정" /></a></li>
			</ul>
		</div>
		<div class="ui-user-member">
			<ul class="clearfix">
				<li>
					<div class="ui-link-login"><a href="../modules/login/login.php?action=login">로그인</a></div>
				</li>
				<li>
					<div class="ui-link-join"><a href="../modules/member/member.php?action=join">회원가입</a></div>
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

<!-- js template start -->
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
{if $documentData.group}
<script type="text/javascript">
	var loginObj = loginObj || {};
	loginObj.memberList = {$documentData.group};
</script>
<script type="x-jquery-templete" id="memberGroupTmpl">
	<option>{literal}${name}{/literal}</option>
</script>
{/if}
<!-- end -->
<script type="text/javascript">
	var is_page = 'sub';
</script>

<!-- js api -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/jquery.min.js"><\/script>')</script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script>window.jQuery.tmpl || document.write('<script src="{$rootPath}common/js/jquery.tmpl.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script>window.TweenMax || document.write('<script src="{$rootPath}common/js/TweenMax.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"></script>
<script>window.Swiper || document.write('<script src="{$rootPath}common/js/idangerous.swiper.min.js"><\/script>')</script>
<!-- end -->
<!-- js customize start -->
<script type="text/javascript" src="{$rootPath}common/js/jsux.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_common.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_app.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_app_stage.min.js"></script>
{if $documentData.module_code != ''}
<script>	jsux.rootPath = {$rootPath};</script>
<script type="text/javascript" src="{$skinPathList.dir}/js/{$documentData.module_code}.js"></script>
{/if}
{if $documentData.jscode != ''}
<script type="text/javascript">
	jsux.fn['{$documentData.jscode}'].init();
</script>
{/if}
<!-- end -->
</body>
</html>