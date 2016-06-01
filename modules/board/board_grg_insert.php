<?
include "lib.php";
$query="insert into $board_grg values ('','$id','$name','$pass','$comment',now())";
$result=mysql_query($query);
echo ("<meta http-equiv='Refresh' content='0; URL=board_read.php?id=$id&sid=$id&board=$board&board_grg=$board_grg&igroup=$igroup&passover=$passover&sid=$sid&fmenu=$fmenu&fsubmenu=$fsubmenu'>");
mysql_close();
?>