
<div class="footer">
	{include file="$copyrightPath"}
</div>
<script type="text/javascript" src="../../common/js/jquery.min.js"></script>	
<script type="text/javascript" src="../../common/js/jquery.tmpl.min.js"></script>	
<script type="text/javascript" src="../../common/js/TweenMax.min.js"></script>
<script type="text/javascript" src="../../common/js/idangerous.swiper.min.js"></script>
<script type="text/javascript" src="../../common/js/jsux.min.js"></script>
<script type="text/javascript" src="../../common/js/common.js"></script>
<!--[if (gte IE 6)&(lte IE 8)]>
	<script type="text/javascript" src="tpl/js/selectivizr-min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/main_ie8.css">
<![endif]-->
<script type="text/javascript" src="../../common/js/admin_gnb.min.js"></script>
<script type="text/javascript" src="../../common/js/navi.min.js"></script>
<script type="text/javascript" src="../admin/tpl/js/admin_gnb_stage.js"></script>
<script type="text/javascript" src="../{$requestData.pagetype}/tpl/js/{$requestData.pagetype}_admin.js"></script>
{if $requestData.jscode != ''}
<script type="text/javascript">
	jsux.fn['{$requestData.jscode}'].init();
</script>
{/if}
</body>
</html>
