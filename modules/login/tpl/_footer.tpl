
<script src="../../common/js/jquery.min.js"></script>
<script src="../../common/js/jquery.tmpl.min.js"></script>
<script src="../../common/js/jsux.min.js"></script>
<!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="../../common/js/selectivizr-min.js"></script>
<![endif]-->
<script type="text/javascript" src="tpl/js/login.js"></script>
{if $requestData.jscode != ''}
<script type="text/javascript">
	jsux.fn['{$requestData.jscode}'].init();
</script>
{/if}
</body>
</html>