
<div class="footer">
	<p>
		<span>
			{include file="$copyrightPath"}
		</span>
	</p>
</div>
<script type="text/javascript">
	var is_page = 'admin_main';
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
<script type="text/javascript" src="../../common/js/jsux_admin_app.min.js"></script>
<script type="text/javascript" src="../../common/js/jsux_admin_app_stage.min.js"></script>

{if $documentData.jscode != ''}
<script type="text/javascript" src="../{$documentData.module_code}/tpl/js/{$documentData.module_code}_admin.js"></script>
<script type="text/javascript">
	jsux.fn['{$documentData.jscode}'].init();
</script>
{/if}
</body>
</html>
