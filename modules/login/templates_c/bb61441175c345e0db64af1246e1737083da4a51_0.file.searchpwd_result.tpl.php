<?php
/* Smarty version 3.1.30, created on 2016-09-22 08:20:14
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/searchpwd_result.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e3781e833268_02865090',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb61441175c345e0db64af1246e1737083da4a51' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/searchpwd_result.tpl',
      1 => 1474525211,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e3781e833268_02865090 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"비밀번호 찾기 결과 - StreamUX"), 0, true);
?>

<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img src="tpl/images/logo.png" alt="streamxux">
		</h1>
	</div>
	<div class="container">		
		<div class="article-box ui-edgebox">	
			<div class="login">
				<h1 class="title">비밀번호 찾기 결과</h1>
				<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
				
				<div class="box ui-edgebox-2px">
					<div class="leave-header">
						<img src="tpl/images/icon_01.gif" title="">						
						<span>조회 결과</span>
						<span class="link-searchinfo">
							<a href="login.php?action=searchid">아이디</a> | <a href="login.php?action=searchpwd">비밀번호 찾기</a>	
						</span>
					</div>
					<div class="leave-body">
						<div class="panel-info-result">
							<ul>
								<li>
									<?php echo $_smarty_tpl->tpl_vars['documentData']->value['user_name'];?>
님의 이메일 주소 '<span><?php echo $_smarty_tpl->tpl_vars['documentData']->value['user_email'];?>
</span>' (으)로 비밀번호가 발송되었습니다.
								</li>
							</ul>				
						</div>
						<div class="panel-btn">
							<ul>
								<li data-id="confirm">확인</li>
							</ul>							
						</div>
					</div>																	
				</div>
				<div class="panel-notice">
					<ul>
						<li>기타 궁금한 사항이나 질문은 Q&amp;A 게시판을 이용해 주세요.</li>
					</ul>
				</div>		
			</div>			
		</div>		
	</div>
	<div class="footer">
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	</div>
</div>
<div class="ui-panel-msg"></div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
