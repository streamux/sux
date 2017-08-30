<?php
/* Smarty version 3.1.31, created on 2017-08-30 11:29:49
  from "/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_pageview_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59a6858d084086_41061225',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b88e315002ab34ea5fe3d388f70d18dd127fece' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_pageview_list.tpl',
      1 => 1483518982,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a6858d084086_41061225 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 게시판 삭제 - StreamUX"), 0, true);
?>

<div class="articles ui-edgebox">
	<div class="list">
		<div class="tt">
			<div class="imgbox">
				<h1>페이지뷰 목록</h1>
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					한번 삭제 시 모든 자료가 사라집니다. 주의하세요.	
				</li>
				<li>
					초기화 또한 반드시 필요한지 확인해주세요.
				</li>
			</ul>
			<table summary="접속키워드 목록을 보여줍니다." cellspacing="0">
				<caption><span class="blind">페이지뷰 목록</span></caption>
				<colgroup>
					<col width="8%">
					<col width="25%">
					<col width="16%">
					<col width="31%">
					<col width="12%">
					<col width="8%">
				</colgroup>
				<thead>
					<tr>
						<th scope="col"><span>번호</span></th>
						<th scope="col"><span>페이지 이름</span></th>
						<th scope="col"><span>클릭수</span></th>
						<th scope="col"><span>통계그래프</span></th>
						<th scope="col"><span>수정</span></th>
						<th scope="col"><span>삭제</span></th>
					</tr>         
				</thead>
				<tbody id="totallogList">
					<tr>
						<td colspan="6"></td>
					</tr>
					<!--
					@jquery templete
					@name totallogWarnMsg_tmpl, totallogList_tmpl
					-->	
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php echo '<script'; ?>
 type="jquery-templete" id="totallogWarnMsg_tmpl">

	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>

<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="jquery-templete" id="totallogList_tmpl">
	<tr>
		
		<td><span>${no}</span></td>
		<td><span>${name}</span></td>								
		<td><span>${hit_count}</span></td>
		<td><span>${percent}</span></td>
		
		<td>
			<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
analytics-admin/${id}/pageview-reset">
				<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/btn_reset.gif" alt="초기화버튼">
			</a></td>
		<td>
			<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
analytics-admin/${id}/pageview-delete">
				<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
