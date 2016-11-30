<?php
/* Smarty version 3.1.30, created on 2016-11-21 07:53:49
  from "/Applications/MAMP/htdocs/sux/modules/install/tpl/db_setup.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_583299fdda75f1_69752824',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e11a633e204276f769d77e7e47ee2a51689e6ee7' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/install/tpl/db_setup.tpl',
      1 => 1479711226,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_583299fdda75f1_69752824 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('skinDir', $_smarty_tpl->tpl_vars['skinPathList']->value['skin_dir']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX 설치 : DB 계정정보 설정 - StreamUX"), 0, true);
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
		<form name="f_setup_db" action="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
setup-db" method="post">
		<input type="hidden" name="_method" value="insert">	
		<div class="article-box ui-edgebox">
			<h1>데이터 베이스 설정</h1>
			<ul>
				<li>
					<fieldset>
						<label for="db_hostname">* 호스트명</label>
						<input type="text" id="db_hostname" name="db_hostname" value="localhost">
					</fieldset>	
				</li>
				<li>
					<fieldset>
						<label for="db_userid">* 사용자계정</label>
						<input type="text" id="db_userid" name="db_userid" value="root">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="db_password">* 비밀번호</label>
						<input type="password" id="db_password" name="db_password">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="db_database">* DB이름</label>
						<input type="text" id="db_database" name="db_database" value="streamuxcom">
					</fieldset>
				</li>
				<li>
					<fieldset>
						<label for="db_table_prefix">* 테이블 접두사</label>
						<input type="text" id="db_table_prefix" name="db_table_prefix" value="sux">
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
<div class="ui-panel-msg"></div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
