  </div>
  <div class="footer">
    {include file="$copyrightPath"}
  </div>
</div>
<div class="ui-panel-msg"></div>

<!-- js api -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/jquery.min.js"><\/script>')</script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script>window.jQuery.tmpl || document.write('<script src="{$rootPath}common/js/jquery.tmpl.min.js"><\/script>')</script>
<!-- end -->
<script src="{$rootPath}common/js/jsux.min.js"></script>
{if $documentData.jscode != ''}
<script src="{$rootPath}modules/login/tpl/{$documentData.module_code}_admin.js"></script>
<script>
  jsux.fn['{$documentData.jscode}'].init();
</script>
{/if}
</body>
</html>