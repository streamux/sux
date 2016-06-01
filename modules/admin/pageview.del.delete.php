<?
include "../lib.php";

$id = $_POST['id'];

$msg = "";
$resultYN = "Y";

$result = mysql_query("delete from $pageview where id='$id'");

if (!$result) {
	$msg = "페이지뷰 키워드 삭제를 실패하였습니다.";
	$resultYN = "N";
} else {
	$msg = "페이지뷰 키워드 삭제를 성공하였습니다.";	
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>