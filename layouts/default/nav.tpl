    <div class="mobile-gnb-case">      
      <div class="header-panel">
        <div class="sx-user-info">
          <div class="sx-user-picture"></div>
          <span class="sx-user-nickname">
          {if $sessionData.user_id || $sessionData.nickname}
            {$sessionData.nickname}
          {else}
            Guest
          {/if}
          </span>
          <div class="sx-admin-setup">
            {if $documentData.is_admin_login !== false}
              <a href="{$rootPath}admin-admin" target="_blank"><img src="{$rootPath}common/images/icon_gear_white.svg" onerror='this.src="{$rootPath}common/images/icon_gear_white.png"' title="관리자 설정" alt="관리자 설정" /></a>
            {/if}
          </div>      
        </div>
        <div class="sx-user-member">
          <ul class="clearfix">
          {if $sessionData.nickname || $sessionData.user_name}
            <li><a href="{$rootPath}logout?_method=insert" class="sx-btn">로그 아웃</a></li>
            <li><a href="{$rootPath}member-modify" class="sx-btn">내 정보 수정</a></li>
          {else}
            <li><a href="{$rootPath}login" class="sx-btn">로그 인</a></li>
            <li><a href="{$rootPath}member-join" class="sx-btn">회원 가입</a></li>
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

      <button class="menu-btn-close sx-btn-close" title="메뉴 닫기" alt="메뉴 닫기">
        <ul class="sx-h-3stick">
          <li class="sx-hline1"></li>
          <li class="sx-hline2"></li>
          <li class="sx-hline3"></li>
        </ul>
      </button>
    </div>   
    <div class="sx-bgcover"></div>