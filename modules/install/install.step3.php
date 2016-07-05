<?
$db_hostname	= trim($_POST['db_hostname']);
$db_userid		= trim($_POST['db_userid']);
$db_password	= trim($_POST['db_password']);
$db_database 	= trim($_POST['db_database']);

$resultYN = "Y";
$msg = "";

$file = "../../config/db.config.php";
$fp = fopen($file, "w");

if(!$fp) {
	$msg .= "파일을 여는데 실패했습니다.";
	$resultYN = "N";
}else{

	$str = "";
	$str .= "<?\n";
	$str .= "\$db_hostname = '$db_hostname';\n";
	$str .= "\$db_userid = '$db_userid';\n";
	$str .= "\$db_password = '$db_password';\n";
	$str .= "\$db_database = '$db_database';\n";
	$str .= "?>";

	fwrite($fp, $str, strlen($str));
	fclose($fp);

	$msg = "데이터베이스 설정을 완료하였습니다.";
	$resultYN = "Y";
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = json_encode($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';

mysql_close();
?>