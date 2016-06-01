<form action=board_insert.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&ljs_mod=<? echo $ljs_mod; ?>&fmenu=<? echo $fmenu; ?>&fsubmenu=<? echo $fsubmenu; ?> method=post  name=musimw enctype=multipart/form-data onSubmit="return storycommentvalue(this);"> 
	<?
if ($ljs_mod == "reply")
{
$result=mysql_query("select * from $board where id=$id");
$row=mysql_fetch_array($result);
$storycomment= nl2br($row[comment]);
$name=$row[name];
$email=$row[email];
$storytitle=$row[title];
$storytitle=substr(htmlspecialchars($storytitle),0,40);
$fileupname=$row[filename];
$type=$row[type];
if($admin_type == 'all'){
	if($type=='html'){
		$storycomment= $row[comment];
	}else if($type == 'text'){
		$storycomment= nl2br($row[comment]);
	}
}else if($admin_type == 'html') {
	$storycomment= $row[comment];
}else{
	$storycomment= nl2br($row[comment]);
}
?>
	<table width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0" bgcolor="#CE0000">
		<tr>
			<td  height="2"></td>
		</tr>
	</table>
	<table  width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width=100% height=37 valign="bottom">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="90" height="27" align="center"><img src="skin/sboard/img/tt_writer.gif" width="40" height="15"></td>
						<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
						<td align="left">&nbsp;&nbsp;<? echo $name; ?></td>
						<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
						<td width="90" align="center"><img src="skin/sboard/img/tt_counter.gif" width="40" height="15"></td>
						<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
						<td width="100" align="center"><? echo $row[see]; ?></td>
					</tr>
			</table></td>
		</tr>
		<tr>
			<td height="1" bgcolor="#D6D7D6"></td>
		</tr>
		<tr>
			<td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="90" height="27" align="center"><img src="skin/sboard/img/tt_title.gif" width="40" height="15"></td>
						<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
						<td align="left">&nbsp;&nbsp;<? echo $storytitle; ?></td>
						<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
						<td width="90" align="center"><img src="skin/sboard/img/tt_date.gif" width="40" height="15"></td>
						<td width="4"><img src="skin/sboard/img/verti_ttline.gif" width="1" height="27"></td>
						<td width="100" align="center"><? echo $row[date]; ?></td>
					</tr>
			</table></td>
		</tr>
		<tr>
			<td height="1" bgcolor="#D6D7D6"></td>
		</tr>
		<tr>
			<td>
				<table width="100%"  border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="90" height="100" align="center" valign="middle"> <img src="skin/sboard/img/tt_comment.gif" width="40" height="15"></td>
						<td width="1" bgcolor="#D6D7D6"></td>
						<td width="12" valign="top"><br></td>
						<td align="left" valign="top"><?
if ($fileupname) {
if ($download == 'y') { // 파일다운로드 설정
?>
								<a href="board_down.php?board=<? echo $board; ?>&fileupname=<? echo $fileupname; ?>&filepath=<? echo $filesize; ?>')" class="darkblue"><? echo $fileupname; ?>&nbsp;&nbsp;<b>[다운로드]</b></a>
								<?
} else {
echo "<br>";
echo "<img src='../$board/$fileupname' width='450' border='0'>";
?>
								<?
}
}
echo "<br>";
echo $storycomment;
echo "<br>";
?>
						</td>
					</tr>
					<tr>
						<td height="27" align="center" valign="middle">&nbsp;</td>
						<td bgcolor="#D6D7D6"></td>
						<td align="right"></td>
						<td align="right"><br>
	&nbsp;&nbsp;<? echo $row[date]; ?>&nbsp;/&nbsp;<a href=mailto:<? echo $email; ?>>e-mail<br>
							<br>
						</a></td>
					</tr>
					<tr>
						<td height="1"bgcolor="#D6D7D6"></td>
						<td bgcolor="#D6D7D6"></td>
						<td colspan="2" bgcolor="#D6D7D6"></td>
					</tr>
				</table>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td height="2"></td>
					</tr>
			</table></td>
		</tr>
	</table>
	<?
}
?>
<table width="<? echo $width; ?>" height="3"  border="0" cellpadding="0" cellspacing="0" bgcolor="#D6D7D6">
	<tr>
		<td></td>
	</tr>
