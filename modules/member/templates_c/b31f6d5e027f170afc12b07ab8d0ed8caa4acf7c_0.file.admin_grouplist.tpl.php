<?php
/* Smarty version 3.1.30, created on 2016-10-01 07:32:15
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_grouplist.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57ef4a5fc99983_64146280',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b31f6d5e027f170afc12b07ab8d0ed8caa4acf7c' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_grouplist.tpl',
      1 => 1475136774,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ef4a5fc99983_64146280 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 회원그룹목록 - StreamUX"), 0, true);
?>
	
	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="list">
				<div class="tt">
					<div class="imgbox">						
						<h1>회원그룹목록</h1>
					</div>
				</div>
				<div class="box">
					<dl>
						<dt>
							<img src="../admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon_notice">										
						</dt>
						<dt>
							<span class="text-notice">한번 삭제 시 모든 자료가 사라집니다. 주의하세요.</span>
						</dt>
						<dd>							
							<span id="articleMemberDelTitle" class="button-delall">
								<!--
								@ jquery templete
								@ name articleMemberDelTitle_tmpl
								-->
							</span>
						<dd>
					</dl>
					<table summary="회원목록을 보여줍니다." cellspacing="0">
						<caption><span class="blind">회원목록</span></caption>
						<colgroup>
							<col width="12%">
							<col width="20%">
							<col width="48%">
							<col width="25%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col"><span>번호</span></th>
								<th scope="col"><span>그룹이름</span></th>
								<th scope="col"><span>생성 날자</span></th>
								<th scope="col"><span>삭제</span></th>
							</tr>         
						</thead>
						<tbody id="memberList">
							<!--
							@ jquery templete
							@ name	memberWarnMsg_tmpl, memberList_tmpl
							-->							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo '<script'; ?>
 type="jquery-templete" id="memberWarnMsg_tmpl">

	<tr>
		<td colspan="9"><span class="warn-msg">${msg}</span></td>
	</tr>

<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="jquery-templete" id="memberList_tmpl">

	<tr>
		<td><span>${no}</span></td>
		<td>
			<a href="member.admin.php?table_name=${name}&action=list&pagetype=member">
				<span>${name}</span>
			</a>
		</td>
		<td><span>${$item.editDate(date)}</span></td>	
		<td>
			<a href="member.admin.php?table_name=${name}&action=groupDelete&pagetype=member">
				<img src="../admin/tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>

<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
