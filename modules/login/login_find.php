<? session_start(); ?>
<?
include "lib.php";

$pass=substr(md5($pass),0,8);
$queryy="select * from $member_table where ".
						 " ljs_memberid='$memberid' and ljs_pass1='$pass' ";
$result=mysql_query($queryy);
$num=mysql_num_rows($result);
if ($num)
{
$row=mysql_fetch_array($result);
$ljs_memberid=$row[ljs_memberid];
$ljs_pass1=$row[ljs_pass1];
$ljs_name=$row[name];
$ljs_conpanyname=$row[conpany];
if($ljs_conpanyname) {
	$ljs_name=$ljs_conpanyname;
}
$ljs_email=$row[email];
$ljs_writer=$row[writer];
$ljs_hit=$row[hit];
$grade=$row[grade];
$automod1="yes";
$chatip=$REMOTE_ADDR;

session_register("member_table");
session_register("ljs_memberid");
session_register("ljs_pass1");
session_register("ljs_name");
session_register("ljs_email");
session_register("ljs_writer");
session_register("ljs_hit");
session_register("grade");
session_register("automod1");
session_register("chatip");

$result=mysql_query("select hit from $member_table where ljs_memberid='$ljs_memberid' ");
$row=mysql_fetch_array($result);
$hit=$row[hit]+1;
$sql=mysql_query("update $member_table set hit=$hit where ljs_memberid='$ljs_memberid' ");
if($ljs_mod==r_mode) {
echo ("<meta http-equiv='Refresh' content='0; URL=board_read.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&s_mod=$s_mod&fmenu=$fmenu&fsubmenu=$fsubmenu'>");
}else if($ljs_mod==writer){
echo ("<meta http-equiv='Refresh' content='0; URL=board_write.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid&fmenu=$fmenu&fsubmenu=$fsubmenu'>");
}else{
echo ("<meta http-equiv='Refresh' content='0; URL=../index.php'>");
}
}else{
echo ("<meta http-equiv='Refresh' content='0; URL=login_an.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid&fmenu=$fmenu&fsubmenu=$fsubmenu'>");
}
mysql_close();
?>