</table>
<table  width="<? echo $width; ?>" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width=100% height=37 valign="bottom">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="6" height="27" align="center">&nbsp;</td>
					<td width="84" align="center"><img src="skin/wswg_board/img/tt_name_2.gif" width="40" height="15"></td>
					<td align="left">
						<input type=text name=name size=14 maxlength=20 value=<? echo $ljs_name; ?>>
			<input type=hidden name=ljs_mod value="reply"></td>
					<td width="90" align="center"><img src="skin/wswg_board/img/tt_pass_2.gif" width="57" height="15"></td>
					<td align="left"><input type=password name=pass size=14 maxlength=10 value=<? echo $ljs_pass1; ?>></td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="6" height="27" align="center">&nbsp;</td>
					<td width="84" align="center"><img src="skin/wswg_board/img/tt_title.gif" width="40" height="15"></td>
					<td align="left"><input type=text name=storytitle size=50 maxlength=50><input type=hidden name=stwrite size=60 maxlength=60 value="<? echo $stwrite; ?>"></td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
			<td valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="6" height="27" align="center">&nbsp;</td>
						<td width="84" align="center"><img src="skin/wswg_board/img/tt_email.gif" width="40" height="15"></td>
						<td><input type=text name=email size=30 maxlength=28 value=<? echo $ljs_email; ?>></td>
			<td width="10"></td>
			<td><font color="FF0000"><? if($setup == 'y'){
				echo "※필수입력 사항입니다.";
				} ?></font></td>
					</tr>
			</table></td>
		</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td><table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="6" height="27" align="center"></td>
					<td width="90" align="center"></td>
					<td><input name="type" type="radio" value="html" <? if($admin_type == 'html') echo "checked"; ?>>
						<strong>HTML</strong>&nbsp;&nbsp;<input name="type" type="radio" value="text" <? if($admin_type == 'text' || $admin_type == 'all') echo "checked"; ?>>
						<strong>TEXT</strong></td>
					<td width="10"></td>
					<td>※ 형식을 선택해주세요. </td>
				</tr>
			</table></td>
		</tr>
	<tr>
		<td height="5"></td>
		</tr>
	<tr>
		<td>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="6" align="center">&nbsp;</td>
					<td width="84" align="center"><img src="skin/wswg_board/img/tt_comment.gif" width="40" height="15"></td>
					<td><table bgcolor=#F5F5F5>
<tr>
<td colspan=2 align=center>
<img title='진하게' onclick="srBold('wswEdit')" src='skin/wswg_board/img/w_bold.gif'>
<img title='이탤릭' onclick="srItalic('wswEdit')" src='skin/wswg_board/img/w_italic.gif'>
<img title='밑줄' onclick="srUnderline('wswEdit')" src='skin/wswg_board/img/w_underline.gif'>
<img title='글자색' onclick="underlook('wswEdit_colorchoice')" src='skin/wswg_board/img/w_fontcolor.gif'>
<img title='글자 배경색' onclick="underlook2('wswEdit_colorchoice2')" src='skin/wswg_board/img/w_fontbackcolor.gif'>

