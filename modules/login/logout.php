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

/*
session_unregister("ljs_memberid");
session_unregister("ljs_pass1");
session_unregister("ljs_writer");
session_unregister("ljs_nickname");
session_unregister("ljs_email");
session_unregister("ljs_hit");
session_unregister("ljs_point");
session_unregister("user");
session_unregister("grade");
session_register("chatip");
session_unregister("admin_ok");
*/

echo ("<meta http-equiv='Refresh' content='0; URL=../index.php'>");
?>