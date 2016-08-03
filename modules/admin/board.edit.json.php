<? 
include "../lib.php";

$table_name = $_POST['table_name'];

$dir = "../board/skin";

$dataObj = null;
$skinList = array();
$msg = "";
$resultYN = "Y";

$result = mysql_query("select * from $board_group where name = '$table_name'");

if ($result) {

	$row = mysql_fetch_array($result);

	$id = $row['id'];
	$board_name =$row['board_name'];
	$width = $row['width'];
	$include1 = $row['include1'];
	$include2 = $row['include2'];
	$include3 = $row['include3'];
	$log_key = $row['log_key'];
	$w_grade = $row['w_grade'];
	$r_grade = $row['r_grade'];
	$rw_grade = $row['rw_grade'];
	$re_grade = $row['re_grade'];	
	$w_admin = $row['w_admin'];
	$r_admin = $row['r_admin'];
	$rw_admin = $row['rw_admin'];
	$re_admin = $row['re_admin'];
	$listnum = $row['listnum'];
	$tail = $row['tail'];
	$download = $row['download'];
	$setup = $row['setup'];
	$output = $row['output'];
	$type = $row['type'];
	$limit_choice = $row['limit_choice'];
	$limit_word = $row['limit_word'];

	$dataObj = array("table_name"=>$table_name,"board_name"=>$board_name,"id"=>$id,"width"=>$width,"include1"=>$include1,"skin"=>$include2,"include3"=>$include3,"log_key"=>$log_key,"w_grade"=>$w_grade,"r_grade"=>$r_grade,"rw_grade"=>$rw_grade,"re_grade"=>$re_grade,"w_admin"=>$w_admin,"r_admin"=>$r_admin,"rw_admin"=>$rw_admin,"re_admin"=>$re_admin,"listnum"=>$listnum,"tail"=>$tail,"download"=>$download,"setup"=>$setup,"output"=>$output,"type"=>$type,"limit_choice"=>$limit_choice,"limit_word"=>$limit_word,"skinList"=>$skinList);

} else {
	$msg = "$table_name 게시판이 존재하지 않습니다.";
	$resultYN = "N";
}

$json_data = array(	"data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>