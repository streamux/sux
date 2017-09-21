<!DOCTYPE html>
<html lang="ko">
<head>
	<title>{$title}</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height, maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="{$rootPath}common/css/sux.css">
	<link rel="stylesheet" type="text/css" href="{$rootPath}modules/admin/tpl/css/admin_layout.css">
	{if $documentData.module_code != ''}
	<link rel="stylesheet" type="text/css" href="{$rootPath}modules/admin/tpl/css/{$documentData.module_code}.css">
	{/if}
<body>
<div class="sx-wrapper">
	<div class="sx-header">		
		<div class="util"></div>
		<a href="{$rootPath}admin-admin">
			<h1><img class="logo" src="{$rootPath}modules/admin/tpl/images/logo.png" alt="streamxux"></h1>
		</a>
		<div id="gnbIcon" class="sx-gnb-icon"></div>
		<div class="sx-gnb-case">					
			<div id="sxGnb" class="sx-gnb"></div>
		</div>
	</div>
	<div class="section sx-container">