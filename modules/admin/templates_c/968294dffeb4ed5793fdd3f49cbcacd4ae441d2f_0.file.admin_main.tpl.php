<?php
/* Smarty version 3.1.30, created on 2016-09-26 15:51:20
  from "/Applications/MAMP/htdocs/sux/modules/admin/tpl/admin_main.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e927d8d5b5d0_14791444',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '968294dffeb4ed5793fdd3f49cbcacd4ae441d2f' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/admin/tpl/admin_main.tpl',
      1 => 1474897847,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e927d8d5b5d0_14791444 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 메인 - StreamUX"), 0, true);
?>

	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="connect">
				<div class="tt">
					<div class="imgbox">
						<h1>접속로그현황</h1>  
					</div>        
				</div>  
				<div class="box">
					<table summary="접속로그현황 정보를 제공합니다.">
						<caption><span class="blind">접속로그현황</span></caption>
						<colgroup>
							<col width="45%">
							<col width="55%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col">구분</th>
								<th scope="col">접속수</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>오늘접속</td>
								<td id="today" class="view-type-textfield"></td>
							</tr>
							<tr>
								<td>어제접속</td>
								<td id="yester" class="view-type-textfield"></td>
							</tr>
							<tr>
								<td>전체접속</td>
								<td id="total" class="view-type-textfield"></td>
							</tr>
						</tbody>
					</table>
					<table summary="접속로그현황 정보를 제공합니다.">
						<caption><span class="blind">접속로그현황</span></caption>
						<colgroup>
							<col width="45%">
							<col width="55%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col">구분</th>
								<th scope="col">접속수</th>
							</tr>						
						</thead>
						<tbody>
							<tr>
								<td>오늘 실접속</td>
								<td id="real_today" class="view-type-textfield"></td>
							</tr>
							<tr>
								<td>어제 실접속</td>
								<td id="real_yester" class="view-type-textfield"></td>
							</tr>
							<tr>
								<td>전체 실접속</td>
								<td id="real_total" class="view-type-textfield"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="ui-tab-promotion">
				<ui class="tab-header">					
					<li class="tt">
						<div class="imgbox-true">
							<h1>페이지 별 클릭 수</h1>
						</div>												
					</li>
					<li class="tt">
						<div class="imgbox-false">
							<h1>접속경로 분석</h1>
						</div>
					</li>
				</ui>
				<div class="pageview activate-false">       
					<table summary="페이지 별 클릭 수 정보를 제공합니다.">
						<caption><span class="blind">페이지 별 클릭 수</span></caption>
						<colgroup>
							<col width="12%">
							<col width="28%">
							<col width="20%">
							<col width="40%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="p-no">번호</th>
								<th scope="col" class="p-name">페이지 이름</th>
								<th scope="col" class="p-hit">클릭수</th>
								<th scope="col" class="p-graph">통계그래프</th>
							</tr>         
						</thead>
						<tbody id="articlesHitList">
							<!--
							@ jquery templete
							@ name	hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
							-->
							<tr>
								<td colspan="4"></td>
							</tr>
						</tbody>
					</table>
					<div class="ui-navi ui-navi-hide">
						<a href="#none"><span class="ui-navi-prev">이전</span></a>
						<ol id="hitNaviList" class="ui-navi-list">
							<!--
							@ templete boardNaviList_tmpl
							-->
						</ol>
						<a href="#none"><span class="ui-navi-next">다음</span></a>
					</div>
				</div>
				<div class="analytics activate-false">
					<table summary="접속경로 정보를 제공합니다.">
						<caption><span class="blind">접속경로분석</span></caption>
						<colgroup>
							<col width="12%">
							<col width="28%">
							<col width="20%">
							<col width="40%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col">번호</th>
								<th scope="col" class="p-name">접속키워드</th>
								<th scope="col" class="p-hit">클릭수</th>
								<th scope="col" class="p-graph">통계그래프</th>
							</tr>         
						</thead>
						<tbody id="articlesAnalyticsList">
							<!--
							@ jquery templete
							@ name	hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
							-->
							<tr>
								<td colspan="4"></td>
							</tr>
						</tbody>
					</table>
					<div class="ui-navi ui-navi-hide">
						<a href="#none"><span class="ui-navi-prev">이전</span></a>
						<ol id="analyticsNaviList" class="ui-navi-list">
							<!--
							@ templete AnalysisNaviList_tmpl
							-->
						</ol>
						<a href="#none"><span class="ui-navi-next">다음</span></a>
					</div>
				</div>
			</div>
			<div class="config">
				<div class="tt">
					<div class="imgbox">
						<h1>서비스 설정상태</h1>
					</div>
				</div>
				<div class="box">
					<table summary="서비스 설정 상태정보를 제공합니다.">
						<caption><span class="hide">서비스 설정 상태</span></caption>
						<colgroup>
							<col width="27%">
							<col width="13%">
							<col width="10%">
							<col width="27%">
							<col width="13%">
							<col width="10%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>팝업등록</td>
								<td id="popupNum" class="view-type-textfield"></td>
								<td id="popupIcon" class="view-type-icon icon-inactivate"></td>
								<td>게시판등록</td>
								<td id="boardNum" class="view-type-textfield"></td>
								<td id="boardIcon" class="view-type-icon icon-inactivate"></td>
							</tr>
							<tr>
								<td>접속키워드등록</td>
								<td  id="analysisNum" class="view-type-textfield"></td>
								<td id="analysisIcon" class="view-type-icon icon-inactivate"></td>
								<td>그룹회원</td>
								<td id="memberNum" class="view-type-textfield"></td>
								<td id="memberIcon" class="view-type-icon icon-inactivate"></td>
							</tr>
							<tr>
								<td>페이지뷰등록</td>
								<td id="pageviewNum" class="view-type-textfield"></td>
								<td id="pageviewIcon" class="view-type-icon icon-inactivate"></td>
								<td colspan="3"></td>
							</tr>
						</tbody>
					</table>			
				</div>
			</div>
		</div>
	</div>	
</div>
<?php echo '<script'; ?>
 type="x-jquery-templete" id="textfield_tmpl">

	<span>${$item.getUnit( label )}</span>

<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="x-jquery-templete" id="hitAnalyticsWarnMsg_tmpl">

	<tr>
		<td colspan="4" style="border-bottom-style:none"><span class="warn-msg">${msg}</span></td>
	</tr>

<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="x-jquery-templete" id="hitAnalyticsList_tmpl">

	<tr>
		<td class="p-no">${no}</td>
		<td class="p-name">${name}</td>
		<td class="p-hit">${hit}회</td>
		<td class="p-graph"><div class="g-graph"></div><span>0%</span></td>
	</tr>

<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="x-jquery-templete" id="NaviList_tmpl">

	<li><a href="#none"><span>${no}</span></a></li>

<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
