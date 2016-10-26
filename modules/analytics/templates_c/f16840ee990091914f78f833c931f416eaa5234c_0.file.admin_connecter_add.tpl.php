<?php
/* Smarty version 3.1.30, created on 2016-10-24 11:39:37
  from "/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_connecter_add.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580dd6d9ce3608_53372482',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f16840ee990091914f78f833c931f416eaa5234c' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/analytics/tpl/admin_connecter_add.tpl',
      1 => 1475136774,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580dd6d9ce3608_53372482 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 접속키워드 추가 - StreamUX"), 0, true);
?>

<div class="container">	
		<div class="articles ui-edgebox">
			<div class="add">
				<div class="tt">
					<div class="imgbox">
						<h1>접속키워드 추가</h1>
					</div>
				</div>
				<div class="box">
					<form name="f_connecter_add">
					<ul>
						<li>
							<img src="../admin/tpl/images/icon_refer.gif" width="30" height="13" align="absmiddle" alt="참고아이콘" class="icon-notice">
						</li>
						<li>
							<span>접속키워드를 생성하면 외부 링크를 통해 사용자 접속경로를 알 수 있습니다.<span>
							<span>예제) http://www.사이트주소.com/gateway.php?keyword=접속키워드<span>

							<span class="text-keyword">접속키워드</span>
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
