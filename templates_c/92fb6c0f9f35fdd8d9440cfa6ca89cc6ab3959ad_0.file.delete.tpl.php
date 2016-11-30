<?php
/* Smarty version 3.1.30, created on 2016-11-29 13:09:33
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/delete.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583d6ffdd31924_99247128',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92fb6c0f9f35fdd8d9440cfa6ca89cc6ab3959ad' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/delete.tpl',
      1 => 1480421359,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_583d6ffdd31924_99247128 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('groupData', $_smarty_tpl->tpl_vars['documentData']->value['group']);
$_smarty_tpl->_assignInScope('boardTitle', $_smarty_tpl->tpl_vars['groupData']->value['board_name']);
$_smarty_tpl->_assignInScope('contentData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
$_smarty_tpl->_assignInScope('uri', $_smarty_tpl->tpl_vars['documentData']->value['uri']);
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->tpl_vars['boardTitle']->value)." :: 게시물 삭제 - StreamUX"), 0, true);
?>

<div class="article-box ui-edgebox">	
	<div class="login">
		<h1 class="title">게시물 삭제 비밀번호 인증</h1>
		<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

		<form action="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;
echo $_smarty_tpl->tpl_vars['contentData']->value['category'];?>
/<?php echo $_smarty_tpl->tpl_vars['contentData']->value['id'];?>
/delete" method="post" name="f_board_delpass">
		<input type="hidden" name="_method" value="delete">
		<div class="box ui-edgebox-2px">
			<div class="login-title">
				<img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/icon_01.gif" title="" alt="">			
				<span class="link-searchinfo">
					<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
search-id">아이디</a> | <a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
search-password">비밀번호 찾기</a>
				</span>
			</div>
			<div class="login-body">
				<div class="panel-info">
					<ul>
						<li><span class="ui-label">이름</span><?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_name'];?>
<input type="hidden" name="name" maxlength="14" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_name'];?>
"></li>
						<li><span class="ui-label">비밀번호</span><input type="password" name="password" maxlength="20"></li>
					</ul>							
				</div>
				<div class="panel-btn">
					<input type="submit" name="btn_confirm" value="삭 제">
					<input type="button" name="btn_cancel" value="취 소" onclick="history.back();">
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
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
