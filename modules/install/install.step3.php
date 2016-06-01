<?
$mysql_host	= trim($_POST['mysql_host']);
$mysql_user	= trim($_POST['mysql_user']);
$mysql_pwd	= trim($_POST['mysql_pwd']);
$mysql_db 		= trim($_POST['mysql_db']);

$resultYN = "Y";
$msg = "";

$file = "../../config/config.db.php";
$fp = fopen($file, "w");

if(!$fp) {
	$msg .= "파일을 여는데 실패했습니다.";
	$resultYN = "N";
}else{

	$str = "";
	$str .= "<?\n";
	$str .= "\$mysql_host = '$mysql_host';	// 서버이름(호스트명) \n";
	$str .= "\$mysql_user = '$mysql_user';	// 사용자 계정 \n";
	$str .= "\$mysql_pwd = '$mysql_pwd';	// 비밀번호 \n";
	$str .= "\$mysql_db = '$mysql_db';	// 데이터베이스(DB명) \n";
	$str .= "\$connect = @mysql_connect(\$mysql_host, \$mysql_user, \$mysql_pwd) or die('서버 연결에 실패 했습니다. 계정 또는 패스워드를 확인하세요.');\n@mysql_select_db(\$mysql_db, \$connect) or die('데이터베이스 연결에 실패 했습니다. 데이터베이스명을 확인하세요.');";
	$str .= "\n?>";

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