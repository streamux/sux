<?
include "../lib.php";


$id = $_REQUEST[id];
$board = $_REQUEST[board];
$board_grg = $_REQUEST[board_grg];
$group = $_REQUEST[group];
$passover = $_REQUEST[passover];
$sid = $_REQUEST[sid];

$ljs_name = $_POST[ljs_name];
$ljs_pass = $_POST[ljs_pass];
$comment = $_POST[comment];

$result=mysql_query("insert into $board_grg values ('','$id','$ljs_name','$ljs_pass','$comment',now())");

echo ("<meta http-equiv='Refresh' content='0; URL=board.read.php?id=$id&sid=$id&board=$board&board_grg=$board_grg&igroup=$igroup&passover=$passover&sid=$sid'>");
mysql_close();
?>