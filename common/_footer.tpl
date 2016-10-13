	</div>
	<div class="footer">
		{include file="$copyrightPath"}
	</div>
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
		
	</div>
</div>
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