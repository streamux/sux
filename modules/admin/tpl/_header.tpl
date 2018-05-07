<!DOCTYPE html>
<html lang="ko">
<head>
  <title>{$browserTitle}</title>  
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
  
  {if $documentData.develop_mode !== true}
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">  
  {else if}
  <link rel="stylesheet" href="{$rootPath}common/css/api/xeicon.min.css">
  <link rel="stylesheet" href="{$rootPath}common/css/api/swiper.min.css">
  {/if}

  <link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux.min.css?20180108">
  <link rel="stylesheet" type="text/css" href="{$rootPath}modules/admin/tpl/admin_layout.css?20180109">  
  
  {if $documentData.module_code !== ''}
  <link rel="stylesheet" type="text/css" href="{$rootPath}modules/{$documentData.module_code}/tpl/{$documentData.module_code}_admin.css?20180109_2">
  {/if}

  {if $documentData.module_code === 'menu'}
  <base href="{$rootPath}">
  <script type="text/javascript">
    var sux_resource_url = '{$rootPath}';
  </script>
  {/if}

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  
</head>
<body>