<?
session_start();
include "lib.php";

if(!$HTTP_SESSION_VARS[ljs_name] || !$HTTP_SESSION_VARS[ljs_pass1]){
echo ("
	<script>
	alert('먼저 로그인 하세요.')
	history.go(-1)
	</script>
	");
	exit;
}else{
	if ($HTTP_POST_VARS[admin_pass] == $admin_pwd) {
	$admin_ok=md5("$admin_name");
	session_register("admin_ok");
	echo ("<meta http-equiv='Refresh' content='0; URL=$yourhome'>");
	}else{
	echo ("
	<script>
	alert('죄송합니다! 이곳은 관리자 메뉴입니다.')
	history.go(-1)
	</script>
	");
	exit;
}
}
?>