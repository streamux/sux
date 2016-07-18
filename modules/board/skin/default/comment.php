<?php

$result2 = mysql_query("select * from $board_grg where storyid=$id order by id");
$numrow2 = mysql_num_rows($result2);
?>
	<div class="board-tail" style="width:<? echo ${width}; ?>">
		<div class="panel-list">
			<dl>
				<dt>댓글 <? echo $numrow2; ?></dt>
<? 
	while ($row2 = mysql_fetch_array($result2)) {

		$day = $row2[date];
		$nickname = htmlspecialchars($row2[nickname]);
		$iyggrcomment =  nl2br($row2[comment]);
		$grgid = $row2[id];
?>
				<dd>
					<? echo "${nickname} - <span class=\"grgcomment\">${iyggrcomment}</span><span class=\"date\">${day}</span>"; ?> 
					<a href="board.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&grgid=<? echo $grgid; ?>&igroup=<? echo $igroup; ?>&passover=<? echo $passover; ?>&action=deletecomment">[삭제]</a>
				</dd>
<?
	}
?>
			</dl>
		</div>
		<div class="panel-write">
			<form action="board.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&igroup=<? echo $igroup; ?>&passover=<? echo $passover; ?>&sid=<? echo $sid; ?>&action=record_writecomment" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
			<ul>		
				<li class="form-heading">
					<span>이름</span>
					<input type="text" name="ljs_name" size="10" maxlength="20" value="<? echo $ljs_nickname; ?>">&nbsp;
					<span>비밀번호</span>
					<input type="password" name="ljs_pass" size="8" maxlength="8" value="<? echo $ljs_pass1; ?>">
				</li>
				<li class="form-comment">
					<textarea name="comment" cols="64" rows="5"></textarea>
				</li>
				<li class="form-buttons">
					<input type="submit" name="Submit" value="댓글등록">
					<input type="reset" name="Submit2" value="다시쓰기">
				</li>
			</ul>
			</form>
		</div>
	</div>