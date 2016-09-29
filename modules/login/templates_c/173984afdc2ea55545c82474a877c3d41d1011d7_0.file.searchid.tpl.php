<?php
/* Smarty version 3.1.30, created on 2016-09-26 08:03:36
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/searchid.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e8ba384bee97_73632152',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '173984afdc2ea55545c82474a877c3d41d1011d7' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/searchid.tpl',
      1 => 1474869766,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e8ba384bee97_73632152 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"아이디 찾기 - StreamUX"), 0, true);
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
				<h1 class="title">아이디 찾기</h1>
				<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
				<form action="login.php?action=searchid" name="f_searchid" method="post" onSubmit="return jsux.fn.searchid.checkForm(this);">
				<div class="box ui-edgebox-2px">
					<div class="leave-header">
						<img src="tpl/images/icon_01.gif" title="">						
						<span>회원그룹</span>
						<select name="member" id="ljsMember">
							<!-- templete -->
						</select>
						<span class="link-searchinfo">
							<a href="login.php?action=searchID">아이디</a> | <a href="login.php?action=searchPassword">비밀번호 찾기</a>	
						</span>
					</div>
					<div class="leave-body">
						<div class="panel-info">
							<ul>
								<li><span class="ui-label">이름</span><input type="text" name="user_name" maxlength="14" value=""></li>
								<li><span class="ui-label">E-Mail 주소</span><input type="text" name="user_email" maxlength="20"></li>
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
				<div class="panel-notice">
					<ul>
						<li><span>위 사항을 입력해 주세요.</span></li>
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
<?php echo '<script'; ?>
 type="text/javascript">
	var loginObj = loginObj || {};
	loginObj.memberList = <?php echo $_smarty_tpl->tpl_vars['documentData']->value['group'];?>
;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="x-jquery-templete" id="ljsMember_tmpl">
	<option>${name}</option>
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
