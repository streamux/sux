<!DOCTYPE html>
<html>
<head>
	<title>{$title}</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_default.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_common.min.css">
	<link rel="stylesheet" type="text/css" href="../../common/css/sux_layout.css">	
	<link rel="stylesheet" type="text/css" href="tpl/css/login.css">
{if $documentData.isLogon === false}
	<link rel="stylesheet" type="text/css" href="tpl/css/login_fail.css">
{/if}
</head>
<body>
<div class="wrapper">
	<div class="header"></div>
	<div class="container">	

