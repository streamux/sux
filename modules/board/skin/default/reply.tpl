{assign var=groupData value=$documentData.group}
{assign var=boardTitle value=$groupData.board_name}
{assign var=contentData value=$documentData.contents}
{assign var=uri value=$documentData.uri}
{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="$boardTitle :: 게시물 답변 - StreamUX"}
<div class="board-read" style="width:{$groupData.width}">
	<div class="panel-heading">
		<p class="title">{$contentData.title}</p>
		<p class="sub-info">{$contentData.user_name} &nbsp; {$contentData.date} &nbsp; 조회 {$contentData.readed_count}</p>
	</div>
	<div class="panel-body">
		<p class="{$contentData.css_down}">
			<a href="{$contentData.fileup_path}">{$contentData.fileup_name}&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="{$contentData.img_width}" class="{$contentData.css_img}"><img src="{$contentData.fileup_path}" width="100%" border="0"></p>
		<p>{$contentData.contents}</p>
	</div>		
</div>
<div class="board-write" style="width:{$groupData.width}">
	<form action="{$uri}/{$contentData.id}/reply" method="post"  name="f_board_reply" enctype="multipart/form-data">
	<input type="hidden" name="_method" value="insert">
	<input type="hidden" name="user_id" value="{$contentData.user_id}">
	<input type="hidden" name="igroup_count" value="{$contentData.igroup_count}">
	<input type="hidden" name="space_count" value="{$contentData.space_count}">
	<input type="hidden" name="ssunseo_count" value="{$contentData.ssunseo_count}">
	<div class="panel-heading">
		<p>
			<label for="user_name" class="{$contentData.css_user_label}">이름</label>
			<input type="{$contentData.user_name_type}" name="user_name" id="user_name" maxlength="20" value="{$contentData.user_name}">
		</p>
		<p>
			<label for="password" class="{$contentData.css_user_label}">비번</label>
			<input type="{$contentData.user_pass_type}" name="password" id="password" maxlength="10" value="{$contentData.user_password}">
		</p>
		<p>
			<label for="title">제목</label>
			<input type="text" name="title" id="title" maxlength="50" value="테스터 글">
		</p>
		<p>
			<label for="email_address">이메일</label>
			<input type="text" name="email_address" id="email_address" maxlength="28" value="streammx@naver.com">			
		</p>
	</div>
	<div class="panel-body">
		<p>
			<span class="ui-label-width"><label for="contents">내용</label></span>
			<span><input type="radio" name="type" id="radio_type_text" value="text" {$contentData.comment_type_text}><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" {$contentData.comment_type_html}><label for="radio_type_html">HTML</label></span>
		</p>
		<textarea name="contents" id="contents" cols="64" rows="14">테스트 중입니다.</textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			<label for="imgup_pick">첨부파일</label> <input type="file" name="imgup" id="imgup_pick">
		</p>
		<span class="ui-wallkey">
			<label for="wall_key">등록키 [ <span class="color-red font-weight-bold">{$contentData.wallname}</span> ]</label>
			<input type="text" name="wall" id="wall_key" size="16" maxlength="20">			
			<input type="hidden" name="wallok" value="{$contentData.wallname}">
			<input type="hidden" name="wallwd" value="{$contentData.wallkey}">
		</span>
		<span class="ui-inlineblock">등록키를 입력해주세요.</span>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="{$skinPathList.dir}/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="#" onclick="history.back();"><img src="{$skinPathList.dir}/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>
{include file="$footerPath"}