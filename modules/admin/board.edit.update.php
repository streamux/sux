<?
include "../lib.php";

$table_name = $_REQUEST['table_name'];
$id = $_REQUEST['id'];
$width = $_REQUEST['width'];
$include1 = $_REQUEST['include1'];
$skin = $_REQUEST['skin'];
$include3 = $_REQUEST['include3'];
$w_admin = $_REQUEST['w_admin'];
$r_admin = $_REQUEST['r_admin'];
$rw_admin = $_REQUEST['rw_admin'];
$re_admin = $_REQUEST['re_admin'];
$listnum = $_REQUEST['listnum'];
$tail = $_REQUEST['tail'];
$download = $_REQUEST['download'];
$setup = $_REQUEST['setup'];
$w_grade = $_REQUEST['w_grade'];
$r_grade = $_REQUEST['r_grade'];
$rw_grade = $_REQUEST['rw_grade'];
$re_grade = $_REQUEST['re_grade'];
$log_key = $_REQUEST['log_key'];
$limit_choice = $_REQUEST['limit_choice'];
$limit_word = $_REQUEST['limit_word'];
$board_name = $_REQUEST['board_name'];
$type = $_REQUEST['type'];
$output = $_REQUEST['output'];

$dataObj = array();
$resultYN = "Y";
$msg = "";

$result2 = mysql_query("update $board_group set width='$width',include1='$include1',include2='$skin',include3='$include3',w_admin='$w_admin',r_admin='$r_admin',rw_admin='$rw_admin',re_admin='$re_admin',listnum='$listnum',tail='$tail',download='$download',setup='$setup',w_grade='$w_grade',r_grade='$r_grade',rw_grade='$rw_grade',re_grade='$re_grade',log_key='$log_key',limit_choice='$limit_choice',limit_word='$limit_word',board_name='$board_name',type='$type',output='$output' where id=$id");

if (!$result2) {
	$msg = "$table_name 테이블 수정을 실패하였습니다.";
	$resultYN = "N";	
} else {
	$msg = "$table_name 테이블 수정을 완료하였습니다.";
}


$json_data = array(	"member"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>