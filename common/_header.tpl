<!DOCTYPE html>
<html lang="ko">
<head>
	<title>{$title}</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
	<link rel="icon" href="./favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/xeicon/2/xeicon.min.css">
	<link rel="stylesheet" type="text/css" href="{$rootPath}common/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux_default.min.css">
	<link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux_common.min.css">
	<link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux_layout.min.css">	
	{if $documentData.module_code != ''}
	<link rel="stylesheet" type="text/css" href="{$skinPathList.dir}css/{$documentData.module_code}.css">
	{/if}
	{if $documentData.isLogon === false}
	<link rel="stylesheet" type="text/css" href="{$skinPathList.dir}css/login_fail.css">
	{/if}
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
		// 컨텐츠 내 값 설정
		var is_page = '';
		var sux_domain = '';
	</script>
</head>
<body>
<div class="wrapper">
	<div class="header clearfix">
		<div class="mobile-menu-case">
			<div class="mobile-menu-btn">
				<div class="ui-h-3stick">
					<div class="hline1"></div>
					<div class="hline2"></div>
					<div class="hline3"></div>
				</div>
			</div>
		</div>
		<h1 class="logo">
			<a href="{$rootPath}"><img src="{$rootPath}common/images/sux_logo.svg" onerror='this.src="{$rootPath}common/images/sux_logo.png"' alt="streamxux"></a>
		</h1>
		<div class="gnb-case">
			<div id="gnb" class="gnb"></div>
		</div>
	</div>
	<div class="section container">
		{if {$groupData.board_name}}
		<div class="contents-header">
			
			<div class="ui-btn-write"><a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$requestData.passover}&page={$requestData.page}&action=write"><img src="{$rootPath}common/images/icon_write.png" width="18px" height="18px"></a></div>
			<h1 class="document-title">{$groupData.board_name}</h1>			
			<p>home > {$documentData.module_name}</p>
		</div>
		{/if}