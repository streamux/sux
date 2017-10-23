<!DOCTYPE html>
<html lang="ko">
<head>
  <title>{$title}</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/xeicon/2/xeicon.min.css">
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
              <a href="#" title="회원 관리"><i class="xi-group xi-fw"></i> 회원 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}member-admin/list" title="회원 목록">회원 목록</a></li>
                  <li><a href="{$rootPath}member-admin/add" title="회원 추가">회원 추가</a></li>
                  <li class="divider"></li>
                  <li><a href="{$rootPath}member-admin/group" title="그룹 목록">그룹 목록</a></li>
                  <li><a href="{$rootPath}member-admin/group-add" title="그룹 추가">그룹 추가</a></li>
                </ul>
              </div>
            </li>
            <li>
              <a href="#" title="게시판 관리"><i class="xi-comment-o xi-fw"></i> 게시판 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}board-admin" title="게시판 목록">게시판 목록</a></li>                  
                  <li><a href="{$rootPath}board-admin/add" title="게시판 추가">게시판 추가</a></li>                  
                </ul>
              </div>
            </li>
            <li>
              <a href="#" title="페이지 관리"><i class="xi-paper-o xi-fw"></i> 페이지 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}document-admin" title="페이지 목록">페이지 목록</a></li>
                  <li><a href="{$rootPath}document-admin/add" title="페이지 추가">페이지 추가</a></li>
                </ul>
              </div>          
            </li>
            <li>
              <a href="#" title="팝업 관리"><i class="xi-forum-o xi-fw"></i> 팝업 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}popup-admin" title="팝업 목록">팝업 목록</a></li>
                  <li><a href="{$rootPath}popup-admin/add" title="팝업 추가">팝업 추가</a></li>
                </ul>
              </div>
            </li>
            <li>
              <a href="#" title=" 통계 관리"><i class="xi-chart-line xi-fw"></i> 통계 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}analytics-admin/connect-site" title="접속 목록">접속 목록</a></li>
                  <li><a href="{$rootPath}analytics-admin/connect-site-add" title="접속 키워드 추가">접속 키워드 추가</a></li>
                  <li class="divider"></li>
                  <li><a href="{$rootPath}analytics-admin/pageview" title="페이지뷰 목록">페이지뷰 목록</a></li>
                  <li><a href="{$rootPath}analytics-admin/pageview-add" title="페이지뷰 키워드 추가">페이지뷰 키워드 추가</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>  
    </nav>