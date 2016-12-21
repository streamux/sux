<?php
/* Smarty version 3.1.30, created on 2016-12-16 06:13:05
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_grouplist.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_585377e1d32e89_97432911',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b31f6d5e027f170afc12b07ab8d0ed8caa4acf7c' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_grouplist.tpl',
      1 => 1481865184,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_585377e1d32e89_97432911 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 회원그룹목록 - StreamUX"), 0, true);
?>
	
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
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon_notice">										
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
					<col width="19%">
					<col width="43%">
					<col width="13%">
					<col width="13%">
				</colgroup>
				<thead>
					<tr>
						<th scope="col"><span>번호</span></th>
						<th scope="col"><span>그룹이름</span></th>
						<th scope="col"><span>생성 날자</span></th>
						<th scope="col"><span>수정</span></th>
						<th scope="col"><span>삭제</span></th>
					</tr>         
				</thead>
				<tbody id="memberList">
					<tr>
						<td colspan="5"></td>
					</tr>
					<!--
					@ jquery templete
					@ name	memberWarnMsg_tmpl, memberList_tmpl
					-->							
				</tbody>
			</table>
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
			
			<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
member-admin/${id}/list">
				<span>${category}</span>
			</a>
		</td>
		<td><span>${$item.editDate(date)}</span></td>	
		<td>
			<a href="#">
				<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/btn_edit.gif" alt="수정버튼">
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
member-admin/${id}/group-delete">
				<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
