    <footer>
      <div class="sx-footer">
        <span>{include file="$copyrightPath"}</span>
      </div>    
  </footer>
  </div>  
</div>

<script type="text/javascript">
  var is_page = 'admin_main';
</script>

<!-- js template start -->
<script type="sux-templete" id="gnbFirstMenu">
  <ul class="sx-mmenu">
    <li data-mid="" data-sid="">
      <a href="#none"><span></span></a>
      <div class="sx-gnb-sub">
        <ul class="panel" style="" data-startPosY=""></ul>
      </div>
    </li>
  </ul>
</script>
<script type="sux-templete" id="gnbSecondMenu">
  <li class="sx-smenu" data-mid="" data-sid="">
    <a href="#none"><span></span></a>
  </li>
</script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/jquery.min.js"><\/script>')</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/jquery-ui.min.js"><\/script>')</script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script>window.jQuery.tmpl || document.write('<script src="{$rootPath}common/js/jquery.tmpl.min.js"><\/script>')</script>
<script type="text/javascript" src="{$rootPath}common/js/jsux.min.js"></script>
<script>  jsux.rootPath = {$rootPath};</script>
<script src="{$rootPath}common/js/jsux_common.min.js"></script>
<script src="{$rootPath}common/js/jsux_admin_app.min.js"></script>
{if $documentData.jscode != ''}
<script type="text/javascript" src="{$rootPath}modules/{$documentData.module_code}/tpl/{$documentData.module_code}_admin.js"></script>
<script type="text/javascript">
  jsux.fn['{$documentData.jscode}'].init();
</script>
{/if}
</body>
</html>
