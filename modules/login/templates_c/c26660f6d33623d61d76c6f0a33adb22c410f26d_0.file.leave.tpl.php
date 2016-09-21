<?php
/* Smarty version 3.1.30, created on 2016-09-21 12:41:22
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/leave.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e263d2bdb855_24840718',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c26660f6d33623d61d76c6f0a33adb22c410f26d' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/leave.tpl',
      1 => 1474454407,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e263d2bdb855_24840718 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="tpl/images/logo.png" alt="streamxux">	
		</h1>	
	</div>
	<div class="container">		
		<div class="article-box ui-edgebox">			
			<h2 class="blind">회원 탈퇴</h2>		
			<div class="login">
				<span class="title">회원 탈퇴</span>
				<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

				<form name="loginleave">
				<div class="box ui-edgebox-2px">
					<div class="login-title">
						<img src="tpl/images/icon_01.gif" alt="">						
						<span>비밀번호 확인</span>
					</div>
					<div class="leave-body">
						<div class="panel-info">
							<ul>
								<li><input type="hidden" name="member" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['sessions']['ljs_member'];?>
"><span class="ui-label">아이디</span><span><?php echo $_smarty_tpl->tpl_vars['documentData']->value['sessions']['ljs_memberid'];?>
</span><input type="hidden" name="memberid" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['sessions']['ljs_memberid'];?>
"></li>
								<li><span class="ui-label">비밀번호</span><input type="password" name="pass" maxlength="20"class="input-pwd"></li>
							</ul>							
						</div>
						<div class="panel-btn">
							<ul>
								<li data-id="send">보내기</li>
								<li data-id="cancel">취소</li>
							</ul>
						</div>				
					</div>																	
				</div>
				</form>
				<div class="panel-fail">
					<ul>
						<li><span>아이디와 비밀번호가 일치하지 않습니다.</span></li>
						<li><span>아이디와 비밀번호를 정확하게 입력해주세요.</span></li>
						<li>만일 회원가입을 하지 않고, 로그인을 하셨다면 회원가입을 먼저 해주세요.</li>
					</ul>
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

<?php echo '<script'; ?>
 type="x-jquery-templete" id="ljsMember_tmpl">
	<option>${label}</option>
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
