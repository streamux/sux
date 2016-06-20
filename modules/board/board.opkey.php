<?
include "../lib.php";

$id = $_REQUEST[id];
$board = $_REQUEST[board];
$board_grg = $_REQUEST[board_grg];
$opkey = $_POST[opkey];

$dbup = "update $board set opkey='$opkey' where id=$id ";
$result = mysql_query($dbup);
echo ("<meta http-equiv='Refresh' content='0; URL=board.list.php?board=$board&board_grg=$board_grg'>");
mysql_close();
?>