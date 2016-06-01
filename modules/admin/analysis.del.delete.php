<?
include "../lib.php";

$id = $_POST['id'];

$msg = "";
$resultYN = "Y";

$table_name = $connecter_site;
$result = mysql_query("delete from $table_name where id='$id'");

if (!$result) {
	$msg = "접속키워드 삭제를 실패하였습니다.";
	$resultYN = "N";
} else {
	$msg = "접속키워드 삭제를 성공하였습니다.";	
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
?>