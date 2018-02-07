  </div><!-- end of container -->
  
  <footer id="sxfooter" class="footer">
    {include file="$copyrightPath"}
  </footer>  
</div>

<img src="{$rootPath}analytics/counter" alt="" class="hide">

<!-- template start -->
<script type="text/x-jquery-templete" id="gnbMenuItem">
  <li class="sx-menu" data-id="-1" data-depth="0">
    <a href="" target=""></a>
    <div class="sub_mask">
        <ul></ul>
      </div>
  </li>
</script>
<!-- template end -->

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/api/jquery.min.js"><\/script>')</script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script>window.jQuery.tmpl || document.write('<script src="{$rootPath}common/js/api/jquery.tmpl.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script>window.TweenMax || document.write('<script src="{$rootPath}common/js/api/TweenMax.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"></script>
<script>window.Swiper || document.write('<script src="{$rootPath}common/js/api/idangerous.swiper.min.js"><\/script>')</script>

<script src="{$rootPath}common/js/jsux.min.js?20180202"></script>
<script>jsux.rootPath = "{$rootPath}";</script>
<script>jsux.cookieVersion = "{$cookieVersion}";</script>
<script src="{$rootPath}common/js/jsux_common.min.js?20180202"></script>
<script src="{$rootPath}common/js/jsux_app.min.js?20180202"></script>
<script src="{$rootPath}common/js/jsux_app_stage.min.js?20180202"></script>
<script src="{$rootPath}common/js/app/jsux_search_form.js?20180202"></script>

{if $documentData.module_code && $documentData.jscode}
<script src="{$skinPath}{$documentData.module_code}.js?{$cookieVersion}"></script>
<script type="text/javascript">jsux.fn['{$documentData.jscode}'].init();</script>
{/if}
</body>
</html>