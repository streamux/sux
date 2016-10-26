<?php
/* Smarty version 3.1.30, created on 2016-10-24 11:37:37
  from "/Applications/MAMP/htdocs/sux/modules/popup/tpl/admin_add.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580dd6611eca76_33742152',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e032d38055c228b85d567df3d7bd6ae844fca617' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/popup/tpl/admin_add.tpl',
      1 => 1475136774,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580dd6611eca76_33742152 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 팝업 추가 - StreamUX"), 0, true);
?>

	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="add">
				<div class="tt">
					<div class="imgbox">
						<h1>팝업생성</h1>
					</div>
				</div>
				<div class="box">
					<form name="info_add" method="post">
					<dl>
						<dt>팝업생성 옵션설정</dt>
						<dd>
							<img src="../admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
							<span class="text-notice">발강색(별표)으로 표신된 부분은 반드시 입력해주세요.</span>			
						</dd>
					</dl>
					<table summary="팝업 정보를 입력해 생성해주세요.">
						<caption class="blind">팝업 정보 입력</caption>
						<tbody>
							<tr>
								<td><span>*</span> 팝업이름</td>
								<td>
									<input type="text" name="popup_name" size="20" maxlength="20">
								</td>
							</tr>
							<tr>
								<td>제목</td>

								<td>
									<input type="text" name="popup_title" size="30" maxlength="30">
								</td>
							</tr>
							<tr>
								<td>노출</td>
								<td>
									<select name="choice">
										<option value="n">n</option>
										<option value="y">y</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>시간</td>
								<td>
									<input type="text" name="time6" size="4" maxlength="4">
									<span>년</span>
									<input type="text" name="time4" size="2" maxlength="2">
									<span>월</span>
									<input type="text" name="time5" size="2" maxlength="2">
									<span>일</span>
									<input type="text" name="time1" size="2" maxlength="2">
									<span>시</span>
									<input type="text" name="time2" size="2" maxlength="2">
									<span>분</span>
									<input type="text" name="time3" size="2" maxlength="2">
									<span>초 까지</span>
									<span>※ 팝업창 닫을 시간을 정확하게 설정하세요.</span>
								</td>
							</tr>
							<tr>
								<td>스킨</td>
								<td>
									<select name="skin" id="skinList">
										<!--
										@ jquery templete
										@ name skinList_tmpl
										-->
									</select>
								</td>
							</tr>
							<tr>
								<td>팝업크기</td>
								<td>
									넓이
									<input type="text" name="popup_width" size="4" maxlength="3">
									<span>높이</span>
									<input type="text" name="popup_height" size="4" maxlength="3">
								</td>
							</tr>
							<tr>
								<td>팝업위치</td>
								<td>
									<span>상단</span>
									<input type="text" name="popup_top" size="4" maxlength="3">
									<span>좌측</span>
									<input type="text" name="popup_left" size="4" maxlength="3">
									<span>※ 모니터 기준</span>
								</td>
							</tr>		
							<tr>
								<td>내용여백</td>
								<td>
									<span>상단</span>
									<input type="text" name="skin_top" size="4" maxlength="3">
									<span>좌측</span>
									<input type="text" name="skin_left" size="4" maxlength="3">
									<span>우측</span>
									<input type="text" name="skin_right" size="4" maxlength="3">
								</td>
							</tr>						
							<tr>
								<td>수정내용</td>
								<td>
									<textarea name="comment" cols="25" rows="6"></textarea>
									<span>※ 팝업에 들어갈 내용을 입력해주세요.</span>
								</td>
							</tr>
						</tbody>
					</table>
					
					<input type="submit" name="submit" size="10" value="확 인">
					<input type="button" name="cancel" size="10" value="취 소">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo '<script'; ?>
 type="jquery-templete" id="skinList_tmpl">
	<option>${file_name}</option>
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
