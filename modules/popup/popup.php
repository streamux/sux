<?
include "lib.php";

$query="select * from popup where id='$id'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$popuptitle=$row[title];
$popupheight=$row[height];
$popupwidth=$row[width];
$popupurl=$row[url];
$skin_top=$row[skin_top];
$skin_left=$row[skin_left];
$skin_right=$row[skin_right];
$scomment= nl2br($row[comment]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><? echo $popuptitle; ?></title>
<link href="css/smx.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript">
<!--
function setCookie( name, value, expiredays )
    {
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	}

function closeWin() 
{ 
	if ( document.forms[0].Smxpop.checked ) 
 		setCookie( "<? echo $popwinname; ?>", "nooppop" , 1); 

	self.close(); 
}

// --> 
</SCRIPT> 
</head>

<body bgcolor="#FFFFFF" class="popup_body">
<form name="form1" method="post" action="">
<?
if($popupurl) {
$imgurl="pop_skin/skin/$popupurl";
}
?>
<table border="0" cellspacing="0" cellpadding="0" style="background-repeat:no-repeat; background-image: url(<? echo $imgurl; ?>);">
  <tr>
    <td><table width="<? echo $popupwidth; ?>" height="<? echo $popupheight; ?>"  border="0" cellpadding="0" cellspacing="0">
      <?
if($scomment) {
?>
      <tr>
        <td height="<? echo $skin_top; ?>"></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table  border="0" cellpadding="0" cellspacing="0">
            <tr>
			  <td width="<? echo $skin_left; ?>"></td>
              <td align="left"><? echo $scomment; ?></td>
			  <td width="<? echo $skin_right; ?>"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="20"></td>
      </tr>
      <?
}
?>
      <tr>
        <td align="center" valign="bottom" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="22" align="center" bgcolor="#333333"><table border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="txt_gray_01">오늘하루 이창을 열지 않음</td>
                    <td><input type=CHECKBOX name="Smxpop" value=""></td>
                    <td width="4"></td>
                    <td><a href="javascript:history.onclick=closeWin();" class="gray"><img src="pop_skin/img/butn_close.gif" width="55" height="17"></a></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>  
</form>
</body>
</html>