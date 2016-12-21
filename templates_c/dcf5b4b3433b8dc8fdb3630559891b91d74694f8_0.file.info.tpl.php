<?php
/* Smarty version 3.1.30, created on 2016-11-26 07:35:14
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58392d22b5da94_25442799',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dcf5b4b3433b8dc8fdb3630559891b91d74694f8' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/info.tpl',
      1 => 1480142113,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58392d22b5da94_25442799 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"회원정보 - StreamUX"), 0, true);
?>

<div class="article-box ui-edgebox">
	<div class="login">
		<h1 class="title">회원정보</h1>
		<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
		<div class="box ui-edgebox-2px">
			<div class="login-header">
				<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/login/tpl/images/icon_01.gif" alt="">
				<span><a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
member-modify">회원정보수정</a> | <a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
leave">회원탈퇴</a></span>
			</div>
			<div class="login-body">
				<div class="panel-info">
					<ul>
						<li><span class="ui-label">이름</span><span class="ui-value">'<?php echo $_smarty_tpl->tpl_vars['sessionData']->value['sux_user_name'];?>
</span>' 님</li>
						<li><span class="ui-label">적립포인트</span><span class="ui-value">'<?php echo $_smarty_tpl->tpl_vars['sessionData']->value['sux_point'];?>
</span>' 포인트</li>
						<li><span class="ui-label">방문횟수</span><span class="ui-value">'<?php echo $_smarty_tpl->tpl_vars['sessionData']->value['sux_hit_count'];?>
</span>' 번째 방문</li>
					</ul>
				</div><div class="panel-btn">
					<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
logout?_method=insert"><img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/login/tpl/images/btn_logout.gif"></a>
				</div>
			</div>																	
		</div>
		<div class="panel-notice">
			<dl>
				<dt>주의사항</dt>
				<dd>비밀번호가 노출되지 않도록 세심한 주의를 기울여 주세요.</dd>
			</dl>
			<dl>
				<dt>서비스 이용안내</dt>
				<dd>서비스를 이용하시려면 먼저 로그인을 해주세요.</dd>
			</dl>
		</div>					
	</div>			
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
