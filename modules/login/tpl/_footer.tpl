	</div>
	<div class="footer">
		{include file="$copyrightPath"}
	</div>
</div>
<div class="ui-panel-msg"></div>

{if $documentData.jscode == 'login' || $documentData.jscode == 'searchID' || $documentData.jscode == 'searchPassword'}
<script type="text/javascript">
	var loginObj = loginObj || {};
	loginObj.memberList = {$documentData.group};
</script>
<script type="x-jquery-templete" id="ljsMember_tmpl">
	<option>{literal}${name}{/literal}</option>
</script>
{/if}

<script src="../../common/js/jquery.min.js"></script>
<script src="../../common/js/jquery.tmpl.min.js"></script>
<script src="../../common/js/jsux.min.js"></script>
<!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="../../common/js/selectivizr-min.js"></script>
<![endif]-->
<script type="text/javascript" src="tpl/js/login.js"></script>
{if $documentData.jscode != ''}
<script type="text/javascript">
	jsux.fn['{$requestData.jscode}'].init();
</script>
{/if}
</body>
</html>