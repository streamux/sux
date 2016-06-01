<?
session_start();

include "../lib.php";
//include "admin_check.php";

$page_type = $_REQUEST["pageType"];
$page_type = $page_type ? $page_type : "main";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<title>SUX관리자 메인화면</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="tpl/css/common.css">
	<link rel="stylesheet" type="text/css" href="tpl/css/<? echo $page_type ?>.css">

	<script type="text/javascript" src="../../common/js/jquery.min.js"></script>
	<script type="text/javascript" src="../../common/js/jquery.tmpl.min.js"></script>
	<script type="text/javascript" src="../../common/js/jsux-1.0.0.min.js"></script>
	<script type="text/javascript" src="../../common/js/jsux.min.js"></script>
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="tpl/js/selectivizr-min.js"></script>
		<link rel="stylesheet" type="text/css" href="./css/main_ie8.css">
	<![endif]-->
</head>
<body>
<div class="wrap">
	<h1 class="blind">메인페이지</h1>
	<div class="header">		
		<div class="util"></div>
		<a href="./main.php">
			<img class="logo" src="tpl/images/logo.png" alt="streamxux 로고">
		</a>
		<h2 class="blind">GNB</h2>
		<div id="gnb_icon" class="gnb-icon"></div>
		<div class="gnbCase">					
			<div id="gnb" class="gnb"></div>
		</div>
	</div>