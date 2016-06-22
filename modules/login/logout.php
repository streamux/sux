<?
session_start();

unset($_SESSION[ljs_member]);
unset($_SESSION[ljs_memberid]);
unset($_SESSION[ljs_pass1]);
unset($_SESSION[ljs_writer]);
unset($_SESSION[ljs_nickname]);
unset($_SESSION[ljs_email]);
unset($_SESSION[ljs_hit]);
unset($_SESSION[ljs_point]);
unset($_SESSION[user]);
unset($_SESSION[grade]);
unset($_SESSION[chatip]);
unset($_SESSION[admin_ok]);

$targetURL = $_SERVER[HTTP_REFERER];

echo ("<meta http-equiv='Refresh' content='0; URL=$targetURL'>");
?>