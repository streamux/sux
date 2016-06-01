<?
include "../lib.php";

$keyword = $_POST['keyword'];

$msg = "";
$resultYN = "Y";

$result = mysql_query("insert into $connecter_site values ('','$keyword',now(),0)");

if (!$result) {
 	$msg = "접속키워드 추가를 실패하였습니다.";
} else {
	$msg = "접속키워드 추가를 성공하였습니다.";
}


$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
?>