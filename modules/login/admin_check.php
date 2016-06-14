<?
if ($_SESSION[admin_ok] != md5($admin_name)) {
echo (" <script>
			alert('죄송합니다! 이곳은 관리자 메뉴입니다.')
			history.go(-1)
		</script>");
exit;
}
?>
