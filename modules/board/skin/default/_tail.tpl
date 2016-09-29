	<div class="panel-write">
		<form action="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&igroup={$requestData.igroup}&passover={$requestData.passover}&sid={$requestData.sid}&action=recordWriteTail" method="post" name="f_board_write_tail" onSubmit="return jsux.fn.read.checkTailDocumentForm(this);">
		<dl>
			<dt>댓글 쓰기</dt>
			<dd class="form-heading">
				<span>이름</span>
				<input type="text" name="nickname" size="10" maxlength="20" value="">&nbsp;
				<span>비밀번호</span>
				<input type="password" name="pass" size="8" maxlength="8" value="">
			</dd>
			<dd class="form-comment">
				<textarea name="comment" cols="64" rows="5"></textarea>
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
			<dt>댓글 {$tailData.num}</dt>
			{foreach from=$tailData.list item=$item}
			<dd>
				{$item.nickname} - 
				<span class="grgcomment">{$item.comment}</span>
				<span class="date">{$item.day}</span>
				<a href="board.php?board={$requestData.board}&board_grg={$requestData.board_grg}&id={$requestData.id}&grgid={$item.id}&igroup={$requestData.igroup}&passover={$requestData.passover}&action=deleteTail">[삭제]</a>
			</dd>
			{/foreach}
		</dl>
	</div>		