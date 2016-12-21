	<div class="panel-write">
		<form action="{$uri}/{$contentData.id}/comment" name="f_comment" method="post">
		<input type="hidden" name="_method" value="insert">
		<input type="hidden" name="content_id" value="content_id : {$contentData.id}">
		<dl>
			<dt>댓글 쓰기</dt>
			<dd class="form-heading">
				<span>이름</span>
				<input type="text" name="nickname" size="10" maxlength="20" value="임꺽정">&nbsp;
				<span>비밀번호</span>
				<input type="password" name="password" size="8" maxlength="8" value="12">
			</dd>
			<dd class="form-comment">
				<textarea name="comment" cols="64" rows="5">내용 입력 테스트 글 입니다.</textarea>
			</dd>
			<dd class="form-buttons">
				<input type="submit" name="comfirm" value="댓글등록">
				<input type="reset" name="rewrite" value="다시쓰기">
			</dd>
		</dl>		
		</form>
	</div>
	<div class="panel-list">
		<dl>
			<dt>댓글 {$commentData.num}</dt>
			{foreach from=$commentData.list item=$item}
			<dd>
				{$item.nickname} - 
				<span class="grgcomment">{$item.comment}</span>
				<span class="date">{$item.day}</span>
				<a href="{$uri}/{$contentData.id}/delete-comment/{$item.id}">[삭제]</a>
			</dd>
			{/foreach}
		</dl>
	</div>		