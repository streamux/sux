<?php
/* Smarty version 3.1.30, created on 2016-11-18 06:14:37
  from "/Applications/MAMP/htdocs/sux/modules/install/tpl/admin_setup.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582e8e3dcfd3d0_33100582',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c83ab6173838725f4670d49a7db58aaf7ac9039' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/install/tpl/admin_setup.tpl',
      1 => 1479446074,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_582e8e3dcfd3d0_33100582 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('skinDir', $_smarty_tpl->tpl_vars['skinPathList']->value['skin_dir']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX 설치 : 관리자 기본정보 설정 - StreamUX"), 0, true);
?>

<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="../modules/install/tpl/images/logo.png" alt="streamxux">	
		</h1>
	</div>
	<div class="container">
		<form>
		<div class="article-box ui-edgebox">	
			<h1>관리자 기본정보 설정</h1>
			<ul>
				<li>
					<fieldset>
						<label for="admin_id">* 관리자 아이디</label>
						<input type="text" id="admin_id" name="admin_id" value="admin">
					</fieldset>	
				</li>
				<li>
					<fieldset>
						<label for="admin_pwd">* 관리자 비밀번호</label>
						<input type="password" id="admin_pwd" name="admin_pwd">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="admin_email">* 관리자 이메일</label>
						<input type="text" id="admin_email" name="admin_email" value="streamux@naver.com">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="yourhome">* 홈페이지 주소</label>
						<input type="text" id="yourhome" name="yourhome" value="localhost">
					</fieldset>
				</li>
			</ul>
		</div>
		<input type="submit" value=' 다 음 ' class="btn-submit">
		</form>
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
