<?php
/* Smarty version 3.1.30, created on 2016-09-25 05:04:23
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/delpass.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e73eb7c01f69_07738455',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3b66fd700849224b46ba0d9143da310c4284f82' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/delpass.tpl',
      1 => 1474772662,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e73eb7c01f69_07738455 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('groupData', $_smarty_tpl->tpl_vars['documentData']->value['group']);
$_smarty_tpl->_assignInScope('contentData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"게시물 삭제 - StreamUX"), 0, true);
?>

<div class="container">		
	<div class="article-box ui-edgebox">	
		<div class="login">
			<h2 class="title">게시물 비밀번호 인증</h2>
			<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

			<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&action=record_delete" method="post" name="f_board_delpass" onSubmit="return jsux.fn.deletepass.checkDocumentForm(this);">
			<div class="box ui-edgebox-2px">
				<div class="login-title">
					<img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/icon_01.gif" title="" alt="">			
					<span class="link-searchinfo">
						<a href="../login/login.php?action=searchid">아이디</a> | <a href="../login/login.php?action=searchpwd">비밀번호 찾기</a>
					</span>
				</div>
				<div class="login-body">
					<div class="panel-info">
						<ul>
							<li><span class="ui-label">이름</span><?php echo $_smarty_tpl->tpl_vars['contentData']->value['name'];?>
<input type="hidden" name="name" maxlength="14" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['name'];?>
"class="input-id"></li>
							<li><span class="ui-label">비밀번호</span><input type="password" name="pass" maxlength="20"class="input-pwd"></li>
						</ul>							
					</div>
					<div class="panel-btn">
						<ul>
							<li data-id="send">삭제</li>
							<li data-id="cancel">취소</li>
						</ul>							
					</div>			
				</div>																	
			</div>
			</form>
			<div class="panel-login-fail">
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
				</dl><dl>
					<dt>서비스 이용안내</dt>
					<dd>서비스를 이용하시려면 먼저 로그인을 해주세요.</dd>
				</dl>
			</div>					
		</div>			
	</div>		
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
