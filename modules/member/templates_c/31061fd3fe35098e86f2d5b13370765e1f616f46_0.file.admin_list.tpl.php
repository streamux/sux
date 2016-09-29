<?php
/* Smarty version 3.1.30, created on 2016-09-26 15:54:23
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e9288f02b3e1_38379949',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31061fd3fe35098e86f2d5b13370765e1f616f46' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_list.tpl',
      1 => 1474898053,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e9288f02b3e1_38379949 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 회원목록 - StreamUX"), 0, true);
?>
	
	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="list">
				<div class="tt">
					<div class="imgbox">						
						<h1>회원목록</h1>
						<input type="hidden" name="table_name" value="<?php echo $_smarty_tpl->tpl_vars['requestData']->value['table_name'];?>
">
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
							<col width="8%">
							<col width="18%">
							<col width="18%">
							<col width="20%">
							<col width="9%">
							<col width="9%">
							<col width="9%">
							<col width="9%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col"><span>번호</span></th>
								<th scope="col"><span>아이디</span></th>
								<th scope="col"><span>이름</span></th>
								<th scope="col"><span>날자</span></th>
								<th scope="col"><span>히트</span></th>
								<th scope="col"><span>레벨</span></th>
								<th scope="col"><span>수정</span></th>
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
 type="jquery-templete" id="articleMemberDelTitle_tmpl">

	<a href="member.groupdelpass.php?table_name=${table_name}&pagetype=member">${table_name}<span>회원그룹삭제</span></a>

<?php echo '</script'; ?>
>
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
		<td><span>${memberid}</span></td>
		<td><span>${name}</span></td>
		<td><span>${$item.editDate(date)}</span></td>							
		<td><span>${hit}</span></td>
		<td><span>${grade}</span></td>
		<td>
			<a href="member.admin.php?id=${id}&memberid=${memberid}&table_name=${table_name}&action=modify&pagetype=member">
				<img src="../admin/tpl/images/btn_edit.gif" alt="수정버튼">
			</a></td>
		<td>
			<a href="member.admin.php?id=${id}&memberid=${memberid}&table_name=${table_name}&action=delete&pagetype=member">
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
