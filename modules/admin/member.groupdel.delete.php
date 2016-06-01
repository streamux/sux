<?
include "../lib.php";

$table_name = $_POST['table_name'];

$dataObj	= "";
$msg = "";
$resultYN = "Y";

$result=mysql_query("drop table $table_name");

if (!$result) {
	$msg = "$table_name 테이블 삭제를 실패하였습니다.";
	$resultYN = "N";
} else {
	$result=mysql_query("delete From $member_group where name='$table_name'");

	if (!$result) {
		$msg = "$table_name 레코드 삭제를 실패하였습니다.";
		$resultYN = "N";
	} else {
		$msg = "$table_name 테이블 삭제를 성공하였습니다.";
	}
}

$json_data = array(	"member"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
