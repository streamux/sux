<!DOCTYPE html>
<html lang="ko">
<head>
	<title>{$title}</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="../../common/css/default.css" title="루트 CSS" media="all">
	<link rel="stylesheet" type="text/css" href="../../common/css/swiper.css">
	{if $requestData.jscode != ''}
		<link rel="stylesheet" type="text/css" href="{$skinPathList.dir}/css/board.css">
	{/if}
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
		<div class="article-header">
			<div class="ui-btn-write"><a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$requestData.passover}&page={$requestData.page}&action=write"><img src="../../common/images/icon_write.png" width="18px" height="18px"></a></div>
			<h1 class="document-title">{$groupData.board_name}</h1>
		</div>
		