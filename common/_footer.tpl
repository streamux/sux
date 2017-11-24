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

<!-- mobile gnb start -->
<div class="sx-bgcover sx-bgcover-off"></div>
<nav class="nav mobile-gnb-case mobile-gnb-case-off">
  <button class="menu-btn-close sx-btn-close" title="메뉴 닫기" alt="메뉴 닫기">
    <ul class="sx-h-3stick">
      <li class="sx-hline1"></li>
      <li class="sx-hline2"></li>
      <li class="sx-hline3"></li>
    </ul>
  </button>
  <div class="header-panel">
    <div class="sx-user-info">
      <ul class="clearfix">
        <li><div class="sx-user-picture"></div></li>
        <li class="sx-user-nickname">
          <span>
          {if isset($sessionData.user_name) && $sessionData.user_name}
            {$sessionData.user_name}
          {else}
            Guest
          {/if}
          </span>
        </li>
        <li class="sx-user-modify">        
          <a href="{$rootPath}admin-admin" target="_blank"><img src="{$rootPath}common/images/icon_gear_white.svg" onerror='this.src="{$rootPath}common/images/icon_gear_white.png"' alt="관리자 설정" /></a>
        </li>
      </ul>
    </div>
    <div class="sx-user-member">
      <ul class="clearfix">
      {if isset($sessionData.user_name) && $sessionData.user_name}
        <li><a href="{$rootPath}logout?_method=insert" class="sx-btn">로그아웃</a></li>
        <li><a href="{$rootPath}member-modify" class="sx-btn">회원정보수정</a></li>
      {else}
        <li><a href="{$rootPath}login" class="sx-btn">로그인</a></li>
        <li><a href="{$rootPath}member-join" class="sx-btn">회원가입</a></li>
      {/if}
      </ul>
    </div>
  </div>
  <div class="sx-body-panel">
    <div class="swiper-container swiper-container-mobilegnb">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <ul id="mobileGnb" class="sx-menu-panel">
            <!-- display first's depth menu list -->
          </ul>
        </div>    
      </div>
      <div class="swiper-scrollbar swiper-scrollbar-mobilegnb"></div>
    </div>
  </div>  
</nav>
<!-- mobile gnb end //-->

<!-- Analytics start -->
<img src="{$rootPath}analytics/counter" alt="" class="hide">
<!-- Analytics end //-->

<!-- template start -->
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
<!-- js template end //-->

<!-- api start -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/jquery.min.js"><\/script>')</script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script>window.jQuery.tmpl || document.write('<script src="{$rootPath}common/js/jquery.tmpl.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script>window.TweenMax || document.write('<script src="{$rootPath}common/js/TweenMax.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"></script>
<script>window.Swiper || document.write('<script src="{$rootPath}common/js/idangerous.swiper.min.js"><\/script>')</script>
<!-- api end //-->

<!-- customize start -->
<script type="text/javascript" src="{$rootPath}common/js/jsux.min.js"></script>
<script>  jsux.rootPath = {$rootPath};</script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_common.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_app.min.js"></script>
<script type="text/javascript" src="{$rootPath}common/js/jsux_app_stage.min.js"></script>
{if $documentData.module_code}
<script type="text/javascript" src="{$skinPath}{$documentData.module_code}.js"></script>
<script type="text/javascript" src="{$skinPath}ckeditor/ckeditor.js"></script>
{/if}
{if $documentData.jscode }
<script type="text/javascript"> 
  jsux.fn['{$documentData.jscode}'].init();
</script>
{/if}

<script type="text/javascript" src="{$rootPath}common/js/app/jsux_search_form.js"></script>
<!-- customize end //-->
</body>
</html>