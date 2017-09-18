<!DOCTYPE html>
<html lang="ko">
<head>
  <title>{$title}</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
  <link rel="icon" href="./favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/xeicon/2/xeicon.min.css">
  <!-- 합쳐지고 최소화된 최신 CSS -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux.css">
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux_layout.css"> 
  {if $documentData.module_code != ''}
  <link rel="stylesheet" type="text/css" href="{$skinPath}css/{$documentData.module_code}.css">
  {/if}
  {if $documentData.isLogon === false}
  <link rel="stylesheet" type="text/css" href="{$skinPath}css/login_fail.css">
  {/if}  
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript">
    // 컨텐츠 내 값 설정
    var is_page = '';
  </script>
</head>
<body>
<div class="sx-wrapper">
  <div class="sx-header clearfix">
    <!-- mobbile gnb start -->
    <div class="mobile-menu-case">
      <div class="mobile-menu-btn">
        <div class="sx-h-3stick">
          <div class="sx-hline1"></div>
          <div class="sx-hline2"></div>
          <div class="sx-hline3"></div>
        </div>
      </div>
    </div>
    <!-- end -->
    <h1 class="sx-logo">
      <a href="{$rootPath}"><img src="{$rootPath}common/images/sux_logo.svg" onerror='this.src="{$rootPath}common/images/sux_logo.png"' alt="streamxux"></a>
    </h1>
    <!-- gnb start -->
    <div class="sx-gnb-case">
      <div id="sxGnb" class="sx-gnb"></div>
      <a href="{$rootPath}login" class="sx-gnb-login">
        <i class="xi-user"></i>로그인
      </a>
    </div>
    <!-- end -->    
  </div>
  <div class="section sx-container"> 