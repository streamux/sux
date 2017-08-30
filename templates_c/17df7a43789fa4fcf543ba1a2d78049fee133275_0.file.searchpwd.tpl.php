<?php
/* Smarty version 3.1.31, created on 2017-08-30 11:30:43
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/searchpwd.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59a685c35bd350_75794692',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17df7a43789fa4fcf543ba1a2d78049fee133275' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/searchpwd.tpl',
      1 => 1483518983,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a685c35bd350_75794692 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"비밀번호 찾기 - StreamUX"), 0, true);
?>

<div class="article-box ui-edgebox">	
	<div class="login">
		<h1 class="title">비밀번호 찾기</h1>
		<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
		<form action="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
search-password" name="f_searchpwd" method="post">
		<input type="hidden" name="_method" value="select">
		<div class="box ui-edgebox-2px">
			<div class="leave-header">
				<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/login/tpl/images/icon_01.gif" title="">						
				<span>회원그룹</span>
				<select name="category" id="memberGroup">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['documentData']->value['group'], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
						<option><?php echo $_smarty_tpl->tpl_vars['value']->value['category'];?>
</option>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

				</select>
				<span class="link-searchinfo">
					<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
search-id">아이디</a> | <a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
search-password">비밀번호 찾기</a>	
				</span>
			</div>
			<div class="leave-body">
				<div class="panel-info">
					<ul>
						<li><span class="ui-label">이름</span><input type="text" name="user_name" maxlength="14" value=""></li>
						<li><span class="ui-label">아이디</span><input type="text" name="user_id" maxlength="14" value=""></li>
						<li><span class="ui-label">E-Mail 주소</span><input type="text" name="email_address" maxlength="20" value=""></li>
					</ul>				
				</div>
				<div class="panel-btn">
					<input type="submit" name="btn_confirm" value="확 인">
					<input type="button" name="btn_cancel" value="취 소" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
login'">
				</div>
			</div>																	
		</div>
		</form>
		<div class="panel-notice">
			<ul>
				<li><span>위 사항을 입력해 주세요.</span></li>
				<li>기타 궁금한 사항이나 질문은 Q&amp;A 게시판을 이용해 주세요.</li>
			</ul>
		</div>		
	</div>			
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
