<?
session_start();
include "../lib.php";

$id = $_REQUEST[id];				
$board = $_REQUEST[board];
$board_grg = $_REQUEST[board_grg];
$grgid = $_REQUEST[grgid];
$igroup = $_REQUEST[igroup];
$passover = $_REQUEST[passover];

$result = mysql_query("select * from $board_group where name='$board'");
$row = mysql_fetch_array($result);
$name = $row[name];
$width = $row[width];
$include1 = $row[include1];
$include2 = $row[include2];
$include3 = $row[include3];
$day = $row[date];
$w_admin = $row[w_admin];
$r_admin = $row[r_admin];
$rw_admin = $row[rw_admin];
$re_admin = $row[re_admin];
$limit_word = $row[limit_word];
$tail = $row[tail];
$download = $row[download];
$setup = $row[setup];
$w_grade = $row[w_grade];
$r_grade = $row[r_grade];
$rw_grade = $row[rw_grade];
$re_grade = $row[re_grade];
$log_key = $row[log_key];

$result = mysql_query("select name from $board where id=$id");
$row = mysql_fetch_array($result);
$m_name = $row[name];

include "$include1";
include $include2 . '/grg_delpass.php";
include "$include3";
?>