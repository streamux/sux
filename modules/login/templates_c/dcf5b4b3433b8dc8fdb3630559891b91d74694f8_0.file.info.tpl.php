<?php
/* Smarty version 3.1.30, created on 2016-09-21 11:17:06
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e2501210ff13_81769827',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dcf5b4b3433b8dc8fdb3630559891b91d74694f8' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/info.tpl',
      1 => 1474449424,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e2501210ff13_81769827 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo"><img src="tpl/images/logo.png" alt="streamxux"></h1>
	</div>
	<div class="container">		
		<div class="article-box ui-edgebox">			
			<h2 class="blind">회원정보</h2>		
			<div class="login">
				<span class="title">회원정보</span>
				<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
				<div class="box ui-edgebox-2px">
					<div class="login-title">
						<img src="tpl/images/icon_01.gif" alt="">
						<span><a href="../member/member.php?table_name=<?php echo $_smarty_tpl->tpl_vars['documentData']->value['sessions']['ljs_member'];?>
&memberid=<?php echo $_smarty_tpl->tpl_vars['documentData']->value['sessions']['ljs_memberid'];?>
&action=modify">회원정보수정</a> | <a href="login.php?action=leave">회원탈퇴</a></span>
					</div>
					<div class="login-body">
						<div class="panel-info">
							<ul>
								<li><span class="ui-label">이름</span><span class="ui-value">'<?php echo $_smarty_tpl->tpl_vars['documentData']->value['sessions']['ljs_name'];?>
</span>' 님</li>
								<li><span class="ui-label">적립포인트</span><span class="ui-value">'<?php echo $_smarty_tpl->tpl_vars['documentData']->value['sessions']['ljs_point'];?>
</span>' 포인트</li>
								<li><span class="ui-label">방문횟수</span><span class="ui-value">'<?php echo $_smarty_tpl->tpl_vars['documentData']->value['sessions']['ljs_hit'];?>
</span>' 번째 방문</li>
							</ul>
						</div><div class="panel-btn">
							<a href="login.php?action=logout"><img src="tpl/images/btn_logout.gif"></a>
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
	</div>
	<div class="footer">
		Copyright @ STREAMUX Corp
	</div>
</div>
<div class="ui-panel-msg"></div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
