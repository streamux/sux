<script type="text/javascript">
  var is_page = 'admin_main';
</script>

<script type="text/jquery-templete" id="gnbFirstMenu">
  <ul class="sx-mmenu">
    <li data-mid="" data-sid="">
      <a href="#none"><span></span></a>
      <div class="sx-gnb-sub">
        <ul class="panel" style="" data-startPosY=""></ul>
      </div>
    </li>
  </ul>
</script>

<script type="text/jquery-templete" id="gnbSecondMenu">
  <li class="sx-smenu" data-mid="" data-sid="">
    <a href="#none"><span></span></a>
  </li>
</script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/api/jquery.min.js"><\/script>')</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/api/jquery-ui.min.js"><\/script>')</script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script>window.jQuery.tmpl || document.write('<script src="{$rootPath}common/js/api/jquery.tmpl.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"></script>
<script>window.Swiper || document.write('<script src="{$rootPath}common/js/api/swiper.min.js"><\/script>')</script>
<script src="{$rootPath}common/plugins/ckeditor/ckeditor.js"></script>

<script src="{$rootPath}common/js/jsux.min.js?20180110"></script>
<script>  jsux.rootPath = "{$rootPath}";</script>
<script src="{$rootPath}common/js/jsux_common.min.js?20180110"></script>
<script src="{$rootPath}common/js/jsux_admin_app.min.js?20180110_2"></script>

{if $documentData.jscode != ''}
<script type="text/javascript" src="{$rootPath}modules/{$documentData.module_code}/tpl/{$documentData.module_code}_admin.js?20180110"></script>

<script type="text/javascript">
  jsux.fn['{$documentData.jscode}'].init();
</script>
{/if}
</body>
</html>
