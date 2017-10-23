<!DOCTYPE html>
<html lang="ko">
<head>
  <title>{$browserTitle} - STREAMUX</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
  <link rel="icon" href="./favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/xeicon/2/xeicon.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux.css">
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux_layout.css"> 
  {if $documentData.module_code}
  <link rel="stylesheet" type="text/css" href="{$skinPath}{$documentData.module_code}.css">
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
        <ul class="sx-h-3stick">
          <li class="sx-hline1"></li>
          <li class="sx-hline2"></li>
          <li class="sx-hline3"></li>
        </ul>        
      </div>
      <div class="mobile-menu-bg"></div>
    </div>
    <!-- end -->
    <h1 class="sx-logo">
      <a href="{$rootPath}"><img src="{$rootPath}common/images/sux_logo.svg" onerror='this.src="{$rootPath}common/images/sux_logo.png"' alt="streamxux"></a>
    </h1>
    <div class="sx-gnb-case">
      <div id="sxGnb" class="sx-gnb"></div>      
    </div>
    {if isset($sessionData.user_name) && $sessionData.user_name}
      <a href="{$rootPath}logout?_method=insert" class="sx-gnb-login" title="로그아웃" alt="로그아웃">
        <i class="xi-user-o xi-2x"></i>
      </a>
    {else}
      <a href="{$rootPath}login" class="sx-gnb-login" title="로그인" alt="로그인">
        <i class="xi-user xi-2x"></i>
      </a>
    {/if}      
  </div>
  <div class="section sx-container"> 