<img title='자르기(Ctrl + X)' onclick="srcut('wswEdit')" src='skin/wswg_board/img/w_cut.gif'>
<img title='복사(Ctrl + C)' onclick="srcopy('wswEdit')" src='skin/wswg_board/img/w_copy.gif'>
<img title='붙이기(Ctrl + V)' onclick="srpaste('wswEdit')" src='skin/wswg_board/img/w_paste.gif'>	
<img title='왼쪽 정렬' onclick="srjustifyleft('wswEdit')" src='skin/wswg_board/img/w_justifyleft.gif'>
<img title='가운데 정렬' onclick="srjustifycenter('wswEdit')" src='skin/wswg_board/img/w_justifycenter.gif'>	
<img title='오른쪽 정렬' onclick="srjustifyright('wswEdit')" src='skin/wswg_board/img/w_justifyright.gif'>
<img title='숫자로 된 목록' onclick="srinsertorderedlist('wswEdit')" src='skin/wswg_board/img/w_insertorderedlist.gif'>	
<img title='점으로 된 목록' onclick="srinsertunorderedlist('wswEdit')" src='skin/wswg_board/img/w_insertunorderedlist.gif'>
<img title='들여쓰기 줄이기' onclick="sroutdent('wswEdit')" src='skin/wswg_board/img/w_outdent.gif'>
<img title='들여쓰기 늘이기' onclick="srindent('wswEdit')" src='skin/wswg_board/img/w_indent.gif'>	
<img title='하이퍼링크 만들기' onclick="srcreateLink('wswEdit')" src='skin/wswg_board/img/w_link.gif'>
</td>
</tr>
<tr>
<td width=140 align=left>
<select onChange="fontct('fontname',this[this.selectedIndex].value);this.selectedIndex=0">
<option selected>font
<option value="굴림">굴림
<option value="돋움">돋움
<option value="바탕">바탕
<option value="고딕">고딕
</select>
<select onChange="fontct('fontsize',this[this.selectedIndex].value);this.selectedIndex=0">
<option value="2" selected>Size
<option value="2">8p
<option value="4">12p
<option value="5">15p
</select>
</td>
<td>

<div id=wswEdit_colorchoice style="VISIBILITY:block;DISPLaY:none">
<table cellpadding=0 cellspacing=1 >
<tr>
<td><span style=font-size:9pt;>글자색</span></td>
<td><a href="javascript:srcolor('wswEdit','#FF0000')"><font COLOR='#FF0000'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#C00000')"><font COLOR='#C00000'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#FF8080')"><font COLOR='#FF8080'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#FFC0C0')"><font COLOR='#FFC0C0'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#FFFF00')"><font COLOR='#FFFF00'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#808000')"><font COLOR='#808000'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#00FF00')"><font COLOR='#00FF00'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#008000')"><font COLOR='#008000'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#00C000')"><font COLOR='#00C000'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#00FFFF')"><font COLOR='#00FFFF'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#008080')"><font COLOR='#008080'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#00C0C0')"><font COLOR='#00C0C0'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#0000FF')"><font COLOR='#0000FF'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#0000C0')"><font COLOR='#0000C0'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#FF00FF')"><font COLOR='#FF00FF'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#800080')"><font COLOR='#800080'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#C000C0')"><font COLOR='#C000C0'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#000000')"><font COLOR='#000000'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#808080')"><font COLOR='#808080'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#C0C0C0')"><font COLOR='#C0C0C0'>■</font></a></td>
<td><a href="javascript:srcolor('wswEdit','#FFFFFF')"><font COLOR='#FFFFFF'>■</font></a></td>
</tr>
</table>
</div>
<div id=wswEdit_colorchoice2 style="VISIBILITY:block;DISPLaY:none">
<table cellpadding=0 cellspacing=1 >
<tr>

