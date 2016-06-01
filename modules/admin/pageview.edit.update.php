<?
include "../lib.php";

$name = $_POST['name'];

$msg = "";
$resultYN = "Y";

$result=mysql_query("update $pageview set hit='0' where name='$name'");

if (!$result) {
	$msg = "$name  필드수정을 실패하였습니다.";
}else{
	$msg = "$name  필드수정을 성공하였습니다.";
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>