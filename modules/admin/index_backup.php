<?
$LastModified = gmdate("D d M Y H:i:s", filemtime($_SERVER[SCRIPT_FILENAME]));
header("Last-Modified: $LastModified GMT");
header("ETag: \"$LastModified\"");
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>SUX 관리자 페이지</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
</head>
<frameset rows="0,*" frameborder="NO" border="0" framespacing="0">
	<frame src="header.php" name="header" scrolling="NO" noresize>
	<frame src="admin.login.php" name="main">
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>
