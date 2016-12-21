<?php
/* Smarty version 3.1.30, created on 2016-11-21 08:21:47
  from "/Applications/MAMP/htdocs/sux/modules/install/tpl/terms.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5832a08b06db81_20323874',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9a010cfd2f912ab890c6dd472ef03d45c75c936' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/install/tpl/terms.tpl',
      1 => 1479702325,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5832a08b06db81_20323874 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('skinDir', $_smarty_tpl->tpl_vars['skinPathList']->value['skin_dir']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX 설치 : 약관동의 - StreamUX"), 0, true);
?>

<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/install/tpl/images/logo.png" alt="streamxux">	
		</h1>	
	</div>
	<div class="container">
		<div class="article-box ui-edgebox">
			<p>
				<span>streamux에 대한 라이센스 명시입니다.<br>
				아래 라이센스에 동의하시는 분만 sux보드를 사용할수 있습니다.</span>
			</p>
			<p>
				----------------------------------------------------<br>
				<span>
				프로그램명 : sux special board<br>
				배포버젼 : 0.2.0 (since 2007. 1. 3)<br>
				개발자 : jeong chae-yoon <br>
				Homepage : http://www.streamux.com<br>
				</span>
				---------------------------------------------------
			</p>

			<span>1. 스트림유엑스의 배포권은 streamux.com에서 허용한 곳에만 있습니다.
			(허락 맡지 않은 재배포는 허용하지 않습니다.)<br>
			2. 링크서비스등의 기본 용도에 맞지 않는 사용은 금지합니다.<br>
			3. 스트림유엑스의 사용으로 인한 데이타 손실 및 기타 손해등 어떠한 사고나 문제에 대해서 streamux.com은 절대 책임을 지지 않습니다.<br>
			4. 스트림유엑스에 대해 streamux.com은 유지/ 보수의 의무가 없습니다.<br>
			5. 스트림유엑스 소스는 개인적으로 사용시 수정하여 사용할수 있지만 수정된 프로그램의 재배포는 금지합니다.<br>
			6. 기타 의문사항은 http://streamux.com 을 이용해 주시기 바랍니다.
			(질문등에 대한 내용은 메일로 받지 않습니다)</span>				
		</div>
		<a href="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
setup-db"><img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/install/tpl/images/btn_agree.gif" width="51" height="23" border="0" alt="동의합니다."></a>
	</div>
	<div class="footer">
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['copyrightPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	</div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
