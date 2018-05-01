<!DOCTYPE html>
<html lang="ko">
<head>
  <title>{$browserTitle} - STREAMUX</title>
  <meta charset="utf-8" />
  <meta name="Generator" content="StreamUX">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">

  <link rel="icon" href="./favicon.ico" type="image/x-icon">
  
  {if $documentData.module_type === 'document' || $documentData.module_type === 'board'}
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/plugins/syntaxhighlighter/styles/shCore.css?1" type="text/css" media="all" />
  <link rel="stylesheet" type="text/css" href="{$rootPath}common/plugins/syntaxhighlighter/styles/shThemeOT.css" media="all" />
  {/if}

  <link rel="stylesheet" href="//cdn.jsdelivr.net/xeicon/2/xeicon.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
  <!-- <link rel="stylesheet" href="{$rootPath}common/css/api/xeicon.min.css">
  <link rel="stylesheet" href="{$rootPath}common/css/api/bootstrap.min.css">
  <link rel="stylesheet" href="{$rootPath}common/css/api/swiper.min.css">--> 

  <link rel="stylesheet" href="{$rootPath}common/css/sux.min.css?20180202">
  <link rel="stylesheet" href="{$rootPath}common/css/sux_layout.css?20180202">  
  {if $documentData.module_code}
  <link rel="stylesheet" type="text/css" href="{$skinPath}{$documentData.module_code}.css?{$cookieVersion}">
  {/if}
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript">var is_page='';</script>
</head>
<body>
