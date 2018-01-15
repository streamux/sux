<!DOCTYPE html>
<html lang="ko">
<head>
  <title>{$title}</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux.min.css?20180109">
  <link rel="stylesheet" type="text/css" href="{$rootPath}modules/admin/tpl/admin_layout.css?20180109">
  
  {if $documentData.module_code != ''}
  <link rel="stylesheet" type="text/css" href="{$rootPath}modules/{$documentData.module_code}/tpl/{$documentData.module_code}_admin.css?20180109_2">
  {/if}
<body>
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
    <nav id="sxGnb" class="sx-nav">
      <div></div>
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
                  <li><a href="{$rootPath}member-admin/add">회원 추가</a></li>
                  <li class="divider"></li>
                  <li><a href="{$rootPath}member-admin/group">그룹 목록</a></li>
                  <li><a href="{$rootPath}member-admin/group-add">그룹 추가</a></li>
                </ul>
              </div>
            </li>
            <li>
              <a href="{$rootPath}board-admin"><i class="xi-comment-o xi-fw"></i> 게시판 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}board-admin">게시판 목록</a></li>                  
                  <li><a href="{$rootPath}board-admin/add">게시판 추가</a></li>                  
                </ul>
              </div>
            </li>
            <li>
              <a href="{$rootPath}document-admin"><i class="xi-paper-o xi-fw"></i> 페이지 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}document-admin" >페이지 목록</a></li>
                  <li><a href="{$rootPath}document-admin/add">페이지 추가</a></li>
                  <li class="divider"></li>
                  <li><a href="{$rootPath}popup-admin" >팝업 목록</a></li>
                  <li><a href="{$rootPath}popup-admin/add">팝업 추가</a></li>
                </ul>
              </div>          
            </li>
            <li>
              <a href="{$rootPath}document-admin"><i class="xi-chart-pie-o xi-fw"></i> 통계 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}analytics-admin/pageview" >페이지뷰 목록</a></li>
                  <li><a href="{$rootPath}analytics-admin/pageview-add">페이지뷰 추가</a></li>
                  <li class="divider"></li>
                  <li><a href="{$rootPath}analytics-admin/connect-site" >접속경로 목록</a></li>
                  <li><a href="{$rootPath}analytics-admin/connect-site-add">접속경로 추가</a></li>
                </ul>
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
      <a href="{$rootPath}logout-admin" class="sx-gnb-login" title="로그아웃" alt="로그아웃">
        <i class="xi-user xi-2x"></i>
      </a>
      {/if}
    </nav>
  </header>  

  <!-- Content -->
  <div id="sxContents" class="sx-container">