<td><span style=font-size:9pt;>배경색</span></td>
<td><a href="javascript:srBackColor('wswEdit','#FF0000')"><font COLOR='#FF0000'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#C00000')"><font COLOR='#C00000'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#FF8080')"><font COLOR='#FF8080'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#FFC0C0')"><font COLOR='#FFC0C0'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#FFFF00')"><font COLOR='#FFFF00'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#808000')"><font COLOR='#808000'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#00FF00')"><font COLOR='#00FF00'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#008000')"><font COLOR='#008000'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#00C000')"><font COLOR='#00C000'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#00FFFF')"><font COLOR='#00FFFF'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#008080')"><font COLOR='#008080'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#00C0C0')"><font COLOR='#00C0C0'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#0000FF')"><font COLOR='#0000FF'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#0000C0')"><font COLOR='#0000C0'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#FF00FF')"><font COLOR='#FF00FF'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#800080')"><font COLOR='#800080'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#C000C0')"><font COLOR='#C000C0'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#000000')"><font COLOR='#000000'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#808080')"><font COLOR='#808080'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#C0C0C0')"><font COLOR='#C0C0C0'>■</font></a></td>
<td><a href="javascript:srBackColor('wswEdit','#FFFFFF')"><font COLOR='#FFFFFF'>■</font></a></td>
</tr>
</table>
</div>
</td>
</tr>
<tr>
<td colspan=2>
<table BORDER=0 width=100%>
<tr>
<td>
<iframe  id=wswEdit src='about:blank' width=100% HEIGHT=200 scrolling="auto" border=0 frameborder=0 framespacing=0 hspace=0 marginheight=0 marginwidth=0 vspace=0></iframe>
<textarea style="display: none" NaME=storycomment></textarea>
</td>
</tr>
</table>
<script>
function storycommentvalue(v) {
v.elements.storycomment.value = "" + wswEdit.document.body.innerHTML + "";
pass = v.pass.value.length;
storytitle = v.storytitle.value.length;
email = v.email.value.length;
storycomment = v.storycomment.value.length;
wall = v.wall.value.length;
if ( pass < 1 ) {
	alert("비밀번호를 입력하세요.");
	v.pass.focus();
	return (false);
}
if ( storytitle < 1 ) {
	alert("제목을 입력하세요.");
	v.storytitle.focus();
	return (false);
}
if ( storytitle > 50 ) {
	alert("제목은 최대 50바이트까지 허용합니다.");
	v.storytitle.focus();
	return (false);
}
if ( email < 1 ) {
	alert("이메일 주소를 입력하세요.");
	v.email.focus();
	return (false);
}
if ( storycomment < 1 ) {
	alert("내용을 입력하세요.");
	frames.wswEdit.document.focus();
	return (false);
}
if ( wall < 1 ) {
	alert("붉은글씨를 입력하세요.");
	v.wall.focus();
	return (false);
}
return (true);
}

function srcut(srname) // 자르기
{
	srname = eval(srname) ;
	srname.document.execCommand('cut', false, null);
	srname.focus();
}

function srcopy(srname) // 복사
{
	srname = eval(srname) ;
	srname.document.execCommand('copy', false, null);
	srname.focus();
}

function srpaste(srname) // 붙이기
{
	srname = eval(srname) ;
	srname.document.execCommand('paste', false, null);
	srname.focus();
}

function srjustifyleft(srname) // 왼쪽 정렬
{
	srname = eval(srname) ;
	srname.document.execCommand('justifyleft', false, null);
	srname.focus();
}

function srjustifycenter(srname) // 가운데 정렬
{
	srname = eval(srname) ;
	srname.document.execCommand('justifycenter', false, null);
	srname.focus();
}

function srjustifyright(srname) // 오른쪽 정렬
{
	srname = eval(srname) ;
	srname.document.execCommand('justifyright', false, null);
	srname.focus();
}

function srinsertorderedlist(srname) // 숫자로 된 목록
{
	srname = eval(srname) ;
	srname.document.execCommand('insertorderedlist', false, null);
	srname.focus();
}

function srinsertunorderedlist(srname) // 점으로 된 목록
{
	srname = eval(srname) ;
	srname.document.execCommand('insertunorderedlist', false, null);
	srname.focus();
}

function srindent(srname) // 들여쓰기 늘이기
{
	srname = eval(srname) ;
	srname.document.execCommand('indent', false, null);
	srname.focus();
}

function sroutdent(srname) // 들여쓰기 줄이기
{
	srname = eval(srname) ;
	srname.document.execCommand('outdent', false, null);
	srname.focus();
}

