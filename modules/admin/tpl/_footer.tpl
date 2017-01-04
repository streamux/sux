	</div>
	<div class="footer">
		<p>
			<span>
				{include file="$copyrightPath"}
			</span>
		</p>
	</div>
</div>
<script type="text/javascript">
	var is_page = 'admin_main';
</script>

<!-- js template start -->
<script type="sux-templete" id="gnbFirstMenu">
	<ul class="mmenu">
		<li data-mid="" data-sid="">
			<a href="#none"><span></span></a>
			<div class="sub">
				<ul class="panel" style="" data-startPosY=""></ul>
			</div>
		</li>
	</ul>
</script>
<script type="sux-templete" id="gnbSecondMenu">
	<li class="smenu" data-mid="" data-sid="">
		<a href="#none"><span></span></a>
	</li>
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
<!--[if (gte IE 6)&(lte IE 8)]>
	<script type="text/javascript" src="tpl/js/selectivizr-min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/main_ie8.css">
<![endif]-->
<script type="text/javascript" src="{$rootPath}common/js/jsux.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_common.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_admin_app.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_admin_app_stage.min.js"></script>

{if $documentData.jscode != ''}
<script>	jsux.rootPath = {$rootPath};</script>
<script type="text/javascript" src="{$rootPath}modules/{$documentData.module_code}/tpl/js/{$documentData.module_code}_admin.js"></script>
<script type="text/javascript">
	jsux.fn['{$documentData.jscode}'].init();
</script>
{/if}
</body>
</html>
