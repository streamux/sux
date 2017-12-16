<!DOCTYPE html>
<html lang="ko">
<head>
  <title>{$title}</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/xeicon.min.css">
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux.css">
  <link rel="stylesheet" type="text/css" href="{$rootPath}modules/admin/tpl/admin_layout.css">
  {if $documentData.module_code != ''}
  <link rel="stylesheet" type="text/css" href="{$rootPath}modules/{$documentData.module_code}/tpl/{$documentData.module_code}_admin.css">
  {/if}
<body>
<div class="sx-wrapper">
  <div class="sx-container">
    <header>
      <div class="sx-header-bar">
        <a class="sx-menu-btn" title="메뉴 열기">
          <ul class="sx-menu">
            <li></li>
            <li></li>
            <li></li>
          </ul>
        </a>
        <h1 class="sx-logo">
          <a href="{$rootPath}admin-admin"><img src="{$rootPath}common/images/sux_logo_white.svg" onerror='this.src="{$rootPath}common/images/sux_logo.png"' alt="streamxux"/><span class="sx-logo-title">Admin<span></a>
        </h1>
      </div>  
    </header>
    <nav class="sx-nav">
      <div class="sx-nav-bar sx-nav-off">
        <div id="sxGnbCase" class="sx-gnb-case">
          <a href="#" class="sx-close-btn" title="메뉴 닫기">
            <ul class="sx-close">
              <li></li>
              <li></li>
            </ul>
          </a>      
          <ul class="sx-gnb lst_group clearfix">
            <li>
              <a href="#"><i class="xi-bars xi-fw"></i> 메뉴 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}menu-admin/list">메뉴 목록</a></li>
                  <li><a href="{$rootPath}menu-admin/add">메뉴 추가</a></li>
                </ul>
              </div>
            </li>
            <li>
              <a href="#"><i class="xi-group xi-fw"></i> 회원 관리</a>
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
              <a href="#"><i class="xi-comment-o xi-fw"></i> 게시판 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}board-admin">게시판 목록</a></li>                  
                  <li><a href="{$rootPath}board-admin/add">게시판 추가</a></li>                  
                </ul>
              </div>
            </li>
            <li>
              <a href="#"><i class="xi-paper-o xi-fw"></i> 페이지 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}document-admin" >페이지 목록</a></li>
                  <li><a href="{$rootPath}document-admin/add">페이지 추가</a></li>
                </ul>
              </div>          
            </li>
            <li>
              <a href="#"><i class="xi-forum-o xi-fw"></i> 팝업 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}popup-admin">팝업 목록</a></li>
                  <li><a href="{$rootPath}popup-admin/add">팝업 추가</a></li>
                </ul>
              </div>
            </li>
            <li>
              <a href="#"><i class="xi-chart-line xi-fw"></i> 통계 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}analytics-admin/connect-site">접속 목록</a></li>
                  <li><a href="{$rootPath}analytics-admin/connect-site-add">접속 키워드 추가</a></li>
                  <li class="divider"></li>
                  <li><a href="{$rootPath}analytics-admin/pageview">페이지뷰 목록</a></li>
                  <li><a href="{$rootPath}analytics-admin/pageview-add">페이지뷰 키워드 추가</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>  
    </nav>