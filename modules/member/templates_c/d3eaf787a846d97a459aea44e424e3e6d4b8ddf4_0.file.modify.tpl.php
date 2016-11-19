<?php
/* Smarty version 3.1.30, created on 2016-11-14 10:30:52
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/modify.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5829844cb1bcd6_79029988',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3eaf787a846d97a459aea44e424e3e6d4b8ddf4' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/modify.tpl',
      1 => 1479111486,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5829844cb1bcd6_79029988 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"회원정보수정 - StreamUX"), 0, true);
?>

<div class="articles ui-edgebox">
	<div class="member-edit">
		<div class="tt">
			<div class="imgbox">
				<h1>회원정보수정</h1>
			</div>
		</div>
		<div class="box">
			<form name="f_member_modify">
			<dl>
				<dt>
					<h2>기본정보입력</h2>
				</dt>
				<dd>
					<img src="../modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">발강색으로 표신된 부분은 반드시 입력해주세요.</span>			
				</dd>
			</dl>					
			<table summary="회원정보를 수정하세요.">
				<caption class="blind">회원정보수정</caption>
				<tbody>
					<tr>
						<td>
							<span>회</span>원그룹
							<input type="hidden" name="table_name" value="<?php echo $_smarty_tpl->tpl_vars['requestData']->value['table_name'];?>
">
							<input type="hidden" name="memberid" value="<?php echo $_smarty_tpl->tpl_vars['requestData']->value['memberid'];?>
">
						</td>
						<td>									
							<?php echo $_smarty_tpl->tpl_vars['requestData']->value['table_name'];?>

						</td>
					</tr>
					<tr>
						<td><span>아</span>이디</td>
						<td>
							<?php echo $_smarty_tpl->tpl_vars['requestData']->value['memberid'];?>

						</td>
					</tr>
					<tr>
						<td><span>비</span>밀번호</td>
						<td><input type="password" name="pwd1" size="10" maxlength="12"></td>
					</tr>
					<tr>
						<td><span>비</span>밀번호 확인</td>
						<td><input type="password" name="pwd2" size="10" maxlength="12"></td>
					</tr>
					<tr>
						<td><span>이</span>름</td>
						<td><input type="text" name="name" size="8" maxlength="10" value=""></td>
					</tr>
					<tr>
						<td><span>이</span>메일</td>
						<td><input type="text" name="email" size="12" maxlength="20">
						<select name="email_tail1">
							<option>직접입력</option>
							<option value="naver.com">naver.com</option>
							<option value="hanmail.com">hanmail.net</option>
							<option value="gmail.com">gmail.com</option>
						</select>
						<input type="text" name="email_tail2" size="12" maxlength="20" value=""> <span>[ 비밀번호 분실 시 사용됩니다. ]</span></td>
					</tr>
					<tr>
						<td><span>휴</span>대폰번호</td>
						<td>
							<input type="text" name="hp1" size="3" maxlength="3" value="">-
							<input type="text" name="hp2" size="4" maxlength="4" value="">-
							<input type="text" name="hp3" size="4" maxlength="4" value="">
						</td>
					</tr>
					<tr>
						<td>전화번호</td>
						<td>
							<input type="text" name="tel1" size="3" maxlength="3" value="">-
							<input type="text" name="tel2" size="4" maxlength="4" value="">-
							<input type="text" name="tel3" size="4" maxlength="4" value="">
						</td>
					</tr>							
					<tr>
						<td>회사이름</td>
						<td>
							<input type="text" name="company" size="12" maxlength="16" value="">
						</td>
					</tr>
				</tbody>
			</table>
			<dl>
				<dt>
					<h2>기타정보입력</h2>
				</dt>
				<dd>
					<img src="../modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">추가 정보를 입력해주세요.</span>			
				</dd>
			</dl>	
			<table summary="기타 회원정보를 수정하세요.">
				<caption class="blind">회원정보수정</caption>
				<tbody>
					<tr>
						<td>직업</td>
						<td>
							<select name=job>
								<option value="">선택하기</option>
								<option value=프리랜서>프리랜서</option>
								<option value=교수>교수</option>
								<option value=교사>교사</option>
								<option value=학생>학생</option>
								<option value=기업인>기업인</option>
								<option value=회사원>회사원</option>
								<option value=정치인>정치인</option>
								<option value=주부>주부</option>
								<option value=농어업>농어업</option>
								<option value=기타>기타</option>
						</select>
						</td>
					</tr>
					<tr>
						<td>취미</td>
						<td>
							<input type="checkbox" name="hobby" value="인터넷"><span>인터넷</span>
							<input type="checkbox" name="hobby" value="독서" ><span>독서</span>
							<input type="checkbox" name="hobby" value="여행" ><span>여행</span>
							<input type="checkbox" name="hobby" value="낚시" ><span>낚시</span>
							<input type="checkbox" name="hobby" value="바둑" ><span>바둑</span>
							<input type="checkbox" name="hobby" value="기타" ><span>기타</span>
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
