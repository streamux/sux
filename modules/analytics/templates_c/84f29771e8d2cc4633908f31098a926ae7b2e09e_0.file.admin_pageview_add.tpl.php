<?php
/* Smarty version 3.1.30, created on 2016-09-27 02:31:17
  from "/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_pageview_add.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e9bdd5f28e50_63648992',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '84f29771e8d2cc4633908f31098a926ae7b2e09e' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_pageview_add.tpl',
      1 => 1474900703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e9bdd5f28e50_63648992 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 페이지뷰 추가 - StreamUX"), 0, true);
?>

	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="add">
				<div class="tt">
					<div class="imgbox">
						<h1>페이지뷰 추가</h1>
					</div>
				</div>
				<div class="box">
					<form name="f_pageview_add">
					<ul>
						<li>
							<img src="../admin/tpl/images/icon_refer.gif" width="30" height="13" align="absmiddle" alt="참고아이콘" class="icon-notice">
						</li>
						<li>
							<span>페이지뷰를 생성하면 각 메뉴별 클릭 조회수를 알 수 있습니다.<span>
							<span>예제) http://www.사이트주소.com/gateway.php/페이지명.php?keyword=페이지뷰 키워드<span>

							<span class="text-keyword">페이지뷰키워드</span>
							<input type="text" name="keyword" size="16" maxlength="16">
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
?>

<?php }
}
