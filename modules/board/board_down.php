<?
include "config_db.php";
$connect = @mysql_connect($mysql_host, $mysql_user, $mysql_pwd) or die("DB 서버 연결에 실패 했습니다. 계정 또는 패스워드를 확인하세요.");
@mysql_select_db($mysql_db, $connect) or die("DB명을 확인하세요.");
header("Content-Type: file/unkown");
header("Content-Disposition: attachment; filename=$fileupname");
header("Content-Transfer-Encoding: binary"); 
header("Content-Length: $filepath"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 
$fp = fopen("../$board/$fileupname","rb") ; 
fpassthru($fp);
exit;
?>