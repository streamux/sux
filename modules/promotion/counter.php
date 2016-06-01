<?
if (!$connectcheck) { // 접속자 시작
// 접속한 총수
$result11=mysql_query("select hit from $connecter_all");
$row11=mysql_fetch_array($result11);
$jsjhit=$row11[hit]+1;
$sql11=mysql_query("update $connecter_all set hit=$jsjhit");
// 접속자 수
$jsjdeldate=date("Y-m-d", time()-86400);  // 60초 * 06분 * 24시 = 86400초 하루를 초로환산
$convalue12=mysql_query("delete from $connecter where date < '$jsjdeldate'");
$query12=mysql_query("insert into $connecter values ('','$REMOTE_ADDR', now())");
// 실접속자 수
$ip = $REMOTE_ADDR;
$result13=mysql_query("select * from $connecter_real where ip = '$ip' and date = now()");
$rowip=mysql_num_rows($result13);
if(!$rowip) {
$realdeldate2=date("Y-m-d", time()-86400);  // 60초 * 06분 * 24시 = 86400초 하루를 초로환산
$convalue13=mysql_query("delete from $connecter_real where date < '$realdeldate2'");
$query13=mysql_query("insert into $connecter_real values ('','$REMOTE_ADDR', now())");
// 실접속자 총수
$resultrl=mysql_query("select hit from $connecter_real_all");
$rowrl=mysql_fetch_array($resultrl);
$jsjhitrl=$rowrl[hit]+1;
$sqlrl=mysql_query("update $connecter_real_all set hit=$jsjhitrl");
}
$connectcheck="yes";
session_register("connectcheck");
}

// 접속한 총수
$result15=mysql_query("select * from $connecter_all");
$row15=mysql_fetch_array($result15);
$jsjhit=$row15[hit];

// 접속자 수
$jnumresults16=mysql_query("select id from $connecter where date = now()");
$jnumrows16=mysql_num_rows($jnumresults16);
$todaycon=$jnumrows16;
$jnumresults17=mysql_query("select id from $connecter where date < now()");
$jnumrows17=mysql_num_rows($jnumresults17);
$yescon=$jnumrows17;

// 실접속자 수
$jnumresults18=mysql_query("select id from $connecter_real where date = now()");
$jnumrows18=mysql_num_rows($jnumresults18);
$todaycon_real=$jnumrows18;
$jnumresults19=mysql_query("select id from $connecter_real where date < now()");
$jnumrows19=mysql_num_rows($jnumresults19);
$todaycon_real=$jnumrows19;

// 실접속 총수
$result20=mysql_query("select * from $connecter_real_all");
$row20=mysql_fetch_array($result20);
$jsjhit20=$row20[hit];