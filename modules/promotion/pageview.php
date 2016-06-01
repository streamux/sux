<?
if($pageviewname){
$result11=mysql_query("select id from $pageview where name='$pageviewname'");
if($result11){
$numrows11=mysql_num_rows($result11);
}
if($numrows11 < 1){
$query="insert into $pageview values ('','$pageviewname',now(),0)";
$result=mysql_query($query);
}else{
$result11=mysql_query("select hit from $pageview where name='$pageviewname'");
$row11=mysql_fetch_array($result11);
$jsjhit=$row11[hit]+1;
$sql11=mysql_query("update $pageview set hit='$jsjhit' where name='$pageviewname'");
}
}
?>