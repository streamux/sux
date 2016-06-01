<?
include "../lib.php";

$table_name = $board_group;

$dataObj = null;
$dataList = array();
$msg = "";
$resultYN = "Y";

function tableExists($tablename, $db) {

	$result = mysql_query("show tables from $db");
	$rcount = mysql_num_rows($result);

	for ($i=0;$i<$rcount;$i++) {

		if (mysql_tablename($result, $i) ==$tablename) {
			return true;
		}
	}
	return false;
}

if (tableExists($table_name, $mysql_db)) {

	$numresults = mysql_query("select id from $table_name");
	$numrows = mysql_num_rows($numresults);
	$limit = 20;   

	if (!$passover) {
		 $passover = 0;
	}

	$result = mysql_query("select * from $table_name ORDER BY id desc limit $passover,$limit");
	$numrows2 = mysql_num_rows($result);
	$a = $numrows-$passover;

	if ($numrows){

		while ($row = mysql_fetch_array($result)){
			$cb_id = $row['id'];
			$cb_name = $row['name'];
			$cb_board_name = $row['board_name'];
			$cb_width = $row['width'];
			$cb_day = $row['date'];
			$cb_grade = $row['grade'];
			$cb_log_key = $row['log_key'];
			$cb_output = $row['output'];

			array_push($dataList, array("no"=>$a,"id"=>$cb_id,"table_name"=>$cb_name, "board_name"=>$cb_board_name,"date"=>$cb_day,"log_key"=>$cb_log_key,"width"=>$cb_width));

			$a--;
		}

		$dataObj = array("list"=>$dataList);
	} else {
		$msg = "게시판이 존재하지 않습니다.";
		$resultYN = "N";
	}
} else {
	$msg = "그룹테이블이 존재하지 않습니다.";
	$resultYN = "N";
}

$json_data = array(	"data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>