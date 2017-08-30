{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 게시판 수정 - StreamUX"}
<div class="articles ui-edgebox">
	<div class="add">
		<div class="tt">
			<div class="imgbox">
				<h1>게시판 옵션수정</h1>
			</div>
		</div>
		<div class="box">
			<form action="{$rootPath}board-admin/modify" name="f_board_admin_modify" method="post">
			<input type="hidden" name="_method" value="update">
			<dl>
				<dt>세부옵션 설정</dt>
				<dd>
					<img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">발강색(별표)으로 표신된 부분은 반드시 입력해주세요.</span>
				</dd>
			</dl>
			<table summary="게시판 정보를 입력해 생성해주세요.">
				<caption class="blind">게시판 정보 입력</caption>
				<tbody>
					<tr>
						<td>
							카테고리 이름
							<input type="hidden" name="category" value="{$documentData.category}">
							<input type="hidden" name="id" value="{$documentData.id}">			
						</td>
						<td>
							{$documentData.category}
						</td>
					</tr>
					<tr>
						<td><label for="board_name">*게시판 이름</label></td>
						<td>
							<input type="text" id="board_name" name="board_name" size="20" maxlength="20" value="">
						</td>
					</tr>
					<tr>
						<td><label for="summary">게시판 설명</label></td>
						<td>
							<input type="text" id="summary" name="summary" size="25" maxlength="50" value="">
						</td>
					</tr>
					<tr>
						<td><label for="board_width">게시판 넓이</label></td>
						<td>
							<input type="text" id="board_width" name="board_width" size="10" maxlength="12" value="100%">
						</td>
					</tr>
					<tr>
						<td><label for="hearder_path">상단 경로</label></td>
						<td>
							<input type="text" id="hearder_path" name="header_path" size="25" maxlength="50" value="">
						</td>
					</tr>
					<tr>
						<td>스킨</td>
						<td>
							<select id="skinList" name="skin_path">
							{foreach from=$documentData.skin_list item=$item}
								<option>{$item.file_name}</option>
							{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="footer_path">하단 경로</label></td>
						<td>
							<input type="text" id="footer_path" name="footer_path" size="25" maxlength="50" value="">
						</td>
					</tr>
					<tr>
						<td>사용가능</td>
						<td>
							<span>읽기</span>
							<select name="is_readable">
								<option value="y">yes</option>
								<option value="n">no</option>
							</select>
							<span>쓰기</span>
							<select name="is_writable">
								<option value="y">yes</option>
								<option value="n">no</option>
							</select>							
							<span>수정</span>
							<select name="is_modifiable">
								<option value="y">yes</option>
								<option value="n">no</option>
							</select>
							<span>답변</span>
							<select name="is_repliable">
								<option value="y">yes</option>
								<option value="n">no</option>
							</select>
							<span>가능:y 제한:n</span>
						</td>
					</tr>
					<tr>
						<td>허용레벨</td>
						<td>
							<span>읽기</span>
							<select name="grade_r">
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
							<span>쓰기</span>
							<select name="grade_w">
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
							<select name="grade_m">
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
							<select name="grade_re">
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
						<td>비회원 권한</td>
						<td>
							<select name="allow_nonmember">
								<option value="y">yes</option>
								<option value="n">no</option>
							</select>
							<span>가능 : yes / 제한 : no</span>
						</td>
					</tr>				
					<tr>
						<td>글목록 수</td>
						<td>
							<input type="text" name="limit_pagination" value="" size="3" maxlength="2">
							<span>※ 게시판 리스트에 출력할 글목록 수를 설정해주세요.</span>
						</td>
					</tr>
					<tr>
						<td>기타옵션 출력</td>
						<td>
							<span>꼬리글</span>
							<select name="is_comment">
								<option value="n">no</option>
								<option value="y">yes</option>								
							</select>
							<span>다운로드</span>
							<select name="is_download">
								<option value="n">no</option>
								<option value="y">yes</option>								
							</select>
							<span>진행상황</span>
							<select name="is_progress_step">
								<option value="n">no</option>
								<option value="y">yes</option>								
							</select>
						</td>
					</tr>
					<tr>
						<td>최근게시물</td>
						<td>
							<input type="radio" id="is_latest_y" name="is_latest" value="y">
							<span><label for="is_latest_y">출력</label></span>
							<input type="radio" id="is_latest_n" name="is_latest" value="n">
							<span><label for="is_latest_n">출력안함</label></span>
						</td>
					</tr>
					<tr>
						<td>게시판형식</td>
						<td>
							<input type="radio" id="board_type_html" name="board_type" value="html">
							<span><label for="board_type_html">HTML</label></span>
							<input type="radio" id="board_type_text" name="board_type" value="text">
							<span><label for="board_type_text">TEXT</label></span>
							<input type="radio" id="board_type_all" name="board_type" value="all">
							<span><label for="board_type_all">HTML + TEXT</label></span>
						</td>
					</tr>
					<tr>
						<td>불량단어 범위</td>
						<td>									
							<input type="radio" id="board_type_title" name="limit_choice" value="title">
							<span><label for="board_type_title">제목</label></span>									
							<input type="radio" id="board_type_comment" name="limit_choice" value="comment">
							<span><label for="board_type_comment">내용</label></span>									
							<input type="radio" id="board_type_all" name="limit_choice" value="all">
							<span><label for="board_type_all">제목+내용</label></span>
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
			
			<input type="submit" name="submit" size="10" value="수 정">
			<input type="button" name="cancel" value="취 소">
			</form>
		</div>
	</div>
</div>
{include file="$footerPath"}