function srBold(srname) // 진하게
{
	srname = eval(srname) ;
	srname.document.execCommand('Bold', false, null);
	srname.focus();
}

function srItalic(srname) // 이텔릭
{
	srname = eval(srname) ;
	srname.document.execCommand('Italic', false, null);
	srname.focus();
}

function srUnderline(srname) // 밑줄
{
	srname = eval(srname) ;
	srname.document.execCommand('Underline', false, null);
	srname.focus();
}


function srcolor(srname, color) // 글자색
{
	srname = eval(srname) ;
	srname.document.execCommand('ForeColor', true, color);
	srname.focus();
}

function srBackColor(srname, color) // 글자 배경색
{
	srname = eval(srname) ;
	srname.document.execCommand('BackColor', true, color);
	srname.focus();
}

function srcreateLink(srname,link_name) // 하이퍼링크 만들기
{
	srname = eval(srname) ;
	srname.focus();
	srname.document.execCommand('CreateLink', true, link_name);
}

function fontct(fontcts,cho){
	 frames.wswEdit.focus(); 
	 srfont = frames.wswEdit.document.selection.createRange(); 
	 srfont.execCommand(fontcts,false, cho);	
	}

function underlook(hee) {
	if(document.all[hee].style.display == 'none') {
document.all[hee].style.display = 'block';
	} else {
document.all[hee].style.display = 'none';
	}
}

function underlook2(hee) {
	if(document.all[hee].style.display == 'none') {
document.all[hee].style.display = 'block';
	} else {
document.all[hee].style.display = 'none';
	}
}
frames.wswEdit.document.designMode = "On"
</script>
</td>
</tr>
</table></td>
				</tr>
		</table></td>
	</tr>
	<tr>
		<td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="90" height="10" colspan="2"></td>
					<td></td>
				</tr>
				<tr>
					<td width="6" align="center">&nbsp;</td>
					<td width="84" align="center"><img src="skin/wswg_board/img/tt_adfile.gif" width="57" height="15"></td>
					<td><input type=file name=imgup size=40>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td>php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf 등의<br>
						실행파일은 업로드 할 수 없습니다.</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
					<td width="84" align="center"><img src="skin/wswg_board/img/tt_adkey.gif" width="44" height="15"></td>
					<td><input type=text name=wall size=16 maxlength=20></td>
				</tr>
				<tr>
					<td colspan="2" align="center"></td>
					<td>프로그램 등록을 방지하기 위해 붉은 글씨를 입력하세요.(미입력시 등록 안됨)<br>
							<? 
$result=mysql_query("select wall from $board order by id desc limit 1");
$row=mysql_fetch_array($result);
if($row[wall] == 'a') {
echo "<font color=red size=3><b>나라사랑</b></font>";
?>
							<input type=hidden name=wallok value="나라사랑">
							<input type=hidden name=wallwd value="b">
							<?
} else if($row[wall] == 'b') {
echo "<font color=red size=3><b>조국사랑</b></font>";
?>
							<input type=hidden name=wallok value="조국사랑">
							<input type=hidden name=wallwd value="a">
							<?
}
?></td>
				</tr>
				<tr>
					<td height="20" colspan="2"></td>
					<td></td>
				</tr>
				<tr>
					<td height="1" colspan="3" bgcolor="#D6D7D6"></td>
				</tr>
				<tr>
					<td height="5" colspan="2"></td>
					<td height="5"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"></td>
					<td align="right"><table  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><input name="imageField" type="image" src="skin/wswg_board/img/btn_confirm.gif" width="51" height="23" border="0"></td>
								<td width="10"></td>
								<td><a href="#" onclick="history.back()"><img src="skin/wswg_board/img/btn_cancel.gif" width="51" height="23" border="0"></a></td>
							</tr>
					</table></td>
				</tr>
		</table></td>
	</tr>
</table>
	<script>
document.musimw.name.focus();
	</script>
</form>
