<?
include "top.php"; 

$id = $_REQUEST['id'];
?>

<div class="container">	
		<div class="articles ui-edgebox">
			<div class="add">
				<h2 class="blind">팝업 수정</h2>
				<div class="tt">
					<div class="imgbox">
						<span>팝업수정</span>
					</div>
				</div>
				<div class="box">
					<form>
					<dl>
						<dt>팝업수정 옵션설정</dt>
						<dd>
							<img src="tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
							<span class="text-notice">발강색으로 표신된 부분은 반드시 입력해주세요.</span>
							<input type="hidden" name="id" value=<? echo $id ?>>	
						</dd>
					</dl>
					<table summary="팝업 정보를 입력해 생성해주세요.">
						<caption class="blind">팝업 정보 입력</caption>
						<tbody>
							<tr>
								<td><span>팝</span>업 이름</td>
								<td>
									<input type="text" name="popupname" size="20" maxlength="30">
								</td>
							</tr>
							<tr>
								<td><span>제</span>목</td>

								<td>
									<input type="text" name="popuptitle" size="30" maxlength="30">
								</td>
							</tr>
							<tr>
								<td>노출</td>
								<td>
									<select name="popupchoice">
										<option value="n">n</option>
										<option value="y">y</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>시간</td>
								<td>
									<input type="text" name="popuptime6" size="4" maxlength="4">
									<span>년</span>
									<input type="text" name="popuptime4" size="2" maxlength="2">
									<span>월</span>
									<input type="text" name="popuptime5" size="2" maxlength="2">
									<span>일</span>
									<input type="text" name="popuptime1" size="2" maxlength="2">
									<span>시</span>
									<input type="text" name="popuptime2" size="2" maxlength="2">
									<span>분</span>
									<input type="text" name="popuptime3" size="2" maxlength="2">
									<span>초</span>
									<span>※ 팝업창 닫을 시간을 정확하게 설정하세요.</span>
								</td>
							</tr>
							<tr>
								<td>스킨</td>
								<td>
									<select name="skin" id="skinList">
										<!--
										@ jquery templete
										@ name skinList_tmpl
										-->
									</select>
								</td>
							</tr>
							<tr>
								<td>팝업크기</td>
								<td>
									넓이
									<input type="text" name="popupwidth" size="4" maxlength="3">
									<span>높이</span>
									<input type="text" name="popupheight" size="4" maxlength="3">
								</td>
							</tr>
							<tr>
								<td>팝업위치</td>
								<td>
									<span>상단</span>
									<input type="text" name="popuptop" size="4" maxlength="3">
									<span>좌측</span>
									<input type="text" name="popupleft" size="4" maxlength="3">
									<span>※ 모니터 기준</span>
								</td>
							</tr>		
							<tr>
								<td>내용여백</td>
								<td>
									<span>상단</span>
									<input type="text" name="skin_top" size="4" maxlength="3">
									<span>좌측</span>
									<input type="text" name="skin_left" size="4" maxlength="3">
									<span>우측</span>
									<input type="text" name="skin_right" size="4" maxlength="3">
								</td>
							</tr>						
							<tr>
								<td>수정내용</td>
								<td>
									<textarea name="pucomment" cols="25" rows="6"></textarea>
									<span>※ 팝업에 들어갈 내용을 입력해주세요.</span>
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
	</div>
</div>

<script type="jquery-templete" id="popupLabel_tmpl">
	<span>${label}</span>
</script>
<script type="jquery-templete" id="skinList_tmpl">
	<option>${file_name}</option>
</script>

<script type="text/javascript" src="./tpl/js/popup.edit.js"></script>



<? include "bottom.php"; ?>