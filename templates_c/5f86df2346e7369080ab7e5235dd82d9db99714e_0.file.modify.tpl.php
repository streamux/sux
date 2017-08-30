<?php
/* Smarty version 3.1.31, created on 2017-08-30 12:02:57
  from "/Applications/MAMP/htdocs/sux/modules/member/tpl/modify.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59a68d51dd4dc4_11147599',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5f86df2346e7369080ab7e5235dd82d9db99714e' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/member/tpl/modify.tpl',
      1 => 1504087328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a68d51dd4dc4_11147599 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_assignInScope('contentsData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
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
			<form name="f_member_modify" action="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
member-modify" method="post">
			<input type="hidden" name="_method" value="update">
			<dl>
				<dt>
					<h2>기본정보입력</h2>
				</dt>
				<dd>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">발강색으로 표신된 부분은 반드시 입력해주세요.</span>			
				</dd>
			</dl>					
			<table summary="회원정보를 수정하세요.">
				<caption class="blind">회원정보수정</caption>
				<tbody>
					<tr>
						<td>회원그룹</td>
						<td>
							<input type="hidden" name="category" value="<?php echo $_smarty_tpl->tpl_vars['sessionData']->value['category'];?>
">		
							<?php echo $_smarty_tpl->tpl_vars['sessionData']->value['category'];?>

						</td>
					</tr>
					<tr>
						<td>아이디</td>
						<td>
							<input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['sessionData']->value['user_id'];?>
">
							<?php echo $_smarty_tpl->tpl_vars['sessionData']->value['user_id'];?>

						</td>
					</tr>
					<tr>
						<td>비밀번호</td>
						<td><input type="password" name="password" size="10" maxlength="12"></td>
					</tr>
					<tr>
						<td>비밀번호 확인</td>
						<td><input type="password" name="passwordConf" size="10" maxlength="12"></td>
					</tr>
					<tr>
						<td>이름</td>
						<td><input type="text" name="user_name" size="8" maxlength="10" value="<?php echo $_smarty_tpl->tpl_vars['contentsData']->value['user_name'];?>
"></td>
					</tr>
					<tr>
						<td>닉네임</td>
						<td><input type="text" name="nick_name" size="8" maxlength="10" value="<?php echo $_smarty_tpl->tpl_vars['contentsData']->value['nick_name'];?>
"></td>
					</tr>
					<tr>
						<td>이메일</td>
						<td><input type="text" name="email_address" size="12" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['contentsData']->value['email'];?>
">
						<select name="email_tail1">
							<option>직접입력</option>
							<option value="naver.com">naver.com</option>
							<option value="hanmail.com">hanmail.net</option>
							<option value="gmail.com">gmail.com</option>
						</select>
						<input type="text" name="email_tail2" size="12" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['contentsData']->value['email_tail2'];?>
"> <span>[ 비밀번호 분실 시 사용됩니다. ]</span></td>
					</tr>
					<tr>
						<td><span>휴</span>대폰번호</td>
						<td>
							<input type="text" name="hp1" size="3" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['contentsData']->value['hp1'];?>
">-
							<input type="text" name="hp2" size="4" maxlength="4" value="<?php echo $_smarty_tpl->tpl_vars['contentsData']->value['hp2'];?>
">-
							<input type="text" name="hp3" size="4" maxlength="4" value="<?php echo $_smarty_tpl->tpl_vars['contentsData']->value['hp3'];?>
">
						</td>
					</tr>
				</tbody>
			</table>
			<dl>
				<dt>
					<h2>기타정보입력</h2>
				</dt>
				<dd>
					<img src="<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">추가 정보를 입력해주세요.</span>			
				</dd>
			</dl>	
			<table summary="기타 회원정보를 수정하세요.">
				<caption class="blind">회원정보수정</caption>
				<tbody>
					<tr>
						<td>직업</td>
						<td>
							<select name="job">								
								<option value="">선택하기</option>
								<?php $_smarty_tpl->_assignInScope('jobList', array('프리랜서','교수','교사','학생','기업인','회사원','정치인','주부','농어업','기타'));
?>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jobList']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>							
									<option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['contentsData']->value['job'] === $_smarty_tpl->tpl_vars['value']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

							</select>
							
						</td>
					</tr>
					<tr>
						<td>취미</td>
						<td>
							<?php $_smarty_tpl->_assignInScope('hobbyBoxes', array('인터넷','독서','여행','낚시','바둑','기타'));
?>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hobbyBoxes']->value, 'mItem', false, NULL, 'hobby', array (
  'index' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['mItem']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_hobby']->value['index']++;
?>
								<?php $_smarty_tpl->_assignInScope('index', (isset($_smarty_tpl->tpl_vars['__smarty_foreach_hobby']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_hobby']->value['index'] : null));
?>
								<?php $_smarty_tpl->_assignInScope('isChecked', '');
?>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contentsData']->value['hobby'], 'compareItem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['compareItem']->value) {
?>
									<?php if ($_smarty_tpl->tpl_vars['mItem']->value === $_smarty_tpl->tpl_vars['compareItem']->value) {?>
										<?php $_smarty_tpl->_assignInScope('isChecked', 'checked');
?>
									<?php }?>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

								<label for="hobby<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"></label>
								<input type="checkbox" id="hobby<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" name="hobby<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['mItem']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['isChecked']->value;?>
><span><?php echo $_smarty_tpl->tpl_vars['mItem']->value;?>
</span>
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

						</td>
					</tr>
				</tbody>
			</table>
			<input type="submit" name="submit" size="10" value="확 인">
			<input type="button" name="cancel" value="취 소" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
login'">
			</form>
		</div>
	</div>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
