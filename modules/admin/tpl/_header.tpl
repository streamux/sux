<!DOCTYPE html>
<html lang="ko">
<head>
  <title>{$browserTitle}</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
  
  {if $documentData.develop_mode !== true}
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">  
  {else if}
  <link rel="stylesheet" href="{$rootPath}common/css/api/xeicon.min.css">
  <link rel="stylesheet" href="{$rootPath}common/css/api/swiper.min.css">
  {/if}

  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux.min.css?20180109">
  <link rel="stylesheet" type="text/css" href="{$rootPath}modules/admin/tpl/admin_layout.css?20180109">  
  
  {if $documentData.module_code !== ''}
  <link rel="stylesheet" type="text/css" href="{$rootPath}modules/{$documentData.module_code}/tpl/{$documentData.module_code}_admin.css?20180109_2">
  {/if}

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  
</head>
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
              <a href="{$rootPath}board-admin"><i class="xi-comment-o xi-fw"></i> 게시글 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}board-admin/list">게시글 목록</a></li>
                  <li><a href="{$rootPath}board-admin/add">게시글 추가</a></li>                  
                  <li class="divider"></li>
                  <li><a href="{$rootPath}board-admin/group">게시 그룹 목록</a></li>                  
                  <li><a href="{$rootPath}board-admin/group-add">게시판 추가</a></li>                  
                </ul>
              </div>
            </li>
            <li>
              <a href="{$rootPath}document-admin"><i class="xi-paper-o xi-fw"></i> 페이지 관리</a>
              <div class="sx-sub-case">
                <ul class="sx-drap-menu">
                  <li><a href="{$rootPath}document-admin" >페이지 목록</a></li>
                  <li><a href="{$rootPath}document-admin/add">페이지 추가</a></li>
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