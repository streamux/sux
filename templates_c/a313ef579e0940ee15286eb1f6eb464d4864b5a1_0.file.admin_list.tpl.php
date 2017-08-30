<?php
/* Smarty version 3.1.31, created on 2017-08-30 11:30:09
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59a685a1596b54_49678294',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a313ef579e0940ee15286eb1f6eb464d4864b5a1' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_list.tpl',
      1 => 1488852504,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a685a1596b54_49678294 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 회원목록 - StreamUX"), 0, true);
?>
	
<div class="articles ui-edgebox">
	<div class="list">
		<div class="tt">
			<div class="imgbox">						
				<h1>회원목록</h1>
				<input type="hidden" name="category" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['category'];?>
">
				<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['id'];?>
">
			</div>
		</div>
		<div class="box">
			<ul>
				<li>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">한번 삭제 시 모든 자료가 사라집니다. 주의하세요.</span>	
				</li>
			</ul>
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
					<tr>
						<td colspan="8"></td>
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
 type="jquery-templete" id="articleMemberDelTitle_tmpl">

	<a href="member.groupdelpass.php?table_name=${table_name}&pagetype=member">${category}<span>회원그룹삭제</span></a>

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
		<td><span>${user_id}</span></td>
		<td><span>${user_name}</span></td>
		<td><span>${$item.editDate(date)}</span></td>							
		<td><span>${access_count}</span></td>
		<td><span>${grade}</span></td>
		
		<td>
			<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
member-admin/<?php echo $_smarty_tpl->tpl_vars['documentData']->value['id'];?>
/modify/${id}">
				<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
/modules/admin/tpl/images/btn_edit.gif" alt="수정버튼">
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
member-admin/<?php echo $_smarty_tpl->tpl_vars['documentData']->value['id'];?>
/delete/${id}">
				<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
/modules/admin/tpl/images/btn_del.gif" alt="삭제버튼">
			</a>
		</td>
	</tr>
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
