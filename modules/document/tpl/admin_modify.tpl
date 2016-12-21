{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 페이지 수정 - StreamUX"}
<div class="articles ui-edgebox">
	<div class="add">
		<div class="tt">
			<div class="imgbox">
				<h1>페이지 옵션수정</h1>
			</div>
		</div>
		<div class="box">
			<form action="{$rootPath}document-admin/modify" name="f_document_admin_modify" method="post">
			<input type="hidden" name="_method" value="update">
			<dl>
				<dt>세부옵션 설정</dt>
				<dd>
					<img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">발강색(별표)으로 표신된 부분은 반드시 입력해주세요.</span>			
				</dd>
			</dl>
			<table summary="페이지 정보를 입력해 생성해주세요.">
				<tr>
						<td>
							*카테고리 이름
							<input type="hidden" name="category" value="{$documentData.category}">
							<input type="hidden" name="id" value="{$documentData.id}">			
						</td>
						<td>
							{$documentData.category}		
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
{include file="$footerPath"}