<? 
include "lib.php";

$query2=mysql_query("select * from questionc");
$row=mysql_fetch_array($query2);
$qtitle=$row[title];
$qwidth=$row[q_width];
$qheight=$row[q_height];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title><? echo $qtitle; ?></title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript">
<!--
function setCookie( name, value, expiredays ) {

	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	}
function closeWin() { 

	if ( document.forms[0].smxpop.checked ) 
		setCookie( "questionpop", "nooppop2" , 1); 

	self.close(); 
}
// --> 
</SCRIPT>
</head>
<body onLoad="window.focus()">
<table width="100%" height="<? echo $qheight; ?>" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="20" align="center" valign="top"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td height="30" align="center"><B>::::: 조사 결과 :::::</B> </td>
			</tr>
			<tr>
				<td height="20"></td>
			</tr>
			<tr>
				<td align="left"><?
$quesvalue=mysql_query("delete from questiont");
$quesinsert=mysql_query("insert into questiont values ('','0','$igroup')");
$query3=mysql_query("select hit from question where hit>0 and igroup = '$igroup' ");
while ($row3=mysql_fetch_array($query3)) {
	$see3=$row3[hit];
	$update3=mysql_query("update questiont set jilmunno=$jilmunno+$see3");
}

$query4=mysql_query("select * from questiont");
while($row4=mysql_fetch_array($query4)) {

	$questt=$row4[jilmunno];
	echo "<b>총 투표자";
	echo number_format($questt);
	echo "명</b>";
	echo "&nbsp; &nbsp;<br><br>";
}

$query5=mysql_query("select * from question where title ='' and igroup = '$igroup' order by id asc");
while ($row5=mysql_fetch_array($query5)) {
	$comment=$row5[comment];
	echo $comment."<br>";
	 if($questt && (int)$row5[hit]) {
		$percent = (int)(70 * $row5[hit]/$questt).'%';
		$length = (int)(150 * $row5[hit]/$questt);

		echo ("<img src=./admin/img/stick.jpg width=$percent height=10 > &nbsp;&nbsp;");
	}else{
		$percent=0;
	}
	echo ("<B>$row5[hit]명 ($percent)</B><br>");
}
?>
				</td>
			</tr>
			<tr>
				<td height="20"></td>
			</tr>
			<tr>
				<td align="left">※ 체크박스에 체크하시고 창닫기를 클릭하세요. <br>
오늘 다시 보고 싶을 때는 인터넷 브라우즈(인터넷을 연결한 상태)에서 [도구] - [ 인터넷옵션] - [쿠키삭제] 를 클릭하시면 됩니다.</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="24" valign="bottom">		
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<form name="form1" method="post" action="">
		<tr>
			<td height="24" align="center" bgcolor="#333333">		
				<table border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td class="txt_gray_01">오늘하루 이창을 열지 않음</td>
						<td class="txt_gray_01">&nbsp;</td>
						<td><input type=CHECKBOX name="smxpop" value=""></td>
						<td width="4"></td>
						<td><a href="javascript:history.onclick=closeWin();" class="gray">닫기</a></td>
					</tr>
				</table>
			</td>
		</tr>
	</form>
	</table></td>
	</tr>
</table>
</body>
</html>