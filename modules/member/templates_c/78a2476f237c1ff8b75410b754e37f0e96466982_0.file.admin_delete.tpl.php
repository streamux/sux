<?php
/* Smarty version 3.1.30, created on 2016-09-26 07:44:51
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_delete.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e8b5d35f8a60_16352149',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78a2476f237c1ff8b75410b754e37f0e96466982' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/admin_delete.tpl',
      1 => 1474868518,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e8b5d35f8a60_16352149 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 회원삭제 - StreamUX"), 0, true);
?>
	
	<div class="container">
		<div class="articles ui-edgebox">
			<div class="del ">
				<div class="tt">
					<div class="imgbox">
						<h1>회원삭제 알림</h1>	
					</div>
				</div>
				<div class="box">
					<ul>
						<li>
							<img src="../admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
							<span class="title1"><?php echo $_smarty_tpl->tpl_vars['table_name']->value;?>
 회원을 정말로 삭제 하시겠습니까?</span>
							<input type="hidden" name="memberid" value="<?php echo $_smarty_tpl->tpl_vars['requestData']->value['memberid'];?>
">
							<input type="hidden" name="table_name" value="<?php echo $_smarty_tpl->tpl_vars['requestData']->value['table_name'];?>
">
							<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
">
						</li>
						<li>
							<span class="title2">다시한번 잘 확인해 주세요.</span>
							<a href="#" data-key="del" class="button-del"><span>[삭제]</span></a>
							<a href="#" data-key="back" class="button-cancel"><span>[취소]</span></a>		
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
