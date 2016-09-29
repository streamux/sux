
<script src="../../common/js/jquery.min.js"></script>
<script src="../../common/js/jquery.tmpl.min.js"></script>
<script src="../../common/js/jsux-1.0.0.min.js"></script>
<script src="../../common/js/jsux.min.js"></script>
<!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="../../common/js/selectivizr-min.js"></script>
<![endif]-->
<script type="text/javascript" src="tpl/js/member.js"></script>
{if $requestData.action != ''}
<script type="text/javascript">
	jsux.fn['{$requestData.action}'].init();
</script>
{/if}
</body>
</html>
