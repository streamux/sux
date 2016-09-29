<?php
/* Smarty version 3.1.30, created on 2016-09-23 05:21:44
  from "/Applications/MAMP/htdocs/sux/modules/install/tpl/admin_setup.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57e49fc81bc1d9_61940461',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c83ab6173838725f4670d49a7db58aaf7ac9039' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/install/tpl/admin_setup.tpl',
      1 => 1474600890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57e49fc81bc1d9_61940461 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX 설치 : 관리자 기본정보 설정 - StreamUX"), 0, true);
?>

<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="tpl/images/logo.png" alt="streamxux">	
		</h1>
	</div>
	<div class="container">
		<form>
		<div class="article-box ui-edgebox">			
			<table summary="관리자 정보를 입력해주세요.">
				<caption>
					<span class="hide">관리자 기본정보 설정입니다.</span>
				</caption>
				<colgroup>
					<col width="40%"></col>
					<col width="60%"></col>
				</colgroup>
				<thead>
					<tr>
						<th colspan="2">
							<span>관리자 기본정보 설정</span>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>관</span>리자 아이디</td>
						<td><input type="text" name="admin_id"></td>
					</tr>
					<tr>
						<td><span>관</span>리자 비밀번호</td>
						<td><input type="password" name="admin_pwd"></td>
					</tr>
					<tr>
						<td>관리자 이메일</td>
						<td><input type="text" name="admin_email"></td>
					</tr>					
					<tr>
						<td>홈페이지 주소</td>
						<td><input type="text" name="yourhome" size="50"></td>
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
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['skinDir']->value)."/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}
