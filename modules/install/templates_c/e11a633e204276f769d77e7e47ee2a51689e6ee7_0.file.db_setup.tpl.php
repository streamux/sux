<?php
/* Smarty version 3.1.30, created on 2016-09-23 05:21:14
  from "/Applications/MAMP/htdocs/sux/modules/install/tpl/db_setup.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e49faa08fe68_52406283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e11a633e204276f769d77e7e47ee2a51689e6ee7' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/install/tpl/db_setup.tpl',
      1 => 1474600869,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e49faa08fe68_52406283 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX 설치 : DB 계정정보 설정 - StreamUX"), 0, true);
?>

<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="tpl/images/logo.png" alt="streamxux">	
		</h1>	
	</div>
	<div class="container">	
		<form name="f_db_setup">	
		<div class="article-box ui-edgebox">			
			<table summary="데이터베이스 정보를 입력해주세요." class="db_form">
				<caption>
					<span class="hide">데이터베이스 계정정보 설정입니다.</span>
				</caption>
				<colgroup>
					<col width="30%"></col>
					<col width="70%"></col>
				</colgroup>
				<thead>
					<tr>
						<th colspan="2">
							<span>데이터페이스 설정</span>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>호</span>스트명</td>
						<td><input type="text" name="db_hostname" value="localhost"></td>
					</tr>
					<tr>
						<td><span>사</span>용자계정</td>
						<td><input type="text" name="db_userid"></td>
					</tr>
					<tr>
						<td><span>비</span>밀번호</td>
						<td><input type="password" name="db_password"></td>
					</tr>
					<tr>
						<td><span>D</span>B명</td>
						<td><input type="text" name="db_database"></td>
					</tr>
				</tbody>
			</table>			
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
