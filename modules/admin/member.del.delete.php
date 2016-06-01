<?
include "../lib.php";

$table_name = $_POST['table_name'];
$id = $_POST['id'];

$dataObj	= "";
$msg = "";
$resultYN = "Y";

$result = mysql_query("delete From $table_name where id='$id'");

if (!$result) {
	$msg = "${table_name} 회원 레코드를 삭제 실패하였습니다.";
 	$resultYN = "N"; 	
} else {
	$msg = "${table_name} 회원 레코드를 삭제 완료하였습니다.";
 }


$json_data = array(	"member"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
