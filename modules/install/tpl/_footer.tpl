  </div>
  <div class="sx-footer">
    {include file="$copyrightPath"}
  </div>
</div>
<div class="ui-panel-msg"></div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/api/jquery.min.js"><\/script>')</script>
<script src="{$rootPath}common/js/jsux.min.js"></script>
<script type="text/javascript">
  jsux.rootPath = '{$rootPath}';
</script>
{if $requestData.action != ''}
<script src="{$rootPath}modules/install/tpl/install.min.js"></script>
<script type="text/javascript">
  jsux.fn['{$requestData.action}'].init();
</script>
{/if}
</body>
</html>