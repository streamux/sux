<?php
/* Smarty version 3.1.30, created on 2016-10-24 09:29:25
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/delete_tail.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580db8552f9652_27566648',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54879da8d9be873d36e0a71d1364c59dcdd85345' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/delete_tail.tpl',
      1 => 1477294163,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580db8552f9652_27566648 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('contentData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
$_smarty_tpl->_assignInScope('boardTitle', $_smarty_tpl->tpl_vars['groupData']->value['board_name']);
$_smarty_tpl->_assignInScope('tailData', $_smarty_tpl->tpl_vars['documentData']->value['tails']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_assignInScope('opkeySkinPath', $_smarty_tpl->tpl_vars['skinPathList']->value['opkey']);
$_smarty_tpl->_assignInScope('tailSkinPath', $_smarty_tpl->tpl_vars['skinPathList']->value['tail']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->tpl_vars['boardTitle']->value)." :: 게시물 댓글삭제 - StreamUX"), 0, true);
?>

<div class="article-box ui-edgebox">
	<div class="login">
		<h1 class="title">댓글 삭제 비밀번호 인증</h1>
		<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

		<form action="board.php?board=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board'];?>
&board_grg=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['board_grg'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['id'];?>
&grgid=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['grgid'];?>
&igroup=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['igroup'];?>
&passover=<?php echo $_smarty_tpl->tpl_vars['requestData']->value['passover'];?>
&action=recordDeleteTail" method="post" name="f_board_tail_delpass" onSubmit="return jsux.fn.delete.checkDocumentForm(this);">			
		<div class="box ui-edgebox-2px">
			<div class="login-title">
				<img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/icon_01.gif" title="">			
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
						<li><span class="ui-label"><label for="pass">비밀번호</label></span><input type="password" name="pass" id="pass" maxlength="20"class="input-pwd"></li>
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
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
