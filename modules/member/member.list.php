<?
include "admin.check.php";

$numresults=mysql_query("select id from $member");
$numrows=mysql_num_rows($numresults);
?>

<table border=0 align=center>
	<tr>
		<td width=550 height=25 class=shop_bgc_table><font class=ljs_fontcolor><B>&nbsp;&nbsp;회원 현황</B></font></td>
	</tr>
</table>
<span style=font-size:8pt;>&nbsp;</span><br>

<form action=membersearch.php method=post onSubmit='return content_check(this)'>
<table border=0 width=550>
	<tr>
		<td width=350 height=20 align=center>		
			<select name=find>
				<option value=name>이름</option>
				<option value=nickname> 닉네임</option>
				<option value=email> email</option>
			</select>
			<input type=text name=search size=10>
			<input type=submit value=검색하기>		
		</td>
		<td width=200 height=20 align=center ><B>총 등록인원 : <? echo $numrows; ?></B></td>
	</tr>
</table>
</form>

<?
$limit=10; 

if (!$passover) {
	 $passover=0;
}

$result=mysql_query("select * from $member order by id desc limit $passover,$limit");

while($row=mysql_fetch_array($result)) {
?>

<table width=550 border=0>
	<tr>
		<td width=100 height=20 align=center class=ljs_bgc_d>아이디</td>
		<td width=100 height=20 align=center class=ljs_bgc_d>비밀번호</td>
		<td width=100 height=20 align=center class=ljs_bgc_d>이름</td>
		<td width=100 height=20 align=center class=ljs_bgc_d>닉네임</td>
		<td width=150 height=20 align=center class=ljs_bgc_d>이메일</td>
	</tr>
<?
	echo "<tr><td height=20>&nbsp;";
	echo $row[ljs_memberid];
	echo "</td><td height=20>&nbsp;";
	echo $row[ljs_pass1];
	echo "</td><td height=20>&nbsp;";
	echo $row[name];
	echo "</td><td height=20>&nbsp;";
	echo $row[nickname];
	echo "</td><td height=20>&nbsp;";
	echo "<a href=mailto:$row[email]>";
	echo $row[email];
	echo "</a></td></tr><tr>";
	echo "<td colspan=5 height=20>";
	echo "주민번호 : "; 
	echo $row[jumin1]."-";  
	echo $row[jumin2]."&nbsp;&nbsp;"; 
	echo "적립금 : "; 
	echo number_format($row[point])."&nbsp;&nbsp;";
	echo "등급 : "; 
	echo $row[grade];
	echo "&nbsp;&nbsp;"; 
	echo "직업 : "; 
	echo $row[job];
	echo "&nbsp;&nbsp;"; 
	echo "취미 : "; 
	echo $row[hobby];
	echo "</td></tr><tr><td colspan=5 height=20>";
	echo "전화 : ";
	echo $row[tel];
	echo "&nbsp;&nbsp;"; 
	echo "핸드폰 : ";
	echo $row[htel];
	echo "&nbsp;&nbsp;"; 
	echo "홈페이지 : ";
	echo "<a href=$row[home] target=_blank>";
	echo $row[home];
	echo "</a></td></tr><tr><td colspan=5 height=20>";
	echo "주소 : ";
	echo $row[post1];
	echo "-";
	echo $row[post2];
	echo "&nbsp;&nbsp;"; 
	$addres1 = htmlspecialchars($row[addres2]);
	echo $addres1;
	echo "&nbsp;&nbsp;"; 
	echo "가입일 : ";
	$day = $row[date];
	echo $day;
	echo "</td></tr><tr><td>"; 
	echo "<a href=shopmemrewrite.php?id=$row[id]><font color=blue><b>수정</b></font></a>";
	echo "&nbsp;&nbsp;"; 
	echo "<a href=shopmemberdelpass.php?id=$row[id]><font color=blue><b>삭제</b></font></a>";
	echo "</td></tr></table>";
}

include "navi.php";
?>

<script type="text/javascript">

function content_check(f) {

	search = f.search.value.length;

	if ( search < 1 ) {
		alert("검색어를 입력 하세요.");
		f.search.focus();
		return (false);
	}
	return (true);
}
</script>