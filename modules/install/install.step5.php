<?
$admin_id		= trim($_POST['admin_id']);
$admin_pwd	= trim($_POST['admin_pwd']);
$admin_email	= trim($_POST['admin_email']);
$yourhome		= trim($_POST['yourhome']);

$resultYN = "Y";
$msg = "";

$file = "../../config/admin.inc.php";
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
	$str .= "\$admin_id		= '$admin_id';\n";
	$str .= "\$admin_pwd	= '$admin_pwd';\n";
	$str .= "\$admin_email	= '$admin_email';\n";	
	$str .= "\$yourhome		= '$yourhome';\n";
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