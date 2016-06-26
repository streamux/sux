<meta charset="utf-8" />

<?
if ($_SESSION[admin_ok] !== md5($admin_id)) {

	echo ("<script>
				alert('죄송합니다! 이곳은 관리자 메뉴입니다.\\n관리자 로그인을 먼저 하세요.');				
				location.href=\"login.php\";
			</script>");
exit;
}
?>
