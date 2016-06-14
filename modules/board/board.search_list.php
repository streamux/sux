<?
session_start();
include "../lib.php";

$board = $_REQUEST[board];

$result = mysql_query("select * from $board_group where name = '$board'");
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
$listnum = $row[listnum];
$limit_word = $row[limit_word];
$tail = $row[tail];
$download = $row[download];
$setup = $row[setup];
$w_grade = $row[w_grade];
$r_grade = $row[r_grade];
$rw_grade = $row[rw_grade];
$re_grade = $row[re_grade];

$skin_path = "skin/${include2}";

if ($include1){
	include "$include1";
} else {
	echo "상단 파일경로를 입력해 해주세요! 예)파일명.php";
}

if ($include2){
	include "${skin_path}/search_list.php";
} else {
	echo " 스킨을 선택해주세요!";
}

if ($include3){
	include "$include3";
} else {
	echo "하단 파일경로를 입력해 해주세요! 예)파일명.php";
}
?>