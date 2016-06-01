<?
include "../lib.php";

$del_puid = $_POST['id'];

$msg = "";
$resultYN = "Y";

$table_name = $popup;
$result = mysql_query("delete From $table_name where id='$del_puid'");

if (!$result) {
	 $msg = "$del_puname 팝업 레코드 삭제를 실패하였습니다.";
	 $resultYN = "N";
} else {
 	$msg = "$del_puname 팝업 레코드 삭제를 성공하였습니다.";
 	$resultYN = "Y";
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
