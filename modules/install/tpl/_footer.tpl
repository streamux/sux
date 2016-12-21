<script src="{$rootPath}common/js/jquery.min.js"></script>
<script src="{$rootPath}common/js/jsux.min.js"></script>
{if $requestData.action != ''}
<script>	jsux.rootPath = {$rootPath};</script>
<script src="{$rootPath}modules/install/tpl/js/install.js"></script>
<script type="text/javascript">
	jsux.fn['{$requestData.action}'].init();
</script>
{/if}
</body>
</html>