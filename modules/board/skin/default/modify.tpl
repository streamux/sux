{assign var=groupData value=$documentData.group}
{assign var=boardTitle value=$groupData.board_name}
{assign var=contentData value=$documentData.contents}
{assign var=uri value=$documentData.uri}
{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="$boardTitle :: 게시물 수정 - StreamUX"}
<div class="board-write" style="width:{$groupData.width}">
	<form action="{$uri}/{$contentData.id}/modify" method="post"  name="f_board_modify" enctype="multipart/form-data">
	<input type="hidden" name="_method" value="update">
	<div class="panel-heading">
		<p>
			<label for="user_name">이름</label>
			<input type="text" name="user_name" id="user_name" maxlength="20" value="{$contentData.user_name}">
		</p>
		<p>
			<label for="password">비번</label>
			<input type="password" name="password" id="password" maxlength="10" value="">
		</p>
		<p>
			<label for="title">제목</label>
			<input type="text" name="title" id="title" maxlength="50" value="{$contentData.title}">
		</p>
		<p>
			<label for="email_address">이메일</label>
			<input type="text" name="email_address" id="email_address" maxlength="28" value="{$contentData.email_address}">			
		</p>
	</div>
	<div class="panel-body">
		<p>
			<span class="ui-label-width"><label for="contents">내용</label></span>
			<span><input type="radio" name="type" id="radio_type_text" value="text" {$contentData.contents_type_text}><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" {$contentData.contents_type_html}><label for="radio_type_html">HTML</label></span>
		</p>
		<textarea name="contents" id="contents" cols="64" rows="14">{$contentData.contents}</textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			첨부파일&nbsp;<input type="file" name="imgup">			
		</p>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="{$skinPathList.dir}/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="#" onclick="history.back();"><img src="{$skinPathList.dir}/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>
{include file="$footerPath"}