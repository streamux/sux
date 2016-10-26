	</div>
	<div class="footer">
		{include file="$copyrightPath"}
	</div>
</div>
{if $documentData.jscode == 'join'}
<script type="jquery-templete" id="tableList_tmpl">
{literal}
	<option>${name}</option>
{/literal}
</script>
{/if}

<script src="../../common/js/jquery.min.js"></script>
<script src="../../common/js/jquery.tmpl.min.js"></script>
<script src="../../common/js/jsux.min.js"></script>
<!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="../../common/js/selectivizr-min.js"></script>
<![endif]-->
<script type="text/javascript" src="tpl/js/member.js"></script>
{if $documentData.jscode != ''}
<script type="text/javascript">
	jsux.fn['{$requestData.action}'].init();
</script>
{/if}
</body>
</html>
