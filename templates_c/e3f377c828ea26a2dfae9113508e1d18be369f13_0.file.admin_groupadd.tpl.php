<?php
/* Smarty version 3.1.30, created on 2017-01-05 10:57:44
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_groupadd.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_586e189822e764_87065981',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e3f377c828ea26a2dfae9113508e1d18be369f13' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_groupadd.tpl',
      1 => 1483518983,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_586e189822e764_87065981 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 회원그룹추가 - StreamUX"), 0, true);
?>
	
<div class="articles ui-edgebox">
	<div class="group-add">
		<h2 class="blind">회원그룹추가</h2>
		<div class="tt">
			<div class="imgbox">
				<h1>회원그룹추가</h1>
			</div>
		</div>
		<div class="box">
			<form action="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
member-admin/group-add" name="f_admin_group_add" method="post">
			<input type="hidden" name="_method" value="insert">
			<ul>
				<li>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">회원그룹을 생성해야지만 회원을 받으실수 있습니다.</span>			
				</li>				
				<li>
					<p><label for="category">카테고리(영문)</label></p>
					<input type="text" id="category" name="category" maxlength="16" value=""> <input type="button" name="check-member-group" value="중복체크">
				</li>
				<li>
					<p><label for="group_name">회원그룹 이름</label></p>				
					<input type="text" id="group_name" name="group_name" maxlength="16" value="">
				</li>
				<li>
					<p><label for="summary">요약 설명</label></p>				
					<input type="text" id="summary" name="summary" maxlength="50" value="회원을 그룹단위로 관리합니다.">
				</li>
				<li>
					<p><label for="header_path">헤더 파일</label></p>					
					<input type="text" id="header_path" name="header_path" maxlength="50" value="/sux/common/_header.tpl">
				</li>
				<li>
					<p><label for="footer_path">푸터 파일</label></p>				
					<input type="text" id="footer_path" name="footer_path" maxlength="50" value="/sux/common/_footer.tpl">
				</li>
			</ul>
			<input type="submit" name="submit" size="10" value="확 인">
			<input type="button" name="cancel" value="취 소">
			</form>
		</div>
	</div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
