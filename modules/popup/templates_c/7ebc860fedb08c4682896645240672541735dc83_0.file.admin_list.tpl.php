<?php
/* Smarty version 3.1.30, created on 2016-10-27 05:47:56
  from "/Applications/MAMP/htdocs/sux/modules/popup/tpl/admin_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_581178ec351000_32968284',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7ebc860fedb08c4682896645240672541735dc83' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/popup/tpl/admin_list.tpl',
      1 => 1477540047,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_581178ec351000_32968284 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 팝업목록 - StreamUX"), 0, true);
?>

<div class="articles ui-edgebox">
	<div class="list">
		<div class="tt">
			<div class="imgbox">
				<h1>팝업목록</h1>
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="../admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">한번 삭제 시 모든 자료가 사라집니다. 주의하세요.</span>			
				</li>
			</ul>
			<table summary="팝업목록을 보여줍니다." cellspacing="0">
				<caption><span class="blind">팝업목록</span></caption>
				<colgroup>
					<col width="8%">
					<col width="26%">
					<col width="24%">
					<col width="26%">
					<col width="8%">
					<col width="8%">
				</colgroup>
				<thead>
					<tr>
						<th scope="col"><span>번호</span></th>
						<th scope="col"><span>이름</span></th>
						<th scope="col"><span>완료일</span></th>
						<th scope="col"><span>스킨</span></th>
						<th scope="col"><span>수정</span></th>
						<th scope="col"><span>삭제</span></th>
					</tr>         
				</thead>
				<tbody id="popupList">
					<tr>
						<td colspan="6"></td>
					</tr>
					<!--
					@ jquery templete
					@ name	popupWarnMsg_tmpl, popupList_tmpl
					-->		
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php echo '<script'; ?>
 type="jquery-templete" id="popupWarnMsg_tmpl">
	
	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>
	
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="jquery-templete" id="popupList_tmpl">
	
	<tr>
		<td><span>${no}</span></td>
		<td data-key="td"><span class="popup"><a href="#" data-key="${id}">${popup_name}</a></span></td>								
		<td><span class="ui-date">${date}</span><span class="ui-time">${time}</span></td>
		<td><span>${skin}</span></td>
		<td>
			<a href="popup.admin.php?id=${id}&action=modify&pagetype=popup">
				<img src="../admin/tpl/images/btn_edit.gif" alt="수정버튼">
			</a></td>
		<td>
			<a href="popup.admin.php?id=${id}&popup_name=${popup_name}&action=delete&pagetype=popup">
				<img src="../admin/tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
	
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
