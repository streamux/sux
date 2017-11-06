  </div>
  <footer class="footer">
    <ul class="copyright clearfix">
    {if isset($sessionData.user_name) && $sessionData.user_name}
      <li><a href="{$rootPath}logout?_method=insert">로그아웃</a></li>
      <li><a href="{$rootPath}member-modify">회원정보수정</a></li>
    {else}
      <li><a href="{$rootPath}login">로그인</a></li>
      <li><a href="{$rootPath}member-join">회원가입</a></li>    
    {/if}
      <li><a href="#" onclick="jsux.mobileGnbView.showSitemap();">사이트 맵</a></li>
    </ul> 
    <p>{include file="$copyrightPath"}</p>
  </footer>
</div>

<img src="{$rootPath}analytics/counter" alt="" class="hide">
<!-- end -->

<!-- js template start -->
<script type="sux-templete" id="gnbFirstMenu">
  <ul class="sx-mmenu">
    <li data-mid="" data-sid="">
      <a href="#none" title=""></a>
      <div class="sx-gnb-sub">
        <ul class="panel" style="" data-startPosY=""></ul>
      </div>
    </li>
  </ul>
</script>
<script type="sux-templete" id="gnbSecondMenu">
  <li class="sx-smenu" data-mid="" data-sid="">
    <a href="#none" title=""></a>
  </li>
</script>

<script type="sux-templete" id="suxMobileGnbFirstMenu">
  <li data-code=""><a href="#"></a></li>
</script>
<script type="sux-templete" id="suxMobileGnbSecondMenuCase">
  <div class="sx-second-menu">
    <ul>
      /*display second's depth menu list*/
    </ul>
  </div>
</script>
<script type="sux-templete" id="suxMobileGnbSecondMenu">
  <li data-code="" data-sub-code=""><a href="#"></a></li>
</script>

{if $documentData.group}
<script type="text/javascript">
  var loginObj = loginObj || {};
  loginObj.memberList = {$documentData.group};
</script>
<script type="x-jquery-templete" id="memberGroupTmpl">
  <option>{literal}${name}{/literal}</option>
</script>
{/if}

<!-- js api -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/jquery.min.js"><\/script>')</script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script>window.jQuery.tmpl || document.write('<script src="{$rootPath}common/js/jquery.tmpl.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script>window.TweenMax || document.write('<script src="{$rootPath}common/js/TweenMax.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"></script>
<script>window.Swiper || document.write('<script src="{$rootPath}common/js/idangerous.swiper.min.js"><\/script>')</script>
<!-- end -->
<!-- js customize start -->
<script type="text/javascript" src="{$rootPath}common/js/jsux.min.js"></script>
<script>  jsux.rootPath = {$rootPath};</script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_common.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_app.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_app_stage.min.js"></script>
{if $documentData.module_code}
<script type="text/javascript" src="{$skinPath}{$documentData.module_code}.js"></script>
{/if}
{if $documentData.jscode }
<script type="text/javascript"> 
  jsux.fn['{$documentData.jscode}'].init();
</script>
{/if}

<script type="text/javascript" src="{$rootPath}common/js/app/jsux_search_form.js"></script>
<!-- end -->
</body>
</html>