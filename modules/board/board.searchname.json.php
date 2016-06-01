<?
include "../lib.php";

$table_name = $_POST['table_name'];


$dataObj	= "";
$msg = "";
$resultYN = "Y";


$msg = "추가 생성 게시판 : ".$table_name."\\n";

if (strlen($table_name) < 2) {

	$msg = "게시판 테이블 이름은 2글자 이상 사용해주세요.";

	$json_data = array(	"msg"=>$msg);

	$strJson = JsonEncoder::getInstance()->parse($json_data);
	echo $_REQUEST['callback'].'('.$strJson.')';
	exit;
} 

if ($table_name) {

	$result = mysql_query("select name from $board_group where name='$table_name'");
	$numrows = mysql_num_rows($result);

	if ($numrows> 0) {
		$msg = "${table_name}는 이미 존재하는 게시판입니다.";
		$resultYN = "N";
	} else {
		$msg = "${table_name}는 생성할 수 있는 게시판입니다.";
		$resultYN = "Y";
	}
}else{
	$msg = "게시판 이름을 넣고 중복체크를 하십시오.";
	$resultYN = "N";
}


$json_data = array(	"data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
