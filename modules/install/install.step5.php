<?
$admin_id		= trim($_POST['admin_id']);
$admin_pwd	= trim($_POST['admin_pwd']);
$admin_email	= trim($_POST['admin_email']);
$yourhome		= trim($_POST['yourhome']);

$resultYN = "Y";
$msg = "";

$file = "../../config/config.php";
$fp = fopen($file, "w");

if(!$fp) {
	$msg = "파일을 여는데 실패했습니다.";
	$resultYN = "N";
} else {

	if (strlen(stristr($yourhome, "http://")) == 0) {
		$yourhome	 = "http://".$yourhome	;
	}

	$str = "";
	$str .= "<?\n";
	$str .= "\$admin_id		= '$admin_id';		// 관리자 아이디\n";
	$str .= "\$admin_pwd	= '$admin_pwd';	// 관리자 패스워드\n";
	$str .= "\$admin_email	= '$admin_email';	// 관리자 이메일\n";	
	$str .= "\$yourhome		= '$yourhome';		// 홈으로 가기\n";
	$str .= "?>";

	fwrite($fp, "$str", strlen($str));
	fclose($fp);

	$msg = "관리자계정 설정을 완료하였습니다.";
	$resultYN = "Y";
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = json_encode($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';

mysql_close();
?>