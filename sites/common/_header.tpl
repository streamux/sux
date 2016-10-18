<!DOCTYPE html>
<html lang="ko">
<head>
	<title>{$title}</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0, target-densityDpi=device-dpi">
	<link rel="stylesheet" type="text/css" href="../../common/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_default.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_common.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_layout.min.css">	
	{if $requestData.jscode != ''}
		<link rel="stylesheet" type="text/css" href="{$skinPathList.dir}/css/board.css">
	{/if}
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="wrapper">
	<div class="header clearfix">		
		<div class="util"></div>
		<h1 class="logo">
			<a href="../../index.php"><img src="../../common/images/sux_logo.png" alt="streamxux" width="60px" height="30px"></a>
		</h1>		
		<div class="mobile-menu">
			<div class="mobile-btn">
				<div class="btn-hline1"></div>
				<div class="btn-hline2"></div>
				<div class="btn-hline2"></div>
			</div>
		</div>
		<div class="gnb-case">
			<div id="gnb" class="gnb"></div>
		</div>
	</div>
	<div class="container">
		<div class="contents-header">
			<div class="ui-btn-write"><a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$requestData.passover}&page={$requestData.page}&action=write"><img src="../../common/images/icon_write.png" width="18px" height="18px"></a></div>
			<h1 class="document-title">{$groupData.board_name}</h1>
			<p>home > {$requestData.board} > {$groupData.board_name}</p>
		</div>
		<div class="swiper-container swiper-container-contents">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
				
		