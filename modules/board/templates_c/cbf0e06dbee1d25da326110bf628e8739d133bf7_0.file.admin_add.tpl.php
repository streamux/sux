<?php
/* Smarty version 3.1.30, created on 2016-10-12 01:41:38
  from "/Applications/MAMP/htdocs/sux/modules/board/tpl/admin_add.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57fd78b298f2c9_05738236',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cbf0e06dbee1d25da326110bf628e8739d133bf7' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/tpl/admin_add.tpl',
      1 => 1475300888,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57fd78b298f2c9_05738236 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"SUX관리자 게시판 추가 - StreamUX"), 0, true);
?>

<div class="container">	
		<div class="articles ui-edgebox">
			<div class="add">
				<h2 class="blind">게시판 추가</h2>
				<div class="tt">
					<div class="imgbox">
						<span>게시판생성</span>
					</div>
				</div>
				<div class="box">
					<form>
					<dl>
						<dt>게시판 생성 및 게시판 컨트롤 세부설정</dt>
						<dd>
							<img src="../admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
							<span class="text-notice">발강색(별표)으로 표신된 부분은 반드시 입력해주세요.</span>			
						</dd>
					</dl>
					<table summary="게시판 정보를 입력해 생성해주세요.">
						<caption class="blind">게시판 정보 입력</caption>
						<tbody>
							<tr>
								<td><span>*</span> 테이블 이름</td>
								<td>
									<input type="text" name="table_name" size="20" maxlength="20">
									<input type="button" name="checkID" value='중복체크'>
									<span>※ 반드시 영문으로 작성해주세요.</span>
								</td>
							</tr>
							<tr>
								<td><span>*</span> 게시판 이름</td>

								<td>
									<input type="text" name="board_name" size="16" maxlength="16" value="">
								</td>
							</tr>
							<tr>
								<td>넓이</td>
								<td>
									<input type="text" name="width" size="10" maxlength="12" value="100%">
								</td>
							</tr>
							<tr>
								<td>상단 경로</td>
								<td>
									<input type="text" name="include1" size="25" maxlength="50">
								</td>
							</tr>
							<tr>
								<td>스킨</td>
								<td>
									<select name="include2" id="skinList">
										<!--
										@ jquery templete
										@ name skinList_tmpl
										-->
									</select>
								</td>
							</tr>
							<tr>
								<td>하단 경로</td>
								<td>
									<input type="text" name="include3" size="25" maxlength="50">
								</td>
							</tr>
							<tr>
								<td>비회원 권한</td>
								<td>
									<select name="log_key">
										<option>yes</option>
										<option>no</option>
									</select>
									<span>이용가능 : yes / 불가능 : no</span>
								</td>
							</tr>
							<tr>
								<td>사용가능 레벨</td>
								<td>
									<span>쓰기</span>
									<select name="w_grade">
										<option>0</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
									</select>
									<span>읽기</span>
									<select name="r_grade">
										<option>0</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
									</select>
									<span>수정</span>
									<select name="rw_grade">
										<option>0</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
									</select>
									<span>답변</span>
									<select name="re_grade">
										<option>0</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
									</select>
								</td>
							</tr>							
							<tr>
								<td>사용가능 옵션</td>
								<td>
									<span>쓰기</span>
									<input type="text" name="w_admin" size="2" maxlength="1" value="y">
									<span>읽기</span>
									<input type="text" name="r_admin" size="2" maxlength="1" value="y">
									<span>수정</span>
									<input type="text" name="rw_admin" size="2" maxlength="1" value="y">
									<span>답변</span>
									<input type="text" name="re_admin" size="2" maxlength="1" value="y">
									<span>허용:y 허용안함:n</span>
								</td>
							</tr>
							<tr>
								<td>글목록 수</td>
								<td>
									<input type="textfield" name="listnum" value="10" size="3" maxlength="2">
									<span>※ 게시판 리스트에 출력할 글목록 수를 설정해주세요.</span>
								</td>
							</tr>
							<tr>
								<td>부분 출력</td>
								<td>
									<span>꼬리글</span>
									<input type="text" name="tail" size="2" maxlength="1" value="n">
									<span>다운로드</span>
									<input type="text" name="download" size="2" maxlength="1" value="n">
									<span>진행상황</span>
									<input type="text" name="setup" size="2" maxlength="1" value="n">
								</td>
							</tr>
							<tr>
								<td>최근게시물</td>
								<td>
									<input type="radio" name="output" value="yes">
									<span>출력</span>
									<input type="radio" name="output" value="no" checked>
									<span>출력안함</span>
								</td>
							</tr>
							<tr>
								<td>게시판형식</td>
								<td>
									<input type="radio" name="type" value="html">
									<span>HTML</span>
									<input type="radio" name="type" value="text">
									<span>TEXT</span>
									<input type="radio" name="type" value="all" checked>
									<span>HTML + TEXT</span>
								</td>
							</tr>
							<tr>
								<td>불량단어 범위</td>
								<td>									
									<input type="radio" name="limit_choice" value="title" checked>
									<span>제목</span>									
									<input type="radio" name="limit_choice" value="comment">
									<span>내용</span>									
									<input type="radio" name="limit_choice" value="all">
									<span>제목+내용</span>
								</td>
							</tr>
							<tr>
								<td>불량단어</td>
								<td>
									<textarea name="limit_word" cols="25" rows="6">광고, 대출</textarea>
									<span>※ 단어 구분은 반드시 콤마(,)로 해주세요.</span>
								</td>
							</tr>
						</tbody>
					</table>					
					<input type="submit" name="submit" size="10" value="확 인">
					<input type="button" name="cancel" value="취 소">
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