<?php
/* Smarty version 3.1.30, created on 2016-10-24 10:33:06
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_groupadd.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580dc7423c4ff8_34060600',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e3f377c828ea26a2dfae9113508e1d18be369f13' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_groupadd.tpl',
      1 => 1475136774,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580dc7423c4ff8_34060600 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 회원그룹추가 - StreamUX"), 0, true);
?>
	
<div class="container">	
		<div class="articles ui-edgebox">
			<div class="group-add">
				<h2 class="blind">회원그룹추가</h2>
				<div class="tt">
					<div class="imgbox">
						<h1>회원그룹추가</h1>
					</div>
				</div>
				<div class="box">
					<form>
					<ul>
						<li>
							<img src="../admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
							<span class="text-notice">회원그룹을 생성해야지만 회원을 받으실수 있습니다.</span>			
						</li>
						<li>
							<span>회원그룹 이름</span>
							<input type="text" name="table_name" size="16" maxlength="16">
						</li>
					</ul>
					<input type="submit" name="submit" size="10" value="확 인">
					<input type="button" name="cancel" value="취 소">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
