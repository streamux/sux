<?php
/* Smarty version 3.1.30, created on 2017-01-05 11:03:49
  from "/Applications/MAMP/htdocs/sux/modules/document/tpl/admin_modify.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_586e1a0526a678_99273219',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17f35bb3129d092716f8f78f9db836161a84d098' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/document/tpl/admin_modify.tpl',
      1 => 1483518983,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_586e1a0526a678_99273219 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 페이지 수정 - StreamUX"), 0, true);
?>

<div class="articles ui-edgebox">
	<div class="add">
		<div class="tt">
			<div class="imgbox">
				<h1>페이지 옵션수정</h1>
			</div>
		</div>
		<div class="box">
			<form action="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
document-admin/modify" name="f_document_admin_modify" method="post">
			<input type="hidden" name="_method" value="update">
			<dl>
				<dt>세부옵션 설정</dt>
				<dd>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">발강색(별표)으로 표신된 부분은 반드시 입력해주세요.</span>			
				</dd>
			</dl>
			<table summary="페이지 정보를 입력해 생성해주세요.">
				<tr>
						<td>
							*카테고리 이름
							<input type="hidden" name="category" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['category'];?>
">
							<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['documentData']->value['id'];?>
">			
						</td>
						<td>
							<?php echo $_smarty_tpl->tpl_vars['documentData']->value['category'];?>
		
						</td>
					</tr>
					<tr>
						<td><label for="document_name">*페이지 이름</label></td>
						<td>
							<input type="text" id="document_name" name="document_name" size="20" maxlength="20" value="">
						</td>
					</tr>
					<tr>
						<td><label for="summary">페이지 설명</label></td>
						<td>
							<input type="text" id="summary" name="summary" size="25" maxlength="50" value="">
						</td>
					</tr>
					<tr>
						<td><label for="is_readable">읽기 허용</label></td>
						<td>
							<select name="is_readable">
								<option value="y">yes</option>
								<option value="n">no</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="document_width">페이지 넓이</label></td>
						<td>
							<input type="text" id="document_width" name="document_width" size="10" maxlength="12" value="">
						</td>
					</tr>					
					<tr>
						<td><label for="header_path">상단 경로</label></td>
						<td>
							<input type="text" id="header_path" name="header_path" size="25" maxlength="50" value="">
						</td>
					</tr>
					<tr>
						<td><label for="contents_path">컨텐츠 경로</label></td>
						<td>
							<input type="text" id="contents_path" name="contents_path" size="25" maxlength="50" value="">
						</td>
					</tr>
					<tr>
						<td><label for="contents">컨텐츠 내용</label></td>
						<td>
							<textarea id="contents" name="contents" rows="10"></textarea>
							<p>컨텐츠 내용을 입력하세요.</p>
						</td>
					</tr>
					<tr>
						<td><label for="footer_path">하단 경로</label></td>
						<td>
							<input type="text" id="footer_path" name="footer_path" size="25" maxlength="50" value="">
						</td>
					</tr>
				</tbody>
			</table>
			
			<input type="submit" name="submit" size="10" value="수 정">
			<input type="button" name="cancel" value="취 소">
			</form>
		</div>
	</div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
