<?
include "../lib.php";

$keyword = $_POST['keyword'];

$msg = "";
$resultYN = "Y";

$table_name = "$pageview";
$result = mysql_query("insert into $table_name values ('','$keyword',now(),0)");

if (!$result) {
	$msg = "페이지뷰 키워드 추가를 실패하였습니다.";
	$resultYN = "N";
} else {
	$msg = "페이지뷰 키워드 추가를 성공하였습니다.";
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>