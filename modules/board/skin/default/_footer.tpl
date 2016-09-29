<script src="../../common/js/jquery.min.js"></script>
<script src="../../common/js/jsux.min.js"></script>
<script src="{$skinPathList.dir}/js/board.js"></script>
{if $requestData.jscode != ''}
<script type="text/javascript">
	jsux.fn['{$requestData.jscode}'].init();
</script>
{/if}
</body>
</html>