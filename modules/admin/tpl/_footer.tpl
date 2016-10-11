
<div class="footer">
	{include file="$copyrightPath"}
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
<script type="text/javascript" src="../{$requestData.pagetype}/tpl/js/{$requestData.pagetype}_admin.js"></script>
{if $requestData.jscode != ''}
<script type="text/javascript">
	jsux.fn['{$requestData.jscode}'].init();
</script>
{/if}
</body>
</html>
