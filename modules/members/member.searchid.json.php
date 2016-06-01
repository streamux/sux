<?
include "../lib.php";

$table_name = $_POST['table_name'];
$id = $_POST['memberid'];


$dataObj	= "";
$msg = "";
$resultYN = "Y";


$msg = "신청 아이디 : ".$id."\n";

if (strlen($id) < 4) {

	$msg = "게시판 테이블 이름은 4글자 이상 사용해주세요.";

	$json_data = array(	"msg"=>$msg);

	$strJson = JsonEncoder::getInstance()->parse($json_data);
	echo $_REQUEST['callback'].'('.$strJson.')';
	exit;
} 

if ($id) {

	$result = mysql_query("select name from $table_name where id='$id'");
	$numrows = mysql_num_rows($result);

	if ($numrows> 0) {
		$msg = "'${id}'는 이미 존재하는 아이디입니다.";
		$resultYN = "N";
	} else {
		$msg = "'${id}'는 생성할 수 있는 아이디입니다.";
		$resultYN = "Y";
	}
}else{
	$msg = "아이디를 넣고 중복체크를 하십시오.";
	$resultYN = "N";
}


$json_data = array(	"data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
