<script src="../../common/js/jquery.min.js"></script>
<script src="../../common/js/jsux.min.js"></script>
<script src="tpl/js/install.js"></script>

{if $requestData.action != ''}
<script type="text/javascript">
	jsux.fn['{$requestData.action}'].init();
</script>
{/if}
</body>
</html>