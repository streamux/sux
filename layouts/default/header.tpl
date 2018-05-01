    <div class="sx-header-body">        
      <h1 class="sx-logo">
        <a href="{$rootPath}"><img src="{$rootPath}common/images/sux_logo.svg" onerror='this.src="{$rootPath}common/images/sux_logo.png"' title="streamxux" alt="streamxux"></a>
      </h1>

      <div class="mobile-menu-case">      
        <a href="#" class="mobile-menu-btn" title="메뉴 열기" alt="메뉴 열기">        
          <ul class="sx-h-3stick">
            <li class="sx-hline1"></li>
            <li class="sx-hline2"></li>
            <li class="sx-hline3"></li>
          </ul>        
        </a>
        <div class="mobile-menu-bg"></div>
      </div>
    
      <!-- GNB  -->
      <div class="sx-gnb-case">
        <ul id="sxGnb" class="sx-gnb"></ul>
      </div>
    
      <!-- Search form -->
      <button id="btnShowSearchForm" class="sx-btn-search" title="검색" alt="검색">
        <i class="xi-search"></i>
      </button>    
      <div id="gnbSearchForm" class="sx-search-form">
        <form action="{$rootPath}search" name="gnb_form_search">
          <div class="sx-form-inline">
            <label for="searchControlInput" class="sx-control-label">
              <i class="xi-search"></i><span class="sr-only">검색</span>
            </label>
            <input type="text" id="searchControlInput" name="search" class="sx-search-control" placeholder="Search">
            <input type="submit">
          </div>
        </form>
        <button class="search-btn-close sx-btn-close" title="검색창 닫기" alt="검색창 닫기">
          <ul class="sx-h-3stick">
            <li class="sx-hline1"></li>
            <li class="sx-hline2"></li>
            <li class="sx-hline3"></li>
          </ul>
        </button>
      </div>
      
      <!-- Admin setup -->      
      <div class="sx-admin-setup">
      {if $documentData.is_admin_login !== false}
        <a href="{$rootPath}admin-admin" target="_blank"><img src="{$rootPath}common/images/icon_gear.svg" onerror='this.src="{$rootPath}common/images/icon_gear.png"' alt="관리자 설정" /></a>
      {/if}
      </div>      
      
      <!--  Login  -->
      <div id="sxGnbLoginWrap" class="sx-gnb-login-wrap">
      {if $sessionData.user_id || $sessionData.nickname}
        <a href="{$rootPath}login" class="sx-gnb-login" title="회원정보" alt="회원정보">
          <i class="xi-user-o xi-2x"></i>
        </a>
        <div class="sx-login-panel">
          <div class="sx-user-case">
            <div class="sx-user-picture"></div>
          </div>
          <div class="sx-info-case">
            <a href="{$rootPath}member-modify" class="sx-user-info">{$sessionData.user_id|upper}</a>
            <a href="{$rootPath}member-modify" class="sx-user-info">내 정보 수정</a>
            <a href="{$rootPath}logout?_method=insert" class="sx-user-logout">로그 아웃</a>
          </div>
        </div>        
      {else}
        <a href="{$rootPath}login" class="sx-gnb-login" title="로그인" alt="로그인">
          <i class="xi-user xi-2x"></i>
        </a>
      {/if} 
      </div>      
    </div>  