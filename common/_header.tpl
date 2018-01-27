<!DOCTYPE html>
<html lang="ko">
<head>
  <title>{$browserTitle} - STREAMUX</title>
  <meta charset="utf-8" />
  <meta name="Generator" content="StreamUX">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">

  <link rel="icon" href="./favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/xeicon/2/xeicon.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
  <link rel="stylesheet" href="{$rootPath}common/css/sux.min.css">
  <link rel="stylesheet" href="{$rootPath}common/css/sux_layout.css">
  
  {if $documentData.module_code}
  <link rel="stylesheet" type="text/css" href="{$skinPath}{$documentData.module_code}.css">
  {/if}

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

  <script type="text/javascript">var is_page='';</script>
</head>
<body>
<div class="sx-wrapper">
  
  <!-- Skip -->
  <p class="sx-skip-menu">
    <a href="#sxGnb">Skip to menu</a>  
    <a href="#sxContents">Skip to content</a>  
  </p>

  <!-- Header --> 
  <header id="sxHeader" class="header">    
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
      {if isset($sessionData.grade) && $sessionData.grade > 9}
        <a href="{$rootPath}admin-admin" target="_blank"><img src="{$rootPath}common/images/icon_gear.svg" onerror='this.src="{$rootPath}common/images/icon_gear.png"' alt="관리자 설정" /></a>
      {/if}
      </div>      
      
      <!--  Login  -->
      <div class="sx-gnb-login-wrap">
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
  </header>

  <!-- Nav -->
  <div id="nav" class="sx-gnb">
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
            {if isset($sessionData.grade) && $sessionData.grade > 9}
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
  </div>

  <!-- container -->
  <div id="sxContents" class="sx-container">