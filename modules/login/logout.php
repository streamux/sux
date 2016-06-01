<?
session_start();
session_unregister("member_table");
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
echo ("<meta http-equiv='Refresh' content='0; URL=../index.php'>");

?>