<?php
/* Smarty version 3.1.30, created on 2016-10-13 07:49:39
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/leave.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57ff2073d41483_81363982',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c26660f6d33623d61d76c6f0a33adb22c410f26d' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/leave.tpl',
      1 => 1476337679,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ff2073d41483_81363982 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"회원탈퇴 - StreamUX"), 0, true);
?>

<div class="article-box ui-edgebox">				
	<div class="login">
		<h1 class="title">회원 탈퇴</h1>
		<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

		<form name="f_loginleave">
		<div class="box ui-edgebox-2px">
			<div class="leave-header">
				<img src="tpl/images/icon_01.gif" alt="">						
				<span>비밀번호 확인</span>
			</div>
			<div class="leave-body">
				<div class="panel-info">
					<ul>
						<li>
							<input type="hidden" name="member" value="<?php echo $_smarty_tpl->tpl_vars['sessionData']->value['ljs_member'];?>
"><span class="ui-label">아이디</span><span><?php echo $_smarty_tpl->tpl_vars['sessionData']->value['ljs_memberid'];?>
</span><input type="hidden" name="memberid" value="<?php echo $_smarty_tpl->tpl_vars['sessionData']->value['ljs_memberid'];?>
">
						</li>
						<li>
							<span class="ui-label"><label for="pass">비밀번호</label></span><input type="password" id="pass" name="pass" maxlength="20">
						</li>
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
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
