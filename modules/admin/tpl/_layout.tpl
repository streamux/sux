{include file="$htmlHeader"}

<div class="sx-wrapper">

  <!-- Skip -->
  <p class="sx-skip-menu">
    <a href="#sxGnb">Skip to menu</a>
    <a href="#sxContents">Skip to content</a>
  </p>

  <header class="sx-header">
    <div class="sx-bgcover"></div>
    <div class="sx-header-bar">
      <h1 class="sx-logo">
        <a href="{$rootPath}admin-admin"><img src="{$rootPath}common/images/sux_logo_white.svg" onerror='this.src="{$rootPath}common/images/sux_logo.png"' alt="streamxux"/><span class="sx-logo-title">Admin</span></a>
      </h1>
    </div>

    <!-- GNB -->
    <nav id="sxGnb" class="sx-nav">
      <a href="#" class="sx-menu-btn" title="메뉴 열기">
        <ul class="sx-menu">
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </a>
      <div class="sx-nav-bar">
        <div id="sxGnbCase" class="sx-gnb-case">
          <ul class="sx-gnb lst_group clearfix">
            <li>
              <a href="{$rootPath}menu-admin/list"><i class="xi-bars xi-fw"></i> 메뉴 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu"></ul>
              </div>
            </li>
            <li>
              <a href="{$rootPath}member-admin/list"><i class="xi-group xi-fw"></i> 회원 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}member-admin/list">회원 목록</a></li>
                  <li><a href="{$rootPath}member-admin/group">회원 그룹 목록</a></li>
                </ul>
              </div>
            </li>
            <li>
              <a href="{$rootPath}board-admin"><i class="xi-comment-o xi-fw"></i> 게시글 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}board-admin/list">전체 글 목록</a></li>
                  <li><a href="{$rootPath}board-admin/group">게시글 그룹 목록</a></li>
                </ul>
              </div>
            </li>
            <li>
              <a href="{$rootPath}document-admin"><i class="xi-paper-o xi-fw"></i> 페이지 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu"></ul>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <a href="#" class="sx-close-btn" title="메뉴 닫기">
        <ul class="sx-close">
          <li></li>
          <li></li>
        </ul>
      </a>

      <!--  Login  -->
      {if isset($sessionData.admin_ok) && $sessionData.admin_ok}
      <div id="sxGnbLoginWrap" class="sx-gnb-login-wrap">
        <a href="{$rootPath}member-admin/modify" class="sx-gnb-login" title="회원 정보" alt="회원 정보">
          <i class="xi-user xi-2x"></i>
        </a>
        <div class="sx-login-panel">
          <div class="sx-user-case">
            <div class="sx-user-picture"></div>
          </div>
          <div class="sx-info-case">
            <a href="{$rootPath}member-admin/modify" class="sx-user-info">{$sessionData.user_id|upper}</a>
            <a href="{$rootPath}member-admin/modify" class="sx-user-info">내 정보 수정</a>
            <a href="{$rootPath}logout-admin?_method=insert" class="sx-user-logout">로그 아웃</a>
          </div>
        </div>
      </div>
      {/if}
    </nav>
  </header>

  <!-- Content -->
  <div id="sxContents" class="sx-container">
    {include file="$contentPath"}
  </div>

  <!-- Footer -->
  <footer>
    <div class="sx-footer">
      <span>{include file="$copyrightPath"}</span>
    </div>
  </footer>
</div>

{include file="$htmlFooter"}