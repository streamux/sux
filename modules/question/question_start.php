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
<title><? echo $qtitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="css/smx.css" rel="stylesheet" type="text/css">
</head>

<body>
<form action=question_insert.php method=post  name=musimso onSubmit="return musimso_check(this);">
<table width="100%" height="<? echo $qheight; ?>"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td height="30" align="center"><B>::::: 설문 조사 :::::</B></td>
	  </tr>
	  <tr>
	    <td height="20" align="center"></td>
	    </tr>
	  <tr>
	    <td align="left"><?
$query1=mysql_query("select * from question where title !='' and igroup = '$row[choice]' order by id desc");
$row1=mysql_fetch_array($query1);
echo $row1[title];
?></td>
	  </tr>
	  <tr>
	    <td height="10" align="left"></td>
	    </tr>
      <tr>
        <td align="left" valign="top">
<?
$query2=mysql_query("select * from question where title ='' and igroup = '$row[choice]' order by id asc");
while ($row2=mysql_fetch_array($query2))
{
$jilmunno=$row2[jilmunno];
$comment=$row2[comment];
?>
          <input type=hidden name=igroup value="<? echo $row[choice]; ?>">
          <input type=radio name=jilmunno value="<? echo $jilmunno; ?>"><? echo $comment; ?><br>
<?
}
?>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24" align="center" valign="bottom"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24" align="center" bgcolor="#333333"><INPUT type=submit name=submit size=10 value="투&nbsp;&nbsp;표">&nbsp;&nbsp;
          <input type="button" name="Button" value="닫&nbsp;&nbsp;기" onClick="window.self.close()"></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
